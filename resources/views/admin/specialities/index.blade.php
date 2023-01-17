@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1 class="m-0">Listado de Especialidades</h1>
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
                                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show"
                                    role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img"
                                        aria-label="Success:">
                                        <use xlink:href="#check-circle-fill" />
                                    </svg>
                                    <div>
                                        {{ $message }}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif


                            {{-- <div class="card-title">Listado de usuarios</div> --}}

                            @can('persona-create')
                                <div class="mb-3">
                                    <a href="{{ route('admin.specialities.create') }}" class="btn btn-success p-2"
                                        data-placement="left">
                                        {{ __('Agregar Nueva Especialidad') }}
                                    </a>
                                </div>
                            @endcan


                            <div class="table-responsive">
                                <table id="especialidades_table"
                                    class="table table-striped table-bordered zero-configuration text-center">
                                    <thead class="thead">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Estado</th>
                                            <th>Creado por</th>
                                            <th>Actualizado por</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($specialities as $especialidad)
                                            <tr>
                                                <td>{{ $especialidad->id }}</td>
                                                <td>{{ $especialidad->name }}</td>
                                                <td>{{ $especialidad->description }}</td>
                                                <td>{{ $especialidad->status }}</td>
                                                <td>{{ $especialidad->created_by }}</td>
                                                <td>{{ $especialidad->updated_by }}</td>

                                                <td>
                                                    {{-- @can('especialidad-show')
                                                        <a href="{{ route('admin.specialities.show', $especialidad->id) }}">
                                                            <button
                                                                class="btn btn-info mb-2 btn-sm"><i class="fa fa-fw fa-eye"></i></button></a> </br>
                                                    @endcan --}}
                                                    @can('especialidad-edit')
                                                        <a href="{{ route('admin.specialities.edit', $especialidad->id) }}"><button
                                                                class="btn btn-warning mb-2 btn-sm"><i
                                                                    class="fa fa-fw fa-edit"></i></button></a></br>
                                                    @endcan
                                                    @can('especialidad-delete')
                                                        <form action="{{ route('admin.specialities.destroy', $especialidad) }}"
                                                            method="POST" style="display: inline" class="eliminarEspecialidad">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button class="btn btn-danger btn-sm" type="submit"><i
                                                                    class="fa fa-fw fa-trash"></i></button>
                                                        </form>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>



                        </div>
                        <!--card-body-->
                    </div>
                    <!--card-->
                </div>
                <!--col-lg-12-->
            </div>
            <!--row-->
        </div><!-- /.container-fluid -->
    </div><!-- /.content -->
@endsection
