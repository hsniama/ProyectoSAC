@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">

                {{-- <div class="col-sm-6">
                    <h1 class="m-0">Listado de Pacientes</h1>
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

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show"
                                    role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                        aria-label="Success:">
                                        <use xlink:href="#check-circle-fill" />
                                    </svg>
                                    <div>
                                        {{ $message }}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif


                            <div class="card-title fs-3 fw-bolder">Listado de pacientes</div>

                            @can('person-create')
                                <div class="float-end">
                                    <a href="{{ route('secretaria.pacientes.create') }}" class="btn btn-success p-2"
                                        data-placement="left">
                                        {{ __('Agregar Nuevo Paciente') }}
                                    </a>
                                </div>
                            @endcan


                            <div class="table-responsive">
                                <table id="tablaNormalDataTable"
                                    class="table table-striped table-bordered zero-configuration text-center">
                                    <thead class="thead">
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Cedula</th>
                                            <th>Apellidos</th>
                                            <th>Nombres</th>
                                            <th>Email</th>
                                            {{-- <th>Telefono</th> --}}
                                            {{-- <th>Direccion</th> --}}
                                            {{-- <th>Ciudad</th> --}}
                                            <th>Fecha Nacimiento</th>
                                            <th>Genero</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($personsRolPaciente as $paciente)
                                            {{-- @foreach ($pacientes as $paciente) --}}
                                            <tr>
                                                <td>{{ $paciente->id }}</td>
                                                <td>{{ $paciente->user->username }}</td>
                                                <td>{{ $paciente->cedula }}</td>
                                                <td>{{ $paciente->apellidos }}</td>
                                                <td>{{ $paciente->nombres }}</td>
                                                <td>{{ $paciente->user->email }}</td>
                                                {{-- <td>{{ $paciente->telefono }}</td> --}}
                                                {{-- <td>{{ $paciente->direccion }}</td> --}}
                                                {{-- <td>{{ $paciente->ciudad }}</td> --}}
                                                <td>{{ $paciente->fecha_nacimiento }}</td>
                                                <td>{{ $paciente->genero }}</td>

                                                <td>
                                                    @can('paciente-show')
                                                        <a href="{{ route('secretaria.pacientes.show', $paciente->id) }}"><button
                                                                class="btn btn-info mb-2 btn-sm"><i
                                                                    class="fa fa-fw fa-eye"></i>Ver</button></a> </br>
                                                    @endcan
                                                    {{-- @can('paciente-edit')
                                                <a href="{{ route('admin.persons.edit', $person->id) }}"><button class="btn btn-warning mb-2 btn-sm"><i class="fa fa-fw fa-edit"></i>Editar</button></a></br> 
                                                @endcan
                                                @can('paciente-delete')
                                                <form action="{{ route('admin.persons.destroy', $person) }}" method="POST" style="display: inline" class="eliminarPerson">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-fw fa-trash"></i>Eliminar</button>
                                                </form>
                                                @endcan --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
