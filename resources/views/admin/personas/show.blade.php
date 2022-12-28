
@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1 class="m-0">Datos personales de: {{ $persona->apellidos . ' ' . $persona->nombres}}</h1>
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
                      
                        {{-- <div class="card-title">Listado de usuarios</div> --}}

                        <div class="mb-3">
                            <a href="{{ route('admin.personas.index') }}" class="btn btn-danger btn-sm p-2"  data-placement="left">
                                <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                {{ __('Volver al listado') }}
                            </a>
                        </div>


                        <div class="table-responsive">
                            <table id="personas_table" class="table table-striped table-bordered zero-configuration">
                                <thead class="thead">
                                    <tr>
                                        {{-- <th>No</th> --}}
                                        
										<th>User Id</th>
                                        <th>Username</th>
										<th>Cedula</th>
										<th>Apellidos</th>
										<th>Nombres</th>
										<th>Email</th>
										<th>Telefono</th>
										<th>Direccion</th>
										<th>Ciudad</th>
										<th>Fecha Nacimiento</th>
										<th>Genero</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            {{-- <td>{{ ++$i }}</td> --}}                                           
											<td>{{ $persona->user_id }}</td>
											<td>{{ $persona->user->username }}</td>
											<td>{{ $persona->cedula }}</td>
											<td>{{ $persona->apellidos }}</td>
											<td>{{ $persona->nombres }}</td>
											<td>{{ $persona->email }}</td>
											<td>{{ $persona->telefono }}</td>
											<td>{{ $persona->direccion }}</td>
											<td>{{ $persona->ciudad }}</td>
											<td>{{ $persona->fecha_nacimiento }}</td>
											<td>{{ $persona->genero }}</td>
                                        </tr>
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


