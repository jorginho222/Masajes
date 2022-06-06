@extends('layouts.app')
@section('content')

<div class="container mx-auto pb-6">

    <div class="mt-6 bg-indigo-400 pt-1 pb-2">
        <h2 class="text-3xl text-center text-gray-50">Gestionar blog</h2>
    </div>
    <div class="mt-6">
        <x-panel-link :href="route('posts.create')">Agregar publicacion +</x-panel-link>
    </div>

    @if(isset($userPosts[0]))

        <div class="mt-6 grid grid-cols-3 gap-6">
            
            @foreach ($userPosts as $userPost)
                
            <div class="max-w-lg rounded-lg  overflow-hidden">
                @if(isset($userPost->image->path))
                <img class="w-full" src="{{ asset($userPost->image->path) }}" width="600" alt="Sunset in the mountains">
                @endif

                <div class="bg-gray-200">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl">(ID: {{ $userPost->id }}) {{ $userPost->title }}</div>
                        <div class="my-2 border-b border-gray-300"></div>
                        <p class="">Escrito el <span class="text-orange-400 font-medium">{{$userPost->created_at->format('d/m/y')}}</span> a las <span class="font-medium text-orange-400">{{$userPost->created_at->format('H:i')}}</span></p>
                        @if ($userPost->created_at != $userPost->updated_at)
                            <p class="">Editado el <span class="text-orange-400 font-medium">{{$userPost->updated_at->format('d/m/y')}}</span> a las <span class="text-orange-400 font-medium">{{$userPost->updated_at->format('H:i')}}</span></p>       
                        @endif

                        <p class="mt-2 text-gray-700 text-base">
                            {{ $userPost->description }}
                        </p>

                        <div class="mt-2 font-bold text-indigo-700">Estado: {{ $userPost->status }}</div>

                        <div class="mt-4">
                            <x-edit-link :href="route('posts.edit', ['post' => $userPost->id])" class="mr-2"> Editar </x-edit-link>
                            <form id="{{ $userPost->id }}" method="POST" class="inline-block" action="{{ route('posts.destroy', ['post' => $userPost->id]) }}">
                                @csrf
                                @method('DELETE')
                                <x-delete-button class="openConfirmModal" value="{{ $userPost->id }}">Eliminar</x-delete-button>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="flex justify-center bg-indigo-400 hover:cursor-pointer " >
                    <a href="{{ route('posts.show', ['post' => $userPost->id]) }}" class="text-white text-lg px-4 py-2">Ver publicación</a>
                </div>
            </div>
            @endforeach

        </div>

        @else
        <p class="mt-6">No tenés ninguna publicacion por el momento.</p>

    @endif

</div>

{{-- Delete Modal --}}

<div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="confirmModal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg @click="toggleModal" class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                              Eliminar Servicio
                            </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                La publicacion se borrará permanentemente de la base de datos ¿Confirma eliminación?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="deleteItem w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Confirmar
                </button>
                <button type="button" class="closeConfirmModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.openConfirmModal').on('click', function(e){
                e.preventDefault();
                var id = $(this).val()
                
                $('#confirmModal').removeClass('invisible');
                
                $('.closeConfirmModal').on('click', function(e){
                    $('#confirmModal').addClass('invisible');
                });

                $('.deleteItem').on('click', function(e){
                    $('#'+ id +'').submit();
                });
            });
        });
    </script>
@endsection