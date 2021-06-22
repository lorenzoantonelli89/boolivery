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
Route::get('/', 'HomeController@home') 
    -> name('home');
// route dettagli ristorante selezionato
Route::get('/restaurant-details/{id}', 'GuestController@detailsRestaurant') 
    -> name('restaurant-details');
//rotta che porta all apgina chi siamo
Route::get('/info-company', 'GuestController@infoCompany') 
    -> name('info-company'); 
//rotta che porta all pagina delle domande frequenti
Route::get('/faq', 'GuestController@faq') 
    -> name('faq');     
//rotte per i pagamenti
Route::get('/payment/{total}', 'PaymentController@payment')
    -> name('payment');
Route::post('/checkout', 'PaymentController@checkout')
    -> name('checkout');    
//inizio delle rotte in cui serve essere loggati 
Auth::routes();
// rotta lista ristoranti utente loggato
Route::get('/user/my-restaurants','Admin\RestaurantController@listRestaurant')
    -> name('listRestaurant');
// rotte per la creazione di un nuovo ristorante
Route::get('/user/createRestaurant','Admin\RestaurantController@createRestaurant')
    -> name('createRestaurant');
Route::post('/user/storeRestaurant','Admin\RestaurantController@storeRestaurant')
    -> name('storeRestaurant');
// rotta che porta al form per fare la modifica di un ristorante
Route::get('/editRestaurant/{id}','Admin\RestaurantController@editRestaurant')
    -> name('editRestaurant');
// rotta che che fa update del ristorante e ritorna poi alla pagina della lista ristoranti
Route::post('/updateRestaurant/{id}','Admin\RestaurantController@updateRestaurant')
    -> name('updateRestaurant');
// rotta che porta alla lista dei piatti del ristorante cliccato 
 Route::get('/list-plate/{id}', 'Admin\PlateController@plateList')
    -> name('plateList');
// rotta per modificare piatto
 Route::get('/edit-plate/{id}', 'Admin\PlateController@editPlate')
    -> name('editPlate');
// rotta per che fa update piatto e ritorna poi alla pagina della lista piatti
 Route::post('/update-plate/{id}', 'Admin\PlateController@updatePlate')
    -> name('updatePlate');
// rotte per la creazione di un nuovo piatto
 Route::get('/create-plate/{id}', 'Admin\PlateController@createPlate')
    -> name('createPlate');
 Route::post('/store-plate/{id}', 'Admin\PlateController@storePlate')
    ->name('storePlate');
// rotta per creazione nuovo ordine
Route::post('/storeOrder','PaymentController@storeOrder')
    ->name('storeOrder');



 
 