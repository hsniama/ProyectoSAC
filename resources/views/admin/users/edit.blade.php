
@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1 class="m-0">Editar Usuario</h1>
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

                        @can('user-list')
                        <div class="mb-3">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-danger btn-sm p-2"  data-placement="left">
                                <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                {{ __('Volver al listado') }}
                            </a>
                        </div>
                        @endcan


                        <form method="POST" action="{{ route('admin.users.update', $user->id) }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                        <div class="box box-info padding-1">

                            <div class="box-body">

                                <div class="form-group">
                                    <label for="email" class="required">Correo</label>
                                    <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" 
                                        autofocus placeholder="Ingrese el Email del nuevo usuario" 
                                        value="{{ old('email', $user->email) }}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="form-group">
                                    <label for="username" class="required">Username</label>
                                    <input type="text" name="username" id="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : ''}}" 
                                        placeholder="Edite el Username" 
                                        value="{{ old('username', $user->username) }}">
                                    @if ($errors->has('username'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="roles" class="required">Roles</label>
                                    <select name="roles[]" id="roles" class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : ''}}" multiple>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->roles->pluck('id')->contains($role->id) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('roles'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('roles') }}</strong>
                                        </span>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <label for="password" class="required">Contraseña </label>
                                    <input type="password" name="password" id="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" 
                                        placeholder="Ingrese la nueva contraseña del usuario.">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password-confirmation" class="required">Repita la Contraseña </label>
                                    <input type="password" name="password_confirmation" id="password-confirmation" 
                                        class="form-control" placeholder="Repita la nueva contraseña del usuario">
                                </div>
                            
                            </div>

                            @can('user-edit')
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                        Actualizar Usuario
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

