$('#miSpinner').hide();

let $fechaCita = $(".fechaCita");
$fechaCita.hide();
let $horasDisponiblesDoctor = $('.horasDisponiblesDoctor');
$horasDisponiblesDoctor.hide();


const noHours = `<h3 class="text-danger">No hay horas disponibles para este doctor</h3>`;


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
        const $speciality = $('#speciality');
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

        $fechaCita.hide();
        $horasDisponiblesDoctor.hide();

        const $doctor = $('#doctor');

        console.log(doctors);

        $doctor.find('option').remove();
        $doctor.append('<option disabled selected>Seleccione un doctor</option>');

        doctors.forEach(doctor => {
            $doctor.append(`<option value="${doctor.id}">${doctor.nombres} ${doctor.apellidos}</option>`);
        });
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
    const $doctor = $('#doctor');

    
    $date = $('#scheduled_date');

    $doctor.on('change',  () => {

        $fechaCita.show();
        loadHours();
    });

    $date.on('change', () => {
        // $("#scheduled_time").prop('disabled', false);
        // $("#scheduled_time").addClass('bg-white');
        $horasDisponiblesDoctor.show();
        loadHours();
        }
    );
});



function loadHours(){

    const $doctor = $('#doctor');
    const $date = $('#scheduled_date');

    const doctorId = $doctor.val();
    const selectedDate = $date.val();
    const url = `/schedule/hours?scheduled_date=${selectedDate}&doctor_id=${doctorId}`;
    // $.getJSON(url, onHorariosLoaded);

    $.ajax({
        url: url,
        type: 'GET',
        success: function(data){
            // console.log(data);
            onHorariosLoaded(data);
        },
        error: function(error){
            $horasDisponiblesDoctor.append(`<h3 class="text-danger">${error.responseJSON.error}</h3>`)
        }



    })

}

function onHorariosLoaded(horarios){
    
        // console.log(horarios);

        if(horarios.length == 0){
            // $horasDisponiblesDoctor.text('No hay horas disponibles para este doctor');
            $horasDisponiblesDoctor.append(`<input type="text" disabled> No hay horas disponibles para este doctor </input>`);
            alert('No hay horas disponibles para este doctor');
            console.log('no hay horas.');
        }else{

            const horasDisponibles =  horarios.map(horario => horario.start);
            // console.log(horasDisponibles);

            $horasDisponiblesDoctor.find('input').remove();
            $horasDisponiblesDoctor.find('label').remove();
            $horasDisponiblesDoctor.append('<label class="form-label" for="scheduled_time" class="required">Horas disponibles</label> </br>');

            let iRadio = 0;

            horasDisponibles.forEach(horaInicio => {
                $horasDisponiblesDoctor.append(`
                    <input type="radio" class="btn-check {{ $errors->has('scheduled_time') ? 'is-invalid' : '' }}" name="scheduled_time" id="scheduled_time${iRadio}" 
                           value="${horaInicio}" 
                           autocomplete="off" ></input>
                    <label class="btn btn-outline-primary" for="scheduled_time${iRadio}">${horaInicio}</label>
                `);
                iRadio++;
            });

        }
}



