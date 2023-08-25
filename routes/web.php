<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\RoutesController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\FunctionsController;
use App\Http\Controllers\AttributesController;
use App\Http\Controllers\StandartPagesController;
use App\Http\Controllers\ServiceNotificationsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {
    // Pages
    Route::get('/', [RoutesController::class, 'index'])->name('welcome')->middleware('auth');
    Route::get('settings',[RoutesController::class,'settings'])->name('settings')->middleware('auth');

    // Auth
    Route::get("login", [RoutesController::class, 'login'])->name("login")->middleware('guest');
    Route::get("forgetpassword", [RoutesController::class, 'forgetpassword'])->name("forgetpassword")->middleware('guest');
    Route::get('password_change',[RoutesController::class,'password_change'])->name('password.change');
    Route::get("profile",[RoutesController::class,'profile'])->name('auth.profile')->middleware('auth');

    // Services
    Route::resource("services",ServicesController::class)->middleware('auth');
    Route::resource("servicenotifications",ServiceNotificationsController::class)->middleware('auth');
    Route::resource('attributes',AttributesController::class)->middleware('auth');

    // Users
    Route::resource('users',UsersController::class)->middleware('auth');
    Route::get('voen/{voen}',[UsersController::class,'voen'])->name('voen.show');
    Route::resource('admins',AdminsController::class)->middleware('auth');

    // Notifications
    Route::get('notifications',[RoutesController::class,'notifications'])->name("notifications.index")->middleware('auth');
    Route::get('notifications/{id}',[RoutesController::class,'notification'])->name("notifications.show")->middleware('auth');

    // Counters
    Route::resource('standartpages',StandartPagesController::class);
    Route::resource('payments',PaymentsController::class)->middleware('auth');


    Route::fallback([RoutesController::class,'fallback']);

});


// Functions
Route::post("auth", [FunctionsController::class, 'auth'])->name("auth.login")->middleware('guest');
Route::post("forgetpass", [FunctionsController::class, 'forgetpassword'])->name("auth.forgetpassword")->middleware('guest');
Route::post('verifysms', [FunctionsController::class, 'smsverify'])->name("sms.verify")->middleware('guest');
Route::post('updatesettings',[FunctionsController::class,'settingsupdate'])->name('settings.update')->middleware('auth');
Route::get('logout',[FunctionsController::class,'logout'])->name('auth.logout')->middleware('auth');
Route::post('updateprofile',[FunctionsController::class,'profile'])->name('auth.updateprofile')->middleware('auth');
Route::delete('deletedevice',[UsersController::class,'deletedevice'])->name('auth.deletedevice')->middleware("auth");
Route::post('forgetpasswordform',[UsersController::class,'forgetpasswordform'])->name('forgetpassword.form');
Route::post('changepasswordform',[UsersController::class,'changepasswordform'])->name('changepassword.form');
Route::get('paynow/{type}/{user_id}/{via}',[FunctionsController::class,'paynow'])->name('pay.now');
Route::delete('deleteserviceattribute',[ServicesController::class,'deleteserviceattribute'])->name('api.deleteserviceattribute');

Route::get('success',[PaymentsController::class,'callback'])->name('payments.success');
Route::get('error',[PaymentsController::class,'callback'])->name('payments.error');
Route::get('result',[PaymentsController::class,'callback'])->name('payments.result');

Route::get('newrole',[AdminsController::class,'newrolecreate']);
