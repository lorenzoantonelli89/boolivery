<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Restaurant;

class GuestController extends Controller
{
    // funzione che ritora in pagina il ristorante nel dettaglio 
    public function detailsRestaurant($id){

        $restaurant = Restaurant::findOrFail($id);

        return view('pages.restaurant-details', compact('restaurant'));
    }
    // funzione che riporta alla pagina chi siamo
    public function infoCompany(){

        return view('pages.info-company');
    }
    // funzione che riporta alla pagina delle faq
    public function faq(){

        return view('pages.faq');
    }
    // funzione che riporta alla pagina dei contatti
    public function contacts(){

        return view('pages.contacts');
    }
    
}
