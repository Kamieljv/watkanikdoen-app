@extends('layouts.app')

@section('content')
    <div class="px-3 xl:px-5">
        <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 flex">
            <a href="{{ route('books.index') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
                @svg('custom-arrow-left', 'w-4 h-4 mr-2')
                Terug naar boeken
            </a>
        </div>

        <div class="max-w-6xl mx-auto mt-6">
            <h1 class="text-3xl font-bold">{{ __('books.bookshelves_title') }}</h1>
            <p class="mt-4">
                {{ __('books.bookshelves_subtitle') }}
            </p>
        </div>
    </div>

    <div id="app" class="px-3 xl:px-5 mb-40">
        <div class="max-w-6xl mx-auto mt-10">
            <book-shelves :shelves="{{ $bookShelves }}" />

            @if($bookShelves->isEmpty())
                <p class="text-gray-600">Er zijn nog geen boekenplanken beschikbaar.</p>
            @endif
        </div>
    </div>
@endsection