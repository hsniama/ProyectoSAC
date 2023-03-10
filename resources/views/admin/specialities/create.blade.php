@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">Nueva Especialidad Médica</h1>
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

                            @can('person-list')
                                <div class="mb-3">
                                    <a href="{{ route('admin.specialities.index') }}" class="btn btn-danger btn-sm p-2"
                                        data-placement="left">
                                        <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                        {{ __('Volver al listado') }}
                                    </a>
                                </div>
                            @endcan


                            <form method="POST" action="{{ route('admin.specialities.store') }}" role="form"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="box box-info padding-1">
                                    <div class="box-body">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="name" class="required">Nombre:</label>
                                                            <input type="text" name="name" id="name"
                                                                class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                                placeholder="Ingres el nombre de la nueva especialidad"
                                                                value="{{ old('name', '') }}">
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
                                                            <label for="description" class="required">Descripción:</label>
                                                            <textarea type="text" name="description" id="description"
                                                                class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                                                placeholder="Ingrese la descripción de la especialidad" value="{{ old('description', '') }}"
                                                                rows="7">
                                                            </textarea>
                                                            @if ($errors->has('description'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('description') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="row d-flex">
                                                    <div class="form-group">
                                                        <label for="status" class="required">Estado: </label>
                                                        </br>
                                                        @foreach (App\Models\Speciality::ESTADOS as $status)
                                                            <div class="form-check form-check-inline">
                                                                <input
                                                                    class="form-check-input {{ $errors->has('status') ? 'is-invalid' : '' }}"
                                                                    type="radio" name="status" id="estado_{{ $status }}"
                                                                    value="{{ $status }}"
                                                                    @if ($status === old('status')) checked @endif>
                                                                <label class="form-check-label" for="estado_{{ $status }}">{{ $status }}</label>
                                                            </div>
                                                        @endforeach
                                                        @if ($errors->has('status'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('status') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        </div>





                                        <div class="form-group" hidden>
                                            <label for="created_by" class="required">Creado por:</label>
                                            <input type="text" name="created_by" id="created_by" class="form-control"
                                                value="{{ Auth::user()->person->getFullNameAttribute() }}">
                                        </div>



                                    </div>

                                    @can('especialidad-create')
                                        <div class="row">
                                            <div class="col-12 text-right">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                                    Crear Especialidad
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
