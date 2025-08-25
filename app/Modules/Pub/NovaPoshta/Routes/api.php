<?php
use Illuminate\Support\Facades\Route;

Route::get('/np/city/{search?}', 'Api\NovaPoshtaController@city')->name('np.city');
Route::get('/np/warehouses/{search?}', 'Api\NovaPoshtaController@warehouses')->name('np.warehouses');
