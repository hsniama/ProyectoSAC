<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creedenciales</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>


        @page {
            size: A4 portrait;
            margin: 0;
        }

        @media print {
            html,
            body {
                width: 210mm;
                height: 297mm;
            }
        }

        .container{
          position: relative;
        }

        .header{
          border-bottom: 4px solid cornflowerblue;
          padding-bottom: 10px
        }

        .miTabla{
          font-size: 12px;
        }

        .ultimoBorde{
          border-bottom: 4px solid cornflowerblue;
          margin-right: 30px
        }

        .pie{
          position: absolute;
          bottom: 20;
          width: 100%;
        }
      
    </style>

</head>

<body>


    <div class="container">

      <header class="header mb-4">
        <div class="row text-center">
          <h2>Hospital <span class="font-weight-bold text-primary">OroMed</span> </h2>
          <h5 class="">Citas Médicas</h5>
        </div>
      </header>

      <main>
        <div class="row mb-2">
          <p class="mb-0"> <span class="font-weight-bold">Cédula:</span> {{ Auth::user()->person->cedula }} </p>
          <p><span class="font-weight-bold">Paciente:</span> <span class="text-uppercase"> {{ Auth::user()->person->getFullNameAttribute() }}</span></p>
        </div>
      </main>

        <div class="row mb-2 text-center">
            <p>Detalle de Citas Médicas Pendientes</p>
        </div>

        <div class="row">
            <table class="table text-center table-bordered table-sm miTabla">
                <thead class="">
                    <tr class="table-primary">
                        <th scope="col">Unidad Médica</th>
                        <th scope="col">Especialidad</th>
                        <th scope="col">Médico</th>
                        <th scope="col">Fecha de la cita</th>
                        <th scope="col">Hora de la cita</th>
                        <th scope="col">Dirección</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($appointments as $a)
                    <tr class="fs-6">
                      <td>Hospital el Oro</td>
											<td class="text-uppercase">{{ App\Models\Speciality::find($a->speciality_id)->name }}</td>
                      <td class="text-uppercase text-start">{{ $a->doctor->getFullNameAttribute()}}</td>
                      <td>{{ $a->scheduled_date }}</td>
                      <td>{{ $a->getScheduledTimeAttribute($a->scheduled_time) }}</td>
                      <td class="text-start"><p>Av. 10 de Agosto y Av. 6 de Diciembre</p></td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>


        <footer class="pie">
          <div class="row">
            <div class="ultimoBorde"></div>
            <p class="text-left pt-4 font-weight-bold"> {{ $fecha }}</p>
          </div>

          <div class="row text-center">
            <p class="font-italic text-secondary">www.hospitaloromed.com</p>
          </div>
        </footer>



    </div>





    {{-- <div class="card-footer bg-black">
    <p class="text-center">Siguenos en: </p>
  </div> --}}

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

</body>

</html>
