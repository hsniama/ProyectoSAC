{{-- @extends('layouts.app') --}}
@extends('layouts.auth', ['title' => 'Login'])	

@section('content')


      <p class="login-box-msg h3">Inicia sesión</p>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="input-group mb-3">
          <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Escribe tu Usuario" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa-solid fa-user"></span>
            </div>
          </div>
          @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>

        <div class="input-group mb-3">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Digita tu Password" name="password" required autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>


        <div class="row mb-3">

          <div class="col-6">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">
                {{ __('Recordarme') }}
              </label>
            </div>
          </div>

        </div>

        <div class="row mb-3 d-block">
          <!-- /.col -->
          <div class="">
            <button type="submit" class="btn btn-primary btn-block">{{ __('Login') }}</button>
          </div>

          <!-- /.col -->
        </div>


      </form>

      {{-- <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> --}}
      <!-- /.social-auth-links -->

      {{-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      --}}

      <div class="row d-flex justify-content-center">
        <p class="">
            <a href="{{ route('register') }}" class="text-decoration-none">¿No tienes una cuenta? ¡Registrate Aquí!</a>
        </p> 
      </div>

       <div class="row d-flex justify-content-center">
            <p class="mb-0">
                @if (Route::has('password.request'))
                    <a class="text-decoration-none" href="{{ route('password.request') }}">
                        {{ __('¿Olvidaste la contraseña?') }}
                    </a>
                @endif
            </p>
       </div>

@endsection
