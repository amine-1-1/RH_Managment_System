$(document).ready(function () {
    $('form#editEmployee').validate({
        errorClass: 'input-error',
        rules: {
            first_name: {
                required: true,
                minlength: 2
            },
            last_name: {
                required: true,
                minlength: 2
            },
            birth_date: {
                required: true,
                date: true,
            },
            phone_number: {
                required: true,
                minlength: 8
            },
        },
        messages: {
            first_name: "Please specify your First Name",
            last_name: "Please specify your Last Name",
            birth_date: "Please specify The date of birth",
            phone_number: "Please specify your phone number",

        }
    });
    $('#submit').click(function () {

        var form = $("form#editEmployee")
        if (form.valid()) {
            form.submit();
        }
    });
});
