<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Order;
use App\Models\EnrollmentOrder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'day',
        'init_time',
        'finish_time',
        'init_date',
        'duration',
        'capacity',
        'fee',
        'enrollment',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @deprecated Use the "casts" property
     *
     * @var array
     */
    protected $dates = [    // Instancia de Carbon, para poder acceder a sus funcionalidades
        'init_time',
        'finish_time',
        'init_date',
    ];    

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function enrollmentOrders()
    {
        return $this->hasMany(EnrollmentOrder::class, 'course_id');
    }

    /**
     * Get the course's spanish day.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */

    public function getSpanishDayAttribute()
    {
        $day = $this->day;
        switch ($day) {
            case 'Monday':
                $day= 'Lunes';
                return $day;
                break;
            case 'Tuesday':
                $day= 'Martes';
                return $day;
                break;
            case 'Wednesday':
                $day= 'Miercoles';
                return $day;
                break;
            case 'Thursday':
                $day= 'Jueves';
                return $day;
                break;
            case 'Friday':
                $day= 'Viernes';
                return $day;
                break;
            case 'Saturday':
                $day= 'Sabado';
                return $day;
                break;
            default:
                return $day;
                break;
        }
    }
}
