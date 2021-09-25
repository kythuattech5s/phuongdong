<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{QuestionCategory,Question,Doctor};
class QuestionController extends Controller
{	
    public function view($request, $route, $link){
        $currentItem = Question::slug($link)->with(['comments'])->act()->first();
        if ($currentItem == null) { abort(404); }
        $parent = $currentItem->category()->act()->first();
        $questionRelateds = $currentItem->getRelatesCollection()->all();
        $doctor = Doctor::find($currentItem->doctor_id);
        $comments = $currentItem->comments()->with('childs')->paginate(5);
        return view('question.view',compact('currentItem','parent','questionRelateds','doctor','comments'));
    }
}