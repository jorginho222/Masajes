@component('mail::message')
Hola **{{$name}}**,  {{-- use double space for line break --}}
Tu inscripción ha sido confirmada! Gracias por elegirnos!      
 
**Curso elegido:** {{ $order->course->title }}  
**Fecha de inicio:** {{ $order->course->init_date->format('d/m/Y') }}    
**Horario:** {{ $order->course->init_time->format('H:i') }} a {{ $order->course->finish_time->format('H:i') }} hs.  
**Matrícula:** ${{ $order->course->enrollment }}  
**Couta mensual:** ${{ $order->course->fee }} 

Que tenga un feliz aprendizaje!

Click below to start working right now
@component('mail::button', ['url' => $link])
Go to your inbox
@endcomponent
Sincerely,
Mailtrap team.
@endcomponent