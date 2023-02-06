
@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1 class="m-0">Nueva Persona</h1>
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

                        @can('persona-list')
                        <div class="mb-3">
                            <a href="{{ route('admin.personas.index') }}" class="btn btn-danger btn-sm p-2"  data-placement="left">
                                <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                {{ __('Volver al listado') }}
                            </a>
                        </div>
                        @endcan


                        <form method="POST" action="{{ route('admin.personas.store') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">

                                    <div class="form-group">
                                        <label for="user_id" class="required">¿Qué usuario es? (ya creado)</label>
                                        <select class="form-control select2 {{ $errors->has('user_id') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                                            <option value="" disabled selected class="p-2">Seleccione el usuario que falta completar su información</option>
                                            @foreach ($users as $user)
                                                @if (!$user->persona)
                                                    <option value="{{ $user->id }}" 
                                                        @selected($user->id == old('user_id'))>
                                                        {{ $user->username }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @if ($errors->has('user_id'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('user_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="cedula" class="required">N° de Cédula</label>
                                        <input type="number" name="cedula" id="cedula"
                                            class="form-control {{ $errors->has('cedula') ? 'is-invalid' : '' }}"
                                            placeholder="Ingrese el N° de Cédula de la persona" value="{{ old('cedula', '') }}">
                                        @if ($errors->has('cedula'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('cedula') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="apellidos" class="required">Apellidos</label>
                                        <input type="text" name="apellidos" id="apellidos"
                                            class="form-control {{ $errors->has('apellidos') ? 'is-invalid' : '' }}"
                                            placeholder="Ingres los apellidos" value="{{ old('apellidos', '') }}">
                                        @if ($errors->has('apellidos'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('apellidos') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                    <div class="form-group">
                                        <label for="nombres" class="required">Nombres</label>
                                        <input type="text" name="nombres" id="nombres"
                                            class="form-control {{ $errors->has('nombres') ? 'is-invalid' : '' }}"
                                            placeholder="Ingrese los nombres" value="{{ old('nombres', '') }}">
                                        @if ($errors->has('nombres'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('nombres') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                    {{-- <div class="form-group">
                                        <label for="email" class="required">Correo</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            placeholder="Ingrese el Email de la persona" value="{{ old('email', '') }}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div> --}}

                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" name="telefono" id="telefono"
                                            class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                            placeholder="Ingrese el Teléfono de la persona" value="{{ old('telefono', '') }}">
                                        @if ($errors->has('telefono'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('telefono') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" name="direccion" id="direccion"
                                            class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}"
                                            placeholder="Ingrese la Dirección de la persona" value="{{ old('direccion', '') }}">
                                        @if ($errors->has('direccion'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('direccion') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="ciudad">Ciudad</label>
                                        <input type="text" name="ciudad" id="ciudad"
                                            class="form-control {{ $errors->has('ciudad') ? 'is-invalid' : '' }}"
                                            placeholder="Ingrese la Ciudad de la persona" value="{{ old('ciudad', '') }}">
                                        @if ($errors->has('ciudad'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('ciudad') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="fecha" class="required">Fecha de Nacimiento</label>
                                        <input name="fecha_nacimiento" id="fecha" type="date" value="{{ old('fecha_nacimiento') }}"
                                        class="form-control date {{ $errors->has('fecha_nacimiento') }}" placeholder="Escoja una fecha">
                                        @if ($errors->has('fecha_nacimiento'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label for="genero" class="required">Género</label>
                                        <select class="form-control select2 {{ $errors->has('genero') ? 'is-invalid' : '' }}" name="genero" id="genero">
                                            <option value="">Seleccione un género</option>
                                            @foreach (App\Models\Persona::GENEROS as $genero)
                                                <option value="{{ $genero }}" {{ old('genero') == $genero ? 'selected' : '' }}>
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

                                @can('persona-create')
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                            Crear Persona
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