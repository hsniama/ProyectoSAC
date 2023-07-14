@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          <div class="col-sm-6">
            <h1 class="m-0">Cambiar contraseña</h1>
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
                        @elseif ($message = Session::get('error'))
                            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                                  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                <div>
                                    {{ $message }}
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- <div class="card-title">Listado de usuarios</div>  --}}

                        @can('home')
                        <div class="mb-3">
                            <a href="{{ route('home') }}" class="btn btn-danger btn-sm p-2"  data-placement="left">
                                <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                {{ __('Cancelar') }}
                            </a>
                        </div>
                        @endcan 


                        <form method="POST" action="{{ route('change.password') }}" role="form" enctype="multipart/form-data">
                            @csrf

                            <div class="box box-info padding-1">
                                <div class="box-body">

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="current_password" class="required">Contraseña actual</label>
                                                    <input type="password" name="current_password" id="current_password"
                                                        class="form-control {{ $errors->has('current_password') ? 'is-invalid' : '' }}"
                                                        placeholder="Ingrese la contraseña actual" value="{{ old('current_password', '') }}" required>
                                                    @if ($errors->has('current_password'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('current_password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="new_password">Nueva contraseña</label>
                                                    <input type="password" name="new_password" id="new_password"
                                                        class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}"
                                                        placeholder="Ingrese la nueva contraseña" value="{{ old('new_password', '') }}"
                                                        required>
                                                    @if ($errors->has('new_password'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('new_password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="new_password_confirmation">Confirmar nueva contraseña</label>
                                                    <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                                        class="form-control {{ $errors->has('new_password_confirmation') ? 'is-invalid' : '' }}"
                                                        placeholder="Confirme la nueva contraseña" value="{{ old('new_password_confirmation', '') }}"
                                                        required>
                                                    @if ($errors->has('new_password_confirmation'))
                                                        <span class="text-danger">
                                                            <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                </div> <!--box-body-->
                                                            
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-fw fa-lg fa-check-circle"></i>
                                            Cambiar contraseña
                                        </button>
                                    </div>
                                </div>
                            
                            </div>
                        </form>


                    </div> <!--card-body-->
                </div> <!--card-->
            </div> <!--col-lg-12-->
        </div> <!--row-->
      </div><!-- /.container-fluid -->
    </div><!-- /.content -->

@endsection
