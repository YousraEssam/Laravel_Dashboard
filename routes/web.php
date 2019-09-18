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

Route::get(
    '/', function () {
        return view('layouts.landing');
    }
)->name('landing');

Route::get(
    '/login', function () {
        return view('auth.login');
    }
)->name('login');
    
Route::get(
    '/register', function () {
        return view('auth.register');
    }
)->name('register');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(
    ['middleware' => ['auth']], function () {
        Route::resource('roles', 'RoleController');
        Route::resource('cities', 'CityController');
    }
);