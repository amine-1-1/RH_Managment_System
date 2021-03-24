var passwordId = $('#password').data("password-id");
var createId = $('#create').data("create-id");
var profileId = $('#profile').data("profile-id");
var firstnameId = $('#firstname').data("firstname-id");
var lastnameId = $('#lastname').data("lastname-id");



    function deleteUser(id) {
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
                    url: 'user/' + id,
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
                    'Your Employee is safe :)',
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
            text: 'Password ' +firstnameId+'  '+lastnameId+ ' has been updated',

        })
            .then(function(){
                window.location.reload(window.location.href);
            });
    }
    if (profileId) {
        Swal.fire({
            icon: 'success',
            title: 'profileUpdated',
            text: 'Profile  ' +firstnameId+'  '+lastnameId+' has been updated',

        })
            .then(function(){
                window.location.reload(window.location.href);
            });
    }
    if (createId) {
        Swal.fire({
            icon: 'success',
            title: 'create',
            text: 'Employee ' +firstnameId+'  '+lastnameId+' is created',

        })
            .then(function(){
                window.location.reload(window.location.href);
            });
    }


});





