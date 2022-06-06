@extends('layouts.app')
@section('content')

<div class="relative h-screen">
    <img src="{{asset('img/registration.jpg')}}" class="" alt="">
    <div class="absolute top-1/4 left-1/2 transform -translate-x-1/2 -translate-y-1/4">
    
        <div class="">
            <div class="mt-10 bg-white shadow-lg rounded-lg">
                <div class=" bg-indigo-400 py-1 rounded-t-lg">
                    <h1 class="text-2xl text-white text-center font-medium ">Mis turnos</h1>
                </div>
                <div class="p-5">
    
                    <p class="mb-3 font-medium text-indigo-600 text-lg">Bienvenido al sistema de gestion de turnos!</p>
                
                    @if(isset($bookings[0]))
                
                        <p class="text-lg text-indigo-600">Turnos confirmados</p>
                        <table class="mt-3 border">
                            <thead class="bg-gray-300 ">
                                <tr>
                                    <th class="py-2 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Dia</th>
                                    <th class="py-2 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Hora</th>
                                    <th class="py-2 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Servicio</th>
                                    <th class="py-2 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Precio</th>
                                    <th class="py-2 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">N° Personas</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $booking->date->format('d/m/y') }}</td>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $booking->time->format('H:i') }}</td>
                                        
                                        @if(isset($booking->services[0]))
                                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $booking->services[0]->title }}
                                            </td>
                                            <td class="py-4 px-6 text-center text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                ${{ $booking->services[0]->price }}
                                            </td>
                                            <td class="py-4 px-6 text-center text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $booking->services[0]->pivot->quantity }}
                                            </td>
                                            
                                        @else
                                            <td class="text-red-600 font-medium">El servicio ha sido eliminado.</td>
                                            <td class="text-red-600 text-center font-medium">-</td>
                                            <td class="text-red-600 text-center font-medium">-</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                
                        @else
                        <p class="text-gray-500 my-6">No contás con ninguna reserva confirmada por el momento.</p>
                    @endif
    
                        <x-app-link class="mt-5" :href="route('bookings.create')">
                            Sacar nuevo turno
                        </x-app-link>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection