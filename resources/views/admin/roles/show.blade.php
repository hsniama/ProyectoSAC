
@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1 class="m-0">Informacion completa del Rol: {{ $role->name}}</h1>
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

                        @can('role-list')
                        <div class="mb-3">
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-danger btn-sm p-2"  data-placement="left">
                                <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                {{ __('Volver al listado') }}
                            </a>
                        </div>
                        @endcan



                        <div class="box box-info padding-1">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="name" class="required">Nombre del Rol</label>
                                    <input type="text" class="form-control" id="name" disabled
                                           value="{{ $role->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="permissions" class="required">Permisos</label>
                                    <select class="form-control select2" id="permissions" multiple disabled>
                                        @foreach ($rolePermissions as $permission)
                                            <option value="{{ $permission->id }}" {{ $role->permissions->contains($permission->id) ? 'selected' : '' }}>
                                                {{ $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="created_at" class="required">Fecha de creación</label>
                                    <input type="text" class="form-control" id="created_at" disabled
                                           value="{{ $role->created_at}}">                                       
                                </div>

                                <div class="form-group">
                                    <label for="updated_at" class="required">Fecha de actualización</label>
                                    <input type="text" class="form-control" id="updated_at" disabled
                                           value="{{$role->updated_at}}">
                                </div>

                                <div class="form-group">
                                    <label for="guard_name" class="required">Acceso via: </label>
                                    <input type="text" class="form-control" id="guard_name" disabled
                                           value="{{$role->guard_name}}">
                                </div>

                            </div>

                        </div>



                    </div> <!--card-body-->
                </div> <!--card-->
            </div> <!--col-lg-12-->
        </div> <!--row-->
      </div><!-- /.container-fluid -->
    </div><!-- /.content -->


@endsection


