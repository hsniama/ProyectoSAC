@extends('layouts.auth', ['title' => 'Verifica tu correo.'])

@section('content')

      <p class="login-box-msg h3">Verificación de correo y envio de creendenciales</p>

        <div class="card-body text-center">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('Se envió un nuevo correo.') }}
                </div>
            @endif

            {{ __('Se envió un correo con las creedenciales para ingresar al sistema.') }}
            <br> <br>
            {{ __('Si no recibe el correo') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click aqui para reenviarlo') }}</button>.
            </form>
        </div>

@endsection
