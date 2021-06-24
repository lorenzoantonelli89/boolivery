<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Delivery Order</title>
    <style>
        body{
            background-color: lightblue;
            color: #fff;
        }
        
    </style>
</head>
<body>
    <div id="container-mail">
        <h1>
            Gentile {{$order -> name}} {{$order -> lastname}} il suo ordine è in consegna, l'orario previsto è: {{$order -> time_delivery}}
        </h1>
    </div>
</body>
</html>