@extends('layouts.admin')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="col-lg-12">

                @if (session('notificacion'))
                    <div class="alert alert-success alert-dismissible mt-2">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> {{ session('notificacion') }}</h5>
                        Confirmamos que su cita médica ha sido agendada para el día {{ $appointment->scheduled_date }} a las {{ $appointment->scheduled_time }} 
                        en la unidad Medica HOSPITAL EL ORO con el Dr. <span class="uppercase">{{ $appointment->doctor->getFullNameAttribute() }}</span>  en el area de <span class="uppercase">{{ $appointment->speciality->name }}</span> .
                    </div>                               
                @endif




                <div class="card card-cyan mt-3">

                    <div class="card-header"> 
                        <h6 class="card-title">Resumen de la Cita Médica</h6> 
                    </div>

                    <div class="card-body">

                        <dl class="row">
                        <dt class="col-sm-4">Fecha de Registro: </dt>
                        <dd class="col-sm-8">{{ $appointment->created_at }}</dd>
                        <dt class="col-sm-4">Hora de la cita: </dt>
                        <dd class="col-sm-8">{{ $appointment->scheduled_time }}</dd>
                        {{-- <dd class="col-sm-8 offset-sm-4">Donec id elit non mi porta gravida at eget metus.</dd> --}}
                        <dt class="col-sm-4">Médico</dt>
                        <dd class="col-sm-8">{{$appointment->doctor->getFullNameAttribute() }}</dd>    
                        <dt class="col-sm-4">Especialidad</dt>
                        <dd class="col-sm-8">{{ $appointment->speciality->name }}</dd>
                        </dl>
                    </div>

                    <div class="row p-3">
                        <p>
                            Estimado Sr/Sra. <span class="uppercase">{{ $appointment->patient->getFullNameAttribute() }}</span> .
                        </p>
                        <p>
                            Confirmamos que su cita médica ha sido agendada para el día {{ $appointment->scheduled_date }} a las {{ $appointment->scheduled_time }} 
                            en la unidad Medica HOSPITAL EL ORO con el Dr. <span class="uppercase">{{ $appointment->doctor->getFullNameAttribute() }}</span>  en el area de <span class="uppercase">{{ $appointment->speciality->name }}</span>.
                        </p>
                        <p>
                            El formato de la atención médica es PRESENCIAL, por lo que se le solicita presentarse con 15 minutos de anticipación a la hora de su cita.
                        </p>
                        <p>
                            En caso de no poder asistir sírvase en cancelar la cita médica hasta con 1 dia de anticipación en esta misma página o comuníquese con nosotros al teléfono 02 1234567.
                        </p>
                    </div>


                    <div class="row p-3">
                        <div class="col-2 text-left">
                            <a type="button" class="btn btn-block btn-primary" href="{{ route("home") }}">Finalizar</a>
                        </div>
                    </div>
                        


                </div> <!--card-body-->
        </div> <!--card-->

        </div>


    </section>


</section>

@endsection