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
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</main>
@endsection