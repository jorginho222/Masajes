@extends('layouts.app')
@section('content')

<div class="container mx-auto">
    <div class="flex justify-center">

        <div class="mt-10 bg-slate-200 max-w-5xl py-4 rounded-lg">
            <h1 class="text-gray-700 text-2xl text-center ">&#9989; La inscripción se ha realizado correctamente! Te enviamos un mail con todos los detalles y comprobante de pago.</h1>
    
            <div class="mt-6 flex items-center justify-center">
                <x-app-link :href="route('enrollments.index')">
                    Ver mis cursos
                </x-app-link>
            </div>
        </div>
    </div>
</div>
@endsection