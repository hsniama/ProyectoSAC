{{-- @extends('layouts.app') --}}
@extends('layouts.auth', ['title' => 'Registro'])

@section('content')

      <p class="login-box-msg h3">Crea una Cuenta!</p>

      @if ($errors->any())

        <div class="alert alert-danger text-center" role="alert">
            {{ $errors->first()  }}
        </div>

      @else

        <div class="text-center text-muted mb-4">
          <small>Ingrese sus datos para registrarse</small>
        </div>

      @endif


      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="input-group mb-3">
          <input id="cedula" type="number" class="form-control @error('cedula') is-invalid @enderror" name="cedula" value="{{ old('cedula') }}"  autocomplete="cedula" autofocus placeholder="Escribe tu cedula">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          {{-- @error('cedula')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror --}}
        </div>
        
        <div class="input-group mb-3">
          <input id="nombres" type="text" class="form-control @error('nombres') is-invalid @enderror" name="nombres" value="{{ old('nombres') }}"  autocomplete="nombres" autofocus placeholder="Escribe tus nombres completos">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          {{-- @error('nombres')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror --}}
        </div>

        <div class="input-group mb-3">
          <input id="apellidos" type="text" class="form-control @error('apellidos') is-invalid @enderror" name="apellidos" value="{{ old('apellidos') }}"  autocomplete="apellidos" autofocus placeholder="Escribe tus apellidos completos">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          {{-- @error('apellidos')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror --}}
        </div>

        <div class="input-group mb-3">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus placeholder="pepito@gmail.com">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          {{-- @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror --}}
        </div>

        <div class="input-group mb-3">
          <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  autocomplete="username" placeholder="Escribe un username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          {{-- @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror --}}
        </div>



        <div class="row mb-3 d-block">
          <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="">
            <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
          </div>
          <!-- /.col -->
        </div>

      </form>



      <div class="d-flex justify-content-center">
        <p class="">
            <a href="{{ route('login') }}" class="text-decoration-none">¿Ya Tienes una cuenta? ¡Inicia Sesión!</a>
        </p>
      </div>



@endsection
