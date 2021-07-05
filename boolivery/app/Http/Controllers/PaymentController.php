<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;

use Braintree;
use App\Plate;
use App\Order;
use App\Mail\OrderShipped;

class PaymentController extends Controller
{
    // funzione privata che ritorna array di dati di braintree
    private function braintree(){
        $gateway = new Braintree\Gateway([
            'environment' => env('BT_ENVIRONMENT'),
            'merchantId' => env('BT_MERCHANT_ID'),
            'publicKey' => env('BT_PUBLIC_KEY'),
            'privateKey' => env('BT_PRIVATE_KEY')
        ]);

        return $gateway;
    }
    // funzione che prende i dati della carta e tramite id ordine passato come parametro
    public function checkout(Request $request, $id){

        $order = Order::findOrFail(Crypt::decrypt($id));
        // faccio partire i controlli di braintree
        $gateway = $this -> braintree();
        $amount = $request -> amount;
        $nonce = $request -> payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'customer' => [
                'firstName' => $order -> name,
                'lastName' => $order -> lastname,
                'email' => $order -> customer_email,
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        // se è andato a buon fine cambio lo status dell'ordine da false a true e ritorno alla pagina checkout
        if ($result->success) {
            $transaction = $result->transaction;
            $order -> status = true;
            $order -> save();
            Mail::to($order -> customer_email)->send(new OrderShipped($order));
            return view('pages.checkout', compact('transaction', 'order'));
        // se non è andato a buon fine lo status ordine rimane a false e ritorno in pagina checkout con un errore 
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            $error = $result -> message;
            
            return view('pages.checkout', compact('error'));
            // return back() -> withErrors('An error occured with the message:' . $result -> message);
        }
    }
    public function storeOrder(Request $request){

        $validated = $request -> validate([
            'name'=> 'required|min:3|max:255',
            'lastname'=> 'required|min:3|max:255',
            'customer_email'=>'required|email:rfc,dns',
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
        $gateway = $this -> braintree();
        $token = $gateway->ClientToken()->generate();
        
        return view('pages.payment', compact('token','order'));
    }
}

