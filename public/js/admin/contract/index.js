var contractId = $('#contract').data("contract-id");
var createId = $('#create').data("create-id");

function deleteContract(id) {
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
                url: '/contract/'+id,
                type: 'delete'
            });
            swalWithBootstrapButtons.fire(
                'Deleted!',
                'Contract has been deleted.',
                'success'
            )
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Contract is safe :)',
                'error'
            )
        }
    })
    $(document).ajaxStop(function () {
        window.location.reload();
    });

}
$(document).ready(function () {
    if (contractId) {
        Swal.fire({
            icon: 'success',
            title: 'Contract Updated',
            text: ' Contract has been updated',

        })
            .then(function(){
                window.location.reload(window.location.href);
            });
    }

    if (createId) {
        Swal.fire({
            icon: 'success',
            title: 'create',
            text: 'Payslip is created',

        })
            .then(function(){
                window.location.reload(window.location.href);
            });
    }


});
