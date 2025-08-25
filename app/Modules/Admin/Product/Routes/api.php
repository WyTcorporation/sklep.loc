<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 19:05:30
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */
Route::group(['prefix' => 'products', 'middleware' => []], function () {
    Route::get('/', 'Api\ProductController@index')->name('api.products.index');
    Route::post('/', 'Api\ProductController@store')->name('api.products.store');
    Route::get('/{product}', 'Api\ProductController@show')->name('api.products.read');
    Route::put('/{product}', 'Api\ProductController@update')->name('api.products.update');
    Route::delete('/{product}', 'Api\ProductController@destroy')->name('api.products.delete');
});
