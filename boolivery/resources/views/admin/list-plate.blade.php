@extends('layouts.main-layout')

@section('content')

    <main>
        <a class="mx-5" href="{{route('listRestaurant')}}">Torna ai ristoranti</a>

        <a class="mx-5" href="{{route('createPlate', $restaurant->id)}}">Aggiungi un piatto</a>
        

         <ol style="list-style: none">
                            @foreach ($restaurant -> plates as $plate)
                                <li class="py-3" style="border: 1px solid red; text-align:center">   
                                    <div>
                                        <h4>{{ $plate -> name}}</h4>
                                        <p>
                                            {{ $plate -> description}}
                                            
                                        </p>
                                        <img style="height: 250px; width:350px;object-fit:contain" src="{{ asset('/storage/restaurant-plates')}}/{{ $plate->image }}" alt="{{ $plate->plate_name }}">

                                        <h6>
                                            € {{ $plate -> price}}
                                        </h6>
                                    </div>
                                   

                                    <a href="{{route('editPlate', $plate -> id)}}">Modifica</a>
                                </li>

                            @endforeach

                        </ol>
    </main>
    
@endsection