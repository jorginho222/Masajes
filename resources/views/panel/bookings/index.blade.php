@extends('layouts.app')

@section('content')

<div class="container mx-auto pb-6">

    <div class="mt-6 bg-indigo-400 pt-1 pb-2">
        <h2 class="text-3xl text-center text-gray-50">Gestionar reservas</h2>
    </div>
    <div class="mt-6">
        <form class="" action="{{ route('panel.bookings.index') }}">
            <label class="block uppercase text-sm font-bold opacity-70">Consultar fecha especifica</label>
            <input type="date" name="date" class="p-2 mt-2 mb-4 bg-slate-200 rounded">

            <input type="submit" class="py-2 px-6 ml-2 bg-orange-400 text-white font-medium rounded hover:bg-indigo-500 cursor-pointer ease-in-out duration-300" value="Consultar">
        </form>
    </div>
        
    @empty($dateSelectedBookings)

        @if(isset($todayBookings[0]))
        
            <h1 class="mt-6 mb-6 text-xl">Reservas del dia de hoy ({{ now()->format('d/m/Y') }})</h1>

            <div>
                <table class="border ">
                    <thead class="bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Id</th>
                            <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Hora</th>
                            <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Nombre</th>
                            <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Servicio</th>
                            <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">N° Personas</th>
                            <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($todayBookings as $todayBooking)
                            <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $todayBooking->id }}</td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $todayBooking->time->format('H:i') }}</td>

                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex align-content-around">
                                        <img 
                                            src="{{ asset($todayBooking->user->profile_image) }}" 
                                            alt="Avatar"
                                            class="rounded-full"
                                            width="40"
                                            height="40"
                                        >
                                        <div class="mt-2 ml-2">
                                            {{ $todayBooking->user->name }}
                                        </div>
                                    </div>
                                </td>

                                @if(isset($todayBooking->services[0]))
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $todayBooking->services[0]->title }}</td>
                                    <td class="py-4 px-6 text-center text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $todayBooking->services[0]->pivot->quantity }}</td>
                                    <td class="py-4 px-6 text-center text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <x-edit-link :href="route('panel.bookings.edit', ['booking' => $todayBooking->id])" class="mr-2"> Modificar </x-edit-link>
                                    </td>

                                    @else
                                    <td class="text-red-600 font-medium">El servicio ha sido eliminado.</td>
                                    <td class="text-red-600 text-center font-medium">-</td>
                                    <td class="py-4 px-6 text-center text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <x-edit-link class="mr-2"> Imposible Modificar </x-edit-link>
                                    </td>
                                    
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @else

            <div class="mt-4 text-indigo-500 text-lg font-medium">
                No hay ninguna reserva para el dia de hoy!
            </div>  

        @endif
        
        @else

        @if(isset($dateSelectedBookings[0]))
            
            <h1 class="mt-6 mb-6 text-xl text-indigo-500">Reservas para el dia: {{ $dateSelectedBookings[0]->date->format('d/m/Y') }}</h1>
            
            <div>
                <table class="border ">
                    <thead class="bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Id</th>
                            <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Hora</th>
                            <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Nombre</th>
                            <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Servicio</th>
                            <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">N° Personas</th>
                            <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($dateSelectedBookings as $dateSelectedBooking)
                            <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $dateSelectedBooking->id }}</td>
                                <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $dateSelectedBooking->time->format('H:i') }}</td>
                
                                    
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="flex align-content-around">
                                            <img 
                                                src="{{ asset($dateSelectedBooking->user->profile_image) }}" 
                                                alt="Avatar"
                                                class="rounded-full"
                                                width="40"
                                                height="40"
                                            >
                                            <div class="mt-2 ml-2">
                                                {{ $dateSelectedBooking->user->name }}
                                            </div>
                                        </div>
                                    </td>
                
                                @if(isset($dateSelectedBooking->services[0]))    
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $dateSelectedBooking->services[0]->title }}</td>
                                    <td class="py-4 px-6 text-center text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $dateSelectedBooking->services[0]->pivot->quantity }}</td>
                                    <td class="py-4 px-6 text-center text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <x-edit-link :href="route('panel.bookings.edit', ['booking' => $dateSelectedBooking->id])" class="mr-2"> Modificar </x-edit-link>
                                    </td>
                                    
                                    @else
                                    <td class="text-red-600 font-medium">El servicio ha sido eliminado.</td>
                                    <td class="text-red-600 text-center font-medium">-</td>
                                    <td class="py-4 px-6 text-center text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <x-edit-link class="mr-2"> Imposible Modificar </x-edit-link>
                                    </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <div class="mt-10">
                <a href="{{ route('panel.bookings.index') }}" class="py-2 px-6 bg-orange-400 text-white font-medium rounded hover:bg-indigo-500 cursor-pointer ease-in-out duration-300">Volver al dia de hoy</a>
            </div>

            @else

            <div class="mt-4 text-indigo-500 text-lg font-medium">
                No hay reservas para la fecha seleccionada.
            </div> 

            <div class="mt-10">
                <a href="{{ route('panel.bookings.index') }}" class="py-2 px-6 bg-orange-400 text-white font-medium rounded hover:bg-indigo-500 cursor-pointer ease-in-out duration-300">Volver al dia de hoy</a>
            </div>

        @endif    

    @endempty
</div>

@endsection