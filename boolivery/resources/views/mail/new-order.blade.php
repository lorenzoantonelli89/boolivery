<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Delivery Order</title>
    <style>
        body{
            background-color: #6cb1ea;
            font-family: 'Open Sans', sans-serif;
        }
        
    </style>
</head>
<body>
    <div id="container-mail">
        <h2>
            Gentile {{$order -> name}} {{$order -> lastname}} il suo ordine numero {{$order->id}} è confermato.
        </h2>
        <h4>L'orario di arrivo previsto è: {{$order -> time_delivery}}</h4>
        <h4>Indirizzo di consegna: {{$order->shipping_address}} </h4>
        <h4>Piatti ordinati</h4>
        <ul>
            @php
                $sum = 0;
            @endphp
            @foreach ($order->plates as $plate)
                <li>
                    <span>{{$plate->name}}</span>
                    <span> --------------- </span>
                    <span>{{$plate->price}}</span>
                </li>
                @php
                    $sum += $plate->price;
                @endphp
            @endforeach
        </ul>
        <div>Totale: {{$order->total_price}}</div>
        @if ($sum < 20)
            <div>Spese di consegna: 5€</div>
        @else
            <div><strong>Consegna gratuita</strong></div>
        @endif
        <p>
        Boolivery SRL <br>
        sede legale: via La Fame, 9 <br>
        20146, Milano <br> 
        </p>
    </div>
</body>
</html>