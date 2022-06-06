@extends('layouts.app')
@section('content')
<div class="container mx-auto pb-6">

    <div class="mt-6">
        <h1 class="text-3xl text-indigo-700 font-medium tracking-wider">{{ $course->title }}</h1>
    </div>

    <img class=" mt-6 rounded-lg" width="800" src="{{ asset($course->image->path) }}" alt="Imagen curso">

    <p class="mt-3 text-gray-700 text-base">
        {{ $course->description }}
    </p>

    <p class="mt-6">
        El curso de dicta los dias <span class="font-medium text-indigo-700">{{ $course->spanish_day }}</span> de <span class="font-medium text-indigo-700">{{ $course->init_time->format('H:i') }} a {{ $course->finish_time->format('H:i') }} hs. </span>
    </p>

    <p>
        El valor de la cuota es de <span class="font-medium text-indigo-700">${{ $course->fee }}</span>, y la matricula sale <span class="font-medium text-indigo-700">${{ $course->enrollment }}</span>
    </p>

    <x-app-link :href="route('start.enrollment', ['course' => $course->id])" class="mt-6 bg-indigo-600">
        Inscribirse
    </x-app-link>

</div>

@endsection