<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('admins.index');
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
            return view('admins.create_edit');
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
            $admin = new User();
            $admin->name_surname = $request->name_surname;
            $admin->email = $request->email;
            $admin->phone = $request->phone;
            $admin->fin_code = $request->fin_code;
            $admin->password = bcrypt($request->password);
            $admin->status = $request->status;
            $admin->is_admin = true;
            $admin->save();
            if(isset($request->role) && !empty($request->role))
            {
                $role = Role::where('name', $request->role)->first();
                $admin->assignRole($role->id);
            }
            Cache::flush();
            return redirect(route('admins.index'))->with('success', trans('additional.messages.added'));
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
        //
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
            $data = users($id);
            return view('admins.create_edit', compact('data'));
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
            $admin = users($id);
            $admin->name_surname = $request->name_surname;
            $admin->email = $request->email;
            $admin->phone = $request->phone;
            $admin->fin_code = $request->fin_code;
            if (isset($request->new_password) && !empty($request->new_password)) {
                $admin->password = bcrypt($request->new_password);
            }
            $admin->status = $request->status;
            $admin->update();

            $admin->roles()->detach();

            if(isset($request->role) && !empty($request->role))
            {
                $role = Role::where('name', $request->role)->first();
                $admin->assignRole($role->id);
            }

            Cache::flush();
            return redirect(route('admins.index'))->with('success', trans('additional.messages.added'));
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
            return redirect()->back()->with('error', $e->getMessage());
        }finally {
            Helper::dbdeactive();
        }
    }
    public function newadmin(Request $request)
    {
        try {
            $role = Role::create(['name' => 'admin']);
            $admin = new User();
            $admin->name_surname = "Eyvaz Ceferov";
            $admin->email = "eyvaz.ceferov@gmail.com";
            $admin->phone = "0516543290";
            $admin->fin_code = "xxx";
            $admin->password = bcrypt("E_r123456789");
            $admin->status = true;
            $admin->is_admin = true;
            $admin->save();
            $admin->assignRole($role->id);
            return redirect(route("login"));
        } catch (\Exception $e) {
            return $e->getMessage();
        }finally {
            Helper::dbdeactive();
        }
    }
    public function newrolecreate(Request $request){
        return Role::create(['name' => $request->name]);;

    }
}
