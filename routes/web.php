<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//LOGIN ONLY
    Route::get('/login/{status}', 'Auth\LoginController@showLoginForm') -> name('bhootel.login');

//-----------------------------------------------------//


//GUEST AND USER
    Route::get('/', 'GuestController@index') -> name('all.index');

//-----------------------------------------------------//


//GUEST ROUTES
    Route::post('/search', 'GuestController@search') -> name('guest.search');

    Route::get('/apartment/{id}', 'GuestController@show') -> name('guest-apt.show');


//-----------------------------------------------------//


///USERS UPR UPRA

Auth::routes();



Route::post('/user/search', 'UserController@search') -> name('user.search');

Route::get('/user/apartment/{id}', 'UserController@show') -> name('user-apt.show');

Route::get('/user/edit-apt/{id}', 'UserController@edit') -> name('user-apt.edit');
Route::post('/user/update-apt/{id}', 'UserController@update') -> name('user-apt.update'); ///what if

Route::get('/user/create-apt', 'UserController@create') -> name('user-apt.create');
Route::post('/user/store', 'UserController@store') -> name('user.store');

Route::get('/user/destroy-apt/{id}', 'UserController@destroy') -> name('user-apt.destroy');

Route::get('/user/user-panel', 'UserController@userPanel') -> name('user.user-panel');




