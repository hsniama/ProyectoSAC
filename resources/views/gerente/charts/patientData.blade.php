@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">

          <div class="col-sm-12">
            <h1 class="m-0">Datos de los pacientes.</h1>
          </div>

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
                  
                        {{-- <div class="card-title fs-3 fw-bolder">Datos del Paciente</div> --}}

                        <div class="row">
                            <div class="col-6">
                              <div class="card">
                                <div class="card-body">
                                  {!! $chartAge->container() !!}
                                </div>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="card">
                                <div class="card-body">                           
                                  {!! $chartGender->container() !!}
                                </div>
                              </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                              <div class="card">
                                <div class="card-body">
                                  {!! $chartCities->container() !!}
                                </div>
                              </div>
                            </div>
                        </div>




                    </div> <!--card-body-->
                </div> <!--card-->
            </div> <!--col-lg-12-->
        </div> <!--row-->
      </div><!-- /.container-fluid -->
    </div><!-- /.content -->

@endsection

@section('scripts')

  <script src="{{ $chartAge->cdn() }}">
  </script>

      {{ $chartAge->script() }}
      {{ $chartGender->script() }}
      {{ $chartCities->script() }}

@endsection