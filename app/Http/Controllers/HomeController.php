<?php
namespace App\Http\Controllers;
use App\Models\{Banner,Partner,Services,Doctor,News,ForCustomer,Equipment};
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Helpers\Utm;
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
        $currentUrl = $request->getPathInfo();
        if ($currentUrl == '/'.$link) {
            $redirectLink = str_replace($currentUrl,$currentUrl.'/',$_SERVER['REQUEST_URI']);
            // return redirect($redirectLink);
        }
        Utm::check();
        $controllers = explode('@', $route->controller);
        $controller = $controllers[0];
        $method = $controllers[1];
        return (new $controller)->$method($request, $route, $link);
    }
    public function index(){
        Utm::check();
        $listBanner = Banner::act()->Ord()->get();
        $listPartner = Partner::act()->get();
        $listService = Services::where('home',1)->act()->get();
        $listDoctor = Doctor::where('home',1)->act()->get();
        $listNews = News::where('home',1)->where('time_show_home','>=',new \DateTime())->act()->publish()->take(7)->get()->all();
        $listForcustomer = ForCustomer::act()->get();
        $listEquipment = Equipment::act()->get();
        return view('home',compact('listBanner','listPartner','listService','listDoctor','listNews','listForcustomer','listEquipment'));
    }

    public function test(){
        $posts = \App\Models\News::act()->get();
        dd($posts);
    }
}