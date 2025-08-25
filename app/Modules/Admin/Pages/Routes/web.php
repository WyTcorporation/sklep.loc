<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 16:40:45
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */

Route::group(['prefix' => 'pages', 'middleware' => []], function () {
    Route::get('/', 'PagesController@index')->name('pages.index');
    Route::get('/create', 'PagesController@create')->name('pages.create');
    Route::post('/', 'PagesController@store')->name('pages.store');
    Route::get('/{page}', 'PagesController@show')->name('pages.read');
    Route::get('/edit/{page}', 'PagesController@edit')->name('pages.edit');
    Route::put('/{page}', 'PagesController@update')->name('pages.update');
    Route::delete('/{page}', 'PagesController@destroy')->name('pages.delete');
});

Route::group(['prefix' => 'banners', 'middleware' => []], function () {
    Route::get('/', 'BannersController@index')->name('banners.index');
    Route::get('/create', 'BannersController@create')->name('banners.create');
    Route::post('/', 'BannersController@store')->name('banners.store');
    Route::get('/{banner}', 'BannersController@show')->name('banners.read');
    Route::get('/edit/{banner}', 'BannersController@edit')->name('banners.edit');
    Route::put('/{banner}', 'BannersController@update')->name('banners.update');
    Route::delete('/{banner}', 'BannersController@destroy')->name('banners.delete');
});
