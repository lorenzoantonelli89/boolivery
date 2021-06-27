<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Order;
use App\Plate;

class StatsController extends Controller
{
    public function getOrderStats($id){
        
        $orders = DB::table('orders')
            ->join('order_plate' , 'orders.id', '=' , 'order_plate.order_id')
            ->join('plates','order_plate.plate_id', '=', 'plates.id')
            ->join('restaurants','restaurant_id','=', 'restaurants.id')
            //->select('orders.date_delivery','restaurants.name','orders.total_price')
            ->where('restaurants.id' , $id)
            ->where('orders.id','<', 29)
            ->get();

        return response() -> json($orders);
    }

    public function getOrderYear($id,$year){

        $orders = DB::table('orders')
            ->join('order_plate' , 'orders.id', '=' , 'order_plate.order_id')
            ->join('plates','order_plate.plate_id', '=', 'plates.id')
            ->join('restaurants','restaurant_id','=', 'restaurants.id')
            //->select('orders.date_delivery','restaurants.name','orders.total_price')
            ->where('restaurants.id' , $id)
            ->whereYear('orders.date_delivery',$year)
            ->get();

        return response() -> json($orders);
    }
}