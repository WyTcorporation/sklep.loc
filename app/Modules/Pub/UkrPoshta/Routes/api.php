<?php
use Illuminate\Support\Facades\Route;

Route::get('/ukr/auth', 'Api\UkrPoshtaController@auth')->name('ukr.auth');
