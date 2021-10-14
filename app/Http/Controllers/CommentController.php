<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Helpers\MediaHelper;
use App\Models\Rating;
use App\Models\LikeComment;
use App\Models\Order;
use Auth;

class CommentController extends Controller
{
    public function commentNow(Request $request)
    {
        return $this->addComment($request, 'parent');
    }

    // RATING
    public function ratingNow(Request $request)
    {
        $this->addRating($request);
        return response()->json([
            'code' => 200,
            'message'=> "Đánh giá bài viết thành công"
        ]);
    }


    // COMMENT
    public function repCommentNow(Request $request)
    {
        return $this->addComment($request, 'child');
    }
    
    // ADDCOMMENT
    private function addComment($request, $type = 'parent')
    {
        \DB::beginTransaction();
        try {
            $comment = new Comment;
            $comment->content = $this->strip_all_tags($request->content);
            $comment->map_table = $request->map_table;
            $comment->map_id = $request->map_id;
            $comment->email = $request->email;
            $comment->phone = $request->phone;
            $comment->name = $request->name;
            $comment->parent = isset($request->parent) ? $request->parent : null;
            $comment->imgs = isset($request->img) ? MediaHelper::uploadImgs('binh-luan', 'img') : '';
            $comment->save();
    
            if (isset($request->rate)) {
                $this->addRating($request, $user, $comment);
            }
            \DB::commit();
            if (isset($request->order_id)) {
                return $this->fetchCommentOrder($request);
            }
            return $this->fetchItem($comment, $type);
        } catch (\Exception $err) {
            \DB::rollback();
            return response([
                'code' => 100,
                'message' => $err->getMessage()
            ]);
        }
    }

    // ADD RATING
    private function addRating($request, $user = null, $comment = null)
    {
        $rating = new Rating;
        $rating->map_table = $request->map_table;
        $rating->map_id = $request->map_id;
        if ($user !== null) {
            $rating->user_id = $comment->user_id;
        }
        if ($comment !== null) {
            $rating->comment_id = $comment->id;
        }
        $rating->rating = $request->rate;
        $rating->save();
    }

    // FRESH ITEM
    private function fetchItem($comment, $type = 'parent')
    {
        if ($comment->act == 1) {
            if ($type == 'parent') {
                $html = view('path.item_comment', compact('comment'))->render();
                return response([
                    'code' => 200,
                    'message' => 'Bình luận thành công',
                    'html' => $html
                ]);
            } else {
                $html = view('path.item_comment_child', compact('comment'))->render();
                return response([
                    'code' => 200,
                    'message' => 'Trả lời bình luận thành công',
                    'html' => $html
                ]);
            }
        } else {
            if ($type == 'parent') {
                return response([
                    'code' => 200,
                    'message' => 'Bình luận thành công',
                ]);
            } else {
                return response([
                    'code' => 200,
                    'message' => 'Trả lời bình luận thành công',
                ]);
            }
        }
    }
    // REFRESH COMMENT
    private function fetchComment($map_table, $map_id)
    {
        $comments = Comment::with(['childs'])->where('map_table', $map_table)->where('map_id', $map_id)->where('act', 1)->paginate(5);
        $html = view('path.comment', compact('comments'))->render();
        return response([
           'message' => 'Bình luận thành công',
           'code' => 200,
           'html' => $html,
           'lastPage' => $comments->lastPage()
        ]);
    }

    // FETCH COMMENT ORDER
    private function fetchCommentOrder($request)
    {
        $order = Order::with(['comments','orderProducts'=>function ($q) {
            $q->with('product');
        }])->where('user_id', Auth::id())->where('id', $request->order_id)->first();
        $order->time_rating_order = new \DateTime;
        $order->save();
        $html = view('ajax.rating', compact('order'))->render();

        return response([
            'code' => 200,
            'html' => $html,
            'message' => "Bình luận thành công"
        ]);
    }

    // LOADMORE COMMENT CHILD
    public function fetchCommentChild(Request $request)
    {
        $childs = Comment::with(['childs'])->where('parent', $request->parent_id)->where('act', 1)->paginate(5);
        $html = view('path.comment_child', compact('childs'))->render();
        return response([
            'code' => 200,
            'html' => $html,
            'lastPage' => $childs->lastPage()
        ]);
    }

    // LOADMORE COMMENT PARENT
    public function fetchCommentMore(Request $request)
    {
        $comments = Comment::with(['childs'])->whereNull('parent')->where('map_table', $request->map_table)->where('map_id', $request->map_id)->where('act', 1);
        if (isset($request->filter)) {
            $comments = $this->filter($comments);
        } else {
            $comments = $comments->paginate(5);
        }

        return $this->renderComment($comments);
    }

    // FILLTER RATING
    public function filterRating(Request $request)
    {
        $comments = Comment::with(['childs'])->where('map_table', $request->map_table)->where('map_id', $request->map_id)->where('act', 1);
        $comments = $this->filter($comments);

        return $this->renderComment($comments);
    }

    private function filter($comments)
    {
        $request = request();
        if (in_array($request->filter, [1,2,3,4,5])) {
            $comments->whereHas('rating', function ($q) use ($request) {
                $q->where('rating', $request->filter);
            });
        }
        if ($request->filter == 6) {
            $users = Order::whereHas('orderProducts', function ($q) use ($request) {
                $q->where('product_id', $request->map_id);
            })->whereIn('status', [\OrderSupport::STATUS_SUCCESS,\OrderSupport::STATUS_RATING])->pluck('user_id');
            $comments->whereIn('user_id', $users);
        }

        if ($request->filter == 7) {
            $comments->where(function ($q) {
                $q->whereNotNull('imgs')->where('imgs', '<>', '');
            });
        }

        if ($request->filter == 8) {
            $comments->orderBy('id', 'DESC');
        }

        return $comments->paginate(5);
    }

    private function renderComment($comments)
    {
        $html = view('path.comment', compact('comments'))->render();
        return response([
            'code' => 200,
            'html' => $html,
            'lastPage' => $comments->lastPage()
        ]);
    }

    public function likeAndUnlike(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'code' => 100,
                'message' => 'Vui lòng đăng nhập để thực hiện hành động này'
            ]);
        }

        $like = LikeComment::where('comment_id', $request->id)->where('user_id', Auth::id())->first();
        if ($like == null) {
            $like == LikeComment::create([
                'comment_id' => $request->id,
                'user_id' => Auth::id()
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Thích bình luận thành công'
            ]);
        } else {
            $like->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Đã bỏ thích bình luận'
            ]);
        }
    }

    // FIX ERROR SCRIPT TAGS
    protected function strip_all_tags($string, $remove_breaks = false)
    {
        $string = preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si', '', $string);
$string = strip_tags($string);

if ($remove_breaks) {
$string = preg_replace('/[\r\n\t ]+/', ' ', $string);
}

return trim($string);
}
}