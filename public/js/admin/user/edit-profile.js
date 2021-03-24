console.log('hello');
$(document).ready(function () {
    $('form#editAdmin').validate({
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

            role_id: {
                required: true,
                min: 1
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: '/user/check-email',
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
            email: {
                required: "We need your email address to contact you",
                email: "Your email address must be in the format of name@domain.com"
            }
        }
    });
    $('#submit').click(function () {

        var form = $("form#editAdmin")
        if (form.valid()) {
            form.submit();
        }
    });
});
