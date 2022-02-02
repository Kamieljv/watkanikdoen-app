@extends('layouts.app')

@section('content')

    <div class="flex flex-col justify-center pb-10 sm:pb-20 sm:px-6 lg:px-8">
        <div class="flex flex-col justify-center py-10 sm:py-20 sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-lg">
                <h3 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900 lg:text-5xl">
                    {{ __("auth.register_complete_heading") }}
                </h3>
                <p class="mt-4 text-sm leading-5 text-center text-gray-600 max-w">
                    {{ __("auth.register_complete_body") }} <strong>{{ session('email') }}</strong>.
                </p>
            </div>
        </div>
    </div>
@endsection
