<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Payments;
use App\Models\Services;
use App\Jobs\SendEmailJob;
use App\Models\UserDevices;
use Illuminate\Support\Str;
use App\Models\UserServices;
use Illuminate\Http\Request;
use App\Models\UserAdditionals;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Password;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('users.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $services_a = Services::orderBy('order_a', 'DESC')->whereNull('top_id')->get();
            return view('users.create_edit', compact('services_a'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $profile_picture = "";
            $company_logo = "";

            if ($request->hasFile("company_logo")) {
                $company_logo = "Company-" . time() . '.' . $request->file("company_logo")->extension();
                $request->file("company_logo")->storeAs('useradditionals', $company_logo, 'uploads');
            }

            if ($request->hasFile("profile_picture")) {
                $profile_picture = "Profil-" . time() . '.' . $request->file("profile_picture")->extension();
                $request->file("profile_picture")->storeAs('useradditionals', $profile_picture, 'uploads');
            }

            $data = new User();
            $data->name_surname = $request->name_surname;
            $data->fin_code = $request->fin_code;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->password = bcrypt($request->original_password);
            $data->status = $request->status;
            $data->profile_picture = $profile_picture;
            $data->service_prices = ['monthly' => $request->service_price_monthly ?? 0, 'yearly' => $request->service_price_yearly ?? 0];
            $data->save();

            $additional = new UserAdditionals();
            $additional->company_name = $request->company_name;
            $additional->company_voen = $request->company_voen;
            $additional->original_password = $request->original_password;
            $additional->company_description = $request->company_description;
            $additional->company_logo = $company_logo;
            $additional->user_id = $data->id;
            $additional->company_owner_name = $request->company_owner_name ?? $request->name_surname;
            $additional->company_legal_owner = $request->company_legal_owner ?? $request->name_surname;
            $additional->company_version = $request->company_version ?? 'mmc';
            $additional->activity_area = $request->activity_area ?? null;
            $additional->registry_date = $request->registry_date ?? null;
            $additional->save();

            if (isset($request->services) && !empty($request->services)) {
                foreach ($request->services as $service) {
                    $userservice = new UserServices();
                    $userservice->user_id = $data->id;
                    $userservice->service_id = $service;
                    $userservice->save();
                }
            }
            Cache::flush();
            return redirect(route('users.index'))->with('success', trans('additional.messages.added'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = users($id);
            return view('users.show', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $services_a = Services::orderBy('order_a', 'DESC')->whereNull('top_id')->get();
            $data = users($id);
            $payments = Payments::where("user_id", $data->id)->orderBy('id', 'DESC')->get();
            return view('users.create_edit', compact('services_a', 'data', 'payments'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = users($id);

            $profile_picture = $data->profile_picture ?? null;
            $company_logo = $data->additionalinfo->company_logo ?? null;

            if ($request->hasFile("company_logo")) {
                $company_logo = "Company-" . time() . '.' . $request->file("company_logo")->extension();
                $request->file("company_logo")->storeAs('useradditionals', $company_logo, 'uploads');
            }

            if ($request->hasFile("profile_picture")) {
                $profile_picture = "Profil-" . time() . '.' . $request->file("profile_picture")->extension();
                $request->file("profile_picture")->storeAs('useradditionals', $profile_picture, 'uploads');
            }

            $data->name_surname = $request->name_surname;
            $data->fin_code = $request->fin_code;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->password = bcrypt($request->original_password);
            $data->status = $request->status;
            $data->profile_picture = $profile_picture;
            $data->service_prices = ['monthly' => $request->service_price_monthly ?? 0, 'yearly' => $request->service_price_yearly ?? 0];
            $data->update();

            $additional = UserAdditionals::where('user_id', $data->id)->first();
            $additional->company_name = $request->company_name;
            $additional->company_voen = $request->company_voen;
            $additional->original_password = $request->original_password;
            $additional->company_description = $request->company_description;
            $additional->company_logo = $company_logo;
            $additional->company_owner_name = $request->company_owner_name ?? $request->name_surname;
            $additional->company_legal_owner = $request->company_legal_owner ?? $request->name_surname;
            $additional->company_version = $request->company_version ?? 'mmc';
            $additional->activity_area = $request->activity_area ?? null;
            $additional->registry_date = $request->registry_date ?? null;
            $additional->update();

            foreach (UserServices::where('user_id', $id)->get() as $atta) {
                $atta->delete();
            }

            if (isset($request->services) && !empty($request->services)) {
                foreach ($request->services as $service) {
                    $userservice = new UserServices();
                    $userservice->user_id = $data->id;
                    $userservice->service_id = $service;
                    $userservice->save();
                }
            }

            Cache::flush();
            return redirect(route('users.index'))->with('success', trans('additional.messages.added'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = users($id);
            $user->delete();
            Cache::flush();
            return redirect()->back()->with('success', trans('additional.messages.deleted'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMssage());
        }finally {
            Helper::dbdeactive();
        }
    }
    public function deletedevice(Request $request)
    {
        try {
            $device = UserDevices::where('id', $request->device_id)->first();
            $device->delete();
            return response()->json(['status' => 'success', 'message' => trans('additional.messages.deleted')]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }finally {
            Helper::dbdeactive();
        }
    }
    public function forgetpasswordform(Request $request)
    {
        try {
            $user = User::where('fin_code', $request->fin_code)->latest()->first();
            if (!empty($user)) {
                DB::table('password_resets')->insert([
                    'email' => $user->email,
                    'token' => Str::random(60),
                    'created_at' => Carbon::now()
                ]);
                //Get the token just created above
                $tokenData = DB::table('password_resets')
                    ->where('email', $user->email)->latest()->first();

                $message = "Salam " . $user->name_surname . " ework.com.az vebsaytına şifrə yeniləmək üçün müraciət etdiniz. \n Şifrəni dəyişmək üçün: Keçid linki: <a href='" . route('password.change', ['email' => $user->email, 'token' => $tokenData->token]) . "' target='_blank'>link</a> \n Hörmətlə  EWORK";
                dispatch(new SendEmailJob($message, $user->email, $user->name_surname, 'forgetpassword', 'Şifrəni Unutdum'));
                return redirect(route('login'))->with('success', trans('additional.messages.emailsended'));
            } else {
                return redirect()->back()->with('warning', trans('additional.messages.usernotfound'));
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }
    public function changepasswordform(Request $request)
    {
        try {
            $tokenData = DB::table('password_resets')
                ->where('email', $request->email)->where('token', $request->token)->latest()->first();
            if (!empty($tokenData)) {
                if ($request->new_password == $request->new_password_confirmation) {
                    $user = User::where('email', $request->email)->first();
                    $user->update([
                        "password" => bcrypt($request->new_password)
                    ]);
                    $userAdditionals = UserAdditionals::where("user_id", $user->id)->first();
                    if (!empty($userAdditionals)) {
                        $userAdditionals->update(['original_password' => $request->new_password]);
                    }
                } else {
                    return redirect()->back()->with('error', "Parollar uyuşmur");
                }

                return redirect(route('login'))->with('success');
            } else {
                return view('auth.login');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }
    public function voen($voen)
    {
        try {
            $voeninfo = UserAdditionals::where("company_voen", $voen)->first();
            return view('users.voen', compact('voeninfo'));
        } catch (\Exception $e) {
            return redirect()->bakc()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }
}
