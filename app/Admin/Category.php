<?php

namespace App\Admin;

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

    public function isElementOfCategory($id)
    {
        foreach ($this->post()->get() as $postTable) {
            if ($postTable->id === $id) {
                return true;
            }
        }
        return false;
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
