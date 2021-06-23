@extends('layouts.main-layout')
@section('title')
    Checkout
@endsection
@section('content')
    
    <main>
        <div id="container-checkout">
            @if ($order -> status = true)
                <p>
                    Gentile {{$order -> name}} transazione avvenuta con successo con id: {{$transaction -> id}}
                </p>
                <span>
                    Il suo ordine arriverà entro le {{$order -> time_delivery}}
                </span>
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

        setTimeout('redirect()', 4000);
    </script>

@endsection