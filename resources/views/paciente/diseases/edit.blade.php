@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">Editar Enfermedad</h1>
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

                            {{-- @can('person-list') --}}
                                <div class="mb-3">
                                    <a href="{{ route('paciente.diseases.index') }}" class="btn btn-danger btn-sm p-2"
                                        data-placement="left">
                                        <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                        {{ __('Volver al listado') }}
                                    </a>
                                </div>
                            {{-- @endcan --}}


                            <form method="POST" action="{{ route('paciente.diseases.update', $disease->id) }}">
                                @csrf
                                @method('PUT')

                                <div class="box box-info padding-1">
                                    <div class="box-body">


                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="name" class="required">Nombre: </label>
                                                            <input type="text" name="name" id="name"
                                                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                                placeholder="Actualiza el nombre de la enfermedad"
                                                                value="{{ old('name', $disease->name) }}">
                                                            @if ($errors->has('name'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('name') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="observaciones" class="required">Observaciones:</label>
                                                            <textarea type="text" name="observaciones" id="observaciones"
                                                                class="form-control {{ $errors->has('observaciones') ? 'is-invalid' : '' }}"
                                                                placeholder="Ingrese observaciones de la enfermedad"
                                                                rows="7">
                                                                {{ old('observaciones', $disease->observaciones ) }}
                                                            </textarea>
                                                            @if ($errors->has('observaciones'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('observaciones') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            {{-- <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="status" class="required">Estado:</label>
                                                            <select name="status" id="status" class="form-control">
                                                                <option value="Activo"
                                                                    {{ old('status', $speciality->status) == 'Activo' ? 'selected' : '' }}>
                                                                    Activo</option>
                                                                <option value="Inactivo"
                                                                    {{ old('status', $speciality->status) == 'Inactivo' ? 'selected' : '' }}>
                                                                    Inactivo</option>
                                                            </select>
                                                            @if ($errors->has('status'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('status') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}

                                        </div>



                                        {{-- <div class="form-group" hidden>
                                            <label for="updated_by" class="required">Actualizado por:</label>
                                            <input type="text" name="updated_by" id="updated_by" class="form-control"
                                                value="{{ Auth::user()->person->getFullNameAttribute() }}">
                                        </div> --}}




                                    </div>

                                    {{-- @can('especialidad-edit') --}}
                                        <div class="row">
                                            <div class="col-12 text-right">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                                    Actualizar Enfermedad
                                                </button>
                                            </div>
                                        </div>
                                    {{-- @endcan --}}



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
