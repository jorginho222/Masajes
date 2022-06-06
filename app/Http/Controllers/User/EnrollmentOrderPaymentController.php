<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Booking;
use App\Mail\EnrollmentMail;
use App\Models\BookingOrder;
use Illuminate\Http\Request;
use App\Mail\MailtrapExample;
use App\Models\EnrollmentOrder;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class EnrollmentOrderPaymentController extends Controller
{
    public function create(EnrollmentOrder $order)
    {
        return view('user.enrollments.payments.create')->with([
            'order' => $order,
        ]);
    }

    public function pay(EnrollmentOrder $order, Request $request)
    {
        $payment_id = $request->get('payment_id');

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=TEST-6552556589763354-042315-db819431aca62a80d162a2097c671f5d-1111629541");

        $response = json_decode($response);

        $status = $response->status;

        if($status == 'approved') {

            return DB::transaction(function () use($order, $request) {

                $order->payment()->create([
                    'amount' => $order->course->enrollment,
                    'payed_at' => now(),
                ]);
    
                $order->status = 'paid';
                $order->save();
    
                $user = $request->user();
                
                $user->courses()->save($order->course);

                $order->course->decrement('capacity', 1);

                // Mail::to($request->user()->email)->send(new EnrollmentMail($order));

                return redirect()
                    ->route('enrollment.success');
            }, 5);
        }

        if($status == 'pending') {
            $order->status = 'pending';
            $order->save();

            return redirect()
                ->route('enrollment.pending');
        }

        if($status == 'rejected') {
            $order->status = 'rejected';
            $order->save();

            return redirect()
                ->back()
                ->withErrors('Su pago no ha podido ser acreditado. Si lo desea puede intentar con otro medio de pago.');
        }
    }
}
