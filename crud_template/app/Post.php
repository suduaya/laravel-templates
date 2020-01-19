<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;

class Post extends Model
{
  protected $fillabel = ['title', 'text'];



  public function user(){
    return $this->belongsTo("App\User");
  }

  public function comments(){
    return $this->hasMany("App\Comment");
  }
}
