$('#miSpinner').hide();

// let $fechaCita = $(".fechaCita");
// $fechaCita.hide();
// let $horasDisponiblesDoctor = $('.horasDisponiblesDoctor');
// $horasDisponiblesDoctor.hide();

let $speciality, $date, $doctor, iRadio;
let $hoursMorning, $hoursAfternoon, $titleMorning, $titleAfternoon;
const titleMorning = `En la mañana`;
const titleAfternoon = `En la tarde`;
const noHours = `<h3 class="text-danger">No hay horas disponibles.</h3>`;


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
            if(!inputs[i].value) {
                // If a field is empty, show an error message and return false
                alert("Porfavor llena primero estos campos antes de avanzar al siguiente paso.");
                return false;
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
            }
            );
         
        });
    });

    function onDoctorsLoaded(doctors){

        // $fechaCita.hide();
        // $horasDisponiblesDoctor.hide();

        $doctor = $('#doctor');

        // console.log(doctors);

        $doctor.find('option').remove();
        $doctor.append('<option disabled selected>Seleccione un doctor</option>');

        doctors.forEach(doctor => {
            $doctor.append(`<option value="${doctor.id}">${doctor.nombres} ${doctor.apellidos}</option>`);
        });

        loadHours();
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
    $titleMorning = $('#titleMorning');
    $hoursMorning = $('#hoursMorning');
    $titleAfternoon = $('#titleAfternoon');
    $hoursAfternoon = $('#hoursAfternoon');

    $doctor.on('change',  () => {
        // $fechaCita.show();
        loadHours();
    });

    $date.on('change', () => {
        // $horasDisponiblesDoctor.show();
        loadHours();
        }
    );
});



function loadHours(){

    const selectedDate = $date.val();
    const doctorId = $doctor.val();

    const url = `/schedule/hours?scheduled_date=${selectedDate}&doctor_id=${doctorId}`;

    $.getJSON(url, displayHours);


}

function displayHours(data){
    
        console.log(data);

        let htmlHoursMorning = '';
        let htmlHoursAfternoon = '';

        iRadio = 0;

        if(data.morning){
            const morning_intervals = data.morning;

            morning_intervals.forEach(interval => {
                htmlHoursMorning += getRadioIntervalHTML(interval);
            });
        }

        if(!htmlHoursMorning != ""){
            htmlHoursMorning += noHours;
        }

        if(data.afternoon){ 
            const afternoon_intervals = data.afternoon;

            afternoon_intervals.forEach(interval => {
                htmlHoursAfternoon += getRadioIntervalHTML(interval);
            });
        }

        if(!htmlHoursAfternoon != ""){
            htmlHoursAfternoon += noHours;
        }

        $hoursMorning.html(htmlHoursMorning);
        $hoursAfternoon.html(htmlHoursAfternoon);

        $titleMorning.html(titleMorning);
        $titleAfternoon.html(titleAfternoon);

}

function getRadioIntervalHTML(intervalo){
    const text = `${intervalo.start} - ${intervalo.end}`;

    return `
        <input type="radio" class="btn-check {{ $errors->has('scheduled_time') ? 'is-invalid' : '' }}" 
               name="scheduled_time" 
               id="scheduled_time${iRadio}" 
               value="${text}" 
               autocomplete="off" >
        </input>
        <label class="btn btn-outline-primary" for="scheduled_time${iRadio++}">${text}</label>
    `;
}



