@extends('layouts.app')
@section('content')

<div class="container mx-auto pb-6">

    <div class="mt-6 bg-indigo-400 pt-1 pb-2">
        <h2 class="text-3xl text-center text-gray-50">Gestionar cursos</h2>
    </div>
    <div class="mt-6">
        <x-panel-link :href="route('courses.create')">Agregar curso +</x-panel-link>
    </div>

    @if(isset($courses[0]))
    
        <table class="border mt-6">
            <thead class="bg-gray-200 dark:bg-gray-700">
                <tr>
                    <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Id</th>
                    <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Curso</th>
                    <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Dias</th>
                    <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Horario</th>
                    <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Fecha de inicio</th>
                    <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Duración</th>
                    <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Cuota</th>
                    <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Matrícula</th>
                    <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Cupos disponibles</th>
                    <th class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">Acciones</th>
                </tr>
            </thead>
                
                <tbody>
                    @foreach ($courses as $course)
                        <tr class="bg-white dark:bg-gray-800 dark:border-gray-700">
                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $course->id }}</td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $course->title }}
                            </td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $course->spanish_day }}</td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $course->init_time->format('H:i')}} a {{ $course->finish_time->format('H:i')}}</td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $course->init_date->format('d/m/Y') }}</td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $course->duration }} Meses</td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">${{ $course->fee }}</td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">${{ $course->enrollment }}</td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $course->capacity }} personas</td>
                            <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <button type="button" value="{{ $course->id }}" class="openEnrolledUsersModal mr-1 px-3 py-1 bg-green-100 border-2 border-green-600 rounded-md text-green-600 hover:bg-green-200">Ver inscriptos</button>
                                <x-edit-link :href="route('courses.edit', ['course' => $course->id])" class="mr-2"> Editar </x-edit-link>
                                <form id="{{ $course->id }}" method="POST" class="inline-block" action="{{ route('courses.destroy', ['course' => $course->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-delete-button class="openConfirmModal" value="{{ $course->id }}">Eliminar</x-delete-button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

        @else

        <div class="mt-6">
            No hay ningun curso registrado en el sistema.
        </div>

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
                              Eliminar curso
                            </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                El curso se borrara permanentemente de la base de datos ¿Confirma eliminación?
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


{{-- Enrolled Users Modal --}}

<div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="enrolledUsersModal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-indigo-400 py-1 rounded-t-lg">
                    <h3 class="text-lg text-center font-medium text-white" id="modal-title">
                        Usuarios inscriptos
                    </h3>
                </div>
                <div class="bg-white px-4 pt-5 pb-2 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="">
                            <ul id="enrolledUsers" class="text-sm text-gray-500">
                                {{-- Incrustar JQ --}}
                            </ul>
                        </div>
                    </div>
                </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="closeEnrolledUsersModal w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Cerrar
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

    <script>

        $(document).on('click', '.openEnrolledUsersModal', function (e) {
            e.preventDefault();
            var course_id = $(this).val();
            // console.log(course_id);
            $('#enrolledUsersModal').removeClass('invisible');

            $.ajax({
                type: "GET",
                url: "/panel/" + course_id + "/enrolled/" ,
                success: function (response) {
                    console.log(response)
                    if(response.status == 404)
                    {
                        $('#enrolledUsers').html("")
                        $('#enrolledUsers').append('<p class="py-1 font-medium text-indigo-600">No hay usuarios inscriptos en este curso.</p>')
                    }
                    if(response.status == 200)
                    {
                        $('#enrolledUsers').html("")
                        $.each(response.enrolledUsers, function (key, enrolledUser) { 
                             $('#enrolledUsers').append('<li class="py-1 font-medium">'+ enrolledUser.name +'<span class="font-normal"> ('+ enrolledUser.email +')</span></li>')
                        });
                    }
                }
            });
        })
        
        $('.closeEnrolledUsersModal').on('click', function(e){
            $('#enrolledUsersModal').addClass('invisible');
            $('#enrolledUsers').html("")
        });
    </script>

@endsection