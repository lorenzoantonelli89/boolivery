@extends('layouts.main-layout')

@section('content')

    <main>
       
        <h2>
            Qui trovi tutti i piatti del ristorante {{$restaurant -> name}}
        </h2>

        {{-- immagine cover restaurant --}}
        <div class="restaurantCover">
            <img class="coverRestImg" src="{{ asset('/storage/restaurant-cover')}}/{{ $restaurant -> image_cover }}" alt="{{ $restaurant -> image_cover }}">

            <a class="ms_button listRestButt" href="{{route('listRestaurant')}}">Torna ai ristoranti</a>

            <a class="ms_button createPlateButt" href="{{route('createPlate', encrypt($restaurant -> id))}}">Aggiungi un piatto</a>
            
        </div>
    

        <div class="menuContainer">

                <h2 class="speciality">
                    Le nostre specialità:
                </h2>

                {{-- lista piatti del ristorante --}}
                
                <ol class="platesCards">
                        
                        @foreach ($restaurant -> plates as $plate)
                            <li>   
                                <div class="plateCard">
                                    
                                    <img  src="{{ asset('/storage/restaurant-plates')}}/{{ $plate -> image }}" alt="{{ $plate-> name }}">
                                    <a class="editPlate" href="{{route('editPlate', encrypt($plate -> id))}}">
                                       {{--  <i class="fas fa-pencil-alt"></i> --}}
                                       <img src="{{ asset('/storage/graphics/matita2.png')}}" alt="{{ $plate-> name }}">
                                    </a>
                                    </div>
                                    <h4>{{ $plate -> name}}</h4>
                                    <p>
                                        {{ $plate -> description}}
                                    </p>

                                    <h6>
                                        € {{ $plate -> price}}
                                    </h6>
                                
                            </li>

                        @endforeach

                </ol>

        </div>
    </main>
    
@endsection