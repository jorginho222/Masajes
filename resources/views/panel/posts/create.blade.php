@extends('layouts.app')
@section('content')
<div class="container mx-auto">

    <div class="m-5 flex justify-center">
        <div class='w-full  px-10 py-8 bg-white rounded-lg shadow-xl'>
            <div class=' mx-auto space-y-6'>
                <form 
                    id="postForm"
                    method="POST" 
                    action="{{ route('posts.store') }} "
                    enctype="multipart/form-data">
    
                    <h2 class="text-2xl text-center">Nueva publicación</h2>
                    {{-- <p class="my-2 opacity-70">Rellená todos los datos. Luego, confirmá tu reserva.</p> --}}
                    <hr class="my-6">
                    <div class="mb-6">
                        <ul id="showErrors"></ul>
                    </div>
                    
                    @csrf
                    <label for="title" class="uppercase text-sm font-bold opacity-70">Titulo</label>
                    <input id="title" type="text" name="title" class="title p-2 mt-2 mb-4 w-full bg-slate-200 rounded" value="{{ old('title') }}">
    
                    <label for="description" class="uppercase text-sm font-bold opacity-70" for="">Descripción</label>
                    <input id="description" type="text" name="description" class="description p-2 mt-2 mb-4 w-full bg-slate-200 rounded" placeholder="Una breve descripcion que aparecerá en la seccion del blog de la pagina. Puede ser la introduccion del contenido" value="{{ old('description') }}">
    
                    <label for="content" class="uppercase text-sm font-bold opacity-70">Contenido</label>
                    <textarea id="content" name="content" id="" class="content p-2 mt-2 mb-4 w-full bg-slate-200 rounded" cols="30" rows="10" value="{{ old('content') }}"></textarea>

                    <label for="image" class="uppercase text-sm font-bold opacity-70">Imagen</label>
                    <input id="image" type="file" accept="image/*" name="image" class="p-2 mt-2 mb-4 w-full bg-slate-200 rounded">
                   
                    <label class="uppercase text-sm font-bold opacity-70">Estado</label>
                    <div class="mt-1">
                        <input type="radio" id="draft" name="published" value="0" checked class="published">
                        <label for="draft">Borrador</label>
                        <input type="radio" id="publication" name="published" value="1" class="published">
                        <label for="publication">Publicado</label>
                    </div>

                    <x-app-button class="initValidation">
                        Crear publicacion
                    </x-app-button>    
                </form>
            </div>
        </div>      
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).on('click', '.initValidation', function (e) {
        e.preventDefault();
        var data = {
            'title': $('.title').val(),
            'description': $('.description').val(),
            'content': $('.content').val(),
            'published': $('.published').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('posts.validation') }}",
            data: data,
            dataType: "json",
            success: function (response) {
                console.log(response)
                if (response.status == 400) {
                    $('#showErrors').html("")
                    $.each(response.errors, function (key, error) { 
                        $('#showErrors').append('<li class="text-red-700 font-medium list-none">'+ error +'</li>')
                    });
                }
                if(response.status == 200) {
                    $('#showErrors').html("")
                    $('#postForm').submit()
                }
            }
        });        
    });
</script>
@endsection