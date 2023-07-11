{{-- @extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">Editar Perfil</h1>
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

                            @can('home')
                                <div class="mb-3">
                                    <a href="{{ route('home') }}" class="btn btn-danger btn-sm p-2" data-placement="left">
                                        <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                        {{ __('Regresar') }}
                                    </a>
                                </div>
                            @endcan

                            <form method="POST" action="{{ route('profile.update', $person->id) }}">
                                <form method="POST" action="">
                                    @csrf
                                    @method('PUT')

                                    <div class="box box-info padding-1">
                                        <div class="box-body">



                                        </div>




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
@endsection  --}}


@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-12">
                        <h1 class="m-0">Editar mi Información</h1>
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
                                    <a href="{{ route('home') }}" class="btn btn-danger btn-sm p-2"
                                        data-placement="left">
                                        <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                        {{ __('Cancelar') }}
                                    </a>
                                </div>
                            @endcan

                            <form method="POST" action="{{ route('profile.update', $person->id) }}">
                                    @csrf
                                    @method('PUT')

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
                                                                {{-- placeholder="Actualiza los apellidos" --}}
                                                                value="{{ old('apellidos', $person->apellidos) }}" disabled>
                                                            {{-- @if ($errors->has('apellidos'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('apellidos') }}</strong>
                                                                </span>
                                                            @endif --}}
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="nombres" class="required">Nombres</label>
                                                            <input type="text" name="nombres" id="nombres"
                                                                class="form-control {{ $errors->has('nombres') ? 'is-invalid' : '' }}"
                                                                {{-- placeholder="Actualiza los nombres" --}}
                                                                value="{{ old('nombres', $person->nombres) }}" disabled>
                                                            {{-- @if ($errors->has('nombres'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('nombres') }}</strong>
                                                                </span>
                                                            @endif --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="cedula" class="required">N° de Cédula</label>
                                                            <input type="number" name="cedula" id="cedula"
                                                                class="form-control {{ $errors->has('cedula') ? 'is-invalid' : '' }}"
                                                                {{-- placeholder="Actualiza el N° de Cédula de la person" --}}
                                                                value="{{ old('cedula', $person->cedula) }}" disabled>
                                                            {{-- @if ($errors->has('cedula'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('cedula') }}</strong>
                                                                </span>
                                                            @endif --}}
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="username" class="required">Username</label>
                                                            <input type="text" class="form-control" id="username" disabled
                                                                value="{{ $person->user->username }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="created_at" class="required">Fecha de creación de mi cuenta</label>
                                                            <input type="text" class="form-control" id="created_at" disabled value="{{ $person->created_at }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="updated_at" class="required">Fecha de última actualización</label>
                                                            <input type="text" class="form-control" id="updated_at" disabled value="{{ $person->updated_at }}">
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="telefono">Teléfono</label>
                                                            <input type="number" name="telefono" id="telefono"
                                                                class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                                                placeholder="Ingrese el Teléfono de la person"
                                                                value="{{ old('telefono', $person->telefono) }}">
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
                                                                placeholder="Ingrese la Ciudad de la person"
                                                                value="{{ old('ciudad', $person->ciudad) }}">
                                                            @if ($errors->has('ciudad'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('ciudad') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="email" class="required">Correo</label>
                                                            <input type="email" name="email" id="email"
                                                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                                placeholder="Actualiza el email" value="{{ old('email', $person->user->email) }}">
                                                            @if ($errors->has('email'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div> 
                                                    </div>


                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="direccion">Dirección</label>
                                                            <input type="text" name="direccion" id="direccion"
                                                                class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}"
                                                                placeholder="Ingrese la Dirección de la person"
                                                                value="{{ old('direccion', $person->direccion) }}">
                                                            @if ($errors->has('direccion'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('direccion') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="fecha" class="required">Fecha de Nacimiento</label>
                                                            <input name="fecha_nacimiento" id="fecha" type="date"
                                                                class="form-control date bg-white {{ $errors->has('fecha_nacimiento') }}"
                                                                value="{{ old('fecha', $person->fecha_nacimiento) }}"
                                                                {{-- placeholder="Ingrese su fecha de nacimiento"  --}}
                                                                >
                                                            {{-- @if ($errors->has('fecha_nacimiento'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                                                </span>
                                                            @endif --}}
                                                        </div>
                                                    </div>
                                                    
                                                    {{-- <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="fecha_nacimiento" class="required">Edad</label>
                                                            <input type="number" class="form-control" id="fecha_nacimiento" 
                                                                    value="{{ $edad }}">
                                                        </div>
                                                    </div> --}}
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="genero" class="required">Género</label>
                                                            <input name="genero" type="text" class="form-control" id="genero" value="{{ $person->genero }}">
                                                        </div>
                                                    </div> 
                                                    
                                                </div>
                                            </div>
                                        </div>

                                    </div> 

                                        @can('profile-edit')
                                            <div class="row">
                                                <div class="col-12 text-right">
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                                        Actualizar Informacion
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


@endsection
