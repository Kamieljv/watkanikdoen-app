@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="py-8">
        <nav class="mb-6 text-sm">
            <a href="{{ route('handbook.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                Handbook
            </a>
            <span class="mx-2">/</span>
            <span class="text-gray-600 dark:text-gray-400">{{ $page->title }}</span>
        </nav>

        <article class="prose dark:prose-invert lg:prose-lg max-w-none">
            <h1 class="text-3xl font-bold mb-6">{{ $page->title }}</h1>
            
            <div class="mb-8">
                {!! $page->content !!}
            </div>

            @if($page->tags->count() > 0)
                <div class="flex flex-wrap gap-2 mb-8">
                    @foreach($page->tags as $tag)
                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded-full text-sm">
                            #{{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            @endif

            @if($page->children->count() > 0)
                <div class="border-t pt-6 mt-8">
                    <h2 class="text-xl font-semibold mb-4">Related Pages</h2>
                    <ul class="space-y-2">
                        @foreach($page->children as $child)
                            <li>
                                <a href="{{ route('handbook.page', $child->slug) }}"
                                   class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                    {{ $child->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($page->parent)
                <div class="border-t pt-6 mt-8">
                    <h2 class="text-xl font-semibold mb-4">Parent Page</h2>
                    <a href="{{ route('handbook.page', $page->parent->slug) }}"
                       class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                        {{ $page->parent->title }}
                    </a>
                </div>
            @endif
        </article>
    </div>
</div>
@endsection
