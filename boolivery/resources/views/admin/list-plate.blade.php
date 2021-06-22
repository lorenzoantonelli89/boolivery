@extends('layouts.main-layout')

@section('content')

    <main>
        
        <h2>
            Qui trovi tutti i piatti del ristorante {{$restaurant -> name}}
        </h2>

        {{-- immagine cover restaurant --}}
        <div class="restaurantCover">
            <img class="coverRestRel" src="{{ asset('/storage/restaurant-cover')}}/{{ $restaurant -> image_cover }}" alt="{{ $restaurant -> image_cover }}">

            <a class="ms_button listRestButt" href="{{route('listRestaurant')}}">Torna ai ristoranti</a>

            <a class="ms_button createPlateButt" href="{{route('createPlate', encrypt($restaurant -> id))}}">Aggiungi un piatto</a>
            
        </div>


        <ol class="platesCards">
                @foreach ($restaurant -> plates as $plate)
                    <li>   
                        <div>
                            <img  src="{{ asset('/storage/restaurant-plates')}}/{{ $plate -> image }}" alt="{{ $plate-> name }}">
                            <h4>{{ $plate -> name}}</h4>
                            <p>
                                {{ $plate -> description}}
                                
                            </p>

                            <h6>
                                € {{ $plate -> price}}
                            </h6>
                        </div>
                        

                        <a class="editPlate" href="{{route('editPlate', encrypt($plate -> id))}}">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                    </li>

                @endforeach

        </ol>
    </main>
    
@endsection