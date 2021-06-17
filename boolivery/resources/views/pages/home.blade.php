@extends('layouts.main-layout')
@section('title')
    Home Page
@endsection

@section('content')

    <main>
    <!-- PARTE SUPERIODE DEL SITO -->
    <div class=jumbotron>
          <div class="div-margin">
          <div class="wellcome ">
                
                <div class="logo-login">
                  <img class="logo" src={{ asset('/storage/graphics/logocompleto.png') }} alt="">
                  <a class="blink" href="#">LOGIN</a>
                </div>
                
                <div class="title-research">                  
                    <h1>I piatti che ami, a domicilio</h1>
                <div class="research-request">

                  <span>Cerca il tuo ristorante preferito</span> 
                  
                  <div class="input-adresse">
                    <input id="guest-request" type="text" name="" value="" placeholder="Cerca il tuo ristorante preferito...">
                    <input id="guest-request-click" type="submit" name="" value="CERCA"></input>
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
          <div class="piatto">
            <img src={{ asset('/storage/restaurant-profile/dagianninologo.png') }} alt="">
            <h3>Nome Ristorante</h3>
            <span>Specialità</span>
          </div>
          <div class="piatto">
            <img src={{ asset('/storage/restaurant-profile/homulogo.png') }} alt="">
            <h3>Nome Ristorante</h3>
            <span>Specialità</span>
          </div>
          <div class="piatto">
            <img src={{ asset('/storage/restaurant-profile/pokehouselogo.png') }} alt="">
            <h3>Nome Ristorante</h3>
            <span>Specialità</span>
          </div>        
        </div>
      </div>

      <!-- SECONDA SEZIONE, VISIONE DEI PIATTI -->
      <div id="section-2">
        <div class="div-margin">
            <div class="cards" id="details">
              <div class="dx">
              </div>
              <div id="column">
                <div class="sx">
                  <p><b>Nome: </b></p>
                  <p><b>Votazioni medie: </b></p>
                  <p><b>Descrizione: </b></p>
                </div>
              </div>
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
      <div id="contacts">
        <div id="mail">
          <i class="fas fa-at"></i>
        </div>
        <div id="phone">
          <i class="fas fa-phone"></i>
        </div>
      </div>

        <ul>
            <li v-for="elem in restaurants" v-on:click="getActiveRestaurant(elem)">
                <a :href=getHref>
                    @{{elem.restaurant_name}}
                </a>
                <div>
                    <span >
                        @{{elem.address_restaurant}}
                    </span>
                </div>
                <img :src="'/storage/restaurant-profile/' + elem.image_profile " alt="">
            </li>
        </ul>
    </main>

    
    
@endsection