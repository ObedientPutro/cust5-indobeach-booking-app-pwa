<?php

namespace App\Models;

use App\Enums\BookingStatus;
use App\Enums\PostStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'tb_m_posts';

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'price',
        'quantity',
        'status',
    ];

    protected $casts = [
        'status' => PostStatus::class,
    ];

    protected $appends = [
        'quantity_left'
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

    /**
     * Accessor untuk menghitung sisa kuantitas yang tersedia HARI INI.
     */
    protected function quantityLeft(): Attribute
    {
        return Attribute::make(
            get: function () {
                $today = Carbon::today();

                $activeBookingsCount = $this->bookings()
                    ->whereIn('status', [
                        BookingStatus::Confirmed,
                        BookingStatus::Completed,
                        BookingStatus::WaitingPaymentConfirmation,
                        BookingStatus::Payment,
                    ])
                    ->where('start_date', '<=', $today)
                    ->where('end_date', '>=', $today)
                    ->count();

                return $this->quantity - $activeBookingsCount;
            }
        );
    }
}
