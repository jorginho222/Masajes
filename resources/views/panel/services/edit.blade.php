@extends('layouts.app')

@section('content')

<div class="container mx-auto pb-6">

    <div class="mt-6 flex justify-center">
        <div class='w-full max-w-xl px-10 py-8 bg-white rounded-lg shadow-xl'>
            <div class='max-w-md mx-auto space-y-6'>
                <form
                    id="serviceForm" 
                    method="POST" 
                    action="{{ route('services.update', ['service' => $service->id]) }}"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <h2 class="text-2xl text-center">Editar servicio</h2>
                    {{-- <p class="my-2 opacity-70">Rellená todos los datos. Luego, confirmá tu reserva.</p> --}}
                    <hr class="my-6">

                    <div class="mb-6">
                        <ul id="showErrors"></ul>
                    </div>
            
                    <label for="title" class="uppercase text-sm font-bold opacity-70">Nombre del servicio</label>
                    <input type="text" name="title" class="title p-2 mt-2 mb-4 w-full bg-slate-200 rounded" value="{{ $service->title }}">

                    <label for="description" class="uppercase text-sm font-bold opacity-70" for="">Descripción</label>
                    <input type="text" name="description" class="description p-2 mt-2 mb-4 w-full bg-slate-200 rounded" value="{{ $service->description }}">

                    <label for="price" class="uppercase text-sm font-bold opacity-70">Precio</label>
                    <input type="number" name="price" class="price p-2 mt-2 mb-4 w-full bg-slate-200 rounded" value="{{ $service->price }}">

                    <div class="flex">
                        <label class="block uppercase text-sm font-bold opacity-70">Cupo</label>
    
                        <p class="ml-2 text-sm">(maximo de personas que pueden reservar a la misma hora)</p>
                    </div>
                    <div class="flex">
                        <input type="number" min="1" name="capacity" class="capacity block p-2 mt-2 mb-4 w-20 bg-slate-200 rounded" value="{{ $service->capacity }}">
                        <div class="mt-4 ml-2 text-md opacity-70">(personas)</div>
                    </div>
                    
                    <label for="image" class="uppercase text-sm font-bold opacity-70">Imagen</label>
                    
                    <div class="mt-2 mb-4 w-full">
                        <img src="{{ asset($service->image->path) }}" alt="">
                    </div>
                    
                    <input type="file" accept="image/*" name="image" class="p-2 mt-2 mb-4 w-full bg-slate-200 rounded" value="{{ $service->image }}">
                
                    <x-app-button class="initValidation">
                        Editar servicio
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
            'price': $('.price').val(),
            'capacity': $('.capacity').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('services.validation') }}",
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
                    $('#serviceForm').submit()
                }
            }
        });        
    });
</script>
@endsection