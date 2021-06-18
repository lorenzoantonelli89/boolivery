<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Plate;
use App\Restaurant;

class PlateDetailController extends Controller
{
    public function getAllPlates(){

        $plates = Plate::all();
        return response() ->json($plates);
    }
    public function getPlate($id){

        $restaurant = Restaurant::findOrFail($id);
        $plates = $restaurant -> plates() -> get();
        // $plates = Plate::all();

        return response() ->json($plates);
    }
}
