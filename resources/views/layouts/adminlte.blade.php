<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>{{ config('app.name', 'Laravel') }}</title>

  @vite(['resources/css/adminlte.css'])
  @yield('css')
</head>
<body class="layout-fixed sidebar-expand-sm sidebar-mini bg-body-tertiary">
  <!-- Site wrapper -->
  <div id="app" class="app-wrapper">
    <!-- Navbar -->
    <nav class="app-header navbar navbar-expand navbar-white navbar-light">
      <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"><i class="bi bi-list"></i></a>
          </li>
          <li class="nav-item d-none d-md-block">
            <a href="https://intranet.mineco.gob.gt" class="nav-link" target="_blank">Intranet</a>
          </li>
          <li class="nav-item d-none d-md-block">
            <a href="https://otrs.mineco.gob.gt" class="nav-link" target="_blank">Ayuda</a>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#" data-lte-toggle="fullscreen">
              <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
              <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
            </a>
          </li>
          <user-menu></user-menu>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      <div class="sidebar-brand">
        <a href="#" class="brand-link logo-switch">
          <img
            src="/images/logo.jpg"
            alt="AdminLTE Logo"
            class="brand-image opacity-75 shadow rounded" height="45"
          />
          <span class="brand-text fw-light">{{env('APP_NAME')}}</span>
        </a>
      </div>
      <sidebar></sidebar>
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <main class="app-main" id="app-main">
      <content-header></content-header>
      <div class="app-content">
        <div class="container-fluid">
          @yield('content')   
        </div>
      </div>
    </main>
    <!-- /.content-wrapper -->
  </div>
  <!-- ./wrapper -->
  @vite(['resources/js/adminlte.js'])
  @yield('script')
</body>
</html>
