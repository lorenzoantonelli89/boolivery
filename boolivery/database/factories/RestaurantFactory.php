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
            'name' => 'Five Guys', //fastfood
            'address' => 'Piazza Duomo 25',
            'phone' => '023521321',
            'email' => 'fiveguys@mail.it',
            'description' => 'Famosa catena di hamburger Americana, tutti i prodotti sono freschi e preparati al momento.',
            'image_cover' => 'fiveguyscover.png',
            'image_profile' => 'fiveguyslogo.png',
            'popular' => 1,
        ],
        [
            'user_id' => '1',
            'name' => 'Poke House', //etnico, giapponese
            'address' => 'Via Buenos Aires 11',
            'phone' => '025579873',
            'email' => 'pokehouse@mail.it',
            'description' => 'Nelle nostre House potrai gustare freschissime poke bowl, immerso in un ambiente trendy e rilassato.',
            'image_cover' => 'pokehousecover.png',
            'image_profile' => 'pokehouselogo.png',
            'popular' => 1,
        ],
        [
            'user_id' => '2',
            'name' => 'Antica Cina', //cinese, etnico
            'address' => 'Via Milano 35',
            'phone' => '0235215678',
            'email' => 'anticacina@mail.it',
            'description' => 'Nel nostro locale potrai assaporare la vera cucina tradizionale cinese.',
            'image_cover' => 'anticacinacover.png',
            'image_profile' => 'anticacinalogo.png',
            'popular' => 0,
        ],
        [
            'user_id' => '2',
            'name' => 'Da Giannino',//mediterranea, carne
            'address' => 'Via Cavour 35',
            'phone' => '023521999',
            'email' => 'dagiannino@mail.it',
            'description' => 'Da Giannino troverai un vero angolo abruzzese con le specialità della nostra terra.',
            'image_cover' => 'dagianninocover.png',
            'image_profile' => 'dagianninologo.png',
            'popular' => 0,
        ],
        [
            'user_id' => '3',
            'name' => 'El Centenario',//messicano, carne, pesce
            'address' => 'Via Garibaldi 4',
            'phone' => '023521879',
            'email' => 'elcentenario@mail.it',
            'description' => "Locale spazioso dove si possono ordinare diverse proposte messicane, soprattutto di carne. El Centenario si trova nella centralissima Via Garibaldi e ne rappresenta perfettamente lo spirito: qui non si viene soltanto per mangiare ma anche per scatenarsi tra canti, balli e durante le tantissime feste a tema che vengono organizzate.",
            'image_cover' => 'elcentenariocover.png',
            'image_profile' => 'elcentenariologo.png',
            'popular' => 1,
        ],
        [
            'user_id' => '3',
            'name' => 'Il Bistrot',//mediterraneo, pesce
            'address' => 'Via dei Giardini 20',
            'phone' => '023521421',
            'email' => 'bistrot@mail.it',
            'description' => "Il Ristorante offre genuinità di prodotti dell’orto di famiglia con sapori inconsueti. Essi generano sulla tavola alchimie armoniose che inebriano anche i palati più esigenti. Dall'atmosfera della sala alle calde serate nel centro città.Questo locale mette l’accento sul gusto e sulla qualità delle materie prime e fonda la sua proposta su piatti easy a prezzi corretti.",
            'image_cover' => 'ilbistroitcover.png',
            'image_profile' => 'ilbistroitlogo.png',
            'popular' => 1,
        ],
        [
            'user_id' => '4',
            'name' => 'Bella Napoli',//pizza, mediterraneo
            'address' => 'Viale Mazzini 32',
            'phone' => '023521843',
            'email' => 'bellanapoli@mail.it',
            'description' => "E’ un nuovo modo di intendere, preparare e gustare la pizza. Dal 2015, portiamo nel panorama gastronomico una filosofia basata sulla leggerezza del prodotto e sulla particolarità delle ricette. La continua ricerca di un attento equilibrio tra tradizione napoletana e innovazione contemporanea ci spinge a migliorare ogni giorno per offrirvi un’esperienza veramente gourmet.",
            'image_cover' => 'bellanapolicover.png',
            'image_profile' => 'bellanapolilogo.png',
            'popular' => 1,
        ],
        [
            'user_id' => '4',
            'name' => 'Piaceri di Patata',//vegano
            'address' => 'Via Salasco 34',
            'phone' => '023521199',
            'email' => 'piaceridipatata@mail.it',
            'description' => 'Tutto, dagli antipasti ai dolci, è interamente pensato per valorizzare la regina del Piaceri di Patata, che vedrete preparata in numerosi modi diversi, sempre squisiti, curando non solo il gusto, ma anche la vista.',
            'image_cover' => 'piacieridipatatacover.png',
            'image_profile' => 'piacieridipatatalogo.png',
            'popular' => 0,
        ],
        [
            'user_id' => '5',
            'name' => 'Pizza Hut',//pizza, fastfood
            'address' => 'Via Torquato Tasso 5',
            'phone' => '023521766',
            'email' => 'pizzahut@mail.it',
            'description' => 'Pizza Hut è una catena di ristorazione statunitense con sede a Dallas, in Texas, nel quartiere settentrionale di Addison, fondata nel 1958 dai fratelli Dan e Frank. Approda in italia per soddisfare i tuoi desideridi pizza. ',
            'image_cover' => 'pizzahutcover.png',
            'image_profile' => 'pizzahutlogo.png',
            'popular' => 0,
        ],
        [
            'user_id' => '5',
            'name' => 'Homu',//etnico, cinese, giapponese
            'address' => 'Corso Filippo Turati 9/A',
            'phone' => '023521498',
            'email' => 'Homu@mail.it',
            'description' => "Ideato da Johnny Hu, con l'obiettivo  di offrire ai propri clienti una pura esperienza, non solo culinaria, del Giappone: cibo, bevande, usi e costumi dell'estremo oriente.",
            'image_cover' => 'pokehousecover.png',
            'image_profile' => 'pokehouselogo.png',
            'popular' => 1,
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
        'name' => $restaurant['name'],
        'address' => $restaurant['address'] ,
        'phone' => $restaurant['phone'],
        'email' => $restaurant['email'],
        'description' => $restaurant['description'],
        'image_cover' => $restaurant['image_cover'],
        'image_profile' => $restaurant['image_profile'],
        'popular' => $restaurant['popular'],
    ];
});
// funziona che autoincrementa il valore ad ogni giro
function autoIncrement()
{
    for ($i = -1; $i < 10; $i++) {
        yield $i;
    }
}
