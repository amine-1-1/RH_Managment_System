var passwordId = $('#password').data("password-id");
var profileId = $('#profile').data("profile-id");
var firstnameId = $('#firstname').data("firstname-id");
var lastnameId = $('#lastname').data("lastname-id");

$(document).ready(function () {
    if (passwordId) {
        Swal.fire({
            icon: 'success',
            title: 'passwordUpdated',
            text: ' ' +firstnameId+'  '+lastnameId+ ' password has been updated',

        })
            .then(function(){
                window.location.reload(window.location.href);
            });
    }
    if (profileId) {
        Swal.fire({
            icon: 'success',
            title: 'profileUpdated',
            text: ' ' +firstnameId+'  '+lastnameId+ '  profile has been updated',

        })
            .then(function(){
                window.location.reload(window.location.href);
            });
    }

});
