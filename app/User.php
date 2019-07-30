<?php

namespace App;

use App\Admin\Page;
use App\Admin\Post;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function page()
    {
        return $this->belongsToMany(Page::class, 'page_user');
    }

    public function post()
    {
        return $this->belongsToMany(Post::class, 'post_user');
    }

    public function roles()
    {
        return $this->belongsToMany('App\User\Role', 'role_user');
    }

    public function doesHavePermission($role) :bool
    {
        foreach ($this->roles()->get() as $roleTable) {
            if ($roleTable->name === $role) {
                return true;
            }
        }
        return false;
    }

}
