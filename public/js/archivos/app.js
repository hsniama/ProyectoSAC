$('#miSpinner').hide();

let $fechaCita = $(".fechaCita");
$fechaCita.hide();
let $horasDisponiblesDoctor = $('.horasDisponiblesDoctor');
$horasDisponiblesDoctor.hide();
let $doctorBox = $('.doctorBox');
$doctorBox.hide();

let $speciality, $date, $doctor, iRadio;
let $hoursMorning, $hoursAfternoon, $titleMorning, $titleAfternoon, $hoursAvailable;
// const titleMorning = `En la mañana`;
// const titleAfternoon = `En la tarde`;
const noHours = `<input type="text" disabled id="noHoursAvailable" class="text-danger border-0 bg-white" value="No hay horas disponibles.">`;


// Multi-Step Form
    function nextTab(e, tabName) {
        e.preventDefault();
        // check if all form fields in the current tab are filled out 
        // before switching to the next tab
        if(validateCurrentTab()) {
            $('[href="#' + tabName + '"]').tab('show');
        }
    }

    function prevTab(e, tabName) {
        e.preventDefault();
        $('[href="#' + tabName + '"]').tab('show');
    }

    function validateCurrentTab() {
        // Select all input fields in the current tab excepto password y confirm password
        var inputs = $('.tab-content .tab-pane.active input:not([type="password"])');
        for(var i = 0; i < inputs.length; i++) {
            // Check if any of the fields are empty

            if(!inputs[i].value ) {
                // If a field is empty, show an error message and return false
                Swal.fire({
                    icon: 'warning',
                    title: 'Datos incompletos',
                    text: 'Porfavor llena todos los campos antes de avanzar al siguiente paso.',
                })

                return false;
            }

            if(inputs[i].value == "No hay horas disponibles."){
                // If a field is empty, show an error message and return false
                Swal.fire({
                    icon: 'error',
                    title: 'No hay citas disponibles',
                    text: 'Lo sentimos, busca otro doctor/especialidad o intenta otro diá.',
                })

                return false;
            }

            //check if the scheduled_time is not selected:
            if(inputs[i].name == "scheduled_time"){
                let iRButtons = document.getElementsByName("scheduled_time");
                let isChecked = false;
                for (let i = 0; i < iRButtons.length; i++) {
                    if (iRButtons[i].checked) {
                        isChecked = true;
                        break;
                    }
                }
                if (!isChecked) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No has seleccionado una hora',
                        text: 'Porfavor selecciona una hora antes de avanzar al siguiente paso.',
                    })
                    return false;
                }
            }



        }
        return true;
    }


// Cargar doctores por especialidad en crear cita.
    $(function(){
        $speciality = $('#speciality');

        $speciality.change(() => {
            const specialityId = $speciality.val();
            const url = `/especialidades/${specialityId}/doctores`;
            // $.get(url, onDoctorsLoaded);

            const $body = $("body");
            //get the url with the onDoctorsLoaded function and add a spinner while the data is loading. The spinner will be hidden when the data is loaded.
            $.ajax({
                url: url,
                beforeSend: function(){
                    $('#miSpinner').show();
                    $body.css("opacity", "0.5");
                }
            }).done(function(doctors){

                onDoctorsLoaded(doctors);
                $('#miSpinner').hide();
                $body.css("opacity", "1");

                $doctorBox.show();
            }
            );
         
        });
    });

    function onDoctorsLoaded(doctors){

        $fechaCita.hide();
        $horasDisponiblesDoctor.hide();

        $doctor = $('#doctor');

        // console.log(doctors);

        $doctor.find('option').remove();
        $doctor.append('<option disabled selected>Seleccione un doctor</option>');

        doctors.forEach(doctor => {
            $doctor.append(`<option value="${doctor.id}">${doctor.nombres} ${doctor.apellidos}</option>`);
        });

        // loadHours();
    }

// Cargar datos del paciente a partir de la cedula
    $(function(){
        const $cedula = $('#cedulaPaciente');

        $cedula.change(() => {
            const cedulaId = $cedula.val();

            const url = `/get-patient-data/${cedulaId}`;

            const $body = $("body");
            //get the url with the onDoctorsLoaded function and add a spinner while the data is loading. The spinner will be hidden when the data is loaded.
            $.ajax({
                url: url,
                beforeSend: function(){
                    $('#miSpinner').show();
                    $body.css("opacity", "0.5");
                    //quitar un parrafo dentro de la clase .vistoBueno
                    $('.vistoBueno').find('i').remove();
                    $('.editarCampo').find('i').remove();
                }
            }).done(function(patient){

                onPatientDataLoaded(patient);
                $('#miSpinner').hide();
                $body.css("opacity", "1");
            }
            );
        });
    });

    function onPatientDataLoaded(patient){
        const $nombres = $('#nombres');
        const $edad = $('#edad');
        const $telefono = $('#telefono');
        const $email = $('#email');

        //quitar disabled a celular
        $telefono.removeAttr('disabled');
        $email.removeAttr('disabled');

        //quitar clase border-0 a telefono y email
        $telefono.removeClass('border-0');
        $email.removeClass('border-0');

        //agregar placeholder a telefono y email:
        $telefono.attr('placeholder', 'Confirma el numero de celular');
        $email.attr('placeholder', 'Confirma el correo electronico');

        //agregar un parrafo dentro de la clase .vistoBueno
        $('.vistoBueno').append('<i class="fa-solid fa-check" style="color: #22ec13;"></i>');
        $('.editarCampo').append('<i class="fa-solid fa-pencil" style="color: #7b9cd5;"></i>')

        $nombres.val(patient.nombres);
        $edad.val(patient.edad);
        $telefono.val(patient.telefono);
        $email.val(patient.email);
    }


