<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Services;
use App\Models\Settings;
use App\Models\UserServices;
use Illuminate\Http\Request;
use App\Models\StandartPages;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct(Request $request)
    {
        try {
            if (Auth::check() == true && !empty(Auth::user()) && Auth::user()->is_admin == false) {

                $services = UserServices::where('user_id', Auth::user()->id)
                    ->join('services', 'services.id', '=', 'user_services.service_id')
                    ->orderBy('services.id')
                    ->select('user_services.*')
                    ->whereNull('services.top_id')
                    ->where('services.showondashboard', false)
                    ->with('service', 'user')
                    ->get();
            } else {
                $services = [];
            }

            View::share([
                "services" => $services,
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        } finally {
            Helper::dbdeactive();
        }
    }
}
