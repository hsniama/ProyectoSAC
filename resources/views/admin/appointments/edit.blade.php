@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1 class="m-0">Reprogramar (editar) Cita</h1>
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

                        @can('appointment-list')
                        <div class="mb-3">
                            <a href="{{ route('admin.appointments.index') }}" class="btn btn-danger btn-sm p-2"  data-placement="left">
                                <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                {{ __('Volver al listado') }}
                            </a>
                        </div>
                        @endcan


                        <form method="POST" action="{{ route('admin.appointments.update', $appointment->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="box box-info padding-1">
                                <div class="box-body">


                                <div class="row">

                                    <input type="number" name="patient_id" id="patient_id" value="{{ $paciente->id }}" hidden>
                                    
                                    <div class="form-group col-6">
                                        <label for="nombres" class="required">Nombre del Paciente: </label>
                                        <input type="text" class="form-control" id="nombres" disabled
                                            value="{{$paciente->nombres . " " . $paciente->apellidos}}">
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="cedula" class="required">Cedula: </label>     
                                        <input type="text" class="form-control" id="cedula" disabled
                                            value="{{$paciente->cedula}}">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="speciality" class="required">Especialidad</label>
                                        <select class="form-control select2 {{ $errors->has('speciality_id') ? 'is-invalid' : '' }}" name="speciality_id" id="speciality">
                                            
                                            <option value="" disabled selected>Seleccione una especialidad</option>
                                            @foreach ($specialities as $specialty)
                                                <option value="{{ $specialty->id }}" {{ $doctorCita->specialities->pluck('id')->contains($specialty->id) ? 'selected' : '' }} >
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
                                 
                                    <div class="form-group col-6">
                                        <label for="doctor" class="required">Doctor</label>
                                        <select class="form-control select2 {{ $errors->has('doctor_id') ? 'is-invalid' : '' }}" name="doctor_id" id="doctor">
                                            <option value="" disabled >Seleccione un doctor</option>

                                            @foreach ($doctors as $doctor)
                                                <option value="{{ $doctor->id }}" {{ $doctor->id == $doctorCita->id ? 'selected' : '' }} >
                                                    {{ $doctor->nombres . " " . $doctor->apellidos }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('doctor_id'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('doctor_id') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="scheduled_date" class="required">Fecha</label>
                                        <input class="form-control editarCita input-button{{ $errors->has('scheduled_date') ? 'is-invalid' : '' }}" 
                                        type="date" name="scheduled_date" id="scheduled_date" 
                                        value="{{ old('scheduled_date', $appointment->scheduled_date) }}">

                                        @if($errors->has('scheduled_date'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('scheduled_date') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="scheduled_time" class="required">Hora</label>
                                        <input class="form-control horaCita input-button{{ $errors->has('scheduled_time') ? 'is-invalid' : '' }}" 
                                        type="time" name="scheduled_time" id="scheduled_time" 
                                        value="{{ old('scheduled_time', $appointment->scheduled_time) }}">

                                        @if($errors->has('scheduled_time'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('scheduled_time') }}
                                            </div>
                                        @endif
                                    </div>

                                </div>

                                <div class="form-group">
                                    <input hidden class="form-control  {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="{{ $appointment->status }}">
                                </div>

                                <div class="form-group">
                                    <label for="notes" class="required">Motivo/Observaciones: </label>
                                    <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes" rows="3">{{ old('notes', $appointment->notes) }}</textarea>
                                    @if($errors->has('notes'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('notes') }}
                                        </div>
                                    @endif
                                </div>


                               

                                {{--  
                                <div class="form-group">
                                    <label for="scheduled_date" class="required">Fecha</label>
                                    <input class="form-control dateCita input-button{{ $errors->has('scheduled_date') ? 'is-invalid' : '' }}" type="date" name="scheduled_date" id="scheduled_date" value="{{ old('scheduled_date') }}">
                                    @if($errors->has('scheduled_date'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('scheduled_date') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="scheduled_time" class="required">Hora</label>
                                    <input class="form-control horaCita {{ $errors->has('scheduled_time') ? 'is-invalid' : '' }}" type="text" name="scheduled_time" id="scheduled_time" value="{{ old('scheduled_time') }}">
                                    @if($errors->has('scheduled_time'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('scheduled_time') }}
                                        </div>
                                    @endif
                                </div> --}}



                                {{-- <div class="form-group">
                                    <input hidden class="form-control  {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="Pendiente">
                                </div>

                                <div class="form-group">
                                    <label for="notes" class="required">Motivo</label>
                                    <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes" rows="3">{{ old('notes') }}</textarea>
                                    @if($errors->has('notes'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('notes') }}
                                        </div>
                                    @endif
                                </div> --}}




                                @can('appointment-create')
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                            Actualizar Cita
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
    </div><!-- /.content -->


@endsection
