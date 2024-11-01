<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}