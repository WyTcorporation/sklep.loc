<?php
use Illuminate\Support\Facades\Route;

Route::get('/order/{product}', 'OrdersController@index')->name('order');
Route::get('/card', 'OrdersController@card')->name('card');
Route::get('/buy', 'OrdersController@buy')->name('buy');
Route::post('/one/click', 'OrdersController@oneClick')->name('one.click');
Route::get('/success/{order}', 'OrdersController@success')->name('order.success');
Route::post('/success/{order}', 'OrdersController@successPost')->name('order.success.post');
Route::get('/fondy/{order}', 'OrdersController@fondy')->name('order.fondy');
