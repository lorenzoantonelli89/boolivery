<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Restaurant;
use App\User;
use App\Category;
use App\Order;
use App\Plate;

class OrderController extends Controller
{
    public function showStats($id){ //funzione per mostrare pagina statistiche

        $restaurant = Restaurant::findOrFail(Crypt::decrypt($id));
        //funzione per passare un array vuoto di ordini, e mostrare relativo messaggio
        $plates = $restaurant -> plates() ->get();
        if(count($plates) == 0){
            $orders = [];
        } else {
            foreach($plates as $plate){
                $orders = $plate->orders()->get();
            }
        }
        return view('admin.orderStats',compact('restaurant','orders'));
    }

    public function showOrders($id){ //funzione per mostrare tutti gli ordini

        $restaurant = Restaurant::findOrFail(Crypt::decrypt($id));
        //funzione per passare un array vuoto di ordini, e mostrare relativo messaggio
        $plates = $restaurant -> plates() ->get();
        if(count($plates) == 0){
            $orders = [];
        } else {
            foreach($plates as $plate){
                $orders = $plate->orders()->get();
            }
        }
        return view ('admin.orderList',compact('restaurant','orders'));
    }

    public function showOrder($id){ //funzione per mostrare ordine

        $order = Order::findOrFail($id);
        $plates = $order->plates()->get();
        $restaurant = Restaurant::findOrFail($plates[0]->restaurant_id);
        $ownerId = $restaurant->user_id;
        $user= Auth::user();
        // controllo per non fare inserire ID ordine altrui
        if($ownerId != $user->id){
            return redirect()->route('listRestaurant');
        }
        return view('admin.orderPage',compact('order','restaurant'));
    }
}
