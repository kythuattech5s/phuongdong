<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use vanhenry\manager\model\HUser;
class NewsHistory extends Model
{
    use HasFactory;

    public function news(){
        return $this->belongsTo(News::class,'news_id');
    }

    public function h_users(){
        return $this->belongsTo(HUser::class, 'h_user_id');
    }
}
