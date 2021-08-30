<?php
namespace App\Http\Controllers;
use App\Models\{Services,ServiceCategory};
use \View;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ServiceCategoryController extends Controller
{
	public function all($request, $route, $link)
	{
        $currentItem = $route;
		$listItems = ServiceCategory::act()->Ord()->paginate(12);
		return View::make('service_categories.all',compact('currentItem','listItems'));	
	}
    public function view($request, $route, $link){
        $currentItem = ServiceCategory::slug($link)->act()->first();
        if ($currentItem == null) {
            abort(404);
        }
        $listItems = $currentItem->services()->act()->ord()->paginate(12);
        return view('service_categories.view', compact('currentItem','listItems'));
    }
}