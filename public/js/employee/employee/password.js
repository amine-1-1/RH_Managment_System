$(document).ready(function () {
    $('form#editPassword').validate({
        errorClass: 'input-error',
        rules: {
            new_password: {
                required: true,
                minlength: 8
            },
            new_password_confirmation: {
                required: true,
                minlength: 8
            },

            messages: {
                new_password: "Please specify your password",
                new_password_confirmation: "Please specify your Last Name",

            },
        }
    });
    $('#submit').click(function () {

        var form = $("form#editPassword")
        if (form.valid()) {
            form.submit();
        }
    });
});
