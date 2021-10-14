<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\VideoGallery;
use App\Models\NewsCategory;
class NewsController extends Controller
{	
    public function view($request, $route, $link){
        $currentItem = News::slug($link)->with('ratings')->act()->first();
        if ($currentItem == null) { abort(404); }
        $currentItem->count_view = (int)$currentItem->count_view + 1;
        $currentItem->save();
        $parent = $currentItem->category()->act()->orderBy('id','desc')->first();
        $tags = $currentItem->tags()->act()->get()->all();
        $newsRelateds = $currentItem->getRelatesCollection()->all();
        $listIdNewSelect = explode(',',$currentItem->same_topic);
        array_push($listIdNewSelect,-1);
        $listNewsSelect = News::whereIn('id',$listIdNewSelect)->publish()->get()->all();
        $videoRelate = VideoGallery::find($currentItem->video_id);
        $dataContent = \Support::createdTocContent($currentItem->content);
        return view('news.view',compact('currentItem','tags','newsRelateds','parent','tags','dataContent','videoRelate','listNewsSelect'));
    }
}
