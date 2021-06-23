<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Plate;
use App\Order;
use Braintree;

class PaymentController extends Controller
{
    private function braintree(){
        $gateway = new Braintree\Gateway([
            'environment' => env('BT_ENVIRONMENT'),
            'merchantId' => env('BT_MERCHANT_ID'),
            'publicKey' => env('BT_PUBLIC_KEY'),
            'privateKey' => env('BT_PRIVATE_KEY')
        ]);

        return $gateway;
    }
    public function checkout(Request $request, $id){

        $order = Order::findOrFail(Crypt::decrypt($id));
        
        $gateway = $this -> braintree();
        $amount = $request -> amount;
        $nonce = $request -> payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $transaction = $result->transaction;
            $order -> status = true;
            $order -> save();
            // header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
            // return back() -> with('success_message', 'Transazione riuscita, con id: ' . $transaction -> id);
            return view('pages.checkout', compact('transaction'));
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            $error = $result -> message;
            // $_SESSION["errors"] = $errorString;
            // header("Location: " . $baseUrl . "index.php");
            return back() -> withErrors('An error occured with the message:' . $result -> message);
            // return view('pages.check-out', compact('error'));
        }
    }
    public function storeOrder(Request $request){

        $validated = $request -> validate([
            'name'=> 'required|min:3|max:255',
            'lastname'=> 'required|min:3|max:255',
            'email'=>'required|email:rfc,dns',
            'shipping_address'=> 'required|min:3|max:255',
            'date_delivery'=> 'required|date|after:yesterday',
            'time_delivery'=> 'required|date_format:H:i',
            'total_price'=> 'required|integer',
            'status'=> 'required|boolean',
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
        $gateway = $this -> braintree();
        $token = $gateway->ClientToken()->generate();
        // dd($order);
        
        return view('pages.payment', compact('token','order'));
        // return redirect()->route('payment', compact('order'));
    }
}
