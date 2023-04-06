    $('.eliminarPerson').submit(function(e) {

        e.preventDefault();

        Swal.fire({
            title: '¿Borrar Person?',
            text: "No se podrá revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borrar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.value) {
                this.submit();
            }

        }) 
    })

    $('.eliminarUsuario').submit(function(e) {

        e.preventDefault();

        Swal.fire({
            title: '¿Borrar Usuario?',
            text: "No se podrá revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borrar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.value) {
                this.submit();
            }

        }) 
    })


    $('.eliminarCitaPaciente').submit(function(e) {
        e.preventDefault();
        // Obtiene la información de la cita

        //get the appointment:
        var appointment = $(this).data('appointment');

        // console.log(appointment);
        
        var paciente = appointment.patient.nombres + ' ' + appointment.patient.apellidos;
        var cedula = appointment.patient.cedula;
        var doctor = appointment.doctor.nombres + ' ' + appointment.doctor.apellidos;
        var especialidad = appointment.speciality.name;
        var fecha = appointment.scheduled_date;
        var hora = appointment.scheduled_time;

        // Muestra SweetAlert2 con la información de la cita
        Swal.fire({
            title: '¿Desea eliminar esta cita médica?',
            html: '<table class="table table-bordered">' +
                    '<tbody>' +
                        '<tr><td><b>Paciente:</b></td><td>' + paciente + '</td></tr>' +
                        '<tr><td><b>Cédula:</b></td><td>' + cedula + '</td></tr>' +
                        '<tr><td><b>Médico:</b></td><td>' + doctor + '</td></tr>' +
                        '<tr><td><b>Especialidad:</b></td><td>' + especialidad + '</td></tr>' +
                        '<tr><td><b>Fecha:</b></td><td>' + fecha + '</td></tr>' +
                        '<tr><td><b>Hora:</b></td><td>' + hora + '</td></tr>' +
                    '</tbody>' +
                '</table>',
            icon: 'warning',
            width: '40%',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            customClass: {
                title: 'text-danger',
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Envía el formulario para eliminar la cita
                $(this).unbind('submit').submit();
            }
        });
    });


    $('.eliminarRol').submit(function(e) {

        e.preventDefault();

        Swal.fire({
            title: '¿Borrar Rol?',
            text: "No se podrá revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borrar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.value) {
                this.submit();
            }

        }) 
    })


    $('.eliminarEspecialidad').submit(function(e) {

        e.preventDefault();

        Swal.fire({
            title: '¿Borrar Especialidad?',
            text: "No se podrá revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borrar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.value) {
                this.submit();
            }

        }) 
    })

    $('.eliminarCita').submit(function(e) {

        e.preventDefault();

        Swal.fire({
            title: '¿Borrar Cita del sistema?',
            text: "No se podrá revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, borrar!',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.value) {
                this.submit();
            }

        }) 
    });

$('.confirmarCita').submit(function(e) {
    
        e.preventDefault();

        var self = this;

        var form_data = $(this).serialize();

                $.ajax({
                    url: "/get-appointment-data",
                    type: "POST",
                    data: form_data,
                }).done(function(response) {
                    var html = '<table class="table table-bordered">' +
                        '<tbody>' +
                            '<tr><td><b>Médico:</b></td><td>' + response.doctor_nombres + ' ' + response.doctor_apellidos + '</td></tr>' +
                            '<tr><td><b>Especialidad:</b></td><td>' + response.especialidad_nombre + '</td></tr>' +
                            '<tr><td><b>Fecha:</b></td><td>' + response.fecha_cita + '</td></tr>' +
                            '<tr><td><b>Hora:</b></td><td>' + response.hora_cita + '</td></tr>' +
                        '</tbody>' +
                   '</table>';
                    Swal.fire({
                        title: '¿Confirmar Cita?',
                        html: html,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, agendar!',
                        cancelButtonText: 'No'
                    }).then((result) => {
                        if (result.value) {
                            self.submit();
                        }
                    });
                }).fail(function(response) {
                    console.log(response);
                });    
            


});

