<?php



namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Foundation\Bus\DispatchesJobs;

use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $listTimePickAll = \App\Models\TimePick::get();
        $listDoctorAll = \App\Models\Doctor::act()->get();
        $listServiceAll = \App\Models\ServiceCategory::act()->get();
        $listSpecialistAll = \App\Models\Specialist::act()->get();
        $itemFlashNotifcation = \App\Models\FlashNotification::act()->get()->first();

        \View::share('listTimePickAll', $listTimePickAll);
        \View::share('itemFlashNotifcation', $itemFlashNotifcation);
        \View::share('listDoctorAll', $listDoctorAll);
        \View::share('listServiceAll', $listServiceAll);
        \View::share('listSpecialistAll', $listSpecialistAll);

        if (in_array(request()->ip(), ['42.118.11.7','113.23.54.4','42.112.239.28','8.30.234.25','14.160.24.158'])) {
            \Debugbar::enable();
        } else {
            \Debugbar::disable();
        }
    }
}