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
        'date_delivery'=>$faker -> dateTimeBetween($startDate = '-10 years', $endDate = 'now', $timezone = null),
        'time_delivery'=>$faker-> time($format = 'H:i:s'),
        'total_price'=>$faker-> numberBetween(7,100),
        'status'=> 1
    ];
});
