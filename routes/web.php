<?php


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('accommodations')->group(function () {
    Route::get('/', 'AccommodationsController@index')->name('accommodations');
    Route::get('create', 'AccommodationsController@create')->name('accommodations.create');
    Route::post('store', 'AccommodationsController@store')->name('accommodations.store');
    Route::get('show/{accommodation}', 'AccommodationsController@show')->name('accommodations.show');
    Route::get('edit/{accommodation}', 'AccommodationsController@edit')->name('accommodations.edit');
    Route::post('update/{accommodation}', 'AccommodationsController@update')->name('accommodations.update');

    Route::get('photos/{accommodation}', 'AccommodationsController@photos')->name('accommodations.photos');
    Route::post('photos/{accommodation}', 'AccommodationsController@uploadPhoto');
    Route::delete('photos/{accommodation}', 'AccommodationsController@deletePhoto');
});

Route::prefix('rooms')->group(function () {
    Route::get('create/{accommodation?}/{type?}', 'RoomsController@create')->name('rooms.create');
    Route::post('store', 'RoomsController@store')->name('rooms.store');
    Route::get('show/{room}', 'RoomsController@show')->name('rooms.show');
    Route::get('edit/{room}', 'RoomsController@edit')->name('rooms.edit');
    Route::post('update/{room}', 'RoomsController@update')->name('rooms.update');
    Route::get('{accommodation}/{type?}', 'RoomsController@index')->name('rooms');
});

