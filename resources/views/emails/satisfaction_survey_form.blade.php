<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
</head>
<body>

    <div class="formbold-main-wrapper">

        <div class="formbold-form-wrapper">
            <div class="mb-4 border-b border-gray-300 pb-5">
                <h1 class="text-2xl font-bold mb-3">Encuesta de satisfacción al paciente</h1>
                <p class="parrafo">Por favor, tómese un momento para llenar esta encuesta.</p>    
            </div>
        
            <form action="{{ route('satisfaction_survey.store') }}" method="POST">
                @csrf

                <input type="number" hidden id="appointment_id" name="appointment_id" value="{{ $survey->appointment_id }}">

                <!--Pregunta 1-->
                <div class="formbold-mb-6">
                    <label for="doctor_qualification" class="formbold-form-label">
                        1. ¿Qué calificación le das al Dr. {{ App\Models\Person::find($survey->appointment->doctor_id)->getFullNameAttribute() }}?
                    </label>

                    <div class="formbold-radio-flex">
                        <div class="formbold-radio-group">
                            <input
                                type="radio"
                                id="buena"
                                name="doctor_qualification"
                                value="Buena"
                                class="{{ $errors->has('doctor_qualification') ? 'is-invalid' : '' }}"
                            >
                            <label for="buena">
                                Buena
                            </label>
                        </div>

                        <div class="formbold-radio-group">
                            <input
                                type="radio"
                                id="mala"
                                name="doctor_qualification"
                                value="Mala"
                                class="{{ $errors->has('doctor_qualification') ? 'is-invalid' : '' }}"
                            >
                            <label for="mala">
                                Mala
                            </label>
                        </div>

                        <div class="formbold-radio-group">
                            <input
                                type="radio"
                                id="regular"
                                name="doctor_qualification"
                                value="Regular"
                                class="{{ $errors->has('doctor_qualification') ? 'is-invalid' : '' }}"
                            >
                            <label for="regular">
                                Regular
                            </label>
                        </div>

                        @if ($errors->has('doctor_qualification'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('doctor_qualification') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <!--Pregunta 2-->
                <div class="formbold-mb-6">
                    <label for="satisfaction" class="formbold-form-label">
                        2. ¿Estás satisfecho con los servicios de OroMed?
                    </label>

                    <div class="formbold-radio-flex">
                        <div class="formbold-radio-group">
                            <input
                                type="radio"
                                id="si"
                                name="satisfaction"
                                value="Si"
                                class="{{ $errors->has('satisfaction') ? 'is-invalid' : '' }}"
                            >
                            <label for="si">
                                Si
                            </label>
                        </div>

                        <div class="formbold-radio-group">
                            <input
                                type="radio"
                                id="no"
                                name="satisfaction"
                                value="No"
                                class="{{ $errors->has('satisfaction') ? 'is-invalid' : '' }}"
                            >
                            <label for="no">
                                No
                            </label>
                        </div>

                        <div class="formbold-radio-group">
                            <input
                                type="radio"
                                id="talvez"
                                name="satisfaction"
                                value="Tal vez"
                                class="{{ $errors->has('satisfaction') ? 'is-invalid' : '' }}"
                            >
                            <label for="talvez">
                                Mas o menos
                            </label>
                        </div>

                        @if ($errors->has('satisfaction'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('satisfaction') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <!--Pregunta 3-->
                <div class="formbold-mb-3">
                    <label for="recommendation" class="formbold-form-label">
                    3. ¿Cómo podemos mejorar nuestro servicio? (Opcional)
                    </label>
                    <textarea
                    rows="4"
                    name="recommendation"
                    id="recommendation"
                    class="formbold-form-input"
                    >
                    </textarea>
                </div>



                <button type="submit" class="formbold-btn">Enviar Feedback</button>
            </form>
        </div>
    </div>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }
  body {
    font-family: 'Inter', sans-serif;
  }
  .formbold-main-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 8px;
  }

  .formbold-form-wrapper {
    margin: 0 auto;
    max-width: 570px;
    width: 100%;
    background: white;
    padding: 15px 40px;
  }

  /* .formbold-img {
    display: block;
    margin: 0 auto 40px;
  } */

  .parrafo{
    margin-top: 15px;
    margin-bottom: 15px
  }

  .formbold-form-input {
    width: 100%;
    padding: 13px 22px;
    border-radius: 5px;
    border: 1px solid #dde3ec;
    background: #ffffff;
    font-weight: 500;
    font-size: 16px;
    color: #536387;
    outline: none;
    resize: none;
  }
  .formbold-form-input:focus {
    border-color: #6a64f1;
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }
  .formbold-form-label {
    color: #07074d;
    font-weight: 500;
    font-size: 14px;
    line-height: 24px;
    display: block;
    margin-bottom: 20px;
  }
  .formbold-form-label span {
    color: #536387;
    font-size: 12px;
    line-height: 18px;
    display: inline-block;
  }

  .formbold-mb-3 {
    margin-bottom: 15px;
  }
  .formbold-mb-6 {
    margin-bottom: 30px;
  }
  .formbold-radio-flex {
    display: flex;
    flex-direction: column;
    gap: 10px;
  }
  .formbold-radio-label {
    font-size: 14px;
    line-height: 24px;
    color: #07074d;
    position: relative;
    padding-left: 25px;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
  .formbold-input-radio {
    position: absolute;
    opacity: 0;
    cursor: pointer;
  }
  .formbold-radio-checkmark {
    position: absolute;
    top: -1px;
    left: 0;
    height: 18px;
    width: 18px;
    background-color: #ffffff;
    border: 1px solid #dde3ec;
    border-radius: 50%;
  }
  .formbold-radio-label
    .formbold-input-radio:checked
    ~ .formbold-radio-checkmark {
    background-color: #6a64f1;
  }
  .formbold-radio-checkmark:after {
    content: '';
    position: absolute;
    display: none;
  }

  .formbold-radio-label
    .formbold-input-radio:checked
    ~ .formbold-radio-checkmark:after {
    display: block;
  }

  .formbold-radio-label .formbold-radio-checkmark:after {
    top: 50%;
    left: 50%;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #ffffff;
    transform: translate(-50%, -50%);
  }

  .formbold-btn {
    text-align: center;
    width: 100%;
    font-size: 16px;
    border-radius: 5px;
    padding: 14px 25px;
    border: none;
    font-weight: 500;
    background-color: #6a64f1;
    color: white;
    cursor: pointer;
    margin-top: 25px;
  }
  .formbold-btn:hover {
    box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
  }
</style>
</body>
</html>