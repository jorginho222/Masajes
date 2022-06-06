<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BookingRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Cache;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        return view('user.bookings.index')->with([
            'bookings' => $user->bookings,
        ]);     
    }

    public function create()
    {
        $services = Cache::remember('services', 30, function () {
            return Service::all();
        });
        
        return view('user.bookings.create')->with([
            'services' => $services,
            'user' => Auth::user(),
        ]); 
    }

    // public function destroy(Booking $booking, Service $service)
    // {
    //     // dd($booking->user_id);
    //     $booking->update(['user_id' => NULL]);
    //     $booking->services()->detach($service->id); 
    //     $booking->delete();

    //     return redirect()
    //         ->route('')
    //         ->withSuccess('El turno se canceló correctamente!'); 
    // }
}
