<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 19:05:30
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

Route::group(['prefix' => 'products', 'middleware' => []], function () {

    Route::get('/categories/', 'CategoryProductController@index')->name('products.categories.index');
    Route::get('/categories/create', 'CategoryProductController@create')->name('products.categories.create');
    Route::post('/categories/', 'CategoryProductController@store')->name('products.categories.store');
    Route::get('/categories/{category_product}', 'CategoryProductController@show')->name('products.categories.read');
    Route::get('/categories/edit/{category_product}', 'CategoryProductController@edit')->name('products.categories.edit');
    Route::put('/categories/{category_product}', 'CategoryProductController@update')->name('products.categories.update');
    Route::delete('/categories/{category_product}', 'CategoryProductController@destroy')->name('products.categories.delete');


    Route::get('/', 'ProductController@index')->name('products.index');
    Route::get('/create', 'ProductController@create')->name('products.create');
    Route::post('/', 'ProductController@store')->name('products.store');
    Route::get('/{product}', 'ProductController@show')->name('products.read');
    Route::get('/edit/{product}', 'ProductController@edit')->name('products.edit');
    Route::put('/{product}', 'ProductController@update')->name('products.update');
    Route::delete('/{product}', 'ProductController@destroy')->name('products.delete');
    Route::post('/images', 'ProductController@images')->name('products.images.post');

});
