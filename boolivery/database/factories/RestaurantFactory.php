<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    $restaurants = [
            [
                'user_id' => '1',
                'restaurant_name' => 'Five Guys',
                'address_restaurant' => 'Piazza Duomo 25',
                'phone' => '023521321',
                'email' => 'fiveguys@mail.it',
                'description' => 'Famosa catena di hamburger Americana, tutti i prodotti sono freschi e preparati al momento',
                'image_cover' => '',
                'image_profile' => '',
                'popular' => '1',
                'vote' => '5'
            ],
            [
                'user_id' => '1',
                'restaurant_name' => 'Poke House',
                'address_restaurant' => 'Via Buenos Aires 11',
                'phone' => '025579873',
                'email' => 'pokehouse@mail.it',
                'description' => '',
                'image_cover' => '',
                'image_profile' => '',
                'popular' => '1',
                'vote' => '5'
            ],
            [
                'user_id' => '2',
                'restaurant_name' => 'Homu',
                'address_restaurant' => 'Piazza Duomo 25',
                'phone' => '0235215678',
                'email' => 'homu@mail.it',
                'description' => 'Famosa catena di hamburger Americana, tutti i prodotti sono freschi e preparati al momento',
                'image_cover' => '',
                'image_profile' => '',
                'popular' => '1',
                'vote' => '5'
            ],
            [
                'user_id' => '2',
                'restaurant_name' => 'Da Giannino',
                'address_restaurant' => 'Piazza Duomo 25',
                'phone' => '023521999',
                'email' => 'dagiannino@mail.it',
                'description' => 'Famosa catena di hamburger Americana, tutti i prodotti sono freschi e preparati al momento',
                'image_cover' => '',
                'image_profile' => '',
                'popular' => '1',
                'vote' => '5'
            ],
            [
                'user_id' => '3',
                'restaurant_name' => 'El Centenario',
                'address_restaurant' => 'Piazza Duomo 25',
                'phone' => '023521879',
                'email' => 'elcentenario@mail.it',
                'description' => 'Famosa catena di hamburger Americana, tutti i prodotti sono freschi e preparati al momento',
                'image_cover' => '',
                'image_profile' => '',
                'popular' => '1',
                'vote' => '5'
            ],
            [
                'user_id' => '3',
                'restaurant_name' => 'Il Bistroit',
                'address_restaurant' => 'Piazza Duomo 25',
                'phone' => '023521421',
                'email' => 'bistroit@mail.it',
                'description' => 'Famosa catena di hamburger Americana, tutti i prodotti sono freschi e preparati al momento',
                'image_cover' => '',
                'image_profile' => '',
                'popular' => '1',
                'vote' => '5'
            ],
            [
                'user_id' => '4',
                'restaurant_name' => 'Sicily',
                'address_restaurant' => 'Piazza Duomo 25',
                'phone' => '023521843',
                'email' => 'sicily@mail.it',
                'description' => 'Famosa catena di hamburger Americana, tutti i prodotti sono freschi e preparati al momento',
                'image_cover' => '',
                'image_profile' => '',
                'popular' => '1',
                'vote' => '5'
            ],
            [
                'user_id' => '4',
                'restaurant_name' => 'La Taverna',
                'address_restaurant' => 'Piazza Duomo 25',
                'phone' => '023521199',
                'email' => 'lataverna@mail.it',
                'description' => 'Famosa catena di hamburger Americana, tutti i prodotti sono freschi e preparati al momento',
                'image_cover' => '',
                'image_profile' => '',
                'popular' => '1',
                'vote' => '5'
            ],
            [
                'user_id' => '5',
                'restaurant_name' => 'Cantine Risso',
                'address_restaurant' => 'Piazza Duomo 25',
                'phone' => '023521766',
                'email' => 'cantinerisso@mail.it',
                'description' => 'Famosa catena di hamburger Americana, tutti i prodotti sono freschi e preparati al momento',
                'image_cover' => '',
                'image_profile' => '',
                'popular' => '1',
                'vote' => '5'
            ],
            [
                'user_id' => '5',
                'restaurant_name' => 'Casa Goffi',
                'address_restaurant' => 'Piazza Duomo 25',
                'phone' => '023521498',
                'email' => 'casagoffi@mail.it',
                'description' => 'Famosa catena di hamburger Americana, tutti i prodotti sono freschi e preparati al momento',
                'image_cover' => '',
                'image_profile' => '',
                'popular' => '1',
                'vote' => '5'
            ],
        ];
    $index= $faker -> unique() -> numberBetween(0, 9);
    $restaurant = $restaurants[$index];
    return [
        'user_id' => $restaurant['user_id'],
        'restaurant_name' => $restaurant['restaurant_name'],
        'address_restaurant' => $restaurant['address_restaurant'] ,
        'phone' => $restaurant['phone'],
        'email' => $restaurant['email'],
        'description' => $restaurant['description'],
        'image_cover' => $restaurant['image_cover'],
        'image_profile' => $restaurant['image_profile'],
        'popular' => $restaurant['popular'],
        'vote' => $restaurant['vote'],
    ];
});
