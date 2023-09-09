import Swal from 'sweetalert2';

const forms = document.querySelectorAll('.form-deleter');
forms.forEach((formDelete) => {
    formDelete.addEventListener('submit', function (event) {
        event.preventDefault();
        var doubleconfirm = event.target.classList.contains('double-confirm');
        Swal.fire({
            title: 'Are you sure ?',
            text: "Please confirm your request !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancel',
            confirmButtonText: 'Yes, confirm !'
        }).then((result) => {
            if (result.value) {
  
                // if double confirm
                if (doubleconfirm) {
  
                    Swal.fire({
                        title: 'Confirm request',
                        html: "Please type <b>CONFIRM</b>",
                        input: 'text',
                        type: 'warning',
                        inputPlaceholder: 'CONFIRM',
                        showCancelButton: true,
                        confirmButtonText: 'Confirm',
                        cancelButtonText: 'Cancel',
                        showLoaderOnConfirm: true,
                        allowOutsideClick: () => !Swal.isLoading(),
                        preConfirm: (txt) => {
                            return (txt.toUpperCase() == "CONFIRM");
                        },
                    }).then((result) => {
                        if (result.value) this.submit();
                    })
                } else {
                    this.submit();
                }
            }
        });
    });
});