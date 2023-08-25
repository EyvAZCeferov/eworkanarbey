<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\EmailJob;
use App\Helpers\Helper;
use App\Models\Services;
use App\Jobs\SendEmailJob;
use App\Models\Attributes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\ServiceNotifications;
use Illuminate\Support\Facades\Cache;
use App\Models\ServiceNotificationAttribute;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ServiceNotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try{
            $service=Services::orderBy('order_a','DESC')->where("slugs->az_slug",$request->slug)->orWhere("slugs->ru_slug",$request->slug)->orWhere("slugs->en_slug",$request->slug)->first();
            $users=User::orderBy('id','DESC')->whereHas('services',function($query) use ($service){
                $query->where('service_id',$service->id);
            })->get();
            return view('servicenotifications.create_edit',compact('service','users'));
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
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
        try{
            $name = [
                'az_name' => $request->az_name,
                'ru_name' => isset($request->ru_name) ? $request->ru_name : trim(GoogleTranslate::trans($request->az_name, 'ru')),
                'en_name' => isset($request->en_name) ? $request->en_name : trim(GoogleTranslate::trans($request->az_name, 'en')),
            ];

            $slugs = [
                'az_slug' => Str::slug(trim($name['az_name'])),
                'ru_slug' => Str::slug(trim($name['ru_name'])),
                'en_slug' => Str::slug(trim($name['en_name'])),
            ];

            $description = [
                'az_description' => $request->az_description ?? ' ',
                'ru_description' => isset($request->ru_description) ? $request->ru_description : (isset($request->az_description) && !empty($request->az_description) ? trim(GoogleTranslate::trans($request->az_description, 'ru')) : ' '),
                'en_description' => isset($request->en_description) ? $request->en_description : (isset($request->az_description) && !empty($request->az_description) ? trim(GoogleTranslate::trans($request->az_description, 'en')) : ' '),
            ];

            $pdf = null;
            if (isset($request->pdf) && !empty($request->pdf)) {
                $pdf = "ServiceNotification-" . time() . '.' . $request->file("pdf")->extension();
                $request->file("pdf")->storeAs('servicenotifications', $pdf, 'uploads');
            }

            $service = new ServiceNotifications();
            $service->name = $name;
            $service->slugs = $slugs;
            $service->description = $description;
            $service->user_id = $request->user_id ?? null;
            $service->service_id = $request->service_id ?? null;
            $service->pdf = $pdf;
            $service->status = $request->status;
            $service->time = $request->time;
            $service->save();

            $notification=new Notifications();
            $notification->user_id=$request->user_id;
            $notification->title=$name['az_name'];
            $notification->body=$description['az_description'].'<br/>Keçid et: <a href="'.route('services.show',$request->service_id).'">'.$name['az_name'].'</a>';
            $notification->via=1;
            $notification->status=false;
            $notification->save();

            $user=users($request->user_id);

            if(isset($request->area) && !empty($request->area)){
                foreach($service->attributes as $attribute){
                    $attribute->delete();
                }

                foreach($request->area as $key=> $area){
                    $servicenotificationattribute=new ServiceNotificationAttribute();
                    $servicenotificationattribute->service_notification_id=$service->id;
                    $servicenotificationattribute->attribute_group_id=$key;
                    if(!empty(attributes_search($area['value'],$key))){
                        $servicenotificationattribute->attribute_id=attributes_search($area['value'],$key)->id;
                    }else{
                         $name = [
                            'az_name' => $area['value'] ?? ' ',
                            'ru_name' => trim(GoogleTranslate::trans($area['value'], 'ru')) ?? ' ',
                            'en_name' => trim(GoogleTranslate::trans($area['value'], 'en')) ?? ' ',
                            'tr_name' => trim(GoogleTranslate::trans($area['value'], 'tr')) ?? ' ',
                        ];
                        $group=attributes($key);
                        $attribute=new Attributes();
                        $attribute->name=$name;
                        $attribute->status=true;
                        $attribute->type=$group->type;
                        $attribute->group_id=$key;
                        $attribute->save();
                        $servicenotificationattribute->attribute_id=$attribute->id;
                    }
                    $servicenotificationattribute->save();
                }
            }

            // Send Mail
            dispatch(new SendEmailJob($notification->body, $user->email, $user->name_surname, 'newserviceavaiable', $name['az_name'].' Yeni məlumat əlavə edildi'));
            // Send Mail
            Cache::flush();

            return redirect(route('services.show',$request->service_id))->with('success', trans('additional.messages.added'));
        }catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->with('error',$e->getMessage());
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
        try{
            $data=servicenotifications($id);
            return view('servicenotifications.show',compact('data'));
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
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
        try{
            $data=servicenotifications($id);
            $service=services($data->service_id);
            return view('servicenotifications.create_edit',compact('data','service'));
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
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

        try{
            $service = ServiceNotifications::find($id);

            $name = [
                'az_name' => $request->az_name,
                'ru_name' => isset($request->ru_name) ? $request->ru_name : trim(GoogleTranslate::trans($request->az_name, 'ru')),
                'en_name' => isset($request->en_name) ? $request->en_name : trim(GoogleTranslate::trans($request->az_name, 'en')),
            ];

            $slugs = [
                'az_slug' => Str::slug(trim($name['az_name'])),
                'ru_slug' => Str::slug(trim($name['ru_name'])),
                'en_slug' => Str::slug(trim($name['en_name'])),
            ];

            $description = [
                'az_description' => $request->az_description ?? ' ',
                'ru_description' => isset($request->ru_description) ? $request->ru_description : (isset($request->az_description) && !empty($request->az_description) ? trim(GoogleTranslate::trans($request->az_description, 'ru')) : ' '),
                'en_description' => isset($request->en_description) ? $request->en_description : (isset($request->az_description) && !empty($request->az_description) ? trim(GoogleTranslate::trans($request->az_description, 'en')) : ' '),
            ];

            if (isset($request->pdf) && !empty($request->pdf)) {
                $pdf = "ServiceNotification-" . time() . '.' . $request->file("pdf")->extension();
                $request->file("pdf")->storeAs('servicenotifications', $pdf, 'uploads');
                $service->update(['pdf'=>$pdf]);
            }

            $service->name = $name;
            $service->slugs = $slugs;
            $service->description = $description;
            $service->status = $request->status;
            $service->time = $request->time;
            $service->update();

            $notification=new Notifications();
            $notification->user_id=$service->user_id;
            $notification->title=$name['az_name'];
            $notification->body=$description['az_description'].'<br/>Keçid et: <a href="'.route('services.show',$service->id).'">'.$name['az_name'].'</a>';
            $notification->via=1;
            $notification->status=false;
            $notification->save();

            $user=users($service->user_id);

            if(isset($request->area) && !empty($request->area)){
                foreach($service->attributes as $attribute){
                    $attribute->delete();
                }

                foreach($request->area as $key=> $area){
                    $servicenotificationattribute=new ServiceNotificationAttribute();
                    $servicenotificationattribute->service_notification_id=$service->id;
                    $servicenotificationattribute->attribute_group_id=$key;
                    if(!empty(attributes_search($area['value'],$key))){
                        $servicenotificationattribute->attribute_id=attributes_search($area['value'],$key)->id;
                    }else{
                         $name = [
                            'az_name' => $area['value'] ?? ' ',
                            'ru_name' => trim(GoogleTranslate::trans($area['value'], 'ru')) ?? ' ',
                            'en_name' => trim(GoogleTranslate::trans($area['value'], 'en')) ?? ' ',
                            'tr_name' => trim(GoogleTranslate::trans($area['value'], 'tr')) ?? ' ',
                        ];
                        $group=attributes($key);
                        $attribute=new Attributes();
                        $attribute->name=$name;
                        $attribute->status=true;
                        $attribute->type=$group->type;
                        $attribute->group_id=$key;
                        $attribute->save();
                        $servicenotificationattribute->attribute_id=$attribute->id;
                    }
                    $servicenotificationattribute->save();
                }
            }

            // Send Mail
            dispatch(new SendEmailJob($notification->body, $user->email, $user->name_surname, 'newserviceavaiable', $name['az_name'].' Məlumat yeniləndi.'));
            // Send Mail

            Cache::flush();

            return redirect(route('services.show',$service->service_id))->with('success', trans('additional.messages.updated'));
        }catch(\Exception $e){
            dd($e->getMessage());
            return redirect()->back()->with('error',$e->getMessage());
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
        try{
            $service =  ServiceNotifications::find($id);


            $notification= Notifications::where('user_id',$service->user_id)->where('title',$service->name['az_name'])->first();
            if(!empty($notification)){
                $notification->delete();
            }

            $service->delete();
            Cache::flush();
            return redirect()->back()->with('success','Silindi');

        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
