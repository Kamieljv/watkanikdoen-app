<?php

namespace App\Http\Controllers;

use App\Models\BookShelf;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookShelfController extends Controller
{
    /**
     * Display the bookshelves overview page
     */
    public function index(Request $request)
    {
        $bookShelves = BookShelf::with(['organizer', 'themes', 'books'])
            ->get();

        Log::info('BookShelves Overview', [
            'count' => $bookShelves->count(),
            'data' => $bookShelves->toArray()
        ]);

        // SEO
        SEOTools::setTitle('Boekenplanken');
        SEOTools::setDescription('Overzicht van alle boekenplanken');
        SEOMeta::setKeywords('boeken, boekenplanken, leeslijsten');

        return view('bookshelves.index', compact('bookShelves'));
    }

    /**
     * Display a single bookshelf by slug
     */
    public function show(string $slug)
    {
        $bookShelf = BookShelf::with(['organizer', 'themes', 'books'])
            ->where('slug', $slug)
            ->firstOrFail();

        Log::info('BookShelf Detail', [
            'slug' => $slug,
            'title' => $bookShelf->title,
            'organizer' => $bookShelf->organizer->name,
            'themes' => $bookShelf->themes->pluck('name')->toArray(),
            'books_count' => $bookShelf->books->count(),
            'books' => $bookShelf->books->map(function ($book) {
                return [
                    'title' => $book->title,
                    'author' => $book->author,
                    'description_on_shelf' => $book->pivot->description,
                ];
            })->toArray()
        ]);

        // SEO
        SEOTools::setTitle($bookShelf->title);
        SEOTools::setDescription($bookShelf->description ?? 'Boekenplank van ' . $bookShelf->organizer->name);
        SEOMeta::setKeywords($bookShelf->themes->pluck('name')->join(', '));

        return view('bookshelves.show', compact('bookShelf'));
    }
}
