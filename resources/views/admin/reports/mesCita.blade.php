@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">

          {{-- <div class="col-sm-12">
            <h1 class="m-0">Reporte de citas atendidas por Mes en cierto Año.</h1>
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
                 
                        <div class="card-title fs-3 fw-bolder">Reporte de citas atendidas por Mes en cierto Año.</div>

                        <div class="table-responsive">

                            <table id="tablaReporte" class="table table-striped table-bordered zero-configuration text-center">
                                                              
                                <thead class="thead">
                                    <tr>
                                        <th>ID</th>                    
										<th>Mes</th>
										<th>Año</th>
										<th>Citas Atendidas</th>
										<th>Citas Pendientes</th>
										<th>Citas Canceladas</th>
                                        <th>Citas Totales</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($monthwithAppointments as $key => $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $value['month'] }}</td>
                                            <td>{{ $value['year'] }}</td>
                                            <td> @if (array_key_exists('atendido', $value)) {{$value['atendido'] }}@else 0 @endif </td>
                                            <td> @if (array_key_exists('pendiente', $value)) {{$value['pendiente'] }}@else 0 @endif </td>
                                            <td> @if (array_key_exists('cancelado', $value)) {{$value['cancelado'] }}@else 0 @endif </td>
                                            <td> {{$value['total'] }} </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> 



                    </div> <!--card-body-->
                </div> <!--card-->
            </div> <!--col-lg-12-->
        </div> <!--row-->
      </div><!-- /.container-fluid -->
    </div><!-- /.content -->

@endsection