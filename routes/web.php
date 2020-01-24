<?php


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('accommodations')->group(function () {
    Route::get('create', 'AccommodationsController@create')->name('acccommodations.create');
});
