@extends('layouts.main-layout')
@section('title')
    Home Page
@endsection

@section('content')

    <main>
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
                    <h3>@{{ elem.restaurant_name }}</h3>
                    <p>@{{ elem.address_restaurant }}</p>
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
          <div id="prev">
          </div>
          <div class="div-margin">
            <ul>
              <li v-for="elem in plates">
                <img src="elem.image" alt="Immagine di portate">
              </li>
            </ul>
          </div>
          <div id="next">          
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

        <ul>
            <li v-for="elem in restaurants" v-on:click="(getActiveRestaurant(elem), getActivePlates)">
                <a :href=getHref>
                    @{{elem.name}}
                </a>
                <div>
                    <span >
                        @{{elem.address}}
                    </span>
                </div>
                <img :src="'/storage/restaurant-profile/' + elem.image_profile " alt="" width="150px" height="150px">
            </li>
        </ul>
    </main>

    
    
@endsection