(function (){
    "use strict";

    /**
     * This function will check the username is available or not
     * */
    $('#username').on('input', function(){
        var username = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/admin/users/check-username',
            type: 'post',
            delay: 2000,
            data: {
                username: username
            },
            success: function (res){
                $('#username').removeClass('is-invalid').addClass('is-valid');
                $('#message').html('<small class="text-success">'+res+'</small>');
            },
            error: function (xhr){
                $('#username').removeClass('is-valid').addClass('is-invalid');
                $('#message').html('<small class="text-danger">'+xhr.responseJSON+'</small>');
            }
        });

        if(username === ''){
            $('#username').removeClass('is-invalid is-valid');
            $('#message').empty();
        }
    });
})(jQuery);
