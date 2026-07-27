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
        $bookShelf = BookShelf::with(['organizer', 'themes', 'books.themes'])
            ->where('slug', $slug)
            ->firstOrFail();

        if (!$bookShelf) {
            abort(404, 'Boekenplank niet gevonden');
        }

        // Change the remove the pivot data key and add 'notes' to the book data
        $bookShelf->books->each(function ($book) use ($bookShelf) {
            $book->notes = [
                'organizer' => $bookShelf->organizer,
                'note' => $book->pivot->description,
            ];
            $book->makeHidden('pivot');
        });

        // SEO
        SEOTools::setTitle('Boekenplank van ' . $bookShelf->organizer->name);
        SEOTools::setDescription($bookShelf->description ?? 'Boekenplank van ' . $bookShelf->organizer->name);
        SEOMeta::setKeywords($bookShelf->themes->pluck('name')->join(', '));

        return view('bookshelves.show', compact('bookShelf'));
    }
}
