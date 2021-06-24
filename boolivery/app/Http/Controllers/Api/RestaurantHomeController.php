<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Category;
use App\Restaurant;


class RestaurantHomeController extends Controller
{
    // funzione che manda al FE tramite chiamata axios in vue array di ristoranti filtrati per popolarità
    public function getRestaurants(){

        $restaurants = Restaurant::where('popular', 1)->get();

        return response() ->json($restaurants);
    }
    // funzione che manda al FE tramite chiamata axios in vue array di ristoranti con filtro checked
    public function getRestaurantCategory($filterCategory){

        $filterCategoryStr = explode(',', $filterCategory);
        $filterCategoryNum = [];
        foreach ($filterCategoryStr as $item) {
            $filterCategoryNum []= intval($item);
        }

        $temporary = [];
        $restaurantsFiltered = [];

        $filteredRestaurants = DB::table('categories') 
            ->join('category_restaurant', 'categories.id', '=',  'category_restaurant.category_id')
            ->join('restaurants', 'restaurants.id', '=',  'category_restaurant.restaurant_id')
            ->whereIn('category_restaurant.category_id', $filterCategoryNum)
            ->get();
        
        foreach ($filteredRestaurants as $restaurant) {
            if(!in_array($restaurant -> id, $temporary)){
                array_push($temporary, $restaurant -> id);
                array_push($restaurantsFiltered, $restaurant);
            }
        }    
        
        return response() -> json($restaurantsFiltered, 200);
    }
    // funzione che manda al FE tramite chiamata axios in vue array di ristoranti con filtro per nome
    public function getRestaurantName($filterName){

        $restaurantsFiltered = Restaurant::where('name', 'LIKE', '%' . $filterName . '%') -> get();
        
        return response() -> json($restaurantsFiltered, 200);
    }
}
