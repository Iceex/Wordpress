(function ($) {
    'use strict';
    var $body = $('body');

    function singleProductGalleryImages() {
        var rtl = $body.hasClass('rtl') ? true : false;

        var lightbox = $('.single-product .woocommerce-product-gallery__image > a');
        if (lightbox.length) {
            lightbox.attr("data-elementor-open-lightbox", "no");
        }
        var $flex_control = $('.flex-control-thumbs', '.woocommerce-product-gallery');
        if ($flex_control.length) {
            if ($('.woocommerce-product-gallery-horizontal').length) {
                var c_width = 0,
                    p_width = $flex_control.outerWidth(true);
                $('.woocommerce-product-gallery-horizontal .flex-control-thumbs li').each(function () {
                    c_width += $(this).outerWidth(true);
                });
                var $slick_slider = $('.woocommerce-product-gallery.woocommerce-product-gallery-horizontal .flex-control-thumbs');
                if (c_width > p_width) {
                    if (!$slick_slider.hasClass('slick-initialized')) {
                        $slick_slider.css({
                            "padding-right": 35,
                        }).slick({
                            rtl: rtl,
                            infinite: false,
                            slidesToShow: 1,
                            variableWidth: true
                        });
                    }
                } else {
                    if ($slick_slider.hasClass('slick-initialized')) {
                        $slick_slider.slick('unslick');
                    }
                }

                $slick_slider.on('afterChange', function (e, slick) {
                    var lElRect = slick.$slides[slick.slideCount - 1].getBoundingClientRect();
                    var rOffset = lElRect.x + lElRect.width;
                    var wraRect = $('.slick-list', $slick_slider).get(0).getBoundingClientRect();
                    if (rOffset < (wraRect.x + wraRect.width)) {
                        $('.slick-next', $slick_slider).addClass('slick-disabled');
                    }
                });
            }

            if ($('.woocommerce-product-gallery-vertical').length) {
                var $image = $('.woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:eq(0) .wp-post-image');

                if ($image) {
                    setTimeout(function () {
                        var setHeight = $image.closest('.woocommerce-product-gallery__image').height();

                        var $slick_slider_h = $('.woocommerce-product-gallery.woocommerce-product-gallery-vertical .flex-control-thumbs');

                        if (setHeight) {
                            $slick_slider_h.height(setHeight);
                        }
                        var c_height = 0;
                        $('.woocommerce-product-gallery-vertical .flex-control-thumbs li').each(function () {
                            c_height += $(this).outerHeight(true);
                        });

                        if (c_height > setHeight) {
                            if (!$slick_slider_h.hasClass('slick-initialized')) {
                                $slick_slider_h.slick({
                                    rtl: rtl,
                                    infinite: false,
                                    vertical: true,
                                });
                            }
                        } else {
                            if ($slick_slider_h.hasClass('slick-initialized')) {
                                $slick_slider_h.slick('unslick');
                            }
                        }

                        $slick_slider_h.on('afterChange', function (e, slick) {
                            var lElRect = slick.$slides[slick.slideCount - 1].getBoundingClientRect();
                            var rOffset = lElRect.y + lElRect.height;
                            var wraRect = $('.slick-list', $slick_slider_h).get(0).getBoundingClientRect();
                            if (rOffset < (wraRect.y + wraRect.height)) {
                                $('.slick-next', $slick_slider_h).addClass('slick-disabled');
                            }
                        });

                    }, 500);
                }
            }
        }

        var $gallery_style = $('.woocommerce-product-gallery-gallery .woocommerce-product-gallery__wrapper');
        if ($gallery_style.length) {
            $gallery_style.slick({
                rtl: rtl,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                adaptiveHeight: true,
                centerMode: true,
            })
        }
    }

    $('.woocommerce-product-gallery').on('wc-product-gallery-after-init', function () {
        setTimeout(function () {
            singleProductGalleryImages();
        },1000);
    });

    $(window).resize(function () {
        singleProductGalleryImages();
    });


    function popup_video() {
        $('a.btn-video').magnificPopup({
            type: 'iframe',
            disableOn: 700,
            removalDelay: 160,
            midClick: true,
            closeBtnInside: true,
            preloader: false,
            fixedContentPos: false
        });

        $('a.btn-360').magnificPopup({
            type: 'inline',

            fixedContentPos: false,
            fixedBgPos: true,

            overflowY: 'auto',

            closeBtnInside: true,
            preloader: false,

            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in',
            callbacks: {
                open: function() {
                    var spin = $('#rotateimages');
                    var images = spin.data('images');
                    var imagesarray = images.split(",");
                    var api;
                    spin.spritespin({
                        source: imagesarray,
                        width: 800,
                        height: 800,
                        sense: -1,
                        responsive: true,
                        animate: false,
                        onComplete: function () {
                            $(this).removeClass('opal-loading');
                        }
                    });

                    api = spin.spritespin("api");

                    $('.view-360-prev').click(function(){
                        api.stopAnimation();
                        api.prevFrame();
                    });

                    $('.view-360-next').click(function(){
                        api.stopAnimation();
                        api.nextFrame();
                    });

                }
            }
        });
    }

    function sizechart_popup() {

        $('.sizechart-button').on('click', function (e) {
            e.preventDefault();
            $('.sizechart-popup').toggleClass('active');
        });

        $('.sizechart-close,.sizechart-overlay').on('click', function (e) {
            e.preventDefault();
            $('.sizechart-popup').removeClass('active');
        });
    }

    function onsale_gallery_vertical() {
        $('.woocommerce-product-gallery.woocommerce-product-gallery-vertical:not(:has(.flex-control-thumbs))').css('max-width', '690px').next().css('left', '10px');
    }

    function output_accordion(){
        $('.js-card-body.active').slideDown();
        /*   Produc Accordion   */
        $('.js-btn-accordion').on('click', function(){
            if( !$(this).hasClass('active') ){
                $('.js-btn-accordion').removeClass('active');
                $('.js-card-body').removeClass('active').slideUp();
            }
            $(this).toggleClass('active');
            var card_toggle = $(this).parent().find('.js-card-body');
            card_toggle.slideToggle();
            card_toggle.toggleClass('active');

            setTimeout(function () {
                $('.product-sticky-layout').trigger('sticky_kit:recalc');
            }, 1000);
        });
    }

    function _makeStickyKit() {
        var top_sticky = 20,
            $adminBar = $('#wpadminbar');

        if ($adminBar.length > 0) {
            top_sticky += $adminBar.height();
        }

        if (window.innerWidth < 992) {
            $('.product-sticky-layout').trigger('sticky_kit:detach');
        } else {
            $('.product-sticky-layout').stick_in_parent({
                offset_top: top_sticky
            });

        }
    }

    $body.on('click', '.wc-tabs li a, ul.tabs li a', function (e) {
        e.preventDefault();
        var $tab = $(this);
        var $tabs_wrapper = $tab.closest('.wc-tabs-wrapper, .woocommerce-tabs');
        var $control = $tab.closest('li').attr('aria-controls');
        $tabs_wrapper.find('.resp-accordion').removeClass('active');
        $('.' + $control).addClass('active');

    }).on('click', 'h2.resp-accordion', function (e) {
        e.preventDefault();
        var $tab = $(this);
        var $tabs_wrapper = $tab.closest('.wc-tabs-wrapper, .woocommerce-tabs');
        var $tabs = $tabs_wrapper.find('.wc-tabs, ul.tabs');

        if ($tab.hasClass('active')) {
            return;
        }
        $tabs_wrapper.find('.resp-accordion').removeClass('active');
        $tab.addClass('active');
        $tabs.find('li').removeClass('active');
        $tabs.find($tab.data('control')).addClass('active');
        $tabs_wrapper.find('.wc-tab, .panel:not(.panel .panel)').hide(300);
        $tabs_wrapper.find($tab.attr('aria-controls')).show(300);

    });

   function initSlideProduct() {
        var $sinlge_slider    = $('.single-product div.product .images'),
            $widthwrap = $sinlge_slider.find('.flex-viewport').width(),
            $image     = $sinlge_slider.find('.woocommerce-product-gallery__image > a');
        $image.css({
            'max-width': $widthwrap,
            'display'  : 'block'
        });
    }

    $(document).ready(function () {
        initSlideProduct();
        sizechart_popup();
        onsale_gallery_vertical();
        popup_video();
        output_accordion();

        if ($('.product-sticky-layout').length > 0) {
            _makeStickyKit();
            $(window).resize(function(){
                setTimeout(function () {
                    _makeStickyKit();
                }, 100);
            });
        }

    });

})(jQuery);

