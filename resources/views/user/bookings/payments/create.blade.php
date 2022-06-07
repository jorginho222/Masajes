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
$item->title = $order->services[0]->title . ' (x' . $order->services[0]->pivot->quantity . ')';
$item->quantity = $order->services[0]->pivot->quantity;
$item->currency_id = "ARS";
$item->unit_price = $order->services[0]->price;

$payer = new MercadoPago\Payer();
$user = Auth::user();
$payer->email = 'test_user_95116427@testuser.com';

$preference->back_urls = array(
    "success" => route('bookings.orders.payments.pay', $order),
    "failure" => route('bookings.orders.payments.pay', $order),
    "pending" => route('bookings.orders.payments.pay', $order),
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
        <div class="my-6 min-w-4xl bg-white pb-6 pr-10 pl-10 shadow-lg">
            {{-- <div class="max-w-xl my-6 bg-indigo-400 pt-1 pb-2 ">
                <h2 class="text-3xl text-center text-gray-50">Nueva reserva de turno</h2>
            </div> --}}
            
            <div class="mt-6 max-w-3xl rounded">
                <p class="pb-3 text-center text-lg text-gray-700">Confirmá tu reserva realizando el pago.</p>
                <div class="bg-indigo-500 w-full py-1 rounded-t-md">
                    <h2 class="text-center text-white font-medium tracking-wider">Turno</h2>
                </div>
                <div class="py-2 shadow-lg rounded-b-md">
                    <div class="flex justify-between px-2">
                        <div class="">
                            Fecha
                        </div>
                        <div>
                            {{ $data['date'] }}
                        </div>
                    </div>
                    <div class="flex justify-between px-2">
                        <div class="">
                            Hora
                        </div>
                        <div>
                            {{ $data['time'] }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 max-w-md rounded overflow-hidden shadow-lg">
                <div class="bg-indigo-500 w-full py-1 rounded-t-md">
                    <h2 class="text-center text-white font-medium tracking-wider">Orden</h2>
                </div>

                <img src="{{ asset($order->services[0]->image->path) }}" alt="">

                <div class="py-2 rounded-b-md">

                    <div class="flex justify-between px-2">
                        <div class="">
                            {{ $order->services[0]->title }} (Para {{ $order->services[0]->pivot->quantity }} persona/s)
                        </div>
                        <div>
                            ${{ $order->services[0]->price }}
                        </div>
                    </div>
                    <div class="flex justify-between px-2">
                        <div class="font-medium text-lg">
                            Total
                        </div>
                        <div class="font-medium text-lg">
                            ${{ $order->total }}
                        </div>
                    </div>
                </div>

            </div>
        
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