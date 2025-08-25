<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'products', 'middleware' => []], function () {
    Route::get('/{product}', 'ProductsController@show')->name('products.show');
});

