<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Services;
use App\Models\Attributes;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ServiceAttributes;
use App\Models\ServiceNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('services.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } finally {
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
            $services_top = Services::whereNull('top_id')->get();
            return view('services.create_edit', compact('services_top'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } finally {
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

            $icon = null;
            if (isset($request->icon) && !empty($request->icon)) {
                $icon = "Service-" . time() . '.' . $request->file("icon")->extension();
                $request->file("icon")->storeAs('services', $icon, 'uploads');
            }


            $service = new Services();
            $service->name = $name;
            $service->slugs = $slugs;
            $service->description = $description;
            $service->top_id = $request->top_id ?? null;
            $service->icon = $icon;
            $service->status = $request->status;
            $service->send_info = $request->send_info;
            $service->order_a = $request->order_a;
            $service->showondashboard = $request->showondashboard;
            $service->save();


            if (isset($request->area) && !empty($request->area)) {
                foreach ($request->area as $area) {

                    if (!empty($area)) {
                        $serviceattribute = new ServiceAttributes();

                        $serviceattribute->service_id = $service->id;
                        $serviceattribute->attribute_group_id = $area['group_id'];
                        $serviceattribute->showontable = $area['showontable'] == "on" ? true : false;
                        $serviceattribute->order_a = $area['order_a'];
                        $serviceattribute->save();
                    }
                }
            }

            Cache::flush();
            return redirect(route('services.index'))->with('success', trans('additional.messages.added'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } finally {
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
        $service = services($id);
        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator')) {
            $data = ServiceNotifications::where('service_id', $id)->orderBy('id', 'DESC')->get();
        } else {
            $data = ServiceNotifications::where('user_id', Auth::user()->id)->where('status', true)->where('service_id', $id)->orderBy('id', 'DESC')->get();
        }
        $tableheaders = [];
        if (isset($service->attributes) && !empty($service->attributes)) {
            if (count($service->attributes->where("showontable", true)) > 0) {
                foreach ($service->attributes->where("showontable", true)->sortBy("order_a") as $attribute) {
                    array_push($tableheaders,[
                        'name'=>$attribute->attributegroup->name[app()->getLocale().'_name'],
                        'variable'=>'name',
                        'type'=>"attribute",
                        'model'=>$attribute
                    ]);
                }
            } else {
                $tableheaders = [
                    ['name' => trans('additional.forms.title'), 'variable' => 'name', 'type' => 'data'],
                    ['name' => trans('additional.forms.content'), 'variable' => 'description', 'type' => 'data'],
                ];
            }
        } else {
            $tableheaders = [
                ['name' => trans('additional.forms.title'), 'variable' => 'name', 'type' => 'data'],
                ['name' => trans('additional.forms.content'), 'variable' => 'description', 'type' => 'data'],
            ];
        }

        return view('services.show', compact('data', 'service', 'tableheaders'));
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
            $data = services($id);
            $services_top = Services::whereNull('top_id')->get();
            return view('services.create_edit', compact('data', 'services_top'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } finally {
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

            $service = services($id);

            $icon = $service->icon ?? null;
            if (isset($request->icon) && !empty($request->icon)) {
                $icon = "Service-" . time() . '.' . $request->file("icon")->extension();
                $request->file("icon")->storeAs('services', $icon, 'uploads');
            }

            $service->name = $name;
            $service->slugs = $slugs;
            $service->description = $description;
            $service->top_id = $request->top_id ?? null;
            $service->icon = $icon;
            $service->status = $request->status;
            $service->send_info = $request->send_info;
            $service->order_a = $request->order_a;
            $service->showondashboard = $request->showondashboard;
            $service->update();

            if (isset($request->area) && !empty($request->area)) {

                foreach ($service->attributes as $attrib) {
                    $attrib->delete();
                }

                foreach ($request->area as $area) {

                    if (!empty($area)) {
                        $serviceattribute = new ServiceAttributes();

                        $serviceattribute->service_id = $service->id;
                        $serviceattribute->attribute_group_id = $area['group_id'];
                        $serviceattribute->showontable = isset($area['showontable']) && $area['showontable'] == "on" ? true : false;
                        $serviceattribute->order_a = $area['order_a'];
                        $serviceattribute->save();
                    }
                }
            }

            Cache::flush();
            return redirect(route('services.index'))->with('success', trans('additional.messages.updated'));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        } finally {
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
            $service = services($id);
            $service->delete();
            Cache::flush();
            return redirect()->back()->with('success', trans('additional.messages.deleted'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } finally {
            Helper::dbdeactive();
        }
    }
    public function deleteserviceattribute(Request $request)
    {
        try {
            $serviceattribute = serviceattribute($request->element_id);
            $serviceattribute->delete();
            Cache::flush();
            return response()->json(['status' => 'success', 'message' => trans('additional.messages.deleted')]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        } finally {
            Helper::dbdeactive();
        }
    }
}
