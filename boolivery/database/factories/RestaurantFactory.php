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
            'description' => 'Famosa catena di hamburger Americana, tutti i prodotti sono freschi e preparati al momento',
            'image_cover' => '',
            'image_profile' => '',
            'popular' => '1',
            'vote' => '5'
        ],
        [
            'user_id' => '1',
            'restaurant_name' => 'Poke House', //etnico, giapponese
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
            'restaurant_name' => 'Antica Cina', //cinese, etnico
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
            'restaurant_name' => 'Da Giannino',//mediterranea, carne
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
            'restaurant_name' => 'El Centenario',//messicano, carne, pesce
            'address_restaurant' => 'Via Garibaldi 4',
            'phone' => '023521879',
            'email' => 'elcentenario@mail.it',
            'description' => "Locale spazioso dove si possono ordinare diverse proposte messicane, soprattutto di carne. El Centenario si trova nella centralissima Via Garibaldi e ne rappresenta perfettamente lo spirito: qui non si viene soltanto per mangiare ma anche per scatenarsi tra canti, balli e durante le tantissime feste a tema che vengono organizzate.",
            'image_cover' => 'elcentenariocover.png',
            'image_profile' => 'elcentenariologo.png',
            'popular' => '1',
            'vote' => '5'
        ],
        [
            'user_id' => '3',
            'restaurant_name' => 'Il Bistrot',//mediterraneo, pesce
            'address_restaurant' => 'Via dei Giardini 20',
            'phone' => '023521421',
            'email' => 'bistrot@mail.it',
            'description' => "Il Ristorante offre genuinità di prodotti dell’orto di famiglia con sapori inconsueti. Essi generano sulla tavola alchimie armoniose che inebriano anche i palati più esigenti. Dall'atmosfera della sala alle calde serate nel centro città.Questo locale mette l’accento sul gusto e sulla qualità delle materie prime e fonda la sua proposta su piatti easy a prezzi corretti.",
            'image_cover' => 'ilbistroitcover',
            'image_profile' => 'ilbistroitlogo',
            'popular' => '1',
            'vote' => '5'
        ],
        [
            'user_id' => '4',
            'restaurant_name' => 'Bella Napoli',//pizza, mediterraneo
            'address_restaurant' => 'Viale Mazzini 32',
            'phone' => '023521843',
            'email' => 'bellanapoli@mail.it',
            'description' => "E’ un nuovo modo di intendere, preparare e gustare la pizza. Dal 2015, portiamo nel panorama gastronomico una filosofia basata sulla leggerezza del prodotto e sulla particolarità delle ricette. La continua ricerca di un attento equilibrio tra tradizione napoletana e innovazione contemporanea ci spinge a migliorare ogni giorno per offrirvi un’esperienza veramente gourmet.",
            'image_cover' => 'bellanapolicover',
            'image_profile' => 'bellanapolilogo',
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
            'popular' => '0',
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
            'popular' => '0',
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
