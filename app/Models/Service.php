<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Order;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'capacity',
    ];

    public function bookings()
    {
        return $this->morphedByMany(Booking::class, 'serviceable')->withPivot('quantity');
    }

    public function bookingOrders()
    {
        return $this->morphedByMany(BookingOrder::class, 'serviceable')->withPivot('quantity');
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function isMostSold($service)
    {
        $mostSoldservices= Service::orderBy('sales', 'desc')
            ->where('sales', '>=', 1)
            ->get();

        $isMostSold = $mostSoldservices->where('id', '=', $service);
            
        return isset($isMostSold[0]) 
            ? true 
            : false;
    }
}
