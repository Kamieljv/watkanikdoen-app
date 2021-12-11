@extends('theme::layouts.app')

@section('content')

    <div class="max-w-4xl px-5 mx-auto mt-10 lg:px-0">
        <a href="{{ route('wave.home') }}" class="flex items-center mb-6 font-mono text-sm font-bold cursor-pointer text-wave-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("acties.back_to_acties") }}
        </a>
    </div>
    <article id="post-{{ $actie->id }}" class="max-w-4xl px-5 mx-auto prose prose-xl lg:prose-2xl lg:px-0">

        <meta property="name" content="{{ $actie->title }}">
        <meta property="author" typeof="Person" content="admin">
        <meta property="dateModified" content="{{ Carbon\Carbon::parse($actie->updated_at)->toIso8601String() }}">
        <meta class="uk-margin-remove-adjacent" property="datePublished" content="{{ Carbon\Carbon::parse($actie->created_at)->toIso8601String() }}">

        <div class="max-w-4xl mx-auto mt-6">

            <h1 class="flex flex-col leading-none">
                <span>{{ $actie->title }}</span>
                <span class="mt-0 mt-10 text-base font-normal">{{ __("general.written_on") }}<time datetime="{{ Carbon\Carbon::parse($actie->created_at)->toIso8601String() }}">{{ Date::parse($actie->created_at)->format("j F Y") }}</time></span>
            </h1>
            <div>
                {{ __("acties.categories") }}
                @foreach ($actie->categories as $category)
                    <p class="relative self-start inline-block px-2 py-1 mt-4 text-xs font-medium leading-5 text-gray-400 uppercase bg-gray-100 rounded">
                        <a href="{{ route('wave.blog.category', $category->slug) }}" class="text-gray-700 hover:underline" rel="category">
                            {{ $category->name }}
                        </a>
                    </p>
                @endforeach
                </ul>
            </span>


        </div>

        <div class="relative">
            <img class="w-full h-auto rounded-lg" src="{{ $actie->image_path }}" alt="{{ $actie->title }}" srcset="{{ $actie->image_path }}">
        </div>

        <div class="max-w-4xl mx-auto">
            {!! $actie->body !!}
        </div>

    </article>

@endsection
