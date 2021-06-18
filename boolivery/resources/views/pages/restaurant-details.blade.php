@extends('layouts.main-layout')
@section('title')

    {{$restaurant -> restaurant_name}} 
    
@endsection

@section('content')

    <main>
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