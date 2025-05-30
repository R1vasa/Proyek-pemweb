<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'post_id'];
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class);
    }
}
