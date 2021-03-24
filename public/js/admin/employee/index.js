var passwordId = $('#password').data("password-id");
var createId = $('#create').data("create-id");
var profileId = $('#profile').data("profile-id");
var bonusId = $('#bonus').data("bonus-id");
var activatedId = $('#activated').data("activated-id");
var firstnameId = $('#firstname').data("firstname-id");
var lastnameId = $('#lastname').data("lastname-id");

    function deleteEmployee(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true

        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'employee/' + id,
                    type: 'delete'
                });
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your employee has been deleted.',
                    'success'
                )
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your employee is safe :)',
                    'error'
                )
            }
        })
        $(document).ajaxStop(function () {
            window.location.reload();
        });

    }

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
    if (createId) {
        Swal.fire({
            icon: 'success',
            title: 'create',
            text:  ' '+firstnameId+'  '+lastnameId+ ' is created',

        })
            .then(function(){
                window.location.reload(window.location.href);
            });

    }
    if (bonusId) {
        Swal.fire({
            icon: 'success',
            title: 'bonusUpdated',
            text: ' '+firstnameId+'  '+lastnameId+ 'Bonus is Updated',

        })
            .then(function(){
                window.location.reload(window.location.href);
            });
    }
    if (activatedId && activatedId===1) {
        Swal.fire({
            position: 'middle',
            icon: 'success',
            title: ' '+firstnameId+'  '+lastnameId+ '   is now activated',
            showConfirmButton: false,
            timer: 1500
        })
    } else if(activatedId && activatedId===0) {
        Swal.fire({
            position: 'middle',
            icon: 'error',
            title: ' '+firstnameId+'  '+lastnameId+ '  is now deactivated',
            showConfirmButton: false,
            timer: 1500
        })
    }

});
