<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Restaurant;


class HomeController extends Controller
{
    // funzione che ritorna nella 
    public function home()
    {   
        // $restaurants = Restaurant::all();

        return view('pages.home');
    }
}
