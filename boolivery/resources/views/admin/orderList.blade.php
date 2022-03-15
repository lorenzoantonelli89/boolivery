@extends('layouts.main-layout')

@section('title')
    Lista Ordini {{$restaurant->name}}
@endsection

@section('content')
<main>
    <div class="container" id="appOrders">
        {{-- titolo --}}
        <h1>Ordini ricevuti da {{$restaurant->name}}</h1>
        {{-- se ci non ci sono ordini, mostra messaggio --}}
        @if (count($orders) < 1)
            <div class="no-orders"><strong>NON CI SONO ORDINI DA VISUALIZZARE</strong></div>
            <nav>
                <div class="back-button">
                    <a href="{{route('listRestaurant')}}"><i class="fas fa-long-arrow-alt-left"></i>TORNA ALLA DASHBOARD</a>
                </div>
            </nav>
        @else
            {{-- torna alla dashboard --}}
            <div class="back-to-dashboard">
                <a href="{{route('listRestaurant')}}"><i class="fas fa-long-arrow-alt-left"></i> Torna alla dashboard</a>
            </div>
            {{-- navbar menu --}}
            <nav>
                {{-- scegli l'anno --}}
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
                <div class="back-button">
                    <a href="{{route('showStats', encrypt($restaurant -> id))}}">VISUALIZZA GRAFICI</a>
                </div>
            </nav>
            {{-- visualizzazione ordini --}}
            <div>
                <table>
                    <thead>
                    <tr>
                        <th># ORDINE</th>
                        <th>EMAIL</th>
                        <th>DATA ORDINE</th>
                        <th>PREZZO TOTALE €</th>
                        <th>STATUS ORDINE</th>
                        <th>LINK</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="order in orders">
                        <td>@{{order.order_id}}</td>
                        <td>@{{order.customer_email}}</td>
                        <td>@{{order.date_delivery}}</td>
                        <td>@{{order.total_price}} €</td>
                        <td><span :class="order.status == 1 ? 'status paid' : 'status not-paid'"></span></td>
                        <td><a :href="'/showOrder/'+ order.order_id">Dettaglio ordine</a></td>
                    </tr>
                    </tbody>
                </table>
                </ul>
            </div>  
        @endif
    </div>
</main>
<script>

    new Vue({
        el: '#appOrders',
        data: {
            years: [], // array dinamico degli anni in cui ho ordini
            chosenYear:'', //anno selezionato
            orders:[]
        },
        methods: {
            showYear: function(){ // funzione per stabilire anno selezionato
                if(this.chosenYear == 0){ // chiamata in caso selezioni tutti gli anni
                    axios.post('/api/orderGraph/' + {{$restaurant->id}}) //chiamo tutti gli ordini associati al risto
                    .then(res=>{
                        this.orders = [];
                        const data = res.data;
                        let orderIds = [];
                        for(i=0;i<data.length;i++){
                            const order = data[i];
                            if(orderIds.indexOf(order['order_id']) == -1){
                                orderIds.push(order['order_id']);
                                this.orders.push(order);
                            }
                        }
                    })
                } else { // chiamata in caso sia selezionato un anno
                    axios.post('/api/orderYear/' + {{$restaurant->id}}  + '/' + this.chosenYear) //chiamata per anno selezionato
                    .then(res=>{
                        this.orders = [];
                        const data = res.data;
                        let orderIds = [];
                        for(i=0;i<data.length;i++){
                            const order = data[i];
                            if(orderIds.indexOf(order['order_id']) == -1){
                                orderIds.push(order['order_id']);
                                this.orders.push(order);
                            }
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
                let orderIds = [];
                for(i=0;i<data.length;i++){
                    const order = data[i];
                    const date = order['date_delivery'];
                    let year = new Date(date).getYear() + 1900;
                    if(unorderedYears.indexOf(year) == -1){
                        unorderedYears.push(year);
                    }
                    if(orderIds.indexOf(order['order_id']) == -1){
                        orderIds.push(order['order_id']);
                        this.orders.push(order);
                    }
                }
                this.years = unorderedYears.sort(function(a, b){return b-a}); // array ordinato ASC di anni disponibili.
            })
        }
    });

</script>
@endsection