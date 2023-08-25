<?php

use App\Models\Attributes;
use App\Models\ServiceAttributes;
use App\Models\ServiceNotificationAttribute;
use App\Models\User;
use App\Models\Services;
use App\Models\Settings;
use App\Models\StandartPages;
use App\Models\ServiceNotifications;
use Illuminate\Support\Facades\Cache;

if (!function_exists('setting')) {
    function setting(): object
    {
        $model = Settings::latest()->first();
        return Cache::rememberForever("settings", fn () => $model);
    }
}

if (!function_exists('standartpages')) {
    function standartpages($key = null): object
    {
        if (isset($key) && !empty($key)) {
            $model = StandartPages::find($key);
        } else {
            $model = StandartPages::all();
        }
        return Cache::rememberForever("standartpages" . $key, fn () => $model);
    }
}

if (!function_exists('users')) {
    function users($key = null): object
    {
        if (isset($key) && !empty($key)) {
            $model = User::find($key);
        } else {
            $model = User::all();
        }
        return Cache::rememberForever("users" . $key, fn () => $model);
    }
}


if (!function_exists('servicenotifications')) {
    function servicenotifications($key = null): object
    {
        if (isset($key) && !empty($key)) {
            $model = ServiceNotifications::find($key);
        } else {
            $model = ServiceNotifications::all();
        }
        return Cache::rememberForever("servicenotifications" . $key, fn () => $model);
    }
}

if (!function_exists('services')) {
    function services($key = null): object
    {
        if (isset($key) && !empty($key)) {
            $model = Services::find($key);
        } else {
            $model = Services::orderBy('order_a', "ASC")->get();
        }
        return Cache::rememberForever("services" . $key, fn () => $model);
    }
}

if (!function_exists('attributes')) {
    function attributes($key = null): object
    {
        if (isset($key) && !empty($key)) {
            $model = Attributes::find($key);
        } else {
            $model = Attributes::orderBy('id', "DESC")->get();
        }
        return Cache::rememberForever("attributes" . $key, fn () => $model);
    }
}


if (!function_exists('attributes_search')) {
    function attributes_search($key,$group_id)
    {
        if (isset($key) && !empty($key)) {
            $model = Attributes::where('group_id',$group_id);
            $model=$model->where('name->az_name',$key)->orWhere('name->ru_name',$key)->orWhere("name->en_name",$key)->first();
        }
        return Cache::rememberForever("attributes_search" . $key.$group_id, fn () => $model);
    }
}

if (!function_exists('serviceattribute')) {
    function serviceattribute($key)
    {
        if (isset($key) && !empty($key)) {
            $model = ServiceAttributes::find($key);
        }
        return Cache::rememberForever("serviceattribute" . $key, fn () => $model);
    }
}

if (!function_exists('servicenotificationattribute')) {
    function servicenotificationattribute($group_id,$servicenotification_id)
    {
        $model = ServiceNotificationAttribute::where('service_notification_id',$servicenotification_id)
        ->where('attribute_group_id',$group_id)
        ->first();

        return Cache::rememberForever("servicenotificationattribute" .$group_id.$servicenotification_id, fn () => $model);
        // return $model;
    }
}

