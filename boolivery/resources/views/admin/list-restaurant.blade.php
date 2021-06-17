@extends('layouts.main-layout')
@section('content')
    
<div>
    <h1>LISTA RISTORANTI DI {{$user->name}} {{$user->lastname}}</h1>
    <a href="{{route('createRestaurant',$user->id)}}">
        <button>CREA NUOVO</button>
    </a> 
    <ul>
        @foreach ($restaurants as $restaurant)
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
        @endforeach

        {{-- @foreach ($user->restaurants as $restaurant)
            <h2>{{$restaurant->restaurant_name}}</h2>   
            <div>{{$restaurant->address_restaurant}}</div>        
            <div>{{$restaurant->phone}}</div>        
            <div>{{$restaurant->email}}</div>        
            <div>{{$restaurant->description}}</div>        
            <div>
                <img src="{{asset('/storage/restaurant-profile/'.$restaurant->image_profile)}}" alt="" width="200px">
            </div> 
            <div>
                <a href="">
                    <button>VIEW</button>
                </a>
                <a href="">
                    <button>EDIT</button>
                </a>
            </div>    
        @endforeach --}}

    </ul>
</div>

@endsection