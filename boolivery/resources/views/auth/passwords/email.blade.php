@extends('layouts.main-layout')

@section('title')
    Registrati
@endsection

@section('content')
<main>
    <div id="password-reset-container">
        <div id="absolute-trapezoid"></div>
        <div id="container-top">
            <h1>
                {{ __('Password Reset') }}
            </h1>
        </div>
        <div id="absolute-trapezoid"></div>
        <div id="container-form">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="container-email-password">
                    <label for="email" class="label">{{ __('E-Mail Address') }}</label>

                    <div class="container-input">
                        <input id="email" type="email" class="input-text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="go-to-login">
                    <span>Vuoi tornare al Login ? </span>
                     <span><a href="{{ route('login') }}">{{ __('Clicca qui') }}</a></span>
                </div>

                <div class="container-button">
                    <button id="submit" type="submit">
                        {{ __('Invia link password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection