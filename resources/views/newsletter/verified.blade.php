@extends('layouts.app')

@php
    foreach(array('info', 'warning', 'success', 'error') as $messType) {
        if (session()->has($messType)) { $type = $messType; $message = session($messType); }
    }
    if (!isset($type) || !isset($message)) {
        return redirect('/');
    }
@endphp

@section('content')
    <div class="flex flex-col justify-center py-10 sm:py-20 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-lg">
            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900">
                {{ __("newsletter.title_verification") }}
            </h2>
        </div>
        <div class="mt-8 mx-5 sm:mx-auto sm:w-full sm:max-w-lg">
            <div class="px-4 py-8 bg-white sm:px-10 sm:rounded-lg">
                <div class="flex-1 pl-3.5 ml-1 ">
                    <p class="leading-5" style="color: var(--wkid-message-{{$type}}-dark)">{{$message}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    
@endpush

