@extends('layouts.app')

@section('content')

<div class="container mx-auto pb-6">

    <div class="mt-6 relative bg-indigo-400 pt-1 pb-2">
        <h2 class="text-3xl text-center text-gray-50">Gestionar Usuarios</h2>
    </div>
    {{-- <div class="mt-6">
        <x-panel-link :href="route('services.create')">Agregar servicio +</x-panel-link>
    </div> --}}
    <table class="border mt-6">
        <thead class="bg-gray-200 dark:bg-gray-700">
            <tr>
                <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Id</th>
                <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Nombre</th>
                <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Email</th>
                <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Rol</th>
                <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $user->id }}</td>
                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <div class="flex align-content-around">
                            <img 
                                src="{{ asset($user->profile_image) }}" 
                                alt="Avatar"
                                class="rounded-full"
                                width="40"
                                height="40"
                            >
                            <div class="mt-2 ml-2">
                                {{ $user->name }}
                            </div>
                        </div>
                    </td>
                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$user->email}}</td>
                    <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $user->isAdmin() ? 'Administrador' : 'Usuario' }}</td>
                    <td class="py-4 px-6 text-center text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <form id="{{ $user->id }}" method="POST" class="d-inline" action="{{ route('users.admin.toggle', ['user' => $user->id]) }}">
                            @csrf

                            @if($user->isAdmin())
                                @if($user->id != 1)
                                    <button type="submit" value="{{ $user->id }}" class="openConfirmModal px-3 py-1 bg-red-100 border-2 border-red-600 rounded-md text-red-600 hover:bg-red-200">
                                        Descartar administrador
                                    </button>
                                @endif
                            @else
                                <button type="submit" value="{{ $user->id }}" class="openConfirmModal px-3 py-1 bg-green-100 border-2 border-green-600 rounded-md text-green-600 hover:bg-green-200">
                                    Designar administrador
                                </button>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</div>


{{-- Confirm Modal --}}

<div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="confirmModal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Cambiar rol
                            </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                ¿Confirma la acción de cambio de rol?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="confirmChange w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
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

                $('.confirmChange').on('click', function(e){
                    $('#'+ id +'').submit();
                });
            });
        });
    </script>

@endsection