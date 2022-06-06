@extends('layouts.app')

@section('content')

<div class="container mx-auto pb-6">
    
    <div class="m-5 flex justify-center">
        <div class='w-full max-w-xl px-10 py-8 bg-white rounded-lg shadow-xl'>
            <div class='max-w-md mx-auto space-y-6'>
                <form 
                    method="POST" 
                    action="{{ route('profile.update') }}"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <h2 class="text-2xl text-center">Editar perfil</h2>
                    {{-- <p class="my-2 opacity-70">Rellená todos los datos. Luego, confirmá tu reserva.</p> --}}
                    <hr class="my-6">
            
                    <label for="" class="uppercase text-sm font-bold opacity-70">Nombre</label>
                    <input type="text" name="name" class="p-2 mt-2 mb-4 w-full bg-slate-200 rounded form-control" value="{{ old('name') ?? $user->name }}" autocomplete="name" autofocus>
                    
                    <label for="" class="uppercase text-sm font-bold opacity-70">Email</label>
                    <input type="text" name="email" class="p-2 mt-2 mb-4 w-full bg-slate-200 rounded form-control" value="{{ old('email') ?? $user->email }}" autocomplete="email" autofocus>

                    <label for="" class="uppercase text-sm font-bold opacity-70">Telefono</label>
                    <input type="number" name="phone" class="p-2 mt-2 mb-4 w-full bg-slate-200 rounded form-control" value="{{ old('phone') ?? $user->phone }}" autocomplete="phone" autofocus>

                    <label for="" class="uppercase text-sm font-bold opacity-70">Nueva Contraseña</label>
                    <input type="password" name="password" class="p-2 mt-2 mb-4 w-full bg-slate-200 rounded form-control" autocomplete="new-password">

                    <label for="" class="uppercase text-sm font-bold opacity-70">Confirmar nueva contraseña</label>
                    <input type="password" name="password_confirmation" class="p-2 mt-2 mb-4 w-full bg-slate-200 rounded form-control" autocomplete="new-password">

                    <label for="image" class="uppercase text-sm font-bold opacity-70">Foto de perfil</label>
                
                    <div class="mt-2 mb-4 w-full flex justify-center">
                        <img src="{{ isset($user->image->path) ? asset($user->image->path) : '' }}" class="rounded-full" width="300" alt="">
                    </div>
                    
                    <input type="file" accept="image/*" name="image" class="p-2 mt-2 mb-4 w-full bg-slate-200 rounded" value=""> 
                
                    <input type="submit" class="py-2 px-6 my-2 bg-orange-400 text-white font-medium rounded hover:bg-indigo-500 cursor-pointer ease-in-out duration-300" value="Guardar">

                </form>
            </div>
        </div>      
    </div>

</div>

@endsection