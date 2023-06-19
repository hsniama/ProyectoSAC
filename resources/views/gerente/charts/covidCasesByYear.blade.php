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
                    
                            <div class="card-title fs-6 fw-bolder">Filtro por Año:</div>
                            {{-- @can('appointment-create')
                                <div class="mb-3 float-end">
                                    <a href="{{ route('admin.appointments.create') }}" class="btn btn-success p-2"  data-placement="left">
                                        {{ __('Agendar Nueva Cita') }}
                                    </a>
                                </div>
                            @endcan --}}
                        </div>

                        <div class="row mt-3 mb-4">
                            <div class="col-md-2">
                                <div class="form-floating">
                                    <select class="form-control" name="covidYear">
                                        <option value="" disabled selected>Seleccione una año</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}"  @if ($year == date('Y')) selected @endif>{{ $year}}</option>
                                        @endforeach
                                    </select>
                                    <label for="covidYear">Año: </label>
                                </div>
                            </div>
                        </div>


                        <div class="row justify-content-center" id="chartContainer">
                            <div class="col-md-10">
                                <canvas id="covidCasesByYear" ></canvas>
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
        const yearSelect = document.querySelector('select[name="covidYear"]');

        // Declarar una variable para almacenar el gráfico
        let myChart = null;

        //Funcion para realizar la solicitud y actualizar la grafica
        async function updateChart(){
            try{
                // Obtener el valor del año seleccionado
                const selectedYear = yearSelect.value;

                // Realizar la solicitud de datos al controlador:
                const response = await fetch(`/api/covid-chart/data-year?year=${selectedYear}`);

                if(!response.ok){
                    throw new Error('Error al realizar la petición');
                }

                // Obtener los datos de la respuesta
                const data = await response.json();
                    // console.log('recuperado');
                    // console.log('data', data)
                    // Create Chart JS Line chart:

                    // Destruir el gráfico existente si está definido
                    if (myChart) {
                        myChart.destroy();
                    }

                    const ctx = document.getElementById('covidCasesByYear').getContext('2d');
                    myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: data.months,
                            datasets: [{
                                label: 'Casos',
                                data: data.cases,
                                borderColor: 'rgb(75, 192, 192)',
                                // fill: false,
                                // tension: 0.1
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                pointStyle: 'circle',
                                pointRadius: 10,
                                pointHoverRadius: 15,
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        precision: 0, //Muestra los valores enteros
                                        stepSize: 1, //Muestra valores de 1 en 1 en el eje Y
                                        font: {
                                            size: 20 // Tamaño de letra en el eje X
                                        }
                                    },
                                },
                                x: {
                                    ticks: {
                                        font: {
                                            size: 25 // Tamaño de letra en el eje X
                                        }
                                    },
                                }
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: `Cantidad de casos de COVID-19 en el año ${selectedYear}`,
                                    font: {
                                        size: 25, // Tamaño de letra en el eje X
                                        weight: 'bold'
                                    }
                                },
                                legend: {
                                    labels: {
                                        font: {
                                            size: 20 // Tamaño de letra en el eje X
                                        }
                                    }
                                }
                            }
                        }
                    });
            } catch(error){
                console.error(error);
            }
        }

        // Escuchar el evento change del select
        yearSelect.addEventListener('change', updateChart);

        // Llamar a la función inicialmente para mostrar la gráfica con el año por defecto
        updateChart();


        
    </script>

@endsection