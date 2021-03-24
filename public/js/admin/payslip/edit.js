$(document).ready(function () {
    $('form#editPayslip').validate({
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


        },
        messages: {
            employee_id: "Please specify The Employee ",
            month: "Please specify The Month",
            year: "Please specify The Year",

        }
    });
    $('#submit').click(function () {

        var form = $("form#editPayslip")
        if (form.valid()) {
            form.submit();
        }
    });
});
