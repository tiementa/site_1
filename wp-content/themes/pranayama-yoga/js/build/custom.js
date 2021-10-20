jQuery(document).ready(function ($) {

    var rtl;

    if (pranayama_yoga_data.rtl == '1') {
        rtl = true;
    } else {
        rtl = false;
    }

    $(".tabs-menu a").on('click', function (event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });

    $(".testimonial-tabs-menu a").on('click', function (event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".testimonial-tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });

    /* Equal Height */
    $('.section-three .col').matchHeight({
        byRow: true,
        property: 'height',
        target: null,
        remove: false
    });

    $('.site-header .header-b .btn-search .header-search-modal').on('click', function (event) {
        event.stopPropagation();
    });

    $('html').on('click', function () {
        $('.site-header .header-search-modal').slideUp();
    });

    $(".site-header .header-b .btn-search .search").on('click', function () {
        $(".site-header .header-search-modal").slideToggle();
        return false;
    });

    //closebutton
    $(".site-header .header-b .btn-search .close").on('click', function () {
        $(".site-header .header-search-modal").slideToggle();
        return false;
    });

    $('.mobile-navigation').hide()
        ;
    $(".testimonial-tabs-menu").owlCarousel({
        // Most important owl features
        items: 3,
        // Navigation
        nav: false,
        margin: 20,
        rtl: rtl,
        mouseDrag: false,
        rewindNav: false,
        pagination: false,
        itemsTablet: [768, 3],
        itemsMobile: [767, 1],
    });

    var wsize = $(window).width();
    if (wsize > 767) {
        $(".testimonial .testimonial-tabs-menu .owl-stage div:nth-child(2)").addClass("current");
    } else {
        $(".testimonial .testimonial-tabs-menu .owl-stage div:first-child").addClass("current");
    }

    //ul accessibility
    $('<button class="angle-down"></button>').insertAfter($('.mobile-menu ul .menu-item-has-children > a'));
    $('.mobile-menu ul li .angle-down').click(function () {
        $(this).next().slideToggle();
        $(this).toggleClass('active');
    });

    $('.menu-opener').click(function () {
        $('.mobile-menu').animate({
            width: 'toggle',
        });
        $('body').addClass('menu-open');
    });

    $('.mobile-menu .close').click(function () {
        $('.mobile-menu').animate({
            width: 'toggle',
        });
        $('body').removeClass('menu-open');
    });

    $('.overlay').click(function () {
        $('.mobile-menu').animate({
            width: 'toggle',
        });
        $('body').removeClass('menu-open');
    });

    if (wsize > 1024) {
        $("#site-navigation ul li a").on('focus', function () {
            $(this).parents("li").addClass("focus");
        }).on('blur', function () {
            $(this).parents("li").removeClass("focus");
        });
    }
    //window width and remove classes
    var windowWidth = window.innerWidth;
    window.addEventListener('resize', function () {
        if (windowWidth >= 1024) {
            document.body.classList.remove('menu-open');
        }
    });
});
