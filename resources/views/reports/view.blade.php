@extends('layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto mt-10 px-5 lg:px-0 flex">
        <a href="{{ route('dashboard') }}" class="flex items-center text-sm font-bold cursor-pointer text-gray-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            {{ __("dashboard.back_to_dashboard") }}
        </a>
    </div>

    <div class="max-w-6xl mx-auto mt-6 mb-40 px-5 lg:px-0">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            {{-- Header --}}
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $report->title }}</h1>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ __("reports.reported_on") }}: {{ $report->created_at->format('d-m-Y H:i') }}
                        </p>
                    </div>
                    <div>
                        @php
                            $statusColorMap = [
                                'PENDING' => 'bg-blue-100 text-blue-800',
                                'APPROVED' => 'bg-green-100 text-green-800',
                                'REJECTED' => 'bg-red-100 text-red-800',
                            ];
                        @endphp
                        <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full {{ $statusColorMap[$report->status] }}">
                            {{ __("general." . strtolower($report->status)) }}
                        </span>
                    </div>
                </div>
            </div>

            {{-- Content --}}
            <div class="px-6 py-6 space-y-6">
                {{-- Image --}}
                @if($report->image_url)
                    <div>
                        <img src="{{ $report->image_url }}" alt="{{ $report->title }}" class="w-full h-64 object-cover rounded-lg">
                    </div>
                @endif

                {{-- Description --}}
                @if($report->body)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __("reports.body") }}</h3>
                        <div class="prose max-w-none text-gray-700">
                            {!! $report->body !!}
                        </div>
                    </div>
                @endif

                {{-- Organizers --}}
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __("reports.organizer") }}</h3>
                    <div class="space-y-2">
                        @foreach($organizers as $organizer)
                            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                                @if($organizer->image_url)
                                    <img src="{{ $organizer->image_url }}" alt="{{ $organizer->name }}" class="w-12 h-12 rounded-full object-cover">
                                @endif
                                <div>
                                    <p class="font-medium text-gray-900">{{ $organizer->name }}</p>
                                    @if($organizer->website)
                                        <a href="{{ $organizer->website }}" target="_blank" class="text-sm text-blue-600 hover:underline">
                                            {{ $organizer->website_short }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Date and Time --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __("reports.start_date") }}</h3>
                        <p class="text-gray-700">
                            {{ \Carbon\Carbon::parse($report->start_date)->format('d-m-Y') }}
                            @if($report->start_time)
                                {{ __("general.at") }} {{ \Carbon\Carbon::parse($report->start_time)->format('H:i') }}
                            @endif
                        </p>
                    </div>
                    @if($report->end_date)
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __("reports.end_date") }}</h3>
                            <p class="text-gray-700">
                                {{ \Carbon\Carbon::parse($report->end_date)->format('d-m-Y') }}
                                @if($report->end_time)
                                    {{ __("general.at") }} {{ \Carbon\Carbon::parse($report->end_time)->format('H:i') }}
                                @endif
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Location --}}
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __("reports.location") }}</h3>
                    <div class="flex items-start space-x-2">
                        <svg class="w-5 h-5 text-gray-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <p class="text-gray-700">{{ $report->location_human }} @if($report->location) ({{ __("general.at") }} {{ $report->location->latitude }}, {{ $report->location->longitude }}) @endif</p>
                    </div>
                </div>

                {{-- External Links --}}
                @if($report->externe_link)
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __("reports.external_links") }}</h3>
                        <div class="space-y-2">
                            @foreach(is_array($report->externe_link) ? $report->externe_link : [$report->externe_link] as $link)
                                <a href="{{ $link }}" target="_blank" class="flex items-center text-blue-600 hover:underline">
                                    {{ $link }}
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Status Message --}}
                @if($report->status === 'APPROVED' && $report->actie)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-green-800">{{ __("reports.approved_message") }}</h3>
                            </div>
                        </div>
                    </div>
                @elseif($report->status === 'PENDING')
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-center">
                            @svg('antdesign-clock-circle-o', 'w-5 h-5 text-blue-600 mt-0.5')
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">{{ __("reports.pending_message") }}</h3>
                            </div>
                        </div>
                    </div>
                @elseif($report->status === 'REJECTED')
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">{{ __("reports.rejected_message") }}</h3>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection