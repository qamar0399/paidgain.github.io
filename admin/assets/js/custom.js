(function($) {
    "use strict";

    /*-------------------------------
            Delete Confirmation Alert
    -----------------------------------*/
    $(".cancel").on('click', function(e) {
        e.preventDefault();
        var link = $(this).attr("href");

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
                window.location.href = link;
            }
        })
    });


    /*-------------------------------
            Delete Confirmation Alert
    -----------------------------------*/
    $('.delete-confirm').on('click', function(event) {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                console.log($('#delete_form_' + id).html());
                document.getElementById('delete_form_' + id).submit();
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your Data is Save :)',
                    'error'
                )
            }
        })
    });


    var x = $('.icon_class').length; //Initial field counter is 1
    var count = 100;
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper

    //Once add button is clicked
    $(addButton).on('click', function() {
        //Check maximum number of input fields
        if (x < maxField) {
            //Increment field counter
            var fieldHTML = `<div class='row'>
                                <div class="col-md-5"><br>
                                    <div class="input-group">
                                        <input type="text" class="form-control icon_class" name="social[${x}][icon]" placeholder="icon here">
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class=""></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6"><br>
                                    <input type="url" required class="form-control" name="social[${x}][link]" aria-label="link">
                                </div>
                                <div class="col-md-1">
                                    <a href="javascript:void(0);" class="remove_button text-xxs mr-2 btn btn-danger mb-0 btn-sm text-xxs" title="Add field">
                                        <i class="fas fa-times-circle"></i>
                                    </a>
                                </div>
                            <div>`; //New input field html
            x++;
            count++;
            $(wrapper).append(fieldHTML); //Add field html
        }
    });

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e) {
        e.preventDefault();
        $(this).parent('div').parent('div.row').remove(); //Remove field html
        x--; //Decrement field counter
    });


    $(document).on('keyup', '.icon_class', function() {
        let _class = $(this).val();
        $(this).closest('.input-group').find($('i')).attr('class', _class);
    });

})(jQuery);