
@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1 class="m-0">Datos personales de: {{ $persona->apellidos . ' ' . $persona->nombres}}</h1>
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

                        <div class="box box-info padding-1">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="username" class="required">Username correspondiente</label>
                                    <input type="text" class="form-control" id="username" disabled
                                           value="{{$persona->user->username}}">
                                </div>

                                <div class="form-group">
                                    <label for="apellidos" class="required">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" disabled
                                           value="{{$persona->apellidos}}">
                                </div>

                                <div class="form-group">
                                    <label for="nombres" class="required">Nombres</label>
                                    <input type="text" class="form-control" id="nombres" disabled
                                           value="{{$persona->nombres }}">
                                </div>

                                <div class="form-group">
                                    <label for="cedula" class="required">Cedula</label>
                                    <input type="number" class="form-control" id="cedula" disabled
                                           value="{{$persona->cedula }}">
                                </div>

                                <div class="form-group">
                                    <label for="email" class="required">Correo</label>
                                    <input type="email" class="form-control" id="email" disabled
                                           value="{{$persona->email }}">
                                </div>

                                <div class="form-group">
                                    <label for="telefono" class="required">Telefono</label>
                                    <input type="text" class="form-control" id="telefono" disabled
                                           value="{{$persona->telefono }}">
                                </div>

                                <div class="form-group">
                                    <label for="direccion" class="required">Direccion</label>
                                    <input type="text" class="form-control" id="direccion" disabled
                                           value="{{$persona->direccion }}">
                                </div>

                                <div class="form-group">
                                    <label for="ciudad" class="required">Ciudad</label>
                                    <input type="text" class="form-control" id="ciudad" disabled
                                           value="{{$persona->ciudad }}">
                                </div>

                                <div class="form-group">
                                    <label for="fecha_nacimiento" class="required">Fecha de Nacimiento</label>
                                    <input type="text" class="form-control" id="fecha_nacimiento" disabled
                                           value="{{$persona->fecha_nacimiento }}">
                                </div>

                                <div class="form-group">
                                    <label for="fecha_nacimiento" class="required">Edad</label>
                                    <input type="number" class="form-control" id="fecha_nacimiento" disabled
                                           value="{{ $edad }}">
                                </div>

                                <div class="form-group">
                                    <label for="genero" class="required">Genero</label>
                                    <input type="text" class="form-control" id="genero" disabled
                                           value="{{$persona->genero }}">
                                </div>

                                <div class="form-group">
                                    <label for="created_at" class="required">Fecha de creación de la Persona</label>
                                    <input type="text" class="form-control" id="created_at" disabled
                                           value="{{$persona->created_at}}">                                       
                                </div>

                                <div class="form-group">
                                    <label for="updated_at" class="required">Fecha de actualización de la Persona</label>
                                    <input type="text" class="form-control" id="updated_at" disabled
                                           value="{{$persona->updated_at}}">
                                </div>


                            </div>

                        </div>



                    </div> <!--card-body-->
                </div> <!--card-->
            </div> <!--col-lg-12-->
        </div> <!--row-->
      </div><!-- /.container-fluid -->
    </div><!-- /.content -->


@endsection


