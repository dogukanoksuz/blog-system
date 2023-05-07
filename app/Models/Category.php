<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug',
    ];

    public function post()
    {
        return $this->belongsToMany(Post::class, 'post_category');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
}
