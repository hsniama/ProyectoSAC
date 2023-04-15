    $(document).ready(function () {
        flatpickr(".date", {
            "locale": "es",
            "dateFormat": "Y-m-d",
            "maxDate": "today",
        });

        flatpickr(".dateFiltroInicio", {
            "locale": "es",
            "dateFormat": "Y-m-d",
            "defaultDate": "today",
            "maxDate": "today",
        });

        flatpickr(".dateFiltroFinal", {
            "locale": "es",
            "dateFormat": "Y-m-d",
            "defaultDate": "today",
            // "maxDate": "today",
        });

        flatpickr(".dateCita", {
            "locale": "es",
            "dateFormat": "Y-m-d",
            "altInput": true,
            "minDate": "today",
            "maxDate" : new Date().fp_incr(8),
            // disable sat and sun:
            "disable": [ function(date) {
                // return true to disable
                return (date.getDay() === 0 || date.getDay() === 6);
            } ],
          
        });


        //function to select hour from 9am to 12pm and from 2pm to 6pm
        flatpickr(".horaCita", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            minDate: "09:00",
            maxDate: "18:00",
            minuteIncrement: 40,

            disable: [
                {
                    from: "12:00",
                    to: "16:00"
                },
            ]

        });


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


