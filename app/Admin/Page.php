<?php

namespace App\Admin;

use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'content',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
