  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>SAC | App</title>

  <!-- Google Font: Source Sans Pro -->
  {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('css/plugins/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

  @vite(['resources/sass/app.scss', 'resources/js/app.js'])