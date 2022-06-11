@extends('layouts.app')
@section('content')
<div class="bg-orange-200">
    
    <div class="container mx-auto pb-6">
        <div class="mt-10 grid grid-cols-2 gap-10">

            @foreach ($courses as $course)
                <div class="mb-6 overflow-hidden">
                    @if(isset($course->image->path))
                    <img class="w-full rounded-lg" src="{{ asset($course->image->path) ? asset($course->image->path) : '' }}" alt="Imagen servicio">
                    @endif
                    <div class="mt-4">
                        <div class="px-6 py-3 bg-white rounded-lg border-gray-300 border-2 border-dotted">
                            <div class="font-bold text-xl text-center text-indigo-800">{{ $course->title }}</div> 
                            <div class="my-4 border-b border-gray-300"></div>
                            <p class="mt-2 text-gray-700 text-base">
                                {{ $course->description }}
                            </p>
                            <div class="my-4 border-b border-gray-300"></div>

                            <p class="mt-2 text-indigo-400 font-bold">Duración: <span class=" text-black font-normal">{{ $course->duration }} meses</span></p>
                            <p class="mt-2 text-indigo-400 font-bold">Fecha de inicio: <span class="text-black font-normal">{{ $course->init_date->format('d/m/Y') }} </span></p>
                            
                            <x-app-link :href="route('course', ['course' => $course->id])" class="mt-4 bg-indigo-600">
                                Mas información
                            </x-app-link>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

</div>


@endsection