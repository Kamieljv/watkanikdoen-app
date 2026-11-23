@extends('layouts.app')

@section('content')
    <div class="px-3 xl:px-5">
        <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 flex">
            <a href="{{ route('bookshelves.index') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
                @svg('custom-arrow-left', 'w-4 h-4 mr-2')
                Terug naar boekenplanken
            </a>
        </div>
    </div>

    <div id="app" class="px-3 xl:px-5 mb-40">
        <div class="max-w-6xl mx-auto mt-10">
            <book-shelf :shelf="{{ $bookShelf }}" />

            @if($bookShelf->books->isEmpty())
                <p class="text-gray-600">Deze boekenplank bevat nog geen boeken.</p>
            @endif
        </div>
    </div>
@endsection
