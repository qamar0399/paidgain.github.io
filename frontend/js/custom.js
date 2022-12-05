(function ($) {
	"use strict";

	$(".auth_form").on('submit', function(e){
		e.preventDefault();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		var basicbtnhtml=$('.basicbtn').html();
		$.ajax({
			type: 'POST',
			url: this.action,
			data: new FormData(this),
			dataType: 'json',
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function() {

				$('.basicbtn').html("Please Wait....");
				$('.basicbtn').attr('disabled','');
			},

			success: function(response){
				$('.basicbtn').removeAttr('disabled');
				Sweet('success', response.message);
				$('.basicbtn').html(basicbtnhtml);

                window.setTimeout(function () {
                    window.location.href = response.redirect;
                }, 1500);
			},
			error: function(xhr, status, error)
			{
				$('.basicbtn').html(basicbtnhtml);
				$('.basicbtn').removeAttr('disabled');
				$.each(xhr.responseJSON.errors, function (key, item)
				{
					Sweet('error', item);
					$("#errors").html("<li class='text-danger'>"+item+"</li>");
				});
				errosresponse(xhr, status, error);
			}
		});
	});

})(jQuery);

function Sweet(icon, title, time= 3000){

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
