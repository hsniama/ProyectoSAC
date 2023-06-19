@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">

          {{-- <div class="col-sm-6">
            <h1 class="m-0">Reporte de cantidad de citas por Doctor</h1>
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

                        <div class="card-title fs-3 fw-bolder">Reporte de cantidad de citas por Doctor</div>

                        <div class="table-responsive">
                            <table id="tablaDataTable" class="table table-striped table-bordered zero-configuration text-center">
                                <thead class="thead">
                                    <tr>
                                        <th>ID</th>                    
										<th>Doctor</th>
										<th>Citas Atendidas</th>
										<th>Citas Pendientes</th>
										<th>Citas Canceladas</th>
                                        <th>Citas Totales</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($doctorwithAppointments as $key => $value)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $key }}</td>
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