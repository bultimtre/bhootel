<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

///GUEST Con il loro controller GuestController

Route::get('/', 'GuestController@index')-> name('guest.home');

Route::post('/search', 'GuestController@search')-> name('guest.search');

Route::get('/apartment/{id}', 'GuestController@show')-> name('guest-apt.show');



///USERS UPR UPRA registrati con e senza appartmenti Con il loro controller UserController

Auth::routes();
/* aggiunt qui user home  */
//Route::get('/user', 'UserApartmentController@index')-> name('user.home');
//rotta crud User Apartments
Route::resource('/user/index', 'UserController');

Route::post('/user/search', 'UserController@search') -> name('user.search');

Route::get('/user/apartment/{id}', 'UserController@show') -> name('user-apt.show');

Route::post('/user/index/{id}', 'UserController@update') -> name('index.update');

Route::get('/user/user-panel', 'UserController@userPanel') -> name('user.user-panel');

//testRoute only for session clear
Route::get('/clear', 'TestSession@clearSession');