@extends('layouts.main-layout')
@section('title')
    {{$restaurant -> name}} 
@endsection

@section('content')
<main>
    <div id="restaurant-details-container">
        <div id="absolute-trapezoid"></div>
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
                    <h3>
                        {{$restaurant -> address}}
                    </h3>
                    <div>
                        @foreach ($restaurant->categories as $category)
                            <span><i class="fas fa-utensils"></i><i>{{$category->name}}</i></span>
                        @endforeach
                    </div>
                    <!-- descrizione -->
                    <div class="restaurant-description-text">
                    
                        <p>
                            <i>{{$restaurant -> description}}</i>
                        </p>

                    </div> 
                    
                    <a href="{{route('home')}}"><i class="fas fa-long-arrow-alt-left"></i> Torna ai ristoranti</a>
                </div>
            </div>
                <!-- IMMAGINE LATERALE E TEMPI DI CONSEGNA -->
            <div class="restaurant-foto-order">
                <!-- cover del ristorante -->
                <img src="{{ asset('/storage/restaurant-cover/' . $restaurant -> image_cover) }}" alt="">
                <!-- tempi di consegna -->
                <span>
                    <i class="far fa-clock"></i>
                    Consegna prevista tra 30 e 40 minuti.
                    <p>Primo orario utile:
                    <strong>@{{getTimeDelivery()}}</strong></p>
                </span>
                <!-- dettagli del pagamento -->
                <span>
                <i class="fas fa-comments-dollar"></i>
                    Accettiamo i seguenti metodi di pagamento
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
            <div class="plates-choosing-view">
                <!-- CARRELLO FISSO -->
                <div class="cartFixed div-margin">
                    <a href="#cartView">
                    <h2><i class="fas fa-shopping-cart"></i> @{{total + getDeliveryCost()}}€ Go to Cart <i class="fas fa-caret-down"></i></h2>
                    </a>
                </div>
                <div class="choosing-and-total-container div-margin">
                    <div class="plate-selection-container ">
                        @foreach ($restaurant -> plates as $plate)
                        @if ($plate -> visible == true)
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
                                        <button v-on:click="addPlate({{$plate}})">
                                            {{-- <i class="fas fa-plus-circle"></i> --}}
                                            AGGIUNGI
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <img id="imgchoice" src="{{asset('/storage/restaurant-plates/' . $plate -> image)}}" alt="">
                        </div>
                        @endif
                        @endforeach
                        <a name="cartView"></a>
                    </div>                    
                    <!-- TABELLA PER L'ORDINE E PER IL TOTALE -->
                    <div class="momentary-total">
                        <!-- ZONA DEL CARRELLO -->
                        <div class="mykart">
                            <form action="{{route('storeOrder')}}" method="POST">
                            
                                @csrf
                                @method('POST')
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
                                
                                <!-- OGGETTI NEL CARRELLO -->
                                <div :class="total < 20 ? 'pay-delivery' : 'free-delivery'">
                                    <h6>La consegna è gratuita se spendi almeno 20€</h6>
                                </div>
                                
                                <div class="elemQnty" v-for="item in showedItems">
                                    <div class="listitem">
                                        <div class="pluseminus">
                                            <span v-on:click="removeQty(item)">
                                                <i class="fas fa-minus-circle"></i>
                                            </span>
                                            <span>@{{item.counter}}</span>
                                            <span v-on:click="addQty(item)">
                                                <i class="fas fa-plus-circle"></i>
                                            </span>

                                            </div>
                                            <div class="myelem">
                                            <span>@{{item.name}} </span> 
                                            </div>    

                                            <div class="singlecount">
                                                @{{item.price * item.counter}}€
                                            </div>
                                        </div>  
                                </div>

                                <!-- calcolo del totale -->
                                
                                <div class="total-calculator">
                                    {{-- <div>Totale(consegna esclusa): @{{total}}</div> --}}
                                    <div class="amount">
                                        <span>Spese di consegna: </span>
                                        <span>@{{getDeliveryCost()}}€</span>
                                    </div>
                                    <div class="amount">
                                        <span>Il mio totale: </span>
                                        <span>@{{total + getDeliveryCost()}}€</span>
                                    </div>
                                    
                                    <!-- indicatore rosso verde sulla consegna gratuita -->
                                    
                                </div>
                                <div class="total-price">
                                    <label for="total_price">    
                                    </label>
                                    <input id="totalPrice" type="text" id="total_price" name="total_price" :value="total < 20 ? total+5 : total"  readonly>                                        
                                </div>
                                <div>
                                    <input v-for="elem in cart"  type="hidden" name="plate_id[]" id="plate_id[]" :value="elem" readonly>
                                </div>
                                
                                {{-- submit --}}
                                <div class="goToKart" v-on:click="changeFormVisibility">
                                    <p>
                                        <i :class="show == true ? 'fas fa-caret-up display' : 'fas fa-caret-up'"></i>
                                        <i :class="show == false ? 'fas fa-caret-down display' : 'fas fa-caret-down'"></i>
                                        COMPLETA L'ORDINE
                                    </p>
                                </div>

                                <!-- campo del nome -->
                                <div v-if="formView"id="userDetails">
                                <div>
                                    <label for="name">
                                        Nome
                                    </label>
                                    <input type="text" id="name" name="name" minlength="3" maxlength="255" required>
                                </div>
                                <!-- campo del cognome -->
                                <div>
                                    <label for="lastname">
                                        Cognome
                                    </label>
                                    <input type="text" id="lastname" name="lastname" minlength="3" maxlength="255" required>
                                </div>
                                <!-- campo del telefono -->
                                <div>
                                    <label for="email">
                                        Email
                                    </label>
                                    <input type="email" id="email" name="customer_email" minlength="3" maxlength="255" required>
                                </div>
                                <!-- campo dell'indirizzo -->
                                <div>
                                    <label for="shipping_address">  
                                        Indirizzo
                                    </label>
                                    <input type="text" id="shipping_address" name="shipping_address" minlength="3" maxlength="255" required>
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
            <div id="absolute-trapezoid-gray"></div>   
        </div>
        <div class="delivery-promotion">
            <span>Spendi almeno 20,00€ per la <b>consegna gratuita </b>|| La mancia al Ryder non è obbligatoria ma è ben voluta &hearts; </span>
        </div>
    </div>
    
