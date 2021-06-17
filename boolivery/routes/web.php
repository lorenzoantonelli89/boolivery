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
