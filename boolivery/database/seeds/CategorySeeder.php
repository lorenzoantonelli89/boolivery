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
        // array di tutte le categorie
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

        // ciclo su array categorie e inserimento in tabella di ogni elemento
        foreach($categories as $key => $category){

            DB::table('categories') -> insert([
                'name' => $category['category'] 
            ]);
            
        }
    }
}
