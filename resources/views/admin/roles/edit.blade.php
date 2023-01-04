
@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1 class="m-0">Editar Rol</h1>
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


                       <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                            @csrf
                            @method('PUT')

                        <div class="box box-info padding-1">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="name" class="required">Nombre del Rol</label>
                                    <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" id="name" 
                                    placeholder="Edite el nombre de rol" value="{{ old('name', $role->name) }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="permissions" class="required">Permisos</label>
                                    <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalidad' : '' }}" name="permissions[]" id="permissions" multiple>
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}" {{ $role->permissions->contains($permission->id) ? 'selected' : '' }}>
                                                {{ $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('permissions'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('permissions') }}</strong>
                                        </span>
                                    @endif
                                </div>




                            </div>

                            @can('role-edit')
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                        Actualizar Persona
                                    </button>
                                </div>
                            </div>
                            @endcan



                        </div>
                        </form>                      

                    </div> <!--card-body-->
                </div> <!--card-->
            </div> <!--col-lg-12-->
        </div> <!--row-->
      </div><!-- /.container-fluid -->
    </div><!-- /.content -->


@endsection

