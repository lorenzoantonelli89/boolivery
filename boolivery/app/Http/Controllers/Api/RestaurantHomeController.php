<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Restaurant;


class RestaurantHomeController extends Controller
{
    public function getRestaurant(){

        $restaurants = Restaurant::all();

        return response() ->json($restaurants);
    }
}
