<?php


Route::get('/', 'GuestController@index')-> name('guest.home');

Route::post('/search', 'GuestController@search')-> name('guest.search');

Route::get('/apartment/{id}', 'GuestController@show')-> name('apartment.show');
