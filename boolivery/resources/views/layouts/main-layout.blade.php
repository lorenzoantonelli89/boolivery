<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
    {{-- my script js --}}
    <script src="{{asset('/js/app.js')}}"></script>

</head>
<body>
    
    <div id=app class=my-container>
        @include('components.header')

        @yield('content')

        @include('components.footer')
    </div>
    
</body>
</html>