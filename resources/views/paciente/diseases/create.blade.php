@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">Nueva Enfermedad</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">

                    <div class="card">

                        <div class="card-body">

                            {{-- <div class="card-title">Listado de usuarios</div> --}}

                            @can('person-list')
                                <div class="mb-3">
                                    <a href="{{ route('paciente.diseases.index') }}" class="btn btn-danger btn-sm p-2"
                                        data-placement="left">
                                        <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                        {{ __('Volver al listado') }}
                                    </a>
                                </div>
                            @endcan


                            <form method="POST" action="{{ route('paciente.diseases.store') }}" role="form" enctype="multipart/form-data">
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
                                                                placeholder="Ingres el nombre de la nueva enfermedad"
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
                                                            <label for="observaciones" class="required">Observaciones:</label>
                                                            <textarea type="text" name="observaciones" id="observaciones"
                                                                class="form-control {{ $errors->has('observaciones') ? 'is-invalid' : '' }}"
                                                                placeholder="Ingrese las Observaciones de la enfermedad" value="{{ old('observaciones', '') }}"
                                                                rows="7">
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

                                        </div>


                                    </div>

                                    
                                        <div class="row">
                                            <div class="col-12 text-right">
                                                <button type="submit" class="btn btn-success">
                                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                                    Crear Enfermedad
                                                </button>
                                            </div>
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
    </section><!-- /.content -->
@endsection
