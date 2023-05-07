<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Sluggable;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function post()
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }
}
