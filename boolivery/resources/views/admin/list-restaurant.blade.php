@extends('layouts.main-layout')

@section('content')
    
<div id="list-restaurant-container">
    <div class="list-restaurant div-margin">
        <div class="list-restaurant-title">
        <h1>LISTA RISTORANTI DI {{Str::upper($user->name)}} {{Str::upper($user->lastname)}}</h1>
        </div>
        
        <a href="{{route('createRestaurant')}}">
            <button class="abutton" >CREA NUOVO</button>
        </a>


        
            @foreach ($restaurants as $restaurant)
            <div class="restaurant-from-list">
                <div class="restaurantfl-details">
                    <h2>{{$restaurant->name}}</h2>
                    <div>Tipo di ristorante:
                    @foreach ($restaurant->categories as $category)
                    <span>{{$category->name}} <i class="fas fa-utensils"></i> </span> 
                    @endforeach
                    </div> 
                    
                    <ul>
                        <li>
                        <i class="fas fa-map-marker-alt"></i> Indirizzo: {{$restaurant->address}} ||
                        </li>
                        <li>
                            <i class="fas fa-phone"></i> Telefono: {{$restaurant->phone}} || 
                        </li>
                        <li>
                            <i class="fas fa-at"></i> E-mail: {{$restaurant->email}} 
                        </li>
                        @if ($restaurant -> popular === 1)
                        <li>
                        || <i class="fas fa-star"></i> <b>Consigliato da Boolivery</b>     
                        </li>
                        @endif
                    </ul>
                             
                    <div class="description-container">
                        {{$restaurant->description}}
                                
                    </div> 
                </div>

                <div class="restaurantfl-foto">
                    
                    <img src="{{ asset('/storage/restaurant-cover/' . $restaurant -> image_cover) }}" alt="">
                    
                </div>

                <div class="restaurantfl-modify">
                        <a href="{{route('plateList', encrypt($restaurant -> id))}}">
                            <button class="abutton">VIEW</button>
                        </a>
                        <a href="{{route('editRestaurant', encrypt($restaurant -> id))}}">
                            <button class="abutton">EDIT</button>
                        </a>
                </div>

            </div>
            @endforeach 
    </div>
</div>

@endsection