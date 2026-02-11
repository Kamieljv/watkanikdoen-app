<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
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
        $response = Http::get("https://openlibrary.org/isbn/{$isbn}.json");

        if (!$response->successful()) {
            throw new \Exception('Book not found with this ISBN');
        }

        $bookData = $response->json();
        \Log::debug($bookData);
        $result = [
            'title' => null,
            'description' => null,
            'author' => null,
            'year' => null,
            'cover_image' => null,
        ];

        $result = array_merge($result, [
            'title' => $bookData['title'] ?? null,
            'description' => $bookData['description']['value'] ?? null,
            'year' => $bookData['publish_date'] ?? null,
        ]);

        // Get author names
        if (isset($bookData['authors']) && is_array($bookData['authors'])) {
            $result['author'] = $this->fetchAuthorNames($bookData['authors']);
        }

        // Download and set cover image
        $result['cover_image'] = $this->fetchCoverImage($isbn);

        // If the cover image is empty, try to get it via the Hardcover API
        if (empty($result['cover_image'])) {
            $hardcoverData = $this->fetchBookDataFromHardcover($isbn);
            if ($hardcoverData && isset($hardcoverData['cover_image'])) {
                $result['cover_image'] = $hardcoverData['cover_image'];
            }
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
     * Fetch book data from the Hardcover API using ISBN
     */
    protected function fetchBookDataFromHardcover(string $isbn): ?array
    {
        // Use a graphql requst to fetch book data from the Hardcover API
        $response = Http::withHeaders([
            'Authorization' => env('HARDCOVER_BEARER_TOKEN'),
        ])->post('https://api.hardcover.app/v1/graphql', [
            'query' => '
                query BookCoverByISBN13 {
                    books(where: {editions: {isbn_13: {_eq: "' . $isbn . '"}}}) {
                        image {
                            url
                        }
                    }
                }
            '
        ]);
        
        \Log::debug($response->json());
        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['data']['books'][0]['image']['url'])) {
                return [
                    'cover_image' => $data['data']['books'][0]['image']['url'],
                ];
            }
        }
    }
}
