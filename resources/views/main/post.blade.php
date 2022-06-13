@extends('layouts.app')
@section('content')

<div class="container mx-auto pb-6">
    <div class="grid grid-cols-3 gap-12">

        <div class="col-span-2 ">
    
            <h1 class="mt-10 text-4xl font-medium text-indigo-500">{{ $post->title }}</h1>
            
            @include('components.about-post')
    
            <div class="mt-6">
                <img src="{{ asset($post->image->path) }}" width="1000" alt="">
            </div>
            <div class="mt-6">
                <p class="">{{ $post->content }}</p>
            </div>
    
            <div class="mt-10">
                <p class="text-lg">{{ $post->quantity }} {{ $post->quantity == 1  ? 'comentario' : 'comentarios'}}</p>
            </div>
            
            <div class="users_comments mt-6">
    
                @isset($comments[0])
                    
                    @foreach ($comments as $comment)
                        <div class="flex mt-6">
                            <div>
                                <img src="{{ asset($comment->user->profile_image ) }}" class="rounded-full" width="40" alt="imagen usuario">
                            </div>
    
                            <div class="ml-4">
                                <div>
                                    <p class="font-medium">{{ $comment->user->name }} <span class="font-normal">{{ $comment->created_at->diffForHumans() }}</span></p>
                                </div>
                                <div class="mt-1">
                                    {{ $comment->content }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
    
            </div>
    
            <div class="mt-6">
                <form 
                method="POST" 
                action="{{ route('comments.store', ['post' => $post->id]) }}"
                >
                    @csrf
                    
                    <ul id="saveform_errList"></ul>
    
                    <div id="success_message"></div>
                    
                    <input name="post_id" class="post_id" value="{{$post->id}}" type="hidden">
                    <textarea name="content" id="" class="content p-2 mt-2 w-full bg-slate-200 rounded" cols="1" rows="2" value="{{ old('content') }}" placeholder="Añade un comentario"></textarea>
                    <input type="submit" class="add_comment my-3 py-2 px-6 bg-orange-400 text-white font-medium rounded {{ auth()->user() ? 'hover:bg-indigo-500 cursor-pointer ease-in-out duration-300' : '' }}" {{ auth()->user() ? '' : 'disabled' }} value="{{ auth()->user() ? 'Comentar' : 'Inicia sesion para comentar'}}">
                </form>
            </div>
        </div>
        <div>
            <h1 class="mt-20 text-center text-3xl text-indigo-500 font-medium tracking-wider">Más publicaciones</h1>
            <div class="mt-6 flex flex-col">
                @foreach ($somePosts as $post)
                    <div class="max-w-lg overflow-hidden">
                        <div class="bg-gray-200">
                    
                            <div class="mt-4 px-6 py-4 border-dotted border-2 border-gray-300">
                                <div class="font-bold text-xl text-indigo-700">
                                    {{ $post->title }}
                                </div>
                                <div class="mt-2 border-b border-gray-300"></div>
                                <div class="mt-2 text-gray-700 text-base ">
                                    {{ $post->description }}                                        
                                </div>
                                <div class="hover:cursor-pointer mt-3" >
                                    <a href="{{ route('post', ['post' => $post->id]) }}" class="text-orange-400 text-lg">Leer mas...</a>
                                </div>
                                
                                @include('components.about-post')
                                
                            </div> 
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    $(document).ready(function () {

        $(document).on('click', '.add_comment', function (e) {
            e.preventDefault();
            var data = {
                'content': $('.content').val(),
                'post_id': $('.post_id').val(),
            }
            // console.log(data);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "{{ route('comments.store', ['post' => $post->id]) }}",
                data: data,
                dataType: "json",
                success: function (response) {
                    if(response.status == 400)
                    {
                        $('#saveform_errList').html(""); // Esta vacio el elemento con ese id al momento de cargar
                        $('#saveform_errList').addClass('text-red-500 font-medium');  // Luego se añaden las clases 

                        $.each(response.errors, function (key, error) { 
                             $('#saveform_errList').append('<li>' + error + '<li>')
                        });
                    }
                    else
                    {
                        $('#saveform_errList').html(""); // Esta vacio el elemento con ese id al momento de cargar
                        $('#success_message').addClass('bg-green-500 text-white font-medium px-4 py-2 rounded-lg w-72')
                        $('.content').val('')
                        $('#success_message').text(response.message)
                    }
                }
            });
        });
    });
</script>
@endsection