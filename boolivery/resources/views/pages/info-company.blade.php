@extends('layouts.main-layout')
@section('title')

    Chi siamo
    
@endsection
@section('content')
    
    <main>
        <div id="info-container">
            <div class="backend-container">
            <img class="infotitolo" src="/storage/graphics/infotitoloback.png" alt="">
            
            <div class="images-container">
                <div class="info-foto-details">

                    <img class="infofotoprofilo" src="/storage/graphics/infostaffnicola.png" alt="">
                    <h2>Nicola Milani</h2>
                    <span>Cucina Codice</span>
                </div>
                <div class="info-foto-details">

                <img class="infofotoprofilo" src="/storage/graphics/infostafflorenzo.png" alt="">
                <h2>Lorenzo Antonelli</h2>
                    <span>Chef Leader</span>

                </div>
                <div class="info-foto-details">
                <img class="infofotoprofilo" src="/storage/graphics/infostaffgiordano.png" alt="">

                <h2>Giordano Vita</h2>
                    <span>Degusta Metodi</span>
                </div>
                </div>
            </div>

            <div class="frontend-container">
            <img class="infotitolo" src="/storage/graphics/infotitolofront.png" alt="">
                <div class="images-container">
                <div class="info-foto-details">

                <img class="infofotoprofilo" src="/storage/graphics/infostaffjacopo.png" alt="">
                <h2>Jacopo Zandonà</h2>
                    <span>Boomer alla Griglia</span>
                <h1></h1>
                <span></span>

                </div>

                <div class="info-foto-details">

                <img class="infofotoprofilo" src="/storage/graphics/infostaffsimone.png" alt="">
                <h2>Simone Marzolla</h2>
                    <span>Display Menu: none</span>
                <h1></h1>
                <span></span>

                </div>
                </div>
            </div>
            
        </div>

        <div class="superlogo">

                <img src="/storage/graphics/team4cover.png" alt="">
                
        </div>
    </main>

    <script>
        
        // new Vue({
        //   el: '#info-container',
        //   data: {
              
        //       restaurants: '',
        //       foto: ""
              
        //   },

        //   mounted() {

        //     axios.get('/api/restaurants')
        //                 .then(res => {
        //                     this.restaurants = res.data;
        //                     let myfoto = this.restaurants[0].image_profile;
        //                     this.foto = myfoto;
                            
        //                 });

        //   }
        
        //             })

    </script>
@endsection