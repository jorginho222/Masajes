@component('mail::message')
Hola **{{$name}}**,  {{-- use double space for line break --}}
Tu reserva ha sido confirmada! Gracias por elegirnos!      
Datos de tu reserva:  

**Fecha:** {{ $booking->date->format('d/m/Y') }}  
**Hora:** {{ $booking->time->format('H:i') }}  
**Servicio:** {{ $booking->services[0]->title }} (para {{ $booking->services[0]->pivot->quantity }} persona/s)   
**Precio final:** ${{ $order->total }}   

Click below to start working right now
@component('mail::button', ['url' => $link])
Go to your inbox
@endcomponent
Sincerely,
Mailtrap team.
@endcomponent