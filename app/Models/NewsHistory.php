<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use vanhenry\manager\model\HUser;
class NewsHistory extends Model
{   
    protected $fillable = ['content_old','content','news_id','created_at','updated_at','type','h_user_id','reason'];
    
    use HasFactory;

    public function news(){
        return $this->belongsTo(News::class,'news_id');
    }

    public function h_users(){
        return $this->belongsTo(HUser::class, 'h_user_id');
    }
}
