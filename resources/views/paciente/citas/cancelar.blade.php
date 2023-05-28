@extends('layouts.admin')

@section('content')


    <section class="content">
      <div class="container-fluid">
        <div class="col-lg-12">

                <div class="card card-primary mt-3">

                    <div class="card-header"> 
                        <h6 class="card-title">Citas Médicas</h6> 
                    </div>


                    @if ($appointments->count() > 0)
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
                                            <th class="pl-5 pr-5"></th>                               
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($appointments as $a)
                                            <tr class="fs-6">
                                                {{-- <td class="text-uppercase">{{ $a->speciality->name}}</td> --}}
                                                <td class="text-uppercase">{{ App\Models\Speciality::find($a->speciality_id)->name}}</td>
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
                                                <td class="text-center">
                                                        @can('appointment-delete')
                                                            <form action="{{ route('paciente.citas.destroy', $a->id) }}"
                                                                method="POST" style="display: inline" class="eliminarCitaPaciente"
                                                                data-appointment = "{{ json_encode($a) }}"
                                                                data-speciality-name="{{ $speciality = App\Models\Speciality::find($a->speciality_id)->name }}">
                                                                @csrf
                                                                {{ method_field('DELETE') }}
                                                                <button class="btn btn-danger btn-sm" type="submit">
                                                                    <i class="fa fa-fw fa-trash"></i></button>
                                                            </form>
                                                        @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div> <!--card-body-->
                    @else
                        <div class="row text-center fst-italic p-3 fs-4 fw-light">
                            <p>No tiene citas agendadas.</p>                     
                        </div>
                    @endif


                </div> <!--card-->

        </div>
      </div>
    </section>

@endsection



