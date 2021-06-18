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
        </div>
    </main>
    
@endsection