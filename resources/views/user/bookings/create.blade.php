@extends('layouts.app')

@section('content')

<div class="container mx-auto pb-6">
    <div class="m-5 flex justify-center">
        <div>
            <div class="max-w-xl my-6 bg-indigo-400 pt-1 pb-2 rounded-lg">
                <h2 class="text-3xl text-center text-gray-50">Nueva reserva de turno</h2>
            </div>
            <div class='w-full max-w-xl px-10 py-8 bg-white rounded-lg shadow-xl'>
                <div class='max-w-md mx-auto space-y-6'>
                    <form id="bookingForm" method="POST" action="{{ route('bookings.orders') }}">
                        <p class=" my-2 opacity-70">Rellená todos los datos. Luego, confirmá tu reserva.</p>
                        <hr class="my-6">
                        <div class="mb-6">
                            <ul id="showErrors"></ul>
                        </div>
    
                        @csrf
    
                        <label for="" class="uppercase text-sm font-bold opacity-70">Nombre</label>
                        <input type="text" name="name" class="name p-2 mt-2 mb-4 w-full bg-slate-200 rounded form-control" value="{{ old('name') ?? $user->name }}" autocomplete="name" autofocus>
                        
                        <label for="" class="uppercase text-sm font-bold opacity-70">Email</label>
                        <input type="text" name="email" class="email p-2 mt-2 mb-4 w-full bg-slate-200 rounded form-control" value="{{ old('email') ?? $user->email }}" autocomplete="email" autofocus>
    
                        <label class="uppercase text-sm font-bold opacity-70">Servicio</label>
                        <select class="service_id p-2 mt-2 mb-4 w-full bg-slate-200 rounded" name="service_id" id="">
                            <option value="" selected>Seleccione servicio...</option>
                            @foreach ($services as $service )
                                <option {{ old('service_id') == $service->id ? 'selected' : '' }} value="{{ $service->id }}" >{{ $service->title }} (${{ $service->price }})</option>
                                
                            @endforeach
                        </select>
    
                        <label class="uppercase text-sm font-bold opacity-70" for="">Cantidad</label>
                        <div class="flex">
                            <input type="number" min="1" max="5" name="quantity" class="quantity p-2 mt-2 mb-4 w-20 bg-slate-200 rounded" value="{{ old('quantity') }}">
                            <div class="mt-4 ml-2 text-md opacity-70">(personas)</div>
                        </div>
                        
                        <label class="block uppercase text-sm font-bold opacity-70">Fecha</label>
                        <input type="date" min="{{ now()->addDays(1)->format('Y-m-d') }}" name="date" value="{{ old('date') }}" class="date p-2 mt-2 mb-4 w-full bg-slate-200 rounded">
    
                        <label class="uppercase text-sm font-bold opacity-70">Hora</label>
                        <select class="time block p-2 mt-2 mb-4 bg-slate-200 rounded" name="time" id="">
                            <option value="" selected>Seleccione la hora...</option>
                            
                            @for ($i=9; $i<=17; $i++)
                                <option value="{{ $i }}:00">{{ $i }}:00</option>
                                <option value="{{ $i }}:30">{{ $i }}:30</option>
                            @endfor
                        </select>
    
                        <x-app-button class="initValidation">
                            Iniciar reserva
                        </x-app-button>
                    </form>
                </div>
            </div>      
        </div>
    </div>
</div>

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
                              Confirmacion reserva
                            </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Está a punto de iniciar la orden de reserva ¿Confirma los datos ingresados del turno?
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

@endsection

@section('scripts')
<script>
    $(document).on('click', '.initValidation', function (e) {
        e.preventDefault();
        var data = {
            'name': $('.name').val(),
            'email': $('.email').val(),
            'service_id': $('.service_id').val(),
            'quantity': $('.quantity').val(),
            'date': $('.date').val(),
            'time': $('.time').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('bookings.orders.validation') }}",
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

