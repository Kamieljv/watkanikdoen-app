@extends('layouts.app')

@section('content')

<div class="flex flex-col justify-center py-20 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="mt-6 text-3xl font-extrabold leading-none text-center text-gray-900 lg:text-5xl">
            {{ __("auth.new_password_setup") }}
        </h2>
        <p class="mt-4 text-sm leading-5 text-center text-gray-600 max-w">
            {{ __("general.or_back_to") }}
            <a href="{{ route('login') }}" class="font-medium transition duration-150 ease-in-out text-wave-600 hover:text-wave-500 focus:outline-none focus:underline">
                {{ __('auth.login') }}
            </a>
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        @if (session('status'))
            <div class="mb-3 uk-alert-primary">
                {{ session('status') }}
            </div>
        @endif
        <div class="px-4 py-8 bg-white border shadow border-gray-50 sm:rounded-lg sm:px-10">
            <form action="{{ route('password.request') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mt-6">
                    <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                        {{ __("Email Address") }}
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="email" type="email" name="email" required class="w-full form-input">
                    </div>
                    @if ($errors->has('email'))
                    <div class="mt-1 text-red-500">
                        {{ $errors->first('email') }}
                    </div>
                    @endif
                </div>

                <div class="mt-6">
                    <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
                        {{ __("Password") }}
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="password" type="password" name="password" required class="w-full form-input">
                    </div>
                    @if ($errors->has('password'))
                    <div class="mt-1 text-red-500">
                        {{ $errors->first('password') }}
                    </div>
                    @endif
                </div>

                <div class="mt-6">
                    <label for="password_confirmation" class="block text-sm font-medium leading-5 text-gray-700">
                        {{ __("Confirm Password") }}
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                        <input id="password_confirmation" type="password" name="password_confirmation" required class="w-full form-input">
                    </div>
                    @if ($errors->has('password_confirmation'))
                    <div class="mt-1 text-red-500">
                        {{ $errors->first('password_confirmation') }}
                    </div>
                    @endif
                </div>

                <div class="flex flex-col items-center justify-center text-sm leading-5">
                    <span class="block w-full mt-5 rounded-md shadow-sm">
                        <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-wave-700 focus:shadow-outline-wave active:bg-blue-700">
                            {{ __("Reset Password") }}
                        </button>
                    </span>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
