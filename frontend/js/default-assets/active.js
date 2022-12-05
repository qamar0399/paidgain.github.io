(function ($) {
    'use strict';

    var $constrom_window = $(window);

    // Preloader Active Code
    $constrom_window.on('load', function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

    // :: Scrollup Active Code
    if ($.fn.scrollUp) {
        $constrom_window.scrollUp({
            scrollSpeed: 1000,
            scrollText: '<i class="fas fa-angle-down"></i>'
        });
    }

    // ::Counter Up Active Code
    if ($.fn.countTo) {
        $('.counter_limit').each(function(){

            $(this).countTo({
                from: 0,
                to: $(this).text(),
                speed: 5000,
                refreshInterval: 50,
                onComplete: function(value) {
                   
                }
            });

        });
    }
    

    // Swiper Silder Active Code
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 15,
        pagination: {
            el: ".swiper-pagination",
            type: "progressbar",
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
             320: {
                 slidesPerView: 1,
             },
             768: {
                slidesPerView: 2,
             },
             992: {
                 slidesPerView: 4,
             },
         },
    });


    // :: ScrollDown Active Code

    $("#scrollDown").on('click', function () {
        $('html, body').animate({
            scrollTop: $("#about").offset().top - 0
        }, 1000);
    });

    // :: Slimscroll Active Code
    if ($.fn.slimscroll) {
        $('#listBox').slimscroll({
            height: '400',
            size: '3px',
            position: 'right',
            color: '#FF0000',
            alwaysVisible: false,
            distance: '0px',
            railVisible: false,
            wheelStep: 15
        });
    }

    // ::  Sticky Header

    window.onscroll = function () {
        scrollFunction();
    };

    function scrollFunction() {
        if (
            document.body.scrollTop > 50 ||
            document.documentElement.scrollTop > 50
        ) {
            $(".site-header--sticky").addClass("scrolling");
        } else {
            $(".site-header--sticky").removeClass("scrolling");
        }
        if (
            document.body.scrollTop > 700 ||
            document.documentElement.scrollTop > 700
        ) {
            $(".site-header--sticky.scrolling").addClass("reveal-header");
        } else {
            $(".site-header--sticky.scrolling").removeClass("reveal-header");
        }
    }

    // :: Animation on Scroll initializing
    if ($.fn.init) {
        AOS.init();
    }

})(jQuery)