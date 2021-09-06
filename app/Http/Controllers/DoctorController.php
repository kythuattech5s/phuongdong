<?php
namespace App\Http\Controllers;
use App\Models\{Doctor,Specialist,News};
use \View;
use Illuminate\Http\Request;
use Carbon\Carbon;
class DoctorController extends Controller
{
	public function all($request, $route, $link)
	{
        $currentItem = $route;
        $listSpecialist = Specialist::act()->get();
        $mode = request()->segment(2);
        if (isset($mode) && $mode != '') {
            $specialist = Specialist::slug($mode)->act()->first();
            if ($specialist == null) { abort(404); }
            $listItems = Doctor::where('specialist_id',$specialist->id)->act()->Ord()->paginate(12);
            return View::make('doctors.all_sub',compact('listItems','listSpecialist','specialist')); 
        }
		$listItems = Doctor::act()->Ord()->paginate(12);
		return View::make('doctors.all',compact('currentItem','listItems','listSpecialist'));	
	}
    public function view($request, $route, $link)
    {
    	$currentItem = Doctor::slug($link)->act()->first();
        if ($currentItem == null) { abort(404); }
        $listRelateDoctor = Doctor::where('specialist_id',$currentItem->specialist_id)->where('id','!=',$currentItem->id)->act()->get();
        $specialists = Specialist::find($currentItem->specialist_id);
        $listNews = News::where('doctor_id',$currentItem->id)->act()->publish()->get()->all();
        return view('doctors.view',compact('currentItem','specialists','listRelateDoctor','listNews'));
    }
}