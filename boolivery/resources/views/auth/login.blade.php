<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('/css/app.css')}}">
</head>
<body>
    <div id="login-container">
        <div id="container-top">
            <span>
                {{ __('Login') }}
            </span>
        </div>

        <div id="container-form">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="container-email-password">
                    <label for="email" class="label">
                        {{ __('E-Mail Address') }}
                    </label>

                    <div class="container-input">
                        <input id="email" type="email" class="input-text @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="container-email-password">
                    <label for="password" class="label">
                        {{ __('Password') }}
                    </label>

                    <div class="container-input">
                        <input id="password" type="password" class="input-text @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="container-remember">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>

                <div class="container-button">
                    <button type="submit" id="submit">
                        {{ __('Login') }}
                    </button>

                    @if (Route::has('password.request'))
                        <a class="" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</body>
</html>

