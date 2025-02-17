<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'tb_m_images';

    protected $guard = ['id'];

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
}
