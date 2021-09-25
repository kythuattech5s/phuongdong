<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function childs(){
        return $this->hasMany(Comment::class,'parent')->where('act',1);
    }

    public function rating(){
        return $this->hasOne(Rating::class,'comment_id');
    }

    public function news(){
        return $this->belongsTo(News::class, 'map_id');
    }
}
