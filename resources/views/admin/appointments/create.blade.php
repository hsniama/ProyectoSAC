@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row  mb-0">
                <div class="col-sm-5">
                    <h1 class="m-0">Agendamiento de Cita Médica</h1>
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

                    <div class="card">

                        <div class="card-body">
       
                            <div class="mb-3">
                                <small class="mt-1 fst-italic"> (Los datos marcados con * son obligatorios)</small>
                            </div>

                            <div>
                                <!--Si existen errores:-->
                                @if ($errors->any())
                                    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                                            <use xlink:href="#exclamation-triangle-fill" />
                                        </svg>
                                        <div>
                                            @foreach ($errors->all() as $error)
                                                <p>{{ $error }}</p>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif                 
                            </div>
                            

                            <form method="POST" action="{{ route('admin.appointments.store') }}" role="form" class="confirmarCita" enctype="multipart/form-data">
                                @csrf

                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#step1">1. Información del Paciente</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#step2">2. Datos de la cita</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#step3">3. Motivo o Razón</a>
                                    </li>
                                </ul>

                                <div class="box box-info padding-1">
                                    <div class="box-body">

                                        <div class="tab-content">
                                            <div id="step1" class="tab-pane active">


                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="row p-1 d-flex justify-content-center">
                                                            <div class="col-7 mt-3">
                                                                <table class="table table-borderless">
                                                                    <caption class="caption-top fw-bolder text-black mb-3 fs-5">Datos del Paciente: </caption>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <p>
                                                                                    <span class="fw-bold">Cedula *</span>  
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    <select class="form-control select2 {{ $errors->has('cedula') ? 'is-invalid' : '' }}" name="cedula" id="cedula">                                 
                                                                                        <option value="" disabled selected>Escribe la cédula del paciente</option>
                                                                                        @foreach ($patients as $patient)
                                                                                            <option value="{{ $patient->person->cedula }}" {{ $patient->person->cedula == old('cedula') ? 'selected' : '' }}>
                                                                                                {{ $patient->person->cedula}}
                                                                                            </option>
                                                                                            <p hidden disabled>{{ $idPaciente = $patient->id }}</p> 
                                                                                        @endforeach                             
                                                                                    </select>                                                                                       
                                                                                    @if ($errors->has('cedula'))
                                                                                        <span class="text-danger">
                                                                                            <strong>{{ $errors->first('cedula') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </p>
                                                                            </td>
                                                                            <td class="vistoBueno">
                                                                                <input hidden class="form-control" type="number" name="patient_id" id="patient_id" value="{{ $idPaciente }}">
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p>
                                                                                    <label for="nombres" class="required">Nombres</label>  
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    <input type="text" name="nombres" id="nombres"
                                                                                        class="form-control bg-white border-0 {{ $errors->has('nombres') ? 'is-invalid' : '' }}"
                                                                                        disabled
                                                                                        value="{{ old('nombres', Auth::user()->nombres) }}">
                                                                                    @if ($errors->has('nombres'))
                                                                                        <span class="text-danger">
                                                                                            <strong>{{ $errors->first('nombres') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </p>
                                                                            </td>
                                                                            <td class="vistoBueno">
                                                                                
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p>
                                                                                    <label for="edad" class="required">Edad</label>  
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    <input type="number" name="edad" id="edad"
                                                                                        class="form-control bg-white border-0 {{ $errors->has('edad') ? 'is-invalid' : '' }}"
                                                                                        disabled
                                                                                        value="{{ old('edad', Auth::user()->edad) }}">
                                                                                    @if ($errors->has('edad'))
                                                                                        <span class="text-danger">
                                                                                            <strong>{{ $errors->first('edad') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </p>
                                                                            </td>
                                                                            <td class="vistoBueno">
                                                                                {{-- <i class="fa-solid fa-check" style="color: #22ec13;"></i> --}}
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="row d-flex justify-content-center">
                                                            <div class="col-8 mt-3">

                                                                <table class="table table-borderless">
                                                                    <caption class="caption-top fw-bolder text-black mb-3 fs-5">Datos para confirmar cita: </caption>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <p>
                                                                                    <label for="telefono">Celular *</label> 
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    <input type="number" name="telefono" id="telefono"
                                                                                        class="form-control bg-white border-0 {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                                                                        disabled
                                                                                        value="{{ old('telefono') }}">
                                                                                    @if ($errors->has('telefono'))
                                                                                        <span class="text-danger">
                                                                                            <strong>{{ $errors->first('telefono') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </p>
                                                                            </td>
                                                                            <td class="editarCampo">
                                                                                
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p>
                                                                                    <label for="email" class="required">Correo *</label> 
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    <input type="email" name="email" id="email"
                                                                                        class="form-control bg-white border-0 {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                                                        disabled
                                                                                        value="{{ old('email') }}">
                                                                                    @if ($errors->has('email'))
                                                                                        <span class="text-danger">
                                                                                            <strong>{{ $errors->first('email') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </p>
                                                                            </td>
                                                                            <td class="editarCampo">
                                                                                
                                                                            </td>
                                                                        </tr>

                                                                    </tbody>
                                                                </table>

                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="row d-flex text-right">
                                                    <div class="col">
                                                        <button type="button" class="btn btn-primary next-step"
                                                            onclick="nextTab(event, 'step2')">
                                                            Siguiente
                                                        </button>
                                                    </div>
                                                </div>


                                            </div>

                                            <div id="step2" class="tab-pane">

                                                <div class="row">
                                                    <div class="col-6 d-flex justify-content-center">
                                                        <div class="col-7 mt-4">
                                                            <div class="card border-light">
                                                                
                                                                <img src="{{ asset('assets/img/calendar-with-medical-sign-doctor-appointment-icon-vector.jpg') }}" class="card-img-top" alt="">                          
                                                                
                                                                <div class="card-body">
                                                                    <div class="card-text">
                                                                        Agende una cita seleccionando la especialidad, medico, fecha y hora de atención.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="col-6">
                                                        <div class="row mt-4">  
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="speciality" class="required">Especialidad *</label>
                                                                    <select class="form-control w-100 select2 {{ $errors->has('speciality_id') ? 'is-invalid' : '' }}" name="speciality_id" id="speciality">
                                                                            
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
                                                        </div>

                                                        <div class="row">   
                                                            <div class="col">
                                                                <div class="form-group doctorBox">
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
                                                     
                                                        </div>

                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group fechaCita">
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
                                                        </div>

                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group horasDisponiblesDoctor">
                                                                    <label for="scheduled_time">Hora de atención *</label>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <h4 class="m-3" id="titleHours"></h4>
                                                                            <div class="" data-toggle="buttons" id="hoursAvailable"></div>
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
                                                </div>

                                                <div class="row form-group">
                                                    <input hidden class="form-control" type="text" name="status" id="status" value="Pendiente">
                                                    
                                                </div>
                                                

                                                <div class="row d-flex">
                                                    <div class="col">
                                                        <button type="button" class="btn btn-secondary"
                                                            onclick="prevTab(event, 'step1')">
                                                            Anterior
                                                        </button>
                                                    </div>
                                                    <div class="col text-right">
                                                        <button type="button" class="btn btn-primary next-step"
                                                            onclick="nextTab(event, 'step3')">
                                                            Siguiente
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>


                                            <div id="step3" class="tab-pane">

                                                <div class="row">
                                                    <div class="col-6 d-flex justify-content-center">
                                                        <div class="col-7 mt-4">
                                                            <div class="card text-center border-light">
                                                                
                                                                <img src="{{ asset('assets/img/signos-interrogacion.png') }}" class="card-img-top" alt="">                          
                                                                
                                                                <div class="card-body">
                                                                    <div class="card-text">
                                                                        Escoja el motivo de su consulta.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="col-6">
                                                        <div class="row mt-3">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <label for="notes" class="required">Motivo</label>

                                                                    
                                                                    <div class="form-check">
                                                                        <input
                                                                            class="form-check-input {{ $errors->has('notes') ? 'is-invalid' : '' }}"
                                                                            type="radio" name="notes" id="consulta"
                                                                            value="Consulta/Cita Médica" checked
                                                                        >                                                                 
                                                                        <label class="form-check-label" for="consulta">Consulta/Cita Médica</label>                                                           
                                                                    </div>
                                                                    
                                                                    <div class="form-check">                                  
                                                                        <input
                                                                            class="form-check-input {{ $errors->has('notes') ? 'is-invalid' : '' }}"
                                                                            type="radio" name="notes"  id="examen"
                                                                            value="Revisión de Exámenes" 
                                                                        >                                                                 
                                                                        <label class="form-check-label" for="examen">Revisión de Exámenes</label>
                                                                    </div>
                                                                    
                                                                    <div class="form-check">                                  
                                                                        <input
                                                                            class="form-check-input {{ $errors->has('notes') ? 'is-invalid' : '' }}"
                                                                            type="radio" name="notes"  id="otro"
                                                                            value="Otro" 
                                                                        >                                                                 
                                                                        <label class="form-check-label" for="otro">Otro</label>
                                                                    </div>


                                                                    @if($errors->has('notes'))
                                                                        <div class="invalid-feedback">
                                                                            {{ $errors->first('notes') }}
                                                                        </div>
                                                                    @endif
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                @can('appointment-create')
                                                    <div class="row d-flex">
                                                        <div class="col">
                                                            <button type="button" class="btn btn-secondary"
                                                                onclick="prevTab(event, 'step2')">
                                                                Anterior
                                                            </button>
                                                        </div>
                                                        <div class="col text-right">
                                                            <button type="submit" class="btn btn-success">
                                                                <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                                                Agendar Cita
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endcan

                                            </div>

                                            <div class="" id="miSpinner"></div>
                                        </div>

                                    </div> <!--box-body-->
                                </div> <!--box-->
                                        <!--tab-content-->
                            </form>


                        </div><!--card-body-->
                    </div><!--card-->
                </div><!--col-lg-12-->
            </div><!--row-->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
@endsection

