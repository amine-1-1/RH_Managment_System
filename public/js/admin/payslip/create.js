$(document).ready(function () {
    $('form#createPayslip').validate({
        errorClass: 'input-error',
        rules: {
            employee_id: {
                required: true,
                min: 1
            },
            month: {
                required: true,
                min: 1
            },
            year: {
                required: true,
                min: 1
            },
            file: {
                required: true,
                extension: "pdf",
            }


        },
        messages: {
            employee_id: "Please specify The Employee ",
            month: "Please specify The Month",
            year: "Please specify The Year",

        }
    });
    $('#submit').click(function () {

        var form = $("form#createPayslip")
        if (form.valid()) {
            form.submit();
        }
    });
});
