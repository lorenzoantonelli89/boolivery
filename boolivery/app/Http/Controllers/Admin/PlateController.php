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


    public function restaurantList(){

        $restaurants = Restaurant::all();

        return view('admin.list-restaurant', compact('restaurants'));
    }


    public function plateList($id){

        $restaurant = Restaurant::findOrFail($id);
        
        
        return view('admin.list-plate', compact('restaurant' ));
        /*         $plates =Plate::where('restaurant_id',$restaurant-> id) -> get(); 
        */
    }


    public function editPlate($id){
        
        $plate = Plate::findOrFail($id);
       

        return view('admin.edit-plate', compact('plate'));
    }

    public function updatePlate(Request $request, $id){

        $validated = $request -> validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric|between:0,99.99',
        ]);


        $img=$request->file('image');
        $imgExt = $img -> getClientOriginalExtension();
        $imgNewName = time() . '_plateImage.' . $imgExt;
        $folder = '/restaurant-plates/';
        $imgFile=$img->storeAs($folder,$imgNewName,'public');
        

        
        $plate = Plate::findOrFail($id);
        $plate -> update($validated);
        $plate ->restaurant() -> associate($request -> restaurant_id);
        $plate -> save();

        $plate ->restaurant() ->sync($request -> plate_id);

        return redirect() ->route('plateList');
    }


    public function createPlate(){

        return view('admin.create-plate');
    }


    public function storePlate(Request $request){

        $validated = $request -> validate([
           'name' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:3',
/*             'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'required|numeric|between:0,99.99', 
 */        ]);

        
/*         $img=$request->file('image');
        $imgExt = $img -> getClientOriginalExtension();
        $imgNewName = time() . '_plateImage.' . $imgExt;
        $folder = '/restaurant-plates/';
        $imgFile=$img->storeAs($folder,$imgNewName,'public');
 *//*         dd($img, $imgExt, $imgNewName);
 */
        $plate = Plate::make($validated);
        $restaurant = Restaurant::findOrFail($request -> id);
        $plate -> restaurant() -> associate($restaurant);
/*          $plate-> image = $imgNewName;
 */         $plate -> save();

     
        return redirect() -> route('plateList', $restaurant ->id);
    }
    
}
