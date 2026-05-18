<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Theme;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

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

        // SEO
        SEOTools::setTitle(__('books.title'));
        SEOTools::setDescription(__('books.sub_title'));
        SEOMeta::setKeywords(__('books.title'));
        return view('books.index', compact('themes', 'routes', 'themes_selected_ids'));
    }

    public function search(Request $request)
    {
        $query = Book::query();
        if ($request->q) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->q . '%');
                // ->orWhere(column: 'keywords', 'LIKE', '%' . $request->q . '%');
            });
        }
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
     * Fetch book data from OpenLibrary API using ISBN
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

        // Fetch book data from OpenLibrary API
        $response = Http::get("https://openlibrary.org/isbn/{$isbn}.json", [
            'User-Agent' => config('app.name'),
            'email' => config('app.admin_email'),
        ]);

        if (!$response->successful()) {
            throw new \Exception('Book not found with this ISBN');
        }

        $bookData = $response->json();

        $result = [
            'title' => null,
            'description' => null,
            'author' => null,
            'year' => null,
            'publisher' => null,
            'cover_image' => null,
            'isbn' => $isbn,
        ];

        $result = array_merge($result, [
            'title' => $bookData['title'] ?? null,
            'description' => $bookData['description']['value'] ?? null,
            'year' => $bookData['publish_date'] ?? null,
            'publisher' => $bookData['publishers'][0] ?? null,
        ]);

        // Get author names
        if (isset($bookData['authors']) && is_array($bookData['authors'])) {
            $result['author'] = $this->fetchAuthorNames($bookData['authors']);
        }

        // Try fetching the cover from Goodreads
        $result['cover_image'] = $this->fetchCoverFromGoodreads($isbn);

        // Add missing data using the HardCover API
        if (in_array(null, $result, strict: true)) {
            $hardcoverData = $this->fetchBookDataFromHardcover($isbn);
            if ($hardcoverData) {
                $result = array_merge($result, $hardcoverData);
            }
        }

        // Last resort: try fetching the cover from OpenLibrary
        if (empty($result['cover_image'])) {
            $result['cover_image'] = $this->fetchCoverImage($isbn);
        }
        return $result;
    }

    /**
     * Fetch author names from OpenLibrary API
     *
     * @param array $authors
     * @return string|null
     */
    protected function fetchAuthorNames(array $authors): ?string
    {
        $authorKeys = collect($authors)
            ->pluck('key')
            ->toArray();

        $authorNames = [];
        foreach ($authorKeys as $authorKey) {
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
     * Fetch and store cover image from OpenLibrary
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
     * Fetch cover image URL from Goodreads by searching with ISBN
     *
     * @param string $isbn
     * @return string|null
     */
    protected function fetchCoverFromGoodreads(string $isbn): ?string
    {
        $searchUrl = 'https://www.goodreads.com/search?utf8=✓&query=' . urlencode($isbn);

        $response = Http::withHeaders([
            'User-Agent' => 'Mozilla/5.0 (compatible; ' . config('app.name') . ')',
        ])->get($searchUrl);

        if (!$response->successful()) {
            return null;
        }

        $html = $response->body();

        // Suppress HTML parsing warnings
        $doc = new \DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML($html);
        libxml_clear_errors();

        $xpath = new \DOMXPath($doc);

        // Get the first image with the class 'bookCover__image' in the search results
        $container = $xpath->query('.//div[contains(@class, "BookCover__image")]', $doc)->item(0);
        if ($container) {
            $img = $xpath->query('.//img', $container)->item(0);

            if ($img) {
                $src = $img->getAttribute('src');
                if (!empty($src)) {
                    return $src;
                }
            }
        }

        return null;
    }

    /** 
     * Fetch book data from the Hardcover API using ISBN
     */
    protected function fetchBookDataFromHardcover(string $isbn): ?array
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
                        description
                        release_year
                    }
                }
            '
                ]);

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['data']['books'][0]['image']['url'])) {
                return [
                    'description' => $data['data']['books'][0]['description'] ?? null,
                    'cover_image' => $data['data']['books'][0]['image']['url'],
                    'year' => $data['data']['books'][0]['release_year'] ?? null,
                ];
            }
        }
    }
}
