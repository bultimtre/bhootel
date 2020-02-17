<?php


Route::get('/', 'GuestController@index')-> name('guest.home');

Route::post('/search', 'GuestController@search')-> name('guest.search');

Route::get('/apartment/{id}', 'GuestController@show')-> name('apartment.show');


//braintree
Route::view('/dropin','drop-ui');
Route::view('/hosted','hosted');
//Route::get('/payment/make', 'PaymentsController@make')->name('payment.make');
Route::post('/payment/make', 'PaymentsController@make')->name('payment.make');

