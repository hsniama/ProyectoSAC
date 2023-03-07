// Activar boton when pressing


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
        // Select all input fields in the current tab
        var inputs = $('.tab-content .tab-pane.active input');
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
            $.get(url, onDoctorsLoaded);
         
        });
    });

    function onDoctorsLoaded(doctors){

        const $doctor = $('#doctor');

        //console.log(doctors);

        $doctor.find('option').remove();
        $doctor.append('<option value="" disabled selected>Seleccione un doctor</option>');

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
        $specialityDoctor.append('<option value="" disabled selected>Seleccione una o mas especialidades</option>');

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


