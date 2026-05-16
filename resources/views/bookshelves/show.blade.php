@extends('layouts.app')

@section('content')
    <div class="px-3 xl:px-5">
        <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 flex">
            <a href="{{ route('bookshelves.index') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Terug naar boekenplanken
            </a>
        </div>

        <div class="max-w-6xl mx-auto mt-6">
            <h1 class="text-3xl font-bold">{{ $bookShelf->title }}</h1>
            
            <div class="mt-4 text-gray-700">
                <strong>Organisator:</strong> 
                <a href="{{ route('organizers.organizer', $bookShelf->organizer->slug) }}" class="text-blue-600 hover:text-blue-800">
                    {{ $bookShelf->organizer->name }}
                </a>
            </div>

            @if($bookShelf->description)
                <div class="mt-4">
                    <p>{{ $bookShelf->description }}</p>
                </div>
            @endif

            <div class="mt-4">
                <strong>Thema's:</strong> 
                @foreach($bookShelf->themes as $theme)
                    <span class="inline-block px-3 py-1 mr-2 text-sm rounded-full" style="background-color: {{ $theme->color }}20; color: {{ $theme->color }}">
                        {{ $theme->name }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>

    <div class="px-3 xl:px-5 mb-40">
        <div class="max-w-6xl mx-auto mt-10">
            <h2 class="text-2xl font-bold mb-6">Boeken ({{ $bookShelf->books->count() }})</h2>

            @foreach($bookShelf->books as $book)
                <div class="mb-6 p-6 border border-gray-300 rounded-lg flex">
                    @if($book->cover_image)
                        <div class="mr-6 flex-shrink-0">
                            <img src="{{ $book->cover_image }}" alt="{{ $book->title }}" class="w-32 h-auto rounded">
                        </div>
                    @endif
                    
                    <div class="flex-1">
                        <h3 class="text-xl font-bold">{{ $book->title }}</h3>
                        
                        @if($book->author)
                            <div class="mt-1 text-gray-600">
                                <strong>Auteur:</strong> {{ $book->author }}
                            </div>
                        @endif
                        
                        @if($book->year)
                            <div class="mt-1 text-gray-600">
                                <strong>Jaar:</strong> {{ $book->year }}
                            </div>
                        @endif
                        
                        @if($book->pivot->description)
                            <div class="mt-3 p-4 bg-yellow-50 border-l-4 border-yellow-400">
                                <strong class="text-yellow-800">Waarom dit boek?</strong>
                                <p class="mt-2 text-gray-700">{{ $book->pivot->description }}</p>
                            </div>
                        @endif
                        
                        @if($book->description)
                            <div class="mt-3">
                                <strong>Beschrijving:</strong>
                                <p class="text-gray-700">{{ Str::limit($book->description, 300) }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach

            @if($bookShelf->books->isEmpty())
                <p class="text-gray-600">Deze boekenplank bevat nog geen boeken.</p>
            @endif
        </div>
    </div>
@endsection
