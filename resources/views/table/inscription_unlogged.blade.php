@extends('layouts.master')

@section('title', $table->nom)

@php
    $isSansTable = $table->sans_table == 1;
@endphp
@section('content')

    <div class="d-flex ">
                <!-- Session Status -->
{{--                <x-auth-session-status class="mb-4" :status="session('status')" />--}}

                <form method="POST" action="{{ route('events.one.creneau.table.inscriptionLogin', ['evenement' => $evenement, 'creneau' => $creneau, "table" => $table]) }}">
                    @csrf
                    <div class="card w-200 text-center p-4 me-2  ">
                        <div class="card-title">
                            Se connecter
                        </div>
                    <!-- Email Address -->
                        <div class="card-body p-2">
                            <div class="row mb-3 me-2">
                                <label class="label-text col-sm col-form-label" for="email">{{__('Email')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" name="email" value="{{old('email')}}" required autofocus autocomplete="email" class="form-control">
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                    <!-- Password -->
                            @if(config('app.env') !=  'local')
                                <div class="row mb-3 me-2">
                                    <x-input-label for="password" :value="__('Password')" />

                                            <x-text-input id="password" class="block mt-1 w-full"
                                                          type="password"
                                                          name="password"

                                                          required
                                                          autocomplete="current-password" />


                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            @endif



                            <!-- Remember Me -->

                            <div class="row mb-3 me-2">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                </label>
                            </div>


                            <div class="form-group row align-items-end">
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
                        </div>
                    </div>
                </form>


                <form method="POST" action="{{ route('events.one.creneau.table.inscriptionRegister', ['evenement' => $evenement, 'creneau' => $creneau, "table" => $table]) }}">
                    @csrf
                    <div class="card w-200 text-center p-4 me-2  ">

                        <!-- Name -->
                        <div class="card-body p-2">
                            <div class="row mb-3 me-2">
                                <x-input-label for="name" :value="__('Pseudo')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                <label class="label-text col-sm col-form-label" for="name">{{__('Pseudo')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" value="{{old('name')}}" required autofocus autocomplete="username" class="form-control">
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>


                            <!-- Email Address -->

                            <div class="row mb-3 me-2">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>


                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Password')" />

                                <x-text-input id="password" class="block mt-1 w-full"
                                              type="password"
                                              name="password"
                                              required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                              type="password"
                                              name="password_confirmation" required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="form-group row align-items-end">
                                <div  class="col">
                                    <x-secondary-button class="btn ms-4" type="button" onclick="window.location='{{ url()->previous() }}'">
                                        Retour
                                    </x-secondary-button>
                                </div>
                                <div  class="col">
                                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                                        {{ __('Already registered?') }}
                                    </a>
                                </div>
                                <div  class="col">
                                    <x-primary-button class="ms-4">
                                        {{ __('Register') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>



                <form method="POST" action="{{ route('events.one.creneau.table.inscriptionProfil', ['evenement' => $evenement, 'creneau' => $creneau, "table" => $table]) }}">
                @csrf
                    <div class="card w-200 text-center p-4 me-2  ">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Pseudo')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email (Optionnel)')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <x-primary-button class="ms-4">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>

    </div>




@endsection
