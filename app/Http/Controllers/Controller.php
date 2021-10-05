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
        $listTimePick = \App\Models\TimePick::get();
        $listDoctor = \App\Models\Doctor::act()->get();
        $listService = \App\Models\ServiceCategory::act()->get();
        $listSpecialist = \App\Models\Specialist::act()->get();
        $itemFlashNotifcation = \App\Models\FlashNotification::act()->get()->first();
        \View::share('listTimePick', $listTimePick);
        \View::share('itemFlashNotifcation', $itemFlashNotifcation);
        \View::share('listDoctor', $listDoctor);
        \View::share('listService', $listService);
        \View::share('listSpecialist', $listSpecialist);
    }
}