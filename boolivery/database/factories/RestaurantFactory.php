<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

// variabile che valorizzzata con la funzione auto incremente che è scritta dopo la $factory
$autoIncrement = autoIncrement();
$factory->define(Restaurant::class, function (Faker $faker) use ($autoIncrement) {
    // array ristoranti per popolare db
    $restaurants = [
        [
            'user_id' => '1',
            'restaurant_name' => 'Five Guys', //fastfood
            'address_restaurant' => 'Piazza Duomo 25',
            'phone' => '023521321',
            'email' => 'fiveguys@mail.it',
            'description' => 'Famosa catena di hamburger Americana, tutti i prodotti sono freschi e preparati al momento.',
            'image_cover' => 'fiveguyscover.png',
            'image_profile' => 'fiveguyslogo.png',
            'popular' => '1',
            'vote' => '5'
        ],
        [
            'user_id' => '1',
            'restaurant_name' => 'Poke House', //etnico, giapponese
            'address_restaurant' => 'Via Buenos Aires 11',
            'phone' => '025579873',
            'email' => 'pokehouse@mail.it',
            'description' => 'Nelle nostre House potrai gustare freschissime poke bowl, immerso in un ambiente trendy e rilassato.',
            'image_cover' => 'pokehousecover.png',
            'image_profile' => 'pokehouselogo.png',
            'popular' => '1',
            'vote' => '5'
        ],
        [
            'user_id' => '2',
            'restaurant_name' => 'Antica Cina', //cinese, etnico
            'address_restaurant' => 'Via Milano 35',
            'phone' => '0235215678',
            'email' => 'anticacina@mail.it',
            'description' => 'Nel nostro locale potrai assaporare la vera cucina tradizionale cinese.',
            'image_cover' => 'anticacinacover.png',
            'image_profile' => 'anticacinalogo.png',
            'popular' => '0',
            'vote' => '5'
        ],
        [
            'user_id' => '2',
            'restaurant_name' => 'Da Giannino',//mediterranea, carne
            'address_restaurant' => 'Via Cavour 35',
            'phone' => '023521999',
            'email' => 'dagiannino@mail.it',
            'description' => 'Da Giannino troverai un vero angolo abruzzese con le specialità della nostra terra.',
            'image_cover' => 'dagianninocover.png',
            'image_profile' => 'dagianninologo.png',
            'popular' => '0',
            'vote' => '5'
        ],
        [
            'user_id' => '3',
            'restaurant_name' => 'El Centenario',//messicano, carne, pesce
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
            'restaurant_name' => 'Il Bistrot',//mediterraneo, pesce
            'address_restaurant' => 'Piazza Duomo 25',
            'phone' => '023521421',
            'email' => 'bistrot@mail.it',
            'description' => 'Famosa catena di hamburger Americana, tutti i prodotti sono freschi e preparati al momento',
            'image_cover' => '',
            'image_profile' => '',
            'popular' => '1',
            'vote' => '5'
        ],
        [
            'user_id' => '4',
            'restaurant_name' => 'Bella Napoli',//pizza, mediterraneo
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
            'restaurant_name' => 'Piaceri di Patata',//vegano
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
            'restaurant_name' => 'Pizza Hut',//pizza, fastfood
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
            'restaurant_name' => 'Homu',//etnico, cinese, giapponese
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
    // il valore $i nella funzione autoincremente incrementa il suo valore di 1 
    $autoIncrement->next();
    // la variabile index diventa il valore corrente incrementato
    $index= $autoIncrement->current();
    // la variabile restaurant diventa l'elemento con index definito dell array restaurants
    $restaurant = $restaurants[$index];
    // ritorniamo array composto da elementi presenti in table restaurants ogni giro si modificano in base alla posizione data dall'index che si incrementa
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
// funziona che autoincrementa il valore ad ogni giro
function autoIncrement()
{
    for ($i = -1; $i < 10; $i++) {
        yield $i;
    }
}
