<?php

namespace App\Models;

use App\Models\BookingOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'payed_at',
        'order_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @deprecated Use the "casts" property
     *
     * @var array
     */
    protected $dates = [    // Instancia de Carbon, para poder acceder a sus funcionalidades
        'payed_at'
    ];  

    public function paymentable()
    {
        return $this->morphTo();
    }
}
