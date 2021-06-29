@extends('layouts.main-layout')

@section('content')
    <main>
        <div class="container" style="width:1140px; margin: auto">
            {{-- titolo --}}
            <h1>Ordine #{{$order->id}}</h1>
            <div>
                <span>Ordine effettuato da:</span>
                <span><i>{{$order->name}} {{$order->lastname}}</i></span>
            </div>
            <div>
                <span>Email cliente:</span>
                <span><i>{{$order->customer_email}}</i></span>
            </div>
            <div>
                <span>Indirizzo di consegna:</span>
                <span><i>{{$order->shipping_address}}</i></span>
            </div>
            <div>
                <span>Ordine da consegnare in data:</span>
                <span><i>{{$order->date_delivery}}</i></span>
                <span> alle ore </span>
                <span><i>{{$order->time_delivery}}</i></span>
            </div>
            <div>
                <h2>Piatti ordinati</h2>
                <ul>
                    @foreach ($order->plates as $plate)
                        <li>
                            <div>{{$plate->name}}</div>
                            <div>{{$plate->price}}</div>
                            <img src="{{ asset('/storage/restaurant-plates')}}/{{ $plate -> image }}" alt="" width="50px">
                        </li> 
                    @endforeach
                </ul>
            </div>
            <div>
                <span>Totale ordine:</span>
                <span><i>{{$order->total_price}}</i></span>
                @php
                    $sum = 0;
                    foreach($order->plates as $plate){
                        $sum += $plate->price;
                    }
                @endphp
                @if ($sum < 20)
                  <div>Di cui 5€ di consegna</div>  
                @else
                    <div>Con consegna gratuita</div> 
                @endif
            </div>


        
    </main>
@endsection

