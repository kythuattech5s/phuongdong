<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use Auth;
use Illuminate\Support\Facades\Cache as Cache;
use Carbon\Carbon;
use vanhenry\manager\model\HUser;
class HUserOnline extends BaseModel
{
    use HasFactory;

    public static function insertOrRemove($request){
        $user = Auth::guard('h_users')->user();
        $h_user_online = static::where('h_user_id', $user->id)->where('tab_session', $request->tab_session)->first();
        if ($request->action == 'ADD' && $h_user_online == null) {
            static::whereNull('tab_session')->delete();
            $h_user_online = new static;
            $h_user_online->h_user_id = $user->id;
            $h_user_online->tab_session = $request->tab_session;
            $h_user_online->doing = json_decode($request->doing);
            $h_user_online->save();
        }elseif($request->action == 'ADD' && $h_user_online !== null){
            $h_user_online->doing = json_decode($request->doing);
            $h_user_online->updated_at = new \DateTime;
            $h_user_online->save();
        }elseif($h_user_online !== null && $request->action == 'REMOVE'){
            $h_user_online->delete();
        }

        if(!Cache::has('TIME_CHECK_ONLINE')){
            $date = new \DateTime;
            static::where('updated_at','<=',$date->modify('-5 minutes'))->delete();
            $expiresAt = Carbon::now()->addMinutes(5);
            Cache::put('TIME_CHECK_ONLINE',$expiresAt, $expiresAt);
            static::whereNull('tab_session')->delete();
        }
    }

    public static function getAll(){
        $h_user_onlines = static::with('h_user:id,email,name')->get(['h_user_id','doing'])->toArray();
        return $h_user_onlines;
    }

    public function h_user(){
        return $this->belongsTo(HUser::class, 'h_user_id');
    }
}

?>