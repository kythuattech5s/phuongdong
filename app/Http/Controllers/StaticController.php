<?php
namespace App\Http\Controllers;
use App\Models\{Banner,Partner};
use Illuminate\Http\Request;
use Carbon\Carbon;
use \View;
class StaticController extends Controller
{
    public function contact($request, $route, $link)
    {
    	$currentItem = $route;
    	return View::make('static.contact',compact('currentItem'));
    }
}