<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SAC | 
    @isset($title)
        {{ $title }}
    @endisset
 </title>

  @include('layouts.partials.head')

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">

    <div class="card-header text-center">
      <a href="{{ url('/') }}" class="h2 text-decoration-none"><b>Sistema de Atención </br> Médica y Control</a>
    </div>

    <div class="card-body">

        @yield('content')

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

@include('layouts.partials.scripts')

</body>
</html>
