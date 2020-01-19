<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Role;
use App\Post;
use App\Comment;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function roles(){
      return $this->belongsToMany('App\Role');
    }

    public function posts(){
      return $this->hasMany("App\Post");
    }

    public function comments(){
      return $this->hasMany("App\Comment");
    }

    public function hasAnyRoles($roles){
   return null !== $this->roles()->whereIn('name', $roles)->first();
 }

 public function hasAnyRole($role){
   return null !== $this->roles()->where('name', $role)->first();
 }
}
