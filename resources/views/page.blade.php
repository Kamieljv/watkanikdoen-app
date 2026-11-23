@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto mt-10 px-5 flex">
        <a href="{{ route('home') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            @svg('custom-arrow-left', 'w-4 h-4 mr-2')
            {{ __("acties.back_to_home") }}
        </a>
    </div>

    <div class="max-w-6xl mx-auto mt-6 mb-40 px-5">
        <article id="page-{{ $page->id }}" class="max-w-6xl mx-auto prose prose-xl">

            <meta property="name" content="{{ $page->title }}">
            <meta property="author" typeof="Person" content="admin">
            <meta property="dateModified" content="{{ Carbon\Carbon::parse($page->updated_at)->toIso8601String() }}">
            <meta class="uk-margin-remove-adjacent" property="datePublished"
                content="{{ Carbon\Carbon::parse($page->created_at)->toIso8601String() }}">

            <h2>{{ $page->title }}</h2>

            @if(!is_null($page->image))
                <img width="1200" height="640" src="{{ $page->image() }}" alt="{{ $page->title }}"
                    srcset="{{ $page->image() }}">
            @endif

            <div class="html-output">
                @if ($page->body !== NULL)
                    {!! Purify::clean($page->body) !!}
                @endif
            </div>
        </article>

        @if($page->slug === 'contact')
            <div id="app">
                <message-form type="contact" :routes="{{ json_encode(['store' => route('contact.store')]) }}"
                    h-captcha-key="{{ env('H_CAPTCHA_KEY') }}" require-contact-details />
            </div>
        @endif
    </div>

@endsection