<?php

namespace App\Http\Controllers;

use App\Helpers\EPoint;
use App\Helpers\Helper;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (Auth::user()->hasRole('admin')) {
                $data = Payments::orderBy('id', 'DESC')->get();
            } else {
                $data = Payments::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
            }
            return view('payments.index', compact('data'));
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function callback(Request $request)
    {
        try {
            $payment = Payments::where("user_id", Auth::user()->id)->latest()->first();
            EPoint::paymentProcess($payment);
            return redirect(route('payments.index'))->with("success",trans('additional.pages.payment.payed'));
        } catch (\Exception $e) {
            return $e->getMessage();
            // return redirect(route('callback.error'));
        } finally {
            Helper::dbdeactive();
        }
    }

}
