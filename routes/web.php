<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/price','DomController@getPrice');
Route::get('/lotte','DomController@getProductsLotte');
Route::get('/lazada','DomController@getDataLazada');
Route::get('/hoangha','DomController@getPriceHoangHa');
Route::get('/tiki','DomController@getPriceTiki');