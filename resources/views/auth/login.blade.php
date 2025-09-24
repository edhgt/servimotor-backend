<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="">
  <title>{{config('app.name')}}</title>
  <meta name="theme-color" content="#563d7c">
  <style>
    .bd-placeholder-img{font-size:1.125rem;text-anchor:middle;-webkit-user-select:none;-moz-user-select:none;user-select:none}@media (min-width: 768px){.bd-placeholder-img-lg{font-size:3.5rem}}.b-example-divider{width:100%;height:3rem;background-color:#0000001a;border:solid rgba(0,0,0,.15);border-width:1px 0;box-shadow:inset 0 .5em 1.5em #0000001a,inset 0 .125em .5em #00000026}.b-example-vr{flex-shrink:0;width:1.5rem;height:100vh}.bi{vertical-align:-.125em;fill:currentColor}.nav-scroller{position:relative;z-index:2;height:2.75rem;overflow-y:hidden}.nav-scroller .nav{display:flex;flex-wrap:nowrap;padding-bottom:1rem;margin-top:-1px;overflow-x:auto;text-align:center;white-space:nowrap;-webkit-overflow-scrolling:touch}.btn-bd-primary{--bd-violet-bg: #712cf9;--bd-violet-rgb: 112.520718, 44.062154, 249.437846;--bs-btn-font-weight: 600;--bs-btn-color: var(--bs-white);--bs-btn-bg: var(--bd-violet-bg);--bs-btn-border-color: var(--bd-violet-bg);--bs-btn-hover-color: var(--bs-white);--bs-btn-hover-bg: #6528e0;--bs-btn-hover-border-color: #6528e0;--bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);--bs-btn-active-color: var(--bs-btn-hover-color);--bs-btn-active-bg: #5a23c8;--bs-btn-active-border-color: #5a23c8}.bd-mode-toggle{z-index:1500}.bd-mode-toggle .bi{width:1em;height:1em}.bd-mode-toggle .dropdown-menu .active .bi{display:block!important}
  </style>
  @vite('resources/css/app.css')
  <link href="/css/sign-in.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto shadow-lg px-4 bg-body-tertiary rounded">
        <form action="{{ route('login') }}" class="" method="POST">
            @csrf
            <div class="text-center mb-4">
                <img class="mb-4" src="/images/logo.jpg" alt="">
                <h1 class="h3 mb-3 fw-normal">{{ __('Login') }}</h1>
                <p>{{config('app.name')}}</p>
            </div>
            <div class="form-floating mb-3">
                <input aria-describedby="emailHelpBlock" autocomplete="email" autofocus class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{ __('Username') }}" required type="text" value="{{ old('email') }}">        
                @error('email')
                <span class="invalid-feedback mb-3" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="email">{{ __('Email') }}</label>
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
            <p class="mt-5 mb-3 text-muted text-center">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
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
</body>
</html>