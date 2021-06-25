<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Plate;
use App\restaurant;

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
        });
    }
}
