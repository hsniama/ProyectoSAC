@extends('layouts.admin')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">

          {{-- <div class="col-sm-6">
            <h1 class="m-0">Lista de Citas totales independientemente de su estado</h1>
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
                   
                        <div class="card-title fs-3 fw-bolder">Mis citas pendientes</div>
                        {{-- @can('appointment-create')
                            <div class="mb-3 float-end">
                                <a href="{{ route('admin.appointments.create') }}" class="btn btn-success p-2"  data-placement="left">
                                    {{ __('Agendar Nueva Cita') }}
                                </a>
                            </div>
                        @endcan --}}


                        <div class="table-responsive">
                            <table id="tablaNormalDataTableBuscador" class="table table-bordered table-hover text-center">
                                <thead class="thead">
                                    <tr>
										<th>Fecha</th>
                                        <th>Hora</th>                    
										<th>Especialidad</th>
										<th>Paciente</th>
										<th>Edad</th>
										<th>Motivo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendingAppointments as $cita)
                                        <tr>
											<td>{{ $cita->scheduled_date }}</td>
											<td>{{ $cita->getScheduledTimeAttribute($cita->scheduled_time) }}</td>
											<td><span class="badge badge-primary ">{{ App\Models\Speciality::find($cita->speciality_id)->name }}</span></td>
											<td>{{ $cita->patient->getFullNameAttribute() }}</td>
											<td>{{ $cita->patient->getAgeAttribute()}}</td>
											<td>{{ $cita->notes }}</td>
                                            <td>
                                                {{-- @can('appointment-show')
                                                <a href="{{ route('admin.appointments.show', $cita->id) }}"><button class="btn btn-info mb-2 btn-sm"><i class="fa fa-fw fa-eye"></i></button></a> </br>   
                                                @endcan --}}
                                                {{-- @can('appointment-edit')
                                                    <a href="{{ route('admin.appointments.edit', $cita->id) }}"><button class="btn btn-warning mb-2 btn-sm"><i class="fa fa-fw fa-edit"></i></button></a></br> 
                                                @endcan
                                                
                                                @can('appointment-delete')
                                                    <form action="{{ route('admin.appointments.destroy', $cita) }}" method="POST" style="display: inline" class="eliminarCita">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-fw fa-trash"></i></button>
                                                    </form>
                                                @endcan --}}

                                                @can('diagnostico-create')
                                                <a href="{{ route('doctor.diagnosis.create', $cita->id) }}" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="Iniciar Consulta" ><i class="fa-solid fa-circle-plus fa-xl opcion-citas-doctor" style="color: #47e04e;"></i></a>
                                                @endcan
                                                {{-- <a href="#" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="Reprogramar Cita"><i class="fa-regular fa-pen-to-square fa-xl opcion-citas-doctor" style="color: #848336;"></i></a>

                                                <a href="#" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="Ver Perfil del Paciente"><i class="fa-regular fa-eye fa-xl opcion-citas-doctor" style="color: #6487c4;"></i></a>

                                                <a href="#" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="Eliminar Cita"><i class="fa-regular fa-circle-xmark fa-xl opcion-citas-doctor" style="color: #d85450;"></i></a> --}}
                                                    
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

