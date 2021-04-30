<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    $seo  = \Illuminate\Support\Facades\Lang::get('seo.home');
    return view('external/home',$seo);
})->name('home');

Route::get('/register', function () {
    $seo  = \Illuminate\Support\Facades\Lang::get('seo.register');
    return view('external/register',$seo);
})->name('register');

Route::get('/login', function () {
    $seo  = \Illuminate\Support\Facades\Lang::get('seo.login');
    return view('external/login',$seo);
})->name('login');

Route::get('/dashboard', function (\Illuminate\Http\Request $request) {
    $token = $request->get('token');
    $param = \Illuminate\Support\Facades\Lang::get('seo.dashboard');
    $param['token'] = $token;
    return view('internal/dashboard',$param);
})->name('dashboard');

Route::get('/profile', function (\Illuminate\Http\Request $request) {
    $token = $request->get('token');
    $param  = \Illuminate\Support\Facades\Lang::get('seo.dashboard');
    $param['token'] = $token;
    return view('internal/profile',$param);
})->name('profile');

