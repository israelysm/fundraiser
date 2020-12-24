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
