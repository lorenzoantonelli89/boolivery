@extends('layouts.main-layout')

@section('content')
    
<div class="container">
    <h1>LISTA RISTORANTI DI {{$user->name}} {{$user->lastname}}</h1>
    <a href="{{route('createRestaurant')}}">
        <button>CREA NUOVO</button>
    </a>
    <ul>
        @foreach ($restaurants as $restaurant)
        <li>
            <h2>{{$restaurant->name}}</h2>
            <div>Tipo di ristorante:
                @foreach ($restaurant->categories as $category)
                   <span>{{$category->name}},</span> 
                @endforeach
            </div>  
            <div>{{$restaurant->address}}</div>        
            <div>{{$restaurant->phone}}</div>        
            <div>{{$restaurant->email}}</div>        
            <div>{{$restaurant->description}}</div>        
            <div>
                <img src="{{asset('/storage/restaurant-profile/'.$restaurant->image_profile)}}" alt="" width="200px">
            </div> 
            <div>
                <a href="{{route('plateList',$restaurant->id)}}">
                    <button>VIEW</button>
                </a>
                <a href="{{route('editRestaurant',$restaurant->id)}}">
                    <button>EDIT</button>
                </a>
            </div>  
        </li>
        @endforeach
    </ul>
</div>

@endsection