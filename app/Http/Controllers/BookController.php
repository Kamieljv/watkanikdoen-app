<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookShelf;
use App\Models\Theme;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;

class BookController extends Controller
{
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

        $result = [
            'title' => null,
            'description' => null,
            'author' => null,
            'year' => null,
            'publisher' => null,
            'cover_image' => null,
            'isbn' => $isbn,
        ];

        $sources = [
            fn(string $isbn) => $this->fetchFromOpenLibrary($isbn),
            fn(string $isbn) => $this->fetchFromHardcover($isbn),
            fn(string $isbn) => $this->fetchFromDeSlegte($isbn),
        ];

        foreach ($sources as $source) {
            if ($this->hasAllBookData($result)) {
                break;
            }

            foreach ($source($isbn) as $key => $value) {
                if (empty($result[$key]) && !empty($value)) {
                    $result[$key] = $value;
                }
            }
        }

        if (empty($result['title'])) {
            throw new \Exception('Book not found with this ISBN');
        }

        return $result;
    }

    /**
     * Download a remote cover image and store it on the public disk under books/.
     *
     * @param string $url
     * @param string $isbn
     * @return string|null Relative storage path (e.g. "books/xxx.jpg"), or null if the download failed.
     */
    public function downloadCoverImage(string $url, string $isbn): ?string
    {
        $response = Http::get($url);

        if (!$response->successful()) {
            return null;
        }

        $contentType = explode(';', $response->header('Content-Type'))[0];
        $extension = explode('/', $contentType)[1] ?? 'jpg';

        $filePath = 'books/' . md5($isbn . microtime()) . '.' . $extension;
        Storage::disk('public')->put($filePath, $response->body());

        return $filePath;
    }

    /**
     * Whether every field (other than the ISBN itself) has already been found.
     *
     * @param array $result
     * @return bool
     */
    protected function hasAllBookData(array $result): bool
    {
        return collect($result)
            ->except('isbn')
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
        \Log::debug($bookData);

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
            'Authorization' => env('HARDCOVER_BEARER_TOKEN'),
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
            'year' => $this->fetchDeSlegteSpec($productCrawler, 'Publicatiedatum'),
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
