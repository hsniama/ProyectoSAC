<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creedenciales</title>

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

      <style>

        @page {
            size: A4 portrait;
            margin: 0;
        }
        @media print {
            html, body {
                width: 210mm;
                height: 297mm;
            }
        }
    </style>

</head>
<body>


  <div class="container">

    <div class="row mb-5 ml-1">
        <p><span class="font-weight-bold">Fecha:</span>  {{ $fecha }}</p>
    </div>

    {{-- <div class="row">
      <div class="col-xl-12">
        <i class="fa-regular fa-hospital"></i>
      </div>
    </div> --}}


    <div class="row mb-5">

      <div class="col-12">
        <ul class="list-unstyled float-end">
          <li> <h3 class="text-danger">Sistema de Atención Médica y Control </h3> </li>
          <li>El Oro, Machala</li>
          <li>Call Center: 0986824705</li>
          <li>sac@mail.com</li>
        </ul>
      </div>

    </div>

    <div class="row text-center mb-5">
      <h4 class="text-uppercase text-center mt-3">Creedenciales de acceso</h4>
    </div>

      <div class="row mt-2 mb-5">
        <p>Hola, <span class="font-weight-bold">{{ $nombres }}</span> tenga un cordial saludo por parte del 
        Hospital El Oro. A continuación, se detallan sus creedenciales para que ingrese a nuestro Sistema 
        de Atención Médica y Control SAC.
      </p>

      </div>

      <div class="row mx-3">
        <table class="table text-center">
          <thead>
            <tr>
              <th scope="col">Username</th>
              <th scope="col">Contraseña</th>
            </tr>
          </thead>
          <tbody>
            <tr scope="row">
              <td>{{ $username }}</td>
              <td>{{ $password }}</td>
            </tr>
          </tbody>
        </table>
      </div>

      {{-- <hr> --}}

      <div class="row mt-5 mb-5">
        <p>Una vez ingrese al sistema se le pedirá que cambie la contraseña por una de su preferencia.</p>
      </div>

      <div class="row mt-5 mb-5">
        <p class="text-center font-italic">Gracias por usar nuestros servicios.</p>
      </div>

      <br>
      <br>
      <br>
      <br>

      <div>
        <p class="text-center">_______________________________</p>
        <p class="text-center">Secretaria: {{ Auth::user()->persona->nombres .' '. Auth::user()->persona->apellidos  }}</p>
      </div> 
      
      <br>
      <br>
      <br>
      <br>
      <br>

      <div class="row mt-5">
        <p><span class="font-weight-bold font-italic">Nota: </span> 
          No entregue a nadie esta hoja ya que contiene sus creedenciales para el acceso al sistema.  </p>
      </div>

  </div>





  {{-- <div class="card-footer bg-black">
    <p class="text-center">Siguenos en: </p>
  </div> --}}

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>