<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'tb_m_categories';

    protected $fillable = [
        'name',
        'icon_path'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'category_id');
    }
}
