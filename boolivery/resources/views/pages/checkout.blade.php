@extends('layouts.main-layout')
@section('title')
    Checkout
@endsection
@section('content')
    
    <main>
        <div id="container-checkout">
            transazione avvenuta con successo con id: {{$transaction -> id}}
        </div>
    </main>

@endsection