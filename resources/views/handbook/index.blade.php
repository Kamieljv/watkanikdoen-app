@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="py-8">
        <h1 class="text-3xl font-bold mb-6">Handbook</h1>

        @if($rootPages->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($rootPages as $page)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold mb-4">
                            <a href="{{ route('handbook.page', $page->slug) }}" 
                               class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                {{ $page->title }}
                            </a>
                        </h2>
                        
                        @if($page->children->count() > 0)
                            <ul class="list-disc list-inside space-y-2 mb-4">
                                @foreach($page->children as $child)
                                    <li>
                                        <a href="{{ route('handbook.page', $child->slug) }}"
                                           class="text-gray-600 hover:text-gray-800 dark:text-gray-300 dark:hover:text-gray-100">
                                            {{ $child->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        @if($page->tags->count() > 0)
                            <div class="flex flex-wrap gap-2 mt-4">
                                @foreach($page->tags as $tag)
                                    <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded-full text-sm">
                                        #{{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-600 dark:text-gray-400">No handbook pages found.</p>
            </div>
        @endif
    </div>
</div>
@endsection
