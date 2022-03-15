@extends('layouts.main-layout')
@section('title')
    Pagamento
@endsection
@section('content')
    
    <main>
        <div id="container-payment">
            <form method="post" id="payment-form" action="{{route('checkout', encrypt($order -> id))}}">
                @csrf
                <section>
                    <div id="container-amount">
                        <label for="amount">
                            <span class="input-label">Totale ordine</span>
                            <div class="">
                                <input id="amount" name="amount" type="hidden" min="1" placeholder="Amount" value="{{$order -> total_price}}">
                                <span>
                                    {{$order -> total_price}} €
                                </span>
                            </div>
                        </label>
                    </div>
                    <div class="container-dropin">
                        <div id="bt-dropin"></div>
                    </div>
                </section>

                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <div id="container-button">
                    <button class="button" type="submit" v-on:click="dropinRequestPaymentMethod">
                        Paga Ordine
                    </button>
                </div>
            </form>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            let form = document.querySelector('#payment-form');
            let client_token = "{{ $token }}";

            braintree.dropin.create({
            authorization: client_token,
            selector: '#bt-dropin',
            
            }, function (createErr, instance) {
                if (createErr) {
                    console.log('Create Error', createErr);
                    return;
                }
                form.addEventListener('submit', function (event) {
                    event.preventDefault();

                    instance.requestPaymentMethod(function (err, payload) {
                    if (err) {
                        console.log('Request Payment Method Error', err);
                        return;
                    }

                    // Add the nonce to the form and submit
                    document.querySelector('#nonce').value = payload.nonce;
                    form.submit();
                    });
                });
            });
        });
    </script>
@endsection