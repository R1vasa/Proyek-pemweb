<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use hasfactory;
    protected $fillable = [
        'user_id',
        'img_content',
        'content',
    ];
  
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }


    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }
}
