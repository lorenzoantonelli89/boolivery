<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Plate;

class PlateDetailController extends Controller
{
    public function getPlates($id){

        $plates = Plate::where('restaurant_id', $id) -> get();

        return response() ->json($plates);
    }
}
