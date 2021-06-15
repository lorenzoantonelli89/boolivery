<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [

            [
                'category' => 'Mediterraneo'
            ],
            [
                'category' => 'Etnico' 
            ],
            [
                'category' => 'Cinese'
            ],
            [
                'category' => 'Giapponese'
            ],
            [
                'category' => 'Vegano'
            ],
            [
                'category' => 'FastFood'
            ],
            [
                'category' => 'Messicano'
            ],
            [
                'category' => 'Pizza'
            ],
            [
                'category' => 'Carne'
            ],
            [
                'category' => 'Pesce'
            ],
        ];


        foreach($categories as $key => $category){

            DB::table('categories') -> insert([
                'category_name' => $category['category'] 
            ]);
            
        }
    }
}
