@extends('layouts.admin')


@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">

          {{-- <div class="col-sm-6">
            <h1 class="m-0">Lista de Citas totales independientemente de su estado</h1>
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

                        <div class="row">
                            @if ($message = Session::get('success'))               
                                <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
                                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                    <div>
                                        {{ $message }}
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                    
                            <div class="card-title fs-3 fw-bolder">Cantidad de Enfermedades diagnosticadas por Año</div>

                        </div>

                        <div class="row mt-3 mb-4">
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <select class="form-control" name="yearEnfermedad">
                                        <option value="" disabled selected>Seleccione una año</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}"  @if ($year == date('Y')) selected @endif>{{ $year}}</option>
                                        @endforeach
                                    </select>
                                    <label for="yearEnfermedad">Año: </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row ">
                                    <div class="col">
                                        <button id="filtrar" class="btn btn-danger ">Filtrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table id="citasTablaEnfermedades" class="table table-bordered table-hover text-center">
                                <thead class="thead">
                                    <tr>
                                        {{-- <th>ID</th> --}}
                                        <th>Enfermedad</th>
                                        <th>Cantidad de Pacientes</th>
                                    </tr>
                                </thead>
                                <tbody>
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

@section('scripts')
<script>

    $(document).ready(function() {

        $('#citasTablaEnfermedades').DataTable({
            searching: true,
            ordering: false,
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "{{ route('gerente.enfermedades') }}",
                data: function (d) {
                    d.yearEnfermedad = $('select[name="yearEnfermedad"]').val();
                }
            },
            dataType: 'json',
            type: 'POST',
            columns: [
                {
                    data: 'enfermedad', name: 'enfermedad'
                },
                {
                    data: 'cantidad', name: 'cantidad'
                },
            ],

            scrollY : 300,

            dom: 'Bfrtip',
            buttons: 
            [
                {
                    extend: 'copy',
                    text: 'Copiar',
                    className: 'btn-secondary'
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    },
                    text: 'Excel',
                    className: 'btn-success'
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible'
                    },
                    text: 'CSV',  
                    className: 'btn-primary'
                },
                {
                    extend: 'pdf',
                    messageBottom: "Impreso el " + new Date().toLocaleDateString() + " a las " + new Date().toLocaleTimeString(),
                    exportOptions: {
                        columns: ':visible'
                    },
                    text: 'PDF',
                    className: 'btn-danger'
                },
                {
                    extend: 'print',
                    messageBottom: "Impreso el " + new Date().toLocaleDateString() + " a las " + new Date().toLocaleTimeString(),
                    text: 'Imprimir',
                    exportOptions: {
                        columns: ':visible'
                    },
                    className: 'btn-info'
                },
                ,
                { 
                    extend: 'spacer',
                    style : 'bar'
                },
                {
                    extend: 'colvis',
                    text: 'Escoger Columnas',
                    className: 'btn-warning'
                },
            ],
        });

        $('#filtrar').click(function(){
            $('#citasTablaEnfermedades').DataTable().draw();
        });

});  
</script>
@endsection