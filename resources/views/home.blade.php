{{-- @extends('layouts.app') --}}
@extends('layouts.admin')

@section('content')
    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Estas logeado!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">Bienvenido</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <section class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    {{-- <div class="card">
                        <div class="card-body"> --}}

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show"
                                    role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                        aria-label="Success:">
                                        <use xlink:href="#check-circle-fill" />
                                    </svg>
                                    <div>
                                        {{ $message }}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            {{-- <div class="card-title">Bienvenido</div> --}}

                            <div class="block">

                                @if (!Auth::user()->person)
                                    <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show"
                                        role="alert">
                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                            aria-label="Success:">
                                            <use xlink:href="#check-circle-fill" />
                                        </svg>

                                        <div class="d-flex flex-column align-items-center">

                                            <div class="mt-3">
                                                <p class="fs-3">
                                                    <span class="text-bold">¡Hola {{ Auth::user()->username }}!</span>,
                                                    primero debes completar tu información personal presionando el siguiente
                                                    botón:
                                                </p>
                                            </div>


                                            <div class="mb-3 mt-3 d-flex justify-content-center">
                                                <a href="{{ route('profile.create') }}"
                                                    class="btn btn-warning btn-lg text-decoration-none text-black">
                                                    Presiona aquí para completar tu perfil.
                                                </a>
                                            </div>

                                            <div class="mt-3">
                                                <p class="fs-4">
                                                    Este paso es obligatorio para poder usar el sistema.
                                                </p>
                                            </div>
                                        </div>

                                    </div>


                                @elseif (Auth::user()->person->isComplete() )

                                    @if ( Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('gerente') || Auth::user()->hasRole('admin'))
                                            

                                        <div class="row">
                                            <div class="col-lg-3 col-6">

                                            </div>

                                            <!-- ./col -->
                                            <div class="col-lg-3 col-6">
                                                <!-- small box -->
                                                <div class="small-box bg-success">
                                                <div class="inner">
                                                    {{-- <h3>53<sup style="font-size: 20px">%</sup></h3> --}}
                                                    <h3>{{ App\Models\Speciality::countSpecialities(); }}</h3>

                                                    <p>Especialidades</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa-solid fa-notes-medical"></i>
                                                </div>
                                                <a href="{{ route('admin.specialities.index') }}" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
                                                </div>
                                            </div>
                                            <!-- ./col -->
                                            <div class="col-lg-3 col-6">
                                                <!-- small box -->
                                                <div class="small-box bg-warning">
                                                <div class="inner">
                                                    <h3>{{ App\Models\User::countUsers(); }}</h3>

                                                    <p>Usuarios Registrados</p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fa-solid fa-users"></i>
                                                </div>
                                                    <a href="{{ route('admin.users.index') }}" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
                                                </div>

                                                <!-- small box -->
                                                <div class="small-box bg-warning">
                                                    <div class="inner">
                                                        <h3>{{ App\Models\User::countDoctors(); }}</h3>
                                                        <p>Doctores</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa-solid fa-user-doctor"></i>
                                                    </div>
                                                </div>

                                                <!-- small box -->
                                                <div class="small-box bg-warning">
                                                    <div class="inner">
                                                        <h3>{{ App\Models\User::countPatients(); }}</h3>
                                                        <p>Pacientes</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa-solid fa-user-doctor"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ./col -->
                                            <div class="col-lg-3 col-6">
                                                <!-- small box -->
                                                <div class="small-box bg-danger">
                                                    <div class="inner">
                                                        <h3>{{App\Models\Appointment::countAppointments();  }}</h3>

                                                        <p>Citas agendadas</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa-regular fa-calendar-check"></i>
                                                    </div>
                                                    <a href="{{ route('admin.appointments.index') }}" class="small-box-footer">Mas información <i class="fas fa-arrow-circle-right"></i></a>
                                                </div>

                                                <div class="small-box bg-danger">
                                                    <div class="inner">
                                                        <h3>{{App\Models\Appointment::countAppointmentsAttendedToday();  }}</h3>                                                        
                                                        <p>Citas atendidas hoy {{\Carbon\Carbon::now()->format('Y-m-d') }}</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa-regular fa-calendar-check"></i>
                                                    </div>
                                                </div>

                                                <div class="small-box bg-danger">
                                                    <div class="inner">
                                                        <h3>{{App\Models\Appointment::countAppointmentsAttendedThisYear();  }}</h3>                                                        
                                                        <p>Citas atendidas este año {{\Carbon\Carbon::now()->format('Y') }}</p>
                                                    </div>
                                                    <div class="icon">
                                                        <i class="fa-regular fa-calendar-check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ./col -->
                                        </div>

                                    @elseif ( Auth::user()->hasRole('doctor'))
                                        <div>
                                            <p class="fs-4">
                                                <span class="text-bold">¡Hola {{ Auth::user()->person->nombres }}!</span>,
                                                como <span class="text-bold">Doctor</span> puedes:</br>
                                            <ul class="fs-5">
                                                <li>Consultar tu agenda de citas.</li>
                                                <li>Iniciar una consulta en una cita.</li>
                                                <li>Detallar la consulta (sintomas, examenes, tratamientos).</li>
                                            </ul>
                                            </p>
                                            {{-- <p class="fs-4">
                                                Roles asignados a este usuario:
                                            <ul>
                                                @foreach (Auth::user()->roles as $rol)
                                                    <li>
                                                        {{ $rol->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                            </p> --}}
                                        </div>
                                    @elseif (Auth::user()->hasRole('secretaria'))
                                        <div>
                                            <p class="fs-4">
                                                <span class="text-bold">¡Hola {{ Auth::user()->person->nombres }}!</span>,
                                                como <span class="text-bold">Secretaria</span> puedes:</br>
                                            <ul class="fs-5">
                                                <li>- Registrar un nuevo paciente en el sistema e imprimir sus creedenciales (username y contraseña).</li>
                                                <li>- Agendar citas a pacientes.</li>
                                                <li>- Consultar y filtrar citas agendadas.</li>
                                            </ul>
                                            </p>
                                            {{-- <p class="fs-4">
                                                Roles asignados a este usuario:
                                            <ul>
                                                @foreach (Auth::user()->roles as $rol)
                                                    <li>
                                                        {{ $rol->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                            </p> --}}
                                        </div>
                                    @elseif ( Auth::user()->hasRole('paciente'))
                                        <div>
                                            <p class="fs-4">
                                                <span class="text-bold">¡Hola {{ Auth::user()->person->nombres }}!</span>,
                                                puedes agendar o consultar una cita en la parte izquierda.
                                            </p>
                                        </div>
                                    @endif

                                @else
                                    {{-- <div>
                                        <p class="fs-4">
                                            <span class="text-bold">¡Hola {{ Auth::user()->person->nombres }}!</span>,
                                            tienes los siguientes roles:
                                        <ul class="fs-5">
                                            @foreach (Auth::user()->roles as $rol)
                                                <li>
                                                    {{ $rol->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        </p>
                                    </div> --}}
                                    <div>
                                        <p>Por favor, dirigite a la barra lateral izquierda.</p>
                                    </div>
                                @endif
                            </div>

                        {{-- </div>
                    </div> --}}
                    
                </div>
            </div>

        </section>
        <!-- /.row -->
    </section><!-- /.container-fluid -->
    
    <!-- /.content -->


@endsection
