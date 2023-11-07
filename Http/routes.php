<?php

Route::group(['as' => 'laraPWA.'], function()
{
    Route::get('/manifest.json', 'LaravelPWAController@manifestJson')
    ->name('manifest');
    Route::get('/offline/', 'LaravelPWAController@offline');
});
