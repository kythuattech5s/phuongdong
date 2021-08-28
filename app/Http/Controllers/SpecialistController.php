<?php
namespace App\Http\Controllers;
use App\Models\{Specialist};
use \View;
use Illuminate\Http\Request;
use Carbon\Carbon;
class SpecialistController extends Controller
{
	public function all(Request $request, $link)
	{
		return View::make('specialists.all');	
	}
    public function view(Request $request, $link)
    {
    	
    }
}