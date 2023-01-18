    $(document).ready(function () {
        $('#user_table').DataTable();
    });

    $(document).ready(function () {
        $('#personas_table').DataTable();
    });

    $(document).ready(function () {
        $('#roles_table').DataTable();
    });

    $(document).ready(function () {
        $('#especialidades_table').DataTable();
    });

    $(document).ready(function () {
        $('#citas_table').DataTable();
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