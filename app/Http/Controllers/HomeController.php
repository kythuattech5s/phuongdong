<?php
namespace App\Http\Controllers;
use App\Models\{Banner,Partner,Services,Doctor,News};
use Illuminate\Http\Request;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function direction(Request $request, $link)
    {
        $lang  = \App::getLocale();
        $link  = \Support::getSegment($request, 1);
        $route = \DB::table('v_routes')->select('*')->where($lang.'_link', $link)->first();
        if ($route == null) {
            abort(404);
        }
        $controllers = explode('@', $route->controller);
        $controller = $controllers[0];
        $method = $controllers[1];
        return (new $controller)->$method($request, $route, $link);
    }
    public function index(){
        $listBanner = Banner::act()->Ord()->get();
        $listPartner = Partner::act()->get();
        $listService = Services::where('home',1)->act()->get();
        $listDoctor = Doctor::where('home',1)->act()->get();
        $listNews = News::where('home',1)->act()->publish()->take(7)->get()->all();
        return view('home',compact('listBanner','listPartner','listService','listDoctor','listNews'));
    }

    public function test(){
        $posts = \App\Models\News::act()->get();
        dd($posts);
    }
}