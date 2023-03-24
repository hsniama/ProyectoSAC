@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h4 class="m-0">Agendamiento de Cita Médica</h4>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">

            <div class="col-lg-12">

                <div class="row">
                    <div class="col-md-7">
                        <div class="card card-cyan"> 
                            <div class="card-header"> 
                                <h3 class="card-title">Datos del paciente</h3>
                            </div>

                            <div class="card-body">
                                    <div class="box box-info -padding-1">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="form-floating col-7">
                                                    <input class="form-control" type="text" disabled value="{{ Auth::user()->person->getFullNameAttribute() }}" readonly>
                                                    <label for="patient" class="required ml-2">Nombres</label>
                                                </div>
                                                <div class="form-floating col-3">
                                                    <input class="form-control" type="number" disabled value="{{ Auth::user()->person->cedula }}" readonly>
                                                    <label for="patient" class="required ml-2">Cedula</label>
                                                </div>
                                                <div class="form-floating col-2">
                                                    <input class="form-control" type="number" disabled value="{{ Auth::user()->person->getAgeAttribute() }}" readonly>
                                                    <label for="patient" class="required ml-2">Edad</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card card-cyan"> 
                            <div class="card-header"> 
                                <h3 class="card-title">Datos para confirmación de la cita</h3>
                            </div>

                            <div class="card-body">
                                    <div class="box box-info -padding-1">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="form-floating col-5">
                                                    <input class="form-control" type="string" disabled value="{{ Auth::user()->person->telefono }}" readonly>
                                                    <label for="patient" class="required ml-2">Celular</label>
                                                </div>
                                                <div class="form-floating col-7">
                                                    <input class="form-control" type="email" disabled value="{{ Auth::user()->email }}" readonly>
                                                    <label for="patient" class="required ml-2">Correo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        
                    </div>
                </div>




                <div class="card card-cyan">

                    <div class="card-header"> 
                        <h6 class="card-title">Datos de la cita </h6> 
                    </div>
                    <small class="ml-3 mt-1"> (Los datos marcados con * son obligatorios)</small>


                    <div class="card-body">

                        <form method="POST" action="{{ route('paciente.citas.store') }}" role="form" enctype="multipart/form-data" class="confirmarCita">
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">

                                <div class="row">

                                    <div class="col-6">

                                        <div class="row d-flex justify-content-center">
                                            <div class="col-7 form-group">
                                                <label for="speciality" class="required">Especialidad *</label>
                                                <select class="form-control select2 {{ $errors->has('speciality_id') ? 'is-invalid' : '' }}" name="speciality_id" id="speciality">
                                                        
                                                    <option value="" disabled selected>Seleccione una especialidad</option>
                                                    @foreach ($specialities as $specialty)
                                                        <option value="{{ $specialty->id }}" @selected($specialty->id == old('speciality_id'))>
                                                            {{ $specialty->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('speciality_id'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('speciality_id') }}
                                                    </div>
                                                @endif 
                                            </div>
                                      
                                        </div>

                                        <div class="row d-flex justify-content-center">
                                            <div class="col-7 form-group">
                                                <label for="doctor" class="required">Doctor *</label>
                                                <select class="form-control select2 {{ $errors->has('doctor_id') ? 'is-invalid' : '' }}" name="doctor_id" id="doctor">
                                                    
                                                </select>
                                                @if($errors->has('doctor_id'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('doctor_id') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="row d-flex justify-content-center">
                                            <div class="col-7 form-group">
                                                <label for="notes" class="required">Motivo</label>
                                                <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" 
                                                        name="notes" id="notes" style="height: 150px"  
                                                        placeholder="Escribe un comentario">{{ old('notes') }}</textarea>
                                                @if($errors->has('notes'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('notes') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <input hidden class="form-control  {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="Pendiente">
                                            <input hidden class="form-control" type="number" name="patient_id" id="patient_id" value="{{ Auth::user()->person->id }}">
                                        </div>

                                    </div>

                                    <div class="col-6">

                                        <div class="row">
                                            <div class="col-6 form-group fechaCita">
                                                <label for="scheduled_date" class="required">Fechas disponibles *</label>
                                                <input class="form-control dateCita bg-white {{ $errors->has('scheduled_date') ? 'is-invalid' : '' }}" type="date" 
                                                    name="scheduled_date" id="scheduled_date" value="{{ old('scheduled_date') }}" 
                                                    placeholder="Seleccione una fecha"
                                                >
                                                @if($errors->has('scheduled_date'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('scheduled_date') }}
                                                    </div>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="row form-group">
                                            <div class="col-12 horasDisponiblesDoctor">
                                                <label for="scheduled_time">Hora de atencion</label>
                                                <div class="row">
                                                    <div class="col">
                                                        <h4 class="m-3" id="titleMorning"></h4>
                                                        <div class="" id="hoursMorning"></div>
                                                    </div>
                                                    <div class="col">
                                                        <h4 class="m-3" id="titleAfternoon"></h4>
                                                        <div class="" id="hoursAfternoon"></div>
                                                    </div>
                                                </div>
                                                @if($errors->has('scheduled_time'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('scheduled_time') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>     

                                    </div>

                                </div>


                                <div class="" id="miSpinner"></div>





                            </div>
                                @can('appointment-create')
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                            Agendar Cita
                                        </button>
                                    </div>
                                </div>
                                @endcan



                            </div>
                        </form>


                    </div> <!--card-body-->
                </div> <!--card-->

            </div> <!--col-lg-12-->
        </div> <!--row-->

      </div><!-- /.container-fluid -->
    </section><!-- /.content -->


@endsection
