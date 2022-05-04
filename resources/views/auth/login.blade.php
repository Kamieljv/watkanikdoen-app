@extends('layouts.app')

@section('content')

    <div class="flex flex-col justify-center py-10 sm:py-20 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="mt-6 text-3xl font-extrabold leading-9 text-center text-gray-900 lg:text-5xl">
                {{ __("Log In") }}
            </h2>
            {{-- <p class="mt-4 text-sm leading-5 text-center text-gray-600 max-w">
                {{ __("general.or_you_can_here") }}
                <a href="{{ route('register') }}" class="font-medium transition duration-150 ease-in-out text-[color:var(--wkid-blue)] focus:outline-none hover:underline hover:text-[color:var(--wkid-blue-dark)]">
                    {{ __("Register") }}
                </a>
            </p> --}}
        </div>

        <div class="mt-8 mx-5 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="px-4 py-8 bg-white border shadow border-gray-50 sm:rounded-lg sm:px-10">
                <p class="mb-2 text-sm">{{ __("auth.no_account?") }}</p>
                <span class="block w-full rounded-md shadow-sm">
                    <a href="{{ route('register') }}" class="secondary w-full">
                        {{ __("auth.register") }}
                    </a>
                </span>
                <hr class="my-5">
                <form action="#" method="POST">
                    @csrf
                    <div>

                        @if(setting('auth.email_or_username') && setting('auth.email_or_username') == 'username')
                            <label for="username" class="block text-sm font-medium leading-5 text-gray-700">{{ __("auth.username") }}</label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="username" type="username" name="username" required class="w-full form-input" autofocus>
                            </div>

                            @if ($errors->has('username'))
                                <div class="mt-1 text-red-500">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                        @else
                            <label for="email" class="block text-sm font-medium leading-5 text-gray-700">{{ __("Email Address") }}</label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="email" type="email" name="email" required class="w-full form-input" autofocus>
                            </div>

                            @if ($errors->has('email'))
                                <div class="mt-1 text-red-500">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
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

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" {{ old('remember') ? ' checked' : '' }}>
                            <label for="remember" class="block ml-2 text-sm leading-5 text-gray-900">
                                {{ __("Remember me") }}
                            </label>
                        </div>

                        <div class="text-sm leading-5">
                            <a href="{{ route('password.request') }}" class="font-medium transition duration-150 ease-in-out text-[color:var(--wkid-blue)] focus:outline-none hover:underline hover:text-[color:var(--wkid-blue-dark)]">
                                {{ __("Forgot your password?") }}
                            </a>
                        </div>
                    </div>

                    <div class="mt-6">
                        <span class="block w-full rounded-md shadow-sm">
                            <button type="submit" class="primary w-full">
                                {{ __("Log In") }}
                            </button>
                        </span>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
