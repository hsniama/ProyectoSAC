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
</script>