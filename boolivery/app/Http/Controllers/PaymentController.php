<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Plate;
use App\Order;

class PaymentController extends Controller
{
    public function createOrder(Request $request){

        $validated = $request -> validate([
            'name'=> 'required|min:3|max:255',
            'lastname'=> 'required|min:3|max:255',
            'email'=>'required|email:rfc,dns',
            'shipping_address'=> 'required|min:3|max:255',
            // 'date_delivery'=> 'required|date',
            // 'time_delivery'=> 'nullable',
            'total_price'=> 'required|integer',
            'status'=> 'required|boolean',
        ]);
        $plates=Plate::findOrFail($request->plates_ids);
        $order=Order::make($validated);
        $order->save();
        for($i=0;$i<count($request->plates_ids);$i++){
            $var = $request->plates_ids[$i];
            $order->plates()->attach($var);
            $order->save();
        }
        $order->save();
        
        return redirect()->route('home');
    }
}
