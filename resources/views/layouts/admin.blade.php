<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>

  @include('layouts.partials.head')

</head>
<body class="hold-transition sidebar-mini layout-fixed" data-panel-auto-height-mode="height">


<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    {{-- <img class="animation__shake" src="{{ asset('assets/img/apple-touch-icon.png') }}" alt="OroMedLogo" height="60" width="60">
    <p class="text-lightblue fs-2">OroMed</p> --}}

    <div class="spinner-border text-info" style="width: 3rem; height: 3rem;" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>


  <!-- Navbar -->
  @include('layouts.partials.navbar')
  <!-- /.Navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.partials.sidebar')
  <!-- /.Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  {{-- <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside> --}}
  <!-- /.control-sidebar -->


  <!-- Main Footer -->
  @include('layouts.partials.footer');
  <!-- ./Main Footer -->



</div>
<!-- ./wrapper -->





@include('layouts.partials.scripts')



</body>
</html>
