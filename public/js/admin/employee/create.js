$(document).ready(function () {
    $('form#createEmployee').validate({
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


            email: {
                required: true,
                email: true,
                remote: {
                    url: '/employee/check-email',
                    type: "get",
                    data: {
                        email: function () {
                            return $('input#email').val();
                        }
                    },
                    dataFilter: function (data) {
                        var json = JSON.parse(data);
                        if (json.exist) {
                            return "\" " + "Email is alredy used." + "\" ";
                        } else {
                            return true;
                        }
                    }
                }
            },

        },
        messages: {
            first_name: "Please specify your First Name",
            last_name: "Please specify your Last Name",
            birth_date: "Please specify The date of birth",
            phone_number: "Please specify your phone number",
            email: {
                required: "We need your email address to contact you",
                email: "Your email address must be in the format of name@domain.com"
            }
        }
    });
    $('#submit').click(function () {

        var form = $("form#createEmployee")
        if (form.valid()) {
            form.submit();
        }
    });
});
