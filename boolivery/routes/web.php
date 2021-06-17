<?php

use Illuminate\Support\Facades\Route;

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

// route home principale
Route::get('/', 'HomeController@home') -> name('home');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

 Route::get('/list-restaurant', 'Admin\PlateController@restaurantList')->name('restaurantList');


 Route::get('/list-plate{id}', 'Admin\PlateController@plateList')->name('plateList');

 Route::get('/edit-plate{id}', 'Admin\PlateController@editPlate')->name('editPlate');

 Route::post('/update-plate{id}', 'Admin\PlateController@updatePlate')->name('updatePlate');

 Route::get('/create-plate', 'Admin\PlateController@createPlate')->name('createPlate');

 Route::post('/store-plate', 'Admin\PlateController@storePlate')->name('storePlate');



 
 