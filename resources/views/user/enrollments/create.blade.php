@extends('layouts.app')
@section('content')

<div class="container mx-auto">

    <div class="m-5 flex justify-center">
        <div>
            <div class="max-w-xl my-4 bg-indigo-400 pt-1 pb-2 rounded-lg">
                <h2 class="text-3xl text-center text-gray-50">Inscripción</h2>
            </div>
            <div class='w-full max-w-xl px-10 py-8 bg-white rounded-lg shadow-xl'>
                <div class='max-w-md mx-auto space-y-6'>
                    <form 
                        id="courseForm"
                        method="POST" 
                        action="{{ route('enrollments.orders', ['course' => $course->id]) }} "
                        enctype="multipart/form-data">
                    
                        <div class="mt-1">
                            <p class="font-medium text-lg text-indigo-700">{{ $course->title }}</p>
                        </div>
                        <div class="my-1 border-b border-gray-300"></div>
                        <div class="mt-1">
                            <p class="font-medium text-gray-600">&#128198; {{ $course->spanish_day }} <span class="text-gray-600 font-normal">(comienza el {{ $course->init_date->format('d/m') }})</span></p>
                        </div>
                        <div class="mt-1">
                            <p class="font-medium text-gray-600">&#9200; {{ $course->init_time->format('H:i') }} a {{ $course->finish_time->format('H:i') }} hs.</p>
                        </div>
                        <div class="mt-1 mb-6">
                            <p class="font-medium text-gray-600">&#128181; ${{ $course->enrollment }}</p>
                        </div>
                        
                        <div class="my-6">
                            <ul id="showErrors"></ul>
                        </div>
    
                        @csrf
                        <label for="" class="uppercase text-sm font-bold opacity-70">Nombre</label>
                        <input type="text" name="name" class="name p-2 mt-2 mb-4 w-full bg-slate-200 rounded form-control" value="{{ old('name') ?? $user->name }}" autocomplete="name" autofocus>
                        
                        <label for="" class="uppercase text-sm font-bold opacity-70">Email</label>
                        <input type="text" name="email" class="email p-2 mt-2 mb-4 w-full bg-slate-200 rounded form-control" value="{{ old('email') ?? $user->email }}" autocomplete="email" autofocus>
    
                        <label for="" class="uppercase text-sm font-bold opacity-70">Telefono <span class="font-normal lowercase">(opcional)</span></label>
                        <input type="number" name="phone" class="phone p-2 mt-2 mb-4 w-full bg-slate-200 rounded form-control" value="{{ old('phone') ?? $user->phone }}" autocomplete="phone" autofocus>
    
                        <input name="course_id" value="{{$course->id}}" type="hidden" class="course_id">
    
                        <x-app-button class="initValidation">
                            Iniciar inscripción
                        </x-app-button>
                    </form>
                </div>
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
            'course_id': $('.course_id').val(),
            'phone': $('.phone').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('enrollments.orders.validation') }}",
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
                    $('#courseForm').submit()
                }
            }
        });        
    });
</script>
@endsection