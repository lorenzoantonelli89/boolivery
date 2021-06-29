@extends('layouts.main-layout')

@section('content')
<main>
    <div class="container" id="appChart">
        {{-- titolo --}}
        <h1>Statistiche di {{$restaurant->id}}.{{$restaurant->name}}</h1>
        {{-- navbar-menu --}}
        <nav>
            {{-- scegli anno --}}
            <div>
                <label for="year-choice">Scegli l'anno da visualizzare</label>
                <select name="year-choice" id="year-choice" v-model="chosenYear" v-on:change="showYear">
                    <option disabled value="">Seleziona un anno</option>
                    {{-- visualizza media per mese di tutti gli anni --}}
                    <option value="0">From @{{years[years.length-1]}} to @{{years[0]}}</option> 
                    {{-- visualizza ciascun anno --}}
                    <option v-for="year in years" :value="year">@{{year}}</option>
                </select>
            </div>
            {{-- bottone per vedere statistiche ordini --}}
            <div>
                <div class="back-button">
                    <a href="{{route('showOrders', encrypt($restaurant -> id))}}">VISUALIZZA LISTA ORDINI</a>
                </div>
            </div>
        </nav>
        {{-- GRAFICO responsive --}}
        <div class="chart">
            <canvas id="myChart" width="600" height="400"></canvas>
        </div>
    </div>
</main>  

<script>

    new Vue({
        el: '#appChart',
        data: {
            sum: 0, // somma € singolo mese
            totEuro: [], // array di € da gennaio a dicembre 
            counter: 0, // qty di ordini per singolo mese
            tot:[], // array di qty da gennaio a dicembre
            years: [], // array dinamico degli anni in cui ho ordini
            chosenYear:'', //anno selezionato
            activeChart:'', //grafico attivo da distruggere e ricostruire
        },
        methods: {
            chartCreate: function(){ // funzione richiamata per montare il grafico
                const ctx = document.getElementById('myChart');
                let myChart = new Chart(ctx, {
                    data: { //dati da passare al grafico
                        labels: ['January', 'February','March', 'April', 'May','June','July','August','September','October','November','December'], //asse X
                        datasets: [
                            {
                                type: 'line', //tipo di visulizzazione dati
                                label: 'Tot ordini in €', //nome asse Y left
                                backgroundColor: 'rgb(0, 194, 184)',
                                borderColor: 'rgb(0, 194, 184)',
                                yAxisID: 'id1',
                                data: this.totEuro, // tot Vendite (€)
                            },
                            {
                                type: 'bar', //tipo di visulizzazione dati
                                label: 'Tot ordini', //nome asse Y right
                                backgroundColor: 'rgb(252, 106, 1)',
                                yAxisID: 'id2',
                                data: this.tot // tot Orders
                            }
                        ]
                    },
                    options: {
                        maintainAspectRatio: false, // responsiveness
                        scales: {
                            'id1':{ // stile asse Y left
                                type: 'linear',
                                position:'left',
                                title: {
                                    display: true,
                                    text: 'Totale ordini in €',
                                    color: 'rgb(0, 194, 184)',
                                },
                                ticks: { // funzione per associare € ai dati scritti sull'asse
                                    callback: function(value,index,values){
                                        return value + '€';
                                    }
                                }
                            },
                            'id2':  { // stile asse Y right
                                type: 'linear',
                                position: 'right',
                                title: {
                                    display: true,
                                    text: 'Tot ordini',
                                    color: 'rgb(252, 106, 1)',
                                }
                            }
                        }
                    }
                });
               this.activeChart = myChart; //stabilisco quale è il grafico che vedo , da distruggere e ricostruire
            },
            showYear: function(){ // funzione per stabilire anno selezionato
                this.totEuro= [];
                this.tot= [];
                if(this.chosenYear == 0){ // chiamata in caso selezioni tutti gli anni
                    axios.post('/api/orderGraph/' + {{$restaurant->id}}) //chiamo tutti gli ordini associati al risto
                    .then(res=>{
                        const data = res.data;
                        for(x=0;x<12;x++){ //ciclo su ogni mese
                            this.sum = 0; // tot NOI
                            this.counter = 0; // count Orders
                            let orderIds = []; // order_id univoci ricavati dalla tabella order_plate
                            for(i=0;i<data.length;i++){ // per ogni mese ciclo tutti gli ordini per estrarre dati di ordine del mese corrispondente
                                const order = data[i];
                                const date = order['date_delivery'];
                                const month = new Date(date).getMonth();
                                if(x == month){
                                    if(orderIds.indexOf(order['order_id']) == -1){
                                        orderIds.push(order['order_id']); //pusho order_id univoci
                                        const price = parseInt(order['total_price']); // prezzo per order_id
                                        this.sum = this.sum + price; // incremento tot € mese
                                    }
                                }
                            }
                            this.counter = orderIds.length; // tot ordini dato dalla lunghezza dell'array di order_id univoci
                            this.totEuro.push(this.sum); //per ogni mese, pusho il valore degli €
                            this.tot.push(this.counter); //per ogni mese, pusho il valore delle qty
                        }
                        this.activeChart.destroy(); //distruggo grafico
                        this.chartCreate(); //ricreo grafico
                    })
                } else{ // chiamata in caso sia selezionato un anno
                    axios.post('/api/orderYear/' + {{$restaurant->id}}  + '/' + this.chosenYear) //chiamata per anno selezionato
                    .then(res=>{
                        const data = res.data;
                        for(x=0;x<12;x++){
                            this.sum = 0; // tot NOI
                            this.counter = 0; // count Orders
                            let orderIds = [];
                            for(i=0;i<data.length;i++){
                                const order = data[i];
                                const date = order['date_delivery'];
                                const month = new Date(date).getMonth();
                                if(x == month){
                                    if(orderIds.indexOf(order['order_id']) == -1){
                                        orderIds.push(order['order_id']);
                                        const price = parseInt(order['total_price']);
                                        this.sum = this.sum + price;
                                    }
                                }
                            }
                            this.counter = orderIds.length;
                            this.totEuro.push(this.sum);
                            this.tot.push(this.counter);
                        }
                        this.activeChart.destroy();//distruggo grafico
                        this.chartCreate();//ricreo grafico
                    })
                }
            }
        },
        mounted(){ //funzione mounted che mi richiama dati per avere andamento generale
            axios.post('/api/orderGraph/' + {{$restaurant->id}})
            .then(res => {
                const data = res.data;
                const unorderedYears = []; //array disordinato di anni disponibili
                for(x=0;x<12;x++){
                    this.sum = 0; // tot NOI
                    this.counter = 0; // count Orders
                    let orderIds = [];
                    for(i=0;i<data.length;i++){
                        const order = data[i];
                        const date = order['date_delivery'];
                        const month = new Date(date).getMonth();
                        let year = new Date(date).getYear() + 1900;
                        if(unorderedYears.indexOf(year) == -1){
                            unorderedYears.push(year);
                        }
                        if(x == month){
                            if(orderIds.indexOf(order['order_id']) == -1){
                                orderIds.push(order['order_id']);
                                const price = parseInt(order['total_price']);
                                this.sum = this.sum + price;
                            }
                        }
                    }
                    this.counter = orderIds.length;
                    this.totEuro.push(this.sum);
                    this.tot.push(this.counter);
                }
                this.years = unorderedYears.sort(function(a, b){return b-a}); // array ordinato ASC di anni disponibili.
                this.chartCreate(); // dopo aver richiamato i dati, creo grafico del refresh
            })
        }
    });

</script>

@endsection