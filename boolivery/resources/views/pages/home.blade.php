@extends('layouts.main-layout')
@section('title')
    Home Page
@endsection

@section('content')

    <main>
        <ul>
            <li v-for="elem in restaurants" v-on:click="getActiveRestaurant(elem)">
                <a :href=getHref>
                    @{{elem.restaurant_name}}
                </a>
                <div>
                    <span >
                        @{{elem.address_restaurant}}
                    </span>
                </div>
                <img :src="'/storage/restaurant-profile/' + elem.image_profile " alt="">
            </li>
        </ul>
    </main>
    
@endsection