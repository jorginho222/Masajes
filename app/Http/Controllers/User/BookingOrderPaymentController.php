<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Booking;
use App\Mail\BookingMail;
use App\Models\BookingOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class BookingOrderPaymentController extends Controller
{
    public function create(BookingOrder $order, Request $request)
    {
        $data = $request->session()->get('data');
        
        return view('user.bookings.payments.create')->with([
            'order' => $order,
            'data' => $data,
        ]);
    }

    public function pay(BookingOrder $order, Request $request)
    {
        $payment_id = $request->get('payment_id');

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=TEST-6552556589763354-042315-db819431aca62a80d162a2097c671f5d-1111629541");

        $response = json_decode($response);

        $status = $response->status;

        if($status == 'approved') {

            return DB::transaction(function () use($order, $request) {

                $order->payment()->create([
                    'amount' => $order->total,
                    'payed_at' => now(),
                ]);
    
                $order->status = 'paid';
                $order->save();
    
                $user = $request->user();
                $data = $request->session()->get('data');

                $booking = $user->bookings()->create($data);
    
                $element[$data['service_id']] = ['quantity' => $data['quantity']];
    
                $booking->services()->attach($element);
    
                $request->session()->pull('data');

                // Mail::to($request->user()->email)->send(new BookingMail($booking, $order));
  
                return redirect()
                    ->route('booking.success');
            }, 5);
        }

        if($status == 'pending') {
            $order->status = 'pending';
            $order->save();

            return redirect()
                ->route('booking.pending');
        }

        if($status == 'rejected') {
            $order->status = 'rejected';
            $order->save();

            return redirect()
                ->back()
                ->withErrors('Su pago no ha podido ser acreditado. Si lo desea, puede intentar con otro medio de pago.');
        }
    }
}
