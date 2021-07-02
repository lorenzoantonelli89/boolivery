<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
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
        
        $restaurant = Restaurant::findOrFail(Crypt::decrypt($id));
        
        return view('admin.list-plate', compact('restaurant'));
        
    }

    /* funzione che permette la modifica del singolo piatto */
    public function editPlate($id){
        
        $plate = Plate::findOrFail(Crypt::decrypt($id));

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
        $restaurant = Restaurant::findOrFail($plate->restaurant_id);
        
        if($request->file('image') != null){
            $img=$request->file('image');
            $imgExt = $img -> getClientOriginalExtension();
            $imgNewName = time() . '_plateImage.' . $imgExt;
            $folder = '/restaurant-plates/';
            $imgFile=$img->storeAs($folder,$imgNewName,'public'); 
            $plate->image=$imgNewName;
            $plate -> save();
        }

        return redirect() -> route('plateList',encrypt($restaurant->id));
    }

    /* funzione che permette la creazione di un piatto */
    public function createPlate($id){
        $restaurant=Restaurant::findOrFail(Crypt::decrypt($id));
        return view('admin.create-plate', compact('restaurant'));
    }

    /* funzione associata a createPlate che salva il piatto creato */
    public function storePlate(Request $request, $id){

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

        return redirect() -> route('plateList',encrypt($restaurant->id));
    }

    // funzione per cancellare piatto con softdelete
    public function deletePlate($id){

        $plate = Plate::findOrFail($id);
        if($plate->visible == 1){
            $plate->visible = 0;
            $plate->save();
        } else {
            $plate->visible = 1;
            $plate->save();
        }
        
        //dd($plate->restaurant_id);
        return redirect()->route('plateList',encrypt($plate -> restaurant->id));
    }
    
}
