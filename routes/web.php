<?php

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

//Route::get('/post', function () {
//    return view('welcome');
//});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

//Route::get('/example-component','AppsController@get_apps');

Route::get('car_model', function(){
    return view('post');
});
Route::get('get_created_data','CarsController@get_created_data');
Route::post('get_changed_data','CarsController@get_changed_data');

/*Route::get('/{any}', function () {
    return view('post');
})->where('any', '.*');*/
