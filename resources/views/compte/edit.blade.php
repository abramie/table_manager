@extends('compte.base')

@section('title', 'Edition compte')


@section('content-compte')
    <h1>Compte</h1>



    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Compte
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="card w-200 text-center p-4 me-2 ">
                <h2 class="section-title">
                    {{ __('Change email address') }}
                </h2>
                <div class="card-body p-2">
                    @include('compte.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card w-200 text-center p-4 me-2 ">
                <h2 class="section-title">
                    {{ __('Update Password') }}
                </h2>
                    @include('compte.partials.update-password-form')
                </div>
            </div>

            <div class="card w-200 text-center p-4 me-2 ">
                <h2 class="section-title">
                    {{ __('Delete Account') }}
                </h2>
                @include('compte.partials.delete-user-form')

            </div>
        </div>
    </div>
@endsection
