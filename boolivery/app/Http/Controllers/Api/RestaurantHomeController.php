<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Category;
use App\Restaurant;


class RestaurantHomeController extends Controller
{
    // funzione che manda al FE tramite chiamata axios in vue array di ristoranti
    public function getRestaurants(){

        $restaurants = Restaurant::all();

        return response() ->json($restaurants);
    }

    // funzione che manda al FE tramite chiamata axios in vue array di tabella ponte categorie ristoranti
    public function getRestaurantCategory(){

        $categoryRestaurant = DB::table('categories') 
            ->join('category_restaurant', 'categories.id', '=',  'category_restaurant.category_id')
            ->join('restaurants', 'restaurants.id', '=',  'category_restaurant.restaurant_id')
            ->get();
        return response() ->json($categoryRestaurant);
    }
}
