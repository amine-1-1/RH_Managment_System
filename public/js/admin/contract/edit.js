$(document).ready(function () {
    $('form#editContract').validate({
        errorClass: 'input-error',
        rules: {

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

        },
        messages: {
            type_id: "Please specify The contract Type",
            hired_date: "Please specify The Start date",
            departure_date: "Please specify The ending Date",

        }
    });
    $('#submit').click(function () {

        var form = $("form#editContract")
        if (form.valid()) {
            form.submit();
        }
    });
});
