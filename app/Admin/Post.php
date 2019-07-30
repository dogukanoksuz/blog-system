<?php

namespace App\Admin;

use App\MediaLibrary\Image;
use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;


class Post extends Model
{
    use Sluggable;
    use HasTags;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumbnail_path'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'post_user');
    }

    public function isElementOfThisCategory($id)
    {
        foreach ($this->category()->get() as $categoryTable) {
            if ($categoryTable->id === $id) {
                return true;
            }
        }
        return false;
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'post_category');
    }

    public function image()
    {
        return $this->morphMany(Image::class, 'imageable');
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
