@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 flex">
        <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("acties.back_to_home") }}
        </a>
    </div>

    <div class="max-w-6xl mx-auto mt-6 mb-40 px-5 lg:px-0">
        <article id="page-{{ $page->id }}" class="max-w-6xl mx-auto prose prose-xl lg:px-0">

            <meta property="name" content="{{ $page->title }}">
            <meta property="author" typeof="Person" content="admin">
            <meta property="dateModified" content="{{ Carbon\Carbon::parse($page->updated_at)->toIso8601String() }}">
            <meta class="uk-margin-remove-adjacent" property="datePublished" content="{{ Carbon\Carbon::parse($page->created_at)->toIso8601String() }}">

            <h2>{{ $page->title }}</h2>

            @if(!is_null($page->image))
                <img width="1200" height="640" src="{{ $page->image() }}" alt="{{ $page->title }}" srcset="{{ $page->image() }}">
            @endif

            {!! filterScripts($page->body) !!}

        </article>
    </div>

@endsection
