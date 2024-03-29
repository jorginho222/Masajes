@extends('layouts.app')
@section('content') 

<x-auth-card>
    <div class="flex justify-center align-content-center my-2">
        <img src="{{ asset('img/logo_indigo.png') }}" width="70" alt="logo">
    </div>

    <a class="my-4" href="{{ route('login.facebook') }}"> 
        <div class="my-4 py-2 bg-blue-500 text-white font-medium text-center rounded-md">
            Ingresar con Facebook
        </div>
    </a>
    <a class="my-4" href="{{ route('login.google') }}"> 
        <div class="my-4 py-2 bg-red-500 text-white font-medium text-center rounded-md">
            Ingresar con Google
        </div>
    </a>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-label for="name" :value="__('Name')" />

            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-label for="email" :value="__('Email')" />

            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-label for="password" :value="__('Password')" />

            <x-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-button class="ml-4">
                {{ __('Register') }}
            </x-button>
        </div>
    </form>
</x-auth-card>

@endsection