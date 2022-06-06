@extends('layouts.app')
@section('content')

<div class="container mx-auto pb-6">
    <div class="w-full max-w-5xl">

        <h1 class="mt-10 text-4xl font-medium text-indigo-500">{{ $post->title }}</h1>
        
        <div class="mt-6 flex align-content-around">
            <img 
            src="{{ asset($post->user->profile_image  ) }}" 
            alt="Avatar"
            class="rounded-full"
            width="40"
            height="40"
            >
            <div class="mt-1 ml-2">
                <p class="text-md font-medium">{{ $post->user->name }} · {{$post->created_at->format('d/m/y')}} · 0 comentarios</p>
            </div>
        </div>

        @if(isset($post->image->path))
            <div class="mt-6">
                <img src="{{ asset($post->image->path) }}" width="1000" alt="">
            </div>
        @endif
        <div class="mt-6">
    
            <p class="">{{ $post->content }}</p>
        </div>
    </div>
</div>

@endsection