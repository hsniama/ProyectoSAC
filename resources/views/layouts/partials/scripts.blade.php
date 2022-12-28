<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('js/plugins/jquery.min.js') }}"></script>

<!-- Bootstrap 4 / usar este en caso de fallas public/js/plugins/bootsrap.bundle.js, se obtiene de la carpeta de AdminLTE-->
{{-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> --}}

<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}"></script>

<!--Datatables-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/date-1.2.0/r-2.4.0/datatables.min.js"></script>


<script>
    $(document).ready(function () {
        $('#user_table').DataTable();
    });

    $(document).ready(function () {
        $('#personas_table').DataTable();
    });

    $.extend(true, $.fn.dataTable.defaults, {
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
        },
        columnDefs: [{
            targets: -1,
            "searching": false,
            "orderable": false
        }, ]
    });

</script>

<!--FlatePickers-->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/es.js"></script>

<script>
    $(document).ready(function () {
        flatpickr(".date", {
            "locale": "es"
        });
    });
</script>


<!--Select2-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $('.select2').select2();
</script>

<!--SweetAlert2-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    
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





</script>







