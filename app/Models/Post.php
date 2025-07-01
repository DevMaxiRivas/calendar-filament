<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'author',
        'status',
        'url_slug',
        'images_path',
    ];

    protected $casts = [
        'images_path' => 'array', // Assuming images_path is a JSON array of image paths
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
