$(document).ready(function () {

    $('form#createVacation').validate({
        errorClass: 'input-error',
        rules: {

            start_date: {
                required: true,
                date: true,
            },
            end_date: {
                required: true,
                date: true,
            },
            reason:{
                required: true,
                minlength: 4,

            },


        },
        messages: {

            start_date: "Please specify The Start date",
            end_date: "Please specify The ending Date",
            reason:"Please specify The reason"

        }
    });
    $('#submit').click(function () {

        var form = $("form#createVacation")
        if (form.valid()) {
            form.submit();
        }
    });
});
