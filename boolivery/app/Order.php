<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_email',
        'name',
        'lastname',
        'shipping_address',
        'date_delivery',
        'time_delivery',
        'total_price',
        'status',
    ];

    public function plates(){
        return $this->belongsToMany(Plate::class);
    }
}
