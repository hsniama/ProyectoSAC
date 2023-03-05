
// CONFIGURACIONES GENERALES PARA TODAS LAS DATATABLES.
    $.extend(true, $.fn.dataTable.defaults, {
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
        },
        
        // columnDefs: [{
        //     targets: -1,
        //     "searching": false,
        //     "orderable": false
        // }, ],

        responsive: true,
        //scrollY : 600,
        pageLength: 10,

    });


    $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
        className: 'btn btn-sm mr-2'
    })


// TABLA NORMAL
    $(document).ready(function () {
        $('.tablaNormalDataTable').DataTable();
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