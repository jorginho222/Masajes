@php
// SDK Mercadopago
use Mercadopago\SDK;
use Mercadopago\Preference;
use Mercadopago\Item;
use Mercadopago\Payer;

// Agrega credenciales
MercadoPago\SDK::setAccessToken(config('services.mercadopago.token'));

// Preferencias
$preference = new MercadoPago\Preference();

$item = new MercadoPago\Item();
$item->title = $order->course->title;
$item->quantity = 1;
$item->currency_id = "ARS";
$item->unit_price = $order->course->enrollment;

$payer = new MercadoPago\Payer();
$user = Auth::user();
$payer->email = 'test_user_95116427@testuser.com';

$preference->back_urls = array(
    "success" => route('enrollments.orders.payments.pay', $order),
    "failure" => route('enrollments.orders.payments.pay', $order),
    "pending" => route('enrollments.orders.payments.pay', $order),
);
$preference->auto_return = "approved";

$preference->items = array($item);
$preference->payer = $payer;
$preference->save();

@endphp

@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    
    <div class="flex justify-center">
        <div class="mt-10 bg-white pt-3 pb-6 pr-6 pl-6 shadow-lg">
            <div class="max-w-md rounded">
                <p class="text-gray-700 text-lg text-center">Confirmá tu inscripción realizando el pago de la <strong>matrícula.</strong></p>
                <div class="mt-6 bg-indigo-500 w-full py-1 rounded-t-md">
                    <h2 class="text-center text-white font-medium tracking-wider">Orden</h2>
                </div>
        
                <img src="{{ asset($order->course->image->path) }}" alt="">
        
                <div class="py-2 shadow-lg rounded-b-md">
        
                    <div class="flex justify-between px-2">
                        <div class="">
                            {{ $order->course->title }}
                        </div>
                    </div>
                    <div class="flex justify-between px-2">
                        <div class="font-medium text-lg">
                            Total
                        </div>
                        <div class="font-medium text-lg">
                            ${{ $order->course->enrollment }}
                        </div>
                    </div>
                </div>
        
            </div>
            {{-- <form 
                action="{{ route('orders.payments.store', ['order' => $order->id]) }}"
                method="POST">
                
                @csrf
                <div class="mt-4">
        
                   
                </div>
            </form> --}}

            <div class="mt-6">
                <img src="{{ asset('img/mdepago.png') }}" alt="" width="400">
            </div>
            <div class="mt-6">
                <p class="text-lg text-gray-700">Encontrá lo necesario para realizar el pago de prueba <a class="font-bold text-indigo-500" href="https://www.mercadopago.com.ar/developers/es/docs/checkout-pro/additional-content/test-cards" target="_blank" rel="noopener noreferrer">acá</a></p>
            </div>
            <div class="mt-6 cho-container"></div>
        </div>

    </div>
    
</div>

<script src="https://sdk.mercadopago.com/js/v2"></script>

<script>
    //Adicione as credenciais de sua conta Mercado Pago junto ao SDK
    const mp = new MercadoPago("{{config('services.mercadopago.key')}}", {
        locale: 'es-AR'
    });
    const checkout = mp.checkout({
       preference: {
           id: "{{ $preference->id }}" // Indica el ID de la preferencia
       },
       render: {
           container: '.cho-container', // Clase CSS para renderizar el botón de pago
           label: 'Ir a pagar', // Cambiar el texto del botón de pago (opcional)
        }
    });
</script>	 	

@endsection