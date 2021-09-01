<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Helpers\MediaHelper;
use App\Models\Rating;
use Auth;
class CommentController extends Controller{
    public function ratingNow(Request $request){
        $this->addRating($request);
        return response()->json([
            'code' => 200,
            'message'=> "Đánh giá bài viết thành công"
        ]);
    }
    
    public function commentNow(Request $request){
        if(!Auth::check()){
            return response([
                'code' => 100,
                'message' => 'Vui lòng đăng nhập',
                'redirect_url' => url('dang-nhap')
            ]);
        }
        return $this->addComment($request);
    }

    public function repCommentNow(Request $request){
        if(!Auth::check()){
            return response([
                'code' => 100,
                'message' => 'Vui lòng đăng nhập',
                'redirect_url' => url('dang-nhap')
            ]);
        }
        $this->addComment($request,false);

        return response()->json([
            'code' => 200,
            'message' => 'Trả lời thành công'
        ]);
    }

    private function addComment($request, $isFetch = true){
        \DB::beginTransaction();
        try{
            $comment = new Comment;
            $comment->user_id = Auth::id();
            $comment->email = Auth::user()->email;
            $comment->content = $request->content;
            $comment->map_table = $request->map_table;
            $comment->map_id = $request->map_id;
            $comment->parent = isset($request->parent) ? $request->parent : 0;
            $comment->act = 0;
            $comment->imgs = isset($request->img) ? MediaHelper::uploadImgs('binh-luan','img') : '';
            $comment->save();
    
            if(isset($request->rate)){
                $this->addRating($request->rate, $comment);
            }
            \DB::commit();
            
            if($isFetch){
                return $this->fetchComment($request->map_table, $request->map_id);
            }
            return false;
        }catch(\Exception $err){
            \DB::rollback();
            return response([
                'code' => 100,
                'message' => $err->getMessage()
            ]);
        }
    }

    
    private function addRating($request,$user = null,  $comment = null){
        $rating = new Rating;
        $rating->map_table = $request->map_table;
        $rating->map_id = $request->map_id;
        if($user !== null){
            $rating->user_id = $comment->user_id;
        }
        if($comment !== null){
            $rating->comment_id = $comment->id;
        }
        $rating->rating = $request->rate;
        $rating->save();
    }

    private function fetchComment($map_table, $map_id){
        $comments = Comment::with(['childs'])->where('map_table',$map_table)->where('map_id',$map_id)->where('act',1)->paginate(5);
        $html = view('path.comment',compact('comments'))->render();
        return response([
            'code' => 200,
            'html' => $html
        ]);
    }

    public function fetchCommentChild(Request $request){
        $childs = Comment::with(['childs'])->where('parent', $request->parent_id)->where('act', 1)->paginate(5);
        $html = view('path.comment_child',compact('childs'))->render();
        return response([
            'code' => 200,
            'html' => $html,
            'lastPage' => $childs->lastPage()
        ]);
    }

    public function fetchCommentMore(Request $request){
        $comments = Comment::with(['childs'])->where('map_table',$request->map_table)->where('map_id',$request->map_id)->where('act',1)->paginate(5);
        $html = view('path.comment',compact('comments'))->render();
        return response([
            'code' => 200,
            'html' => $html,
            'lastPage' => $comments->lastPage()
        ]);
    }
}