@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">

          {{-- <div class="col-sm-6">
            <h1 class="m-0">Listado de Roles</h1>
          </div><!-- /.col -->  --}}

            {{-- @can('role-create')
                <div class="">
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-success p-2"  data-placement="left">
                        Agregar nuevo Rol
                    </a>
                </div> 
            @endcan --}}


        </div>
      </div>
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

                        
                        <div class="card-title fs-3 fw-bolder">Listado de usuarios</div>
                            @can('role-create')
                            <div class="mb-3 float-end">
                                <a href="{{ route('admin.roles.create') }}" class="btn btn-success p-2"  data-placement="right">
                                    Agregar nuevo Rol
                                </a>
                            </div> 
                            @endcan


                        <div class="table-responsive">
                            <table id="tablaDataTable" class="table table-striped table-bordered zero-configuration text-center">
                                <thead class="thead">
                                    <tr>                                     
										<th>Id</th>
										<th>Nombre</th>
                                        <th>Permisos</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $rol)
                                        <tr>
											<td>{{ $rol->id}}</td>
                                            <td>
                                            @if ($rol->name == 'admin' || $rol->name == 'super-admin')
                                                <span class="badge bg-danger fs-6 mb-1">{{ $rol->name  }}</span> </br>
                                            @elseif ($rol->name == 'gerente')
                                                <span class="badge bg-warning fs-6 mb-1">{{ $rol->name  }}</span> </br>                            
                                            @elseif ($rol->name == 'secretaria')
                                                <span class="badge bg-primary fs-6 mb-1">{{ $rol->name }}</span> </br>
                                            @elseif ($rol->name == 'doctor')
                                                <span class="badge bg-success fs-6 mb-1">{{ $rol->name  }}</span> </br>                            
                                            @elseif ($rol->name == 'paciente')
                                                <span class="badge bg-cyan fs-6 mb-1">{{ $rol->name  }}</span> </br>
                                            @else
                                                <span class="badge bg-secondary fs-6 mb-1">{{ $rol->name  }}</span> </br>
                                            @endif
											</td>
                                            <td class="text-start">
                                                @if(!empty($rol->permissions))

                                                    @if ($rol->name == 'super-admin')
                                                        <label class="badge badge-danger">Tiene todos los permisos</label>                                                    
                                                    @endif

                                                    @foreach($rol->permissions as $v)
                                                        <label class="badge badge-dark">{{ $v->name }},</label>
                                                    @endforeach
                                                @endif
                                            </td>

                                            <td>
                                                @can('role-show')
                                                <a href="{{ route('admin.roles.show', $rol->id) }}"><button class="btn btn-info mb-2 btn-sm"><i class="fa fa-fw fa-eye"></i></button></a>  
                                                @endcan
                                                @can('role-edit')
                                                <a href="{{ route('admin.roles.edit', $rol->id) }}"><button class="btn btn-warning mb-2 btn-sm"><i class="fa fa-fw fa-edit"></i></button></a>                                                   
                                                @endcan
                                                @can('role-delete')
                                                <form action="{{ route('admin.roles.destroy', $rol) }}" method="POST" style="display: inline" class="eliminarRol">
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
                        </div>



                    </div> <!--card-body-->
                </div> <!--card-->
            </div> <!--col-lg-12-->
        </div> <!--row-->
      </div><!-- /.container-fluid -->
    </div><!-- /.content -->


@endsection



