<?php

namespace App\Models;


use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $data;

    protected $fillable = [
        'date',
        'time',
        'user_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @deprecated Use the "casts" property
     *
     * @var array
     */
    protected $dates = [    // Instancia de Carbon, para poder acceder a sus funcionalidades
        'date',
        'time'
    ];    

    protected $casts = [
        'date' => 'datetime:Y-m-d',
        'time' => 'datetime:H:i:s',
    ];

    public function services()
    {
        return $this->morphToMany(Service::class,'serviceable')->withPivot('quantity');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function getAvailability($date, $time, $quantityRequest, $serviceId) 
    {
        $coincidences = Booking::whereDate('date', '=', $date)
            ->whereTime('time', '=', $time)
            ->get();

        $serviceCapacity = Service::findOrFail($serviceId)->capacity;

        $total = $quantityRequest;

        foreach ($coincidences as $coincidence) {
            $quantity = $coincidence->services[0]->pivot->quantity;
            $total += $quantity;
        }

        ($total <= $serviceCapacity) ? $available = true : $available = false;
        
        return $available;
        
    }

}
