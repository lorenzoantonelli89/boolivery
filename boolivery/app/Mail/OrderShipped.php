<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    
    public function __construct($order)
    {
        $this -> order = $order;
    }

    
    public function build()
    {   

        return $this->view('mail.new-order')
                    ->with([
                        'name' => $this -> order -> name,
                        'lastname' => $this -> order -> lastname,
                        'email' => $this -> order -> email,
                        'shipping_address' => $this -> order -> shipping_address,
                        'date_delivery' => $this -> order -> date_delivery,
                        'time_delivery' => $this -> order -> time_delivery,
                        'total_price' => $this -> order -> total_price,
                        'status' => $this -> order -> status,
                    ]);
    }
}