</main>

<script>
    // window.onbeforeunload = function() {
    //         alert('stai lasciando');
    //         console.log('hello');
    // };
    // window.addEventListener('beforeunload', function(){
    //     alert('stai lasciando');
    // });
    new Vue({
        el: '#restaurant-details-container',
        data: {
            cart:[], // array di ID piatti ordinati
            showedItems:[], // array di obj da mostrare nel carrello
            total:0, // prezzo totale
            formView:false, //visualizzazione del form
            show: false
        },
        methods: {
            addPlate: function(item){ // aggiungi piatto partendo da qty 0
                if(this.cart.indexOf(item.id) == -1){
                    let obj = {
                        name: item.name,
                        id: item.id,
                        counter: 1,
                        price: item.price,
                    };
                    this.cart.push(item.id);
                    this.showedItems.push(obj);
                    this.total += parseInt(item.price);
                } else {
                    this.addQty(item);
                }
            },
            addQty: function (item){  // aggiungi piatto partendo da qty 1
                let objIndex = this.showedItems.findIndex((obj => obj.id == item.id));
                this.showedItems[objIndex].counter = this.showedItems[objIndex].counter + 1;
                this.cart.push(item.id);
                this.total += parseInt(item.price);
            },
            removeQty: function (item){ // rimuovi piatto 
                const index = this.cart.indexOf(item.id);
                this.cart.splice(index,1); // rimuovi piatto da cart
                this.total -= parseInt(item.price); // aggiorna il tot
                let objIndex = this.showedItems.findIndex((obj => obj.id == item.id));
                this.showedItems[objIndex].counter = this.showedItems[objIndex].counter - 1; // aggiorna qty
                if(this.showedItems[objIndex].counter == 0){ // se qty è = 0, rimuovi piatto dal carrello visibile
                    this.showedItems.splice(objIndex,1);
                }
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
                if (this.total >= 20 || this.total == 0) {
                        return 0;
                } else {           
                    return 5;
                }
            },
            changeFormVisibility: function() {
                if(this.cart.length>0){
                    this.formView = true;
                    this.show = true;
                } else {
                    alert('Seleziona almeno un piatto');
                }
            },
            alertPage: function(){
                if(this.cart.length == 0){
                    alert('perdi i piatti');
                }
            }
            
        },
    });

</script>
    
@endsection