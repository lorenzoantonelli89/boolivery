@extends('layouts.main-layout')
@section('title')
    Home Page
@endsection

@section('content')

    <main>
      <div id="home-container">
          <!-- PARTE SUPERIODE DEL SITO -->
            <div class=myjumbotron>
              <div class="div-margin">
              <div class="welcome ">
                <!-- <div class="logo-login">
                  <img class="logo" src={{ asset('/storage/graphics/logocompleto.png') }} alt="">
                  <a class="blink" href="#">LOGIN</a>
                </div> -->
                    <div class="title-research">                  
                        <h1>I piatti che ami, a domicilio</h1>
                      <div class="research-request">
                      <span>Cerca il tuo ristorante preferito</span> 
                        <div class="input-adresse">
                          <input id="guest-request" type="text" name="" value="" placeholder="Cerca il tuo ristorante preferito...">
                          <input id="guest-request-click" type="submit" name="" value="CERCA">
                        </div>
                      <span><a href="#">Accedi</a> per vedere le tue ricerche recenti</span>
                      </div>
                    </div>        
                </div>
              </div>          
            </div>

        <!-- PRIMA SEZIONE, VISIONE DEI RISTORANTI -->
          <div class="main-sec-1">
            <div class="main-1-container div-margin">
              <ul>
                <li v-for="elem in restaurants" v-on:click="(getActiveRestaurant(elem), getActivePlates)">
                  <a :href="getHref">
                    <div class="restaurants">
                      <img :src="'/storage/restaurant-profile/' + elem.image_profile " alt="Copertina ristorante">
                      <div id="text">
                        <h3 >@{{ elem.name }}</h3>
                        <p>@{{ elem.restaurant }}</p>
                      </div>
                      <div id="layover" > <!-- Layover in absolute -->
                      </div>
                    </div>
                  </a>        
                </li>
              </ul>
            </div>
          </div>

          <!-- SECONDA SEZIONE, VISIONE DEI PIATTI -->
          <div id="section-2">
            <div class="flexible-carusel">
              <div id="prev" class="chevron">
                <i class="fas fa-chevron-left"></i>
              </div>
              <div class="position-carousel"></div>
              <div class="div-margin">
                <ul>
                  <li>
                    <img :src="'/storage/restaurant-plates/' + platesPopular[0].image" alt="Immagine di portate">
                    <div id="plates-info">
                      <div id="text-plates">
                        <h3><i>Nome ristorante</i></h3>
                        <h4><i>Nome cibo</i></h4>
                        <p><i>Ratings</i></p>
                        <p><i>Descrizione</i></p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              <div id="next" class="chevron">
                <i class="fas fa-chevron-right"></i>          
              </div>            
            </div>
          </div>

          <!-- TERZA SEZIONE, SEZIONE PER I RISTORATORI -->
          <div class="main-sec-3 div-margin">
              <div class="business-adv">
                <img class="img-icon" src={{ asset('/storage/graphics/restaurant_icon.png') }} alt="">
                <h1>Diventa partner Boolivery</h1>
                <span>Aumenta le tue vendite fino al 30% grazie alle consegne a domicilio</span>
                <a class="blink" href="#">LOGIN</a>     
              </div>
          </div>

          <!-- CONTENITORE CONTATTI IN ABSOLUTE -->
          <div id="contacts">
            <div id="mail">
              <i class="fas fa-at"></i>
            </div>
            <div id="phone">
              <i class="fas fa-phone"></i>
            </div>
          </div>
      </div>
    </main>

    <script>
        new Vue({
          el: '#home-container',
          data: {
              restaurants: '',
              activeRestaurant: '',
              categories: '',
              platesPopular: [] 
          },
          mounted() {
              // chiamata axio che ritorna array di tutti i ristoranti
              axios.get('/api/restaurants')
                  .then(res => {
                      this.restaurants = res.data;
                      console.log(this.restaurants);
                  })
              // chiamata axio che ritorna array di tutte le categorie
              axios.get('/api/categories')
                  .then(res => {
                      this.categories = res.data;
                      console.log(this.categories);
                  })
              // chiamata axios e filtro che mi ritorna array piatti popolari 
              axios.get('/api/all-plates')
                  .then(res => {
                      for(let i = 0; i < res.data.length; i++){
                        let elem = res.data[i];

                        if(elem.popular == 1){
                          this.platesPopular.push(elem);
                        }
                      }
                      console.log(this.platesPopular);
                  })    
          },
          methods: {
              // funzione che valora il dato active restaurant al click del ristorante selezionato
              getActiveRestaurant: function(elem){
                  this.activeRestaurant = elem.id;
              }
          },
          computed: {
              // funzione per creare href da inserire nel link ristorante come rotta che porta al dettaglio del ristorante cliccato
              getHref: function(){
                  return '/restaurant-details/' + this.activeRestaurant;
              },
          }
      });
    </script>

    
    
@endsection