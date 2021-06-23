<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Order;
use App\Plate;

class StatsController extends Controller
{
    public function getOrder($id){
        
        $orders = DB::table('orders')
            ->join('order_plate' , 'order_id', '=' , 'order_plate.order_id')
            ->join('plates','order_plate.plate_id', '=', 'plates.id')
            ->join('restaurants','restaurant_id','=', 'restaurants.id')
            ->select('orders.date_delivery','restaurants.id')
            ->where('retaurants.id' , $id)
            ->get();

        return response() -> json($orders);
    }
}
