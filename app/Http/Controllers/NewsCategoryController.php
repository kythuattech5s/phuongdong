<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{NewsCategory,News};
use Support;

class NewsCategoryController extends Controller
{
    public function view($request, $route, $link){
        $currentItem = NewsCategory::slug($link)->act()->first();
        if ($currentItem == null) {
            abort(404);
        }
        $listCateChild = NewsCategory::where('parent',$currentItem->id)->act()->get();
        $listCateChildShow = NewsCategory::where('parent',$currentItem->id)->act()->Ord()->take(5)->get();
        $listItems = $currentItem->news()->act()->ord()->paginate(10);
        $hotItems = News::act()->where('hot',1)->limit(4)->orderBy('id','desc')->get()->all();
        return view('news_categories.view', compact('currentItem','listItems','listCateChild','listCateChildShow'));
    }
}
