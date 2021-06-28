<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Plate;
use App\Restaurant;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 1000) -> create()
            -> each(function($order) {
            $restaurant = Restaurant::inRandomOrder()->first();
            $plates = $restaurant -> plates()
            ->limit(rand(1,7))
            ->get();
            $order -> plates() -> attach($plates);
            $order -> save();
            $total_price = 0;
            foreach($plates as $plate){
                $total_price += $plate->price;
            };
            if($total_price > 20){
                $order->total_price = $total_price;
                $order->save();
            } else {
                $order->total_price = $total_price +5;
                $order->save();
            }
        });
    }
}
