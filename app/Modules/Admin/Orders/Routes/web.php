<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2023-06-03 16:43:27
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */
Route::group(['prefix' => 'orders', 'middleware' => []], function () {
    Route::get('/', 'OrdersController@index')->name('orders.index');
    Route::get('/create', 'OrdersController@create')->name('orders.create');
    Route::post('/', 'OrdersController@store')->name('orders.store');
    Route::get('/{order}', 'OrdersController@show')->name('orders.read');
    Route::get('/edit/{order}', 'OrdersController@edit')->name('orders.edit');
    Route::put('/{order}', 'OrdersController@update')->name('orders.update');
    Route::delete('/{order}', 'OrdersController@destroy')->name('orders.delete');
});
