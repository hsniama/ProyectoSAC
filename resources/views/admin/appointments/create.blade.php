@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1 class="m-0">Nueva Cita</h1>
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


                        @can('appointment-list')
                        <div class="mb-3">
                            <a href="{{ route('admin.appointments.index') }}" class="btn btn-danger btn-sm p-2"  data-placement="left">
                                <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                {{ __('Volver al listado') }}
                            </a>
                        </div>
                        @endcan


                        <form method="POST" action="{{ route('admin.appointments.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">

                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="patient_id" class="required">Paciente</label> 
                                        <select class="form-control select2 {{ $errors->has('patient_id') ? 'is-invalid' : '' }}" name="patient_id" id="patient_id">
                                            
                                            <option value="" disabled selected>Seleccione un paciente</option>
                                            @foreach ($patients as $patient)
                                                <option value="{{ $patient->id }}" @selected($patient->id == old('patient_id'))>
                                                    {{'Sr(a). '. $patient->nombres . ' ' . $patient->apellidos }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('patient_id'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('patient_id') }}
                                            </div>
                                        @endif
                                    </div>
                                
                                </div>






                                {{-- <div class="form-group">
                                    <label for="doctor" class="required">Doctor</label>
                                    <select class="form-control select2 {{ $errors->has('doctor_id') ? 'is-invalid' : '' }}" name="doctor_id" id="doctor">
                                        
                                        <option value="" disabled selected>Seleccione un doctor</option>
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}" @selected($doctor->id == old('doctor_id'))>
                                                {{'Dr(a). '. $doctor->nombres . ' ' . $doctor->apellidos }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('doctor_id'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('doctor_id') }}
                                        </div>
                                    @endif
                                </div> --}}

                                <div class="row">

                                    <div class="form-group col-6">
                                        <label for="speciality" class="required">Especialidad</label>
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

                                    <div class="form-group col-6">
                                        <label for="doctor" class="required">Doctor</label>
                                        <select class="form-control select2 {{ $errors->has('doctor_id') ? 'is-invalid' : '' }}" name="doctor_id" id="doctor">
                                            
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
                                        <input class="form-control dateCita input-button{{ $errors->has('scheduled_date') ? 'is-invalid' : '' }}" type="date" name="scheduled_date" id="scheduled_date" value="{{ old('scheduled_date') }}">
                                        @if($errors->has('scheduled_date'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('scheduled_date') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="scheduled_time" class="required">Hora</label>
                                        <input class="form-control horaCita {{ $errors->has('scheduled_time') ? 'is-invalid' : '' }}" type="text" name="scheduled_time" id="scheduled_time" value="{{ old('scheduled_time') }}">
                                        @if($errors->has('scheduled_time'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('scheduled_time') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>




                                {{-- <div class="form-group">
                                    <label for="type" class="required">Tipo</label>
                                    <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                                        
                                        <option value="" disabled selected>Seleccione un tipo</option>
                                        @foreach ($types as $key => $type)
                                            <option value="{{ $key }}" @selected($key == old('type'))>
                                                {{ $type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('type'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('type') }}
                                        </div>
                                    @endif
                                </div> --}}

                                <div class="form-group">
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
                                </div>



                            </div>
                                @can('appointment-create')
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                            Crear Cita
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
