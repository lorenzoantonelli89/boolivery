@extends('layouts.main-layout')
@section('title')
    Lista piatti di {{$restaurant -> name}} {{$restaurant -> lastname}}
@endsection
@section('content')
<main>
    <div id="container-plate-list">
        <div class="container-link">
            <a href="{{route('listRestaurant')}}">
                Torna ai ristoranti
            </a>
            <a href="{{route('createPlate', encrypt($restaurant -> id))}}">
                Aggiungi un piatto
            </a>
        </div>
        <h2 class="titlePlateList">
            Qui trovi tutti i piatti del ristorante {{$restaurant -> name}}
        </h2>
        {{-- immagine cover restaurant --}}
        <div class="restaurantCover">
            <img id="coverRestImg" src="{{ asset('/storage/restaurant-cover')}}/{{ $restaurant -> image_cover }}" alt="{{ $restaurant -> image_cover }}">
        </div>
        @if (count($restaurant->plates) < 1)
            <div class="no-orders"><strong>NON CI SONO PIATTI DA VISUALIZZARE</strong></div>
        @else
            <div class="menuContainer">
                <h2>
                    Le nostre specialità:
                </h2>
                {{-- lista piatti del ristorante --}}
                <ul class="platesCards">
                    @foreach ($restaurant -> plates as $plate)
                        <li>   
                            <div class="plateCard">
                                <div>
                                    <img  src="{{ asset('/storage/restaurant-plates')}}/{{ $plate -> image }}" alt="{{ $plate -> name }}">
                                    <a class="editPlate" href="{{route('editPlate', encrypt($plate -> id))}}">
                                        <i class="fas fa-pencil-alt"></i>
                                        {{-- <img src="{{ asset('/storage/graphics/matita2.png')}}" alt="{{ $plate -> name }}"> --}}
                                    </a>
                                </div>
                                <h4>
                                    {{ $plate -> name}}
                                </h4>
                                <p>
                                    {{ $plate -> description}}
                                </p>
                                <h6>
                                    € {{ $plate -> price}}
                                </h6>
                                {{-- sezione che mi mostra quanti ordini ha ciascun piatto --}}
                                <h6>
                                    @php
                                        $count = [];
                                        $orders = $plate->orders;
                                        foreach($orders as $order){
                                            if(!in_array($order->id,$count)){
                                                $count[] = $order->id;
                                            }
                                        }
                                    @endphp
                                    <span>Acquistato {{count($orders)}}</span>
                                    @if (count($orders) == 1)
                                        <span>volta in {{count($count)}} ordine</span>
                                    @else
                                        <span>volte in {{count($count)}} ordini</span>
                                    @endif
                                </h6>
                                @if ($plate->visible == 1)
                                    <a href="{{route('deletePlate',$plate->id)}}">
                                        <button>Togli il piatto dal menu</button>
                                    </a>
                                @else
                                    <a href="{{route('deletePlate',$plate->id)}}">
                                        <button>Rimetti il piatto nel menu</button>
                                    </a>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</main>
@endsection