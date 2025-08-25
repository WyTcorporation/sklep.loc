<?php
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'categories', 'middleware' => []], function () {
    Route::get('/{category}', 'CategoriesController@show')->name('categories.show');
    Route::post('/{category}', 'CategoriesController@show')->name('categories.show.post');
});

