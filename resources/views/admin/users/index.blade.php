
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
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif
                        {{-- <div class="card-title">Listado de usuarios</div> --}}

                        <div class="table-responsive">
                            <table id="user_table" class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>Nombres</th>
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
                                        <tr>
                                            <td>{{ $retVal = ($user->persona) ? $user->persona->apellidos . ' ' . $user->persona->nombres : 'No ha completado el perfil' ;  }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ 'rol x' }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>{{ $user->updated_at }}</td>
                                            {{-- <td>{{ implode(', ', $user->roles()->get()->pluck('username')->toArray()) }}</td> --}}
                                            <td>
                                                <a href="{{ route('admin.users.edit', $user->id) }}"><button class="btn btn-primary btn-sm">Editar</button></a>
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                                </form>
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

