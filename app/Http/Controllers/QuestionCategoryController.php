<?php
namespace App\Http\Controllers;
use App\Models\{QuestionCategory,Question};
use \View;
use Illuminate\Http\Request;
use Carbon\Carbon;
class QuestionCategoryController extends Controller
{
	public function all($request, $route, $link)
	{
        $currentItem = $route;
		$listItems = Question::act()->Ord()->paginate(12);
		return View::make('question_categories.all',compact('currentItem','listItems'));	
	}
    public function view($request, $route, $link)
    {
    	$currentItem = QuestionCategory::slug($link)->act()->first();
        if ($currentItem == null) { abort(404); }
        $listItems = $currentItem->question()->act()->orderBy('time_ask','desc')->paginate(12);
        return view('question_categories.view',compact('currentItem','listItems'));
    }
}