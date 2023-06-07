@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">Receta médica</h1>
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

                            <div class="col-12 text-center mt-4 mb-4">
                                <div class="row p-3">
                                    <div class="d-flex justify-content-center flex-wrap">
                                        <div class="col-auto me-3">
                                            <a type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#previewModalReceta">
                                                <i class="fa-solid fa-print" style="color: #ffffff;"></i> Imprimir Receta médica del paciente
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="row">
                                    <div class="modal fade" id="previewModalReceta" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="previewModalLabel">Receta Médica</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <iframe src="{{ route('doctor.diagnosis.printPrescription', $appointment) }}" width="100%" height="450"></iframe>
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
