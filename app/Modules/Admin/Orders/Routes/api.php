<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2023-06-03 16:43:27
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */
Route::group(['prefix' => 'orders', 'middleware' => []], function () {
    Route::get('/', 'Api\OrdersController@index')->name('api.orders.index');
    Route::post('/', 'Api\OrdersController@store')->name('api.orders.store');
    Route::get('/{order}', 'Api\OrdersController@show')->name('api.orders.read');
    Route::put('/{order}', 'Api\OrdersController@update')->name('api.orders.update');
    Route::delete('/{order}', 'Api\OrdersController@destroy')->name('api.orders.delete');
});
