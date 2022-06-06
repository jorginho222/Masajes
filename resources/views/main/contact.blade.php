@extends('layouts.app')
@section('content')

<div class="container mx-auto pb-6">
    <div class="mt-10 flex justify-center">
        <div class='w-full max-w-xl px-10 py-8 bg-white rounded-lg shadow-xl'>
            <div class='max-w-md mx-auto '>
                <form id="contactForm" method="POST" action="{{ route('contact.send') }}">
                    <h2 class="text-2xl text-center text-indigo-700">Estamos a su disposición</h2>
                    <p class="my-4 opacity-70">Para consultas, sugerencias, quejas, etc. Por favor, rellene los campos a continuacion:</p>
                    <hr class="my-6">
                    <div class="mb-6">
                        <ul id="showErrors"></ul>
                    </div>

                    @csrf
                    <label class="uppercase text-sm font-bold opacity-70">Tu nombre</label>
                    <input type="text" name="name" class="name p-2 mt-2 mb-4 w-full bg-slate-200 rounded">
                    <label class="uppercase text-sm font-bold opacity-70">Email</label>
                    <input type="text" name="email" class="email p-2 mt-2 mb-4 w-full bg-slate-200 rounded">
                    <label class="uppercase text-sm font-bold opacity-70">Asunto</label>
                    <input type="text" name="subject" class="subject p-2 mt-2 mb-4 w-full bg-slate-200 rounded">
                    <label class="uppercase text-sm font-bold opacity-70">Mensaje</label>
                    <textarea name="message" id="" cols="20" rows="5" class="message p-2 mt-2 mb-4 w-full bg-slate-200 rounded"></textarea>
                    <input type="submit" class="initValidation py-2 px-6 my-2 bg-orange-400 text-white font-medium rounded hover:bg-indigo-500 cursor-pointer ease-in-out duration-300" value="Enviar">
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
            'name': $('.name').val(),
            'email': $('.email').val(),
            'subject': $('.subject').val(),
            'message': $('.message').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('contact.validation') }}",
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
                    $('#contactForm').submit()
                }
            }
        });        
    });
</script>
@endsection