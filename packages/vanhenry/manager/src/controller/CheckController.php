<?php 
namespace vanhenry\manager\controller;
use vanhenry\manager\controller\BaseAdminController;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsEditOnline;
use App\Models\HUserOnline;
use App\Events\HUserOnline as EventOnline;
use App\Models\NewsHistory;
use Auth;
use Session;
class CheckController extends BaseAdminController{
    public function editDone(Request $request, $id){
        $auth = Auth::guard('h_users')->user();
        $news_editing = NewsEditOnline::where('news_id', $id)->first();
        if($news_editing !== null && $news_editing->session_id == session()->getId() && $news_editing->h_user_id == $auth->id){
            $news_editing->delete();
        }
    }

    public function checkEditing(Request $request, $id){
        $auth = Auth::guard('h_users')->user();
        $new = News::find($id);
        $news_editing = NewsEditOnline::where('news_id', $id)->first();
        
        if ($news_editing == null) {
            $news_editing = new NewsEditOnline;
            $news_editing->news_id = $id;
            $news_editing->session_id = session()->getId();
            $news_editing->h_user_id = $auth->id;
            $news_editing->ip = request()->ip();
            $news_editing->tab_time = $request->tab_time;
            $news_editing->save();
        }elseif($news_editing !== null && $news_editing->session_id == session()->getId() && $news_editing->h_user_id == $auth->id && $news_editing->tab_time == $request->tab_time){
            $news_editing->updated_at = new \DateTime;
            $news_editing->save();
            return response()->json('ok');
        }else{
            Session::flash('typeNotify','danger');
            Session::flash('messageNotify','Bài viết đang có người chỉnh sửa');
            return response()->json([
                'code' => 100,
                'redirect_url' => url('esystem/view/news')
            ]);
        }
    }

    public function checkHasEdit(Request $request, $id){
        $date = new \DateTime;
        $news_editing = NewsEditOnline::where('news_id', $id)->first();
        if($news_editing == null || ($news_editing !== null && $news_editing->updated_at <= $date->modify('-8 seconds'))){
            if($news_editing !== null){
                $news_editing->delete();
            }
            return response()->json([
                'code' => 200
            ]);
        }else{
            return response()->json([
                'code' => 100,
                'message' => 'Đang có người sửa bài viết này'
            ]);
        }
    }

    

    public function saveContent(Request $request, $id){
        $user = Auth::guard('h_users')->user();
        $news = News::withoutGlobalScope('draft')->withoutGlobalScope('trash')->find($id);
        if($news !== null){
            NewsHistory::create([
                'h_user_id' => $user->id,
                'content_old' => $news->content,
                'content' => $request->content,
                'reason' => $request->reason ?? '',
                'news_id' => $id,
                'type' => $request->type,
                'created_at' => new \DateTime
            ]);
        }
    }


    public function userOnline(Request $request){
        HUserOnline::insertOrRemove($request);
        event(new EventOnline);
    }

    public function test(Request $request){
        return view('vh::view.test');
    }
}

?>