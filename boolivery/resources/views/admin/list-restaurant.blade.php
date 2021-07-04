@extends('layouts.main-layout')
@section('title')
    Dashboard di {{$user->name}} {{$user->lastname}}
@endsection
@section('content')    
<main class="bg-color">
    <div>
        <div id="polygon-1"></div>
        <div id="polygon-2"></div>
        <div id="list-restaurant-container">
            <div id="centered-list">
                <h1 id="restaurant-user-title">
                    Ristoranti di {{$user->name}} {{$user->lastname}}
                </h1>
                
                <a href="{{route('createRestaurant')}}">
                    Aggiungi Ristorante
                </a>
            </div>
            @if (count($restaurants)<1)
                <div class="no-orders"><strong>NON CI SONO RISTORANTI DA VISUALIZZARE</strong></div>
            @else
                {{-- ciclo che genera tanti blocchi quanti sono i ristoranti del user loggato --}}
            @foreach ($restaurants as $restaurant)
                <div class="restaurant-from-list">
                    <div class="restaurantfl-details">
                        <div id="details">
                            <div id="h2-btn-flex">
                                <h2>
                                    {{$restaurant->name}}
                                </h2>
                                <div id="btn-mod-del">
                                    <div id="icon-modify">
                                        <a href="{{route('editRestaurant', encrypt($restaurant -> id))}}">
                                            ✎
                                        </a>
                                    </div>
                                    <div id="icon-delete">
                                        <a href="{{route('deleteRestaurant', encrypt($restaurant -> id))}}">
                                            X
                                        </a>
                                    </div>
                                </div>
                            </div>
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
                                    <span>Indirizzo: {{$restaurant->address}} |</span>
                                </li>
                                <li>
                                    <i class="fas fa-phone"></i> 
                                    <span>Telefono: {{$restaurant->phone}} |</span> 
                                </li>
                                <li>
                                    <i class="fas fa-at"></i> 
                                    <span>E-mail: {{$restaurant->email}}</span> 
                                </li>
                                @if ($restaurant -> popular === 1)
                                <li>
                                    | <i class="fas fa-star"></i> 
                                    <span><b>Consigliato da Boolivery</b></span>     
                                </li>
                                @endif
                            </ul>
                            <p>
                                {{$restaurant->description}}
                                        
                            </p> 
                        </div>
                        <div class="restaurantfl-foto">
                        
                            <img src="{{ asset('/storage/restaurant-cover/' . $restaurant -> image_cover) }}" alt="">
                            
                        </div>
                        <div class="restaurantfl-modify">
                            <a href="{{route('plateList', encrypt($restaurant -> id))}}">
                                Menu
                            </a>
                            <a href="{{route('showOrders', encrypt($restaurant -> id))}}">
                                Lista Ordini
                            </a>
                            <a href="{{route('showStats', encrypt($restaurant -> id))}}">
                                Statistiche
                            </a>
                        </div>
                    </div>
                    
                </div>
            @endforeach
            @endif
        </div>
    </div>    
</main>
@endsection