@extends('layouts.main-layout')
@section('title')
    {{$restaurant -> name}} 
@endsection

@section('content')
    <main>
        <div id="restaurant-details-container">
            <div class="restaurant-show-container">
                <div class="restaurant-show div-margin">
                    <div class="restaurant-description">
                        <span><a href="{{route('home')}}">Home</a></span>
                        <!-- valutazione, indirizzo e descrizione -->
                        <div class="restaurant-details">
                            <h1>
                                {{$restaurant -> name}}
                            </h1>
                            <h5>
                                {{$restaurant -> address}}
                            </h5>
                            <p>
                                <i>
                                    {{$restaurant -> description}}
                                </i>
                            </p>
                        </div>

                        <a class="atHome" href="{{route('home')}}">
                            Torna alla lista principale
                        </a>
                    </div>
                    <!-- IMMAGINE LATERALE E SHOP -->
                    <div class="restaurant-foto-order">
                        <img src="{{ asset('/storage/restaurant-cover/' . $restaurant -> image_cover) }}" alt="">
                        <span>
                            <i class="far fa-clock"></i>
                            Consegnamo entro 30 minuti dall'ordine
                        </span>
                        <span>
                            <i class="far fa-clock"></i>
                            Puoi pagare subito o alla consegna
                        </span>

                        <div class="types-of-payment">
                            <i class="fab fa-cc-paypal"></i>
                            <i class="fab fa-cc-visa"></i>
                            <i class="fab fa-cc-mastercard"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- LISTA DEI PRODOTTI DEL RISTORANTE -->
            <div class="restaurant-fooding-list div-margin">
                <div class="fooding-list">
                    <!-- SEZIONE PER LA SCELTA DEI PIATTI -->
                    <div class="plates-choosing-view">
                        <div class="choosing-and-total-container div-margin">
                            <div class="plate-selection-container">
                                @foreach ($restaurant -> plates as $plate)
                                    <div class="plate-selection-view">
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
                                            <span>
                                                <button v-on:click="addPlate({{$plate}})">
                                                    ADD
                                                </button>
                                            </span>
                                            <span>
                                                <button v-on:click="removePlate({{$plate}})">
                                                    REMOVE
                                                </button>
                                            </span>
                                        </div>
                                        <img id="imgchoice" src="{{asset('/storage/restaurant-plates/' . $plate -> image)}}" alt="">
                                    </div>
                                @endforeach
                            </div>                    
                            
                            <div class="momentary-total">
                                <div class="total-sticky">
                                    <a class="shop-link" href="">
                                        <i class="fas fa-shopping-cart"></i>
                                        CONCLUDI ORDINE
                                    </a>
                                    <div class="mykart">
                                        <form action="{{route('createOrder')}}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <div>
                                                <label for="name">
                                                    Nome
                                                </label>
                                                <input type="text" id="name" name="name">
                                            </div>
                                            <div>
                                                <label for="lastname">
                                                    Cognome
                                                </label>
                                                <input type="text" id="lastname" name="lastname">
                                            </div>
                                            <div>
                                                <label for="email">
                                                    Email
                                                </label>
                                                <input type="email" id="email" name="email">
                                            </div>
                                            <div>
                                                <label for="shipping_address">  
                                                    Indirizzo
                                                </label>
                                                <input type="text" id="shipping_address" name="shipping_address">
                                            </div>
                                            <div>
                                                <div v-for="item in cart">
                                                    <input type="text" name="plates_ids[]" :value="item.name">
                                                </div>
                                            </div>
                                            <div>
                                                <label for="total_price">
                                                    Total Price
                                                </label>
                                                <input type="text" id="total_price" name="total_price" :value="total" readonly>
                                            </div>
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
                                        </form>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>    
                    <div class="delivery-promotion">
                        <span>Spendi almeno 10,00€ per la <b>consegna gratuita</b></span>
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
              total:0
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
          },
          computed: {
              
          }
      });
    </script>
    
@endsection