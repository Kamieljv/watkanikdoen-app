<?php

namespace App\Services;

use Normalizer;

/**
 * Makes untrusted user input (e.g. contact form messages) safe to put in a mail notification.
 *
 * Laravel renders MailMessage lines through Blade (HTML-escaped) and then through Markdown,
 * so besides HTML we also have to neutralise Markdown (links, images, headings, code blocks),
 * invisible/control characters and clickable URLs. The result is always plain, inert text.
 */
class MailTextSanitizer
{
    /** Characters with inline meaning in (CommonMark) Markdown. `<`, `>` and `&` are left to Blade's escaping. */
    private const MARKDOWN_INLINE = ['\\', '`', '*', '_', '[', ']', '(', ')', '!', '|', '~', '{', '}'];

    /**
     * Sanitize a single-line value (name, subject, ...): newlines are collapsed into spaces.
     */
    public static function line(?string $value, int $maxLength = 255): string
    {
        $text = self::clean($value);
        $text = trim(preg_replace('/\s+/u', ' ', $text));

        return self::escapeMarkdown(self::truncate($text, $maxLength));
    }

    /**
     * Sanitize a multi-line value (the message body) into separate lines, one per MailMessage line.
     *
     * @return string[]
     */
    public static function lines(?string $value, int $maxLength = 5000, int $maxLines = 100): array
    {
        $text = self::truncate(self::clean($value), $maxLength);

        $lines = array_map(
            fn (string $line) => trim(preg_replace('/[^\S\n]+/u', ' ', $line)),
            explode("\n", $text),
        );
        $lines = array_values(array_filter($lines, fn (string $line) => $line !== ''));

        if (count($lines) > $maxLines) {
            $lines = array_slice($lines, 0, $maxLines);
            $lines[] = '[…]';
        }

        return array_map(fn (string $line) => self::escapeMarkdown($line), $lines);
    }

    /**
     * Sanitize an e-mail address; returns null when it is not a valid, single address.
     */
    public static function email(?string $value): ?string
    {
        // No defanging here: the address is validated, and only used for Reply-To (and escaped when shown)
        $email = trim(self::plainText($value));

        if ($email === '' || filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return null;
        }

        return $email;
    }

    /**
     * Plain, inert text: no HTML, control characters or clickable URLs.
     */
    private static function clean(?string $value): string
    {
        return self::defangUrls(self::plainText($value));
    }

    /**
     * Strip everything that is not plain text.
     */
    private static function plainText(?string $value): string
    {
        if ($value === null) {
            return '';
        }

        // Drop invalid UTF-8 and normalise (so look-alike compositions can't slip through)
        $text = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
        if (class_exists(Normalizer::class)) {
            $text = Normalizer::normalize($text, Normalizer::FORM_KC) ?: $text;
        }

        // Decode entities first, so encoded tags (&lt;script&gt;) are stripped as well. Twice, for double encoding.
        for ($i = 0; $i < 2; $i++) {
            $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        }
        $text = strip_tags($text);

        // Normalise newlines; remove control characters (except newline and tab)
        $text = str_replace(["\r\n", "\r"], "\n", $text);
        $text = preg_replace('/[^\P{C}\n\t]/u', '', $text) ?? '';
        // Remove bidi overrides and zero-width characters (used to disguise links or text)
        return preg_replace('/[\x{200B}-\x{200F}\x{202A}-\x{202E}\x{2060}-\x{2064}\x{2066}-\x{2069}\x{FEFF}]/u', '', $text) ?? '';
    }

    /**
     * Make URLs and e-mail addresses non-clickable (mail clients auto-link them), e.g.
     * https://evil.example → hxxps://evil[.]example. The admin can still read them.
     */
    private static function defangUrls(string $text): string
    {
        $text = preg_replace('/\bhttp(s?):\/\//iu', 'hxxp$1://', $text) ?? $text;
        $text = preg_replace('/\b(ftp|file|javascript|data|vbscript|mailto):/iu', '$1[:]', $text) ?? $text;

        // Domain-like tokens (www.example.com, example.org/path, user@example.com): bracket the dots
        return preg_replace_callback(
            '/\b[\p{L}\p{N}-]+(?:\.[\p{L}\p{N}-]+)*\.\p{L}{2,}\b/u',
            fn (array $match) => str_replace('.', '[.]', $match[0]),
            $text,
        ) ?? $text;
    }

    /**
     * Escape Markdown so the text is rendered literally.
     */
    private static function escapeMarkdown(string $text): string
    {
        $text = str_replace(
            self::MARKDOWN_INLINE,
            array_map(fn (string $char) => '\\' . $char, self::MARKDOWN_INLINE),
            $text,
        );

        // Block-level markers at the start of a line: headings, lists, rules, setext underlines.
        // (A leading `>` needs nothing: Blade turns it into `&gt;`, which is not a blockquote marker.)
        $text = preg_replace('/^([#+\-=])/u', '\\\\$1', $text) ?? $text;

        // Ordered lists ("1." / "1)"): escape the delimiter
        return preg_replace('/^(\d+)([.)])/u', '$1\\\\$2', $text) ?? $text;
    }

    private static function truncate(string $text, int $maxLength): string
    {
        return mb_strlen($text) > $maxLength ? mb_substr($text, 0, $maxLength) . '…' : $text;
    }
}
