var acceptedId = $('#accepted').data("accepted-id");
var refusedId = $('#refused').data("refused-id");

$(document).ready(function () {
        if (acceptedId) {
            Swal.fire({
                icon: 'success',
                title: 'accepted',
                text: 'Vacation is accepted',
                footer: '<a href>Why do I have this issue?</a>'
            })
        }

        if (refusedId) {
            Swal.fire({
                icon: 'success',
                title: 'refused',
                text: 'Vacation is rejected',
                footer: '<a href>Why do I have this issue?</a>'
            })
        }
    });
