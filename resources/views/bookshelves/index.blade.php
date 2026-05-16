@extends('layouts.app')

@section('content')
    <div class="px-3 xl:px-5">
        <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 flex">
            <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Terug naar home
            </a>
        </div>

        <div class="max-w-6xl mx-auto mt-6">
            <h1 class="text-3xl font-bold">Boekenplanken</h1>
            <p class="mt-4">
                Overzicht van alle boekenplanken
            </p>
        </div>
    </div>

    <div class="px-3 xl:px-5 mb-40">
        <div class="max-w-6xl mx-auto mt-10">
            <h2 class="text-2xl font-bold mb-6">Gevonden boekenplanken: {{ $bookShelves->count() }}</h2>

            @foreach($bookShelves as $bookShelf)
                <div class="mb-8 p-6 border border-gray-300 rounded-lg">
                    <h3 class="text-xl font-bold">
                        <a href="{{ route('bookshelves.show', $bookShelf->slug) }}" class="text-blue-600 hover:text-blue-800">
                            {{ $bookShelf->title }}
                        </a>
                    </h3>
                    
                    <div class="mt-2 text-gray-600">
                        <strong>Organisator:</strong> {{ $bookShelf->organizer->name }}
                    </div>
                    
                    @if($bookShelf->description)
                        <div class="mt-2">
                            <strong>Beschrijving:</strong> {{ $bookShelf->description }}
                        </div>
                    @endif
                    
                    <div class="mt-2">
                        <strong>Thema's:</strong> 
                        @foreach($bookShelf->themes as $theme)
                            <span class="inline-block px-2 py-1 mr-2 text-sm rounded" style="background-color: {{ $theme->color }}20; color: {{ $theme->color }}">
                                {{ $theme->name }}
                            </span>
                        @endforeach
                    </div>
                    
                    <div class="mt-2">
                        <strong>Aantal boeken:</strong> {{ $bookShelf->books->count() }}
                    </div>
                </div>
            @endforeach

            @if($bookShelves->isEmpty())
                <p class="text-gray-600">Er zijn nog geen boekenplanken beschikbaar.</p>
            @endif
        </div>
    </div>
@endsection
