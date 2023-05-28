@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row  mb-0">

                <div class="col-sm-5">
                    <h1 class="m-0">Agendamiento de Cita Médica</h1>
                </div><!-- /.col -->

                {{-- <div class="col-sm-7">
                    @if ($messages = Session::get('errorsSchedule'))
                        <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                                <use xlink:href="#exclamation-triangle-fill" />
                            </svg>
                            <div>
                                @foreach ($messages as $m)
                                    <p>{{ $m }}</p>
                                @endforeach
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                </div> --}}


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
                            

                            <form method="POST" action="{{ route('paciente.citas.store') }}" role="form" class="confirmarCita" enctype="multipart/form-data">
                                @csrf

                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#step1">1. Información
                                            del Paciente</a>
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
                                                                                    <span class="fw-bold">Nombres</span>  
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    {{-- <span class="fw-bolder">Cedula</span> <span class="ml-2">{{ Auth::user()->person->cedula }}</span> --}}
                                                                                    <span class="ml-2 mr-2">{{ Auth::user()->person->getFullNameAttribute() }} </span> 
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <i class="fa-solid fa-check" style="color: #22ec13;"></i>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p>
                                                                                    <span class="fw-bold">Cedula</span>  
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    {{-- <span class="fw-bolder">Cedula</span> <span class="ml-2">{{ Auth::user()->person->cedula }}</span> --}}
                                                                                    <span class="ml-2 mr-2">{{ Auth::user()->person->cedula }}</span>
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <i class="fa-solid fa-check" style="color: #22ec13;"></i>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p>
                                                                                    <span class="fw-bold">Edad</span>  
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    {{-- <span class="fw-bolder">Cedula</span> <span class="ml-2">{{ Auth::user()->person->cedula }}</span> --}}
                                                                                    <span class="ml-2 mr-2">{{ Auth::user()->person->getAgeAttribute() }}</span>
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <i class="fa-solid fa-check" style="color: #22ec13;"></i>
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
                                                                                        class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                                                                        placeholder="Actualiza tu numero de celular"
                                                                                        value="{{ old('telefono', Auth::user()->person->telefono) }}">
                                                                                    @if ($errors->has('telefono'))
                                                                                        <span class="text-danger">
                                                                                            <strong>{{ $errors->first('telefono') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <i class="fa-regular fa-eye" style="color: #5eafc9;"></i>
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
                                                                                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                                                        autofocus placeholder="Ingrese el Email del nuevo usuario"
                                                                                        value="{{ old('email', Auth::user()->email) }}">
                                                                                    @if ($errors->has('email'))
                                                                                        <span class="text-danger">
                                                                                            <strong>{{ $errors->first('email') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <i class="fa-regular fa-eye" style="color: #5eafc9;"></i>
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
                                                                    <div id="doctoresDisponibles" class="mt-3 row"></div>
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
                                                    <input hidden class="form-control  {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status" id="status" value="Pendiente">
                                                    <input hidden class="form-control" type="number" name="patient_id" id="patient_id" value="{{ Auth::user()->person->id }}">
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


                                                                    {{-- <select class="form-control w-100 select2 {{ $errors->has('notes') ? 'is-invalid' : '' }}" name="notes" id="notes">                                 
                                                                        <option value="" disabled selected>Seleccione el motivo de la cita</option>
                                                                        @foreach (App\Models\Appointment::MOTIVOS as $motivo)
                                                                            <option value="{{ $motivo}}" @selected($motivo == old('motivo'))>
                                                                                {{ $motivo }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select> --}}

                                                                    {{-- 
                                                                    <textarea class="form-control {{ $errors->has('notes') ? 'is-invalid' : '' }}" 
                                                                            name="notes" id="notes" style="height: 150px"  
                                                                            placeholder="Escribe un comentario">{{ old('notes') }}
                                                                    </textarea> 
                                                                    --}}
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

