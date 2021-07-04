@extends('layouts.main-layout')

@section('title')
    Ordine #{{$order->id}}
@endsection

@section('content')
    <main id="order-detail">
        <div class="container">
            {{-- link al totale ordini --}}
            <div class="back-to-dashboard">
                <a href="{{route('showOrders', encrypt($restaurant -> id))}}"><i class="fas fa-long-arrow-alt-left"></i> Torna agli ordini</a>
            </div>
            {{-- ordine precedente / successivo --}}
            <nav>
                <div>
                    <div v-if="actualIndex != 0">
                        <a :href="orderLink" v-on:click="previousOrder({{$order->id}})">PRECEDENTE</a>
                    </div>
                </div>
                
                <div v-if="orderIds.length > actualIndex + 1">
                    <a :href="orderLink" v-on:click="nextOrder({{$order->id}})">SUCCESSIVO</a>
                </div>
            </nav>
            <div class="order-block">
                <div class="order-details">
                    {{-- titolo --}}
                    <h1>Ordine #{{$order->id}}</h1>
                    <div>
                        <span>Ordine effettuato da:</span>
                        <span><i><strong>{{$order->name}} {{$order->lastname}}</strong></i></span>
                    </div>
                    <div>
                        <span>Email cliente:</span>
                        <span><i><strong>{{$order->customer_email}}</strong></i></span>
                    </div>
                    <div>
                        <span>Indirizzo di consegna:</span>
                        <span><i><strong>{{$order->shipping_address}}</strong></i></span>
                    </div>
                    <div>
                        <span>Ordine da consegnare in data:</span>
                        <span><i><strong>{{$order->date_delivery}}</strong></i></span>
                        <span> alle ore </span>
                        <span><i><strong>{{$order->time_delivery}}</strong></i></span>
                    </div>
                    {{-- totale in € --}}
                    <div class="recap">
                        <span>Totale ordine:</span>
                        <span><i><strong>{{$order->total_price}}€ </strong></i></span>
                        @php
                            $sum = 0;
                            foreach($order->plates as $plate){
                                $sum += $plate->price;
                            }
                        @endphp
                        @if ($sum < 20)
                        <span>di cui<i><strong> 5€</strong></i> di consegna</span>  
                        @else
                            <span>con <i><strong>consegna gratuita</strong></i></span> 
                        @endif
                    </div>
                </div>
                {{-- lista piatti ordinati --}}
                <div class="ordered-plates">
                    <h2>Piatti ordinati</h2>
                    <ul>
                        {{-- definisco array di ID piatti ordinati --}}
                        @php
                            $plateIds = [];
                            foreach($order->plates as $plate){
                                $plateIds[] = $plate->id;
                            }
                        @endphp
                        {{-- stampo tutti i piatti del menu, filtrando quelli ordinati con b-if --}}
                        @foreach ($restaurant->plates as $plate)
                            @if (in_array($plate->id, $plateIds))
                            <li>
                                <div class="icon">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div>{{$plate->name}}</div>
                                <div>{{$plate->price}}€</div>
                                <div>
                                    {{-- qty ordinata --}}
                                    @php
                                        $counter = 0;
                                        foreach ($plateIds as $OrderedItem) {
                                            if($OrderedItem == $plate->id){
                                                $counter++;
                                            }
                                        }
                                    @endphp
                                    Qty: {{$counter}}
                                </div>
                                <img src="{{ asset('/storage/restaurant-plates')}}/{{ $plate -> image }}" alt="">
                            </li>   
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <script>

        new Vue({
            el: '#order-detail',
            data: {
                orders:[],
                orderIds:[],
                orderLink: '',
                actualIndex: 0 ,
            },
            methods: {
                nextOrder: function(value){
                    let orderIndex = parseInt(this.orderIds.indexOf(value));
                    let nextOrderIndex = orderIndex + 1;
                    let nextOrder = this.orderIds[nextOrderIndex];
                    this.orderLink = '/showOrder/' + nextOrder;
                },
                previousOrder: function(value){
                    let orderIndex = parseInt(this.orderIds.indexOf(value));
                    let previousOrderIndex = orderIndex - 1;
                    let previousOrder = this.orderIds[previousOrderIndex];
                    this.orderLink = '/showOrder/' + previousOrder;
                },
            },
            mounted(){ //funzione mounted che mi richiama dati per avere andamento generale
                axios.post('/api/orderGraph/' + {{$restaurant->id}})
                .then(res => {
                    const data = res.data;
                    let orderIds = [];
                    for(i=0;i<data.length;i++){
                        const order = data[i];
                        if(orderIds.indexOf(order['order_id']) == -1){
                            orderIds.push(order['order_id']);
                            this.orders.push(order);
                        }
                    }

                    this.orderIds = orderIds;
                    this.actualIndex = parseInt(this.orderIds.indexOf({{$order->id}}));
                })
            }
        });
    
    </script>
@endsection

