<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{NewsCategory,News};
use Support;

class NewsCategoryController extends Controller
{
    public function all($request, $route, $link)
    {
        $currentItem = $route;
        $listCateChild = NewsCategory::act()->ord()->get()->all();
        return view('news_categories.all',compact('currentItem','listCateChild')); 
    }
    public function view($request, $route, $link){
        $currentItem = NewsCategory::slug($link)->act()->first();
        if ($currentItem == null) {
            abort(404);
        }
        $listCateChild = NewsCategory::where('parent',$currentItem->id)->act()->get();
        $listCateChildShow = NewsCategory::where('parent',$currentItem->id)->act()->Ord()->get();
        $listItems = $currentItem->news()->act()->orderBy('time_published','desc')->paginate(12);
        return view('news_categories.view', compact('currentItem','listItems','listCateChild','listCateChildShow'));
    }
}
