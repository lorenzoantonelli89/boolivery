@extends('layouts.main-layout')
@section('title')
    FAQ
@endsection
@section('content')
    <main>
        <div id="faq-container">
            <div id="absolute-trapezoid"></div>
            <div class="div-margin">
                <div id="back-h1">
                    <h1>FAQ</h1>
                </div>
                <div id="faq">
                    <ul id="quest">
                        <li>
                            <p>Cos'è Booliveroo?</p>
                            <p>Booliveroo è un'azienda che s'impegna a consegnare cibo del tuo ristorante preferito a casa tua.<br>
                            Abbiamo migliaia di ristoranti affiliati e altrettanto personale addetto alla consegna, così da coprire nel minor tempo il maggior numero di ordini.
                            </p>
                        </li>
                        <li>
                            <p>Come faccio ad ordinare?</p>
                            <p>Recati nella home-page e cerca il tuo ristorante preferito; 
                            puoi anche solamente ricercare tramite i filtri proposti, 
                            scegliendo tra la cucina che più ti piace.<br>
                            Una volta ricercato, clicca sulla card che ti è comparsa nella sezione sotto 
                            e li potrai accedere ai tutti i piatti che il ristorante propone con la possibilità di acquistarli.<br>
                            Inserisca i suoi dati di spedizione e di fatturazione e completi l'acquisto, 
                            entro 30 minuti / 1 ora saremo da lei.
                            </p>
                        </li>
                        <li>
                            <p>Come funziona?</p>
                            <p>Una volta effettuato il pagamento verrà inviato l'ordine al ristorante da cui lei ha acquistato;<br>
                            loro elaboreranno l'ordine preparando e confezionando il cibo, per poi essere preso da un nostro rider che verrà a consegnarlo a casa sua.
                            </p>
                        </li>
                        <li>
                            <p>Posso ritirare personalmente il mio ordine?</p>
                            <p>Assolutamente si, se lei non abita in una zona coperta dal nostro servizio o vuole seplicemente andare a ritirare il suo ordine può farlo.<br>
                               Purtroppo al momento non è disponibile nessuna funzione di chiamata al ristorante o al rider incaricato.
                            </p>
                        </li>
                        <li>
                            <p>Come viene confezionato il cibo?</p>
                            <p>Il confezionamento del cibo è a cura del ristorante incaricato che dovrà confezionarlo in modo che la temperatura rimanga costante.<br>
                            </p>
                        </li>
                        <li>
                            <p>E' disponibile l'applicazione di Booliveroo?</p>
                            <p>Al momento non disponiamo di nessuna applicazione, ma ci stiamo lavorando.
                            </p>
                        </li>
                        <li>
                            <p>Vorrei provare l'esperienza di lavorare con voi</p>
                            <p>Per verificare quali posizioni sono attualmente aperte, visiti la pagina <a href="{{ route('work') }}">Lavora con noi</a> premendo l'apposito pulsante <b>candidati ora</b>
                            </p>
                        </li>
                        <li>
                            <p>Non voglio più usufruire del servizio da ristoratore?</p>
                            <p>Ci dispiace che lei non si sia trovato bene con il nostro servizio, ci contatti pure a <a href="mailto:support.booliveroo@mail.com">support.booliveroo@mail.com</a>
                            </p>
                        </li>
                    </ul>
                </div>
                <p>Hai altre domande particolari? <a href="mailto:support.boliveroo@mail.com">Contattaci</a></p>
            </div>
        </div>
    </main>
@endsection