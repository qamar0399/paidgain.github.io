(function($) {
    "use strict";


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*-------------------------
        productform Active
    --------------------------*/
    $("#productform").on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.basicbtn').attr('disabled', '');
            },

            success: function(response) {
                $('.basicbtn').removeAttr('disabled');
                Sweet('success', response);

                success(response);
            },
            error: function(xhr, status, error) {
                $('.basicbtn').removeAttr('disabled');
                $('.errorarea').show();
                $.each(xhr.responseJSON.errors, function(key, item) {
                    Sweet('error', item);
                    $("#errors").html("<li class='text-danger'>" + item + "</li>");
                });
                errosresponse(xhr, status, error);
            }
        });
    });


    /*-------------------------
        Ajaxform with Active
    -----------------------------*/
    $(".ajaxform_with_reload").on('submit', function(e) {
        e.preventDefault();

        var basicbtnhtml = $('.basicbtn').html();

        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {

                $('.basicbtn').html("Please Wait....");
                $('.basicbtn').attr('disabled', '');

            },

            success: function(response) {
                $('.basicbtn').removeAttr('disabled');
                Sweet('success', response);
                $('.basicbtn').html(basicbtnhtml);
                window.setTimeout(function() {
                    location.reload();
                }, 1500);
            },
            error: function(xhr, status, error) {
                $('.basicbtn').html(basicbtnhtml);
                $('.basicbtn').removeAttr('disabled');
                $('.errorarea').show();
                $.each(xhr.responseJSON.errors, function(key, item) {
                    Sweet('error', item);
                    $("#errors").html("<li class='text-danger'>" + item + "</li>");
                });
                errosresponse(xhr, status, error);
            }
        });


    });

    /*-------------------------
        Ajaxform with Reset
    -----------------------------*/
    $(".ajaxform_with_reset").on('submit', function(e) {
        e.preventDefault();

        var basicbtnhtml = $('.basicbtn').html();
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.basicbtn').html("Please Wait....");
                $('.basicbtn').attr('disabled', '');
            },

            success: function(response) {
                $('.basicbtn').removeAttr('disabled');
                Sweet('success', response);
                $('.basicbtn').html(basicbtnhtml);
                $('.ajaxform_with_reset').trigger('reset');
                var placeholder_image = $('.placeholder_image').val();
                $('.input_preview').attr('src', placeholder_image);
            },
            error: function(xhr, status, error) {
                $('.basicbtn').html(basicbtnhtml);
                $('.basicbtn').removeAttr('disabled');
                $('.errorarea').show();
                $.each(xhr.responseJSON.errors, function(key, item) {
                    Sweet('error', item);
                    $("#errors").html("<li class='text-danger'>" + item + "</li>");
                });
                errosresponse(xhr, status, error);
            }
        });


    });

    /*-------------------------
        Ajaxform with Next
    -----------------------------*/
    $(".ajaxform_with_next").on('submit', function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var basicbtnhtml = $('.basicbtn').html();
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {

                $('.basicbtn').html('Please Wait....');
                $('.basicbtn').attr('disabled', '')

            },

            success: function(response) {

            },
            error: function(xhr, status, error) {
                $('.basicbtn').html(basicbtnhtml);
                $('.basicbtn').removeAttr('disabled')
                $('.errorarea').show();
                $.each(xhr.responseJSON.errors, function(key, item) {
                    Sweet('error', item)
                    $("#errors").html("<li class='text-danger'>" + item + "</li>")
                });
                errosresponse(xhr, status, error);
            }
        })


    });

    /*-------------------------
        Ajaxform with Submit
    -----------------------------*/
    $("#ajaxform").on('submit', function(e) {
        e.preventDefault();

        var basicbtnhtml = $('.basicbtn').html();

        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.basicbtn').html("Please Wait....");
                $('.basicbtn').attr('disabled', '');
            },
            success: function(response) {
                $('.basicbtn').html(basicbtnhtml);
                $('.basicbtn').removeAttr('disabled');
                Sweet('success', response);
                success(response);
            },
            error: function(xhr, status, error) {
                $('.basicbtn').html(basicbtnhtml);
                $('.basicbtn').removeAttr('disabled');
                $('.errorarea').show();
                $.each(xhr.responseJSON.errors, function(key, item) {
                    Sweet('error', item);
                    $("#errors").html("<li class='text-danger'>" + item + "</li>");
                });
                errosresponse(xhr, status, error);
            }
        });
    });

    /*-------------------------
        Ajaxform with Submit
    -----------------------------*/
    $(".ajaxform").on('submit', function(e) {
        e.preventDefault();

        var basicbtnhtml = $('.basicbtn').html();
        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {

                $('.basicbtn').html("Please Wait....");
                $('.basicbtn').attr('disabled', '')

            },

            success: function(response) {
                $('.basicbtn').removeAttr('disabled')
                Sweet('success', response);
                $('.basicbtn').html(basicbtnhtml);
                success(response);
            },
            error: function(xhr, status, error) {
                $('.basicbtn').html(basicbtnhtml);
                $('.basicbtn').removeAttr('disabled')
                $('.errorarea').show();
                $.each(xhr.responseJSON.errors, function(key, item) {
                    Sweet('error', item)
                    $("#errors").html("<li class='text-danger'>" + item + "</li>")
                });
                errosresponse(xhr, status, error);
            }
        })


    });


    /*-------------------------
        Ajaxform2 with Submit
    -----------------------------*/
    $(document).on('submit', '.ajaxform2', function(e) {
        e.preventDefault();
        var basicbtnhtml = $('.basicbtn').html();

        $.ajax({
            type: this.method,
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.basicbtn').html("Please Wait....");
                $('.basicbtn').attr('disabled', '')
            },
            success: function(response) {
                $('.basicbtn').removeAttr('disabled')
                Sweet('success', response);
                $('.basicbtn').html(basicbtnhtml);
                success2(response);
            },
            error: function(xhr, status, error) {
                $('.basicbtn').html(basicbtnhtml);
                $('.basicbtn').removeAttr('disabled')
                $('.errorarea').show();
                $.each(xhr.responseJSON.errors, function(key, item) {
                    Sweet('error', item)
                    $("#errors").html("<li class='text-danger'>" + item + "</li>")
                });
                errosresponse(xhr, status, error);
            }
        })
    });

    /*----------------------
        CheckAll Active
    --------------------------*/
    $(".checkAll").on('click', function() {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    /*----------------------
        CheckAll Active
    --------------------------*/
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

    $(document).on('submit', '#global-search', function(e) {
        e.preventDefault();

        $.ajax({
            type: this.method,
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
                $('#global-search-result').html(response.html);
            },
            error: function(xhr, status, error) {
                $('#global-search-result').empty();
                $('#global-search-result').html('<div class="search-item"><a href="#">Data Not Found</a> <a href="#" class="search-close"><i class="fas fa-times"></i></a> </div>');
                Sweet('error', xhr.responseJSON.message);
            }
        })
    });

    $(document).on('keyup', '#global-search-input', function() {
        delay(function() {
            $('#global-search').trigger('submit');
        }, 1000);
    });

    $('#lang_switch').on('change', function() {
        var value = $('#lang_switch').val();
        var url = $('#lang_url').val();
        $.ajax({
            type: 'GET',
            url: url,
            data: { value: value },
            dataType: 'json',
            success: function(response) {
                if (response == 'success') {
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                $('.basicbtn').removeAttr('disabled');
                $('.errorarea').show();
                $.each(xhr.responseJSON.errors, function(key, item) {
                    Sweet('error', item);
                    $("#errors").html("<li class='text-danger'>" + item + "</li>");
                });
                errosresponse(xhr, status, error);
            }
        });
    });

})(jQuery);

/*---------------------------
        Sweet Alert Active
    -----------------------------*/
function Sweet(icon, title, time = 3000) {

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: time,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });


    Toast.fire({
        icon: icon,
        title: title,
    });
}

var delay = (function() {
    var timer = 0;
    return function(callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

function amount_format(amount, type = 'name') {
    const currency_settings = JSON.parse($('#currency_settings').val());

    var format = type == 'name' ? ' ' + currency_settings.currency_name + ' ' : currency_settings.currency_icon;


    if (currency_settings.currency_position == 'left') {
        var price = format + amount;

    } else {
        var price = amount + ' ' + format;
    }



    return price;


}

function success(res) {

}

function errosresponse(xhr, status, error) {

}