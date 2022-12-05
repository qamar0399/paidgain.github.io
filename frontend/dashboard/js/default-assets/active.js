(function ($) {
    "use strict";

    // :: Variables
    var ecaps_window = $(window);
     var $constrom_window = $(window);
    var dd = $("dd");
    var pageWrapper = $(".ecaps-page-wrapper");
    var sideMenuArea = $(".ecaps-sidemenu-area");

   // Preloader Active Code
    $constrom_window.on('load', function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

    // :: Slimscroll Active Code
    if ($.fn.slimscroll) {
        $('#ecapsSideNav').slimscroll({
            height: '100%',
            size: '4px',
            position: 'right',
            color: '#8c8c8c',
            alwaysVisible: false,
            distance: '2px',
            railVisible: false,
            wheelStep: 15
        });
    }

   
    // :: Menu Active Code
    $("#menuCollasped").on("click", function () {
        pageWrapper.toggleClass("menu-collasped-active");
    });

    $("#mobileMenuOpen").on("click", function () {
        pageWrapper.toggleClass("mobile-menu-active");
    });

    $("#rightSideTrigger").on("click", function () {
        $(".right-side-content").toggleClass("active");
    });

    sideMenuArea.on("mouseenter", function () {
        pageWrapper.addClass("sidemenu-hover-active");
        pageWrapper.removeClass("sidemenu-hover-deactive");
    });

    sideMenuArea.on("mouseleave", function () {
        pageWrapper.removeClass("sidemenu-hover-active");
        pageWrapper.addClass("sidemenu-hover-deactive");
    });

})(jQuery);