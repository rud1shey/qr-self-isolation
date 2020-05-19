<?php

use Illuminate\Support\Facades\Route;

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



Route::get('qrcode',function ()
{
    $user=[
        "uid"=>"askjdfhalskjdfh",
    ];
    $json = json_encode($user);
    return view('qr_code',compact('json'));
});

Route::get('login', 'AuthController@index');
Route::post('post-login', 'AuthController@postLogin');
Route::get('registration', 'AuthController@registration');
Route::post('post-registration', 'AuthController@postRegistration');
Route::get('post-qr','AuthController@postQrCode');
Route::get('dashboard', 'AuthController@dashboard');
Route::get('/', 'AuthController@dashboard');
Route::get('logout', 'AuthController@logout');
