<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Helper;
use App\Models\Settings;
use App\Models\UserServices;
use Illuminate\Http\Request;
use App\Models\Notifications;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RoutesController extends Controller
{
    public function index()
    {
        try {
            $services_home = UserServices::where('user_id', Auth::user()->id)
                ->join('services', 'services.id', '=', 'user_services.service_id')
                ->orderBy('services.id')
                ->select('user_services.*')
                ->whereNull('services.top_id')
                ->where('services.showondashboard', true)
                ->with('service', 'user')
                ->get();


            return view('welcome', compact('services_home'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }
    public function login()
    {
        try {
            return view('auth.login');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }
    public function password_change(Request $request)
    {
        try {
            $tokenData = DB::table('password_resets')
                ->where('email', $request->email)->where('token', $request->token)->latest()->first();
            if (!empty($tokenData)) {
                return view('auth.changepassword', compact('tokenData'));
            } else {
                return view('auth.login');
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }finally {
            Helper::dbdeactive();
        }
    }
    public function fallback()
    {
        try {
            return view('pages.fallback');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }
    public function notifications()
    {
        try {
            return view('notifications.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }
    public function notification($id)
    {
        try {
            $data = Notifications::where('id', $id)->first();
            if ($data->status == false) {
                $data->update(['status' => true]);
            }
            return view('notifications.show', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }
    public function settings()
    {
        try {
            $role = "default";
            $setting = null;
            if (Auth::user()->hasRole('admin')) {
                $role = "admin";
                $setting = setting();
            }
            return view("pages.settings", compact('role', 'setting'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }
    public function profile()
    {
        try {
            $data = users(Auth::user()->id);
            return view('auth.profile', compact('data'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }finally {
            Helper::dbdeactive();
        }
    }
    public function forgetpassword()
    {
        try {
            return view('auth.forgetpassword');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }
}
