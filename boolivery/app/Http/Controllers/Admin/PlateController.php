<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\Plate;


class PlateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


   
    /* funzione che permette la visualizzazione di tutti i piatti del singolo ritorante */
    public function plateList($id){

        $restaurant = Restaurant::findOrFail($id);
        
        return view('admin.list-plate', compact('restaurant'));
        
    }

    /* funzione che permette la modifica del singolo piatto */
    public function editPlate($id){
        
        $plate = Plate::findOrFail($id);

        return view('admin.edit-plate', compact('plate'));
    }

    /* funzione associata a editPlate che salva le modifiche effettuate sul singolo piatto */
    public function updatePlate(Request $request, $id){

        $validated = $request -> validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|between:0.01,99.99', 
            'visible' => 'required|boolean', 

        ]);

        $plate=Plate::findOrFail($id);
        $plate -> update($validated);
        
        if($request->file('image') != null){
            $img=$request->file('image');
            $imgExt = $img -> getClientOriginalExtension();
            $imgNewName = time() . '_plateImage.' . $imgExt;
            $folder = '/restaurant-plates/';
            $imgFile=$img->storeAs($folder,$imgNewName,'public'); 
            $plate->image=$imgNewName;
            $plate -> save();
        }

        return redirect() -> route('plateList',$plate ->restaurant ->id);
    }

    /* funzione che permette la creazione di un piatto */
    public function createPlate($id){
        $restaurant=Restaurant::findOrFail($id);
        return view('admin.create-plate', compact('restaurant'));
    }

    /* funzione associata a createPlate che salva il piatto creato */
    public function storePlate(Request $request,$id){

        $validated = $request -> validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:3',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|between:0.01,99.99', 
            'visible' => 'required|boolean', 

         ]);

        $restaurant = Restaurant::findOrFail($id);
        $plate = Plate::make($validated);
        $plate -> restaurant() -> associate($restaurant);
         
         if($request->file('image') != null){
             $img=$request->file('image');
             $imgExt = $img -> getClientOriginalExtension();
             $imgNewName = time() . '_plateImage.' . $imgExt;
             $folder = '/restaurant-plates/';
             $imgFile=$img->storeAs($folder,$imgNewName,'public'); 
             $plate->image=$imgNewName;
            }
            else{
                $plate->image = 'default-plate.png';
            }
        $plate -> save();

        return redirect() -> route('plateList', $id);
    }
    
}
