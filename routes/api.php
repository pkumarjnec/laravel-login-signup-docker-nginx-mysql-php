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

//Login with Username & Password
Route::post('/login','Account\LoginController@login');

//Registration with Input details
Route::post('/register','Account\RegisterController@register');

//Get Profile Details
Route::get('/profile','Account\ProfileController@details')->middleware('apih');

//Update Profile Details
Route::post('/profile','Account\ProfileController@update')->middleware('apih');

//Import Country List
Route::get('/countries/import','Exchanger\CountryController@import');

//Get Country List with Currency
Route::get('/countries','Exchanger\CountryController@countries')->middleware('apih');

//Import Current Exchange Rate
Route::get('/rate/import','Exchanger\RatesController@import');

//Search Exchange Rate
Route::get('/rate','Exchanger\RatesController@search')->middleware('apih');

//Save Favorite Exchange
Route::post('/favorite','Exchanger\FavoriteController@save')->middleware('apih');

//Get Favorite Exchange
Route::get('/favorite','Exchanger\FavoriteController@search')->middleware('apih');
