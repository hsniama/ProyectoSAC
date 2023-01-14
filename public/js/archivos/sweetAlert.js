    $('.eliminarPersona').submit(function(e) {

        e.preventDefault();

        Swal.fire({
            title: '¿Borrar Persona?',
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
