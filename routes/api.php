<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('issetup')->get('/set', function () {
    echo "hi";
});

Route::middleware('issetup')->post('/saveDb', 'App\Http\Controllers\SetupController@saveDbSetting');

Route::middleware('issetup')->post('/saveOrg', 'App\Http\Controllers\OrganizationController@store');

Route::middleware('issetup')->get('/checkstatus', 'App\Http\Controllers\SetupController@checkStatus');

Route::post('/imageupload', 'App\Http\Controllers\ImageUploadController@store');
