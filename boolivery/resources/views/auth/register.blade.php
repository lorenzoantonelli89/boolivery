<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">

</head>
<body>
    <div id="register-container">
        <div id="container-top">
            <span>
                {{ __('Register') }}
            </span>
        </div>

        <div id="container-form">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                {{-- name --}}
                <div class="container-email-password-name">
                    <label for="name" class="label">
                        {{ __('Name') }}
                    </label>

                    <div class="container-input">
                        <input id="name" type="text" class="input-text @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                {{-- lastname --}}
                <div class="container-email-password-name">
                    <label for="lastname" class="label">
                        Lastname
                    </label>

                    <div class="container-input">
                        <input id="lastname" type="text" class="input-text @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                        @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                {{-- company_name --}}
                <div class="container-email-password-name">
                    <label for="company_name" class="label">
                        Denominazione Sociale
                    </label>

                    <div class="container-input">
                        <input id="company_name" type="text" class="input-text @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name" autofocus>

                        @error('company_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                {{-- address --}}
                <div class="container-email-password-name">
                    <label for="address" class="label">
                        Sede Legale
                    </label>

                    <div class="container-input">
                        <input id="address" type="text" class="input-text @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                {{-- VAT_number --}}
                <div class="container-email-password-name">
                    <label for="VAT_number" class="label">
                        P.Iva
                    </label>

                    <div class="container-input">
                        <input id="VAT_number" type="number" class="input-text @error('VAT_number') is-invalid @enderror" name="VAT_number" value="{{ old('VAT_number') }}" required autocomplete="VAT_number" autofocus>

                        @error('VAT_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                {{-- email --}}
                <div class="container-email-password-name">
                    <label for="email" class="label">{{ __('E-Mail Address') }}</label>

                    <div class="container-input">
                        <input id="email" type="email" class="input-text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                {{-- password --}}
                <div class="container-email-password-name">
                    <label for="password" class="label">{{ __('Password') }}</label>

                    <div class="container-input">
                        <input id="password" type="password" class="input-text @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                {{-- conferma password --}}
                <div class="container-email-password-name">
                    <label for="password-confirm" class="label">{{ __('Confirm Password') }}</label>

                    <div class="container-input">
                        <input id="password-confirm" type="password" class="input-text" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="container-button">
                    <button type="submit" id="submit">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


