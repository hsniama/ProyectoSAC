@extends('layouts.admin')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">

          {{-- <div class="col-sm-6">
            <h1 class="m-0">Lista de Citas totales independientemente de su estado</h1>
          </div><!-- /.col --> --}}

        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">

                <div class="card">

                    <div class="card-body">

                        <div class="row">                 
                            <div class="card-title fs-3 fw-bolder col-7">Historial médico de paciente: <span class="text-blue-500">{{ $patient->getFullNameAttribute() }}</span> </div>                          
                            <div class="text-md-end text-center my-3 my-md-0 col-5">
                                <a type="button" class="btn btn-success p-2" data-bs-toggle="modal" data-bs-target="#previewModalInformacion">
                                    {{ __('Ver información del paciente') }}
                                </a>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table id="tablaNormalDataTableBuscador" class="table table-bordered table-hover text-center">
                                <thead class="thead">
                                    <tr>
										<th>Fecha</th>
                                        <th>Hora</th>                    
										<th>Especialidad</th>
										<th>Doctor</th>
										<th>Motivo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>                                
                                    @foreach ($appointments as $cita)
                                        <tr>
                                            <td>{{ $cita->scheduled_date }}</td>
                                            <td>{{ $cita->getScheduledTimeAttribute($cita->scheduled_time) }}</td>
                                            <td><span class="badge badge-primary ">{{ App\Models\Speciality::find($cita->speciality_id)->name }}</span></td>
                                            <td>{{ $cita->doctor->getFullNameAttribute() }}</td>
                                            <td>{{ $cita->notes }}</td>
                                            <td>
                                                <a href="{{ route('doctor.diagnosis.show', encrypt($cita->id)) }}" target="_blank" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="Ver Diagnostico"><i class="fa-regular fa-eye fa-xl" style="color: #6487c4;"></i></a>
                                                <a href="{{ route('doctor.diagnosis.printPrescription', encrypt($cita->id)) }}" target="_blank" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="Ver Receta medicada"><i class="fa-regular fa-newspaper fa-xl" style="color: #ca2121;"></i></a>                                                                        
                                            </td>
                                        </tr>
                                    @endforeach         
                                </tbody>
                            </table>
                        </div>


                        <!-- Modal -->
                        <div class="row">
                            <div class="modal fade" id="previewModalInformacion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="previewModalLabel">Datos personales del paciente</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <dl class="row">
                                                <dt class="col-sm-5">Cédula</dt>
                                                <dd class="col-sm-7">{{ $patient->cedula }}</dd>

                                                <dt class="col-sm-5">Nombres</dt>
                                                <dd class="col-sm-7">{{ $patient->getFullNameAttribute() }}</dd>

                                                <dt class="col-sm-5">Edad</dt>
                                                <dd class="col-sm-7">{{ $patient->getAgeAttribute() }}</dd>

                                                <dt class="col-sm-5">Teléfono</dt>
                                                <dd class="col-sm-7">{{ $patient->telefono }}</dd>

                                                <dt class="col-sm-5">Dirección</dt>
                                                <dd class="col-sm-7">{{ $patient->direccion }}</dd>

                                                <dt class="col-sm-5">Ciudad</dt>
                                                <dd class="col-sm-7">{{ $patient->ciudad }}</dd>

                                                <dt class="col-sm-5">Fecha de Nacimiento</dt>
                                                <dd class="col-sm-7">{{ $patient->fecha_nacimiento }}</dd>

                                                <dt class="col-sm-5">Género</dt>
                                                <dd class="col-sm-7">{{ $patient->genero }}</dd>
                                            </dl>
                                        </div>
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