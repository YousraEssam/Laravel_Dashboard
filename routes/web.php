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

Route::get('/', function () {
    return view('layouts.landing');
})->name('landing');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
    
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/forgot_password', function () {
    return view('forgot_password');
})->name('forgot_password');

Route::get('/500', function () {
    return view('500');
})->name('500');

Route::get('/404', function () {
    return view('404');
})->name('404');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
