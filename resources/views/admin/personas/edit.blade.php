
@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1 class="m-0">Editar Persona</h1>
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


                       <form method="POST" action="{{ route('admin.personas.update', $persona->id) }}">
                            @csrf
                            @method('PUT')

                        <div class="box box-info padding-1">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="username" class="required">Username correspondiente (Se puede actualizar solo en el módulo de "usuarios")</label>
                                    <input type="text" class="form-control" id="username" disabled
                                           value="{{$persona->user->username}}">
                                </div>

                                @if ($persona->hasSpecialities())

                                <div class="form-group">
                                    <label for="specialities" class="required">Especialidades</label>
                                    <select name="specialities[]" id="specialities" class="form-control select2 {{ $errors->has('specialities') ? 'is-invalid' : ''}}" multiple>
                                        @foreach ($specialities as $especialidad)
                                            <option value="{{ $especialidad->id }}" {{ $persona->specialities->pluck('id')->contains($especialidad->id) ? 'selected' : '' }} >
                                                {{ $especialidad->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('specialities'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('specialities') }}</strong>
                                        </span>
                                    @endif

                                </div>
                                    
                                @endif

                                <div class="form-group">
                                    <label for="cedula" class="required">N° de Cédula</label>
                                    <input type="number" name="cedula" id="cedula"
                                        class="form-control {{ $errors->has('cedula') ? 'is-invalid' : '' }}"
                                        placeholder="Actualiza el N° de Cédula de la persona" value="{{ old('cedula', $persona->cedula) }}">
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
                                        placeholder="Actualiza los apellidos" value="{{ old('apellidos', $persona->apellidos) }}">
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
                                        placeholder="Actualiza los nombres" value="{{ old('nombres', $persona->nombres) }}">
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
                                        placeholder="Actualiza el email" value="{{ old('email', $persona->email) }}">
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
                                        placeholder="Actualiza el Teléfono de la persona" value="{{ old('telefono', $persona->telefono) }}">
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
                                        placeholder="Ingrese la Dirección de la persona" value="{{ old('direccion', $persona->direccion) }}">
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
                                        placeholder="Ingrese la Ciudad de la persona" value="{{ old('ciudad', $persona->ciudad) }}">
                                    @if ($errors->has('ciudad'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('ciudad') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="fecha" class="required">Fecha de Nacimiento</label>
                                    <input name="fecha_nacimiento" id="fecha" type="date" 
                                    class="form-control date {{ $errors->has('fecha_nacimiento') }}" 
                                    value="{{ old('fecha', $persona->fecha_nacimiento) }}"
                                    placeholder="Actualize la fecha de nacimiento">
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
                                            <option value="{{ $genero }}" {{ (old('genero') ? old('genero') : $persona->genero ??  '') == $genero ? 'selected' : '' }}> 
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

                            @can('persona-edit')
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                        Actualizar Persona
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

