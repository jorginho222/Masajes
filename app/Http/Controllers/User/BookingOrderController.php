<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\BookingOrder;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Validator;

class BookingOrderController extends Controller
{
    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($request->user()->id),
            ],
            'service_id' => 'required',
            'quantity' => 'required',
            'date' => 'required',
            'time' => 'required',
            ]);

        if($validator->fails()) {
            return response()->json([
                'status'=>400,
                'errors'=>$validator->errors()
            ]);
        } else {
            $validator->after(function ($validator) use ($request) {
                $requestDay = Carbon::parse($request->date)->englishDayOfWeek;
    
                if($requestDay == 'Sunday') {
                    $validator->errors()->add('date', 'Elija un dia de lunes a sabado de 9 a 17 hs');
                }
    
                $time = Carbon::parse($request->time)->format('H:i:s');
    
                $available = Booking::getAvailability($request->date, $time, $request->quantity, $request->service_id);
    
                if(!$available) {
                    $validator->errors()->add('time', 'Nos encontramos sin disponibilidad para la fecha y hora seleccionadas.');
                }
    
            });
            if($validator->fails()) {
                return response()->json([
                    'status'=>400,
                    'errors'=>$validator->errors()
                ]);
            } else {
                return response()->json([
                    'status'=>200,
                    'message'=>'Reserva validada'
                ]);
            }
        }
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $user = $request->user();
            
        $user->fill(array_filter($data)); // array_filter(): solo actualizaremos lo q el usuario haya editado
        
        $user->save();
        
        $request->session()->put('type', 'booking');
        $request->session()->put('data', $data);
        
        $order = $user->bookingOrders()->create([
            'status' => 'started',
        ]);
        
        $element[$request->service_id] = ['quantity' => $request->quantity];
        
        $order->services()->attach($element);
        
        return redirect()
            ->route('bookings.orders.payments.create', ['order' => $order]);
    }
}
