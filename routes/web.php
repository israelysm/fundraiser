<?php

use Illuminate\Http\Request;
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

Route::get('/', function () {
    $setup = env('SETUP');
        //echo $setup;
        if($setup == 'true'){
           // echo "setup mode";
            return redirect('setup');
        } else {
            // return route('login');
            return view('welcome');
        }
});

Route::middleware('issetup')->get('setup', 'App\Http\Controllers\SetupController@setup');

Route::get('admin', 'App\Http\Controllers\AuthController@index');

Route::get('login', 'App\Http\Controllers\AuthController@index');

Route::post('login', 'App\Http\Controllers\AuthController@login');

Route::get('logout', 'App\Http\Controllers\AuthController@logout');

Route::middleware('auth')->get('dashboard', 'App\Http\Controllers\DashboardController@index');

Route::middleware('auth')->get('campaign', 'App\Http\Controllers\CampaignController@index');

Route::middleware('auth')->get('events', 'App\Http\Controllers\EventController@index');

Route::middleware('auth')->get('members', 'App\Http\Controllers\MembersController@index');
