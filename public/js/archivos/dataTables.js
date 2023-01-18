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
        $('#tablaNormalDataTable').DataTable();
    });


    // Tabla estilizada con botones
    $(document).ready(function () {
        $('#tablaDataTable').DataTable({
            responsive: true,
            scrollY : 350,
            deferRender: true,
            scroller: true,

            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    messageBottom: null,
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'print',
                    messageBottom: null,
                    text: 'Imprimir',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                { 
                    extend: 'spacer',
                    style : 'bar'
                },
                {
                    extend: 'colvis',
                    text : 'Escoger Columnas',
                }
            ]
        });
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