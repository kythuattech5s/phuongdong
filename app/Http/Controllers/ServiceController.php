<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Services,ServiceCategory,News,VideoGallery};
class ServiceController extends Controller
{	
    public function view($request, $route, $link){
        $currentItem = Services::slug($link)->act()->first();
        if ($currentItem == null) { abort(404); }
        $parent = $currentItem->category()->act()->first();
        $dataContent = \Support::createdTocContent($currentItem->content);
        $arrRelateNewId = explode(',', $currentItem->list_news);
        $listNews = [];
        if (count($arrRelateNewId) > 0) {
        	$listNews = News::whereIn('id',$arrRelateNewId)->act()->publish()->get()->all();
        }
        $videoIntro = VideoGallery::find($currentItem->video_intro);
        return view('services.view',compact('currentItem','parent','dataContent','listNews','videoIntro'));
    }
}