@extends('layouts.app')
@section('content')

<div class="container mx-auto pb-6">
    <h1 class="text-4xl font-medium text-center text-indigo-600 mt-10 mb-6">Blog</h1>

    <div class="my-10 grid grid-cols-3 gap-6">
        @foreach ($posts as $post)
    
        @include('components.cards.post-card')
        
        @endforeach
    </div>
</div>


@endsection
