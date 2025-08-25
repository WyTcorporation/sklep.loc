<?php

Route::group(['prefix' => 'parser', 'middleware' => []], function () {
    Route::get('/categories', 'Api\ParserController@categories')->name('api.parser.categories');
    Route::get('/get/products', 'Api\ParserController@getProducts')->name('api.parser.getProducts');
    Route::get('/products', 'Api\ParserController@index')->name('api.parser.index');
});

Route::group(['prefix' => 'auths', 'middleware' => []], function () {
    Route::post('/login', 'Api\LoginController@login')->name('api.auths.login');
});
