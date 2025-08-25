<?php
/**
 * Created by WyTcorp.
 * User: WyTcorp
 * Date: 2022-07-31 16:40:45
 * Site: lockit.com.ua
 * Email: wild.savedo@gmail.com
 */
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'pages', 'middleware' => []], function () {
    Route::get('/{page}', 'PagesController@show')->name('front.pages.index');
});

