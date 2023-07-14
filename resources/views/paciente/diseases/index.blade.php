@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">

                {{-- <div class="col-sm-6">
                    <h1 class="m-0">Listado de Especialidades</h1>
                </div><!-- /.col --> --}}

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


                            <div class="card-title fs-3 fw-bolder">Listado de Enfermedades</div>

                            {{-- @can('person-create') --}}
                                <div class="float-end">
                                    <a href="{{ route('paciente.diseases.create') }}" class="btn btn-success p-2"
                                        data-placement="left">
                                        {{ __('Agregar Nueva Enfermedad') }}
                                    </a>
                                </div>
                            {{-- @endcan --}}


                            <div class="table-responsive">
                                <table id="tablaDataTable"
                                    class="table table-striped table-bordered zero-configuration text-center">
                                    <thead class="thead">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombres</th>
                                            <th>Identificación</th>
                                            <th>Edad</th>
                                            <th>Fecha de Diagnóstico</th>
                                            <th>Nombre</th>
                                            <th>Fecha de Registro</th>
                                            <th>Observaciones</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                        
                                        @foreach ($diseases as $disease)
                                            <tr>
                                                <td>{{ $disease->id }}</td>
                                                <td>{{ auth()->user()->person->getFullNameAttribute() }}</td>
                                                <td>{{ auth()->user()->person->cedula }}</td>
                                                <td>{{ auth()->user()->person->getAgeAttribute() }}</td>
                                                <td>{{ $disease->created_at }}</td>
                                                <td>{{ $disease->name }}</td>
                                                <td>{{ $disease->created_at }}</td>
                                                <td>{{ $disease->observaciones }}</td>
                                                <td>
                                                    <!-- Boton Editar-->
                                                        <a href="{{ route('paciente.diseases.edit', $disease) }}"><button
                                                                class="btn btn-warning mb-2 btn-sm"><i
                                                                    class="fa fa-fw fa-edit"></i></button>
                                                        </a></br>
                                                        <form action="{{ route('paciente.diseases.destroy', $disease) }}"
                                                            method="POST" style="display: inline" class="eliminarDisease">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-fw fa-trash"></i>
                                                                </button>
                                                        </form>
                                                </td>
                                            </tr>
                                        @endforeach

                                        @foreach ($diseasesDiagnosis as $disease)
                                            <tr>
                                                <td>{{ $disease->id }}</td>
                                                <td>{{ auth()->user()->person->getFullNameAttribute() }}</td>
                                                <td>{{ auth()->user()->person->cedula }}</td>
                                                <td>{{ auth()->user()->person->getAgeAttribute() }}</td>
                                                <td>{{ $disease->created_at }}</td>
                                                <td>{{ $disease->name }}</td>
                                                <td>{{ $disease->pivot->created_at }}</td>
                                                <td>{{ $disease->pivot->notes }}</td>
                                                <td>
                                                    <!-- Boton Editar-->
                                                        <a href="{{ route('paciente.diseases.edit', $disease) }}"><button
                                                                class="btn btn-warning mb-2 btn-sm"><i
                                                                    class="fa fa-fw fa-edit"></i></button>
                                                        </a></br>
                                                        <form action="{{ route('paciente.diseases.destroy', $disease) }}"
                                                            method="POST" style="display: inline" class="eliminarDisease">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-fw fa-trash"></i>
                                                                </button>
                                                        </form>
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


@section('scripts')
<script>

        $('.eliminarDisease').submit(function(e) {

        e.preventDefault();

        Swal.fire({
            title: '¿Borrar enfermedad del sistema?',
            text: "No se podrá revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borrar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.value) {
                this.submit();
            }

        }) 
    });
</script>
@endsection