<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\StandartPages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Stichoza\GoogleTranslate\GoogleTranslate;

class StandartPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('standartpages.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
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
            return view('standartpages.create');
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
            $validator = Validator::make($request->all(), [
                'az_name' => 'required|min:3',
                'az_description' => 'required|min:3',
                'type'=>"required|string"
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            $description = [
                'az_description' => $request->az_description,
                'ru_description' => isset($request->ru_description) ? $request->ru_description : trim(GoogleTranslate::trans($request->az_description, 'ru')),
                'en_description' => isset($request->en_description) ? $request->en_description : trim(GoogleTranslate::trans($request->az_description, 'en')),
                'tr_description' => isset($request->tr_description) ? $request->tr_description : trim(GoogleTranslate::trans($request->az_description, 'tr')),
            ];

            $name = [
                'az_name' => $request->az_name,
                'ru_name' => isset($request->ru_name) ? $request->ru_name : trim(GoogleTranslate::trans($request->az_name, 'ru')),
                'en_name' => isset($request->en_name) ? $request->en_name : trim(GoogleTranslate::trans($request->az_name, 'en')),
                'tr_name' => isset($request->tr_name) ? $request->tr_name : trim(GoogleTranslate::trans($request->az_name, 'tr')),
            ];

            $about = new StandartPages();
            $about->name = $name;
            $about->description = $description;
            $about->type = $request->type;
            $about->save();

            Cache::forget('standartpages');
            return redirect(route('standartpages.index'))->with('info', 'Uğurlu');
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
        try{
            $standartpage=standartpages($id);
            return view('standartpages.show',compact('standartpage'));
        }catch(\Exception $e){
            dd($e->getMessage());
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
        try {
            $data = StandartPages::where("id", $id)->first();
            return view('standartpages.create', ['data' => $data]);
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
            $validator = Validator::make($request->all(), [
                'az_name' => 'required|min:3',
                'az_description' => 'required|min:3',
                'type'=>"required|string"

            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            StandartPages::where("id", $id)->update([
                "description->az_description" => $request->az_description,
                'description->ru_description' => isset($request->ru_description) ? $request->ru_description : trim(GoogleTranslate::trans($request->az_description, 'ru')),
                'description->en_description' => isset($request->en_description) ? $request->en_description : trim(GoogleTranslate::trans($request->az_description, 'en')),
                'description->tr_description' => isset($request->tr_description) ? $request->tr_description : trim(GoogleTranslate::trans($request->az_description, 'tr')),
                "name->az_name" => $request->az_name,
                'name->ru_name' => isset($request->ru_name) ? $request->ru_name : trim(GoogleTranslate::trans($request->az_name, 'ru')),
                'name->en_name' => isset($request->en_name) ? $request->en_name : trim(GoogleTranslate::trans($request->az_name, 'en')),
                'name->tr_name' => isset($request->tr_name) ? $request->tr_name : trim(GoogleTranslate::trans($request->az_name, 'tr')),
                'type'=>$request->type
            ]);
            Cache::forget('standartpages');
            Cache::forget('standartpages'.$id);

            return redirect(route('standartpages.index'))->with('info', 'Uğurlu');
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
            StandartPages::where("id", $id)->delete();
            return redirect()->back()->with('info', 'Uğurlu');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }
}
