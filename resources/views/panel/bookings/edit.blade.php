@extends('layouts.app')

@section('content')

<div class="container mx-auto">

    <div class="mt-10 flex justify-center">
        <div class='w-full max-w-xl px-10 py-8 bg-white rounded-lg shadow-xl'>
            <div class='max-w-md mx-auto space-y-6'>
                <form
                    id="bookingForm" 
                    method="POST" 
                    action="{{ route('panel.bookings.update', ['booking' => $booking->id]) }}"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <h2 class="text-2xl text-indigo-800 text-center">Modificar fecha y hora del turno</h2>
                    <hr class="my-4">

                    {{-- <p class="opacity-70">Aqui puede modificar el dia y horario de la reserva seleccionada.</p> --}}
                    
                    <p class="mt-4 block uppercase text-sm font-bold opacity-70">Quien realizo la reserva</p>
                    <div class="mt-2 flex align-content-around">
                        <img 
                            src="{{ asset($booking->user->profile_image) }}" 
                            alt="Avatar"
                            class="rounded-full"
                            width="40"
                            height="40"
                        >
                        <div class="mt-2 ml-2">
                            {{ $booking->user->name }}
                        </div>
                    </div>
                    <p class="mt-4 block uppercase text-sm font-bold opacity-70">Servicio que eligió</p>
                    <p>{{ $booking->services[0]->title }} (Para {{ $booking->services[0]->pivot->quantity }} persona/s)</p>

                    <div class="mb-6">
                        <ul id="showErrors"></ul>
                    </div>
            
                    <label class="block uppercase text-sm font-bold opacity-70">Fecha</label>
                    <input type="date" min="{{ now()->addDays(1)->format('Y-m-d') }}" name="date" value="{{ $booking->date->format('Y-m-d') }}" class="date p-2 mt-2 mb-4 w-full bg-slate-200 rounded">

                    <label class="uppercase text-sm font-bold opacity-70">Hora</label>
                    <select class="time block p-2 mt-2 mb-4 bg-slate-200 rounded" name="time" id="">
                        <option value="" selected>Seleccione la hora...</option>
                        
                        @for ($i=9; $i<=17; $i++)
                            <option {{ $booking->time->format('H:i') == $i . ':00' ? 'selected' : '' }} value="{{ $i }}:00">{{ $i }}:00</option>
                            <option {{ $booking->time->format('H:i') == $i . ':30' ? 'selected' : '' }} value="{{ $i }}:30">{{ $i }}:30</option>
                        @endfor
                    </select>

                    <input type="hidden" name="service_id" class="service_id" value="{{ $booking->services[0]->id }}">
                    <input type="hidden" name="quantity" class="quantity" value="{{ $booking->services[0]->pivot->quantity }}">
                
                    <x-app-button class="initValidation">
                        Guardar cambios
                    </x-app-button>
                </form>
            </div>
        </div>      
    </div>
</div>

@endsection

{{-- Confirm Booking Modal --}}

<div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="confirmModal">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Guardar cambios
                            </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                ¿Confirma los cambios en el turno?
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="confirmBooking w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Confirmar
                </button>
                <button type="button" class="closeConfirmModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Revisar
                </button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).on('click', '.initValidation', function (e) {
        e.preventDefault();
        var data = {
            'date': $('.date').val(),
            'time': $('.time').val(),
            'service_id': $('.service_id').val(),
            'quantity': $('.quantity').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('panel.bookings.validation') }}",
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
                    $('#confirmModal').removeClass('invisible');
                    $('.closeConfirmModal').on('click', function(e){
                        $('#confirmModal').addClass('invisible');
                    });
                    $('.confirmBooking').on('click', function (e) {
                        $('#bookingForm').submit()
                    });
                }
            }
        });        
    });
</script>
@endsection