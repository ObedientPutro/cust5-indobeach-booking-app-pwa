<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostAmenity extends Model
{
    use HasFactory;

    protected $table = 'tb_tr_post_amenities';

    protected $fillable = [
        'post_id',
        'amenity_id',
    ];
}
