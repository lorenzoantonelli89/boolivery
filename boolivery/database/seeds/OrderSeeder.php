<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\Plate;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 200) -> create()
            -> each(function($order) {
            $plates = Plate::inRandomOrder()
                        -> limit(rand(1,3))
                        -> get();
            $order -> plates() -> attach($plates);
            $order -> save();
        });
    }
}
