
@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1 class="m-0">Listado de Usuarios</h1>
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

                        @if ($message = Session::get('success'))               
                            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                <div>
                                    {{ $message }}
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        
                        {{-- <div class="card-title">Listado de usuarios</div> --}}

                        @can('user-create')
                            <div class="mb-3">
                                <a href="{{ route('admin.users.create') }}" class="btn btn-success p-2"  data-placement="left">
                                    {{ __('Agregar Nuevo Usuario') }}
                                </a>
                            </div>
                        @endcan


                        <div class="table-responsive">
                            <table id="user_table" class="table table-striped table-bordered zero-configuration text-center">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>Creado el</th>
                                        <th>Actualizado el</th>
                                        <th>Observaciones</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>                                   
                                    @foreach ($users as $user)                                                                                                                   
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                        
                                            <td>
                                            @if ($user->getRoleNames())
                                                @foreach ($user->getRoleNames() as $rol)
                                                    @if ($rol == 'admin' || $rol == 'super-admin')
                                                        <span class="badge bg-danger fs-6 mb-1">{{ $rol  }}</span> </br>
                                                    @elseif ($rol == 'gerente')
                                                        <span class="badge bg-warning fs-6 mb-1">{{ $rol  }}</span> </br>                            
                                                    @elseif ($rol == 'secretaria')
                                                        <span class="badge bg-primary fs-6 mb-1">{{ $rol }}</span> </br>
                                                    @elseif ($rol == 'doctor')
                                                        <span class="badge bg-success fs-6 mb-1">{{ $rol  }}</span> </br>                            
                                                    @elseif ($rol == 'paciente')
                                                        <span class="badge bg-cyan fs-6 mb-1">{{ $rol  }}</span> </br>
                                                    @else
                                                        <span class="badge bg-secondary fs-6 mb-1">{{ $rol  }}</span> </br>
                                                    @endif
                                                @endforeach
                                            @endif
                                            </td>


                                            
                                            <td>{{ $user->created_at }}</td>
                                            <td>{{ $user->updated_at }}</td>

                                            <td class="text-left">
                                                <ul>
                                                    @if (!$user->persona)
                                                        <li>No ha completado su perfil. <a href="{{ route('admin.personas.create.personarol', $user->id) }}">Completalo Aqui</a></li>
                                                    @endif

                                                    @if ($user->hasRole('doctor') && !$user->hasPersonaAndSpeciality())
                                                        <li>No tiene especialidades asignadas.</li>
                                                    @elseif ($user->hasRole('doctor') && $user->hasPersonaAndSpeciality())
                                                        <li>Tiene asignado las siguientes especialidades: </li>
                                                        @foreach ($user->persona->specialities as $especialidad)
                                                            <span class="badge badge-primary">{{ $especialidad->name }}</span>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                            </td>

                                            <td>
                                                @can('user-edit')
                                                    <a href="{{ route('admin.users.edit', $user->id) }}"><button class="btn btn-warning mb-2 btn-sm"><i class="fa fa-fw fa-edit"></i></button></a>
                                                @endcan
                                                @can('user-delete')
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline" class="eliminarUsuario">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                                @endcan

                                            </td>
                                        </tr>
                                          
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!--table-responsive-->

                    </div> <!--card-body-->
                </div> <!--card-->
            </div> <!--col-lg-12-->
        </div> <!--row-->
      </div><!-- /.container-fluid -->
    </div><!-- /.content -->


@endsection

