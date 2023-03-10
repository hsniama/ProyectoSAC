{{-- @extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    @if ($user->hasRole('doctor'))
                        <h1 class="m-0">Llene los datos del Doctor</h1>
                    @else 
                        <h1 class="m-0">Llene los datos de la Persona</h1>
                    @endif
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
{{-- 
                            @can('person-list')
                                <div class="mb-3">
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-danger btn-sm p-2"
                                        data-placement="left">
                                        <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                        {{ __('Volver al listado') }}
                                    </a>
                                </div>
                            @endcan


                            <form method="POST" action="{{ route('admin.persons.store') }}" role="form"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="box box-info padding-1">
                                    <div class="box-body">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="apellidos" class="required">Apellidos</label>
                                                            <input type="text" name="apellidos" id="apellidos"
                                                                class="form-control {{ $errors->has('apellidos') ? 'is-invalid' : '' }}"
                                                                placeholder="Ej: Firmino Garcia" value="{{ old('apellidos', '') }}">
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
                                                                placeholder="Ej: Gustavo Joaquin" value="{{ old('nombres', '') }}">
                                                            @if ($errors->has('nombres'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('nombres') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="cedula" class="required">N° de Cédula</label>
                                                            <input type="number" name="cedula" id="cedula"
                                                                class="form-control {{ $errors->has('cedula') ? 'is-invalid' : '' }}"
                                                                placeholder="Ej: 1720844446"
                                                                value="{{ old('cedula', '') }}">
                                                            @if ($errors->has('cedula'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('cedula') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="email" class="required">Correo</label>
                                                            <input type="email" class="form-control" id="email" disabled
                                                                value="{{$user->email }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="fecha" class="required">Fecha de Nacimiento</label>
                                                            <input name="fecha_nacimiento" id="fecha" type="date"
                                                                value="{{ old('fecha_nacimiento') }}"
                                                                class="form-control date {{ $errors->has('fecha_nacimiento') }}"
                                                                placeholder="Escoja una fecha">
                                                            @if ($errors->has('fecha_nacimiento'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="direccion">Dirección</label>
                                                            <input type="text" name="direccion" id="direccion"
                                                                class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}"
                                                                placeholder="Ej: Av. Las Casas y 10 de Agosto"
                                                                value="{{ old('direccion', '') }}">
                                                            @if ($errors->has('direccion'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('direccion') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-6">

                                                @if ($user->hasRole('doctor'))
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="specialities" class="required">Especialidades</label>
                                                                <select
                                                                    class="form-control select2 {{ $errors->has('specialities') ? 'is-invalid' : '' }}"
                                                                    name="specialities[]" id="specialities" multiple="multiple">
                                                                    <option value="">Seleccione las especialidades: </option>
                                                                    @foreach ($specialities as $speciality)
                                                                        <option value="{{ $speciality->id }}" @selected($speciality->id == old('specialities'))>
                                                                            {{ $speciality->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('specialities'))
                                                                    <span class="text-danger">
                                                                        <strong>{{ $errors->first('specialities') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="username" class="required">Username</label>
                                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                            <input type="text" class="form-control" id="username" disabled
                                                                value="{{ $user->username }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="genero" class="required">Género</label>
                                                            <select
                                                                class="form-control select2 {{ $errors->has('genero') ? 'is-invalid' : '' }}"
                                                                name="genero" id="genero">
                                                                <option value="">Seleccione un género</option>
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
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="telefono">Teléfono</label>
                                                            <input type="text" name="telefono" id="telefono"
                                                                class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                                                placeholder="Ej: 0989457004"
                                                                value="{{ old('telefono', '') }}">
                                                            @if ($errors->has('telefono'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('telefono') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="ciudad">Ciudad</label>
                                                            <input type="text" name="ciudad" id="ciudad"
                                                                class="form-control {{ $errors->has('ciudad') ? 'is-invalid' : '' }}"
                                                                placeholder="Ej: Quito"
                                                                value="{{ old('ciudad', '') }}">
                                                            @if ($errors->has('ciudad'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('ciudad') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    @can('person-create')
                                        <div class="row">
                                            <div class="col-12 text-right">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                                    Completar Información!
                                                </button>
                                            </div>
                                        </div>
                                    @endcan


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


@endsection --}} 
