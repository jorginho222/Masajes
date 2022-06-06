<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnrollmentOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'course_id',
    ];

    public function payment()
    {
        return $this->morphOne(Payment::class, 'paymentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

}
