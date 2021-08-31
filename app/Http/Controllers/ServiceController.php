<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Services,ServiceCategory};
class ServiceController extends Controller
{	
    public function view($request, $route, $link){
        $currentItem = Services::slug($link)->act()->first();
        if ($currentItem == null) { abort(404); }
        $parent = $currentItem->category()->act()->first();
        return view('services.view',compact('currentItem','parent'));
    }
}