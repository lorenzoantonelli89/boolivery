@extends('layouts.main-layout')
@section('title')

    {{$restaurant -> restaurant_name}} 
    
@endsection

@section('content')

    <main>
        <div>
            <h1>
                {{$restaurant -> name}}
            </h1>
            <h3>
                {{$restaurant -> restaurant}}
            </h3>
            <p>
                {{$restaurant -> description}}
            </p>
            <div>
                <img src="{{ asset('/storage/restaurant-profile/' . $restaurant -> image_profile) }}" alt="">
            </div>

            <a href="{{route('home')}}">
                Back Home
            </a>
            <div>PIATTI</div>
            <ul>
                @foreach ($restaurant->plates as $plate)
                   <li>
                       <h3>{{$plate->name}}</h3>
                       <div v-on:click="getPlate({{$plate->price}})">{{$plate->price}}</div>
                    </li> 
                @endforeach
            </ul>
            <div>
                <form action="">
                    <div>
                        <label for="nome">Nome</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="">Totale</label>
                        
                        <input type="number" readonly :value="price">
                    </div>
                </form>
            </div>
        </div>
    </main>
    
@endsection