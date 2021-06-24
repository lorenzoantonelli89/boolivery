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
// rotta per chiamata axios che ritoran ristoranti filtrati per categoria
Route::post('/restaurants-filteredCat/{filterCategory}', 'Api\RestaurantHomeController@getRestaurantCategory')
    -> name('restaurant-name');
// rotta per chiamata axios che ritoran ristoranti filtrati per nome
Route::post('/restaurants-filteredName/{filterName}', 'Api\RestaurantHomeController@getRestaurantName')
    -> name('restaurant-category');        
// rotta per chiamata axios categorie
Route::get('/categories', 'Api\CategoryHomeController@getCategories')
    -> name('categories-api');
//rotta per tornatu tutti i piatti 
Route::get('/popular-plates', 'Api\PlateDetailController@getAllPlates')   
    -> name('popular-plates'); 
// rotta per chiamata axios piatti del ristorante selezionato
Route::get('/plates/{id}', 'Api\PlateDetailController@getPlate')
    -> name('plates-api');
//rotta per avere ordini
Route::get('/orders/{id}', 'Api\StatsController@getOrder')
    -> name('order-api');
