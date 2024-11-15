
// CONFIGURACIONES GENERALES PARA TODAS LAS DATATABLES.
    $.extend(true, $.fn.dataTable.defaults, {
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
        },
        responsive: true,
        //scrollY : 600,
        pageLength: 10,

    });


    $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
        className: 'btn btn-sm mr-2'
    })


// TABLA NORMAL
    $(document).ready(function () {
        $('#tablaNormalDataTable').DataTable({
            // sin buscador ni paginador:
            searching: false,
            paging: false,
            // sin ordenar por columnas: 
            orderable: false,
        });
    });

// TABLA NORMAL CON BUSCADOR
    $(document).ready(function () {
        $('#tablaNormalDataTableBuscador').DataTable({
            searching: true,
            paging: true,
            ordering: false, // sin ordenar por columnas.
            lengthChange: false, // sin cambiar la cantidad de registros por pagina.
            pageLength: 5, // cantidad de registros por pagina.
        });

    });


// TABLA ESTILIZADA CON BOTONES SIN SERVER SIDE
    $(document).ready(function () {
        $('#tablaDataTable').DataTable({
            //responsive: true,
            scrollY : 300,
            deferRender: true,
            //scroller: true,
            pageLength: 5,
            //responsive: true,
            //scrollY : 600,

            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    },
                    className: 'btn-success'
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible'
                    },
                    text: 'CSV',  
                    className: 'btn-primary'
                },
                {
                    extend: 'pdf',
                    messageBottom: "Impreso el " + new Date().toLocaleDateString() + " a las " + new Date().toLocaleTimeString(),
                    exportOptions: {
                        columns: ':visible'
                    },
                    className: 'btn-danger'
                },
                {
                    extend: 'print',
                    messageBottom: "Impreso el " + new Date().toLocaleDateString() + " a las " + new Date().toLocaleTimeString(),
                    text: 'Imprimir',
                    exportOptions: {
                        columns: ':visible'
                    },
                    className: 'btn-info'
                },
                { 
                    extend: 'spacer',
                    style : 'bar'
                },
                {
                    extend: 'colvis',
                    text : 'Escoger Columnas',
                    className: 'btn-warning'
                }
            ]
        });
    });