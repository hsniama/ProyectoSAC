@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row d-flex justify-content-around mb-0">

                <div class="col-sm-5">
                    <h1 class="m-0">Editar usuario del sistema</h1>
                </div><!-- /.col -->

                <div class="col-sm-7">
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
                </div>


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

                            {{-- <div class="card-title">Listado de usuarios</div> --}}

                            @can('user-list')
                                <div class="mb-3">
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-danger btn-sm p-2"
                                        data-placement="left">
                                        <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                        {{ __('Regresar al listado') }}
                                    </a>
                                </div>
                            @endcan




                            <form method="POST" action="{{ route('admin.users.update', $user->id) }}" role="form"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#step1">1. Información
                                            Personal</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#step2">2. Creedenciales para el
                                            sistema</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#step3">3. Horario laboral</a>
                                    </li>
                                </ul>

                                <div class="box box-info padding-1">
                                    <div class="box-body">

                                        <div class="tab-content">
                                            <div id="step1" class="tab-pane active">

                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="apellidos" class="required">Apellidos</label>
                                                            <input type="text" name="apellidos" id="apellidos"
                                                                class="form-control {{ $errors->has('apellidos') ? 'is-invalid' : '' }}"
                                                                placeholder="Actualiza los apellidos"
                                                                value="{{ old('apellidos', $user->person->apellidos) }}">
                                                            @if ($errors->has('apellidos'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('apellidos') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="nombres" class="required">Nombres</label>
                                                            <input type="text" name="nombres" id="nombres"
                                                                class="form-control {{ $errors->has('nombres') ? 'is-invalid' : '' }}"
                                                                placeholder="Actualiza los nombres"
                                                                value="{{ old('nombres', $user->person->nombres) }}">
                                                            @if ($errors->has('nombres'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('nombres') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="cedula" class="required">N° de Cédula</label>
                                                            <input type="number" name="cedula" id="cedula"
                                                                class="form-control {{ $errors->has('cedula') ? 'is-invalid' : '' }}"
                                                                placeholder="Actualiza el N° de Cédula de la person"
                                                                value="{{ old('cedula', $user->person->cedula) }}">
                                                            @if ($errors->has('cedula'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('cedula') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="fecha" class="required">Fecha de
                                                                Nacimiento</label>
                                                            <input name="fecha_nacimiento" id="fecha" type="date"
                                                                class="form-control date {{ $errors->has('fecha_nacimiento') }}"
                                                                value="{{ old('fecha', $user->person->fecha_nacimiento) }}"
                                                                placeholder="Actualize la fecha de nacimiento">
                                                            @if ($errors->has('fecha_nacimiento'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="genero" class="required">Género</label>
                                                            <select
                                                                class="form-control select2 {{ $errors->has('genero') ? 'is-invalid' : '' }}"
                                                                name="genero" id="genero">
                                                                <option value="">Seleccione un género</option>
                                                                @foreach (App\Models\Person::GENEROS as $genero)
                                                                    <option value="{{ $genero }}"
                                                                        {{ (old('genero') ? old('genero') : $user->person->genero ?? '') == $genero ? 'selected' : '' }}>
                                                                        {{ $genero }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('genero'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('genero') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="telefono">Teléfono</label>
                                                            <input type="text" name="telefono" id="telefono"
                                                                class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                                                placeholder="Actualiza el Teléfono de la person"
                                                                value="{{ old('telefono', $user->person->telefono) }}">
                                                            @if ($errors->has('telefono'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('telefono') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="ciudad">Ciudad</label>
                                                            <input type="text" name="ciudad" id="ciudad"
                                                                class="form-control {{ $errors->has('ciudad') ? 'is-invalid' : '' }}"
                                                                placeholder="Ingrese la Ciudad de la person"
                                                                value="{{ old('ciudad', $user->person->ciudad) }}">
                                                            @if ($errors->has('ciudad'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('ciudad') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="direccion">Dirección</label>
                                                            <input type="text" name="direccion" id="direccion"
                                                                class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}"
                                                                placeholder="Ingrese la Dirección de la person"
                                                                value="{{ old('direccion', $user->person->direccion) }}">
                                                            @if ($errors->has('direccion'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('direccion') }}</strong>
                                                                </span>
                                                            @endif
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
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="username" class="required">Username</label>
                                                            <input type="text" name="username" id="username"
                                                                class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                                                placeholder="Edite el Username"
                                                                value="{{ old('username', $user->username) }}">
                                                            @if ($errors->has('username'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('username') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email" class="required">Correo</label>
                                                            <input type="email" name="email" id="email"
                                                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                                autofocus placeholder="Ingrese el Email del nuevo usuario"
                                                                value="{{ old('email', $user->email) }}">
                                                            @if ($errors->has('email'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="status" class="required">Estado:</label>
                                                            <select name="status" id="statusEdit" class="form-control">
                                                                <option value="Activo"
                                                                    {{ old('status', $user->status) == 'Activo' ? 'selected' : '' }}>
                                                                    Activo
                                                                </option>
                                                                <option value="Inactivo"
                                                                    {{ old('status', $user->status) == 'Inactivo' ? 'selected' : '' }}>
                                                                    Inactivo
                                                                </option>
                                                            </select>
                                                            @if ($errors->has('status'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('status') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="rolesEdit" class="required">Roles</label>
                                                            <select name="rolesEdit[]" id="rolesEdit"
                                                                class="form-control select2 {{ $errors->has('rolesEdit') ? 'is-invalid' : '' }}"
                                                                multiple>
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role->id }}"
                                                                        {{ $user->roles->pluck('id')->contains($role->id) ? 'selected' : '' }}>
                                                                        {{ $role->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('rolesEdit'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('rolesEdit') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        @if ($user->hasRole('doctor'))
                                                            <div class="form-group" id="specialitiesBoxEdit">
                                                                <label for="specialitiesEdit"
                                                                    class="required">Especialidades</label>
                                                                <select name="specialitiesEdit[]" id="specialitiesEdit"
                                                                    class="form-control select2 {{ $errors->has('specialitiesEdit') ? 'is-invalid' : '' }}"
                                                                    multiple>
                                                                    @foreach ($specialities as $especialidad)
                                                                        <option value="{{ $especialidad->id }}"
                                                                            {{ $user->person->specialities->pluck('id')->contains($especialidad->id) ? 'selected' : '' }}>
                                                                            {{ $especialidad->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('specialitiesEdit'))
                                                                    <span class="text-danger">
                                                                        <strong>{{ $errors->first('specialitiesEdit') }}</strong>
                                                                    </span>
                                                                @endif

                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="password">Nueva Contraseña (Opcional)</label>
                                                            <input type="password" name="password" id="password"
                                                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                                placeholder="Ingrese la nueva contraseña del usuario.">
                                                            @if ($errors->has('password'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('password') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="password_confirmation">Repita la Contraseña
                                                            </label>
                                                            <input type="password" name="password_confirmation"
                                                                id="password_confirmation" class="form-control"
                                                                placeholder="Repita la nueva contraseña del usuario">
                                                            @if ($errors->has('password_confirmation'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                                </span>
                                                            @endif
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

                                                <div class="row p-2">

                                                    @if(in_array('doctor', $user->roles->pluck('name')->toArray()) and $schedules)
                                                    <div class="table-responsive">
                                                        <table
                                                            class="table table-hover table-sm text-center table-borderless">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Dia</th>
                                                                    <th scope="col">Estado</th>
                                                                    <th scope="col">Turno Mañana</th>
                                                                    <th scope="col">Turno Tarde</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>

                                                                {{-- @foreach (App\Models\Schedule::DIAS as $key => $dia) --}}
                                                                @foreach ($schedules as $key => $horario)
                                                                    <tr class="p-0 m-0">
                                                                        <td>
                                                                            {{ App\Models\Schedule::DIAS[$key] }}
                                                                        </td>

                                                                        <td>
                                                                            <div class="form-group p-0 m-0">
                                                                                <div
                                                                                    class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                                    <input type="checkbox"
                                                                                        class="custom-control-input"
                                                                                        id="customSwitch{{ $key }}"
                                                                                        name="active[]"
                                                                                        value="{{ $key }}"
                                                                                        @if ($horario->active == 1) checked @endif>
                                                                                    <label class="custom-control-label"
                                                                                        for="customSwitch{{ $key }}"
                                                                                        >
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                        <td>
                                                                            <div class="row d-flex justify-content-center">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <select class="form-control"
                                                                                            name="morning_start[]"
                                                                                            {{-- id="morning_start" --}}
                                                                                            >
                                                                                            @for ($i = App\Models\Schedule::H_INGRESO_MORNING; $i < App\Models\Schedule::H_SALIDA_MORNING; $i++)
                                                                                                <option value="{{($i<10 ? '0' : ''). $i }}:00" @if ($i . ':00 AM' == $horario->morning_start) selected @endif>
                                                                                                    @if ($i == 12)
                                                                                                        {{ $i }}
                                                                                                        :00 PM
                                                                                                    @else
                                                                                                        {{ $i }}
                                                                                                        :00 AM
                                                                                                    @endif
                                                                                                </option>
                                                                                                {{-- <option
                                                                                                    value="{{ $i }}:00"
                                                                                                    @if ($i . ':30 AM' == $horario->morning_start) selected @endif>
                                                                                                    {{ $i }} :30 AM
                                                                                                </option> --}}
                                                                                            @endfor
                                                                                        </select>
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        {{-- <p>{{ $horario->morning_end }}</p> --}}
                                                                                        <select class="form-control"
                                                                                            name="morning_end[]"
                                                                                            {{-- id="morning_end" --}}
                                                                                            >
                                                                                            @for ($i = (App\Models\Schedule::H_INGRESO_MORNING +1); $i <= App\Models\Schedule::H_SALIDA_MORNING; $i++)
                                                                              <option value="{{($i<10 ? '0' : ''). $i }}:00" @if (($i . ':00 PM' == $horario->morning_end) or ($i . ':00 AM' == $horario->morning_end)) selected @endif>
                                                                                                    @if ($i == 12)
                                                                                                        {{ $i }}
                                                                                                        :00 PM
                                                                                                    @else
                                                                                                        {{ $i }}
                                                                                                        :00 AM
                                                                                                    @endif
                                                                                                </option>
                                                                                                {{-- <option
                                                                                                    value="{{ $i }}"
                                                                                                    @if ($i . ':30 AM' == $horario->morning_end) selected @endif>
                                                                                                    {{ $i }} :30 AM
                                                                                                </option> --}}
                                                                                            @endfor
                                                                                                          </select>
                                                                                       
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </td>

                                                                        <td>

                                                                            <div class="row d-flex justify-content-center">
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">

                                                                                        <select class="form-control"
                                                                                            name="afternoon_start[]"
                                                                                            {{-- id="afternoon_start" --}}
                                                                                            >
                                                                                            @for ($i = App\Models\Schedule::H_INGRESO_TARDE; $i < App\Models\Schedule::H_SALIDA_TARDE; $i++)
                                                                                                <option
                                                                                                    value="{{ $i }}:00"
                                                                                                    @if ($i . ':00 PM' == $horario->afternoon_start) selected @endif>
                                                                                                    {{ $i }} :00
                                                                                                    PM
                                                                                                </option>
                                                                                                {{-- <option
                                                                                                    value="{{ $i }}"
                                                                                                    @if ($i . ':30 PM' == $horario->afternoon_start) selected @endif>
                                                                                                    {{ $i }} :30 PM
                                                                                                </option> --}}
                                                                                            @endfor
                                                                                        </select>

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <div class="form-group">
                                                                                        <select class="form-control"
                                                                                            name="afternoon_end[]"
                                                                                            {{-- id="afternoon_end" --}}
                                                                                            >
                                                                                            @for ($i = (App\Models\Schedule::H_INGRESO_TARDE + 1); $i <= App\Models\Schedule::H_SALIDA_TARDE; $i++)
                                                                                                <option
                                                                                                    value="{{ $i }}:00"
                                                                                                    @if ($i . ':00 PM' == $horario->afternoon_end) selected @endif>
                                                                                                    {{ $i }} :00
                                                                                                    PM
                                                                                                </option>
                                                                                                {{-- <option
                                                                                                    value="{{ $i }}"
                                                                                                    @if ($i . ':00 PM' == $horario->afternoon_end) selected @endif>
                                                                                                    {{ $i }} :30 PM
                                                                                                </option> --}}
                                                                                            @endfor
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </td>

                                                                    </tr>
                                                                @endforeach
                                                                

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @endif


                                                </div>




                                                @can('user-edit')
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
                                                                Editar Usuario
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endcan
                                            </div>

                                        </div>
                                        <!--tab-content-->

                                    </div>
                                    <!--box-body-->




                                </div>
                            </form>


                        </div>
                        <!--card-body-->
                    </div>
                    <!--card-->
                </div>
                <!--col-lg-12-->
            </div>
            <!--row-->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
@endsection

