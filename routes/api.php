<?php

use Illuminate\Http\Request;

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

Route::post('receiver', 'receiverController@store');

Route::put('receiver', 'receiverController@store');

Route::get('receivers', 'receiverController@index');

Route::get('receiver/{id}', 'receiverController@show');

Route::get('searchReceiver/{category}/{query}', 'receiverController@search');

Route::delete('receiver/{id}', 'receiverController@destroy');

Route::post('giver', 'giverController@store');

Route::get('givers', 'giverController@index');

Route::get('getByCat/{category}', 'recycleController@getByCat');

Route::get('getRecByCat/{category}', 'receiverController@getRecByCat');

Route::post('login', 'receiverController@login');

Route::get('giver/{id}', 'giverController@show');

Route::put('giver', 'giverController@store');

Route::post('giverLogin', 'giverController@login');

Route::delete('giver/{id}', 'giverController@destroy');

Route::post('recycle', 'recycleController@store');

Route::get('searchRecycle/{category}/{searchWord}', 'recycleController@search');

Route::get('recycles', 'recycleController@index');

Route::get('recycle/{id}', 'recycleController@show');

Route::put('recycle', 'recycleController@store');

Route::delete('recycle/{id}', 'recycleController@destroy');

Route::get('latlngs/{lat}/lng/{lng}', 'coordinatesController@index');

Route::post('latlng', 'coordinatesController@store');

Route::delete('latlng', 'coordinatesController@destroy');

Route::get('reclatlngs/{lat}/lng/{lng}', 'RecycleCoordinatesController@index');

Route::post('reclatlng', 'RecycleCoordinatesController@store');

Route::delete('reclatlng', 'RecycleCoordinatesController@destroy');

Route::post('newsLetter', 'newsLetterController@store');

Route::post('blog', 'blogController@store');

Route::put('blog', 'blogController@store');

Route::get('blogs', 'blogController@index');

Route::get('blog/{id}', 'blogController@show');
