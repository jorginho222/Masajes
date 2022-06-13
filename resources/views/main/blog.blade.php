@extends('layouts.app')
@section('content')

<div class="container mx-auto pb-6">
    <h1 class="text-4xl font-medium text-center text-indigo-600 mt-10 mb-6">Blog</h1>

    <div class="flex">
        <x-dropdown class="mt-10" align="left" width="48">
            <x-slot name="trigger">
                <button class="flex items-center text-orange-400 hover:text-indigo-400">
                    <div class="text-lg leading-5 text-orange-400 hover:text-indigo-400">
                        Categorías
                    </div>
                    
                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>
    
            <x-slot name="content">
                @if(isset($categories[0]))
                    <x-dropdown-link :href="route('blog')">
                                    
                        Todas
    
                    </x-dropdown-link>
                    @foreach ($categories as $category)
                        <x-dropdown-link :href="route('category.posts', ['category' => $category->id])">
                                
                            {{ $category->title }}
    
                        </x-dropdown-link>
                    @endforeach
                @endif
                
            </x-slot>
        </x-dropdown>
        <div class="ml-10 flex text-indigo-400 ">
            <a href="{{ route('blog') }}">Blog</a> 
            @if(request()->routeIs('blog')) <a href="{{ route('blog') }}" class="ml-1">> Todas las categorías</a> @endif
            @if(isset($selectedcategory)) <a href="" class="ml-1">> {{ $selectedcategory }} @endif</a>  
             
        </div>
    </div>

    <div class="my-10 grid grid-cols-3 gap-6">
        @if(isset($posts[0]))
            @foreach ($posts as $post)
        
                @include('components.cards.post-card')
            
            @endforeach
        @endif
    </div>
</div>

@endsection
