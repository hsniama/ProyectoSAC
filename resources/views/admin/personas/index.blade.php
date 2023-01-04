
@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1 class="m-0">Listado de Personas</h1>
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

                        @can('persona-create')
                            <div class="mb-3">
                                <a href="{{ route('admin.personas.create') }}" class="btn btn-success p-2"  data-placement="left">
                                    {{ __('Agregar Nueva Persona') }}
                                </a>
                            </div>
                        @endcan


                        <div class="table-responsive">
                            <table id="personas_table" class="table table-striped table-bordered zero-configuration text-center">
                                <thead class="thead">
                                    <tr>
                                        <th>ID</th>                    
										<th>User Id</th>
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
                                    @foreach ($personas as $persona)
                                        <tr>
                                            <td>{{ $persona->id }}</td>
											<td>{{ $persona->user->username }}</td>
											<td>{{ $persona->cedula }}</td>
											<td>{{ $persona->apellidos }}</td>
											<td>{{ $persona->nombres }}</td>
											<td>{{ $persona->email }}</td>
											{{-- <td>{{ $persona->telefono }}</td> --}}
											{{-- <td>{{ $persona->direccion }}</td> --}}
											{{-- <td>{{ $persona->ciudad }}</td> --}}
											<td>{{ $persona->fecha_nacimiento }}</td>
											<td>{{ $persona->genero }}</td>

                                            <td>
                                                @can('persona-show')
                                                <a href="{{ route('admin.personas.show', $persona->id) }}"><button class="btn btn-info mb-2 btn-sm"><i class="fa fa-fw fa-eye"></i>Ver</button></a> </br>   
                                                @endcan
                                                @can('persona-edit')
                                                <a href="{{ route('admin.personas.edit', $persona->id) }}"><button class="btn btn-warning mb-2 btn-sm"><i class="fa fa-fw fa-edit"></i>Editar</button></a></br> 
                                                @endcan
                                                @can('persona-delete')
                                                <form action="{{ route('admin.personas.destroy', $persona) }}" method="POST" style="display: inline" class="eliminarPersona">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-fw fa-trash"></i>Eliminar</button>
                                                </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
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


