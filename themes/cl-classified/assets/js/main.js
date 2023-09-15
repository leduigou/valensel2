;(function ($) {
    $(document).ready(function () {
        // Scroll Top Button
        $(".scrollToTop").on("click", function () {
            $("body,html").animate(
                {
                    scrollTop: 0,
                },
                360
            );
        });
        $(window).on("scroll", function () {
            var scrollBar = $(this).scrollTop();

            if (scrollBar > 200) {
                $(".scrollToTop").fadeIn();
            } else {
                $(".scrollToTop").fadeOut();
            }
        });
        // Sticky Menu
        if (CLClassified.hasStickyMenu == 1) {
            run_sticky_menu();
        }
        // Mobile menu
        var a = $('.offscreen-navigation .menu');
        if (a.length) {
            a.children("li").addClass("menu-item-parent");
            a.find(".menu-item-has-children > a").on("click", function (e) {
                e.preventDefault();
                $(this).toggleClass("opened");
                var n = $(this).next(".sub-menu"),
                    s = $(this).closest(".menu-item-parent").find(".sub-menu");
                a.find(".sub-menu").not(s).slideUp(250).prev('a').removeClass('opened'), n.slideToggle(250)
            });
            a.find('.menu-item:not(.menu-item-has-children) > a').on('click', function (e) {
                $('.rt-slide-nav').slideUp();
                $('body').removeClass('slidemenuon');
            });
        }

        $('.sidebarBtn').on('click', function (e) {
            e.preventDefault();
            if ($('.rt-slide-nav').is(":visible")) {
                $('.rt-slide-nav').slideUp();
                $('body').removeClass('slidemenuon');
            } else {
                $('.rt-slide-nav').slideDown();
                $('body').addClass('slidemenuon');
            }

        });

        // Tooltip
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    });

    function run_sticky_menu() {

        var wrapperHtml = $('<div class="main-header-sticky-wrapper"></div>');
        var wrapperClass = '.main-header-sticky-wrapper';

        $('.main-header').clone(true).appendTo(wrapperHtml);
        $('body').append(wrapperHtml);

        var height = $(wrapperClass).outerHeight() + 30;

        $(wrapperClass).css('margin-top', '-' + height + 'px');

        $(window).scroll(function () {
            if ($(this).scrollTop() > 300) {
                $('body').addClass('rdthemeSticky');
            } else {
                $('body').removeClass('rdthemeSticky');
            }
        });
    }

}(jQuery));