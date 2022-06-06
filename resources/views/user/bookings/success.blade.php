@extends('layouts.app')
@section('content')

<div class="container mx-auto">
    <div class="flex justify-center">

        <div class="mt-10 bg-slate-200 max-w-5xl py-4 rounded-lg">
            <h1 class="text-gray-700 text-2xl text-center ">&#9989; La reserva se ha realizado correctamente! Te enviamos un mail con los datos del turno y comprobante de pago.</h1>
    
            <div class="mt-6 flex items-center justify-center">
                <x-app-link :href="route('bookings.index')">
                    Ver mis turnos
                </x-app-link>
            </div>
            <div class="mt-6 flex items-center justify-center">
                <x-app-link :href="route('bookings.create')">
                    Sacar nuevo turno
                </x-app-link>
            </div>
        </div>
    </div>
</div>
@endsection