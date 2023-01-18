@extends('layouts.admin')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1 class="m-0">Lista de Citas totales independientemente de su estado</h1>
          </div><!-- /.col -->

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
                   

                        @can('appointment-create')
                            <div class="mb-3">
                                <a href="{{ route('admin.appointments.create') }}" class="btn btn-success p-2"  data-placement="left">
                                    {{ __('Agendar Nueva Cita') }}
                                </a>
                            </div>
                        @endcan


                        <div class="table-responsive">
                            <table id="citas_table" class="table table-striped table-bordered zero-configuration text-center">
                                <thead class="thead">
                                    <tr>
                                        <th>ID</th>                    
										<th>C.I Paciente</th>
										<th>Doctor</th>
										<th>Especialidad</th>
										<th>Fecha de Cita</th>
										<th>Estado</th>
                                        <th>Motivo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $cita)
                                        <tr>
                                            <td>{{ $cita->id }}</td>
											<td>{{ $cita->patient->cedula }}</td>
											<td>{{'Dr(a). '. $cita->doctor->nombres . ' '. $cita->doctor->apellidos}}</td>
											<td><span class="badge badge-primary fs-6">{{ $cita->speciality->name }}</span></td>
											<td>{{ $cita->scheduled_date }} </br> {{ 'Hora: '. $cita->scheduled_time }}</td>
                                            <td>
                                                @if ($cita->status == 'Cancelado')
                                                    <span class="badge badge-danger fs-6">{{ $cita->status }}</span>
                                                @elseif ($cita->status == 'Atendido')
                                                    <span class="badge badge-success fs-6">{{ $cita->status }}</span>
                                                @else
                                                    <span class="badge badge-warning fs-6">{{ $cita->status }}</span>
                                                @endif
                                            </td>
											<td>{{ $cita->notes }}</td>
                                            <td>
                                                @can('appointment-show')
                                                <a href="{{ route('admin.appointments.show', $cita->id) }}"><button class="btn btn-info mb-2 btn-sm"><i class="fa fa-fw fa-eye"></i></button></a> </br>   
                                                @endcan
                                                @can('appointment-edit')
                                                <a href="{{ route('admin.appointments.edit', $cita->id) }}"><button class="btn btn-warning mb-2 btn-sm"><i class="fa fa-fw fa-edit"></i></button></a></br> 
                                                @endcan
                                                @can('appointment-delete')
                                                <form action="{{ route('admin.appointments.destroy', $cita) }}" method="POST" style="display: inline" class="eliminarCita">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                                @endcan
                                            </td>

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

