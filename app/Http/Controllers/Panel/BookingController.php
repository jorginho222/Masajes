<?php

namespace App\Http\Controllers\Panel;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->date) {

            $todayBookings = Booking::whereDate('date', '=', now())
                ->orderBy('time')
                ->get();
    
            return view('panel.bookings.index')->with([
                'todayBookings' => $todayBookings,
            ]);

        } else {
            $dateSelectedBookings = Booking::whereDate('date', '=', $request->date)
                ->orderBy('time')
                ->get();

            // dd($dateSelectedBookings[0]->user->name);

            return view('panel.bookings.index')->with([
                'dateSelectedBookings' => $dateSelectedBookings,
            ]);
        }
    }

    public function edit(Booking $booking)
    {
        return view('panel.bookings.edit')->with([
            'booking' => $booking,
        ]);
    }

    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'time' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),
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
                    'message'=>'Edicion de Reserva validada'
                ]);
            }
        }
    }

    public function update(Booking $booking, Request $request)
    {
        $booking->update($request->all());

        return redirect()
            ->route('panel.bookings.index')
            ->withSuccess("La reserva con id {$booking->id} se ha movido para el dia {$booking->date->format('d/m/Y')} a las {$booking->time->format('H:i')} hs.");
    }

    // public function destroy(Booking $booking, Service $service)
    // {
    //     // dd($booking->user_id);
    //     $booking->update(['user_id' => NULL]);
    //     $booking->services()->detach($service->id); 
    //     $booking->delete();

    //     return redirect()
    //         ->route('profile.bookings')
    //         ->withSuccess('El turno se canceló correctamente!'); 
    // }
}
