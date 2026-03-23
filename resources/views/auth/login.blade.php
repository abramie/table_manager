
@extends('layouts.master')

@section('title', "connexion")
@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="position-relative auth-form">
        <div class="d-flex border-1 auth-form position-absolute start-50  translate-middle-x rounded">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group m-2">
                    <x-input-label class="" for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4 form-group row m-2">
                    <x-input-label for="password" :value="__('Password')" />
                    @if(config('app.env') !=  'local')
                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"

                                    required
                                  autocomplete="current-password" />
                    @endif

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4 form-group row m-2">
                    <label for="remember_me" class="col-6">
                        <span class="">{{ __('Remember me') }}</span>
                    </label>
                    <input id="remember_me" type="checkbox" class="col rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">

                </div>

                <div class="form-group row align-items-center row m-2">
                    <div  class="col">
                    <x-primary-button class="btn btn-dark btn-xs pull-left" type="button" onclick="window.location='{{ url()->previous() }}'">
                        Retour
                    </x-primary-button>
                    </div>
                    @if (Route::has('password.request'))
                        <div  class="col">
                            <a class="text-center underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                    @endif
                    <div  class="col align-self-end">
                        <x-primary-button >
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
