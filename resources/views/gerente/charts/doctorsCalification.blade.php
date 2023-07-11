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
                    
                            <div class="card-title fs-6 fw-bolder">Filtro por Doctor:</div>
                        </div>

                        <div class="row mt-3 mb-4">
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <select class="form-control" name="doctor">
                                        <option value="" disabled selected>Seleccione un Doctor:</option>
                                        @foreach ($doctors as $doctor )
                                            <option value="{{ $doctor->id }}" >{{ $doctor->person->getFullNameAttribute()}}</option>
                                        @endforeach
                                    </select>
                                    <label for="doctor">Doctor: </label>
                                </div>
                            </div>
                        </div>


                        <div class="row justify-content-center" id="chartContainer">
                            <div class="col-md-10">
                                <canvas id="doctorCalificationChart" ></canvas>
                            </div>
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
        // Obtener el elemento select del year
        const doctorSelect = document.querySelector('select[name="doctor"]');

        // Declarar una variable para almacenar el gráfico
        let myChart = null;

        //Funcion para realizar la solicitud y actualizar la grafica
        async function updateChart(){
            try{
                // Obtener el valor del año seleccionado
                const selectedDoctor = doctorSelect.value;

                // Realizar la solicitud de datos al controlador:
                const response = await fetch(`/api/doctor-calification?doctorId=${selectedDoctor}`);

                if(!response.ok){
                    throw new Error('Error al realizar la petición');
                }

                // Obtener los datos de la respuesta
                const data = await response.json();

                    console.log('recuperado');
                    console.log('data', data.labels)
                    console.log('data', data.data)
                    // Create Chart JS Line chart:

                    // Destruir el gráfico existente si está definido
                    // if (myChart) {
                    //     myChart.destroy();
                    // }

                    // const ctx = document.getElementById('doctorCalificationChart').getContext('2d');
                    // myChart = new Chart(ctx, {
                    //     type: 'pie',
                    //     data: {
                    //         labels: data.labels,
                    //         datasets: [{
                    //             label: 'Calificación',
                    //             data: data.data,
                    //             backgroundColor: [
                    //                 'rgba(255, 99, 132, 0.2)',
                    //                 'rgba(54, 162, 235, 0.2)',
                    //                 'rgba(255, 206, 86, 0.2)'

                    //             ],
                    //             borderColor: [
                    //                 'rgba(255, 99, 132, 1)',
                    //                 'rgba(54, 162, 235, 1)',
                    //                 'rgba(255, 206, 86, 1)'
                    //             ],
                    //             hoverOffset: 4
                    //         }]
                    //     },

                    // });

            } catch(error){
                console.error(error);
            }
        }

        // Escuchar el evento change del select
        doctorSelect.addEventListener('change', updateChart);

        // Llamar a la función inicialmente para mostrar la gráfica con el año por defecto
        updateChart();


        
    </script>

@endsection