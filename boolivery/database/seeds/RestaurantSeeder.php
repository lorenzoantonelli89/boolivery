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
        // factory(Restaurant::class, 10) -> create()->each(function($restaurant){

        //     $category = Category::inRandomOrder()
        //             -> limit(rand(1, 2))
        //             -> get();
        //     $restaurant -> categories() -> attach($category);
            
        //     $restaurant -> save();
        // });

        factory(Restaurant::class, 10) -> create()->each(function($restaurant){

            // $categories = Category::all();
            // foreach($categories as $category){

            //     // switch($restaurant['restaurant_name']){

            //     //     case 'Five Guys': 

            //     //         $restaurant -> categories() -> attach($category['id'] == 6);
            //     //         // $restaurant -> categories() -> attach($category['id'] == 2);
            //     //         $restaurant -> save();
            //     // }

            //     if($restaurant['restaurant_name'] == 'Five Guys'){
                    
            //         $restaurant -> categories() -> attach($category['id']);
            
            //         $restaurant -> save();
            //     }
            // }
            $category = Category::inRandomOrder()
                    -> limit(rand(1, 2))
                    -> get();
            $restaurant -> categories() -> attach($category);
            
            $restaurant -> save();
        });
    }
}
