@extends('layouts.app')
@section('content')
    
    <div class="container mx-auto">
        <div class="m-5 flex justify-center">
            <div class='w-full max-w-xl px-10 py-8 bg-white rounded-lg shadow-xl'>
                <div class='max-w-md mx-auto space-y-6'>
                    <form
                        id="courseForm" 
                        method="POST" 
                        action="{{ route('courses.store') }} "
                        enctype="multipart/form-data">
        
                        <h2 class="text-2xl text-center">Crear nuevo curso</h2>
                        {{-- <p class="my-2 opacity-70">Rellená todos los datos. Luego, confirmá tu reserva.</p> --}}
                        <hr class="my-6">
                        <div class="mb-6">
                            <ul id="showErrors"></ul>
                        </div>
                        
                        @csrf
                        <label class="uppercase text-sm font-bold opacity-70">Nombre del curso</label>
                        <input type="text" name="title" class="title p-2 mt-2 mb-4 w-full bg-slate-200 rounded" value="{{ old('title') }}">
                        <label class="uppercase text-sm font-bold opacity-70">Descripción</label>
                        <input type="text" name="description" class="description p-2 mt-2 mb-4 w-full bg-slate-200 rounded" value="{{ old('description') }}">
                        <label class="uppercase text-sm font-bold opacity-70">Dia de cursada</label>
                        <select name="day" class="day p-2 mt-2 mb-4 w-full bg-slate-200 rounded" id="">
                            <option value="" selected>Seleccione dia...</option>
                            <option {{ old('day') == 'Monday'  ? 'selected' : '' }} value="Monday" >Lunes</option>         
                            <option {{ old('day') == 'Tuesday'  ? 'selected' : '' }} value="Tuesday" >Martes</option>         
                            <option {{ old('day') == 'Wednesday'  ? 'selected' : '' }} value="Wednesday" >Miercoles</option>         
                            <option {{ old('day') == 'Thursday'  ? 'selected' : '' }} value="Thursday" >Jueves</option>         
                            <option {{ old('day') == 'Friday'  ? 'selected' : '' }} value="Friday" >Viernes</option>         
                            <option {{ old('day') == 'Saturday'  ? 'selected' : '' }} value="Saturday" >Sábados</option>         
                        </select>
                        
                        <div class="flex">
                            <div>

                                <label class="uppercase text-sm font-bold opacity-70">Desde</label>
                                <select class="init_time block p-2 mt-2 mb-4 bg-slate-200 rounded" name="init_time" id="">
                                    <option value="" selected>Seleccione la hora de inicio...</option>
                                    
                                    @for ($i=9; $i<=18; $i++)
                                        <option {{ old('init_time') ==  $i . ':00' ? 'selected' : '' }} value="{{ $i }}:00">{{ $i }}:00</option>
                                        <option {{ old('init_time') ==  $i . ':30' ? 'selected' : '' }} value="{{ $i }}:30">{{ $i }}:30</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="ml-2">

                                <label class="uppercase text-sm font-bold opacity-70">Hasta</label>
                                <select class="finish_time block p-2 mt-2 mb-4 bg-slate-200 rounded" name="finish_time" id="">
                                    <option value="" selected>Seleccione la hora de finalización...</option>
                                    
                                    @for ($i=9; $i<=19; $i++)
                                        <option {{ old('finish_time') ==  $i . ':00' ? 'selected' : '' }} value="{{ $i }}:00">{{ $i }}:00</option>
                                        <option {{ old('finish_time') ==  $i . ':30' ? 'selected' : '' }} value="{{ $i }}:30">{{ $i }}:30</option>
                                @endfor
                                </select>
                            </div>
                        </div>

                        <label class="block uppercase text-sm font-bold opacity-70">Fecha de inicio</label>
                        <input type="date" min="{{ now()->addDays(1)->format('Y-m-d') }}" name="init_date" value="{{ old('init_date') }}" class="init_date p-2 mt-2 mb-4 w-full bg-slate-200 rounded">
                        
                        <div class="flex">
                            <div>
                                <label class="uppercase text-sm font-bold opacity-70">Duración</label>
                                <div class="flex">
                                    <input type="number" min="1" max="12" name="duration" class="duration block p-2 mt-2 mb-4 w-20 bg-slate-200 rounded" value="{{ old('duration') }}">
                                    <div class="mt-4 ml-2 text-md opacity-70">(meses)</div>
                                </div>

                            </div>
                            
                            <div class="ml-2">
                                <label class="uppercase text-sm font-bold opacity-70">Cupo máximo</label>
                                <div class="flex">
                                    <input type="number" min="1" name="capacity" class="capacity block p-2 mt-2 mb-4 w-20 bg-slate-200 rounded" value="{{ old('capacity') }}">
                                    <div class="mt-4 ml-2 text-md opacity-70">(personas)</div>
                                </div>
                            </div>
                        </div>
                            
                        <label class="block uppercase text-sm font-bold opacity-70">Valor cuota mensual</label>
                        <div class="flex">
                            <div class="mt-4 text-md font-medium">$</div>
                            <input type="number" min="1" name="fee" class="fee p-2 ml-2 mt-2 mb-4 w-20 bg-slate-200 rounded" value="{{ old('fee') }}">
                        </div>
                    
                    
                        <label class="block uppercase text-sm font-bold opacity-70">Valor Matrícula</label>
                        <div class="flex">
                            <div class="mt-4 text-md font-medium">$</div>
                            <input type="number" min="1" name="enrollment" class="enrollment p-2 ml-2 mt-2 mb-4 w-20 bg-slate-200 rounded" value="{{ old('enrollment') }}">
                        </div>

                        <label for="image" class="block uppercase text-sm font-bold opacity-70">Imagen</label>
                        <input type="file" accept="image/*" name="image" class="p-2 mt-2 mb-4 w-full bg-slate-200 rounded">

                        <x-app-button class="initValidation">
                            Crear curso
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
            'day': $('.day').val(),
            'init_time': $('.init_time').val(),
            'finish_time': $('.finish_time').val(),
            'init_date': $('.init_date').val(),
            'duration': $('.duration').val(),
            'capacity': $('.capacity').val(),
            'fee': $('.fee').val(),
            'enrollment': $('.enrollment').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('courses.validation') }}",
            data: data,
            dataType: "json",
            success: function (response) {
                // console.log(response)
                if (response.status == 400) {
                    $('#showErrors').html("")
                    $.each(response.errors, function (key, error) { 
                        $('#showErrors').append('<li class="text-red-700 font-medium list-none">'+ error +'</li>')
                    });
                }
                if(response.status == 200) {
                    $('#showErrors').html("")
                    $('#courseForm').submit()
                }
            }
        });        
    });
</script>
@endsection