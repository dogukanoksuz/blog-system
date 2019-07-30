<?php

namespace App\MediaLibrary;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['name', 'imageable_id', 'imageable_type'];
}
