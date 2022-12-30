
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

                            <div class="mb-3">
                                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm p-2"  data-placement="left">
                                    {{ __('Crear Nuevo Usuario') }}
                                </a>
                            </div>

                        <div class="table-responsive">
                            <table id="user_table" class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>¿Perfil Completo?</th>
                                        <th>UserName</th>
                                        <th>Email</th>
                                        <th>Roles</th>
                                        <th>Creado el</th>
                                        <th>Actualizado el</th>
                                        <th>Acciones</th>
                                        {{-- <th>Email verificado</th> --}}
                                    </tr>
                                </thead>
                                <tbody>                                   
                                    @foreach ($users as $user)
                                         @foreach ($user->getRoleNames(); as $rol)
                                             
                             
                                        <tr>
                                            @if ($user->persona)
                                                <td>Si</td>
                                            @else
                                                <td>No</td>
                                            @endif

                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $rol }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>{{ $user->updated_at }}</td>
                                            {{-- <td>{{ implode(', ', $user->roles()->get()->pluck('username')->toArray()) }}</td> --}}
                                            <td>
                                                @can('admin.users.edit')
                                                    <a href="{{ route('admin.users.edit', $user->id) }}"><button class="btn btn-warning btn-sm">Editar</button></a>
                                                @endcan
                                                @can('admin.users.destroy')
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline" class="eliminarUsuario">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                                </form>
                                                @endcan

                                            </td>
                                        </tr>
                                        @endforeach    
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

