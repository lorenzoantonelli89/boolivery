@extends('layouts.main-layout')
@section('title')
    Dashboard di {{$user->name}} {{$user->lastname}}
@endsection
@section('content')    
<main>
    <div id="list-restaurant-container">
        <h1 id="restaurant-user-title">
            lista di {{$user->name}} {{$user->lastname}}
        </h1>
        
        <a href="{{route('createRestaurant')}}">
            crea nuovo
        </a>
        {{-- ciclo che genera tanti blocchi quanti sono i ristoranti del user loggato --}}
        @foreach ($restaurants as $restaurant)
        <div class="restaurant-from-list">
            <div class="restaurantfl-details">
                <h2>
                    {{$restaurant->name}}
                </h2>
                <div>Tipo di ristorante:
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
            </div>
        </div>
        @endforeach 
    </div>
</main>
@endsection