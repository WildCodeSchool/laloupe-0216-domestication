jQuery(document).ready(function ($) {



    if (window.matchMedia('(max-width: 767px)').matches) {
        if (jQuery('.res-nav-header').is(':visible'))
            jQuery('.scroll-header .social-icon').css({position: 'absolute'});
        else {
            jQuery('.scroll-header .social-icon').css({position: 'relative'});
        }
    }
    if (jQuery(window).width() >= 767) {
        jQuery("section").css({'margin-top': jQuery("header").height()});
    }
    if (jQuery('div').hasClass('about-us-content')) {
        jQuery("#about-slider").owlCarousel({
            autoPlay: true,
            items: 3,
            itemsDesktop: [1199, 2],
            itemsTablet: [768, 2],
            itemsDesktopSmall: [979, 2],
            itemsMobile: [600, 1]
        });
    }
    if (jQuery('div').hasClass('blog-slider-details')) {
        jQuery("#blog-slider").owlCarousel({
            autoPlay: true,
            items: 3,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [979, 2],
            itemsTablet: [768, 2],
            itemsMobile: [567, 1]
        });
    }

    var $container = jQuery('.masonry-container');
    var gutter = 30;
    var min_width = 300;
    $container.imagesLoaded(function () {
        $container.masonry({
            itemSelector: '.box',
            gutterWidth: gutter,
            isAnimated: true,
            columnWidth: function (containerWidth) {
                var box_width = (((containerWidth - 2 * gutter) / 3) | 0);
                if (box_width < min_width) {
                    box_width = (((containerWidth - gutter) / 2) | 0);
                }
                if (box_width < min_width) {
                    box_width = containerWidth - 15;
                }
                jQuery('.box').width(box_width);
                return box_width;
            }
        });
    });
});
jQuery(window).resize(function ($) {
    if (jQuery(window).width() >= 767) {
        jQuery("section").css({'margin-top': jQuery("header").height()});
    }
});