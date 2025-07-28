@extends('layouts.app')

@section('content')
<link href="/css/sign-in.css" rel="stylesheet">
<div class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto shadow-lg px-4 bg-body-tertiary rounded">
        <form action="{{ route('login') }}" class="" method="POST">
            @csrf
            <div class="text-center mb-4">
                <img class="mb-4" src="/images/user-password-icon.png" alt="">
                <h1 class="h3 mb-3 fw-normal">{{ __('Login') }}</h1>
            </div>
            <div class="form-floating mb-3">
                <input aria-describedby="emailHelpBlock" autocomplete="email" autofocus class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{ __('email') }}" required type="text" value="{{ old('email') }}">        
                @error('email')
                <span class="invalid-feedback mb-3" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="email">{{ __('Email Address') }}</label>
            </div>
        
            <div class="form-floating mb-3">
                <input autocomplete="current-password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Password" required>
        
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="password">{{ __('Password') }}</label>
            </div>
        
            <div class="form-check">
                <input class="form-check-input" id="toggle-view-password" name="toggle-view-password" type="checkbox" onclick="toggleViewPassword(event)">
                <label class="form-check-label" for="toggle-view-password">Mostrar contraseña</label>
            </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
            </div>
    
            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">{{ __('Login') }}</button>
            </div>
        
            @if (Route::has('password.request'))
            <p class="mt-2 mb-3 text-muted text-center">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            </p>
            @endif
        </form>
    </main>
    <script>
        function toggleViewPassword(event) {
            let x = document.getElementById("password");
            event.target.checked && x.type === "password"? x.type = "text" : x.type = "password";
        }
    </script>
</div>
@endsection
