<?php
namespace App\Http\Controllers;
use App\Models\{VideoGalleryCategory,VideoGallery};
use \View;
use Illuminate\Http\Request;
use Carbon\Carbon;
class VideoGalleryCategoryController extends Controller
{
	public function all($request, $route, $link)
	{
        $currentItem = $route;
		$listItems = VideoGalleryCategory::act()->Ord()->paginate(1);
        $listHotItems = VideoGallery::where('hot',1)->act()->get()->all();
		return View::make('video_gallery_categories.all',compact('currentItem','listItems','listHotItems'));	
	}
    public function view($request, $route, $link){
        $currentItem = VideoGalleryCategory::slug($link)->act()->first();
        if ($currentItem == null) {
            abort(404);
        }
        $listItems = $currentItem->videoGallery()->act()->ord()->paginate(11);
        return view('video_gallery_categories.view', compact('currentItem','listItems'));
    }
}