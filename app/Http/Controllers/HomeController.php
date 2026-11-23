<?php

namespace App\Http\Controllers;

use App\Models\Actie;
use App\Models\Book;
use App\Models\Category;
use App\Models\Organizer;
use App\Models\Theme;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index()
    {
        // Definieer de routes waarmee de component evenementen kan ophalen
        $actieRoutes = getRouteUris(namePattern: 'acties');
        $organizerRoutes = getRouteUris(namePattern: 'organizers');
        $bookRoutes = getRouteUris(namePattern: 'book');
        $themes = Theme::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();

        // Random selection of books (with a cover) for the books block
        $books = Book::whereHas('image', fn ($q) => $q->where('file_type', 'image'))
            ->inRandomOrder()
            ->limit(6)
            ->get();

        // Platform Statistics
        $stats = [
            'acties' => Actie::published()->count(),
            'organizers' => Organizer::published()->count(),
            'themes' => Theme::count()
        ];

        // SEO
        SEOTools::setTitle('Home' . ' | ' . config('brand.title'));

        return view('home', compact('actieRoutes', 'organizerRoutes', 'bookRoutes', 'books', 'stats'));
    }
}
