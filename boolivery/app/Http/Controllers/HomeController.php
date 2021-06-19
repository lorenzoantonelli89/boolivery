<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Restaurant;


class HomeController extends Controller
{
    // funzione che ritorna nella 
    public function home()
    {   
        $categories = Category::all();
        $restaurants = Restaurant::all();


        return view('pages.home', compact('categories', 'restaurants'));
    }
}
