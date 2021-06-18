@extends('layouts.main-layout')
@section('title')

    {{$restaurant -> restaurant_name}} 
    
@endsection

@section('content')

    <main>
        <div class="restaurant-show-container">
            <div class="restaurant-show div-margin">
                <div class="restaurant-description">

                <span><a href="">Home</a> / <a href="">Monti</a> / Elleniki </span>
                
                    <!-- valutazione, indirizzo e descrizione -->
                    <div class="restaurant-details">

                    <h1>
                        {{$restaurant -> restaurant_name}}
                    </h1>

                    <h3>***** 4,7 (500+ valutazioni)</h3>

                    <h3>
                        {{$restaurant -> address_restaurant}}
                    </h3>

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

                <div class="types-of-payment">
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                </div>
                
                <a class="shop-link" href=""><i class="fas fa-shopping-cart"></i>CONCLUDI ORDINE</a>
                

                </div>
            
                <div>
                    
                </div>

        <div id="app2">
            <div>
            <h1 >
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
            
                <div class="plates-choosing-view">
                    
                    <div class="choosing-and-total div-margin">

                    <div class="plate-selection-container">
                        @foreach ($restaurant -> plates as $plate)
                        <div class="plate-selection-view">



                        </div>
                        @endforeach
                    </div>
                    
                    <div class="momentary-total">



                    </div>


                    </div>
                    
                </div>
            
            </div>
        
        
        
            <a href="{{route('home')}}">
                Back Home
            </a>
        </div>
        <div>
            <ul>
                <li v-for="elem in plates">
                    @{{elem.name}} <br>
                    @{{elem.price}}
                </li>
            </ul>
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