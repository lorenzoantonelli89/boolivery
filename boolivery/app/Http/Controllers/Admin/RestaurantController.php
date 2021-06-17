<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\User;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listRestaurant(){

        
        $user= Auth::user();
        $restaurants=Restaurant::where('user_id',$user->id)->get();
        return view('admin.list-restaurant', compact('restaurants','user'));
    }

    public function createRestaurant($id){

        $user = User::findOrFail($id);
        return view('admin.create-restaurant',compact('user'));
    }

    public function storeRestaurant(Request $request,$id){

        $validated=$request->validate([
           'restaurant_name' => 'required|min:3|max:255',
           'address_restaurant'=>'required|min:3',
           'phone'=>'required|min:6|max:64',
           'email'=>'unique:restaurants,email',
           'description'=>'max: 1000',
           'image_cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'image_profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'popular'=>'required|boolean',
            'user_id'=>'exists:users,id',
            'vote'=>'required|integer'
        ]);

        $img=$request->file('image_profile');
        $imgExt = $img -> getClientOriginalExtension();
        $imgNewName = time() . '_profile.' . $imgExt;
        $folder = '/restaurant-profile/';
        $imgFile=$img->storeAs($folder,$imgNewName,'public');

        $cover=$request->file('image_cover');
        $coverExt = $cover -> getClientOriginalExtension();
        $coverNewName = time() . '_cover.' . $coverExt;
        $folderCover = '/restaurant-cover/';
        $coverFile=$cover->storeAs($folderCover,$coverNewName,'public');

        $user = User::findOrFail($id);
        $restaurant= Restaurant::make($validated);
        $restaurant->user()->associate($user);
        $restaurant->image_profile = $imgNewName;
        $restaurant->image_cover = $coverNewName;
        $restaurant->save();

        return redirect()->route('listRestaurant',$id);
    }
}
