<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'value'
    ];
}
