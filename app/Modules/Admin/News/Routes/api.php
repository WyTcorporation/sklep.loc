<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 18:33:37
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */
Route::group(['prefix' => 'news', 'middleware' => []], function () {
    Route::get('/', 'Api\NewsController@index')->name('api.news.index');
    Route::post('/', 'Api\NewsController@store')->name('api.news.store');
    Route::get('/{news}', 'Api\NewsController@show')->name('api.news.read');
    Route::put('/{news}', 'Api\NewsController@update')->name('api.news.update');
    Route::delete('/{news}', 'Api\NewsController@destroy')->name('api.news.delete');
});
