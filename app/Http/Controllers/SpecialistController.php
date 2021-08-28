<?php
namespace App\Http\Controllers;
use App\Models\{Specialist};
use \View;
use Illuminate\Http\Request;
use Carbon\Carbon;
class SpecialistController extends Controller
{
	public function all($request, $route, $link)
	{
		$listItems = Specialist::act()->Ord()->paginate(1);
		return View::make('specialists.all',compact('listItems'));	
	}
    public function view($request, $route, $link)
    {
    	$currentItem = Specialist::slug($link)->act()->first();
        if ($currentItem == null) { abort(404); }
        return view('specialists.view',compact('currentItem'));
    }
}