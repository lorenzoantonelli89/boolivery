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
        // creiamo 10 ristoranti presi dall'array dentro la RestaurantFactory e associo con uno switch il ristorante alle categorie corrispondenti
        factory(Restaurant::class, 10) -> create()->each(function($restaurant){

            $categories = Category::all();

            switch($restaurant['restaurant_name']){

                case 'Five Guys': 
                    $restaurant -> categories() -> attach($categories[5]);
                    $restaurant -> save();
                    break;

                case  'Poke House':
                    $restaurant -> categories() -> attach($categories[1]);
                    $restaurant -> categories() -> attach($categories[3]);
                    $restaurant -> save();
                    break;

                case  'Antica Cina':
                    $restaurant -> categories() -> attach($categories[1]);
                    $restaurant -> categories() -> attach($categories[3]);
                    $restaurant -> save();
                    break;

                case 'Da Giannino':
                    $restaurant -> categories() -> attach($categories[0]);
                    $restaurant -> categories() -> attach($categories[8]);
                    $restaurant -> save();
                    break;

                case 'El Centenario':
                    $restaurant -> categories() -> attach($categories[6]);
                    $restaurant -> categories() -> attach($categories[8]);
                    $restaurant -> categories() -> attach($categories[9]);
                    $restaurant -> save();
                    break;  

                case 'Il Bistrot':
                    $restaurant -> categories() -> attach($categories[0]);
                    $restaurant -> categories() -> attach($categories[9]);
                    $restaurant -> save();
                    break; 

                case 'Bella Napoli':
                    $restaurant -> categories() -> attach($categories[0]);
                    $restaurant -> categories() -> attach($categories[7]);
                    $restaurant -> save();
                    break;
                
                case 'Piaceri di Patata':
                    $restaurant -> categories() -> attach($categories[4]);
                    $restaurant -> save();
                    break;
                
                case 'Pizza Hut':
                    $restaurant -> categories() -> attach($categories[5]);
                    $restaurant -> categories() -> attach($categories[7]);
                    $restaurant -> save();
                    break; 
                
                case 'Homu':
                    $restaurant -> categories() -> attach($categories[1]);
                    $restaurant -> categories() -> attach($categories[2]);
                    $restaurant -> categories() -> attach($categories[3]);
                    $restaurant -> save();
                    break;     
                
            }

        });
    }
}
