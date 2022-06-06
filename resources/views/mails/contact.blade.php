@component('mail::message')
Estimado/a administrador,    {{-- use double space for line break --}}
Se estan queriendo contactar contigo! Aqui le proporcionamos los detalles:       
  
**Nombre:** {{ $name }}    
**Email:** {{ $email }}    
**Asunto:** {{ $subject }}    
**Mensaje:**      
{{ $message }}

Click below to start working right now
@component('mail::button', ['url' => $link])
Go to your inbox
@endcomponent
Sincerely,
Mailtrap team.
@endcomponent