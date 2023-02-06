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
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">Bienvenido</h1>
                </div><!-- /.col -->

                {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
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
                                                    primero debes completar tu información personl presionando el siguiente
                                                    botón:
                                                </p>
                                            </div>


                                            <div class="mb-3 mt-3 d-flex justify-content-center">
                                                <a href="{{ route('profile.create') }}"
                                                    class="btn btn-warning btn-lg text-decoration-none text-black">
                                                    Presiona aquí para completar tu profile.
                                                </a>
                                            </div>

                                            <div class="mt-3">
                                                <p class="fs-4">
                                                    Este paso es obligatorio para poder usar el sistema.
                                                </p>
                                            </div>
                                        </div>

                                        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                                    </div>
                                @elseif (!Auth::user()->person->isComplete())
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
                                                    primero debes completar tu información personl presionando el siguiente
                                                    botón:
                                                </p>
                                            </div>


                                            <div class="mb-3 mt-3 d-flex justify-content-center">
                                                <a href="{{ route('profile.edit', Auth::user()->person->id) }}"
                                                    class="btn btn-warning btn-lg text-decoration-none text-black">
                                                    Presiona aquí para completar tu profile.
                                                </a>
                                            </div>

                                            <div class="mt-3">
                                                <p class="fs-4">
                                                    Este paso es obligatorio para poder usar el sistema.
                                                </p>
                                            </div>
                                        </div>

                                        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                                    </div>
                                @elseif (Auth::user()->person->isComplete() && Auth::user()->hasRole('super-admin'))
                                    <div>
                                        <p class="fs-4">
                                            <span class="text-bold">¡Hola {{ Auth::user()->person->nombres }}!</span>, como
                                            <span class="text-bold">Super Administrador</span> puedes operar absolutamente
                                            todo el sistema.</br>
                                        </p>
                                    </div>
                                @elseif (Auth::user()->person->isComplete() && Auth::user()->hasRole('gerente'))
                                    <div>
                                        <p class="fs-4">
                                            <span class="text-bold">¡Hola {{ Auth::user()->person->nombres }}!</span>, como
                                            <span class="text-bold">Gerente</span> puedes:</br>
                                        <ul class="fs-5">
                                            <li>Acceder al Modulo de Gestión Estadística.</li>
                                            <li>Operar todas las funcionalidades del sistema.</li>
                                        </ul>
                                        </p>
                                        <p class="fs-4">
                                            Roles asignados a este usuario:
                                        <ul>
                                            @foreach (Auth::user()->roles as $rol)
                                                <li>
                                                    {{ $rol->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        </p>
                                    </div>
                                @elseif (Auth::user()->person->isComplete() && Auth::user()->hasRole('admin'))
                                    <div>
                                        <p class="fs-4">
                                            <span class="text-bold">¡Hola {{ Auth::user()->person->nombres }}!</span>, como
                                            <span class="text-bold">Administrador</span> puedes operar las siguientes
                                            funcionalidades del sistema:</br>
                                        <ul class="fs-5">
                                            <li>Modulo RPU</li>
                                            <li>Gestión de Persons</li>
                                            <li>Gestión de Citas</li>
                                        </ul>
                                        </p>
                                        <p class="fs-4">
                                            Roles asignados a este usuario:
                                        <ul>
                                            @foreach (Auth::user()->roles as $rol)
                                                <li>
                                                    {{ $rol->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        </p>
                                    </div>
                                @elseif (Auth::user()->person->isComplete() && Auth::user()->hasRole('doctor'))
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
                                        <p class="fs-4">
                                            Roles asignados a este usuario:
                                        <ul>
                                            @foreach (Auth::user()->roles as $rol)
                                                <li>
                                                    {{ $rol->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        </p>
                                    </div>
                                @elseif (Auth::user()->person->isComplete() && Auth::user()->hasRole('secretaria'))
                                    <div>
                                        <p class="fs-4">
                                            <span class="text-bold">¡Hola {{ Auth::user()->person->nombres }}!</span>,
                                            como <span class="text-bold">Secretaria</span> puedes:</br>
                                        <ul class="fs-5">
                                            <li>Registrar un nuevo paciente en el sistema e imprimir sus creedenciales
                                                (username y contraseña).</li>
                                            <li>Agendar citas a pacientes.</li>
                                            <li>Consultar y filtrar citas agendadas.</li>
                                        </ul>
                                        </p>
                                        <p class="fs-4">
                                            Roles asignados a este usuario:
                                        <ul>
                                            @foreach (Auth::user()->roles as $rol)
                                                <li>
                                                    {{ $rol->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        </p>
                                    </div>
                                @elseif (Auth::user()->person->isComplete() && Auth::user()->hasRole('paciente'))
                                    <div>
                                        <p class="fs-4">
                                            <span class="text-bold">¡Hola {{ Auth::user()->person->nombres }}!</span>,
                                            puedes agendar o consultar una cita en la parte izquierda.
                                        </p>
                                    </div>
                                @else
                                    <div>
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
                                    </div>
                            </div>
                            @endif
                        </div>


                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


@endsection
