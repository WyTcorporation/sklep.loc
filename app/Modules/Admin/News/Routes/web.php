<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 18:33:37
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */
Route::group(['prefix' => 'news', 'middleware' => []], function () {
    Route::get('/', 'NewsController@index')->name('news.index');
    Route::get('/create', 'NewsController@create')->name('news.create');
    Route::post('/', 'NewsController@store')->name('news.store');
    Route::get('/{news}', 'NewsController@show')->name('news.read');
    Route::get('/edit/{news}', 'NewsController@edit')->name('news.edit');
    Route::put('/{news}', 'NewsController@update')->name('news.update');
    Route::delete('/{news}', 'NewsController@destroy')->name('news.delete');
});
