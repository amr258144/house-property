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
Route::post('/district/store', 'DistrictsController@store');
Route::get('/district/{district_id}', 'DistrictsController@show');
Route::get('/district', 'DistrictsController@index');

Route::post('/compound/store', 'CompoundsController@store');

Route::post('/building/store', 'BuildingsController@store');
Route::get('/building/edit/{building_id}', 'BuildingsController@edit');
Route::put('/building/update/{building_id}', 'BuildingsController@update');

Route::post('/property/store', 'PropertyController@store');
Route::get('/property/edit/{property_id}', 'PropertyController@edit');
Route::put('/property/update/{property_id}', 'PropertyController@update');

Route::post('/promotions/store', 'PromotionsController@store');
Route::get('/promotions/list', 'PromotionsController@list');