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
// Route::post('/user/update-apt/{id}', 'UserController@update') -> name('user-apt.update'); ///what if
Route::post('/user/update-apt/', 'UserController@update') -> name('user-apt.update'); ///what if

Route::get('/user/create-apt', 'UserController@create') -> name('user-apt.create');
Route::post('/user/store', 'UserController@store') -> name('user.store');

Route::get('/user/destroy-apt/{id}', 'UserController@destroy') -> name('user-apt.destroy');

Route::get('/user/user-panel', 'UserController@userPanel') -> name('user.user-panel');

// Clear Session for Testing view count
Route::get('/clear', 'ClearSessionController@clearSession');




<<<<<<< HEAD
Route::get('/apartment/{id}', 'GuestController@show')-> name('apartment.show');


//braintree
Route::view('/dropin','drop-ui');
Route::view('/hosted','hosted');
//Route::get('/payment/make', 'PaymentsController@make')->name('payment.make');
Route::post('/payment/make', 'PaymentsController@make')->name('payment.make');

=======
>>>>>>> 950b94da2e35771fe1109cbb86337a3b0322504a
