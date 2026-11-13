<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookShelf;
use App\Models\Theme;
use App\Services\BookCoverOptimizer;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class BookController extends Controller
{
    protected const CANDIDATE_CACHE_PREFIX = 'book-search-candidate:';

    protected const SEARCH_LIMIT = 10;

    protected const EMPTY_BOOK = [
        'title' => null,
        'description' => null,
        'author' => null,
        'year' => null,
        'publisher' => null,
        'cover_image' => null,
        'isbn' => null,
    ];

    /**
     * Display the books page
     */
    public function index(Request $request)
    {
        // Definieer de routes waarmee de component evenementen kan ophalen
        $routes = getRouteUris(namePattern: 'book');

        $themes = Theme::orderBy('name', 'ASC')->get();
        $themes_selected_ids = $request->themes ? array_map('intval', $request->themes) : [];

        // Fetch bookshelves with related data
        $bookShelves = BookShelf::with(['organizer', 'themes', 'books'])
            ->get();

        // SEO
        SEOTools::setTitle(__('books.title'));
        SEOTools::setDescription(__('books.sub_title'));
        SEOMeta::setKeywords(__('books.title'));
        return view('books.index', compact('themes', 'routes', 'themes_selected_ids', 'bookShelves'));
    }

    public function search(Request $request)
    {
        $query = Book::query();

        if ($request->themes) {
            $requestThemes = is_array($request->themes) ? $request->themes : array($request->themes);
            $query->whereHas('themes', function ($q) use ($requestThemes) {
                $q->whereIn('theme_id', $requestThemes);
            });
        }

        // Include tags and themes in the response
        // Tags should be a flat array of tag names, themes should be the full theme objects
        $query->with(['themes']);

        if ($request->limit) {
            $books = $query->limit($request->limit)->get();
        } else {
            $books = $query->paginate(10);
        }

        // Add bookshelves to the response (only slug, organizer name and image)
        $books->load([
            'bookShelves:id,slug,organizer_id',
            'bookShelves.organizer:id,name',
        ]);

        return response()->json(['books' => $books]);
    }


    /**
     * Search for books by title on OpenLibrary, falling back to the Big Book API
     * (which has a small daily quota) only when OpenLibrary finds nothing.
     *
     * Each match is cached for an hour so the full data can be retrieved with
     * fetchBookDataByCandidate() once the user picks one.
     *
     * @param string $title
     * @return array<string, string> Candidate key => human readable label
     */
    public function searchBooksByTitle(string $title): array
    {
        $title = trim($title);
        if ($title === '') {
            return [];
        }

        $candidates = $this->searchOpenLibrary($title);
        if (empty($candidates)) {
            $candidates = $this->searchBigBook($title);
        }

        $options = [];
        foreach ($candidates as $candidate) {
            $key = $candidate['source'] . ':' . $candidate['id'];
            Cache::put(self::CANDIDATE_CACHE_PREFIX . $key, $candidate, now()->addHour());
            $options[$key] = $this->candidateLabel($candidate);
        }

        return $options;
    }

    /**
     * Get the label of a candidate previously returned by searchBooksByTitle().
     *
     * @param string|null $key
     * @return string|null
     */
    public function getCandidateLabel(?string $key): ?string
    {
        $candidate = $key ? Cache::get(self::CANDIDATE_CACHE_PREFIX . $key) : null;
        return $candidate ? $this->candidateLabel($candidate) : $key;
    }

    /**
     * Fetch the full book data for a candidate returned by searchBooksByTitle().
     *
     * Starts from the candidate's own data (plus Big Book's detail endpoint for
     * Big Book results), then fills in whatever is still missing from the
     * ISBN-based sources if an ISBN is known.
     *
     * @param string $key
     * @return array
     * @throws \Exception
     */
    public function fetchBookDataByCandidate(string $key): array
    {
        [$source, $id] = array_pad(explode(':', $key, 2), 2, null);

        $data = match ($source) {
            'bigbook' => $this->fetchFromBigBook((int) $id),
            'openlibrary' => Cache::get(self::CANDIDATE_CACHE_PREFIX . $key)['data'] ?? [],
            default => [],
        };

        if (empty($data)) {
            throw new \Exception('Could not retrieve this book, please search again');
        }

        $result = $this->fillMissingBookData(
            array_merge(self::EMPTY_BOOK, array_filter($data)),
            $this->isbnSources(),
        );

        if (empty($result['title'])) {
            throw new \Exception('Book not found');
        }

        return $result;
    }

    /**
     * Fetch book data by ISBN.
     *
     * Queries each source in order (OpenLibrary, Hardcover, De Slegte) and
     * fills in whichever fields are still missing. A source is skipped once
     * every field has already been found.
     *
     * @param string $isbn
     * @return array
     * @throws \Exception
     */
    public function fetchBookDataByIsbn(string $isbn): array
    {
        if (empty($isbn)) {
            throw new \Exception('ISBN is required');
        }

        $result = $this->fillMissingBookData(
            array_merge(self::EMPTY_BOOK, ['isbn' => $isbn]),
            $this->isbnSources(),
        );

        if (empty($result['title'])) {
            throw new \Exception('Book not found with this ISBN');
        }

        return $result;
    }

    /**
     * Sources that look a book up by ISBN, in order of preference.
     *
     * @return array<callable(string): array<string, mixed>>
     */
    protected function isbnSources(): array
    {
        return [
            fn(string $isbn) => $this->fetchFromOpenLibrary($isbn),
            fn(string $isbn) => $this->fetchFromHardcover($isbn),
            fn(string $isbn) => $this->fetchFromDeSlegte($isbn),
        ];
    }

    /**
     * Fill the empty fields of $result from each ISBN source in turn.
     * Does nothing if no ISBN is known.
     *
     * @param array $result
     * @param array<callable(string): array<string, mixed>> $sources
     * @return array
     */
    protected function fillMissingBookData(array $result, array $sources): array
    {
        if (empty($result['isbn'])) {
            return $result;
        }

        foreach ($sources as $source) {
            if ($this->hasAllBookData($result)) {
                break;
            }

            foreach ($source($result['isbn']) as $key => $value) {
                if (empty($result[$key]) && !empty($value)) {
                    $result[$key] = $value;
                }
            }
        }

        return $result;
    }

    /**
     * @param array $candidate
     * @return string
     */
    protected function candidateLabel(array $candidate): string
    {
        $data = $candidate['data'];
        $label = $data['title'];
        if (!empty($data['author'])) {
            $label .= ' — ' . $data['author'];
        }
        if (!empty($data['year'])) {
            $label .= " ({$data['year']})";
        }

        return $label . ' · ' . ($candidate['source'] === 'bigbook' ? 'Big Book' : 'OpenLibrary');
    }

    /**
     * Search the Big Book API by title.
     *
     * @see https://bigbookapi.com/docs/#Search-Books
     * @param string $title
     * @return array<array{source: string, id: int, data: array}>
     */
    protected function searchBigBook(string $title): array
    {
        $books = $this->bigBookGet(
            'https://api.bigbookapi.com/search-books',
            ['query' => mb_strtolower($title), 'number' => self::SEARCH_LIMIT],
            now()->addWeek(),
        )['books'] ?? [];

        // Each entry in "books" is an array wrapping a single book object
        return collect($books)
            ->map(fn($entry) => array_is_list($entry) ? ($entry[0] ?? null) : $entry)
            ->filter(fn($book) => !empty($book['id']) && !empty($book['title']))
            ->map(fn($book) => [
                'source' => 'bigbook',
                'id' => $book['id'],
                'data' => [
                    'title' => $book['title'],
                    'author' => $this->joinNames(collect($book['authors'] ?? [])->pluck('name')->all()),
                    'cover_image' => $book['image'] ?? null,
                ],
            ])
            ->values()
            ->all();
    }

    /**
     * Fetch a single book from the Big Book API by its Big Book id.
     *
     * @see https://bigbookapi.com/docs/#Get-Book-Information
     * @param int $id
     * @return array<string, mixed>
     */
    protected function fetchFromBigBook(int $id): array
    {
        $book = $this->bigBookGet("https://api.bigbookapi.com/{$id}", [], now()->addMonth());
        if (empty($book)) {
            return [];
        }

        $identifiers = $book['identifiers'] ?? [];
        $isbn = $identifiers['isbn_13'] ?? $identifiers['isbn_10'] ?? null;

        return [
            'title' => $book['title'] ?? null,
            'description' => $book['description'] ?? null,
            'author' => $this->joinNames(collect($book['authors'] ?? [])->pluck('name')->all()),
            'year' => !empty($book['publish_date']) ? (int) $book['publish_date'] : null,
            'cover_image' => $book['image'] ?? null,
            'isbn' => is_array($isbn) ? ($isbn[0] ?? null) : $isbn,
        ];
    }

    /**
     * GET a Big Book API endpoint. Successful responses are cached, and requests
     * are capped at services.bigbook.daily_limit per (UTC) day to stay within
     * the API quota.
     *
     * @param string $url
     * @param array $query
     * @param \DateTimeInterface $cacheUntil
     * @return array|null The decoded response, or null if unavailable
     */
    protected function bigBookGet(string $url, array $query, \DateTimeInterface $cacheUntil): ?array
    {
        if (empty(config('services.bigbook.key'))) {
            return null;
        }

        $cacheKey = 'bigbook:' . md5($url . '?' . http_build_query($query));
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $counterKey = 'bigbook-requests:' . now('UTC')->toDateString();
        Cache::add($counterKey, 0, now('UTC')->endOfDay());
        if (Cache::increment($counterKey) > config('services.bigbook.daily_limit')) {
            Log::info('Big Book API daily limit reached, skipping request', ['url' => $url]);
            return null;
        }

        $response = Http::withHeaders(['x-api-key' => config('services.bigbook.key')])
            ->acceptJson()
            ->timeout(10)
            ->get($url, $query);

        if (!$response->successful()) {
            Log::warning('Big Book API request failed', ['url' => $url, 'status' => $response->status()]);
            return null;
        }

        $data = $response->json();
        Cache::put($cacheKey, $data, $cacheUntil);

        return $data;
    }

    /**
     * Search OpenLibrary by title. Uses the best matching edition of each work
     * (e.g. the Dutch edition when searching for a Dutch title) for its data.
     *
     * @param string $title
     * @return array<array{source: string, id: string, data: array}>
     */
    protected function searchOpenLibrary(string $title): array
    {
        $response = Http::withHeaders([
            'User-Agent' => config('app.name'),
        ])->timeout(10)->get('https://openlibrary.org/search.json', [
                    'q' => $title,
                    'fields' => 'key,title,author_name,first_publish_year,cover_i,editions,editions.key,editions.title,editions.isbn,editions.publisher,editions.publish_year,editions.cover_i',
                    'limit' => self::SEARCH_LIMIT,
                    'email' => config('app.admin_email'),
                ]);

        if (!$response->successful()) {
            return [];
        }

        return collect($response->json('docs', []))
            ->filter(fn($work) => !empty($work['key']))
            ->map(function ($work) {
                $edition = $work['editions']['docs'][0] ?? [];
                $coverId = $edition['cover_i'] ?? $work['cover_i'] ?? null;
                $isbns = $edition['isbn'] ?? [];

                return [
                    'source' => 'openlibrary',
                    'id' => $edition['key'] ?? $work['key'],
                    'data' => [
                        'title' => $edition['title'] ?? $work['title'] ?? null,
                        'author' => $this->joinNames($work['author_name'] ?? []),
                        'year' => $edition['publish_year'][0] ?? $work['first_publish_year'] ?? null,
                        'publisher' => $edition['publisher'][0] ?? null,
                        'cover_image' => $coverId ? "https://covers.openlibrary.org/b/id/{$coverId}-M.jpg" : null,
                        // Prefer ISBN-13
                        'isbn' => collect($isbns)->first(fn($isbn) => strlen($isbn) === 13) ?? ($isbns[0] ?? null),
                    ],
                ];
            })
            ->filter(fn($candidate) => !empty($candidate['data']['title']))
            ->values()
            ->all();
    }

    /**
     * @param array<string|null> $names
     * @return string|null
     */
    protected function joinNames(array $names): ?string
    {
        $names = array_filter($names);
        return !empty($names) ? implode(', ', $names) : null;
    }

    /**
     * Download a remote cover image and store it on the public disk under books/,
     * converted to a small WebP (see BookCoverOptimizer).
     *
     * @param string $url
     * @param string $name Used to derive a unique file name (e.g. the ISBN or title)
     * @return string|null Relative storage path (e.g. "books/xxx.jpg"), or null if the download failed.
     */
    public function downloadCoverImage(string $url, string $name): ?string
    {
        $response = Http::get($url);

        if (!$response->successful()) {
            return null;
        }

        $contentType = explode(';', $response->header('Content-Type'))[0];
        $extension = explode('/', $contentType)[1] ?? 'jpg';

        $filePath = 'books/' . md5($name . microtime()) . '.' . $extension;
        Storage::disk('public')->put($filePath, $response->body());

        try {
            return app(BookCoverOptimizer::class)->optimize($filePath);
        } catch (\Throwable $e) {
            // Not a readable image
            Storage::disk('public')->delete($filePath);
            return null;
        }
    }

    /**
     * Whether every field has already been found.
     *
     * @param array $result
     * @return bool
     */
    protected function hasAllBookData(array $result): bool
    {
        return collect($result)
            ->every(fn($value) => !empty($value));
    }

    /**
     * Fetch book data, and failing that its cover, from OpenLibrary.
     *
     * @param string $isbn
     * @return array<string, mixed>
     */
    protected function fetchFromOpenLibrary(string $isbn): array
    {
        $response = Http::withHeaders([
            'User-Agent' => config('app.name'),
        ])->get('https://openlibrary.org/search.json', [
                    'q' => "isbn:{$isbn}",
                    'email' => config('app.admin_email'),
                ]);

        if (!$response->successful() || $response->json('numFound') === 0) {
            return [];
        }

        $workKey = $response->json('docs.0.key');

        $workResponse = Http::withHeaders([
            'User-Agent' => config('app.name'),
        ])->get("https://openlibrary.org{$workKey}.json", [
                    'email' => config('app.admin_email'),
                ]);

        if (!$workResponse->successful()) {
            return [];
        }

        $bookData = $workResponse->json();

        $data = [
            'title' => $bookData['title'] ?? null,
            'description' => $bookData['description']['value'] ?? null,
            'year' => $bookData['publish_date'] ?? null,
            'publisher' => $bookData['publishers'][0] ?? null,
        ];

        if (isset($bookData['authors']) && is_array($bookData['authors'])) {
            $data['author'] = $this->fetchOpenLibraryAuthorNames($bookData['authors']);
        }

        $data['cover_image'] = $this->fetchCoverImage($isbn);

        return $data;
    }

    /**
     * Fetch author names from OpenLibrary API
     *
     * @param array $authors
     * @return string|null
     */
    protected function fetchOpenLibraryAuthorNames(array $authors): ?string
    {
        $authorKeys = collect($authors)
            ->pluck('key')
            ->toArray();

        $authorNames = [];
        foreach ($authorKeys as $authorKey) {
            if (!$authorKey)
                break;
            $authorResponse = Http::get("https://openlibrary.org{$authorKey}.json");
            if ($authorResponse->successful()) {
                $authorData = $authorResponse->json();
                if (isset($authorData['name'])) {
                    $authorNames[] = $authorData['name'];
                }
            }
        }

        return !empty($authorNames) ? implode(', ', $authorNames) : null;
    }

    /**
     * Fetch the cover image from OpenLibrary's covers CDN
     *
     * @param string $isbn
     * @return string|null
     */
    protected function fetchCoverImage(string $isbn): ?string
    {
        $coverUrl = "https://covers.openlibrary.org/b/isbn/{$isbn}-M.jpg";
        $coverResponse = Http::get($coverUrl . '?default=false');

        if ($coverResponse->successful()) {
            return $coverUrl;
        }
        return null;
    }

    /**
     * Fetch book data from the Hardcover API using ISBN
     *
     * @param string $isbn
     * @return array<string, mixed>
     */
    protected function fetchFromHardcover(string $isbn): array
    {
        // Use a graphql request to fetch book data from the Hardcover API
        $response = Http::withHeaders([
            'Authorization' => config('services.hardcover.token'),
        ])->post('https://api.hardcover.app/v1/graphql', [
                    'query' => '
                query BookCoverByISBN13 {
                    books(where: {editions: {isbn_13: {_eq: "' . $isbn . '"}}}) {
                        image {
                            url
                        }
                        title
                        description
                        release_year
                    }
                }
            '
                ]);

        if (!$response->successful()) {
            return [];
        }

        $book = $response->json('data.books.0');
        if (empty($book)) {
            return [];
        }

        return [
            'title' => $book['title'] ?? null,
            'description' => $book['description'] ?? null,
            'cover_image' => $book['image']['url'] ?? null,
            'year' => $book['release_year'] ?? null,

        ];
    }

    /**
     * Fetch book data from De Slegte by scraping their search and product pages,
     * since De Slegte does not offer a public API.
     *
     * @param string $isbn
     * @return array<string, mixed>
     */
    protected function fetchFromDeSlegte(string $isbn): array
    {
        $searchResponse = Http::withHeaders([
            'User-Agent' => config('app.name'),
        ])->get('https://www.deslegte.com/boeken/', [
                    'q' => ['isbn' => $isbn],
                ]);

        if (!$searchResponse->successful()) {
            return [];
        }

        $searchCrawler = new Crawler($searchResponse->body());
        $productLink = $searchCrawler->filter('.searchresults__list .searchresult__item a')->first();

        if ($productLink->count() === 0 || !$productLink->attr('href')) {
            return [];
        }

        $productResponse = Http::withHeaders([
            'User-Agent' => config('app.name'),
        ])->get('https://www.deslegte.com' . $productLink->attr('href'));

        if (!$productResponse->successful()) {
            return [];
        }

        $productCrawler = new Crawler($productResponse->body());

        $data = [
            'title' => $this->fetchDeSlegteText($productCrawler, '.product__page-title h1'),
            'description' => $this->fetchDeSlegteText($productCrawler, '.product__page-description-content'),
            'author' => $this->fetchDeSlegteSpec($productCrawler, 'Auteur'),
            'publisher' => $this->fetchDeSlegteSpec($productCrawler, 'Uitgever'),
            'year' => (int) filter_var($this->fetchDeSlegteSpec($productCrawler, 'Publicatiedatum'), FILTER_SANITIZE_NUMBER_INT),
        ];

        $coverImage = $productCrawler->filter('meta[itemprop="image"]')->first();
        if ($coverImage->count() > 0 && $coverImage->attr('content')) {
            $data['cover_image'] = 'https://www.deslegte.com' . $coverImage->attr('content');
        }

        return $data;
    }

    /**
     * Get the trimmed text content of the first element matching the selector.
     *
     * @param Crawler $crawler
     * @param string $selector
     * @return string|null
     */
    protected function fetchDeSlegteText(Crawler $crawler, string $selector): ?string
    {
        $node = $crawler->filter($selector)->first();
        if ($node->count() === 0) {
            return null;
        }

        $text = trim($node->text());
        return $text !== '' ? $text : null;
    }

    /**
     * Read a value from De Slegte's product specification list by its Dutch label
     * (e.g. "Auteur", "Uitgever", "Publicatiedatum").
     *
     * @param Crawler $crawler
     * @param string $label
     * @return string|null
     */
    protected function fetchDeSlegteSpec(Crawler $crawler, string $label): ?string
    {
        foreach ($crawler->filter('.product__page-spec-item') as $item) {
            $itemCrawler = new Crawler($item);
            $itemLabel = rtrim(trim($itemCrawler->filter('.column.left')->text('')), ':');

            if ($itemLabel === $label) {
                $value = trim($itemCrawler->filter('.column.right')->text(''));
                return $value !== '' ? $value : null;
            }
        }

        return null;
    }
}
