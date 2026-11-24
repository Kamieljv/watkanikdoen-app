<?php

use App\Services\MailTextSanitizer;

describe('MailTextSanitizer', function () {

    it('strips html, also when entity-encoded', function () {
        expect(MailTextSanitizer::line('<script>alert(1)</script>Hallo <b>daar</b>'))->toBe('alert\(1\)Hallo daar')
            ->and(MailTextSanitizer::line('&lt;img src=x onerror=alert(1)&gt;Hoi'))->toBe('Hoi')
            ->and(MailTextSanitizer::line('&amp;lt;b&amp;gt;Hoi'))->toBe('Hoi');
    });

    it('escapes inline markdown', function () {
        expect(MailTextSanitizer::line('[klik](x) ![img](y) **vet** `code`'))
            ->toBe('\[klik\]\(x\) \!\[img\]\(y\) \*\*vet\*\* \`code\`');
    });

    it('escapes block markdown at the start of a line', function () {
        expect(MailTextSanitizer::lines("# Kop\n- lijst\n1. item\n===\n    code"))
            ->toBe(['\# Kop', '\- lijst', '1\. item', '\===', 'code']);
    });

    it('defangs urls and domains', function () {
        expect(MailTextSanitizer::line('Zie https://evil.example/pad en www.test.nl of javascript:alert'))
            ->toBe('Zie hxxps://evil\[.\]example/pad en www\[.\]test\[.\]nl of javascript\[:\]alert');
    });

    it('collapses newlines in single-line values (no header injection)', function () {
        expect(MailTextSanitizer::line("Onderwerp\r\nBcc: x@y.z"))->not->toContain("\n")->not->toContain("\r");
    });

    it('removes control, zero-width and bidi characters', function () {
        expect(MailTextSanitizer::line("a\x00b\x07c\u{200B}d\u{202E}e\u{FEFF}f"))->toBe('abcdef');
    });

    it('drops invalid utf-8', function () {
        expect(mb_check_encoding(MailTextSanitizer::line("ok\xC3\x28ok"), 'UTF-8'))->toBeTrue();
    });

    it('truncates long values and limits the number of lines', function () {
        expect(mb_strlen(MailTextSanitizer::line(str_repeat('a', 500), 10)))->toBe(11)
            ->and(MailTextSanitizer::lines(str_repeat("regel\n", 300), 5000, 5))->toHaveCount(6);
    });

    it('splits a message into non-empty lines', function () {
        expect(MailTextSanitizer::lines("Eerste regel\r\n\r\n\r\n  Tweede   regel  "))->toBe(['Eerste regel', 'Tweede regel']);
    });

    it('only accepts valid e-mail addresses', function () {
        expect(MailTextSanitizer::email('jane@example.com'))->toBe('jane@example.com')
            ->and(MailTextSanitizer::email("jane@example.com\r\nBcc: x@y.z"))->toBeNull()
            ->and(MailTextSanitizer::email('geen e-mail'))->toBeNull()
            ->and(MailTextSanitizer::email(null))->toBeNull();
    });

});
