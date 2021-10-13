<?php
namespace App\Http\Controllers;
use App\Models\{Specialist,SpecialistCategory,Doctor};
use \View;
use Illuminate\Http\Request;
use Carbon\Carbon;
class SpecialistCategoryController extends Controller
{
    public function view($request, $route, $link)
    {
        $currentItem = SpecialistCategory::slug($link)->act()->first();
        if ($currentItem == null) {
            abort(404);
        }
        $listItems = Specialist::where('parent',$currentItem->id)->act()->Ord()->paginate(12);
        return View::make('specialists.view_cate',compact('currentItem','listItems'));
    }
}