@extends('layouts.app')
@section('content')

<div class="container mx-auto">
    
    <h1 class="mt-10 text-2xl text-center ">La reserva se realizará al momento de acreditarse el pago. Te enviamos un mail con más detalles.</h1>
        <div class="mt-10 flex items-center justify-center">
            <x-app-link :href="route('welcome')">
                Volver a inicio
            </x-app-link>
        </div>
        <div class="mt-6 flex items-center justify-center">
            <x-app-link :href="route('bookings.create')">
                Sacar nuevo turno
            </x-app-link>
        </div>
</div>
@endsection