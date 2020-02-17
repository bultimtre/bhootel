<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//LOGIN
//Route::resources('/', 'LoginController');
Route::get('/login/{status}', 'Auth\LoginController@showLoginForm') -> name('bhootel.login');

///GUEST Con il loro controller GuestController

Route::resource('/', 'GuestController');

//Route::get('/', 'GuestController@index');

Route::post('/search', 'GuestController@search') -> name('guest.search');

Route::get('/apartment/{id}', 'GuestController@show') -> name('guest-apt.show');



///USERS UPR UPRA registrati con e senza appartmenti Con il loro controller UserController

Auth::routes();


//Route::resource('/', 'UserController');

Route::post('/user/search', 'UserController@search') -> name('user.search');

Route::get('/user/apartment/{id}', 'UserController@show') -> name('user-apt.show');

Route::get('/user/create-apt', 'UserController@create') -> name('user-apt.create');

Route::post('/user/index/{id}', 'UserController@update') -> name('index.update'); ///what if

Route::get('/user/user-panel', 'UserController@userPanel') -> name('user.user-panel');


