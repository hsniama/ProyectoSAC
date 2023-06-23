{{-- <x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message> --}}

{{-- <x-mail::message> --}}
    <h1>¡Confirmación de Cita!</h1>

    <p>Estimado(a) {{ $appointment->patient->getFullNameAttribute() }},</p>

    <p>Te informamos que tu cita médica ha sido agendada en el Hospital OroMed.</p>

    <table>
        <tr>
            <th>Nombre del Paciente:</th>
            <td>{{ $appointment->patient->getFullNameAttribute() }}</td>
        </tr>
        <tr>
            <th>Cédula:</th>
            <td>{{ $appointment->patient->cedula }}</td>
        </tr>
        <tr>
            <th>Médico:</th>
            <td>{{ $appointment->doctor->getFullNameAttribute() }}</td>
        </tr>
        <tr>
            <th>Especialidad:</th>
            <td>{{ $appointment->speciality_id }}</td>
        </tr>
        <tr>
            <th>Hora de la Cita:</th>
            <td>{{ $appointment->scheduled_time }}</td>
        </tr>
        <tr>
            <th>Fecha de la Cita:</th>
            <td>{{ $appointment->scheduled_date }}</td>
        </tr>
    </table>

    <p>Por favor, asegúrate de llegar al hospital al menos 15 minutos antes de la hora programada.</p>

    <p>¡Gracias y te esperamos en el Hospital OroMed!</p>
{{-- </x-mail::message> --}}
