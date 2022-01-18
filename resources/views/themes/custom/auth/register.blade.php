@extends('theme::layouts.app')

@section('content')

    <div class="flex flex-col justify-center pb-10 sm:pb-20 sm:px-6 lg:px-8">
        <div class="flex flex-col justify-center py-10 sm:py-20 sm:px-6 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900 lg:text-5xl">
                    {{ __("Register") }}
                </h2>
                <p class="mt-4 text-sm leading-5 text-center text-gray-600 max-w">
                    {{ __("general.or_you_can_here") }}
                    <a href="{{ route('login') }}" class="font-medium transition duration-150 ease-in-out text-[color:var(--wkid-blue)] focus:outline-none hover:underline hover:text-[color:var(--wkid-blue-dark)]">
                        {{ __("Log In") }}
                    </a>
                </p>
            </div>

        <div class="mt-8 mx-5 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 bg-white border shadow border-gray-50 sm:rounded-lg sm:px-10">
                <form role="form" method="POST" action="@if(setting('billing.card_upfront')){{ route('wave.register-subscribe') }}@else{{ route('register') }}@endif">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                            {{ __("Name") }}
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="name" type="text" name="name" required class="w-full form-input" value="{{ old('name') }}" @if(!setting('billing.card_upfront')){{ 'autofocus' }}@endif>
                        </div>
                        @if ($errors->has('name'))
                            <div class="mt-1 text-red-500">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>

                    @if(setting('auth.username_in_registration') && setting('auth.username_in_registration') == 'yes')
                        <div class="mt-6">
                            <label for="username" class="block text-sm font-medium leading-5 text-gray-700">
                                {{ __('auth.username') }}
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="username" type="text" name="username" value="{{ old('username') }}" required class="w-full form-input">
                            </div>
                            @if ($errors->has('username'))
                                <div class="mt-1 text-red-500">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="mt-6">
                        <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                            {{ __("Email Address") }}
                        </label>
                        <div class="mt-1 rounded-md shadow-sm">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="w-full form-input">
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
                                {{ __("Register") }}
                            </button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
