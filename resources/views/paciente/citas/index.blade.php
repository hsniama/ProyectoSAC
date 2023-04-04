@extends('layouts.admin')

@section('content')


    <section class="content">
      <div class="container-fluid">
        <div class="col-lg-12">

                <div class="card card-primary mt-3">

                    <div class="card-header"> 
                        <h6 class="card-title">Citas Médicas</h6> 
                    </div>

                    <div class="card-body">
                              
                        <div class="card-title fs-6">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold pb-0 pt-0">Cedula: </td>
                                        <td class="pb-0 pt-0">{{ Auth::user()->person->cedula }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold pb-0 pt-0">Nombres: </td>
                                        <td class="pb-0 pt-0 text-uppercase">{{ Auth::user()->person->getFullNameAttribute() }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="table-responsive">
                            <table class="table align-middle table-hover text-center">
                                <thead class="thead">
                                    <tr class="fs-6">                                     
										<th>Especialidad</th>
										<th class="text-nowrap pl-5 pr-5">Fecha de Cita</th>
                                        <th class="text-nowrap pl-5 pr-5">Hora de Cita</th>
                                        <th class="pl-5 pr-5">Unidad</th>
                                        <th class="pl-5 pr-5">Médico</th>
                                        <th class="pl-5 pr-5">Direccion</th>
                                        <th class="pl-5 pr-5">Nota</th>                               
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $a)
                                        <tr class="fs-6">
											<td class="text-uppercase">{{ $a->speciality->name}}</td>
                                            <td>
                                                {{ $a->scheduled_date }}
											</td>
                                            <td>
                                                {{ $a->getScheduledTimeAttribute($a->scheduled_time) }}
                                            </td>
                                            <td>
                                                <p>Hospital El Oro</p>
                                            </td>
                                            <td class="text-uppercase text-start">
                                                {{ $a->doctor->getFullNameAttribute()}}
                                            </td>
                                            <td class="text-start">
                                                <p>Av. 10 de Agosto y Av. 6 de Diciembre</p>
                                            </td>
                                            <td class="text-start">
                                                <p>La atencion es presencial. Asistir con 30 minutos de anticipación.</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        <div class="row p-3">
                            <div class="d-flex justify-content-center flex-wrap">
                                <div class="col-auto me-3">
                                    <a type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#previewModal">
                                        <i class="fa-solid fa-print" style="color: #ffffff;"></i> Imprimir
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <a type="button" class="btn btn-primary btn-sm" href="{{ route("home") }}"><i class="fa-regular fa-circle-check" style="color: #ffffff;"></i> Finalizar</a>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="row">
                            <div class="modal fade" id="previewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="previewModalLabel">Reporte de Citas médicas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <iframe src="{{ route('paciente.previewCitas') }}" width="100%" height="450"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div> <!--card-body-->
                </div> <!--card-->

        </div>
      </div>
    </section>

@endsection


