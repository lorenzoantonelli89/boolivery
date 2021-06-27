@extends('layouts.main-layout')
@section('title')
    {{$restaurant -> name}} 
@endsection

@section('content')
<main>
    <div id="restaurant-details-container">
        <div class="restaurant-show-container">             
            <div class="restaurant-description">                       
                <img src="{{ asset('/storage/restaurant-profile/' . $restaurant -> image_profile) }}" alt="">
                    <!-- ZONA ALTO SX nome, indirizzo e descrizione -->
                <div class="restaurant-details">
                    <!-- nome      -->
                    <h1>
                        {{$restaurant -> name}}
                    </h1>
                    <!-- indirizzo -->
                    <h2>
                        {{$restaurant -> address}}
                    </h2>
                    <!-- descrizione -->
                    <div class="restaurant-description-text">
                    
                        <p>
                            <i>{{$restaurant -> description}}</i>
                        </p>

                    </div>
                        
                    <div class="atHome">
                        <a href="{{route('home')}}">
                            Torna alla Home
                        </a>
                    </div>        
                </div>

            </div>
                <!-- IMMAGINE LATERALE E TEMPI DI CONSEGNA -->
            <div class="restaurant-foto-order">
                <!-- cover del ristorante -->
                <img src="{{ asset('/storage/restaurant-cover/' . $restaurant -> image_cover) }}" alt="">
                <!-- tempi di consegna -->
                <span>
                    <i class="far fa-clock"></i>
                    Consegna prevista tra 30 e 40 minuti. Primo orario utile:
                    @{{getTimeDelivery()}}
                </span>
                <!-- dettagli del pagamento -->
                <span>
                <i class="fas fa-comments-dollar"></i>
                    Puoi pagare subito o alla consegna, con carta o contanti
                </span>

                <div class="types-of-payment">
                    <i class="fab fa-cc-paypal"></i>
                    <i class="fab fa-cc-visa"></i>
                    <i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-amazon-pay"></i>
                    <i class="fab fa-apple-pay"></i>
                </div>
            </div>
        </div>
        <!-- LISTA DEI PRODOTTI DEL RISTORANTE -->
        <div class="restaurant-fooding-list">
            <div class="fooding-list">
                <!-- SEZIONE PER LA SCELTA DEI PIATTI -->
                <div class="plates-choosing-view">
                    <div class="choosing-and-total-container div-margin">
                        <div class="plate-selection-container ">
                            @foreach ($restaurant -> plates as $plate)
                                <div class="plate-selection-view">
                                    <!-- descrizione del piatto -->
                                    <div class="plate-description">
                                        <h3>
                                            <b>{{$plate -> name}}</b>
                                        </h3>
                                        
                                        <span>
                                            {{$plate -> description}}
                                        </span>
                                        
                                        <h3>
                                            {{$plate -> price}}&euro;
                                        </h3>
                                        <!-- bottoni per aggiungere o togliere un piatto -->
                                        <div class="container-add-cart">
                                            <span>
                                                <button id="{{$plate -> id}}" v-on:click="addCart({{$plate}})">
                                                    {{-- <i class="fas fa-plus-circle"></i> --}}
                                                    add cart
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <img id="imgchoice" src="{{asset('/storage/restaurant-plates/' . $plate -> image)}}" alt="">
                                </div>
                            @endforeach
                        </div>                    
                        <!-- TABELLA PER L'ORDINE E PER IL TOTALE -->
                        <div class="momentary-total">
                            <!-- ZONA DEL CARRELLO -->
                            <div class="mykart">
                                <form action="{{route('storeOrder')}}" method="POST">
                                    
                                    @csrf
                                    @method('POST')
                                    <!-- campo del nome -->
                                    <div>
                                        <label for="name">
                                            Nome
                                        </label>
                                        <input type="text" id="name" name="name">
                                    </div>
                                    <!-- campo del cognome -->
                                    <div>
                                        <label for="lastname">
                                            Cognome
                                        </label>
                                        <input type="text" id="lastname" name="lastname">
                                    </div>
                                    <!-- campo del telefono -->
                                    <div>
                                        <label for="email">
                                            Email
                                        </label>
                                        <input type="email" id="email" name="customer_email">
                                    </div>
                                    <!-- campo dell'indirizzo -->
                                    <div>
                                        <label for="shipping_address">  
                                            Indirizzo
                                        </label>
                                        <input type="text" id="shipping_address" name="shipping_address">
                                    </div>
                                    <!-- campo della data -->
                                    <div>
                                        <label for="date_delivery">
                                            Data
                                        </label>
                                        <input type="date" id="date_delivery" name="date_delivery"
                                        min="<?php
                                        echo date('Y-m-d');
                                        ?>" value="<?php
                                        echo date('Y-m-d');
                                        ?>" required>
                                    </div>
                                    <div>
                                        <label for="time_delivery">
                                            Orario (attesa minima: <i>30minuti</i>)
                                        </label>
                                        <input type="time" id="time_delivery" name="time_delivery"
                                        min="08:00" max="23:00" value= "<?php
                                        date_default_timezone_set("Europe/Rome");
                                        if(date('H:i')>'08:00' && date('H:i')<'23:00'){
                                            $now = date("H:i");
                                            $firstAvailable = date('H:i', strtotime('+30 minutes', strtotime($now)));
                                            echo $firstAvailable;
                                        } else {
                                            echo '08:00';
                                        };
                                        ?>" required>
                                    </div>
                                    
                                    {{-- RILEVAZIONE ERRORI COMPILAZIONE--}}
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <!-- calcolo del totale -->
                                    <div class="total-calculator">
                                        {{-- <div>Totale(consegna esclusa): @{{total}}</div> --}}
                                        <span>Spese di consegna: @{{getDeliveryCost()}}€</span>
                                        <!-- indicatore rosso verde sulla consegna gratuita -->
                                        <div :class="total < 10 ? 'pay-delivery' : 'free-delivery'">
                                            <h6>La consegna è gratuita se spendi almeno 10€</h6>
                                        </div>
                                        <span>Il mio totale: @{{total + getDeliveryCost()}}€</span>
                                    </div>
                                    <div class="total-price">
                                        <label for="total_price">    
                                        </label>
                                        <input id="totalPrice" type="text" id="total_price" name="total_price" :value="total < 10 ? total+5 : total"  readonly>                                        
                                    </div>
                                    <div>
                                        <input v-for="elem in cart"  type="hidden" name="plate_id[]" id="plate_id[]" :value="elem" readonly>
                                    </div>
                                    <!-- OGGETTI NEL CARRELLO -->
                                    <div>
                                        <div v-for="item in orderedItems">
                                            <span>@{{item.name}} </span>
                                            <span>@{{item.counter}}</span>
                                            <span v-on:click="addPlate(item)" >
                                                <i class="fas fa-plus-circle"></i>
                                            </span>
                                            <span v-on:click="removePlate(item)">
                                                <i class="fas fa-trash-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                    {{-- submit --}}
                                    <div>
                                        <button type="submit" class="shop-link">
                                            <i class="fas fa-shopping-cart"></i>
                                            CONCLUDI ORDINE
                                        </button>
                                    </div>
                                </form>
                            </div> 
                        </div>
                    </div>
                </div>    
                <div class="delivery-promotion">
                    <span>Spendi almeno 10,00€ per la <b>consegna gratuita </b>|| La mancia al Ryder non è obbligatoria ma è ben voluta &hearts; </span>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    new Vue({
        el: '#restaurant-details-container',
        data: {
            orderedItems: [], // array di piatti ordinati
            numberItems: [], //
            cart: [], // array di ID ordinati
            total:0, // prezzo totale
            deliveryTime:0,
            btnAddCart: true,
        },
        methods: {
            addCart: function (elem){
                let obj = {
                    id: elem.id,
                    name: elem.name,
                    price: elem.price,
                    counter: 1,
                }
                this.orderedItems.push(obj);
                this.cart.push(elem.id);
                this.total += parseInt(elem.price);
                let activeButton = document.getElementById(elem.id);
                activeButton.style.display = 'none';
            },
            addPlate: function(elem){
                this.cart.push(elem.id);
                this.total += parseInt(elem.price);
                elem.counter++;
            },
            removePlate: function(elem){
                const index = this.cart.indexOf(elem.id);

                if(index > -1){
                    this.cart.splice(index, 1);
                    this.total -= parseInt(elem.price);
                    elem.counter --;
                }
                if(elem.counter == 0){
                    this.orderedItems.splice(index, 1);
                    let activeButton = document.getElementById(elem.id);
                    activeButton.style.display = 'block';
                }
                console.log(this.orderedItems);
            },
            getTimeDelivery: function() {
                const now = new Date();
                now.setMinutes(now.getMinutes() + 30);
                let time = now.getHours() + ":" + now.getMinutes();
                if(now.getMinutes() < 10){
                    time = now.getHours() + ":0" + now.getMinutes();
                };
                
                return time;
            },
            getDeliveryCost: function() {
                if (this.total >= 10 || this.total == 0) {
                        return 0;
                } else {           
                    return 5;
                }
            },

        },
        computed: {

        }
    });

</script>
    
@endsection