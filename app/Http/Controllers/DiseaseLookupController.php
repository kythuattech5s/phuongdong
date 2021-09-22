<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{DiseaseLookup};
class DiseaseLookupController extends Controller
{   
	public function all($request, $route, $link){
		$currentItem = $route;
		$listItems = DiseaseLookup::act()->select('name','slug')->get();
		$listHots = DiseaseLookup::act()->orderBy('count_view','desc')->take(15)->get();
		return view('lookup.all',compact('currentItem','listItems','listHots'));
	}
    public function view($request, $route, $link){
        $currentItem = DiseaseLookup::slug($link)->act()->first();
        if ($currentItem == null) { abort(404); }
        $currentItem->count_view = $currentItem->count_view + 1;
        $currentItem->save();
        return view('lookup.view',compact('currentItem'));
    }
}