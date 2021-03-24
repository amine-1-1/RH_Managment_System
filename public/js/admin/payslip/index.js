var payslipId = $('#payslip').data("payslip-id");
var createId = $('#create').data("create-id");

function deletePayslip(id) {
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
                url: '/payslip/' + id,
                type: 'delete'
            });
            swalWithBootstrapButtons.fire(
                'Deleted!',
                'Payslip has been deleted.',
                'success'
            )
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Payslip is safe :)',
                'error'
            )
        }
    })
    $(document).ajaxStop(function () {
        window.location.reload();
    });
}
$(document).ready(function () {
    if (payslipId) {
        Swal.fire({
            icon: 'success',
            title: 'Payslip Updated',
            text: 'Payslip has been updated',

        })
            .then(function(){
                window.location.reload(window.location.href);
            });
    }

    if (createId) {
        Swal.fire({
            icon: 'success',
            title: 'create',
            text: ' Payslip is created',

        })
            .then(function(){
                window.location.reload(window.location.href);
            });
    }

});
