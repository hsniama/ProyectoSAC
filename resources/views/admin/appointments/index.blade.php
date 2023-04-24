@extends('layouts.admin')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">

          {{-- <div class="col-sm-6">
            <h1 class="m-0">Lista de Citas totales independientemente de su estado</h1>
          </div><!-- /.col --> --}}

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

                        <div class="row">
                            @if ($message = Session::get('success'))               
                                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                    <div>
                                        {{ $message }}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                    
                            <div class="col">
                                <div class="card-title fs-3 fw-bolder">Lista de Citas totales</div>
                            </div>

                            <div class="col">
                                @can('appointment-create')
                                    <div class="mb-3 float-end">
                                        <a href="{{ route('admin.appointments.create') }}" class="btn btn-success p-2"  data-placement="left">
                                            {{ __('Agendar Nueva Cita') }}
                                        </a>
                                    </div>
                                @endcan
                            </div>
                        </div>


                        <div class="row mt-3 mb-4">
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <input type="date" name="start_date" class="form-control bg-white dateFiltroInicio" readonly />
                                    <label for="start_date ">Fecha Inicio (desde): </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <input type="text" name="end_date" class="form-control end_date bg-white dateFiltroFinal" readonly />
                                    <label for="end_date">Fecha final (hasta): </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <select class="form-control" name="status_id">
                                        <option value="" disabled >Seleccione un estado</option>
                                            <option value="Atendido">Atendido</option>                                
                                            <option value="Cancelada">Cancelada</option>                                
                                            <option value="Pendiente" selected>Pendiente</option>                                
                                    </select>
                                    <label for="status_id">Estado: </label>
                                </div>

                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <select class="form-control" name="speciality_id">
                                        <option value="" disabled selected>Seleccione una especialidad</option>
                                        @foreach ($specialities as $speciality)
                                            <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="speciality_id">Especialidad: </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <select class="form-control" name="doctor_id">
                                        <option value="" disabled selected>Escoja un doctor</option>
                                        @foreach ($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">{{ $doctor->person->getFullNameAttribute() }}</option>
                                        @endforeach
                                    </select>
                                    <label for="doctor_id">Doctor: </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row float-end">
                                    <div class="col">
                                        <button id="filtrar" class="btn btn-danger btn-sm">Filtrar</button>
                                    </div>
                                    <div class="col">
                                        <button id="limpiar" class="btn btn-secondary btn-sm">Limpiar</button>
                                    </div>
                                </div>

                            </div>
                        </div>
            

                        <div class="table-responsive">
                            <table id="citasTabla" class="table table-bordered text-center table-sm">
                                <thead class="thead">
                                    <tr>
                                        {{-- <th>ID</th>               --}}
										<th>C.I Paciente</th>
										<th>Doctor</th>
										<th>Especialidad</th>
										<th>Fecha de Cita</th>
										<th>Estado</th>
                                        <th>Motivo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($appointments as $cita)
                                        <tr>
                                            <td>{{ $cita->id }}</td>
											<td>{{ $cita->patient->cedula }}</td>
											<td>{{'Dr(a). '. $cita->doctor->nombres . ' '. $cita->doctor->apellidos}}</td>
											<td><span class="badge badge-primary ">{{ $cita->speciality->name }}</span></td>
											<td>{{ $cita->scheduled_date }} </br> {{ 'Hora: '. $cita->scheduled_time }}</td>
                                            <td>
                                                @if ($cita->status == 'Cancelado')
                                                    <span class="badge badge-danger">{{ $cita->status }}</span>
                                                @elseif ($cita->status == 'Atendido')
                                                    <span class="badge badge-success">{{ $cita->status }}</span>
                                                @else
                                                    <span class="badge badge-warning">{{ $cita->status }}</span>
                                                @endif
                                            </td>
											<td>{{ $cita->notes }}</td>
                                            <td>
                                                {{-- @can('appointment-show')
                                                <a href="{{ route('admin.appointments.show', $cita->id) }}"><button class="btn btn-info mb-2 btn-sm"><i class="fa fa-fw fa-eye"></i></button></a> </br>   
                                                @endcan 
                                                @can('appointment-edit')
                                                <a href="{{ route('admin.appointments.edit', $cita->id) }}"><button class="btn btn-warning mb-2 btn-sm"><i class="fa fa-fw fa-edit"></i></button></a></br> 
                                                @endcan
                                                @can('appointment-delete')
                                                <form action="{{ route('admin.appointments.destroy', $cita) }}" method="POST" style="display: inline" class="eliminarCita">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                                @endcan
                                            </td>

                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>



                    </div> <!--card-body-->
                </div> <!--card-->
            </div> <!--col-lg-12-->
        </div> <!--row-->
      </div><!-- /.container-fluid -->
    </div><!-- /.content -->


@endsection

@section('scripts')

    @can('export-buttons')
    <script>
        $(document).ready(function() {

            $('#citasTabla').DataTable({
                searching: true,
                ordering: false,
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('admin.appointments.index') }}",
                    data: function (d) {
                        d.start_date = $('input[name=start_date]').val();
                        d.end_date = $('input[name=end_date]').val();
                        d.status_id = $('select[name=status_id]').val();
                        d.speciality_id = $('select[name=speciality_id]').val();
                        d.doctor_id = $('select[name=doctor_id]').val();
                    }
                },
                dataType: 'json',
                type: 'POST',
                columns: [
                    // {
                    //     data: 'id', name: 'id'
                    // },
                    {
                        data: 'patient.cedula', name: 'patient.cedula'
                    },
                    {
                        data: 'doctor', name: 'doctor'
                    },
                    {
                        data: 'speciality', name: 'speciality'
                    },
                    {
                        data: 'appDateWithTime', name: 'appDateWithTime'
                    },
                    {
                        data: 'status', name: 'status'
                    },
                    {
                        data: 'notes', name: 'notes'
                    },
                    {
                        data: 'actions', name: 'actions',
                        // orderable: false,
                        // searchable: false 
                    }
                ],

                scrollY : 300,
                
                dom: 'Bfrtip',
                buttons: 
                [
                    {
                        extend: 'copy',
                        text: 'Copiar',
                        className: 'btn-secondary'
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible'
                        },
                        text: 'Excel',
                        className: 'btn-success'
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible'
                        },
                        text: 'CSV',  
                        className: 'btn-primary'
                    },
                    {
                        extend: 'pdf',
                        messageBottom: "Impreso el " + new Date().toLocaleDateString() + " a las " + new Date().toLocaleTimeString(),
                        exportOptions: {
                            columns: ':visible'
                        },
                        text: 'PDF',
                        className: 'btn-danger'
                    },
                    {
                        extend: 'print',
                        messageBottom: "Impreso el " + new Date().toLocaleDateString() + " a las " + new Date().toLocaleTimeString(),
                        text: 'Imprimir',
                        exportOptions: {
                            columns: ':visible'
                        },
                        className: 'btn-info'
                    },
                    ,
                    { 
                        extend: 'spacer',
                        style : 'bar'
                    },
                    {
                        extend: 'colvis',
                        text: 'Escoger Columnas',
                        className: 'btn-warning'
                    },
                ],

            });

            $('#filtrar').click(function(){
                $('#citasTabla').DataTable().draw();
            });

            //select the input search box


            $('#limpiar').click(function(){
                var now = new Date();
                now.setMinutes(now.getMinutes() - now.getTimezoneOffset());

                $('input[name=start_date]').val(now.toISOString().slice(0,10));
                $('input[name=end_date]').val(now.toISOString().slice(0,10)); 
                $('select[name=status_id]').val('Pendiente');
                $('select[name=speciality_id]').val('');
                $('select[name=doctor_id]').val('');
                $('#citasTabla').DataTable().draw(true);
            });



        });


    </script>
    @endcan

@endsection