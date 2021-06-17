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
// route dettagli ristorante selezionato
Route::get('/restaurant-details/{id}', 'GuestController@detailsRestaurant') -> name('restaurant-details');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/{id}/my-restaurants','Admin\RestaurantController@listRestaurant')
->name('listRestaurant');

Route::get('/user/{id}/createRestaurant','Admin\RestaurantController@createRestaurant')
->name('createRestaurant');
Route::post('/user/{id}/storeRestaurant','Admin\RestaurantController@storeRestaurant')
->name('storeRestaurant');


 Route::get('/list-plate{id}', 'Admin\PlateController@plateList')->name('plateList');

 Route::get('/edit-plate{id}', 'Admin\PlateController@editPlate')->name('editPlate');

 Route::post('/update-plate{id}', 'Admin\PlateController@updatePlate')->name('updatePlate');

 Route::get('/create-plate', 'Admin\PlateController@createPlate')->name('createPlate');

 Route::post('/store-plate', 'Admin\PlateController@storePlate')->name('storePlate');



 
 