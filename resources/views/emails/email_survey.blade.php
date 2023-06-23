{{-- <x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message> --}}

<h1>Llena tu encuesta de satisfacción</h1>

<p>Estimado(a) {{ $diagnosis->appointment->patient->getFullNameAttribute() }},</p>

<p>
    Esperamos que se encuentre bien. En OroMed valoramos, tu opinion
    y nos esforzamos por brindarte la mejor atención médica posible. 
    Para ayudarnos a mejorar continuamente nuestros servicios, te 
    invitamos a completar una breve encuesta de satisfacción sobre la atención médica que has recibido recientemente.
</p>

<p>
    Para acceder a la encuesta, simplemente haz clic en el siguiente enlace: <a href="{{ $surveyUrl }}">Encuesta de Satisfacción.</a>
</p>

<p>
    La encuesta es completamente anónima y solo te tomará unos minutos completarla. 
    Tus respuestas serán tratadas con confidencialidad y se utilizarán únicamente para fines de evaluación interna.
</p>

<p>
    Gracias por confiar en OroMed. Valoramos tu opinión y esperamos poder seguir brindándote una atención médica excepcional en el futuro.
</p>

<p>
    Atentamente,
</p>

<p>
    OroMed
</p>