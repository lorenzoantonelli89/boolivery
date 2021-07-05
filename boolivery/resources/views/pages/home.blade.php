@extends('layouts.main-layout')
@section('title')
    Home Page
@endsection

@section('content')

<main>
  <div id="home-container">
    <!-- PARTE SUPERIODE DEL SITO -->
    <div id="scroll" :class="(scrollToDown == true) ? 'active' : ''" v-on:click="scrollToUp">
      <i class="fas fa-chevron-up"></i>
    </div>
    <div class= "myjumbotron">
        <div id="triangle-topleft" :class="(scrollOn == true) ? 'active' : ''">
        </div>
        <div class="content-jumbotron"> 
          <h1>
            I piatti che ami, a domicilio
          </h1>
          <div class="research-request" >
              <input id="guest-request" type="text" name="" value="" placeholder="Cerca il tuo ristorante preferito..." v-model="searchRestaurant" v-on:keyup="filteredRestaurantsName">
          </div>
          <ul id="category-container-list" >
              <li class="category-list" v-for="category in categories">
                  <label :for="category.name">
                    @{{category.name}}
                  </label>
                  <input :id="category.name" type="checkbox" :name="category.name" :value="category.id"  v-model="categoryChecked" v-on:change="filteredRestaurantsCategory">
              </li>
          </ul>
        </div>
    </div>
    <!-- PRIMA SEZIONE, VISIONE DEI RISTORANTI -->
    <div class="main-sec-1" >
      <div id="triangle-sec-1">
      </div>
      <div id="title-sec-1">
        <h1><i><sup><i class="fas fa-star"></i></sup>I nostri ristoranti</i></h1>
      </div>
      <ul>
        <li v-for="elem in currentRestaurants" v-on:click="getActiveRestaurant(elem)">
          <a :href="'/restaurant-details/' + elem.id">
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
        <div id="plates-info">
          <img :src="'/storage/restaurant-plates/' + platesPopular[counter].image" alt="Immagine di portate">
          <div id="text-plates">
            <h3>
              <i>@{{platesPopular[counter].name}}</i>
            </h3>
            <p>
              <i>@{{platesPopular[counter].description}}</i>
            </p>
            <p class="restaurant-route">
              <a :href="'/restaurant-details/' + platesPopular[counter].restaurant_id">Vai al ristorante</a>
            </p>
          </div>
        </div>
        <div id="next" class="chevron">
          <i class="fas fa-chevron-right" v-on:click='nextImg'></i>         
        </div>            
      </div>
    </div>
    <!-- TERZA SEZIONE, TRIPLA SCELTA -->
    <div class="main-sec-3">
      <div id="business-adv">
        <div class="cards-adv" id="rider">
          <div class="triangle-rect" id="rider-img"></div>
          <div class="textAdv">
            <h3>Diventa un rider</h3>
            <p>Prendi in mano la tua bici o qualsiasi mezzo e consegna il cibo</p>
            <a href="{{ route('work') }}">
              <div class="btn-to" id="btn-rider">
                <p>Rider</p>
              </div>
            </a>
          </div>
        </div>  
        <div class="cards-adv" id="engineer">
          <div class="triangle-rect" id="engineer-img"></div>
          <div class="textAdv">
            <h3>Lavora con i nostri ingegneri</h3>
            <p>Entra a far parte del team che sta dietro al mondo di boolivery</p>
            <a href="{{ route('work') }}">
              <div class="btn-to" id="btn-engineer">
                <p>Ingegnere</p>
              </div>
            </a>
          </div>
        </div>  
        <div class="cards-adv" id="chef">
          <div class="triangle-rect" id="chef-img"></div>
          <div class="textAdv">
            <h3>Aggiungi il tuo ristorante</h3>
            <p>Entrare extra senza pagare i tuoi corrieri e senza vincoli contrattuali sul corriere</p>
            <a href="{{ route('register') }}">
              <div class="btn-to" id="btn-chef">
                <p>Ristoratore</p>
              </div>
            </a>
          </div>
        </div>  
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
          scrollToDown: false,
          scrollOn: false,
      },
      mounted() {
        //scorrimento automatico delle immagini
        this.autoSlide();
        document.addEventListener('scroll', this.scrollDown);

        // chiamata axios che mi ritorna array piatti popolari 
        axios.get('/api/popular-plates')
            .then(res => {
              this.platesPopular = res.data;
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
        // chiamata axio che ritorna array di tutti i ristoranti popolari
        axios.get('/api/restaurants')
            .then(res => {
                this.restaurantsPopular = res.data;
                this.currentRestaurants = this.restaurantsPopular;
            })
            .catch(error => {
                console.log(error)
            })
      },
      methods: {
        // funzione per far apparire e scomparire il bottone che cliccando porta la pagina a inizio
        scrollDown: function () {
            this.scrollToDown = true;
            if(window.scrollY < 300){
                this.scrollToDown = false;
            }
            this.scrollOn = true;
            if(window.scrollY == 0){
                this.scrollOn = false;
            }
        },
        // funzione che al click riporta la pagina a top 0
        scrollToUp: function () {
            window.scrollTo({ top: 0, behavior: 'smooth'});
        },
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
       
      }
  });
</script>
@endsection