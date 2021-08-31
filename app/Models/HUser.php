<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class HUser extends BaseModel
{
     use HasFactory;
     public function actions(){
          return $this->belongsto(HGroupUser::class)->with('getActions');
     }
}

?>