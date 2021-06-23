@extends('layouts.main-layout')

@section('content')

    {{-- responsive --}}
    <div id ="appChart" style="width:30vw">
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>

    <div>
        <canvas id="myChart2" width="400" height="400"></canvas>
    </div>

<script>

    new Vue({
        el: '#appChart',
        data: {
            test: '',
        },
        mounted(){
            axios.get('/api/orders/' + 1)
            .then(res => {
                this.test = res.data;
                console.log(this.test);
            })
        }
    });

    // const labels = ['January', 'February','March', 'April', 'May','June'];
    // const label = 'NOI / Month (in K/euro)';
    // const data = {
    //     labels: labels,
    //     datasets: [
    //         {
    //             type: 'line',
    //             label: label,
    //             backgroundColor: 'rgb(255, 99, 132)',
    //             borderColor: 'rgb(132, 99, 132)',
    //             yAxisID: 'id1',
    //             data: [3,4,10,2,4,5], // recuperare dati ordine
    //         },
    //         {
    //             type: 'bar',
    //             label: 'Tot ordini',
    //             backgroundColor: 'rgb(255, 255, 132)',
    //             yAxisID: 'id2',
    //             data: [100,150,200,90,170,110]
    //         }
    //     ]
    // };
    // const config = {
    //     data,
    //     options: {
    //         maintainAspectRatio: false, // responsiveness
    //         scales: {
    //             'id1':{
    //                 type: 'linear',
    //                 position:'left',
    //                 title: {
    //                     display: true,
    //                     text: 'NOI total (in K)',
    //                 }
    //             },
    //             'id2':  {
    //                 type: 'linear',
    //                 position: 'right',
    //                 title: {
    //                     display: true,
    //                     text: 'Tot ordini',
    //                 }
    //             }
    //         }
    //     }
    // };
    // var myChart = new Chart( document.getElementById('myChart'),config );
    

    // const data2 = [{x: 'Jan', net: 100, cogs: 50}, {x: 'Feb', net: 120, cogs: 55}];
    // const cfg = {
    //                 type: 'bar',
    //                 data: {
    //                     labels: ['Jan', 'Feb'],
    //                     datasets: [
    //                         {
    //                             label: 'Net sales',
    //                             data: data2,
    //                             backgroundColor: 'rgb(255, 99, 132)',
    //                             parsing: {
    //                                 yAxisKey: 'net'
    //                             }
    //                         }, 
    //                         {
    //                             label: 'Cost of goods sold',
    //                             data: data2,
    //                             backgroundColor: 'rgb(255, 255, 132)',
    //                             parsing: {
    //                                 yAxisKey: 'cogs'
    //                             }
    //                         }
    //                     ]
    //                 },
    //             };

    // var myChart2 = new Chart( document.getElementById('myChart2'),cfg );

    // function init(){
    //     $.ajax({
    //         url:'/api/orders',
    //         method:'GET',
    //         success: function (data){
    //             const res = data[0];
    //             const date = res['date_delivery'];
    //             const month = new Date(date).getMonth();
    //             console.log(data);               
    //         },
    //         error: function(){
    //         console.log("ERRORE");
    //         }
    //     })
    // }

    // document.addEventListener('DOMContentLoaded',init);
    
</script>

    

    
@endsection