(function($) {
    "use strict";

    $('.subscription_form').on('submit', function(e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Do It!'
        }).then((result) => {
            if (result.value == true) {
                $.ajax({
                    type: 'POST',
                    url: this.action,
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 'warning') {
                            Sweet(response.status, response.message);
                            return false;
                        }
                        Sweet(response.status, response.message);
                        window.location.reload();
                    },
                    error: function(xhr) {
                        Sweet(xhr.responseJSON.status, xhr.responseJSON.message);
                        $.each(xhr.responseJSON.errors, function(key, item) {
                            Sweet('error', item);
                        });
                    }
                });
            }
        });
    });

})(jQuery);

function Sweet(icon, title, time = 3000) {

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: time,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })


    Toast.fire({
        icon: icon,
        title: title,
    })
}