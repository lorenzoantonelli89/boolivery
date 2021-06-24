<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'name' => $faker -> firstNameMale ,
        'lastname'=>$faker-> lastName,
        'email'=>$faker-> email ,
        'shipping_address'=>$faker-> streetAddress ,
        'date_delivery'=>$faker-> date($format = 'Y-m-d', $min = '2020-01-01', $max = 'now'),
        'time_delivery'=>$faker-> time($format = 'H:i:s'),
        'total_price'=>$faker-> numberBetween(7,100),
        'status'=> 1
    ];
});
