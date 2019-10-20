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

Route::get('/home', 'HomeController@index')
            ->name('home')->middleware('user');

Route::group(
    ['middleware' => ['auth']], function () {
        Route::resource('roles', 'RoleController');
        Route::resource('cities', 'CityController');
        Route::resource('jobs', 'JobController');
        Route::resource('staff_members', 'StaffMemberController');
        Route::resource('visitors', 'VisitorController');
        Route::resource('news', 'NewsController');
        Route::resource('events', 'EventController');

        Route::get('get-city-list/{id}', 'CityController@getCityList');
        Route::get('get-author-list/{type}', 'NewsController@getAuthorList');

        Route::post('uploadImage', 'ImageController@store')->name('uploadImage');
        Route::post('uploadFile', 'FileController@store')->name('uploadFile');

        Route::put('toggle_staff_activity/{staffMember}', 'StaffMemberController@toggleActivity')->name('toggleStaff');
        
        Route::put('toggle_visitor_activity/{visitor}', 'VisitorController@toggleActivity')->name('toggleVisitor');

        Route::put('toggle_news_publish/{news}', 'NewsController@togglePublish')->name('toggleNews');

        Route::put('toggle_event_publish/{event}', 'EventController@togglePublish')->name('toggleEvent');

        Route::get('get_published_news', 'NewsController@getPublishedNews')->name('getPublishedNews');

        Route::get('get_event_visitors', 'EventController@getEventVisitors')->name('getEventVisitors');

    }
);