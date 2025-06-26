<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'tb_tr_bookings';

    protected $fillable = [
        'post_id',
        'user_id',
        'start_date',
        'end_date',
        'total_price',
        'payment_image_path',
        'status',
    ];

    protected $casts = [
        'status' => BookingStatus::class,
    ];

    protected $appends = [
        'status_info'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function statusInfo(): Attribute
    {
        return Attribute::make(
            get: fn () => [
                'label' => $this->status->getLabel(),
                'color_class' => $this->status->getColorClass(),
            ],
        );
    }
}
