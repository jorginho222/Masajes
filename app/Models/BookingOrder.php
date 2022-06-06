<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookingOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
    ];

    public function payment()
    {
        return $this->morphOne(Payment::class, 'paymentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function services()
    {
        return $this->morphToMany(Service::class, 'serviceable')->withPivot('quantity');
    }

    public function getTotalAttribute()
    {
        return $this->services[0]->pivot->quantity * $this->services[0]->price;
    }
}
