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

Route::get('/user/my-restaurants','Admin\RestaurantController@listRestaurant')
->name('listRestaurant');

Route::get('/createRestaurant','Admin\RestaurantController@createRestaurant')
->name('createRestaurant');
Route::post('/storeRestaurant','Admin\RestaurantController@storeRestaurant')
->name('storeRestaurant');

Route::get('/editRestaurant/{id}','Admin\RestaurantController@editRestaurant')
->name('editRestaurant');
Route::post('/updateRestaurant/{id}','Admin\RestaurantController@updateRestaurant')
->name('updateRestaurant');

// route che mostra i piatti del singolo ristorante
 Route::get('/list-plate{id}', 'Admin\PlateController@plateList')->name('plateList');
// route che permette la modifica del piatto
 Route::get('/edit-plate{id}', 'Admin\PlateController@editPlate')->name('editPlate');
 Route::post('/update-plate{id}', 'Admin\PlateController@updatePlate')->name('updatePlate');
// route che permette l'aggiunta di un piatto
 Route::get('/create-plate{id}', 'Admin\PlateController@createPlate')->name('createPlate');
 Route::post('/store-plate{id}', 'Admin\PlateController@storePlate')->name('storePlate');



 
 