<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Restaurant;


class RestaurantHomeController extends Controller
{
    // funzione che manda al FE tramite chiamata axios in vue array di ristoranti
    public function getRestaurants(){

        $restaurants = Restaurant::all();

        return response() ->json($restaurants);
    }
}
