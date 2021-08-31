<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;

class HGroupUser extends BaseModel
{
    use HasFactory;

    public function getActions(){
        return $this->belongsToMany(HAction::class,'h_group_user_h_action','h_group_user_id','h_action_id');
    }
}

?>