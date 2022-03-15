@extends('layouts.main-layout')
@section('title')

    Lavora con noi
    
@endsection
@section('content')

    <main>
        <div id="work-container">
            <section id="section-1">
                <div class="div-margin">
                    <div class="flexi">
                        <div id="text-left">
                            <h1>Entra a far parte del nostro gruppo di lavoro</h1>
                            <p>In Deliveroo stiamo trasformando il modo in cui la gente pensa al cibo.
                            Quando pensi a Deliveroo, probabilmente pensi alla possibilità di ricevere i piatti che ami a domicilio, in mezz'ora.<br> 
                            Incredibile, vero? Eppure, le cose veramente incredibili succedono dietro le quinte: storie di grande crescita, immense sfide ed enormi opportunità.<br>
                            <p id="alone-line">Storie che ci piacerebbe raccontare insieme a te.</p>    
                            Vogliamo diventare la food company definitiva: l'app alla quale ti affidi quando la fame si fa sentire.<br> 
                            Offriamo accesso illimitato a tantissimi ristoranti e tipi di cucina differenti, dando alla gente la libertà di mangiare quello che vuole, quando vuole, dove vuole.</p>
                        </div>
                        <div id="community">
                        </div>
                    </div>
                </div>
            </section>
            <section id="section-2">
                <div class="div-margin">
                    <div class="flexi">
                        <div id="text-left-2">
                            <h1>Ottieni un posto ora.<br>
                                Valuta posizioni tra rider, engineer o ristoratore</h1>
                            <!-- Al click fa apparire il messaggio "Non ci sono posizioni aperte" -->
                            <button onclick="document.getElementById('error').innerHTML='Non ci sono posizioni aperte';">Canditati ora</button>
                            <span id="error"></span>
                            <p><a href="{{ route('faq') }}">Perchè lavorare con noi</a></p>
                            <div id="work-by-img">
                                <div id="rider" class="balls">
                                    <img src="https://img.icons8.com/color/50/000000/motorcycle-delivery-single-box.png" alt="Rider"/>
                                </div>
                                <div id="engineer" class="balls">
                                    <img src="https://img.icons8.com/dusk/64/000000/gear.png" alt="Ingegneria"/>
                                </div>
                                <div id="chef" class="balls">
                                    <img src="https://img.icons8.com/office/40/000000/restaurant.png" alt="Ristoratore"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="section-3">
                <div class="div-margin">
                    <h1>Perchè dovresti lavorare per noi?</h1>
                    <div class="flexi">
                        <ol id="why">
                            <li>
                                <h4><span class="azure-num">1.</span>Affronta sfide stimolanti.</h4>
                                <p>Non siamo solo un sito internet: troviamo soluzioni a problematiche complesse per clienti, rider e ristoranti.</p>
                            </li>
                            <li id="second">
                                <h4><span class="azure-num">2.</span>Diventa un'azienda.</h4>
                                <p>Non siamo solo un sito internet: troviamo soluzioni a problematiche complesse per clienti, rider e ristoranti.</p>
                            </li>
                            <li>
                                <h4><span class="azure-num">3.</span>Un'azienda in forte crescit&agrave;</h4>
                                <p>Non siamo solo un sito internet: troviamo soluzioni a problematiche complesse per clienti, rider e ristoranti.</p>
                            </li>
                        </ol>
                    </div>
                </div>
            </section>
        </div>
    </main>
    
@endsection