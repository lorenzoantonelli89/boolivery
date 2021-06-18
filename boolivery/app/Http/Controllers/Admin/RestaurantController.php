<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\User;
use App\Category;

class RestaurantController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listRestaurant(){

        $user= Auth::user();
        $restaurants=$user->restaurants()->get();
        return view('admin.list-restaurant', compact('restaurants','user'));
    }

    public function createRestaurant(){

        $categories = Category::all();
        return view('admin.create-restaurant',compact('categories'));
    }

    public function storeRestaurant(Request $request){

        $validated=$request->validate([
           'name' => 'required|min:3|max:255',
           'address'=>'required|min:3',
           'phone'=>'required|min:6|max:64',
           'email'=>'unique:restaurants,email',
           'description'=>'max: 1000',
           'image_cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'image_profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'category_id' => 'required_without_all',
           //'user_id'=>'exists:users,id',
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

        $user= Auth::user();
        $restaurant= Restaurant::make($validated);
        $restaurant->user()->associate($user);
        $restaurant->image_profile = $imgNewName;
        $restaurant->image_cover = $coverNewName;
        $restaurant->save();

        $categories = Category::findOrFail($request->category_id);
        $restaurant->categories()->attach($categories);
        $restaurant->save();

        return redirect()->route('listRestaurant',$user->id);
    }

    public function editRestaurant($id){

        $restaurant = Restaurant::findOrFail($id);
        $categories = Category::all();
        return view('admin.edit-restaurant',compact('restaurant','categories'));
    }

    public function updateRestaurant(Request $request,$id){

        $validated=$request->validate([
            'name' => 'required|min:3|max:255',
            'address'=>'required|min:3',
            'phone'=>'required|min:6|max:64',
            'email'=>'unique:restaurants,email',
            'description'=>'max: 1000',
            'image_cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id'=>'required_without_all',
            'user_id'=>'exists:users,id',
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

        //$user= Auth::user();
        $categories = Category::findOrFail($request->category_id);
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update($validated);
        //$restaurant->user()->associate($user);
        $restaurant->categories()->sync($categories);
        $restaurant->image_profile = $imgNewName;
        $restaurant->image_cover = $coverNewName;
        $restaurant->save();

        return redirect()->route('listRestaurant');
    }
}
