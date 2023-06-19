@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row  mb-0">
                <div class="col-sm-12">
                    <h1 class="m-0">Diagnostico de la consulta médica registrada el 
                        <span class="text-blue-500">
                            {{ \Carbon\Carbon::parse($appointment->scheduled_date)->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }} a las {{ \Carbon\Carbon::parse($appointment->scheduled_time)->format('h:m A') }}
                        </span> 
                    </h1>
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
                         
                            <div class="row">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#step1">1. Signos Vitales</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#step2">2. Diagnóstico</a>
                                    </li> 
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#step3">3. Receta</a>
                                    </li>
                                </ul>

                                <div class="box box-info padding-1">
                                    <div class="box-body">

                                        <div class="tab-content">

                                            <!--1. Signos Vitales-->
                                            <div id="step1" class="tab-pane active">

                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <div class="row p-3 d-flex justify-content-center">
                                                                <table class="table table-borderless">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <p>
                                                                                    <span class="fw-bold">Edad</span>  
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
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
                                                                                    <span class="fw-bold">Altura (cm) *</span> 
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    <span class="ml-2 mr-2">{{ optional($appointment->vitalSign)->height }}</span>
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <i class="fa-solid fa-check" style="color: #22ec13;"></i>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p>
                                                                                    <span class="fw-bold">Weight (kg) *</span> 
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>
                                                                                    <span class="ml-2 mr-2">{{ optional($appointment->vitalSign)->weight }}</span>
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <i class="fa-solid fa-check" style="color: #22ec13;"></i>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <p>
                                                                                    <span class="fw-bold">Índice de masa corporal (kg) *</span> 
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <p>                     
                                                                                    <span class="ml-2 mr-2" id="imc">{{ optional($appointment->vitalSign)->body_mass_index }}</span>
                                                                                </p>
                                                                            </td>
                                                                            <td>
                                                                                <i class="fa-solid fa-check" id="vistoVerde" style="color: #22ec13;"></i>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="row p-3 d-flex justify-content-center">
                                                            <table class="table table-borderless">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <p>
                                                                                <span class="fw-bold">Temperatura (°C) *</span> 
                                                                            </p>
                                                                        </td>
                                                                        <td>
                                                                            <p>
                                                                                <span class="ml-2 mr-2">{{ optional($appointment->vitalSign)->temperature }}</span>
                                                                            </p>
                                                                        </td>
                                                                        <td>
                                                                            <i class="fa-solid fa-check" id="vistoVerde" style="color: #22ec13;"></i>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <p>
                                                                                <span class="fw-bold">Presión arterial *</span> 
                                                                            </p>
                                                                        </td>
                                                                        <td>
                                                                            <p>
                                                                                <span class="ml-2 mr-2">{{ optional($appointment->vitalSign)->blood_pressure }}</span>
                                                                            </p>
                                                                        </td>
                                                                        <td>
                                                                            <i class="fa-solid fa-check" id="vistoVerde" style="color: #22ec13;"></i>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <p>
                                                                                <span class="fw-bold">Frecuencia cardiaca *</span> 
                                                                            </p>
                                                                        </td>
                                                                        <td>
                                                                            <p>
                                                                                <span class="ml-2 mr-2">{{ optional($appointment->vitalSign)->heart_rate }}</span>
                                                                            </p>
                                                                        </td>
                                                                        <td>
                                                                            <i class="fa-solid fa-check" id="vistoVerde" style="color: #22ec13;"></i>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <p>
                                                                                <span class="fw-bold">Frecuencia respiratoria *</span>
                                                                            </p>
                                                                        </td>
                                                                        <td>
                                                                            <p>
                                                                                <span class="ml-2 mr-2">{{ optional($appointment->vitalSign)->respiratory_rate }}</span>
                                                                            </p>
                                                                        </td>
                                                                        <td>
                                                                            <i class="fa-solid fa-check" id="vistoVerde" style="color: #22ec13;"></i>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
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

                                            <!--2. Diagnostico-->
                                            <div id="step2" class="tab-pane">

                                                <div class="row p-1 d-flex justify-content-center">

                                                    <div class="row"> <!--Completar Informacion-->
                                                        <div class="col-md-12 mt-3">

                                                            <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#primera" aria-expanded="false" aria-controls="primera">
                                                                1. Información Llenada
                                                            </button>

                                                            <div class="collapse" id="primera"><!--collapse-->                                          
                                                               <div class="card card-body mt-2"><!--card card-body mt-2--> 
                                                                    
                                                                    <div class="col">
                                                                        <!-- allergies-->
                                                                        <div class="form-floating">
                                                                            <input type="text" class="form-control bg-white" disabled value="{{ $appointment->diagnosis->allergies }}">
                                                                            <label for="allergies">Alergias:</label>
                                                                        </div>
                                                                        
                                                                        <div class="row g-2 mt-2">
                                                                            <!--alcohol_use-->
                                                                            <div class="col">
                                                                                <div class="form-floating">
                                                                                    <select class="form-select form-select-plaintext bg-white" id="alcohol_use" disabled>
                                                                                        <option selected disabled>{{ $appointment->diagnosis->alcohol_use }}</option>
                                                                                    </select>
                                                                                    <label for="alcohol_use">¿Consume Alcohol?*</label>
                                                                                </div>
                                                                            </div>
                                                                            <!--drug_use-->
                                                                            <div class="col">
                                                                                <div class="form-floating">
                                                                                    <select class="form-select form-select-plaintext bg-white" id="drug_use" disabled>
                                                                                        <option selected disabled>{{ $appointment->diagnosis->drug_use  }}</option>
                                                                                    </select>
                                                                                    <label for="drug_use">¿Consume Drogas?*</label>
                                                                                </div>
                                                                            </div>
                                                                            <!--smoking_use-->
                                                                            <div class="col">
                                                                                <div class="form-floating">
                                                                                    <select class="form-select form-select-plaintext bg-white" id="smoking_use" disabled>
                                                                                        <option selected disabled>{{ $appointment->diagnosis->smoking_use }}</option>
                                                                                    </select>
                                                                                    <label for="smoking_use">¿Consume Tabaco?*</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- family_background-->
                                                                        <div class="form-floating mt-3">
                                                                            <input type="text" class="form-control bg-white" id="family_background" disabled value="{{ $appointment->diagnosis->family_background }}">
                                                                            <label for="family_background">Antecedentes familiares <small>(enfermedades heriditarias)</small>:</label>
                                                                        </div>
                                                                        <!--surgical_history-->
                                                                        <div class="form-floating mt-3">
                                                                            <input type="text" class="form-control bg-white" disabled id="surgical_history" value="{{ $appointment->diagnosis->surgical_history }}">
                                                                            <label for="surgical_history">¿Se ha operado antes? <small>(Detalla las operaciones que ha tenido)</small>:</label>
                                                                        </div>

                                                                        <!--current_medication-->
                                                                        <div class="form-floating mt-3">
                                                                            <input type="text" class="form-control bg-white" id="current_medication" disabled value="{{ $appointment->diagnosis->current_medication }}">
                                                                            <label for="current_medication">¿Está con medicación? <small>(Detalla los medicamentos que consume)</small>:</label>
                                                                        </div>

                                                                        <!--current_diseases-->
                                                                        <div class="current_diseases_container mt-3">                                                                           
                                                                            @foreach ($diagnosis->diseases as $index => $disease)
                                                                                @if ($disease->pivot->status == 'Enfermedad Actual') 
                                                                                    <div class="card card-body">
                                                                                        <div class="row g-2">
                                                                                            <div class="col-6">
                                                                                                <div class="form-floating">
                                                                                                    <select class="form-control form-select-plaintext bg-white" disabled id="currentdisease{{ $index + 1 }}_id">
                                                                                                        <option value="" disabled selected>{{ $disease->name }}</option>                                                                                                  
                                                                                                    </select>
                                                                                                    <label for="currentdisease{{ $index + 1 }}_id">Enfermedad actual {{ $index + 1 }}: </label>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col-6">
                                                                                                <div class="form-floating">
                                                                                                    <select class="form-select form-select-plaintext bg-white" id="currentdisease{{ $index + 1 }}_duration" disabled>
                                                                                                        <option selected disabled>{{ $disease->pivot->duration }}</option>
                                                                                                    </select>
                                                                                                    <label for="currentdisease{{ $index + 1 }}_duration">¿Tiempo con la enfermedad?</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-floating mt-3">
                                                                                            <textarea class="form-control bg-white" disabled id="currentdisease{{ $index + 1 }}_notes" style="height: 100px">{{ $disease->pivot->notes }}</textarea>
                                                                                            <label for="currentdisease{{ $index + 1 }}_notes">Notas adicionales <small>(Si no existe la enfermedad en el listado, escríbala aquí)</small> : </label>
                                                                                        </div>
                                                                                    </div> 
                                                                                @endif                                                                              
                                                                            @endforeach
                                                                        </div>

                                                                        <!--reason_for_consultation-->
                                                                        <div class="form-floating mt-3">
                                                                            <textarea class="form-control bg-white" disabled id="reason_for_consultation" style="height: 100px">{{ $diagnosis->reason_for_consultation }}</textarea>
                                                                            <label for="reason_for_consultation">Razón o motivo de la consulta:*</label>
                                                                        </div>
                                             
                                                                    </div>
                                                                    
                                                                </div><!--card card-body mt-2-->  
                                                            </div><!--collapse-->

                                                        </div><!--col-md-12 mt-3-->
                                                    </div><!--Completar Informacion-->

                                                    <!--2. Sintomas y Enfermedades-->
                                                    <div class="row">             
                                                        <div class="col-md-6 mt-3">
                                                            <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#segunda" aria-expanded="false" aria-controls="segunda">
                                                                2. Sintomas
                                                            </button> 
                                                            <div class="collapse" id="segunda">
                                                               <div class="card card-body mt-2">
                                                                    <div class="col">
                                                                        <!-- symptoms-->
                                                                        <div class="sintomas-container mt-3">     
                                                                            @foreach ($diagnosis->symptoms as $index => $symptom) 
                                                                                <div class="card card-body symptom{{ $index + 1 }}">
                                                                                    <div class="row g-2">
                                                                                        <div class="col-6">
                                                                                            <div class="form-floating">
                                                                                                <select class="form-control bg-white" disabled>
                                                                                                    <option value="" disabled selected>{{ $symptom->name }}</option>
                                                                                                </select>
                                                                                                <label for="symptom{{ $index + 1 }}">Síntoma actual {{ $index + 1 }}: </label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-6">
                                                                                            <div class="form-floating">
                                                                                                <select class="form-select bg-white" disabled>
                                                                                                    <option selected disabled>{{ $symptom->pivot->duration }}</option>
                                                                                                </select>
                                                                                                <label for="symptom{{ $index + 1 }}_duration">¿Tiempo con el síntoma?</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-floating mt-3">
                                                                                        <textarea class="form-control bg-white" disabled style="height: 100px">{{ $symptom->pivot->notes }}</textarea>
                                                                                        <label for="symptom{{ $index + 1 }}_notes">Notas adicionales <small>(Si no existe el síntoma en el listado, escríbalo aquí)</small> : </label>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>

                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>

                                                        <!--3. Posibles Enfermedades-->
                                                        <div class="col-md-6 mt-3">
                                                            <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#tercera" aria-expanded="false" aria-controls="tercera">
                                                                3. Posibles Enfermedades
                                                            </button>  
                                                            <div class="collapse" id="tercera">
                                                               <div class="card card-body mt-2">
                                                                    <div class="col">
                                                                        <!-- possible_diseases -->
                                                                        <div class="possible_diseases_container mt-3">
                                                                            @foreach ($diagnosis->diseases as $index => $possibleDisease)
                                                                                @if ($disease->pivot->status === 'Enfermedad Posible' && !empty($disease->pivot->probability ))
                                                                                    <div class="card card-body possible_disease_{{ $index + 1 }}">
                                                                                        <div class="row g-2">
                                                                                            <div class="col-6">
                                                                                                <div class="form-floating">
                                                                                                    <select class="form-control bg-white" disabled>
                                                                                                        <option value="" disabled selected>{{ $possibleDisease->name }}</option>
                                                                                                    </select>
                                                                                                    <label for="possibledisease{{ $index + 1 }}_id">Enfermedad posible {{ $index + 1 }}: </label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <div class="form-floating">
                                                                                                    <select class="form-select bg-white" disabled>
                                                                                                        <option selected disabled>{{ $possibleDisease->pivot->probability }}</option>
                                                                                                    </select>
                                                                                                    <label for="possibledisease{{ $index + 1 }}_probability">¿Probabilidad?</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-floating mt-3">
                                                                                            <textarea class="form-control bg-white" disabled style="height: 100px">{{ $possibleDisease->pivot->notes }}</textarea>
                                                                                            <label for="possibledisease{{ $index + 1 }}_notes">Notas adicionales <small>(Si no existe la enfermedad en el listado, escríbala aquí)</small> : </label>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!--3. Conclusiones generales-->
                                                    <div class="row">
                                                        <div class="col-md-12 mt-3">
                                                            <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#cuarta" aria-expanded="false" aria-controls="cuarta">
                                                                3. Conclusiones generales
                                                            </button>
                                                            <div class="collapse" id="cuarta">                                          
                                                               <div class="card card-body mt-2">
                                                                    <div class="col">
                                                                        <!--conclusions-->
                                                                        <div class="form-floating mt-3">
                                                                            <textarea class="form-control bg-white" disabled id="conclusions" style="height: 100px">{{ $diagnosis->conclusions }}</textarea>
                                                                            <label for="conclusions">Conclusiones finales del diagnóstico:* </label>
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

                                            <!-- 3. Receta -->
                                            <div id="step3" class="tab-pane">

                                                <div class="row p-1 d-flex justify-content-center">

                                                    <div class="row"> <!--Completar Informacion-->
                                                        <div class="col-md-12 mt-3">

                                                            <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#quinta" aria-expanded="false" aria-controls="quinta">
                                                                1. Medicamentos
                                                            </button>

                                                            <div class="collapse" id="quinta"><!--collapse-->                                          
                                                               <div class="card card-body mt-2"><!--card card-body mt-2--> 
                                                                    
                                                                    <div class="col">                                                                
                                                                        <div class="medicines_container mt-3">                                                                            
                                                                            @foreach ($prescription->medicines as $index => $medicine)
                                                                                <div class="card card-body medicine{{ $index + 1 }}">
                                                                                    <div class="row g-2">
                                                                                        <div class="col-5">
                                                                                            <div class="form-floating">
                                                                                                <select class="form-control bg-white" disabled>
                                                                                                    <option value="" disabled selected>{{ $medicine->name }}</option>
                                                                                                </select>
                                                                                                <label for="medicine{{ $index + 1 }}">Medicamento actual {{ $index + 1 }}:</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div class="form-floating">
                                                                                                <input type="number" class="form-control bg-white" disabled value="{{ $medicine->pivot->quantity }}">
                                                                                                <label for="medicine{{ $index + 1 }}_quantity">Cantidad:</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div class="form-floating">
                                                                                                <input type="number" class="form-control bg-white" disabled value="{{ $medicine->pivot->duration }}">
                                                                                                <label for="medicine{{ $index + 1 }}_duration">Duración: <small>(días)</small>:</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-floating mt-3">
                                                                                        <textarea class="form-control bg-white" disabled style="height: 100px">{{ $medicine->pivot->observations }}</textarea>
                                                                                        <label for="medicine{{ $index + 1 }}_observations">Indicaciones <small>(Detalle las dosis, etc. Si no existe el medicamento en el listado, escríbalo aquí.)</small>:</label>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div><!--card card-body mt-2-->  
                                                            </div><!--collapse-->

                                                        </div><!--col-md-12 mt-3-->
                                                    </div><!--Completar Informacion-->

                                                    <div class="row">             
                                                        <div class="col-md-12 mt-3">
                                                            <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#sexta" aria-expanded="false" aria-controls="sexta">
                                                                2. Exámenes
                                                            </button> 
                                                            <div class="collapse" id="sexta">
                                                               <div class="card card-body mt-2">
                                                                    <div class="col">

                                                                        <div class="exams_container mt-3">                                                                          
                                                                            @foreach ($prescription->medicalExams as $index => $exam)
                                                                                <div class="card card-body exam{{ $index + 1 }}">
                                                                                    <div class="row g-2">
                                                                                        <div class="col-5">
                                                                                            <div class="form-floating">
                                                                                                <select class="form-control bg-white" disabled>
                                                                                                    <option value="" disabled selected>{{ $exam->name }}</option>
                                                                                                </select>
                                                                                                <label for="exam{{ $index + 1 }}">Examen actual {{ $index + 1 }}:</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div class="form-floating">
                                                                                                <input type="text" class="form-control bg-white" disabled value="{{ $exam->pivot->observations }}">
                                                                                                <label for="exam{{ $index + 1 }}_observations">Observaciones adicionales <small>(Si no existe el examen en el listado, escríbalo aquí.)</small>:</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-12 mt-3">
                                                            <button class="btn btn-outline-primary w-100" type="button" data-bs-toggle="collapse" data-bs-target="#septima" aria-expanded="false" aria-controls="septima">
                                                                3. Sugerencias o Recomendaciones
                                                            </button>  
                                                            <div class="collapse" id="septima">
                                                               <div class="card card-body mt-2">
                                                                    <div class="col">

                                                                        <div class="recommendations_container mt-3">
                                                                            @foreach (explode("\n", $prescription->recommendations) as $index => $recommendation)
                                                                                <div class="card card-body recommendation{{ $index + 1 }}">
                                                                                    <div class="row g-5">
                                                                                        <div class="col">
                                                                                            <div class="form-floating mt-3">
                                                                                                <textarea class="form-control bg-white" disabled id="recommendation{{ $index + 1 }}">{{ $recommendation }}</textarea>
                                                                                                <label for="recommendation{{ $index + 1 }}">Recomendación {{ $index + 1 }}:</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
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
                                                        <a href="{{ route('doctor.diagnosis.medicalHistories', $appointment->patient_id) }}" class="btn btn-success">
                                                            <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                                            Regresar
                                                        </a>

                                                    </div>
                                                </div>


                                            </div>
               
                                        </div>

                                    </div> <!--box-body-->
                                </div> <!--box-->
                                        <!--tab-content-->
  
                            </div><!-- /.card-body -->


                        </div><!--card-body-->
                    </div><!--card-->
                </div><!--col-lg-12-->
            </div><!--row-->
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->

@endsection

@section('scripts')
<script>
    const indiceCorporal = parseFloat(document.getElementById('imc').innerHTML);

    const indiceCorporalSpan = document.getElementById('imc');

    if(indiceCorporal < 18.5){
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

</script>
@endsection