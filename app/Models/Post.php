<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'published',
        'user_id',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->hasOne(Category::class, 'post_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
    
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function getStatusAttribute()
    {
        return $this->published == '1'
            ? 'Publicado'
            : 'Borrador';
    }

    public function getQuantityAttribute()
    {
        $quantity = $this->comments->count();
        return $quantity;
    }
}
