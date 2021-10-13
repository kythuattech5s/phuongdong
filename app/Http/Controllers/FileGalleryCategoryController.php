<?php
namespace App\Http\Controllers;
use App\Models\{FileGalleryCategory,FileGallery};
use \View;
use Illuminate\Http\Request;
use Carbon\Carbon;
class FileGalleryCategoryController extends Controller
{
	public function all($request, $route, $link)
	{
        $currentItem = $route;
		$listItems = FileGalleryCategory::act()->Ord()->paginate(12);
        $listHotItems = FileGallery::where('hot',1)->act()->get()->all();
		return View::make('file_gallery_categories.all',compact('currentItem','listItems','listHotItems'));	
	}
    public function view($request, $route, $link){
        $currentItem = FileGalleryCategory::slug($link)->act()->first();
        if ($currentItem == null) {
            abort(404);
        }
        $listItems = $currentItem->fileGallery()->act()->ord()->paginate(11);
        return view('file_gallery_categories.view', compact('currentItem','listItems'));
    }
}