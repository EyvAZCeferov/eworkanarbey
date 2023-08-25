<?php

namespace App\Helpers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Payments;
use App\Models\Services;
use App\Models\UserServices;
use App\Models\ServiceAttributes;
use Illuminate\Support\Facades\DB;

class Helper{
    public static function strip_tags_with_whitespace($string, $allowable_tags = null)
    {
        $string = str_replace('<', ' <', $string);
        $string = str_replace('&nbsp; ', ' ', $string);
        $string = str_replace('&nbsp;', ' ', $string);
        $string = strip_tags($string, $allowable_tags);
        $string = str_replace('  ', ' ', $string);
        $string = trim($string);
        return $string;
    }
    public static function getDateTimeViaTimeStamp($timeStamp, $showhours = false, $type = null)
    {

        if ($showhours == true) {
            if (empty($type) || $type==null || $type==[]) {
                return $timeStamp->format('d.m.Y H:i');
            } else {
                return Carbon::createFromTimestamp($timeStamp)->format('d.m.Y H:i');
            }
        } else {
            if (empty($type) || $type==null || $type==[]) {
                return $timeStamp->format('d.m.Y');
            } else {
                return Carbon::createFromTimestamp($timeStamp)->format('d.m.Y');
            }
        }
    }
    public static function createRandomCode($type = "int", $length = 4)
    {
        if ($type == "int") {
            if ($length == 4) {
                return random_int(1000, 9999);
            } elseif ($length == 49) {
                return random_int(100000000000000, 999999999999999);
            }
        } elseif ($type == "string") {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
    }
    public static function getImageUrl($image, $clasore)
    {
        $url = env("APP_URL") . "/uploads/" . $clasore . "/" . $image;
        if ($url != null) {
            return $url;
        }
        return null;
    }
    public static function searchserviceon_menu($user_id,$service_id){
        $userService=UserServices::where('user_id',$user_id)->where('service_id',$service_id)->latest()->first();
        if(!empty($userService)){
            return true;
        }else{
            return false;
        }
    }public static function searchserviceattribute($attribute_id,$service_id){
        $data=ServiceAttributes::where('attribute_id',$attribute_id)->where('service_id',$service_id)->latest()->first();
        if(!empty($data)){
            return true;
        }else{
            return false;
        }
    }
    public static function getpaidornot($user_id){
        $payment=Payments::where('user_id',$user_id)->where('payment_status',1)
        ->where('end_time', '>=', Carbon::now()->format('Y-m-d'))
        ->orderBy('id','DESC')->first();

        if(!empty($payment)){
            return false;
        }else{
            return true;
        }
    }
    public static function dbdeactive(){
        DB::connection()->disconnect();
    }
}
