<?php


Route::get('/', 'GuestController@index')-> name('guest.home');

Route::post('/search', 'GuestController@search')-> name('guest.search');

Route::get('/apartment/{id}', 'GuestController@show')-> name('apartment.show');

//aggiunte da Fabrizio per User Apartments
Route::get('/welcome', function () {
    return view('welcome');  // temp register / login
});

Auth::routes();
//rotta crud User Apartments
Route::resource('/user/aparts', 'UserApartmentController');
//test
// Route::post('/user/aparts/test', 'UserApartmentController@testStore')->name('aparts.store.test');