<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;

    protected $table = 'tb_m_amenities';

    protected $guard = ['id'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'tb_tr_post_amenities', 'amenity_id', 'post_id')
                    ->withTimestamps();
    }
}
