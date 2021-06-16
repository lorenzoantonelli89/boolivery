<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class PlateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
}
