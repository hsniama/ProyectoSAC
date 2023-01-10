{{-- @extends('layouts.app') --}}
@extends('layouts.admin')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Estas logeado!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1 class="m-0">Bienvenido</h1>
          </div><!-- /.col -->

          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col --> --}}

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        @if ($message = Session::get('success'))               
                            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                <div>
                                    {{ $message }}
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- <div class="card-title">Bienvenido</div> --}}

                        <div class="block">
                          @if (!Auth::user()->persona)
                              <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                  
                                  <div class="d-flex flex-column align-items-center">

                                    <div class="mt-3">
                                      <p class="fs-3">
                                        <span class="text-bold">¡Hola {{ Auth::user()->username }}!</span>, primero debes completar tu información personal presionando el siguiente botón:
                                      </p>
                                    </div>


                                    <div class="mb-3 mt-3 d-flex justify-content-center">                      
                                      <a href="{{ route('perfil.create') }}" class="btn btn-warning btn-lg text-decoration-none text-black">
                                          Presiona aquí para completar tu perfil.
                                      </a>                                        
                                    </div>

                                    <div class="mt-3">
                                        <p class="fs-4">
                                          Este paso es obligatorio para poder usar el sistema.
                                        </p>
                                    </div>
                                  </div>

                                  {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                              </div>
                          @endif
                        </div>


                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


@endsection
