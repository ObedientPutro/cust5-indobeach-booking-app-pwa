<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'tb_m_posts';

    protected $guard = ['id'];

    protected $casts = [
        'status' => PostStatus::class,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(PostImage::class, 'post_id');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'tb_tr_post_amenities', 'post_id', 'amenity_id')
                    ->withTimestamps();
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'post_id');
    }
}
