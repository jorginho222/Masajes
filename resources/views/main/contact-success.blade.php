@extends('layouts.app')
@section('content')

<div class="container mx-auto pb-6">
    <div class="flex justify-center">

        <div class="mt-10 px-2 bg-slate-200 max-w-5xl py-4 rounded-lg">
            <h1 class="text-gray-700 text-2xl text-center ">&#9989; El mensaje ha sido enviado correctamente. Nos pondremos en contacto a la brevedad.</h1>
    
            <div class="mt-6 flex items-center justify-center">
                <x-app-link :href="route('welcome')">
                    Volver a inicio
                </x-app-link>
            </div>
            
        </div>
    </div>
</div>

@endsection