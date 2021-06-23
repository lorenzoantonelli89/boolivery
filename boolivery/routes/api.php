<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// rotta per chiamata axios ristoranti
Route::get('/restaurants', 'Api\RestaurantHomeController@getRestaurants')
    -> name('restaurants-api');
// rotta per chiamata axios categorie
Route::get('/categories', 'Api\CategoryHomeController@getCategories')
    -> name('categories-api');
//rotta per tornatu tutti i piatti 
Route::get('/all-plates', 'Api\PlateDetailController@getAllPlates')   
    -> name('all-plates-api'); 
// rotta per chiamata axios piatti del ristorante selezionato
Route::get('/plates/{id}', 'Api\PlateDetailController@getPlate')
    -> name('plates-api');
// rotta per chiamata axios collegamento categoria/ristoranti
Route::get('/pivot', 'Api\RestaurantHomeController@getRestaurantCategory')
    -> name('pivot-api');

//rotta per avere ordini
Route::get('/orders/{id}', 'Api\StatsController@getOrder')
    -> name('order-api');
