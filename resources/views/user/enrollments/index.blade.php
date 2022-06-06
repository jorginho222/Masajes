@extends('layouts.app')
@section('content')

<div class="relative h-screen">
    <img src="{{asset('img/registration.jpg')}}" class="" alt="">
    <div class="absolute top-1/4 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
    
        <div class="">
            <div class="mt-10 bg-white shadow-lg rounded-lg">
                <div class=" bg-indigo-400 py-1 rounded-t-lg">
                    <h1 class="text-2xl text-white text-center font-medium ">Mis cursos</h1>
                </div>
                <div class="p-5">
    
                    <p class="mb-3 font-medium text-indigo-600 text-lg">Aqui se muestran los cursos a los que te encontras inscripto!</p>
                
                    @if(isset($courses[0]))
                
                        {{-- <p class="text-lg font-medium text-indigo-600">Turnos confirmados</p> --}}
                        <table class="mt-3 border">
                            <thead class="bg-gray-300 ">
                                <tr>
                                    <th class="py-1 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Curso</th>
                                    <th class="py-1 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Dias</th>
                                    <th class="py-1 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Horario</th>
                                    <th class="py-1 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Fecha de inicio</th>
                                    <th class="py-1 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Duracion</th>
                                    <th class="py-1 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Cuota Mensual</th>
                                </tr>
                            </thead>
                        
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $course->title }}</td>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $course->spanish_day }}</td>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $course->init_time->format('H:i') }} a {{ $course->finish_time->format('H:i') }} hs.</td>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $course->init_date->format('d/m/Y') }}</td>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $course->duration }} meses</td>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">${{ $course->fee }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                
                        @else
                        <p class="text-gray-500 my-6">No estás anotado/a en ningun curso por el momento.</p>
                    @endif
    
                    <x-app-link class="mt-6" :href="route('courses')">
                        Ver mas cursos
                    </x-app-link>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection