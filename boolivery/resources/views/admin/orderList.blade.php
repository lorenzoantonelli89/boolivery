@extends('layouts.main-layout')

@section('content')
<main>
<div class="container" id="appOrders">
    {{-- titolo --}}
    <h1>Ordini ricevuti da {{$restaurant->id}}.{{$restaurant->name}}</h1>
    {{-- scegli anno --}}
    <div>
        <label for="year-choice">Scegli l'anno da visualizzare</label>
        <select name="year-choice" id="year-choice" v-model="chosenYear" v-on:change="showYear">
            <option disabled value="">Seleziona un anno</option>
            {{-- visualizza media per mese di tutti gli anni --}}
            <option value="0">Tutti gli ordini</option> 
            {{-- visualizza ciascun anno --}}
            <option v-for="year in years" :value="year">@{{year}}</option>
        </select>
    </div>
    {{-- bottone per vedere statistiche ordini --}}
    <a href="{{route('showStats', encrypt($restaurant -> id))}}">
        <button style="background-color:red; padding: 10px; ">Vai a vedere grafico</button>
    </a>
    {{-- visualizzazione ordini --}}
    <div>
        <table>
            <tr>
                <th># ORDINE</th>
                <th>CLIENTE</th>
                <th>INDIRIZZO DI CONSEGNA</th>
                <th>EMAIL</th>
                <th>DATA E ORA DI CONSEGNA</th>
                <th>PREZZO TOTALE €</th>
                <th>STATUS ORDINE</th>
                <th>PIATTI ORDINATI</th>
            </tr>
            <tr v-for="order in orders">
                <td>@{{order.order_id}}</td>
                <td>@{{order.order_name}} @{{order.order_lastname}}</td>
                <td>@{{order.shipping_address}}</td>
                <td>@{{order.customer_email}}</td>
                <td>@{{order.date_delivery}} @@{{order.time_delivery}}</td>
                <td>@{{order.total_price}} €</td>
                <td><div :class="order.status == 1 ? 'paid' : 'not-paid'"></div></td>
                <td>PIATTI ORDINATI</td>
            </tr>
        </table>
        </ul>
    </div>


</div>   
</main>
<script>

    new Vue({
        el: '#appOrders',
        data: {
            sum: 0, // somma € singolo mese
            totEuro: [], // array di € da gennaio a dicembre 
            counter: 0, // qty di ordini per singolo mese
            tot:[], // array di qty da gennaio a dicembre
            years: [], // array dinamico degli anni in cui ho ordini
            chosenYear:'', //anno selezionato
            activeChart:'', //grafico attivo da distruggere e ricostruire
            orders:[]
        },
        methods: {
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
                                const price = parseInt(order['price']);
                                if(x == month){
                                    this.sum = this.sum + price; //per ogni ordine corrispondente, incremento €
                                    if(orderIds.indexOf(order['order_id']) == -1){ //pusho order_id univoci
                                        orderIds.push(order['order_id']);
                                        this.orders.push(order);
                                    }
                                }
                            }
                            this.counter = orderIds.length; // tot ordini dato dalla lunghezza dell'array di order_id univoci
                            this.totEuro.push(this.sum); //per ogni mese, pusho il valore degli €
                            this.tot.push(this.counter); //per ogni mese, pusho il valore delle qty
                        }
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
                                const price = parseInt(order['price']);
                                if(x == month){
                                    this.sum = this.sum + price; //per ogni ordine corrispondente, incremento €
                                    if(orderIds.indexOf(order['order_id']) == -1){
                                        orderIds.push(order['order_id']);
                                        this.orders.push(order);
                                    }
                                }
                            }
                            this.counter = orderIds.length;
                            this.totEuro.push(this.sum);
                            this.tot.push(this.counter);
                        }
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
                        const price = parseInt(order['price']);
                        let year = new Date(date).getYear() + 1900;
                        if(unorderedYears.indexOf(year) == -1){
                            unorderedYears.push(year);
                        }
                        if(x == month){
                            this.sum = this.sum + price; //per ogni ordine corrispondente, incremento €
                            if(orderIds.indexOf(order['order_id']) == -1){
                                orderIds.push(order['order_id']);
                                this.orders.push(order);
                                console.log(this.orders);
                            }
                        }
                    }
                    this.counter = orderIds.length;
                    this.totEuro.push(this.sum);
                    this.tot.push(this.counter);
                }
                this.years = unorderedYears.sort(function(a, b){return b-a}); // array ordinato ASC di anni disponibili.
            })
        }
    });

</script>
@endsection