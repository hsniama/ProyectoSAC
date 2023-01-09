@extends('layouts.auth', ['title' => 'Nueva contraseña'])

@section('content')


                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

      <p class="login-box-msg">Genera una nueva contraseña</p>
      <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="input-group mb-3">
          <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Solicitar una nueva contraseña</button>
          </div>
          <!-- /.col -->
        </div>

      </form>
      


      {{-- <p class="mt-3 mb-1">
        <a href="login.html">Login</a>
      </p> --}}
                
@endsection
