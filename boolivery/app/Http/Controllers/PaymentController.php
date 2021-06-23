<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Plate;
use App\Order;

class PaymentController extends Controller
{
    public function storeOrder(Request $request){

        $validated = $request -> validate([
            'name'=> 'required|min:3|max:255',
            'lastname'=> 'required|min:3|max:255',
            'email'=>'required|email:rfc,dns',
            'shipping_address'=> 'required|min:3|max:255',
            'date_delivery'=> 'required|date|after:yesterday',
            'time_delivery'=> 'required|date_format:H:i',
            'total_price'=> 'required|integer',
            'plate_id'=>'required_without_all'
        ]);
        
        $plates=Plate::findOrFail($request->plate_id);

        //validazione ora consegna
        date_default_timezone_set("Europe/Rome");
        $date = date('Y-m-d');
        $hour = date("H:i:s");
        $minTime = '08:00';
        $maxTime = '23:00';
        $firstAvailable = date('H:i', strtotime('+25 minutes', strtotime($hour)));
        if($request->date_delivery < $date || $request->time_delivery < $minTime || $request->time_delivery > $maxTime){
            return redirect()->route('restaurant-details',$plates[0]->restaurant_id);
        };
        // consegna non possibile
        if($request->date_delivery == $date && $firstAvailable > $request->time_delivery){
            return redirect()->route('restaurant-details',$plates[0]->restaurant_id);
        };

        $order=Order::make($validated);
        $order->save();
        for($i=0;$i<count($request->plate_id);$i++){
            $var = $request->plate_id[$i];
            $order->plates()->attach($var);
            $order->save();
        }
        $order->save();
        
        return redirect()->route('home');
    }
}
