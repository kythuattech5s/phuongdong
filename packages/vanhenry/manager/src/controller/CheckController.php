<?php 
namespace vanhenry\manager\controller;
use vanhenry\manager\controller\BaseAdminController;
use Illuminate\Http\Request;
use App\Models\News;
use Auth;
use Session;
class CheckController extends BaseAdminController{
    public function editDone(Request $request, $id){
        $auth = Auth::guard('h_users')->user();
        $new = News::find($id);
        if($new->editing == $auth->id){
            News::whereId($id)->update(['editing'=> null]);
        }
    }

    public function checkEditing(Request $request, $id){
        $auth = Auth::guard('h_users')->user();
        $new = News::find($id);
        if(empty($new->editing) || $new->editing == $auth->id){
            News::whereId($id)->update(['editing'=> $auth->id]);
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
        $news = News::find($id);
        if(empty($news->editing)){
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
}

?>