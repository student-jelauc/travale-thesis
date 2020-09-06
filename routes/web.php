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
    Route::get('select', 'AccommodationsController@select')->name('accommodations.select');
});

Route::prefix('rooms')->group(function () {
    Route::get('create/{accommodation?}/{type?}', 'RoomsController@create')->name('rooms.create');
    Route::post('store', 'RoomsController@store')->name('rooms.store');
    Route::get('show/{room}', 'RoomsController@show')->name('rooms.show');
    Route::get('edit/{room}', 'RoomsController@edit')->name('rooms.edit');
    Route::post('update/{room}', 'RoomsController@update')->name('rooms.update');
    Route::get('overview', 'RoomsController@overview')->name('rooms.overview');
    Route::get('{accommodation}/{type?}', 'RoomsController@index')->name('rooms');
});

Route::prefix('photos')->group(function () {
    Route::get('accommodations/{accommodation}', 'PhotosController@get')->name('photos.accommodation');
    Route::post('accommodations/{accommodation}', 'PhotosController@upload');
    Route::delete('accommodations/{accommodation}', 'PhotosController@delete');

    Route::get('rooms/{room}', 'PhotosController@get')->name('photos.room');
    Route::post('rooms/{room}', 'PhotosController@upload');
    Route::delete('rooms/{room}', 'PhotosController@delete');
});

Route::prefix('room/types')->group(function () {
    Route::get('/', 'RoomTypesController@index')->name('room.types');
    Route::get('/select', 'RoomTypesController@select')->name('room.types.select');
    Route::post('/', 'RoomTypesController@store');
    Route::get('/{type}/delete', 'RoomTypesController@delete')->name('room.types.delete');
});

Route::prefix('meals')->group(function () {
    Route::get('/', 'MealsController@index')->name('meals');
    Route::post('/', 'MealsController@store');
    Route::get('/{meal}/delete', 'MealsController@delete')->name('meals.delete');
});

Route::prefix('facilities')->group(function () {
    Route::get('/', 'FacilitiesController@index')->name('facilities');
    Route::get('/select', 'FacilitiesController@select')->name('facilities.select');
    Route::post('/', 'FacilitiesController@store');
    Route::get('/{facility}/delete', 'FacilitiesController@delete')->name('facilities.delete');
});



