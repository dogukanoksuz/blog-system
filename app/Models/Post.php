<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'thumbnail_path',
        'seo_description',
    ];

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

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function syncTags(array $tags)
    {
        $tags = array_map(function ($tag) {
            return Tag::firstOrCreate([
                'name' => $tag,
                'slug' => Str::slug($tag),
            ])->id;
        }, $tags);

        $this->tags()->sync($tags);
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
