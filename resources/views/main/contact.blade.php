@extends('layouts.app')
@section('content')

<div class="container mx-auto pb-6">
    <div class="flex justify-center">
        <div class="mt-10">
            <div class='w-full max-w-xl py-8 px-8 bg-white rounded-lg shadow-xl'>
                <div class='max-w-md mx-auto '>
                    <form id="contactForm" method="POST" action="{{ route('contact.send') }}">
                        <h2 class="text-2xl text-center text-indigo-400 font-medium">Estamos a su disposición</h2>
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
        <div class="ml-12 mt-10">
            <h2 class="my-10 text-center text-xl text-indigo-400 font-medium">¿Dónde estamos?</h2>
            <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=plaza%20irlanda%20&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.whatismyip-address.com/divi-discount/">divi discount</a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><a href="https://www.embedgooglemap.net">google maps generator</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div></div>        
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