// Cargar especialidades si el usuario es doctor
    $(function(){
        const $rolDoctor = $('#roles');

        const $specialityBox = $('#specialitiesBox');
        $specialityBox.hide();


        $rolDoctor.change(() => {

            if ($rolDoctor.val() == 4) {
                const url = `/especialidades`;
                $.get(url, onSpecialitiesLoaded);
                $specialityBox.show();
            }else{
                $specialityBox.hide();
                const $specialityDoctor = $('#specialities');
                $specialityDoctor.find('option').remove();
                    
            }
        });

    });

    function onSpecialitiesLoaded(specialities){

        const $specialityDoctor = $('#specialities');
     
        //console.log(specialities);
    
        $specialityDoctor.find('option').remove();
        // $specialityDoctor.append('<option value="" disabled selected>Seleccione una o mas especialidades</option>');

        specialities.forEach(specialityDoctor => {
            $specialityDoctor.append(`<option value="${specialityDoctor.id}">${specialityDoctor.name}</option>`);
        });
    }


//Cargar especialidades al editar doctor
    $(function(){
        const $rolDoctor = $('#rolesEdit');

        const $specialityBox = $('#specialitiesBoxEdit');
        //$specialityBox.hide();
        
        $rolDoctor.change(() => {
                
                if ($rolDoctor.val() == 4) {
                    $specialityBox.show();
                    
                }else{
                    $specialityBox.hide();
                    // const $specialityDoctor = $('#specialitiesEdit');
                    // $specialityDoctor.find('option').remove();
                }
            }
        );
    });





//Cargar horarios del doctor
$(function(){
    $doctor = $('#doctor');
    $date = $('#scheduled_date');
    // $titleMorning = $('#titleMorning');
    // $hoursMorning = $('#hoursMorning');
    // $titleAfternoon = $('#titleAfternoon');
    // $hoursAfternoon = $('#hoursAfternoon');
    $hoursAvailable = $('#hoursAvailable');

    $doctor.on('change',  () => {
        $fechaCita.show();
        // loadHours();
        //loadDias(); Ejemplo de como cargar dias.
    });

    $date.on('change', () => {
        $horasDisponiblesDoctor.show();
        loadHours();
        }
    );
});



function loadHours(){

    const selectedDate = $date.val();
    const doctorId = $doctor.val();

    const url = `/schedule/hours?scheduled_date=${selectedDate}&doctor_id=${doctorId}`;

    // $.getJSON(url, displayHours);

    const $body = $("body");

    $.ajax({
        url: url,
        beforeSend: function(){
            $('#miSpinner').show();
            $body.css("opacity", "0.5");
        }
    }).done(function(data){
        displayHours(data);
        $('#miSpinner').hide();
        $body.css("opacity", "1");
    }
    );


}

function displayHours(data){
    
        console.log(data);

        // let htmlHoursMorning = '';
        // let htmlHoursAfternoon = '';
        let htmlHours = '';

        iRadio = 0;

        // if(data.morning){
        //     const morning_intervals = data.morning;

        //     morning_intervals.forEach(interval => {
        //         htmlHoursMorning += getRadioIntervalHTML(interval);
        //     });
        // }

        // if(!htmlHoursMorning != ""){
        //     htmlHoursMorning += noHours;
        // }

        // if(data.afternoon){ 
        //     const afternoon_intervals = data.afternoon;

        //     afternoon_intervals.forEach(interval => {
        //         htmlHoursAfternoon += getRadioIntervalHTML(interval);
        //     });
        // }

        // if(!htmlHoursAfternoon != ""){
        //     htmlHoursAfternoon += noHours;
        // }

        // $hoursMorning.html(htmlHoursMorning);
        // $hoursAfternoon.html(htmlHoursAfternoon);

        // $titleMorning.html(titleMorning);
        // $titleAfternoon.html(titleAfternoon);

        if(data.morning || data.afternoon){
            const hoursIntervals = [...data.morning, ...data.afternoon];


            hoursIntervals.forEach(interval => {
                htmlHours += getRadioIntervalHTML(interval);
            });
        }

        if(!htmlHours != ""){
            htmlHours += noHours;
        }

        $hoursAvailable.html(htmlHours);

}

function getRadioIntervalHTML(intervalo){
    // const text = `${intervalo.start} - ${intervalo.end}`;
    const text = `${intervalo.start}`;

    return `
        <input type="radio" class="btn-check {{ $errors->has('scheduled_time') ? 'is-invalid' : '' }}" 
               name="scheduled_time" 
               id="scheduled_time${iRadio}" 
               value="${intervalo.start}" 
               autocomplete="off">
        </input>
        <label class="btn btn-outline-primary" for="scheduled_time${iRadio++}">${text}</label>
    `;
}



