@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-12">
                    @if ($user->person)
                        <h1 class="m-0">Datos personales de la persona</h1>
                    @else
                        <h1 class="m-0">Datos personales de : {{ $user->username }} <span class="font-weight-bold text-danger">(Información Incompleta)</span></h1>
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

                            @can('user-list')
                                <div class="mb-3">
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-danger btn-sm p-2"
                                        data-placement="left">
                                        <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                        {{ __('Volver al listado') }}
                                    </a>
                                </div>
                            @endcan

                            <div class="box box-info padding-1">
                                <div class="box-body">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="apellidos" class="required">Apellidos</label>
                                                        <input type="text" class="form-control" id="apellidos" disabled
                                                            value= @if ($user->person) {{ $user->person->apellidos }} @else "Sin Registros" @endif>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="nombres" class="required">Nombres</label>
                                                        <input type="text" class="form-control" id="nombres" disabled
                                                            value=@if ($user->person) {{ $user->person->nombres }} @else "Sin Registros" @endif>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="cedula" class="required">Cedula</label>
                                                        <input type="number" class="form-control" id="cedula" disabled
                                                            value= @if ($user->person) {{ $user->person->cedula }} @else {{ 0 }} @endif>
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
                                                        <label for="fecha_nacimiento" class="required">Fecha de Nacimiento</label>
                                                        <input type="text" class="form-control" id="fecha_nacimiento" disabled
                                                            value=@if ($user->person) {{ $user->person->fecha_nacimiento }} @else "Sin Registros" @endif>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="direccion" class="required">Direccion</label>
                                                        <input type="text" class="form-control" id="direccion" disabled
                                                                value=@if ($user->person) {{ $user->person->direccion }} @else "Sin Registros" @endif>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="created_at" class="required">Fecha de creación del usuario</label>
                                                        <input type="text" class="form-control" id="created_at" disabled value="{{ $user->created_at }}">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label for="updated_at" class="required">Fecha de la ultima actualización</label>
                                                        <input type="text" class="form-control" id="updated_at" disabled value=@if ($user->person) {{ $user->person->updated_up }} @else "Sin Registros" @endif>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            @if ($user->person && $user->person->hasSpecialities())
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="specialities" class="required">Especialidades</label> </br>
                                                            <select disabled class="form-control select2" name="specialities[]"
                                                                id="specialities" multiple="multiple">
                                                                @foreach ($user->person->specialities as $speciality)
                                                                    <option selected>
                                                                        {{ $speciality->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="username" class="required">Username</label>
                                                        <input type="text" class="form-control" id="username" disabled
                                                            value="{{ $user->username }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="fecha_nacimiento" class="required">Edad</label>
                                                        <input type="number" class="form-control" id="fecha_nacimiento" disabled
                                                            value="{{ $edad }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="genero" class="required">Genero</label>
                                                        <input type="text" class="form-control" id="genero" disabled
                                                            value=@if ($user->person) {{ $user->person->genero }} @else "Sin Registros" @endif>
                                                    </div>
                                                </div>            
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="telefono" class="required">Telefono</label>
                                                        <input type="text" class="form-control" id="telefono" disabled
                                                            value=@if ($user->person) {{ $user->person->telefono }} @else "Sin Registros" @endif>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="ciudad" class="required">Ciudad</label>
                                                        <input type="text" class="form-control" id="ciudad" disabled
                                                            value=@if ($user->person) {{ $user->person->ciudad }} @else "Sin Registros" @endif>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div> 

                            </div>

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
