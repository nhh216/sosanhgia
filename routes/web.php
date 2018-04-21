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
//Route::get('/lotte','DomController@getProductsLotte');//Done
Route::get('/lazada','DomController@getDataLazada'); //Done
//Route::get('/tiki','DomController@getPriceTiki'); //Done
Route::get('/nk','DomController@getPriceNguyenKim');
Route::get('/nc','DomController@getPriceNhatCuong');
Route::get('/cell','DomController@getPriceCellPhone');
Route::get('/hnam','DomController@getPriceHnam');
Route::get('/adayroi','DomController@getPriceAdayroi');

//Route::get('/vuivui','DomController@getPriceVuiVui'); // Done
//Route::get('/hoangha','DomController@HoangHa'); // Done