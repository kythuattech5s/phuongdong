<?php
namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Partner;
use App\Models\ServiceCategory;
use App\Models\Doctor;
use App\Models\News;
use App\Models\ForCustomer;
use App\Models\Equipment;
use App\Models\RedirectLink;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Helpers\Utm;
use App\Helpers\TwoLevelSlug;

class HomeController extends Controller
{
    public function direction(Request $request, $link)
    {
        $lang  = \App::getLocale();
        $link  = \Support::getSegment($request, 1);
        $baseUrl = url()->to('');
        /* Check link chuyển hướng */
        $linkRedirect = RedirectLink::where('root_link', trim($_SERVER['REQUEST_URI'], '/'))->first();
        if (isset($linkRedirect) && (int)$linkRedirect->type) {
            return \Redirect::to($baseUrl.trim($linkRedirect->redirect_link, '/').'/', $linkRedirect->type);
        }
        /* End check link chuyển hướng */

        $listTableTwoLevelSlug = TwoLevelSlug::getArrTable();
        list($link, $tableAccess) = TwoLevelSlug::checkLinkSegmentBeforGetRoutest($link);
        $route = \DB::table('v_routes')->select('*')->where($lang.'_link', $link)->first();
        if ($route == null) {
            abort(404);
        }
        if (!($tableAccess == 'doctors' && $route->table == 'specialists')) {
            if (isset($tableAccess) && $route->is_static == 0 && $tableAccess != $route->table) {
                abort(404);
            }
        }
        if (!isset($tableAccess) && isset($listTableTwoLevelSlug[$route->table])) {
            return \Redirect::to($baseUrl.TwoLevelSlug::convertSlugRoutes($route, $link), 301);
        }

        /* Check link đuôi có dấu / */
        if (substr($_SERVER['REDIRECT_URL'], -1) != '/') {
            $newUrl = $baseUrl.$_SERVER['REDIRECT_URL'].'/'.($_SERVER['QUERY_STRING'] != '' ? '?'.$_SERVER['QUERY_STRING'] : '');
            return \Redirect::to($newUrl, 301);
        }
        /* End check link đuôi có dấu / */

        Utm::check();
        $controllers = explode('@', $route->controller);
        $controller = $controllers[0];
        $method = $controllers[1];
        return (new $controller)->$method($request, $route, $link);
    }
    public function index()
    {
        Utm::check();
        $listBanner = Banner::act()->where('time_show','>',new \DateTime())->where('time_public','<',new \DateTime())->Ord()->get();
        $listPartner = Partner::act()->get();
        $listService = ServiceCategory::where('home', 1)->act()->get();
        $listDoctor = Doctor::where('home', 1)->act()->get();
        $listNews = News::where('home', 1)->where('time_show_home', '>=', new \DateTime())->act()->publish()->orderBy('created_at', 'desc')->take(7)->get()->all();
        $listForcustomer = ForCustomer::act()->get();
        $listEquipment = Equipment::act()->get();
        return view('home', compact('listBanner', 'listPartner', 'listService', 'listDoctor', 'listNews', 'listForcustomer', 'listEquipment'));
    }
    public function test()
    {
        dd(session()->getId());
    }
}