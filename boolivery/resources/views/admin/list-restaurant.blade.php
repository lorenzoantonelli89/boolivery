@extends('layouts.main-layout')

@section('content')

    <main>
        
        <ul>
            @foreach ($restaurants as $restaurant)

               
                <li>
                    <a href="{{route('plateList', $restaurant -> id)}}">
                        {{$restaurant -> id}}
        
                        {{$restaurant -> restaurant_name}}

                    </a> 

                      
                </li>

            @endforeach


        </ul>


    </main>
    
@endsection