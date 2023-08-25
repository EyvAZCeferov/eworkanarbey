<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use GuzzleHttp\Client;
use App\Helpers\EPoint;
use App\Helpers\Helper;
use App\Models\Payments;
use App\Models\Settings;
use App\Jobs\SendEmailJob;
use App\Models\UserDevices;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\UserAdditionals;
use App\Models\ServiceAttributes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

class FunctionsController extends Controller
{
    public function auth(Request $request)
    {
        try {

            // Google reCAPTCHA doğrulama isteğini oluştur
            $client = new Client();
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret' => env('RECAPTCHA_SECRET_KEY'),
                    'response' => $request->input('g-recaptcha-response'),
                    'remoteip' => $request->ip()
                ]
            ]);

            // Google reCAPTCHA doğrulama sonucunu kontrol et
            $body = json_decode((string)$response->getBody());
            // $body->success == 
            if ($body->success==true) {
                $user = User::where(DB::raw("LOWER(fin_code)"), 'LIKE', '%' . strtolower($request->fin_code) . '%')->where("phone", $request->phone)->latest()->first();
                if (isset($user) && !empty($user)) {
                    $userdevices = UserDevices::where('user_id', $user->id)->where('ipaddress', $request->ip())->where("status", true)->latest()->first();
                    if (isset($userdevices) && !empty($userdevices)) {
                        Auth::login($user);
                        return response()->json(['status' => 'success', 'redirect' => route('welcome')]);
                    } else {
                        $address_data = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $request->ip())) ?? [];
                        $agent = new Agent();

                        if (empty(UserDevices::where('user_id', $user->id)->where('ipaddress', $request->ip())->where("status", false)->first())) {
                            $userdevice = new UserDevices();
                            $userdevice->user_id = $user->id;
                            $userdevice->ipaddress = $request->ip();
                            $userdevice->device_data = ["platform" => $agent->platform(), "browser" => $agent->browser(), 'device' => $agent->device()];
                            $userdevice->address_data = $address_data;
                            $userdevice->status = true;
                            $userdevice->save();
                        }

                        $code = Helper::createRandomCode();
                        $notification = new Notifications();
                        $notification->title = "Yeni cihazdan giriş";
                        $notification->value = $code;
                        $notification->body = "Yeni cihazdan giriş edildi. <br/> İp Adres: ".$request->ip()." Tarix: ". now();
                        $notification->via = 2;
                        $notification->user_id = $user->id;
                        $notification->save();
                        // Send Sms
                        dispatch(new SendEmailJob($notification->body, $user->email, $user->name_surname, 'loginbyotherdevice', 'Yeni cihazdan giriş'));
                        // Send Sms
                        Auth::login($user);

                        return response()->json(['status' => 'info', 'verification' => true, 'redirect' => route('welcome')]);
                    }
                } else {
                    return response()->json(['status' => 'error', 'message' => trans('additional.messages.usernotfound')]);
                }
            }else{
                return response()->json(['status'=>'error','message'=>trans('additional.pages.login.verifyrecaptcha')]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }finally {
            Helper::dbdeactive();
        }
    }
    public function smsverify(Request $request)
    {
        try {
            $user = User::where(DB::raw("LOWER(fin_code)"), 'LIKE', '%' . strtolower($request->fin_code) . '%')->where("phone", $request->phone)->latest()->first();
            $notification = Notifications::where('user_id', $user->id)->where('status', false)->latest()->first();
            if (isset($notification) && !empty($notification)) {
                if ($request->code == $notification->value) {
                    $notification->update(['status' => true]);
                    $userdevice = UserDevices::where("user_id", $user->id)->where('status', false)->latest()->first();
                    $userdevice->update(['status' => true]);
                    Auth::login($user);
                    return response()->json(['status' => 'success', 'redirect' => route('welcome')]);
                } else {
                    return response()->json(['status' => 'error']);
                }
            } else {
                // $this->sendverifysms($user->phone, $user->name_surname, $user->id);
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }finally {
            Helper::dbdeactive();
        }
    }
    public function settingsupdate(Request $request)
    {
        try {
            if (Auth::user()->hasRole('admin')) {
                $setting_d = setting();
                $title = [
                    'az_title' => trim($request->az_title) ?? " ",
                    'ru_title' => $request->ru_title ?? trim(GoogleTranslate::trans($request->az_title, 'ru')),
                    'en_title' => $request->en_title ?? trim(GoogleTranslate::trans($request->az_title, 'en')),
                ];

                $open_hours = [
                    'az_open_hours' => trim($request->az_open_hours) ?? " ",
                    'ru_open_hours' => $request->ru_open_hours ?? trim(GoogleTranslate::trans($request->az_open_hours, 'ru')),
                    'en_open_hours' => $request->en_open_hours ?? trim(GoogleTranslate::trans($request->az_open_hours, 'en')),
                ];

                $description = [
                    'az_description' => trim($request->az_description) ?? null,
                    'ru_description' => $request->ru_description ?? trim(GoogleTranslate::trans($request->az_description, 'ru')),
                    'en_description' => $request->en_description ?? trim(GoogleTranslate::trans($request->az_description, 'en')),
                ];

                $logo = isset($setting_d) && !empty($setting_d) && isset($setting_d->logo_dark_mode) && !empty($setting_d->logo_dark_mode) ? $setting_d->logo_dark_mode : null;

                if ($request->hasFile('logo') && !empty($request->logo)) {
                    if (isset($setting_d) && !empty($setting_d) && isset($setting_d->logo_dark_mode) && !empty($setting_d->logo_dark_mode)) {
                        if (Storage::disk("uploads")->exists("settings/" . $setting_d->logo_dark_mode)) {
                            Storage::disk("uploads")->delete("settings/" . $setting_d->logo_dark_mode);
                        }
                    }
                    $logo = "LogoDark-" . time() . '.' . $request->file("logo")->extension();
                    $request->file("logo")->storeAs('settings', $logo, 'uploads');
                }

                $social_media = [
                    'facebook_url' => $request->facebook_url ?? " ",
                    'instagram_url' => $request->instagram_url ?? " ",
                    'phone' => $request->phone ?? " ",
                    'whatsapp' => $request->whatsapp ?? " ",
                    'email' => $request->email ?? " ",
                    'tiktok' => $request->tiktok ?? " ",
                    'gmaps_url' => $request->gmaps_url ?? " ",
                    'youtube_url' => $request->youtube_url ?? " ",
                ];

                if (empty($setting_d)) {
                    $setting = new Settings();
                }else{
                    $setting=setting()
;                }

                $setting->title = $title;
                $setting->description = $description;
                $setting->open_hours = $open_hours;
                $setting->logo_dark_mode = $logo ?? null;
                $setting->social_media = $social_media;
                if (empty($setting_d)) {
                    $setting->save();
                } else {
                    $setting->update();
                }

                Cache::forget('settings');
                return redirect()->back()->with('success', trans('additional.messages.updated'));
            } else {
                $user = users(Auth::user()->id);
                if ($user->additionalinfo->original_password == $request->current_password) {
                    $user->update([
                        'password' => bcrypt($request->new_password)
                    ]);
                    UserAdditionals::where("user_id", $user->id)->update([
                        'original_password' => $request->new_password
                    ]);
                    return redirect()->back()->with('success', trans('additional.messages.updated'));
                } else {
                    return redirect()->back()->with('warning', trans('additional.messages.wronglastpassword'));
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }
    public function profile(Request $request)
    {
        try {
            $user = users(Auth::user()->id);
            if (isset($request->profile_photo) && !empty($request->profile_photo)) {
                $profile_photo = $user->profile_photo ?? null;

                if (isset($request->profile_photo) && !empty($request->profile_photo)) {
                    if (Storage::disk("uploads")->exists("useradditionals/" . $profile_photo)) {
                        Storage::disk("uploads")->delete("useradditionals/" . $profile_photo);
                    }
                    $profile_photo = "ProfilePhoto-" . time() . '.' . $request->file("profile_photo")->extension();
                    $request->file("profile_photo")->storeAs('useradditionals', $profile_photo, 'uploads');
                    $user->update([
                        'profile_picture' => $profile_photo,
                    ]);
                }
            }

            return response()->json(['status' => 'success', 'message' => trans('additional.messages.updated')]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }finally {
            Helper::dbdeactive();
        }
    }
    public function logout()
    {
        try {
            Auth::logout();
            return redirect('/');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }
    public function paynow($type, $user_id, $via)
    {
        try {

            $user = users($user_id);
            $price = $user->service_prices[$type] ?? 0;
            $now = Carbon::now();
            $end_time = null;
            $title = null;
            if ($type == "monthly") {
                $end_time = clone $now;
                $end_time->addMonth(1);
                $title = "Aylıq";
            } else if ($type == "yearly") {
                $end_time = clone $now;
                $end_time->addYear();
                $title = "İllik";
            } else {
                $end_time = $now;
                $title = "Aylıq";
            }

            // dd($end_time,$title);
            $payment = new Payments();
            $payment->user_id = $user_id;
            $payment->amount = $price;
            $payment->transaction_id = Helper::createRandomCode('string', 11);
            $payment->payment_status = 0;
            $payment->data = [
                "user_id" => $user->id,
                "price" => $user->service_prices[$type],
                "type" => $type,
                "end_time" => $end_time,
                'start_time' => $now,
                "title" => $title,
            ];
            $payment->end_time = $end_time;
            $payment->save();



            if ($via == "bank") {
                return EPoint::createPayment($price, $payment);
            } else {

                $payment->update(['payment_status' => true]);
                return redirect()->back()->with('success', trans('additional.pages.payment.payed'));
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }
    public function deleteserviceattribute(Request $request){
        try{
            $serviceattribute=ServiceAttributes::find($request->attribute_id);
            $serviceattribute->delete();
            return response()->json(['status'=>'success','message'=>trans('additional.messages.deleted')]);
        }catch(\Exception $e){
            return response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }
}
