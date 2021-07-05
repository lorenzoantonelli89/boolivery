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
                                        <a id="btnDelete" onclick="return confirm('ATTENZIONE! Sei sicuro di voler cancellare questo ristorante?')" href="{{route('deleteRestaurant', encrypt($restaurant -> id))}}">
                                            X
                                        </a>
                                        <!-- <a href="#" title="delete" class="delete" >Delete</a> -->
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

<script>
    //     document.getElementById("btnDelete").addEventListener("click", displayDate);
    //     var deleteLinks = document.querySelectorAll('.delete');

    //     for (var i = 0; i < deleteLinks.length; i++) {
    //     deleteLinks[i].addEventListener('click', function(event) {
    //         event.preventDefault();

    //         var choice = confirm(this.getAttribute('data-confirm'));

    //         if (choice) {
    //             window.location.href = this.getAttribute('href');
    //         }
    //     });
    // }

    // document.getElementById("btnDelete").addEventListener("click", getAllert());

    // function getAllert() {
    //     console.log("click");
    //     if (alerted != 'yes') {
    //  alert("My alert.");
    //  localStorage.setItem('alerted','yes');
    // }
    // var alerted = getCookie('alerted') || '';
    //                 if (alerted != 'yes') {
    //                 alert("You are using Internet Explorer to view this webpage.  Your experience may be subpar while using Internet Explorer; we recommend using an alternative internet browser, such as Chrome or Firefox, to view our website.");
    //                 createCookie('alerted','yes',365);//cookies expires after 365 days
    //                 }
    // }
</script>
@endsection