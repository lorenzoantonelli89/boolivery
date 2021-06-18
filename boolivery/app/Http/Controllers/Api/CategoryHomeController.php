<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Category;

class CategoryHomeController extends Controller
{
    // funzione che manda al FE tramite chiamata axios in vue array di categorie
    public function getCategories(){

        $categories = Category::all();

        return response() ->json($categories);
    }
}
