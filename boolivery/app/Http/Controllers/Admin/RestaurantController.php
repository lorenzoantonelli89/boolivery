<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
