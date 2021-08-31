<?php
namespace App\Http\Controllers;
use App\Models\{Specialist,Doctor};
use \View;
use Illuminate\Http\Request;
use Carbon\Carbon;
class SpecialistController extends Controller
{
	public function all($request, $route, $link)
	{
        $currentItem = $route;
		$listItems = Specialist::act()->Ord()->paginate(12);
		return View::make('specialists.all',compact('currentItem','listItems'));	
	}
    public function view($request, $route, $link)
    {
    	$currentItem = Specialist::slug($link)->act()->first();
        if ($currentItem == null) { abort(404); }
        $listRelateDoctor = Doctor::where('specialist_id',$currentItem->id)->act()->get();
        return view('specialists.view',compact('currentItem','listRelateDoctor'));
    }
}