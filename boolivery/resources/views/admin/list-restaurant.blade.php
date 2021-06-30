@extends('layouts.main-layout')
@section('title')
    Dashboard di {{$user->name}} {{$user->lastname}}
@endsection
@section('content')    
<main>
    <div class="bg-color">
        <div id="list-restaurant-container">
            <div id="centered-list">
                <h1 id="restaurant-user-title">
                    lista di {{$user->name}} {{$user->lastname}}
                </h1>
                
                <a href="{{route('createRestaurant')}}">
                    crea nuovo
                </a>
            </div>
            {{-- ciclo che genera tanti blocchi quanti sono i ristoranti del user loggato --}}
            @foreach ($restaurants as $restaurant)
            <div class="restaurant-from-list">
                <div class="restaurantfl-details">
                    <div id="details">
                        <h2>
                            {{$restaurant->name}}
                        </h2>
                        <div>
                            Tipo di ristorante:
                            @foreach ($restaurant->categories as $category)
                                <span>
                                    {{$category->name}} 
                                    <i class="fas fa-utensils"></i> 
                                </span> 
                            @endforeach
                        </div> 
                        <ul>
                            <li>
                                <i class="fas fa-map-marker-alt"></i> 
                                Indirizzo: {{$restaurant->address}} ||
                            </li>
                            <li>
                                <i class="fas fa-phone"></i> 
                                Telefono: {{$restaurant->phone}} || 
                            </li>
                            <li>
                                <i class="fas fa-at"></i> 
                                E-mail: {{$restaurant->email}} 
                            </li>
                            @if ($restaurant -> popular === 1)
                            <li>
                                || <i class="fas fa-star"></i> 
                                <b>Consigliato da Boolivery</b>     
                            </li>
                            @endif
                        </ul>
                        <p>
                            {{$restaurant->description}}
                                    
                        </p> 
                    </div>
                </div>
                <div class="restaurantfl-foto">
                    
                    <img src="{{ asset('/storage/restaurant-cover/' . $restaurant -> image_cover) }}" alt="">
                    
                </div>
                <div class="restaurantfl-modify">
                    <a href="{{route('plateList', encrypt($restaurant -> id))}}">
                        view
                    </a>
                    <a href="{{route('editRestaurant', encrypt($restaurant -> id))}}">
                        edit
                    </a>
                    <a href="{{route('showStats', encrypt($restaurant -> id))}}">
                        view statistic
                    </a>
                    <a href="{{route('showOrders', encrypt($restaurant -> id))}}">
                        view all Orders
                    </a>
                    <a href="{{route('deleteRestaurant', encrypt($restaurant -> id))}}">
                        delete
                    </a>
                </div>
            </div>
            @endforeach 
        </div>
    </div>    
</main>
@endsection