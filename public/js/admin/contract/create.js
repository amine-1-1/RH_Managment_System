$(document).ready(function () {

    $('form#createContract').validate({
        errorClass: 'input-error',
        rules: {
            employee_id: {
                required: true,
                min: 1
            },
            type_id: {
                required: true,
                min: 1
            },
            hired_date: {
                required: true,
                date: true,
            },
            departure_date: {
                required: true,
                minlength: 8
            },
            file: {
                required: true,
                extension: "pdf",
            }

        },
        messages: {
            employee_id: "Please specify The Employee ",
            type_id: "Please specify The contract Type",
            hired_date: "Please specify The Start date",
            departure_date: "Please specify The ending Date",

        }
    });
    $('#submit').click(function () {

        var form = $("form#createContract")
        if (form.valid()) {
            form.submit();
        }
    });
});
