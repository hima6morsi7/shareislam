(function (e) {
    "use strict";
    var n = window.AFTHRAMPES_JS || {};
    $ = jQuery;

    n.mobileMenu = {
        init: function () {
            this.toggleMenu(), this.menuMobile(), this.menuArrow()
        },
        toggleMenu: function () {
            e('#masthead').on('click', '.toggle-menu', function (event) {
                var ethis = e('.main-navigation .menu .menu-mobile');
                if (ethis.css('display') == 'block') {
                    ethis.slideUp('300');
                } else {
                    ethis.slideDown('300');
                }
                e('.ham').toggleClass('exit');
            });


            e('#masthead .main-navigation ').on('click', '.menu-mobile a i', function (event) {
                event.preventDefault();
                var ethis = e(this),
                    eparent = ethis.closest('li');

                if (eparent.find('> .children').length) {
                    var esub_menu = eparent.find('> .children');
                } else {
                    var esub_menu = eparent.find('> .sub-menu');
                }


                if (esub_menu.css('display') == 'none') {
                    esub_menu.slideDown('300');
                    ethis.addClass('active');
                } else {
                    esub_menu.slideUp('300');
                    ethis.removeClass('active');
                }
                return false;
            });
        },
        menuMobile: function () {
            if (e('.main-navigation .menu > ul').length) {
                var ethis = e('.main-navigation .menu > ul'),
                    eparent = ethis.closest('.main-navigation'),
                    pointbreak = eparent.data('epointbreak'),
                    window_width = window.innerWidth;
                if (typeof pointbreak == 'undefined') {
                    pointbreak = 991;
                }
                if (pointbreak >= window_width) {
                    ethis.addClass('menu-mobile').removeClass('menu-desktop');
                    e('.main-navigation .toggle-menu').css('display', 'block');
                } else {
                    ethis.addClass('menu-desktop').removeClass('menu-mobile').css('display', '');
                    e('.main-navigation .toggle-menu').css('display', '');
                }
            }
        },
        menuArrow: function () {
            if (e('#masthead .main-navigation div.menu > ul').length) {
                e('#masthead .main-navigation div.menu > ul .sub-menu').parent('li').find('> a').append('<i class="">');
                e('#masthead .main-navigation div.menu > ul .children').parent('li').find('> a').append('<i class="">');
            }
        }
    },


        n.DataBackground = function () {
            var pageSection = e(".data-bg");
            pageSection.each(function (indx) {
                if (e(this).attr("data-background")) {
                    e(this).css("background-image", "url(" + e(this).data("background") + ")");
                }
            });

            e('.bg-image').each(function () {
                var src = e(this).children('img').attr('src');
                e(this).css('background-image', 'url(' + src + ')').children('img').hide();
            });
        },

        n.setInstaHeight = function () {
            e('.insta-slider-block').each(function () {
                var img_width = e(this).find('.insta-item .af-insta-height').eq(0).innerWidth();
                e(this).find('.insta-item .af-insta-height').css('height', img_width);
            });
        },


        n.setHeaderHeight = function () {
            if (e('#main-navigation-bar').length > 0) {
                var menuHeight = e('#main-navigation-bar').outerHeight();
                e('.header-menu-part').height(menuHeight);
            }
        },


        n.Preloader = function () {
            e(window).load(function () {
                e('#loader-wrapper').fadeOut();
                e('#af-preloader').delay(500).fadeOut('slow');

            });
        },

        n.Search = function () {
            e(window).load(function () {
                e(".af-search-click").on('click', function () {
                    e("#af-search-wrap").toggleClass("af-search-toggle");
                });
            });
        },

        n.Offcanvas = function () {
            e('.offcanvas-nav').sidr({
                side: 'left'
            });

            e('.sidr-class-sidr-button-close').on('click', function () {
                e.sidr('close', 'sidr');
            });
        },

        // SHOW/HIDE SCROLL UP //
        n.show_hide_scroll_top = function () {
            if (e(window).scrollTop() > e(window).height() / 2) {
                e("#scroll-up").fadeIn(300);
            } else {
                e("#scroll-up").fadeOut(300);
            }
        },

        n.scroll_up = function () {
            e("#scroll-up").on("click", function () {
                e("html, body").animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        },


        n.MagnificPopup = function () {

            e('.gallery').each(function () {
                e(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        opener: function (element) {
                            return element.find('img');
                        }
                    }
                });
            });

            e('.wp-block-gallery').each(function () {
                e(this).magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        opener: function (element) {
                            return element.find('img');
                        }
                    }
                });
            });
        },

        n.searchReveal = function () {
            jQuery('.search-overlay .search-icon').on('click', function () {
                jQuery(this).parent().toggleClass('reveal-search');
                return false;
            });
        },

        n.em_sticky = function () {
            jQuery('.sidebar-area.aft-sticky-sidebar').theiaStickySidebar({
                additionalMarginTop: 30
            });
        },

        n.jQueryMarquee = function () {
            e('.marquee.aft-flash-slide').marquee({
                //duration in milliseconds of the marquee
                speed: 80000,
                //gap in pixels between the tickers
                gap: 0,
                //time in milliseconds before the marquee will start animating
                delayBeforeStart: 0,
                //'left' or 'right'
                // direction: 'right',
                //true or false - should the marquee be duplicated to show an effect of continues flow
                duplicated: true,
                pauseOnHover: true,
                startVisible: true
            });
        },


        n.SliderAsNavFor = function () {
            if (e('.banner-single-slider-1-wrap').hasClass("no-thumbnails")) {
                return null;
            } else {
                return '.af-banner-slider-thumbnail';
            }
        },
        n.RtlCheck = function () {
            if (e('body').hasClass("rtl")) {
                return true;
            } else {
                return false;
            }
        },


        //slick slider
        n.SlickBannerSlider = function () {
            e(".af-banner-slider").slick({
                autoplay: true,
                infinite: true,
                nextArrow: '<span class="slide-icon slide-next af-slider-btn"></span>',
                prevArrow: '<span class="slide-icon slide-prev af-slider-btn"></span>',
                appendArrows: e('.af-main-banner-navcontrols'),
                asNavFor: n.SliderAsNavFor(),
                rtl: n.RtlCheck()
            });
        },

        n.SlickBannerSliderThumbsVertical = function () {
            e(".af-banner-slider-thumbnail.vertical").slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 12000,
                speed: 1000,
                vertical: true,
                verticalSwiping: true,
                nextArrow: false,
                prevArrow: false,
                asNavFor: '.af-banner-slider',
                focusOnSelect: true,
                responsive: [
                    {
                        breakpoint: 770,
                        settings: {
                            vertical: false,
                            verticalSwiping: false,
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 601,
                        settings: {
                            vertical: false,
                            verticalSwiping: false,
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            vertical: false,
                            verticalSwiping: false,
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        },


        //Slick Carousel


        n.SlickBannerCarousel = function () {
            e(".af-banner-carousel-1").slick({
                autoplay: true,
                infinite: true,
                nextArrow: '<span class="slide-icon slide-next af-slider-btn"></span>',
                prevArrow: '<span class="slide-icon slide-prev af-slider-btn"></span>',
                rtl: n.RtlCheck(),
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        },


        n.SlickTrendingPostVertical = function () {
            e(".trending-posts-vertical ").not('.slick-initialized').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 12000,
                speed: 1000,
                vertical: true,
                verticalSwiping: true,
                nextArrow: false,
                prevArrow: false,
                focusOnSelect: true,
                // rtl: n.RtlCheck(),
                responsive: [
                    {
                        breakpoint: 770,
                        settings: {
                            verticalSwiping: false,
                        }
                    },
                    {
                        breakpoint: 601,
                        settings: {
                            verticalSwiping: false,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            verticalSwiping: false,
                        }
                    }
                ]
            });
        },

        n.SlickBannerTrendingPostVertical = function () {
            e(".af-main-banner-trending-posts-vertical-carousel").not('.slick-initialized').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 12000,
                speed: 1000,
                vertical: true,
                verticalSwiping: true,
                nextArrow: false,
                prevArrow: false,
                focusOnSelect: true,
                responsive: [
                    {
                        breakpoint: 770,
                        settings: {
                            verticalSwiping: false,
                        }
                    },
                    {
                        breakpoint: 601,
                        settings: {
                            verticalSwiping: false,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            verticalSwiping: false,
                        }
                    }
                ]
            });
        },

        n.SlickBannerTrendingPostVerticalAlternate = function () {
            e(".af-main-banner-trending-posts-carousel-vertical-alternate").not('.slick-initialized').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 12000,
                speed: 1000,
                vertical: true,
                verticalSwiping: true,
                nextArrow: false,
                prevArrow: false,
                focusOnSelect: true,
                responsive: [
                    {
                        breakpoint: 770,
                        settings: {
                            verticalSwiping: false,
                        }
                    },
                    {
                        breakpoint: 601,
                        settings: {
                            verticalSwiping: false,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            verticalSwiping: false,
                        }
                    }
                ]
            });
        },


        n.SlickBannerTrendingPostHorizontal = function () {
            e(".af-main-banner-trending-posts-carousel").not('.slick-initialized').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                infinite: true,
                nextArrow: '<span class="slide-icon slide-next af-slider-btn"></span>',
                prevArrow: '<span class="slide-icon slide-prev af-slider-btn"></span>',
                rtl: n.RtlCheck(),
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        },

        n.SlickPostSlider = function () {
            e(".af-post-slider").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                infinite: true,
                nextArrow: '<span class="slide-icon slide-next af-slider-btn"></span>',
                prevArrow: '<span class="slide-icon slide-prev af-slider-btn"></span>',
                rtl: n.RtlCheck()
            });
        },

        n.SlickPostCarousel = function () {
            e(".af-post-carousel").not('.slick-initialized').slick({
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: true,
                infinite: true,
                nextArrow: '<span class="slide-icon slide-next af-slider-btn"></span>',
                prevArrow: '<span class="slide-icon slide-prev af-slider-btn"></span>',
                rtl: n.RtlCheck(),
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        },

        n.SlickPostAboveMainBannerCarousel = function () {
            e("#home-above-main-banner-widgets .af-post-carousel").not('.slick-initialized').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                infinite: true,
                nextArrow: '<span class="slide-icon slide-next af-slider-btn"></span>',
                prevArrow: '<span class="slide-icon slide-prev af-slider-btn"></span>',
                rtl: n.RtlCheck(),
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        },


        n.SlickPostBelowMainBannerCarousel = function () {
            e("#home-below-main-banner-widgets .af-post-carousel").not('.slick-initialized').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                infinite: true,
                nextArrow: '<span class="slide-icon slide-next af-slider-btn"></span>',
                prevArrow: '<span class="slide-icon slide-prev af-slider-btn"></span>',
                rtl: n.RtlCheck(),
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        },


        n.SlickPostFullWidthCarousel = function () {
            e(".frontpage-layout-3 .af-post-carousel").not('.slick-initialized').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                infinite: true,
                nextArrow: '<span class="slide-icon slide-next af-slider-btn"></span>',
                prevArrow: '<span class="slide-icon slide-prev af-slider-btn"></span>',
                rtl: n.RtlCheck(),
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        },


        n.SlickPostSingleSidebarCarousel = function () {
            e(".content-with-single-sidebar .af-post-carousel").not('.slick-initialized').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                infinite: true,
                nextArrow: '<span class="slide-icon slide-next af-slider-btn"></span>',
                prevArrow: '<span class="slide-icon slide-prev af-slider-btn"></span>',
                rtl: n.RtlCheck(),
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        },

        //Slick Carousel
        n.SlickCarouselSecondary = function () {
            e("#secondary .af-post-carousel").not('.slick-initialized').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 12000,
                infinite: true,
                centerMode: false,
                nextArrow: '<span class="slide-icon slide-next af-slider-btn"></span>',
                prevArrow: '<span class="slide-icon slide-prev af-slider-btn"></span>',
                rtl: n.RtlCheck(),

            });
        },

        //Slick Carousel
        n.SlickCarouselTtertiary = function () {
            e("#tertiary .af-post-carousel").not('.slick-initialized').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 12000,
                infinite: true,
                centerMode: false,
                nextArrow: '<span class="slide-icon slide-next af-slider-btn"></span>',
                prevArrow: '<span class="slide-icon slide-prev af-slider-btn"></span>',
                rtl: n.RtlCheck(),

            });
        },

        n.SlickCarouselSidr = function () {
            e("#sidr .af-post-carousel").not('.slick-initialized').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 12000,
                infinite: true,
                centerMode: false,
                nextArrow: '<span class="slide-icon slide-next af-slider-btn"></span>',
                prevArrow: '<span class="slide-icon slide-prev af-slider-btn"></span>',
                rtl: n.RtlCheck(),

            });
        },


        n.SlickCarouselFooter = function () {
            e(".site-footer .af-post-carousel").not('.slick-initialized').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 12000,
                infinite: true,
                centerMode: false,
                nextArrow: '<span class="slide-icon slide-next af-slider-btn"></span>',
                prevArrow: '<span class="slide-icon slide-prev af-slider-btn"></span>',
                rtl: n.RtlCheck(),

            });
        },

        n.SlickYoutubeVideo = function () {
            e(".af-youtube-slider-thumbnail").not('.slick-initialized').slick({
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 12000,
                infinite: true,
                nextArrow: '<span class="slide-icon slide-next af-slider-btn"></span>',
                prevArrow: '<span class="slide-icon slide-prev af-slider-btn"></span>',
                rtl: n.RtlCheck(),
                responsive: [
                    {
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true,
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    }
                ]
            });
        },


        //Video thumbnail
        n.YouTubeThumbnail = function () {
            e('.af-custom-thumbnail').on('click', function () {
                e(this).parents('.slider-pro').find('.af-hide-iframe').addClass('af-display-iframe');
                e(this).parents('.slider-pro').find('iframe').addClass('af-display-iframe');
                if (e(this).parents('.slider-pro').find('.fluid-width-video-wrapper').length > 0) {
                    e(this).parents('.slider-pro').find('.fluid-width-video-wrapper').addClass('af-iframe-added');
                }

                e(this).parents('.slider-pro').find('.vid_frame').removeAttr('src');
                e(this).parents('.slider-pro').find('.af-video-wrap').removeAttr('data-video-link');
                var selected_vdo_link = e(this).data('video');
                e(this).parents('.slider-pro').find('.af-video-wrap').attr('data-video-link', selected_vdo_link);
                var img = e(this).data('item');
                e(this).parents('.slider-pro').find('.af-video-wrap').css('background-image', 'url(' + img + ')');
                e(this).parents('.slider-pro').find('.af-video-wrap').css('padding-top', '50%');

            });

            e('.af-video-wrap').on('click', function () {
                e(this).parents('.slider-pro').find('.vid_frame').removeAttr('src');
                e(this).parents('.slider-pro').find('.af-hide-iframe').removeClass('af-display-iframe');
                e(this).parents('.slider-pro').find('.fluid-width-video-wrapper').removeClass('af-iframe-added');
                e(this).parents('.slider-pro').find('.fluid-width-video-wrapper').addClass('asd');

                e(this).css('padding-top', 0);
                var video_link = e(this).attr('data-video-link');

                e(this).parents('.slider-pro').find('.vid_frame').attr('src', video_link);
                e(".vid-container").fitVids();

            });

            /*JS FOR SCROLLING THE ROW OF THUMBNAILS*/

            e('.first_thb_img').each(function () {
                var active_banner = e(this).data('item');
                var first_video = e(this).data('video');
                e(this).parents('.slider-pro').find('.af-video-wrap').css('padding-top', '50%');
                e(this).parents('.slider-pro').find('.af-hide-iframe').addClass('af-display-iframe');

                e(this).parents('.slider-pro').find('.af-video-wrap').css('background-image', 'url(' + active_banner + ')');
                e(this).parents('.slider-pro').find('.af-video-wrap').attr('data-video-link', first_video);
            });


            e(".vid-item").each(function (index) {
                e(this).on("click", function () {
                    var current_index = index + 1;
                    e(".vid-item .thumb").removeClass("active");
                    e(".vid-item:nth-child(" + current_index + ") .thumb").addClass("active");
                });
            });


        },

        n.SlickInstagtram = function () {

            e('.instagram-carousel').slick({
                slidesToShow: 6,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 12000,
                infinite: true,
                nextArrow: '<span class="slide-icon slide-next af-slider-btn"></span>',
                prevArrow: '<span class="slide-icon slide-prev af-slider-btn"></span>',
                rtl: n.RtlCheck(),

                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

        },


        n.MasonryBlog = function () {
            if (e('.aft-masonry-archive-posts').length > 0) {
                jQuery('.aft-masonry-archive-posts').masonry();
            }
        },

        e(document).ready(function () {
            n.mobileMenu.init(),
                n.DataBackground(),
                n.setInstaHeight(),
                n.em_sticky(),
                n.MagnificPopup(),
                n.jQueryMarquee(),
                n.Preloader(),
                n.setHeaderHeight(),
                n.Search(),
                n.Offcanvas(),
                n.searchReveal(),
                n.scroll_up(),
                n.SlickBannerSlider(),
                n.SlickBannerSliderThumbsVertical(),
                n.SlickTrendingPostVertical(),
                n.SlickBannerTrendingPostVerticalAlternate(),
                n.SlickBannerTrendingPostVertical(),
                n.SlickBannerTrendingPostHorizontal(),
                n.SlickBannerCarousel(),
                n.SlickPostSlider(),
                n.SlickCarouselSecondary(),
                n.SlickCarouselTtertiary(),
                n.SlickCarouselSidr(),
                n.SlickCarouselFooter(),
                n.SlickPostAboveMainBannerCarousel(),
                n.SlickPostBelowMainBannerCarousel(),
                n.SlickPostFullWidthCarousel(),
                n.SlickPostSingleSidebarCarousel(),
                n.SlickPostCarousel(),
                n.SlickYoutubeVideo(),
                n.YouTubeThumbnail(),
                n.SlickInstagtram();

        }), e(window).scroll(function () {
        n.show_hide_scroll_top();
    }), e(window).resize(function () {
        n.mobileMenu.menuMobile();
    }), e(window).load(function () {
        n.MasonryBlog();

    })
})(jQuery);