<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Restaurant;
use App\User;
use App\Category;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listRestaurant(){ //mostro lista ristoranti user loggato

        $user= Auth::user();
        $restaurants=$user->restaurants()->get();
        return view('admin.list-restaurant', compact('restaurants','user'));
    }

    public function createRestaurant(){ //pag.creazione ristorante

        $categories = Category::all();
        return view('admin.create-restaurant',compact('categories'));
    }

    public function storeRestaurant(Request $request){ // pag.salvataggio ristorante

        $validated=$request->validate([
           'name' => 'required|min:3|max:255',
           'address'=>'required|min:3|max:255',
           'phone'=>'required|min:6|max:64',
           'email'=>'required|email:rfc,dns',
           'description'=>'nullable|max: 1000',
           'image_cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'image_profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'category_id' => 'required_without_all',
        ]);
        //rinomina foto profilo
        $img=$request->file('image_profile');
        $imgExt = $img -> getClientOriginalExtension();
        $imgNewName = time() . '_profile.' . $imgExt;
        $folder = '/restaurant-profile/';
        $imgFile=$img->storeAs($folder,$imgNewName,'public');
        //rinomina foto cover
        $cover=$request->file('image_cover');
        $coverExt = $cover -> getClientOriginalExtension();
        $coverNewName = time() . '_cover.' . $coverExt;
        $folderCover = '/restaurant-cover/';
        $coverFile=$cover->storeAs($folderCover,$coverNewName,'public');
        //associazione user_id e salvataggio
        $user= Auth::user();
        $restaurant= Restaurant::make($validated);
        $restaurant->user()->associate($user);
        $restaurant->image_profile = $imgNewName;
        $restaurant->image_cover = $coverNewName;
        $restaurant->save();
        //associazione categorie e salvataggio
        $categories = Category::findOrFail($request->category_id);
        $restaurant->categories()->attach($categories);
        $restaurant->save();

        return redirect()->route('listRestaurant',$user->id); //redirect alla pagina risto dello user
    }

    public function editRestaurant($id){ // pag. edit ristorante

        $restaurant = Restaurant::findOrFail(Crypt::decrypt($id));
        $categories = Category::all();
        return view('admin.edit-restaurant',compact('restaurant','categories'));
    }

    public function updateRestaurant(Request $request,$id){ //pag.salvataggio update ristorante

        $validated=$request->validate([
            'name' => 'required|min:3|max:255',
            'address'=>'required|min:3|max:255',
            'phone'=>'required|min:6|max:64',
            'email'=>'required|email:rfc,dns',
            'description'=>'nullable|max: 1000',
            'image_cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_profile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id'=>'required_without_all',
         ]);
         //salvataggio dati
        $categories = Category::findOrFail($request->category_id);
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update($validated);
        $restaurant->categories()->sync($categories);
        $restaurant->save();
        //se è stata selezionata una nuova foto profilo, fai update
        if($request->file('image_profile') != null){
            $img=$request->file('image_profile');
            $imgExt = $img -> getClientOriginalExtension();
            $imgNewName = time() . '_profile.' . $imgExt;
            $folder = '/restaurant-profile/';
            $imgFile=$img->storeAs($folder,$imgNewName,'public');
            $restaurant = Restaurant::findOrFail($id);
            $restaurant->image_profile = $imgNewName;    
            $restaurant->save();
        };
        //se è stata selezionata una nuova foto cover, fai update
        if($request->file('image_cover') != null){
            $cover=$request->file('image_cover');
            $coverExt = $cover -> getClientOriginalExtension();
            $coverNewName = time() . '_cover.' . $coverExt;
            $folderCover = '/restaurant-cover/';
            $coverFile=$cover->storeAs($folderCover,$coverNewName,'public');
            $restaurant = Restaurant::findOrFail($id);
            $restaurant->image_cover = $coverNewName;
            $restaurant->save();
        };

        return redirect()->route('listRestaurant');
    }

    public function showStats($id){ //funzione per mostrare pagina statistiche

        $restaurant = Restaurant::findOrFail(Crypt::decrypt($id));
        return view('admin.orderStats',compact('restaurant'));
    }
}
