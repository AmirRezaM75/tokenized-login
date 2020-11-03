<?php

Route::post('request', 'TokenController@request')->name('request');
Route::post('login', 'TokenController@login')->name('login');

if (app()->environment('local')) {
    Route::get('test/request', 'TokenController@test');
}
