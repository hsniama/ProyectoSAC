@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">

                {{-- <div class="col-sm-6">
                    <h1 class="m-0">Listado de Usuarios</h1>
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


                            <div class="card-title fs-3 fw-bolder">Listado de usuarios</div>

                            @can('user-create')
                                <div class="float-end">
                                    <a href="{{ route('admin.users.create') }}" class="btn btn-success p-2"
                                        data-placement="left">
                                        {{ __('Agregar Nuevo Usuario') }}
                                    </a>
                                </div>
                            @endcan




                            <div class="table-responsive">
                                <table id="usuariosTabla"
                                    class="table table-striped table-bordered zero-configuration text-center">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Roles</th>
                                            {{-- <th>Creado el</th>
                                            <th>Actualizado el</th> --}}
                                            <th>Observaciones</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->email }}</td>

                                                <td>
                                                    @if ($user->getRoleNames())
                                                        @foreach ($user->getRoleNames() as $rol)
                                                            @if ($rol == 'admin' || $rol == 'super-admin')
                                                                <span
                                                                    class="badge bg-danger mb-1">{{ $rol }}</span>
                                                                </br>
                                                            @elseif ($rol == 'gerente')
                                                                <span
                                                                    class="badge bg-warning mb-1">{{ $rol }}</span>
                                                                </br>
                                                            @elseif ($rol == 'secretaria')
                                                                <span
                                                                    class="badge bg-primary mb-1">{{ $rol }}</span>
                                                                </br>
                                                            @elseif ($rol == 'doctor')
                                                                <span
                                                                    class="badge bg-success mb-1">{{ $rol }}</span>
                                                                </br>
                                                            @elseif ($rol == 'paciente')
                                                                <span
                                                                    class="badge bg-cyan mb-1">{{ $rol }}</span>
                                                                </br>
                                                            @else
                                                                <span
                                                                    class="badge bg-secondary mb-1">{{ $rol }}</span>
                                                                </br>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </td>



                                                <td>{{ $user->created_at }}</td>
                                                <td>{{ $user->updated_at }}</td>

                                                <td class="text-left">
                                                    <ul>
                                                        @if (!$user->person)
                                                            <li>No ha completado su profile. <a
                                                                    href="{{ route('admin.persons.create.personrol', $user->id) }}">Completalo
                                                                    Aqui</a></li>
                                                        @endif

                                                        @if ($user->hasRole('doctor') && !$user->hasPersonAndSpeciality())
                                                            <li>No tiene especialidades asignadas.</li>
                                                        @elseif ($user->hasRole('doctor') && $user->hasPersonAndSpeciality())
                                                            <li>Tiene asignado las siguientes especialidades: </li>
                                                            @foreach ($user->person->specialities as $especialidad)
                                                                <span
                                                                    class="badge badge-primary">{{ $especialidad->name }}</span>
                                                            @endforeach
                                                        @endif
                                                    </ul>
                                                </td>

                                                <td>
                                                    @can('user-edit')
                                                        <a href="{{ route('admin.users.edit', $user->id) }}"><button
                                                                class="btn btn-warning mb-2 btn-sm"><i
                                                                    class="fa fa-fw fa-edit"></i></button></a>
                                                    @endcan
                                                    @can('user-delete')
                                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                            style="display: inline" class="eliminarUsuario">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button class="btn btn-danger btn-sm" type="submit"><i
                                                                    class="fa fa-fw fa-trash"></i></button>
                                                        </form>
                                                    @endcan

                                                </td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                            <!--table-responsive-->

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


@section('scripts')

    @can('export-buttons')
    <script>
        $(document).ready(function() {
            $('#usuariosTabla').DataTable({
 
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.users.index') }}",
                dataType: 'json',
                type: 'GET',
                columns: [{
                        data: 'id', name: 'id'
                    },
                    {
                        data: 'username', name: 'username'
                    },
                    {
                        data: 'email', name: 'email'
                    },
                    {
                        data: 'roles', name: 'roles'
                    },
                    // {
                    //     data: 'created_at', name: 'created_at'
                    // },
                    // {
                    //     data: 'updated_at', name: 'updated_at'
                    // },
                    {
                        data: 'observaciones', name: 'observaciones'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false 
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
        });


    </script>
    @endcan






@endsection