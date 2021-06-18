@extends('layouts.main-layout')
@section('title')

    {{$restaurant -> restaurant_name}} 
    
@endsection

@section('content')

    <main>
        <div class="restaurant-show-container">
            <div class="restaurant-show div-margin">
                <div class="restaurant-description">
                <span><a href="{{route('home')}}">Home</a> / ristorante di</span>
                
                    <!-- valutazione, indirizzo e descrizione -->
                    <div class="restaurant-details">

                    <h1>
                        {{$restaurant -> restaurant_name}}
                    </h1>

                    <h3>***** 4,7 (500+ valutazioni)</h3>

                    <h5>
                        {{$restaurant -> address_restaurant}}
                    </h5>

                    <p>
                        <i>{{$restaurant -> description}}</i>
                        
                        <ul>
                        
                        @foreach ($restaurant -> plates as $plate)
                        <li> <a href=""> {{$plate -> plate_name}}</a></li>
                        <i class="fas fa-utensils"></i>
                        @endforeach
                        
                        
                        </ul>

                    </p>

                    </div>

                        <a class="atHome" href="{{route('home')}}">
                            Torna alla lista principale
                        </a>
                    </div>
                <!-- IMMAGINE LATERALE E SHOP -->
                <div class="restaurant-foto-order">

                <img src="{{ asset('/storage/restaurant-cover/' . $restaurant -> image_cover) }}" alt="">

                <span><i class="far fa-clock"></i>Consegnamo entro 30 minuti dall'ordine</span>

                <span><i class="far fa-clock"></i>Puoi pagare subito o alla consegna</span>

                <div class="types-of-payment">
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                </div>
                
                
                </div>
                <div>                    
                </div>
        </div>
        <div>            
        </div>
        </div>

    <!-- LISTA DEI PRODOTTI DEL RISTORANTE -->
    <div class="restaurant-fooding-list div-margin">
                <div class="fooding-list">
                    <ul class="">
                         
                        <li>ANTIPASTI</li>
                        <li>PRIMI</li>
                        <li>SECONDI</li>
                        <li>DESSERT</li>
                        <li>BEVANDE</li>
                        <li>BAR</li>
                        
                    </ul>
                </div>

                <div class="delivery-promotion">
                    <span>Spendi almeno 10,00€ per la <b>consegna gratuita</b></span>
                </div>
            
                
            </div>
            <!-- SEZIONE PER LA SCELTA DEI PIATTI -->
            <div class="plates-choosing-view">
            
                    
                <div class="choosing-and-total-container div-margin">
               
                    <div class="plate-selection-container">
                        @foreach ($restaurant -> plates as $plate)
                        <div class="plate-selection-view">
                            
                            <div class="plate-description">

                                <h7><b>{{$plate -> plate_name}}</b></h7>
                                
                                <span>{{$plate -> description}}</span>
                                
                                <h7>{{$plate -> price}}&euro;</h7>
                                

                            </div>


                            <img id="imgchoice" src="{{asset('/storage/restaurant-plates/' . $plate -> image)}}" alt="">

                        </div>
                        @endforeach
                    </div>                    
                    
                    <div class="momentary-total">
                    
                    <div class="total-sticky">
                    <a class="shop-link" href=""><i class="fas fa-shopping-cart"></i>CONCLUDI ORDINE</a>
                    
                    <div class="mykart">

                        <h1>ciao</h1>

                    </div> 
                   
                    </div>
                    
                    </div>
                
                </div>
             
            </div>
        
        
        
            <a href="{{route('home')}}">
                Back Home
            </a>
            <div>PIATTI</div>
            <ul>
                @foreach ($restaurant->plates as $plate)
                   <li>
                       <h3>{{$plate->name}}</h3>
                       <div v-on:click="getPlate({{$plate->price}})">{{$plate->price}}</div>
                    </li> 
                @endforeach
            </ul>
            <div>
                <form action="">
                    <div>
                        <label for="nome">Nome</label>
                        <input type="text">
                    </div>
                    <div>
                        <label for="">Totale</label>
                        
                        <input type="number" readonly :value="price">
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        new Vue({
          el: '#app2',
          data: {
              restaurants: '',
              activeRestaurant: 1,
              categories: '',
              plates: '',
          },
          mounted() {
              // chiamata axio che ritorna array di tutti i ristoranti
              axios.get('/api/plates/' + this.activeRestaurant)
                      .then(res => {
                          this.plates = res.data;
                          console.log(this.plates);
                      })
                  console.log(this.activeRestaurant);
          },
          methods: {
              // funzione che valora il dato active restaurant al click del ristorante selezionato
              getActiveRestaurant: function(elem){
                  this.activeRestaurant = elem.id;
              },
              // funzione che al click fa una chiamata axios per avere array di piatti
              getActivePlates: function(){
                  // chiamata axio che ritorna array di tutti i piatti del ristorante cliccato
                  // axios.get('/api/plates/' + this.activeRestaurant)
                  //     .then(res => {
                  //         this.plates = res.data;
                  //         console.log('this.plates');
                  //     })
              },
            //   test: function(){
            //       axios.get('/api/plates/' + this.activeRestaurant)
            //           .then(res => {
            //               this.plates = res.data;
            //               console.log(this.plates);
            //           })
            //       console.log(this.activeRestaurant);
            //   }
            
          },
          computed: {
              // funzione per creare href da inserire nel link ristorante come rotta che porta al dettaglio del ristorante cliccato
              getHref: function(){
                  return '/restaurant-details/' + this.activeRestaurant;
              }
          }
      });
    </script>
    
@endsection