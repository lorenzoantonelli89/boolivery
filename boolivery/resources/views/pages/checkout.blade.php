@extends('layouts.main-layout')
@section('title')
    Checkout
@endsection
@section('content')
    
    <main>
        <div id="container-checkout">
            @if ($order -> status = true)
            <div class="container-text">
                <p>
                    Gentile {{$order -> name}} il suo ordine è in preparazione verrà consegnato entro le {{$order -> time_delivery}}
                </p>
            </div>
                <img id="img" src="{{asset('storage/graphics/checkout.png')}}" alt="">
            @endif
            @if ($order -> status = false)
                <p>
                    {{$error}}
                </p>
            @endif
        </div>
    </main>

    <script>
        function redirect(){
            window.location.replace('http://127.0.0.1:8000');
        }

        setTimeout('redirect()', 2800);
        const img = document.getElementById('img');
        function classImg(){
            img.classList.add('animation');
        }

        setTimeout('classImg()', 10);

    </script>

@endsection