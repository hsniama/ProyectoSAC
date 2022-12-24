@extends('layouts.app')

@section('template_title')
    {{ $persona->name ?? 'Show Persona' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Persona</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('personas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $persona->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Cedula:</strong>
                            {{ $persona->cedula }}
                        </div>
                        <div class="form-group">
                            <strong>Apellidos:</strong>
                            {{ $persona->apellidos }}
                        </div>
                        <div class="form-group">
                            <strong>Nombres:</strong>
                            {{ $persona->nombres }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $persona->email }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $persona->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $persona->direccion }}
                        </div>
                        <div class="form-group">
                            <strong>Ciudad:</strong>
                            {{ $persona->ciudad }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha Nacimiento:</strong>
                            {{ $persona->fecha_nacimiento }}
                        </div>
                        <div class="form-group">
                            <strong>Genero:</strong>
                            {{ $persona->genero }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
