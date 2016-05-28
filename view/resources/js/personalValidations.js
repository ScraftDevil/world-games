// Spanish Date format function
$.validator.addMethod(
    "spainDate",
    function(value, element) {
        return value.match(/^\d\d\-\d\d\-\d\d\d\d/);
    },
    "Fecha con formato incorrecto"
);


// Date is Future function
$.validator.addMethod(
    "futureDate",
    function(value, element) {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        var timeDate = (yyyy * 10000) + (mm * 100) + dd;
        var day = value[0] + "" + value[1];
        var month = value[3] + "" + value[4];
        var year = value[6] + "" + value[7] + "" + value[8] + "" + value[9];
        var date = parseInt(day) + (parseInt(month) * 100) + (parseInt(year) * 10000);
        return date <= timeDate;
    },
    "La fecha introducida es futura a la actual."
);