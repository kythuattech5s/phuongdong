<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{QuestionCategory,Question,Doctor};
class QuestionController extends Controller
{	
    public function view($request, $route, $link){
        $currentItem = Question::slug($link)->act()->first();
        if ($currentItem == null) { abort(404); }
        $parent = $currentItem->category()->act()->first();
        $questionRelateds = $currentItem->getRelatesCollection()->all();
        $doctor = Doctor::find($currentItem->doctor_id);
        return view('question.view',compact('currentItem','parent','questionRelateds','doctor'));
    }
}