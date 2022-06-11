<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Image;
use App\Models\Course;
use App\Models\Booking;
use App\Models\Comment;
use App\Models\Service;
use App\Models\BookingOrder;
use App\Models\EnrollmentOrder;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'avatar',
        'external_id',
        'external_auth',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'admin_since' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->admin_since != null
            && $this->admin_since->lessThanOrEqualTo(now());
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    public function services()
    {
        return $this->hasManyThrough(Service::class, Booking::class, 'user_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function bookingOrders()
    {
        return $this->hasMany(BookingOrder::class, 'user_id');
    }

    public function enrollmentOrders()
    {
        return $this->hasMany(EnrollmentOrder::class, 'user_id');
    }

    public function payments() 
    {
        return $this->hasManyThrough(Payment::class, Order::class, 'customer_id'); // (Hacia donde quiero llegar, a traves de la clase:, foreign key)
    }

    public function getProfileImageAttribute()
    {
        if($this->image) {
            return "{$this->image->path}";
        }
        if ($this->avatar) {
            return "{$this->avatar}";
        }
        return 'https://es.gravatar.com/avatar?d=mp';
    }

}
