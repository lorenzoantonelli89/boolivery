@extends('layouts.main-layout')
@section('title')
    {{$restaurant -> name}} 
@endsection

@section('content')
<main>
    <div id="restaurant-details-container">
        <div class="restaurant-show-container div-margin">             
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
                    
                        <p >
                            <i>{{$restaurant -> description}}</i>
                        </p>

                    </div>
                        
                    <div class="atHome">
                        <a href="{{route('home')}}">
                            Torna alla lista principale
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
                    Consegnamo entro 30 minuti: consegna prevista per le
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
                                        <div>
                                            <span>
                                                <button v-on:click="removePlate({{$plate}})">
                                                    <i class="fas fa-minus-square"></i>
                                                </button>
                                            </span>
                                            <span>
                                                <button v-on:click="addPlate({{$plate}})">
                                                    <i class="fas fa-plus-circle"></i>
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
                                    <form action="{{route('createOrder')}}" method="POST">
                                        
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
                                            <label for="Telefono">
                                                Telefono
                                            </label>
                                            <input type="email" id="email" name="email">
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
                                            <input type="date" id="date_delivery" name="date_delivery">
                                        </div>
                                        <div>
                                            <label for="time_delivery"></label>
                                            <input type="time" id="time_delivery" name="time_delivery">
                                        </div>
                                        <div>
                                            <label for="status">
                                                Status
                                            </label>
                                            <select name="status" id="status">
                                                <option value="0">
                                                    Pagato
                                                </option>
                                                <option value="1">
                                                    Da pagare
                                                </option>
                                            </select>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary">Crea</button>
                                        </div>
                                        <div class="total-price">

                                            <label for="total_price">    
                                            </label>
                                            <input id="totalPrice" type="text" id="total_price" name="total_price" :value="total"  readonly>                                         
                                            
                                        </div>
                                        <!-- OGGETTI NEL CARRELLO -->
                                        <div>
                                            <div v-for="item in cart">
                                                <input  type="hidden" name="plates_ids[]" :value="item.id" readonly>
                                                <span>@{{item.name}}</span>
                                            </div>
                                        </div>
                                    </form>
                                    
                           
                                </div> 
                                
                                <!-- calcolo del totale -->
                                <div class="total-calculator">
                                    <span>Spese di consegna: @{{getDeliveryCost()}}€</span>
                                    <!-- indicatore rosso verde sulla consegna gratuita -->
                                    <div :class="total < 10 ? 'pay-delivery' : 'free-delivery'">
                                        <h6>La consegna è gratuita se spendi almeno 10€</h6>
                                    </div>
                                    <span>Il mio totale: @{{total + getDeliveryCost()}}€</span>
                                </div>
                                
                                <!-- link giallo per concludere l'ordine -->
                                <a class="shop-link" href="">
                                    <i class="fas fa-shopping-cart"></i>
                                    CONCLUDI ORDINE
                                </a>
                            
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
            cart: [],
            total:0,
            deliveryTime:0
        },
        methods: {
            addPlate: function (elem){
                this.cart.push(elem);
                this.total += parseInt(elem.price);
                console.log(this.cart, elem.price);
                console.log(elem);
            },
            removePlate: function(elem){
                const index = this.cart.indexOf(elem);
                if(index > -1){
                    this.cart.splice(index, 1);
                    this.total -= elem.price;
                }
                console.log(this.cart);
            },
            getTimeDelivery: function() {
                const now = new Date();
                now.setMinutes(now.getMinutes() + this.getRandomNumberBetween(15, 45));
                const time = now.getHours() + ":" + now.getMinutes();
                return time;
            },
            getDeliveryCost: function() {
                if (this.total >= 10 || this.total == 0) {
                    return 0;
            } else {           
                return 5;
            }
            },
            getRandomNumberBetween: function(min,max){
            return Math.floor(Math.random()*(max-min+1)+min);
            }


        },
        computed: {
            
        }
    });

</script>
    
@endsection