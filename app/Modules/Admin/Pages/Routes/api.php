<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 16:40:45
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

Route::group(['prefix' => 'pages', 'middleware' => []], function () {
    Route::get('/', 'Api\PagesController@index')->name('api.pages.index');
    Route::post('/', 'Api\PagesController@store')->name('api.pages.store');
    Route::get('/{page}', 'Api\PagesController@show')->name('api.pages.read');
    Route::put('/{page}', 'Api\PagesController@update')->name('api.pages.update');
    Route::delete('/{page}', 'Api\PagesController@destroy')->name('api.pages.delete');
});

