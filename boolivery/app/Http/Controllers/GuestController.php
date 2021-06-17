<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Restaurant;

class GuestController extends Controller
{
    public function detailsRestaurant($id){

        $restaurant = Restaurant::findOrFail($id);

        return view('pages.restaurant-details', compact('restaurant'));
    }
}
