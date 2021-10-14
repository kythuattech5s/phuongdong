<?php
namespace App\Http\Controllers;
use App\Models\{Services,ServiceCategory,News,VideoGallery};
use \View;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ServiceCategoryController extends Controller
{
	public function all($request, $route, $link)
	{
        $currentItem = $route;
		$listItems = ServiceCategory::act()->where('parent',0)->Ord()->paginate(12);
		return View::make('service_categories.all',compact('currentItem','listItems'));	
	}
    public function view($request, $route, $link){
        $currentItem = ServiceCategory::slug($link)->act()->first();
        if ($currentItem == null) {
            abort(404);
        }
        $currentItem->count_view = (int)$currentItem->count_view + 1;
        $currentItem->save();
        $dataContent = \Support::createdTocContent($currentItem->content);
        $listItems = $currentItem->services()->act()->ord()->paginate(12);
        $listCateChild = ServiceCategory::act()->where('parent',$currentItem->id)->Ord()->get();
        $arrRelateNewId = explode(',', $currentItem->list_news);
        $listNews = [];
        if (count($arrRelateNewId) > 0) {
            $listNews = News::whereIn('id',$arrRelateNewId)->act()->publish()->get()->all();
        }
        $videoIntro = VideoGallery::find($currentItem->video_intro);
        return view('service_categories.view', compact('currentItem','listItems','listCateChild','dataContent','listNews','videoIntro'));
    }
}