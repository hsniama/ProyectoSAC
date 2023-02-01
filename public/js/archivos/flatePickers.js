    $(document).ready(function () {
        flatpickr(".date", {
            "locale": "es",
            "dateFormat": "Y-m-d",
            "maxDate": "today",
        });
    });


    $(document).ready(function () {
        flatpickr(".dateCita", {
            "locale": "es",
            "dateFormat": "Y-m-d",
            "altInput": true,
            "minDate": "today",
            // disable sat and sun:
            "disable": [ function(date) {
                // return true to disable
                return (date.getDay() === 0 || date.getDay() === 6);
            } ],
            
        });
    });

        $(document).ready(function () {
        flatpickr(".horaCita", {
            "locale": "es",
            "enableTime": true,
            "noCalendar": true,
            "dateFormat": "H:i",
            "time_24hr": true,

            "minTime": "08:00",
            "maxTime": "18:00",
            
        });
    });


    $(document).ready(function () {
        flatpickr(".editarCita", {
            "locale": "es",
            "dateFormat": "Y-m-d",
            "altInput": true,
            // "minDate": "today",
            // disable sat and sun:
            "disable": [ function(date) {
                // return true to disable
                return (date.getDay() === 0 || date.getDay() === 6);
            } ],
            
        });
    });