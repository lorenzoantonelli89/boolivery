@extends('layouts.main-layout')
@section('title')
    Home Page
@endsection

@section('content')

    <main>
      <div id="home-container">
        <!-- PARTE SUPERIODE DEL SITO -->
        <div class=myjumbotron>
            <div class="content-jumbotron">                  
              <h1>
                I piatti che ami, a domicilio
              </h1>
              <div class="research-request" v-if="categoryChecked == 0">
                  <input id="guest-request" type="text" name="" value="" placeholder="Cerca il tuo ristorante preferito..." v-model="searchRestaurant" v-on:keyup="filteredRestaurantsName">
              </div>
              <div class="categories">
                  <ul id="category-container-list" v-if="searchRestaurant == ''">
                      <li class="category-list" v-for="category in categories">
                          <label :for="category.name">
                            @{{category.name}}
                          </label>
                          <input type="checkbox" :name="category.name" :value="category.id"  v-model="categoryChecked" v-on:change="filteredRestaurantsCategory">
                      </li>
                  </ul>
              </div>     
            </div>
        </div>

        <!-- PRIMA SEZIONE, VISIONE DEI RISTORANTI -->
        <div class="main-sec-1" >
          <div class="div-margin">
            <div class="main-1-container">
              <ul>
                <li v-for="elem in currentRestaurants" v-on:click="getActiveRestaurant(elem)">
                  <a :href="getHref">
                    <div class="restaurants">
                      <img :src="'/storage/restaurant-profile/' + elem.image_profile " alt="Copertina ristorante">
                      <div id="text">
                        <h3>@{{ elem.name }}</h3>
                      </div>
                    </div>
                  </a>        
                </li>
              </ul>
            </div>
          </div>
        </div>

        <!-- SECONDA SEZIONE, VISIONE DEI PIATTI -->
        <div id="section-2">
          <div id="top-rating-plates">
            <h1><i><sup><i class="fas fa-star"></i></sup>Top ratings</i></h1>
          </div>
          <div class="flexible-carusel">
            <div id="prev" class="chevron">
              <i class="fas fa-chevron-left" v-on:click='prevImg'></i>
            </div>
            <!--<div class="position-carousel"></div>-->
            <div class="div-margin">
              <div id="plates-info">
                {{-- <img :src="'/storage/restaurant-plates/' + platesPopular[counter].image" alt="Immagine di portate">
                  <div id="text-plates">
                    <h3><i>@{{platesPopular[counter].name}}</i></h3>
                    <p><i>@{{platesPopular[counter].description}}</i></p>
                  </div> --}}
              </div>
            </div>
            <div id="next" class="chevron">
              <i class="fas fa-chevron-right" v-on:click='nextImg'></i>          
            </div>            
          </div>
        </div>

          <!-- TERZA SEZIONE, SEZIONE PER I RISTORATORI -->
          <div class="main-sec-3">
            <div class="div-margin">
              <div id="business-adv">
                <div class="cards-adv">
                </div>  
                <div class="cards-adv">
                </div>  
                <div class="cards-adv">
                </div>  
              </div>
            </div>
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
              searchRestaurant: '',
              restaurantsPopular: '',
              activeRestaurant: '',
              categories: '',
              categoryChecked: [],
              currentRestaurants: '',
              platesPopular: '',
              counter: 0,
          },
          mounted() {
            //scorrimento automatico delle immagini
            this.autoSlide();

            // chiamata axio che ritorna array di tutti i ristoranti
            axios.get('/api/restaurants')
                .then(res => {
                    this.restaurantsPopular = res.data;
                    this.currentRestaurants = this.restaurantsPopular;
                    
                })
                .catch(error => {
                    console.log(error)
                })
            // chiamata axio che ritorna array di tutte le categorie
            axios.get('/api/categories')
                .then(res => {
                    this.categories = res.data;
                })
                .catch(error => {
                    console.log(error)
                })
            // chiamata axios e filtro che mi ritorna array piatti popolari 
            axios.get('/api/popular-plates')
                .then(res => {
                  this.platesPopular = res.data;
                    console.log(this.platesPopular);
                })
                .catch(error => {
                    console.log(error)
                })
          },
          methods: {
            // funzione per filtrare i ristoranti in base alla categoria
            filteredRestaurantsCategory: function() {
              
              if(this.categoryChecked.length > 0){
                axios.post('/api/restaurants-filteredCat/' + this.categoryChecked)
                .then(res => {
                    this.currentRestaurants = res.data;
                })
                .catch(error => {
                    console.log(error)
                })
              }else{
                this.currentRestaurants = this.restaurantsPopular;
              }

            },
             // funzione per filtrare i ristoranti in base al nome
            filteredRestaurantsName: function() {

              if(this.searchRestaurant != ''){
                axios.post('/api/restaurants-filteredName/' + this.searchRestaurant)
                .then(res => {
                    this.currentRestaurants = res.data;
                })
                .catch(error => {
                    console.log(error)
                })
              }else{
                this.currentRestaurants = this.restaurantsPopular;
              }

            },
            // funzione che valora il dato active restaurant al click del ristorante selezionato
            getActiveRestaurant: function(elem){
                this.activeRestaurant = elem.id;
            },
            // slider che passa all'immagine successiva
            nextImg: function () {

              if(this.counter === this.platesPopular.length -1) {
                this.counter = 0;
              } else {
                this.counter++;
              }
            },
            // slider che passa all'immagine precedente
            prevImg: function() {
              this.counter--;
              if(this.counter < 0) {
                this.counter = this.platesPopular.length -1;
              }
            },
            // funzione che fa lo slide automatico e viene richiamata quanto si monta la pagina
            autoSlide: function() {
              setInterval(this.nextImg, 4000);
            },
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