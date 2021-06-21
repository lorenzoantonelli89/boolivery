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
                              <input id="guest-request" type="text" name="" value="" placeholder="Cerca il tuo ristorante preferito..." v-model="searchName" v-on:keyup="refreshCategory">
                            </div>
                        </div>
                      </div>   
                      <div class="categories">
                          <ul id="category-container-list">
                              <li class="category-list" v-for="category in categories">
                                  <h3 v-on:click="getActiveCategory(category)">
                                      @{{category.name}}
                                  </h3>
                              </li>
                          </ul>
                      </div>     
                  </div>
              </div>          
            </div>

        <!-- PRIMA SEZIONE, VISIONE DEI RISTORANTI -->
        <div class="main-sec-1" v-if="(activeCategory == '' && searchName == '')">
            <div class="main-1-container div-margin">
              <ul>
                <li v-for="elem in restaurantsPopular" v-on:click="getActiveRestaurant(elem)">
                  <a :href="getHref">
                    <div class="restaurants">
                      <img :src="'/storage/restaurant-profile/' + elem.image_profile " alt="Copertina ristorante">
                      <div id="text">
                        <h3 >@{{ elem.name }}</h3>
                        <p>@{{ elem.address }}</p>
                      </div>
                      <div id="layover" > <!-- Layover in absolute -->
                      </div>
                    </div>
                  </a>        
                </li>
              </ul>
            </div>
          </div>
          <div class="main-sec-1" v-else-if="activeCategory == ''">
            <div class="main-1-container div-margin">
              <ul>
                <li v-for="elem in filteredRestaurantsName" v-on:click="getActiveRestaurant(elem)">
                  <a :href="getHref">
                    <div class="restaurants">
                      <img :src="'/storage/restaurant-profile/' + elem.image_profile " alt="Copertina ristorante">
                      <div id="text">
                        <h3 >@{{ elem.name }}</h3>
                        <p>@{{ elem.address }}</p>
                      </div>
                      <div id="layover"> <!-- Layover in absolute -->
                      </div>
                    </div>
                  </a>        
                </li>
              </ul>
            </div>
          </div>
          <div class="main-sec-1" v-else>
            <div class="main-1-container div-margin">
              <ul>
                <li v-for="elem in filteredRestaurantsCategory" v-on:click="(getActiveRestaurant(elem), getActivePlates)">
                  <a :href="getHref">
                    <div class="restaurants">
                      <img :src="'/storage/restaurant-profile/' + elem.image_profile " alt="Copertina ristorante">
                      <div id="text">
                        <h3 >@{{ elem.name }}</h3>
                        <p>@{{ elem.address }}</p>
                      </div>
                      <div id="layover"> <!-- Layover in absolute -->
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
                <i class="fas fa-chevron-left" v-on:click='prevImg'></i>
              </div>
              <div class="position-carousel"></div>
              <div class="div-margin">
                <img :src="'/storage/restaurant-plates/' + platesPopular[counter].image" alt="Immagine di portate">
                <div id="plates-info">
                  <div id="text-plates">
                    <h3><i>@{{platesPopular[counter].name}}</i></h3>
                    <p><i>@{{platesPopular[counter].description}}</i></p>
                  </div>
                </div>
              </div>
              <div id="next" class="chevron">
                <i class="fas fa-chevron-right" v-on:click='nextImg'></i>          
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
              searchName: '',
              restaurants: '',
              restaurantsPopular: [],
              activeRestaurant: '',
              categories: '',
              activeCategory: '',
              platesPopular: [],
              categoryRestaurant: '',
              counter: 0
          },
          mounted() {

            //scorrimento automatico delle immagini
            this.autoSlide();

            // chiamata axio che ritorna array di tutti i ristoranti
            axios.get('/api/restaurants')
                .then(res => {
                    this.restaurants = res.data;
                    // filtro con cui creo array piatti popolari
                    for(let i = 0; i < this.restaurants.length; i++){
                      let elem = this.restaurants[i];
                      if(elem.popular == 1){
                        this.restaurantsPopular.push(elem);
                      }
                    }
                })
            // chiamata axio che ritorna array di tutte le categorie
            axios.get('/api/categories')
                .then(res => {
                    this.categories = res.data;
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
            // chiamata axios e filtro che mi ritorna array tabella pivot category_restaurant    
            axios.get('/api/pivot')
                .then(res => {
                    this.categoryRestaurant = res.data;
                })        
          },
          methods: {
            // funzione che valora il dato active restaurant al click del ristorante selezionato
            getActiveRestaurant: function(elem){
                this.activeRestaurant = elem.id;
            },
            // funzione che valora il dato active category al click della categoria selezionato
            getActiveCategory: function(elem){
              this.activeCategory = elem.id
            },
            // funzione che ripulisce 
            refreshCategory: function(){
              this.activeCategory = '';
            },
            // slider che passa all'immagine successiva
            nextImg: function () {

              if(this.counter === this.platesPopular.length -1) {
                this.counter = 0;
                console.log(this.counter);
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
            }
          },
          computed: {
              // funzione per creare href da inserire nel link ristorante come rotta che porta al dettaglio del ristorante cliccato
            getHref: function(){
                return '/restaurant-details/' + this.activeRestaurant;
            },
            // funzione per filtrare i ristoranti in base al nome
            // filteredRestaurantsName: function () {
            //   return this.restaurants.filter(elem => {
            //       return elem.name.toLowerCase().includes(this.searchName.toLowerCase());
            //   });
            // },
            // funzione per filtrare i ristoranti in base al nome
            filteredRestaurantsName: function() {
              const filtered = [];
              let name;

              for(let i = 0; i < this.restaurants.length; i++){
                  name = this.restaurants[i]['name'];
                  if (name.toLowerCase().includes(this.searchName.toLowerCase())) {
                      filtered.push(this.restaurants[i]);
                  }
              }
              return filtered;
            },
            // funzione per filtrare i ristoranti in base al nome
            filteredRestaurantsCategory: function() {
              const filtered = [];
              let categoryId;

              for(let i = 0; i < this.categoryRestaurant.length; i++){
                  categoryId = this.categoryRestaurant[i]['category_id'];
                  if (categoryId == this.activeCategory) {
                      filtered.push(this.categoryRestaurant[i]);
                  }
              }
              return filtered;
            },
          }
      });
    </script>
@endsection