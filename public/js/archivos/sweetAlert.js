  $(document).ready(function() {

  
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

    $('.eliminarUsuario').on(function(e) {

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
            if (result.isConfirmed) {
                $(this).submit();
            }

        }) 
    })


    $('.eliminarCitaPaciente').submit(function(e) {
        e.preventDefault();
        // Obtiene la información de la cita

        //get the appointment:
        var appointment = $(this).data('appointment');
        var specialityName = $(this).data('speciality-name');

    var motivoSelect = 
                            '<div class="form-floating">'+
                                '<select class="form-select" name="notes" id="notes" required>' +
                                    '<option value="" disabled selected>Seleccione un motivo</option>' +
                                    '<option value="Paciente no puede acudir">No puedo acudir</option>' +
                                    '<option value="Paciente solicitó la eliminación de la cita">Solicitar eliminación de cita</option>' +
                                '</select>'+
                                '<label for="notes">Motivo</label>'+
                            '</div>';
        // console.log(appointment);
        
        var paciente = appointment.patient.nombres + ' ' + appointment.patient.apellidos;
        var cedula = appointment.patient.cedula;
        var doctor = appointment.doctor.nombres + ' ' + appointment.doctor.apellidos;
        // var especialidad = appointment.speciality.name;
        var especialidad = specialityName;
        var fecha = appointment.scheduled_date;
        var hora = appointment.scheduled_time;

        // Muestra SweetAlert2 con la información de la cita
        Swal.fire({
            title: '¿Desea eliminar esta cita médica?',
            html: motivoSelect +'<br/>'+
                        '<table class="table table-bordered">' +
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
            // if motivo is not selected
            if (result.isConfirmed && $('#notes').val() == null) {

                console.log($('#notes').val());
                console.log('No seleccionó motivo');

                Swal.fire({
                    title: 'Debe seleccionar un motivo',
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        title: 'text-danger',
                    }
                });


            } else if (result.isConfirmed && $('#notes').val() != null) {

                console.log($('#notes').val());
                console.log('Seleccionó motivo');

                // send the notes to the controller and the appointment id through ajax
                $.ajax({
                    url: "/api/eliminar-cita-paciente",
                    type: "POST",
                    data: {
                        appointment_id: appointment.id,
                        notes: $('#notes').val(),
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                }).done(function(response) {
                    console.log(response);
                    Swal.fire({
                        title: response.message,
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                        customClass: {
                            title: 'text-success',
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }).fail(function(response) {
                    console.log(response);
                }
                );
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
                    url: "/api/get-appointment-data",
                    type: "POST",
                    data: form_data,
                }).done(function(response) {
                    var html = '<table class="table table-bordered">' +
                        '<tbody>' +
                            '<tr><td><b>Médico:</b></td><td>' + response.doctor_nombres + ' ' + response.doctor_apellidos + '</td></tr>' +
                            '<tr><td><b>Especialidad:</b></td><td>' + response.especialidad_nombre + '</td></tr>' +
                            '<tr><td><b>Paciente:</b></td><td>' + response.paciente_nombres + '</td></tr>' +
                            '<tr><td><b>Cedula:</b></td><td>' + response.paciente_cedula + '</td></tr>' +
                            '<tr><td><b>Fecha de la Cita:</b></td><td>' + response.fecha_cita + '</td></tr>' +
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

});


$(document).on('click', '.eliminarCitaPacienteDesdeAdmin', function(e) {
    e.preventDefault();

    var appointment = $(this).data('appointment');
    var specialityName = $(this).data("speciality-name");

    var motivoSelect = 
                            '<div class="form-floating">'+
                                '<select class="form-select" name="notes" id="notes" required>' +
                                    '<option value="" disabled selected>Seleccione un motivo</option>' +
                                    '<option value="Paciente no puede acudir">Paciente no puede acudir</option>' +
                                    '<option value="Medico no disponible">Medico no disponible</option>' +
                                '</select>'+
                                '<label for="notes">Motivo</label>'+
                            '</div>';

        var paciente = appointment.patient.nombres + ' ' + appointment.patient.apellidos;
        var cedula = appointment.patient.cedula;
        var doctor = appointment.doctor.nombres + ' ' + appointment.doctor.apellidos;
        // var especialidad = appointment.speciality.name;
        var especialidad = specialityName;
        var fecha = appointment.scheduled_date;
        var hora = appointment.scheduled_time;


    //Muestra SweetAlert2 con la información de la cita
    Swal.fire({
        title: '¿Desea eliminar esta cita médica?',
        html: motivoSelect +'<br/>'+
                    '<table class="table table-bordered">' +
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

            // if motivo is not selected
            if (result.isConfirmed && $('#notes').val() == null) {

                console.log($('#notes').val());
                console.log('No seleccionó motivo');

                Swal.fire({
                    title: 'Debe seleccionar un motivo',
                    icon: 'warning',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                    customClass: {
                        title: 'text-danger',
                    }
                });


            } else if (result.isConfirmed && $('#notes').val() != null) {

                console.log($('#notes').val());
                console.log('Seleccionó motivo');

                // send the notes to the controller and the appointment id through ajax
                $.ajax({
                    url: "/api/eliminar-cita-paciente",
                    type: "POST",
                    data: {
                        appointment_id: appointment.id,
                        notes: $('#notes').val(),
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                }).done(function(response) {
                    console.log(response);
                    Swal.fire({
                        title: response.message,
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Aceptar',
                        customClass: {
                            title: 'text-success',
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }).fail(function(response) {
                    console.log(response);
                }
                );
            }



        });
});
