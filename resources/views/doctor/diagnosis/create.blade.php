@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row  mb-0">

                <div class="col-sm-5">
                    <h1 class="m-0">Detalle de consulta médica</h1>
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
                            

                            <form method="POST" action="{{ route('doctor.diagnostico.store') }}" role="form" class="confirmarCita" enctype="multipart/form-data">
                                @csrf

                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#step1">1. Información del Paciente</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#step2">2. Signos Vitales</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#step3">3. Diagnóstico</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#step4">4. Examenes</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#step5">5. Receta</a>
                                    </li>
                                </ul>

                                <div class="box box-info padding-1">
                                    <div class="box-body">

                                        <div class="tab-content">

                                            <div id="step1" class="tab-pane active">

                                                <div class="row">

                                                    <div class="col-md-8">
                                                        <div class="row p-3 d-flex justify-content-center">
                                                            {{-- <div class="col-7 mt-3"> --}}
                                                                <table class="table table-borderless">
                                                                    {{-- <caption class="caption-top fw-bolder text-black mb-3 fs-5">Datos del Paciente: </caption> --}}
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
                                                                                    <span class="ml-2 mr-2">{{ $appointment->patient->getFullNameAttribute() }} </span> 
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
                                                                                    <span class="ml-2 mr-2">{{ $appointment->patient->cedula }}</span>
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <i class="fa-solid fa-check" style="color: #22ec13;"></i>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p>
                                                                                    <span class="fw-bold">Ciudad de Residencia</span>  
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    {{-- <span class="fw-bolder">Cedula</span> <span class="ml-2">{{ Auth::user()->person->cedula }}</span> --}}
                                                                                    <span class="ml-2 mr-2">{{ $appointment->patient->ciudad }}</span>
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <i class="fa-solid fa-check" style="color: #22ec13;"></i>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p>
                                                                                    <span class="fw-bold">Dirección</span>  
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    {{-- <span class="fw-bolder">Cedula</span> <span class="ml-2">{{ Auth::user()->person->cedula }}</span> --}}
                                                                                    <span class="ml-2 mr-2">{{ $appointment->patient->direccion }}</span>
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <i class="fa-solid fa-check" style="color: #22ec13;"></i>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            {{-- </div> --}}
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

                                                    <div class="col-md-6">
                                                        <div class="row p-3 d-flex justify-content-center">
                                                            {{-- <div class="col-7 mt-3"> --}}
                                                                <table class="table table-borderless">
                                                                    {{-- <caption class="caption-top fw-bolder text-black mb-3 fs-5">Signos Vitales: </caption> --}}
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <p>
                                                                                    <span class="fw-bold">Edad</span>  
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    {{-- <span class="fw-bolder">Cedula</span> <span class="ml-2">{{ Auth::user()->person->cedula }}</span> --}}
                                                                                    <span class="ml-2 mr-2">{{ $appointment->patient->getAgeAttribute() }}</span>
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <i class="fa-solid fa-check" style="color: #22ec13;"></i>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p>
                                                                                    <label for="temperatura">Altura (cm) *</label> 
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    <input type="number" name="height" id="height"
                                                                                        class="form-control {{ $errors->has('height') ? 'is-invalid' : '' }}"
                                                                                        placeholder="Llena la estatura del paciente."
                                                                                        value="{{ old('height', optional($appointment->vitalSign)->height) }}">
                                                                                    @if ($errors->has('height'))
                                                                                        <span class="text-danger">
                                                                                            <strong>{{ $errors->first('height') }}</strong>
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
                                                                                    <label for="temperatura">Weight (kg) *</label> 
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    <input type="number" name="weight" id="weight"
                                                                                        class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}"
                                                                                        placeholder="Llena el peso del paciente."
                                                                                        value="{{ old('weight', optional($appointment->vitalSign)->weight) }}">
                                                                                    @if ($errors->has('weight'))
                                                                                        <span class="text-danger">
                                                                                            <strong>{{ $errors->first('weight') }}</strong>
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
                                                                                    <label for="imc">Índice de masa corporal (kg) *</label> 
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>                     
                                                                                    <span class="ml-2 mr-2" id="imc"></span>
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <i class="fa-solid fa-check" id="vistoVerde" style="color: #22ec13;"></i>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            {{-- </div> --}}
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="row p-3 d-flex justify-content-center">
                                                            {{-- <div class="col-8 mt-3"> --}}

                                                                <table class="table table-borderless">
                                                                    {{-- <caption class="caption-top fw-bolder text-black mb-3 fs-5">Datos para confirmar cita: </caption> --}}
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <p>
                                                                                    <label for="temperatura">Temperatura (°C) *</label> 
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    <input type="number" name="temperature" id="temperature"
                                                                                        class="form-control {{ $errors->has('temperature') ? 'is-invalid' : '' }}"
                                                                                        placeholder="Llena la temperatura del paciente."
                                                                                        value="{{ old('temperature', optional($appointment->vitalSign)->temperature) }}">
                                                                                    @if ($errors->has('temperature'))
                                                                                        <span class="text-danger">
                                                                                            <strong>{{ $errors->first('temperature') }}</strong>
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
                                                                                    <label for="email" class="required">Presión arterial *</label> 
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    <input type="number" name="blood_pressure" id="blood_pressure"
                                                                                        class="form-control {{ $errors->has('blood_pressure') ? 'is-invalid' : '' }}"
                                                                                        autofocus placeholder="Llena la presión arterial del paciente."
                                                                                        value="{{ old('blood_pressure', optional($appointment->vitalSign)->blood_pressure) }}">
                                                                                    @if ($errors->has('blood_pressure'))
                                                                                        <span class="text-danger">
                                                                                            <strong>{{ $errors->first('blood_pressure') }}</strong>
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
                                                                                    <label for="email" class="required">Frecuencia cardiaca *</label> 
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    <input type="number" name="heart_rate" id="heart_rate"
                                                                                        class="form-control {{ $errors->has('heart_rate') ? 'is-invalid' : '' }}"
                                                                                        autofocus placeholder="Llena la frecuencia cardiaca del paciente."
                                                                                        value="{{ old('heart_rate', optional($appointment->vitalSign)->heart_rate) }}">
                                                                                    @if ($errors->has('heart_rate'))
                                                                                        <span class="text-danger">
                                                                                            <strong>{{ $errors->first('heart_rate') }}</strong>
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
                                                                                    <label for="email" class="required">Frecuencia respiratoria *</label> 
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    <input type="number" name="respiratory_rate" id="respiratory_rate"
                                                                                        class="form-control {{ $errors->has('respiratory_rate') ? 'is-invalid' : '' }}"
                                                                                        autofocus placeholder="Llena la frecuencia respiratoria del paciente."
                                                                                        value="{{ old('respiratory_rate', optional($appointment->vitalSign)->respiratory_rate) }}">
                                                                                    @if ($errors->has('respiratory_rate'))
                                                                                        <span class="text-danger">
                                                                                            <strong>{{ $errors->first('respiratory_rate') }}</strong>
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

                                                            {{-- </div> --}}
                                                        </div>

                                                    </div>

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


                                                <div class="row p-1 d-flex justify-content-center">

                                                    <div class="row"> <!--Completar Informacion-->
                                                        <div class="col-md-12 mt-3">

                                                            <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#primera" aria-expanded="false" aria-controls="primera">
                                                                1. Completa la Información
                                                            </button>

                                                            <div class="collapse" id="primera"><!--collapse-->                                          
                                                               <div class="card card-body mt-2"><!--card card-body mt-2--> 
                                                                    
                                                                    <div class="col">
                                                                        
                                                                        <div class="form-floating">
                                                                            <input type="text" class="form-control {{ $errors->has('allergies') ? 'is-invalid' : '' }}" name="allergies" id="allergies" 
                                                                                placeholder="Enumera las alergias del paciente." value="{{ old('allergies') }}">
                                                                            <label for="allergies">Alergias:</label>
                                                                            @if ($errors->has('allergies'))
                                                                                <span class="text-danger">
                                                                                    <strong>{{ $errors->first('allergies') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                        
                                                                        <div class="row g-2 mt-2">
                                                                            <div class="col">
                                                                                <div class="form-floating">
                                                                                    <select class="form-select {{ $errors->has('alcohol_use') ? 'is-invalid' : '' }}" id="alcohol_use" name="alcohol_use" aria-label="¿Consume Alcohol?">
                                                                                        <option selected disabled>Seleccione:</option>
                                                                                        <option value="Si" {{ old('alcohol_use') ==  'Si' ? 'selected' : '' }}>Si</option>
                                                                                        <option value="No" {{ old('alcohol_use') == 'No' ? 'selected' : '' }}>No</option>
                                                                                    </select>
                                                                                    <label for="alcohol_use">¿Consume Alcohol?</label>
                                                                                        @if ($errors->has('alcohol_use'))
                                                                                        <span class="text-danger">
                                                                                            <strong>{{ $errors->first('alcohol_use') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="col">
                                                                                <div class="form-floating">
                                                                                    <select class="form-select {{ $errors->has('drug_use') ? 'is-invalid' : '' }}" id="drug_use" name="drug_use" aria-label="¿Consume Drogas?">
                                                                                        <option selected disabled>Seleccione:</option>
                                                                                        <option value="Si" {{ old('drug_use') ==  'Si' ? 'selected' : '' }}>Si</option>
                                                                                        <option value="No" {{ old('drug_use') == 'No' ? 'selected' : '' }}>No</option>
                                                                                    </select>
                                                                                    <label for="drug_use">¿Consume Drogas?</label>
                                                                                        @if ($errors->has('drug_use'))
                                                                                        <span class="text-danger">
                                                                                            <strong>{{ $errors->first('drug_use') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="col">
                                                                                <div class="form-floating">
                                                                                    <select class="form-select {{ $errors->has('smoking_use') ? 'is-invalid' : '' }}" id="smoking_use" name="smoking_use" aria-label="¿Consume Tabaco?">
                                                                                        <option selected disabled>Seleccione:</option>
                                                                                        <option value="Si" {{ old('smoking_use') ==  'Si' ? 'selected' : '' }}>Si</option>
                                                                                        <option value="No" {{ old('smoking_use') == 'No' ? 'selected' : '' }}>No</option>
                                                                                    </select>
                                                                                    <label for="smoking_use">¿Consume Tabaco?</label>
                                                                                        @if ($errors->has('smoking_use'))
                                                                                        <span class="text-danger">
                                                                                            <strong>{{ $errors->first('smoking_use') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-floating mt-3">
                                                                            <input type="text" class="form-control {{ $errors->has('family_background') ? 'is-invalid' : '' }}" name="family_background" id="family_background" 
                                                                                placeholder="Enumera las alergias del paciente." value="{{ old('family_background') }}">
                                                                            <label for="family_background">Antecedentes familiares <small>(enfermedades heriditarias)</small>:</label>
                                                                            @if ($errors->has('family_background'))
                                                                                <span class="text-danger">
                                                                                    <strong>{{ $errors->first('family_background') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                        
                                                                        <div class="form-floating mt-3">
                                                                            <input type="text" class="form-control {{ $errors->has('surgical_history') ? 'is-invalid' : '' }}" name="surgical_history" id="surgical_history" 
                                                                                placeholder="Enumera las alergias del paciente." value="{{ old('surgical_history') }}">
                                                                            <label for="surgical_history">¿Se ha operado antes? <small>(Detalla las operaciones que ha tenido)</small>:</label>
                                                                            @if ($errors->has('surgical_history'))
                                                                                <span class="text-danger">
                                                                                    <strong>{{ $errors->first('surgical_history') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>

                                                                        <div class="form-floating mt-3">
                                                                            <input type="text" class="form-control {{ $errors->has('surgical_history') ? 'is-invalid' : '' }}" name="surgical_history" id="surgical_history" 
                                                                                placeholder="Enumera las alergias del paciente." value="{{ old('surgical_history') }}">
                                                                            <label for="surgical_history">¿Está con medicación? <small>(Detalla los medicamentos que consume)</small>:</label>
                                                                            @if ($errors->has('surgical_history'))
                                                                                <span class="text-danger">
                                                                                    <strong>{{ $errors->first('surgical_history') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>

                                                                        <div class="current_diseases_container mt-3">
                                                                            
                                                                            <div class="card card-body current_disease_1">
                                                                                <div class="row g-2">
                                                                                    <div class="col-6">
                                                                                        <div class="form-floating">
                                                                                            <select class="form-control" name="currentdiseases[1][id]" id="currentdisease1_id">
                                                                                                <option value="" disabled selected>Seleccione una enfermedad</option>
                                                                                                @foreach ($diseases as $disease)
                                                                                                    <option value="{{ $disease->id }}">{{ $disease->name }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            <label for="currentdisease1_id">Enfermedad actual 1: </label>
                                                                                        </div>

                                                                                    </div>

                                                                                    <div class="col-6">
                                                                                        <div class="form-floating">
                                                                                            <select class="form-select {{ $errors->has('currentdisease1_duration') ? 'is-invalid' : '' }}" id="currentdisease1_duration" name="currentdiseases[1][duration]" aria-label="¿?">
                                                                                                <option selected disabled>Seleccione:</option>
                                                                                                <option value="year<1" {{ old('currentdisease1_duration') ==  'year<1' ? 'selected' : '' }}>Menos de 1 Año</option>
                                                                                                <option value="1<year<5" {{ old('currentdisease1_duration') == '1<year<5' ? 'selected' : '' }}>De 1 a 5 Años</option>
                                                                                                <option value="year>5" {{ old('currentdisease1_duration') == 'year>5' ? 'selected' : '' }}>Más de 5 Años</option>
                                                                                                <option value="nacimiento" {{ old('currentdisease1_duration') == 'nacimiento' ? 'selected' : '' }}>Origen Congénito</option>
                                                                                            </select>
                                                                                            <label for="currentdisease1_duration">¿Tiempo con la enfermedad?</label>
                                                                                            @if ($errors->has('currentdisease1_duration'))
                                                                                                <span class="text-danger">
                                                                                                    <strong>{{ $errors->first('currentdisease1_duration') }}</strong>
                                                                                                </span>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="form-floating mt-3">
                                                                                    <textarea class="form-control" placeholder="Agrega las notas adicionales" name="currentdiseases[1][notes]" id="currentdisease1_notes" style="height: 100px"></textarea>
                                                                                    <label for="currentdisease1_notes">Notas adicionales <small>(Si no existe la enfermedad en el listado, escribala aqui)</small> : </label>
                                                                                    <input type="text" hidden name="currentdiseases[1][status]" id="currentdisease1_status" value="Enfermedad Actual">
                                                                                </div>
                                                                                
                                                                            </div>

                                                                            <!--Nueva enfermedad actual-->
                      
                                                                            <a href="#" class="text-decoration-none p-2" id="add_current_disease"><i class="fa-solid fa-circle-plus fa-xl opcion-citas-doctor" style="color: #3991d8;"></i> Agregar otra enfermedad actual del paciente.</a>
                                                                        </div>

                                                                        <div class="form-floating mt-3">
                                                                            <textarea class="form-control" placeholder="Leave a comment here" name="reason_for_consultation" id="reason_for_consultation" style="height: 100px"></textarea>
                                                                            <label for="reason_for_consultation">Razón o motivo de la consulta</label>
                                                                        </div>
                                             
                                                                    </div>
                                                                    
                                                                </div><!--card card-body mt-2-->  
                                                            </div><!--collapse-->

                                                        </div><!--col-md-12 mt-3-->
                                                    </div><!--Completar Informacion-->

                                                    <div class="row">             
                                                        <div class="col-md-6 mt-3">
                                                            <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#segunda" aria-expanded="false" aria-controls="segunda">
                                                                2. Sintomas
                                                            </button> 
                                                            <div class="collapse" id="segunda">
                                                               <div class="card card-body mt-2">
                                                                    <div class="col">

                                                                        <div class="sintomas-container mt-3">
                                                                            
                                                                            <div class="card card-body symptom1">
                                                                                <div class="row g-2">
                                                                                    <div class="col-6">
                                                                                        <div class="form-floating">
                                                                                            <select class="form-control" name="symptoms[1][id]" id="symptom1">
                                                                                                <option value="" disabled selected>Seleccione una síntoma: </option>
                                                                                                @foreach ($symptoms as $symptom)
                                                                                                    <option value="{{ $symptom->id }}">{{ $symptom->name }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            <label for="disease1">Síntoma actual 1: </label>
                                                                                        </div>

                                                                                    </div>

                                                                                    <div class="col-6">
                                                                                        <div class="form-floating">
                                                                                            <select class="form-select {{ $errors->has('symptom1_duration') ? 'is-invalid' : '' }}" id="symptom1_duration" name="symptoms[1][duration]" aria-label="¿symptom?">
                                                                                                <option selected disabled>Seleccione:</option>
                                                                                                <option value="week<1" {{ old('symptom1_duration') ==  'week<1' ? 'selected' : '' }}>Menos de 1 semana</option>
                                                                                                <option value="month<1" {{ old('symptom1_duration') == 'month<1' ? 'selected' : '' }}>Menos de 1 mes</option>
                                                                                                <option value="month>5" {{ old('symptom1_duration') == 'month>5' ? 'selected' : '' }}>Más de 1 mes</option>
                                                                                                <option value="always" {{ old('symptom1_duration') == 'always' ? 'selected' : '' }}>Siempre</option>
                                                                                            </select>
                                                                                            <label for="symptom1_duration">¿Tiempo con el síntoma?</label>
                                                                                            @if ($errors->has('symptom1_duration'))
                                                                                                <span class="text-danger">
                                                                                                    <strong>{{ $errors->first('symptom1_duration') }}</strong>
                                                                                                </span>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="form-floating mt-3">
                                                                                    <textarea class="form-control" placeholder="Agrega las notas adicionales" name="symptoms[1][notes]" id="symptom1_notes" style="height: 100px"></textarea>
                                                                                    <label for="symptom1_notes">Notas adicionales <small>(Si no existe el síntoma en el listado, escribalo aqui)</small> : </label>
                                                                                </div>
                                                                                
                                                                            </div>

                                                                            <!--Nuevo síntoma actual-->
                      
                                                                            <a href="#" class="text-decoration-none p-2" id="agregar-sintoma"><i class="fa-solid fa-circle-plus fa-xl" style="color: #3991d8;"></i> Agregar otro síntoma actual del paciente.</a>
                                                                        </div>

                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6 mt-3">
                                                            <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#tercera" aria-expanded="false" aria-controls="tercera">
                                                                3. Posibles Enfermedades
                                                            </button>  
                                                            <div class="collapse" id="tercera">
                                                               <div class="card card-body mt-2">
                                                                    <div class="col">
                                                                        <div class="possible_diseases_container mt-3">
                                                                            
                                                                            <div class="card card-body possible_disease_1">
                                                                                <div class="row g-2">
                                                                                    <div class="col-6">
                                                                                        <div class="form-floating">
                                                                                            <select class="form-control" name="possiblediseases[1][id]" id="possibledisease1_id">
                                                                                                <option value="" disabled selected>Seleccione una enfermedad</option>
                                                                                                @foreach ($diseases as $disease)
                                                                                                    <option value="{{ $disease->id }}">{{ $disease->name }}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                            <label for="possibledisease1_id">Enfermedad posible 1: </label>
                                                                                        </div>

                                                                                    </div>

                                                                                    <div class="col-6">
                                                                                        <div class="form-floating">
                                                                                            <select class="form-select {{ $errors->has('possibledisease1_status') ? 'is-invalid' : '' }}" id="possibledisease1_status" name="possiblediseases[1][status]" aria-label="¿?">
                                                                                                <option selected disabled>Seleccione:</option>
                                                                                                <option value="Posible" {{ old('possibledisease1_status') ==  'Posible' ? 'selected' : '' }}>Posible</option>
                                                                                                <option value="Confirmada" {{ old('possibledisease1_status') == 'Confirmada' ? 'selected' : '' }}>Confirmada</option>
                                                                                            </select>
                                                                                            <label for="possibledisease1_status">¿Probabilidad?</label>
                                                                                            @if ($errors->has('possibledisease1_status'))
                                                                                                <span class="text-danger">
                                                                                                    <strong>{{ $errors->first('possibledisease1_status') }}</strong>
                                                                                                </span>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="form-floating mt-3">
                                                                                    <textarea class="form-control" placeholder="Agrega las notas adicionales" name="possiblediseases[1][notes]" id="possibledisease1_notes" style="height: 100px"></textarea>
                                                                                    <label for="possibledisease1_notes">Notas adicionales <small>(Si no existe la enfermedad en el listado, escribala aqui)</small> : </label>
                                                                                </div>
                                                                                
                                                                            </div>

                                                                            <!--Nueva enfermedad actual-->
                      
                                                                            <a href="#" class="text-decoration-none p-2" id="add_possible_disease"><i class="fa-solid fa-circle-plus fa-xl opcion-citas-doctor" style="color: #3991d8;"></i> Agregar otra enfermedad posible del paciente.</a>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12 mt-3">
                                                            <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#cuarta" aria-expanded="false" aria-controls="cuarta">
                                                                3. Conclusiones generales
                                                            </button>
                                                            <div class="collapse" id="cuarta">                                          
                                                               <div class="card card-body mt-2">
                                                                    <div class="col">
                                                                        <div class="form-floating mt-3">
                                                                            <textarea class="form-control" placeholder="Leave a comment here" name="conclusions" id="conclusions" style="height: 100px"></textarea>
                                                                            <label for="conclusions">Conclusiones finales del diagnóstico: </label>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>


                                                <div class="row d-flex">
                                                    <div class="col">
                                                        <button type="button" class="btn btn-secondary"
                                                            onclick="prevTab(event, 'step2')">
                                                            Anterior
                                                        </button>
                                                    </div>
                                                    <div class="col text-right">
                                                        <button type="button" class="btn btn-primary next-step"
                                                            onclick="nextTab(event, 'step4')">
                                                            Siguiente
                                                        </button>
                                                    </div>
                                                </div>


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

@section('scripts')
    <script>

        document.getElementById("vistoVerde").style.display = "none";

        const alturaInput = document.getElementById('height');
        const masaInput = document.getElementById('weight');
        const indiceCorporalSpan = document.getElementById('imc');

        alturaInput.addEventListener('input', calcularIndiceCorporal);
        masaInput.addEventListener('input', calcularIndiceCorporal);

        function calcularIndiceCorporal() {
            const altura = alturaInput.value;
            const masa = masaInput.value;

            // Realizar el cálculo del índice corporal
            const indiceCorporal = masa / ((altura/100) ** 2);

            // Actualizar el campo del índice corporal en la vista
            indiceCorporalSpan.textContent = `${indiceCorporal.toFixed(2)}`;

            // si altura o masa estan vacios, no se muestra el visto verde
            if (altura == "" || masa == "") {
                document.getElementById("vistoVerde").style.display = "none";
            }else{
                if (indiceCorporal < 18.5) {
                    indiceCorporalSpan.classList.remove('text-success');
                    indiceCorporalSpan.classList.remove('text-warning');
                    indiceCorporalSpan.classList.remove('text-danger');
                    indiceCorporalSpan.classList.add('text-info');
                    indiceCorporalSpan.textContent += ` Bajo peso`;
                } else if (indiceCorporal < 25) {
                    indiceCorporalSpan.classList.remove('text-warning');
                    indiceCorporalSpan.classList.remove('text-danger');
                    indiceCorporalSpan.classList.remove('text-info');
                    indiceCorporalSpan.classList.add('text-success');
                    indiceCorporalSpan.textContent += ` Peso normal`;
                } else if (indiceCorporal < 30) {
                    indiceCorporalSpan.classList.remove('text-info');
                    indiceCorporalSpan.classList.remove('text-danger');
                    indiceCorporalSpan.classList.remove('text-success');
                    indiceCorporalSpan.classList.add('text-warning');
                    indiceCorporalSpan.textContent += ` Sobrepeso`;
                } else if (indiceCorporal >= 30) {
                    indiceCorporalSpan.classList.remove('text-info');
                    indiceCorporalSpan.classList.remove('text-warning');
                    indiceCorporalSpan.classList.remove('text-warning');
                    indiceCorporalSpan.classList.add('text-danger');
                    indiceCorporalSpan.textContent += ` Obesidad`; 
                }
            //mostrar elemento con clase: vistoAparecer
            document.getElementById("vistoVerde").style.display = "block";
            }

        }

        //--------------------------------------------------------------------------------------
        // Agregar nueva enfermedad actual
        let contadorEnfermedades = 2; //Inicia en 2, ya que en el bloque 1 ya existe la primera.

        document.getElementById('add_current_disease').addEventListener('click', function (e) {
            e.preventDefault();

            let containerEnfermedades = document.querySelector('.current_diseases_container');

            let div = document.createElement('div');
            div.classList.add('card', 'card-body', 'current_disease_' + contadorEnfermedades);
            div.innerHTML = `
                <div class="row g-2">
                    <div class="col-6">
                        <div class="form-floating">
                            <select class="form-control" name="currentdiseases[${contadorEnfermedades}][id]" id="currentdisease${contadorEnfermedades}_id">
                                <option value="" disabled selected>Seleccione una enfermedad</option>
                                @foreach ($diseases as $disease)
                                    <option value="{{ $disease->id }}">{{ $disease->name }}</option>
                                @endforeach
                            </select>
                            <label for="currentdisease${contadorEnfermedades}_id">Enfermedad actual ${contadorEnfermedades}: </label>
                        </div>

                    </div>

                    <div class="col-6">
                        <div class="form-floating">
                            <select class="form-select {{ $errors->has('currentdisease${contadorEnfermedades}_duration') ? 'is-invalid' : '' }}" id="currentdisease${contadorEnfermedades}_duration" name="currentdiseases[${contadorEnfermedades}][duration]" aria-label="¿?">
                                <option selected disabled>Seleccione:</option>
                                <option value="year<1" {{ old('currentdisease${contadorEnfermedades}_duration') ==  'year<1' ? 'selected' : '' }}>Menos de 1 Año</option>
                                <option value="1<year<5" {{ old('currentdisease${contadorEnfermedades}_duration') == '1<year<5' ? 'selected' : '' }}>De 1 a 5 Años</option>
                                <option value="year>5" {{ old('currentdisease${contadorEnfermedades}_duration') == 'year>5' ? 'selected' : '' }}>Más de 5 Años</option>
                                <option value="nacimiento" {{ old('currentdisease${contadorEnfermedades}_duration') == 'nacimiento' ? 'selected' : '' }}>Origen Congénito</option>
                            </select>
                            <label for="currentdisease${contadorEnfermedades}_duration">¿Tiempo con la enfermedad?</label>
                            @if ($errors->has('currentdisease${contadorEnfermedades}_duration'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('currentdisease${contadorEnfermedades}_duration') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="form-floating mt-3">
                    <textarea class="form-control" placeholder="Agrega las notas adicionales" name="currentdiseases[${contadorEnfermedades}][notes]" id="currentdisease${contadorEnfermedades}_notes" style="height: 100px"></textarea>
                    <label for="currentdisease${contadorEnfermedades}_notes">Notas adicionales <small>(Si no existe la enfermedad en el listado, escribala aqui)</small> : </label>
                    <input type="text" hidden name="currentdiseases[${contadorEnfermedades}][status]" id="currentdisease${contadorEnfermedades}_status" value="Enfermedad Actual">
                </div>

                <div class="d-flex">
                    <a href="#" class="text-decoration-none link-danger ms-auto pt-2 remove_disease" data-disease="${contadorEnfermedades}">
                        Eliminar
                    </a>
                </div>

            `;

            //Insertar despues del ultimo elemento de .enfermedad + contadorEnfermedades - 1
            containerEnfermedades.insertBefore(div, document.querySelector('.current_disease_' + (contadorEnfermedades - 1)).nextSibling);

            contadorEnfermedades++;

        });

        // Eliminar enfermedad actual previamente agregada
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove_disease')) {
                e.preventDefault();

                let enfermedad = e.target.dataset.disease;

                document.querySelector('.current_disease_' + enfermedad).remove();

                contadorEnfermedades--;
            }
        });

        //------------------------------------------------------------------------
        // Agregar nuevo sintoma actual
        let contadorSintomas = 2; //Inicia en 2, ya que en el bloque 1 ya existe la primera.

        document.getElementById('agregar-sintoma').addEventListener('click', function (e) {
            e.preventDefault();

            let containerSintomas = document.querySelector('.sintomas-container');

            let div = document.createElement('div');
            div.classList.add('card', 'card-body', 'symptom' + contadorSintomas);
            div.innerHTML = `
                <div class="row g-2">
                    <div class="col-6">
                        <div class="form-floating">
                            <select class="form-control" name="symptoms[${contadorSintomas}][id]" id="symptom${contadorSintomas}">
                                <option value="" disabled selected>Seleccione una sintoma</option>
                                @foreach ($symptoms as $symptom)
                                    <option value="{{ $symptom->id }}">{{ $symptom->name }}</option>
                                @endforeach
                            </select>
                            <label for="symptom${contadorSintomas}">Síntoma actual ${contadorSintomas}: </label>
                        </div>

                    </div>

                    <div class="col-6">
                        <div class="form-floating">
                            <select class="form-select {{ $errors->has('symptom${contadorSintomas}_duration') ? 'is-invalid' : '' }}" id="symptom${contadorSintomas}_duration" name="symptoms[${contadorSintomas}][duration]" aria-label="¿symptom?">
                                <option selected disabled>Seleccione:</option>
                                <option value="week<1" {{ old('symptom${contadorSintomas}_duration') ==  'week<1' ? 'selected' : '' }}>Menos de 1 semana</option>
                                <option value="month<1" {{ old('symptom${contadorSintomas}_duration') == 'month<1' ? 'selected' : '' }}>Menos de 1 mes</option>
                                <option value="month>5" {{ old('symptom${contadorSintomas}_duration') == 'month>5' ? 'selected' : '' }}>Más de 1 mes</option>
                                <option value="always" {{ old('symptom${contadorSintomas}_duration') == 'always' ? 'selected' : '' }}>Siempre</option>
                            </select>
                            <label for="symptom${contadorSintomas}_duration">¿Tiempo con la sintoma?</label>
                            @if ($errors->has('symptom${contadorSintomas}_duration'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('symptom${contadorSintomas}_duration') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="form-floating mt-3">
                    <textarea class="form-control" placeholder="Agrega las notas adicionales" name="symptoms[${contadorSintomas}][notes]" id="symptom${contadorSintomas}_notes" style="height: 100px"></textarea>
                    <label for="symptom${contadorSintomas}_notes">Notas adicionales <small>(Si no existe el síntoma en el listado, escribalo aquí)</small> : </label>
                </div>

                <div class="d-flex">
                    <a href="#" class="text-decoration-none link-danger ms-auto pt-2 eliminar-sintoma" data-sintoma="${contadorSintomas}">
                        Eliminar
                    </a>
                </div>

            `;

            //Insertar despues del ultimo elemento de .sintoma + contadorSintomas - 1
            containerSintomas.insertBefore(div, document.querySelector('.symptom' + (contadorSintomas - 1)).nextSibling);

            contadorSintomas++;

        });

        // Eliminar sintoma actual previamente agregada
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('eliminar-sintoma')) {
                e.preventDefault();

                let sintoma = e.target.dataset.sintoma;

                document.querySelector('.symptom' + sintoma).remove();

                contadorSintomas--;
            }
        });

        //----------------------------------------------------------------------
        // Agregar nueva enfermedad posible
        let contadorEnfermedadesPosibles = 2; //Inicia en 2, ya que en el bloque 1 ya existe la primera.

        document.getElementById('add_possible_disease').addEventListener('click', function (e) {
            e.preventDefault();

            let containerEnfermedades = document.querySelector('.possible_diseases_container');

            let div = document.createElement('div');
            div.classList.add('card', 'card-body', 'possible_disease_' + contadorEnfermedadesPosibles);
            div.innerHTML = `
                <div class="row g-2">
                    <div class="col-6">
                        <div class="form-floating">
                            <select class="form-control" name="possiblediseases[${contadorEnfermedadesPosibles}][id]" id="possibledisease${contadorEnfermedadesPosibles}_id">
                                <option value="" disabled selected>Seleccione una enfermedad</option>
                                @foreach ($diseases as $disease)
                                    <option value="{{ $disease->id }}">{{ $disease->name }}</option>
                                @endforeach
                            </select>
                            <label for="possibledisease${contadorEnfermedadesPosibles}_id">Enfermedad posible ${contadorEnfermedadesPosibles}: </label>
                        </div>

                    </div>

                    <div class="col-6">
                        <div class="form-floating">
                            <select class="form-select {{ $errors->has('possibledisease${contadorEnfermedadesPosibles}_status') ? 'is-invalid' : '' }}" id="possibledisease${contadorEnfermedadesPosibles}_status" name="possiblediseases[${contadorEnfermedadesPosibles}][status]" aria-label="¿?">
                                <option selected disabled>Seleccione:</option>
                                <option value="Posible" {{ old('possibledisease${contadorEnfermedadesPosibles}_status') ==  'Posible' ? 'selected' : '' }}>Posible</option>
                                <option value="Confirmada" {{ old('possibledisease${contadorEnfermedadesPosibles}_status') == 'Confirmada' ? 'selected' : '' }}>Confirmada</option>
                            </select>
                            <label for="possibledisease${contadorEnfermedadesPosibles}_status">¿Probabilidad?</label>
                            @if ($errors->has('possibledisease${contadorEnfermedadesPosibles}_status'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('possibledisease${contadorEnfermedadesPosibles}_status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="form-floating mt-3">
                    <textarea class="form-control" placeholder="Agrega las notas adicionales" name="possiblediseases[${contadorEnfermedadesPosibles}][notes]" id="possibledisease${contadorEnfermedadesPosibles}_notes" style="height: 100px"></textarea>
                    <label for="possibledisease${contadorEnfermedadesPosibles}_notes">Notas adicionales <small>(Si no existe la enfermedad en el listado, escribala aqui)</small> : </label>
                </div>

                <div class="d-flex">
                    <a href="#" class="text-decoration-none link-danger ms-auto pt-2 remove_possible_disease" data-disease="${contadorEnfermedadesPosibles}">
                        Eliminar
                    </a>
                </div>

            `;

            //Insertar despues del ultimo elemento de .enfermedad + contadorEnfermedadesPosibles - 1
            containerEnfermedades.insertBefore(div, document.querySelector('.possible_disease_' + (contadorEnfermedadesPosibles - 1)).nextSibling);

            contadorEnfermedadesPosibles++;

        });

        // Eliminar enfermedad actual previamente agregada
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove_possible_disease')) {
                e.preventDefault();

                let enfermedad = e.target.dataset.disease;

                document.querySelector('.possible_disease_' + enfermedad).remove();

                contadorEnfermedadesPosibles--;
            }
        });

    </script>
@endsection