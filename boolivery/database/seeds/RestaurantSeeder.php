<?php

use Illuminate\Database\Seeder;

use App\Restaurant;
use App\Category;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Restaurant::class, 10) -> create()->each(function($restaurant){

            $category = Category::inRandomOrder()
                    -> limit(rand(1, 2))
                    -> get();
            $restaurant -> categories() -> attach($category);
            
            $restaurant -> save();
        });
    }
}
