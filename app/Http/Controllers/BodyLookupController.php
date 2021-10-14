<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{BodyLookup};
class BodyLookupController extends Controller
{   
	public function all($request, $route, $link){
		$currentItem = $route;
		$listItems = BodyLookup::act()->select('name','slug')->get();
		$listHots = BodyLookup::act()->orderBy('count_view','desc')->take(15)->get();
		return view('lookup.all',compact('currentItem','listItems','listHots'));
	}
    public function view($request, $route, $link){
        $currentItem = BodyLookup::slug($link)->act()->first();
        if ($currentItem == null) { abort(404); }
        $currentItem->count_view = (int)$currentItem->count_view + 1;
        $currentItem->save();
        $dataContent = \Support::createdTocContent($currentItem->content);
        return view('lookup.view',compact('currentItem','dataContent'));
    }
}