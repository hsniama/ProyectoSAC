@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">Impresión de creedenciales</h1>
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

                            @can('home')
                                <div class="mb-3">
                                    <a href="{{ route('home') }}" class="btn btn-danger btn-sm p-2" data-placement="left">
                                        <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                        {{ __('Regresar') }}
                                    </a>
                                </div>
                            @endcan

                            @if ($success)
                                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show"
                                    role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                        aria-label="Success:">
                                        <use xlink:href="#check-circle-fill" />
                                    </svg>
                                    <div>
                                        {{ $success }}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif


                            <div class="col-12 text-center mt-4 mb-4">

                                <form action="{{ route('secretaria.imprimir.creedenciales') }}" method="POST">
                                    @csrf
                                    @method('POST')

                                    <input type="text" name="username" hidden value="{{ $user->username }}">
                                    {{-- <input type="text" name="nombres" hidden value="{{ $user->person->nombres }}">
                              <input type="text" name="apellidos" hidden value="{{ $user->person->apellidos }}"> --}}
                                    <input type="text" name="apellidos" hidden value="{{ $paciente->apellidos }}">
                                    <input type="text" name="nombres" hidden value="{{ $paciente->nombres }}">

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa-solid fa-print"></i>
                                        Imprimir creedenciales de acceso (user y password)
                                    </button>
                                </form>





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
