{{-- @extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1 class="m-0">Nuevo Usuario</h1>
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

                        @can('user-list')
                        <div class="mb-3">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-danger btn-sm p-2"  data-placement="left">
                                <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                {{ __('Volver al listado') }}
                            </a>
                        </div>
                        @endcan


                        <form method="POST" action="{{ route('admin.users.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="email" class="required">Correo</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" autofocus
                                            placeholder="Ingrese el Email del nuevo usuario" value="{{ old('email', '') }}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="username" class="required">Username</label>
                                        <input type="text" name="username" id="username"
                                            class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                            placeholder="Ingres el nuevo Username" value="{{ old('username', '') }}">
                                        @if ($errors->has('username'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="roles" class="required">Roles</label>
                                        <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalidad' : '' }}" name="roles[]" id="roles" multiple>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}" @selected(old(''))>{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('roles'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('roles') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="email_verified_at" class="required">Confirmar correo: </label>
                                        <select class="form-control {{ $errors->has('email_verified_at') ? 'is-invalid' : ''}}" name="email_verified_at" id="email_verified_at">
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                        @if ($errors->has('email_verified_at'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('email_verified_at') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="required">Contraseña </label>
                                        <input type="password" name="password" id="password"
                                            class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                            placeholder="Ingrese la contraseña del usuario">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirmation" class="required">Repita la Contraseña </label>
                                        <input type="password" name="password_confirmation" id="password-confirmation" class="form-control"
                                            placeholder="Repita la contraseña del usuario">
                                    </div>



                                    {{-- <div class="form-group">
                                <label for="active">Active</label>
                                <input type="checkbox" name="active" id="active" class="form-control" placeholder="Active">
                            </div> --}}



                                    {{-- 
                                <label for="avatar">Avatar</label>
                                <input type="file" name="avatar" id="avatar" class="form-control" placeholder="Avatar" aria-describedby="helpId">
                                <small id="helpId" class="text-muted">Help text</small> --}}

{{-- 

                                </div>

                                @can('user-create')
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                            Crear Usuario
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
 --}}

 @extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">Registrar nuevo usuario en el sistema</h1>
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

                            {{-- <div class="card-title">Listado de usuarios</div> --}}

                            @can('user-list')
                                <div class="mb-3">
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-danger btn-sm p-2" data-placement="left">
                                        <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                        {{ __('Regresar al listado') }}
                                    </a>
                                </div>
                            @endcan


                            <form method="POST" action="{{ route('admin.users.store') }}" role="form"
                                enctype="multipart/form-data">
                                @csrf

                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#step1">1. Información
                                            Personal</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#step2">2. Creedenciales para el sistema</a>
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
                                                                placeholder="Ingres los apellidos"
                                                                value="{{ old('apellidos', '') }}">
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
                                                                placeholder="Ingrese los nombres"
                                                                value="{{ old('nombres', '') }}">
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
                                                                placeholder="Ingrese el N° de Cédula de la person"
                                                                value="{{ old('cedula', '') }}">
                                                            @if ($errors->has('cedula'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('cedula') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="fecha" class="required">Fecha de Nacimiento</label>
                                                            <input name="fecha_nacimiento" id="fecha" type="date"
                                                                value="{{ old('fecha_nacimiento') }}"
                                                                class="form-control bg-white date {{ $errors->has('fecha_nacimiento') }}"
                                                                placeholder="Escoja una fecha">
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
                                                                class="form-control {{ $errors->has('genero') ? 'is-invalid' : '' }}"
                                                                name="genero" id="genero">
                                                                <option value="" disabled selected>Seleccione un género</option>
                                                                @foreach (App\Models\Person::GENEROS as $genero)
                                                                    <option value="{{ $genero }}"
                                                                        {{ old('genero') == $genero ? 'selected' : '' }}>
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
                                                                placeholder="Ingrese el Teléfono de la person"
                                                                value="{{ old('telefono', '') }}">
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
                                                                value="{{ old('ciudad', '') }}">
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
                                                                value="{{ old('direccion', '') }}">
                                                            @if ($errors->has('direccion'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('direccion') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-primary next-step"
                                                    onclick="nextTab(event, 'step2')">Siguiente</button>
                                            </div>

                                            <div id="step2" class="tab-pane">

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="username" class="required">Username</label>
                                                            <input type="text" name="username" id="username"
                                                                class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                                                                placeholder="Ingres el nuevo Username"
                                                                value="{{ old('username', '') }}">
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
                                                                placeholder="Ingrese el Email de la person"
                                                                value="{{ old('email', '') }}">
                                                            @if ($errors->has('email'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email_verified_at" class="required">Confirmar correo: </label>
                                                            <select class="form-control {{ $errors->has('email_verified_at') ? 'is-invalid' : ''}}" name="email_verified_at" id="email_verified_at">
                                                                <option value="Si">Si</option>
                                                                <option value="No">No</option>
                                                            </select>
                                                            @if ($errors->has('email_verified_at'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('email_verified_at') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="roles" class="required">Roles</label>
                                                            <select class="form-control {{ $errors->has('roles') ? 'is-invalidad' : '' }}" name="roles[]" id="roles" multiple>
                                                                <option value="" disabled selected>Escoge uno o varios roles</option>
                                                                @foreach ($roles as $rol)
                                                                    <option value="{{ $rol->id }}" {{ old('roles' == $roles ? 'selected' : '') }}>{{ $rol->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @if ($errors->has('roles'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('roles') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group" id="specialitiesBox">
                                                            <label for="specialities" class="required">Especialidades</label>
                                                            <select
                                                                class="form-control {{ $errors->has('specialities') ? 'is-invalid' : '' }}"
                                                                name="specialities[]" id="specialities" multiple="multiple">
                                                                
                                                            </select>
                                                            @if ($errors->has('specialities'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('specialities') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="password" class="required">Contraseña </label>
                                                            <input type="password" name="password" id="password"
                                                                class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                                placeholder="Ingrese la contraseña del usuario">
                                                            @if ($errors->has('password'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('password') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="password-confirmation" class="required">Repita la Contraseña </label>
                                                            <input type="password" name="password_confirmation" id="password-confirmation" class="form-control"
                                                                placeholder="Repita la contraseña del usuario">
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- <button type="button" class="btn btn-primary next-step">Siguiente</button> --}}
                                                <button type="button" class="btn btn-secondary"
                                                    onclick="prevTab(event, 'step1')">
                                                    Anterior
                                                </button>

                                                @can('user-create')
                                                    <div class="row">
                                                        <div class="col-12 text-right">
                                                            <button type="submit" class="btn btn-success">
                                                                <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                                                Crear Usuario
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
