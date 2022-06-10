(function ($) {
    "use strict";

    var pickApp = {
        /* ---------------------------------------------
         Preloader
         --------------------------------------------- */
        preloader: function() {
            $(window).on('load', function () {
                $("body").imagesLoaded(function(){
                    $('.preloader').delay(500).slideUp('slow', function() {
                        $(this).remove();
                    });
                });
            });
        },
        /* ---------------------------------------------
         Top Search
         --------------------------------------------- */
        top_search: function () {
            $('#top-search').clone().addClass('mobile-search').appendTo('#masthead .menuexpandermain');
            $('#search-btn, #top-search .mobile-search #search-btn').on('click', function () {
                $('#search-screen').fadeIn('500');
            });
            $('#search-screen .search-close').on('click', function () {
                $('#search-screen').fadeOut('slow');
            });
        },
        /* ---------------------------------------------
         Menu
         --------------------------------------------- */
        menu: function() {
            var items = $('.overlapblackbg, .slideLeft'),
                menucontent = $('.menucontent'),
                submenu = $('.menu-list li').has('.menu-submenu'),
                menuopen = function() {
                   $(items).removeClass('menuclose').addClass('menuopen');
                },
                menuclose = function() {
                   $(items).removeClass('menuopen').addClass('menuclose');
                };
            $('#navToggle').on('click', function() {
                if (menucontent.hasClass('menuopen')) {
                    $(menuclose);
                } else {
                    $(menuopen);
                }
            });
            menucontent.on('click', function() {
                if (menucontent.hasClass('menuopen')) {
                    $(menuclose);
                }
            });
            $('#navToggle,.overlapblackbg').on('click', function() {
                $('.menucontainer').toggleClass("mrginleft");
            });          
            if(submenu) {
                $('.menu-submenu').prev().append('<span class="fa fa-angle-down"></span>');
            }
            submenu.prepend('<span class="menu-click"><i class="menu-arrow fa fa-plus"></i></span>');
            $('.menu-mobile').on('click', function() {
                $('.menu-list').slideToggle('slow');
            });
            $('.menu-click').on('click', function() {
                $(this).siblings('.menu-submenu').slideToggle('slow');
                $(this).children('.menu-arrow').toggleClass('menu-extend');
            });
        },
        /* ---------------------------------------------
         smooth scroll
         --------------------------------------------- */
        smoothscroll: function() {
            if (typeof smoothScroll == 'object') {
                smoothScroll.init();
            }
        },
        /* ---------------------------------------------
         Pick Video
         --------------------------------------------- */
        video: function () {
            $("#featured-item .post-thumb").fitVids();
            $(".content-area").fitVids();
        },
        /* ---------------------------------------------
         Pick Featured Area
         --------------------------------------------- */
        featured_area: function () {
            if (typeof pick !== 'undefined') {
                var featured_post_auto_slide = pick.featured_post_auto_slide;
                var featured_slide_speed = pick.featured_slide_speed;
                var featured_autoplay_timeout = pick.featured_autoplay_timeout;
                var featured_post_in_slider = pick.featured_post_in_slider;
            }
            if (featured_post_auto_slide == 1) {
                var featured_post_auto_slide = true;
            } else {
                var featured_post_auto_slide = false;
            }

            var check_rtl = pick.check_rtl;
            if (check_rtl == 0) {
                var check_rtl = false;
            } else {
                var check_rtl = true;
            }
            
            $('#featured-item').owlCarousel({
                rtl: check_rtl,
                center: false,
                items: (featured_post_in_slider) ? featured_post_in_slider : 3,
                autoplay: featured_post_auto_slide,
                autoplayTimeout: featured_autoplay_timeout,
                autoplaySpeed: featured_slide_speed,
                navSpeed: featured_slide_speed,
                autoplayHoverPause: true,
                singleItem: true,
                loop: true,
                margin: 30,
                nav: true,
                dots: false,
                navText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                responsive:{
                    280:{
                        items: 1
                    },
                    500:{
                        items: 1
                    },
                    600:{
                        items: 2
                    },
                    800:{
                        items: 2
                    },
                    1000:{
                        items: (featured_post_in_slider) ? featured_post_in_slider : 3
                    },
                    1200:{
                        items:(featured_post_in_slider) ? featured_post_in_slider : 3
                    },
                    1400:{
                        items: (featured_post_in_slider) ? featured_post_in_slider : 3
                    },
                }
            });  
        },
        /* ---------------------------------------------
         Pick Masonry And Infinity Scroll
         --------------------------------------------- */
        masonry: function() {
            if ($('#masonry-layout').length > 0) {
                var container = $('#masonry-layout');
                container.imagesLoaded(function () {
                    container.masonry({
                        itemSelector: '#masonry-layout > div > [class*="col-"]',
                        columnWidth: '.grid',
                        percentPosition: true
                    });
                });
                $(window).on('resize', function() {
                    container.masonry('layout');
                });
            }

            if ($('#pick-theme-infinity-scroll').length > 0) {
                    var $infinity_container = $('#pick-theme-infinity-scroll');
                    if (typeof pick !== 'undefined') {
                        var infinity_scroll_img = pick.infinity_scroll_img;
                    }
                    $infinity_container.infinitescroll({
                    navSelector  : '.paging-navigation',    // selector for the paged navigation
                    nextSelector : '.paging-navigation .nav-next a',  // selector for the NEXT link (to page 2)
                    itemSelector : '.grid, .full-width',     // selector for all items you'll retrieve
                    loading: {
                        finishedMsg: 'No more pages to load.',
                        img: infinity_scroll_img
                      }
                    },
                    // trigger Masonry as a callback
                    function( newElements ) {
                      // hide new items while they are loading
                      var $newElems = $( newElements ).css({ opacity: 0 });
                      // ensure that images load before adding to masonry layout
                      $newElems.imagesLoaded(function(){
                        // show elems now they're ready
                        $newElems.animate({ opacity: 1 });
                        if (pick.list_layout == false) {
                          container.masonry( 'appended', $newElems, true );                            
                        }
                      });
                    }
                );
            }
        },   
        /* ---------------------------------------------
         Sticky Fix
         --------------------------------------------- */
        sticky: function () {
            if($('#main .sticky').length) {
                $('#main .sticky').prepend('<div class="sticky-icon"><i class="fa fa-star"></i></div>');
            }
        },   
        /* ---------------------------------------------
         Gallery One 
         --------------------------------------------- */
        gallary_one: function () {
            var check_rtl = pick.check_rtl;
            if (check_rtl == 0) {
                var check_rtl = false;
            } else {
                var check_rtl = true;
            }

            $('.gallery-one').owlCarousel({
                rtl:check_rtl,
                items:1,
                autoplay: true,
                autoplayTimeout:5000,
                autoplayHoverPause:true,
                singleItem:true,
                loop:true,
                nav : true,
                navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
                owl2row: 'true',
                owl2rowTarget: 'item',
                responsive: {
                    1170:{
                        items:1
                    }
                }
            });
            $('.gallery-one .item').on('click',function(e){
                e.preventDefault();
                $('.gallery-one').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    closeOnContentClick: false,
                    closeBtnInside: false,
                    mainClass: 'mfp-with-zoom mfp-img-mobile',
                    image: {
                        verticalFit: true,
                    },
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        opener: function(element) {
                            return element.find('img');
                        }
                    },
                }); 
            });
        },
        /* ---------------------------------------------
         Gallery Two
         --------------------------------------------- */
        gallary_two: function () {
            var check_rtl = pick.check_rtl;
            if (check_rtl == 0) {
                var check_rtl = false;
            } else {
                var check_rtl = true;
            }

            var $sync1 = $(".full-view"),
                $sync2 = $(".list-view"),
                duration = 300;

            $sync1
                .owlCarousel({
                    rtl:check_rtl,
                    items: 1,
                    margin: 10,
                    nav : true,
                    navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
                    owl2row: 'true',
                    owl2rowTarget: 'item'
                })
                .on('changed.owl.carousel', function (e) {
                    var syncedPosition = syncPosition(e.item.index);
                    if ( syncedPosition != "stayStill" ) {
                        $sync2.trigger('to.owl.carousel', [syncedPosition, duration, true]);
                    }
                });
                $('.full-view .item').on('click',function(e){
                    e.preventDefault();
                    $sync1.magnificPopup({
                        delegate: 'a',
                        type: 'image',
                        closeOnContentClick: false,
                        closeBtnInside: false,
                        mainClass: 'mfp-with-zoom mfp-img-mobile',
                        image: {
                            verticalFit: true,
                        },
                        gallery: {
                            enabled: true
                        },
                        zoom: {
                            enabled: true,
                            duration: 300,
                            opener: function(element) {
                                return element.find('img');
                            }
                        },
                    }); 
                });
            if (typeof pick !== 'undefined') {
                var owl_item = pick.owl_item;
            }
            
            var check_rtl = pick.check_rtl;
            if (check_rtl == 0) {
                var check_rtl = false;
            } else {
                var check_rtl = true;
            }
            $sync2
                .owlCarousel({
                    rtl:check_rtl,
                    margin: 5,
                    items: owl_item,
                    nav: false,
                    center: false,
                    dots: false,
                    responsive:{
                        280:{
                            items:2
                        },
                        500:{
                            items:2
                        },
                        600:{
                            items:3
                        },
                        800:{
                            items:4
                        },
                        1000:{
                            items:5
                        },
                        1200:{
                            items:5
                        },
                        1400:{
                            items:5
                        },
                    }
                })
                .on('initialized.owl.carousel', function() {
                   addClassCurrent(0);
                })
                .on('click', '.owl-item', function () {
                    $sync1.trigger('to.owl.carousel', [$(this).index(), duration, true]);

                });
                function addClassCurrent( index ) {
                    $sync2
                        .find(".owl-item.active")
                        .removeClass("current")
                        .eq( index )
                        .addClass("current");
                }
                addClassCurrent(0);
                function syncPosition( index ) {
                    addClassCurrent( index );
                    var itemsNo = $sync2.find(".owl-item").length;
                    var visibleItemsNo = $sync2.find(".owl-item.active").length;
                
                    if (itemsNo === visibleItemsNo) {
                        return "stayStill";
                    }
                    var visibleCurrentIndex = $sync2.find(".owl-item.active").index( $sync2.find(".owl-item.current") );
                    if (visibleCurrentIndex == 0 && index != 0) {
                        return index - 1;
                    }
                    if (visibleCurrentIndex == (visibleItemsNo - 1) && index != (itemsNo - 1)) {
                        return index - visibleItemsNo + 2;
                    }
                    return "stayStill";
                }
        },
        /* ---------------------------------------------
         Justified Gallery
         --------------------------------------------- */
        gallery_justified: function () {
            if ($('.pick-theme-tiled-gallery').length) {
                if (typeof pick !== 'undefined') {
                    var tiled_gallery_row_height = pick.tiled_gallery_row_height;
                }
                var tiledItemSpacing = 4;
                $('.pick-theme-tiled-gallery').wrap('<div class="pick-theme-tiled-gallery-row"></div>');
                $('.pick-theme-tiled-gallery').parent().css('margin', -tiledItemSpacing);
                $('.pick-theme-tiled-gallery').justifiedGallery({
                    rowHeight: tiled_gallery_row_height,
                    lastRow: 'justify',
                    maxRowHeight: '200%',
                    margins: tiledItemSpacing,
                    waitThumbnailsLoad: false
                });
            }
            $('.pick-theme-tiled-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                closeOnContentClick: false,
                closeBtnInside: false,
                mainClass: 'pp-gallery mfp-with-zoom mfp-img-mobile',
                image: {
                    verticalFit: true,
                },
                gallery: {
                    enabled: true
                },
                zoom: {
                    enabled: true,
                    duration: 300,
                    opener: function(element) {
                        return element.find('img');
                    }
                },
            });
        },
        /* ---------------------------------------------
         Image Background
         --------------------------------------------- */
        image_bg: function () {
            $.fn.bgImage = function() {
                $(this).each(function() {
                    var $image = $(this).find('img');
                    var imageSource = $image.attr('src');
                    $image.css('visibility','hidden');
                    $(this).css('backgroundImage', 'url(' + imageSource + ')');
                    if(!$image.length) {
                        $(this).css('backgroundImage', 'none');
                    }                    
                });
            };
            $('#author-image-bg').bgImage();
            $('.related-post .post-media').bgImage();
        },

        /* ---------------------------------------------
         Chat More Button fix
         --------------------------------------------- */
        chat_more_button: function() {
            if ($('.chat-text p .more-link').length) {
                $('.chat-text p .more-link').detach().appendTo('#readmore-add');
            }
        },
        /* ---------------------------------------------
         Related Post Image Height Fix
         --------------------------------------------- */
        related_post: function () {
            $.fn.fixedHeight = function() {
                var maxHeight = 0;
                $(this).each(function() {
                    var prevHeight = $(this).height();
                    var thisHeight = $(this).height('auto').height();
                    $(this).height(prevHeight);
                    maxHeight = (maxHeight > thisHeight ? maxHeight : thisHeight);
                    var video = $(this).find('.fluid-width-video-wrapper') || $(this).find('.mejs-container');
                    if(video) {
                        video.parent().height('auto');
                        video.css('height', '' + maxHeight + 'px');
                    }
                });
                $(this).height(maxHeight);
            };
            $('.related-post .post-media').fixedHeight();
        },

        /* ---------------------------------------------
         Author Skill
         --------------------------------------------- */
        skill: function () {
            if($('#author-skill').length) {
                $('#author-skill .skill-one').circliful();
            }
        },        
        /* ---------------------------------------------
         Google Maps
         --------------------------------------------- */
        maps: function () {
            if ($('#gmaps').length) {
                var map;
                if (typeof pick !== 'undefined') {
                    var lat = pick.lat;
                    var lon = pick.lon;
                    var map_mouse_wheel = pick.map_mouse_wheel;
                    var map_zoom_control = pick.map_zoom_control;
                    var map_point_img = pick.map_point_img;
                }
                map = new GMaps({
                    el: '#gmaps',
                    lat: lat,
                    lng: lon,
                    scrollwheel: map_mouse_wheel,
                    zoom: 10,
                    zoomControl: map_zoom_control,
                    panControl: false,
                    streetViewControl: false,
                    mapTypeControl: false,
                    overviewMapControl: false,
                    clickable: false
                });

                var image = map_point_img;
                map.addMarker({
                    lat: lat,
                    lng: lon,
                    icon: image,
                    animation: google.maps.Animation.DROP,
                    verticalAlign: 'bottom',
                    horizontalAlign: 'center'
                });
                var styles = [{
                    "featureType": "road",
                    "stylers": [{
                        "color": "#b4b4b4"
                    }]
                }, {
                    "featureType": "water",
                    "stylers": [{
                        "color": "#d8d8d8"
                    }]
                }, {
                    "featureType": "landscape",
                    "stylers": [{
                        "color": "#f1f1f1"
                    }]
                }, {
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#000000"
                    }]
                }, {
                    "featureType": "poi",
                    "stylers": [{
                        "color": "#d9d9d9"
                    }]
                }, {
                    "elementType": "labels.text",
                    "stylers": [{
                        "saturation": 1
                    }, {
                        "weight": 0.1
                    }, {
                        "color": "#000000"
                    }]
                }]
            }
        },
        /* ---------------------------------------------
         Scroll To Top
         --------------------------------------------- */
        scroll_top: function () {
            $("body").append("<a href='#top' id='scroll-top' class='topbutton btn-hide'><span class='glyphicon glyphicon-menu-up'></span></a>");
            var $scrolltop = $('#scroll-top');
            $(window).on('scroll', function() {
                if($(this).scrollTop() > $(this).height()) {
                    $scrolltop
                    .addClass('btn-show')
                    .removeClass('btn-hide');
                } else {
                    $scrolltop
                    .addClass('btn-hide')
                    .removeClass('btn-show');
                }
            });
            $("a[href='#top']").on('click', function() {
                $("html, body").animate({
                    scrollTop: 0
                }, "normal");
                return false;
            });
            $('[data-toggle="tooltip"]').tooltip();
        },
        /* ---------------------------------------------
         If WP Admin bar Come
         --------------------------------------------- */
        wp_adminbar: function() {
            // This function gets called with the user has scrolled the window.
            $(window).on('scroll', function() {
                if ($(this).scrollTop() > 0) {
                    // Add the scrolled class to those elements that you want changed
                    $(".top-menu.menuopen").addClass("scroll");
                } else {
                    $(".top-menu.menuopen").removeClass("scroll");
                }
            });
        },
        pick_theme_initializ: function () {
            pickApp.preloader();
            pickApp.top_search();
            pickApp.menu();
            pickApp.smoothscroll();
            pickApp.video();
            pickApp.featured_area();
            pickApp.masonry();
            pickApp.sticky();
            pickApp.gallary_one();
            pickApp.gallary_two();
            pickApp.gallery_justified();
            pickApp.image_bg();
            pickApp.chat_more_button();
            pickApp.related_post();
            pickApp.skill();
            pickApp.maps();
            pickApp.scroll_top();
            pickApp.wp_adminbar();
        }
    };
    /* ---------------------------------------------
     Document Ready Function
     --------------------------------------------- */
    $(function() {
        pickApp.pick_theme_initializ();
    });
})(jQuery);