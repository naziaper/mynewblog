var etTheme;

;(function($) {

    "use strict";

    var _functions = {}, swipers = [], winW, winH, fontSize, winScr, _ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i), _isPhoneW, _isTabletW, bLazy;

    var initIterator = 0;
    function setParams(swiper, dataValue, returnValue){
        return (swiper.is('[data-'+dataValue+']'))?((typeof swiper.data(dataValue)!="string")?parseInt(swiper.data(dataValue), 10):swiper.data(dataValue)):returnValue;
    }

    etTheme = {
        init: function() {
            this.resizeVideo();
            this.addSwiperLazy();
            this.swiperFunc();
            this.isotope();
            this.sitePreloader();
            this.funcySelect();
            this.secondaryMenu();
            this.nanoScroll();
            this.breadcrumbs();
            this.affixJS();
            this.onePageMenu();
            this.fixedHeader();
            this.fixedFooter();
            this.windowsPhoneFix();
            this.popup();
            this.imagesLightbox();
            this.loadInView();
            this.cleanSpaces();
            this.contentProdImages();
            this.navMenuSmart();
            this.mainNavigation();
            this.backToTop();
            this.portfolio();
            this.searchform();
            this.tabs();
            this.categoriesAccordion();
            this.CustomMenuAccordion();
            this.toggles();
            this.closeParentBtn();
            this.commentsForm();
            this.mobileMenu();
            this.topPanel();
            this.menuPosts();
            this.postLayout();
            this.photoSwipe();
            this.ajaxSearch();
            this.stickySidebar();
            this.countdown();
            this.vcRTLRows();
            this.heightFixMassive();
            this.headerSimpleHover();
            this.hamburgerIcon();
            this.scrollMenu();
            this.NavbarHeader();
            this.customCss();
            this.blogAjaxLoad();
            if( etConfig.woocommerce ) {
                this.wishlist();
                this.woocommerce();
                this.quantityIncrements( false );
                this.ajaxAddToCartInit();
                this.variationsThumbs();
                this.videoPopup();
                this.quickView();
                this.theLook();
                this.filtersArea();
                this.stickyProductImages();
                this.ForCompare();
                this.tooltips();
                this.jumpToSlide();
            }

            setTimeout(function() {
                $('body').addClass('cart-widget-show');
            }, 1000);

            $(window).resize();
        },

        hamburgerIcon: function() {
            $( '.hamburger-icon' ).click(function(){
                $( 'body' ).toggleClass( 'fullscreen-menu-opened' );

            });

            // ! Close menu for vertical header types
            $( '.content-page, footer.footer, .et-footers-wrapper, .header-wrapper.vertical-mod, .page-heading' ).on( 'click', function(e){
                if ( $( 'body' ).is( '.fullscreen-menu-opened.et-vertical-fixed' ) ) {
                    $( 'body' ).toggleClass( 'fullscreen-menu-opened' );
                }
            });

            var navList = $('.fullscreen-menu-container .menu');
            var opener = '<span class="open-child">(open)</span>';

            navList.find('li:has(ul)',this).each(function() {
                var $this = $(this);
                $this.find(' > a').wrap('<div class="inside" />').parent().append(opener);
                // $this.prepend(opener);
            });

            navList.on('click', '.open-child', function(){
                if ($(this).parent().hasClass('over')) {
                    $(this).parent().removeClass('over').parent().find(' > .nav-sublist-dropdown, > .nav-sublist').stop().slideUp(300);
                }else{
                    $(this).parent().parent().parent().find('>li>.over').removeClass('over');
                    $(this).parent().addClass('over').parent().find(' > .nav-sublist-dropdown, > .nav-sublist').stop().slideDown(300);
                }
            });

            // heightSubmenu();

            $( ".fullscreen-menu .container.fullscreen-menu-container" ).nanoScroller({
                contentClass: 'fullscreen-menu-collapse'
            });
        },

        sitePreloader: function() {
            setTimeout(function() {
                $('body').removeClass('et-preloader-on').addClass('et-preloader-hide');
            }, 500);
        },


        addSwiperLazy: function() {
            $('.block-srcset > img').addClass('swiper-lazy');
        },

        swiperFunc: function(){

            $('.swiper-container').not('.initialized').each(function(){
                var $t = $(this);

                var index = 'swiper-unique-id-'+initIterator;

                $t.addClass('swiper-'+index+' initialized').attr('id', index);
                $t.find('.swiper-pagination').addClass('swiper-pagination-'+index);
                $t.parent().find('.swiper-button-prev, .swiper-custom-left').addClass('swiper-button-prev-'+index);
                $t.parent().find('.swiper-button-next, .swiper-custom-right').addClass('swiper-button-next-'+index);

                swipers['swiper-'+index] = new Swiper('.swiper-'+index,{
                    pagination: '.swiper-pagination-'+index,
                    paginationClickable: true,
                    nextButton: '.swiper-button-next-'+index,
                    prevButton: '.swiper-button-prev-'+index,
                    slidesPerView: setParams($t,'slides-per-view',1),
                    slidesPerGroup: setParams($t,'slides-per-group',1),
                    autoHeight: setParams($t,'autoheight',0),
                    loop: setParams($t,'loop',0),
                    autoplay: setParams($t,'autoplay',0),
                    centeredSlides: setParams($t,'center',0),
                    breakpoints: ($t.is('[data-breakpoints]'))? {
                            767: { slidesPerView: ($t.attr('data-xs-slides')!='auto')?parseInt($t.attr('data-xs-slides'), 10):'auto', slidesPerGroup: ($t.attr('data-xs-slides')!='auto' && $t.data('center')!='1')?parseInt($t.attr('data-xs-slides'), 10):1 },
                            991: { slidesPerView: ($t.attr('data-sm-slides')!='auto')?parseInt($t.attr('data-sm-slides'), 10):'auto', slidesPerGroup: ($t.attr('data-sm-slides')!='auto' && $t.data('center')!='1')?parseInt($t.attr('data-sm-slides'), 10):1 },
                            1199: { slidesPerView: ($t.attr('data-md-slides')!='auto')?parseInt($t.attr('data-md-slides'), 10):'auto', slidesPerGroup: ($t.attr('data-md-slides')!='auto' && $t.data('center')!='1')?parseInt($t.attr('data-md-slides'), 10):1 },
                            1370: { slidesPerView: ($t.attr('data-lt-slides')!='auto')?parseInt($t.attr('data-lt-slides'), 10):'auto', slidesPerGroup: ($t.attr('data-lt-slides')!='auto' && $t.data('center')!='1')?parseInt($t.attr('data-lt-slides'), 10):1 } } : {},
                    initialSlide: setParams($t,'initialslide',0),
                    speed: setParams($t,'speed',500),
                    parallax: setParams($t,'parallax',0),
                    slideToClickedSlide: setParams($t,'clickedslide',0),
                    mousewheelControl: setParams($t,'mousewheel',0),
                    direction: ($t.is('[data-direction]'))?$t.data('direction'):'horizontal',
                    spaceBetween: setParams($t,'space',0),
                    watchSlidesProgress: true,
                    autoplayDisableOnInteraction: true,
                    keyboardControl: true,
                    mousewheelReleaseOnEdges: true,
                    preloadImages: false,
                    lazyLoading: true,
                    // lazyLoadingInPrevNext: true,
                    // lazyLoadingInPrevNextAmount: 1,
                    // lazyLoadingOnTransitionStart: true,
                    // loopedSlides: 3,
                    roundLengths: true,
                    watchSlidesVisibility: true,
                    slidesPerColumn: setParams($t,'slidespercolumn',1),
                });

                $( document ).on('click', '.vc_tta-tab', function(){
                    swipers['swiper-'+index].onResize();
                });

                $(window).load(function () {
                    swipers['swiper-'+index].onResize();
                    swipers['swiper-'+index].update();
                });

                setTimeout(function() {
                    $('.vc_tta-tab.vc_active').click();
                }, 500);

                $( window ).bind( "vc_js", function() {
                    swipers['swiper-'+index].update();
                });

                $(document).on( 'found_variation' ,'form.variations_form', function() {
                    swipers['swiper-'+index].slideTo(0);
                });
                $(document).on( 'reset_image', 'form.variations_form', function() {
                    swipers['swiper-'+index].slideTo(0);
                });

                swipers['swiper-'+index].update();
                initIterator++;
            });

            $(document).on('click', '.thumbnail-item', function () {
                $(this).toggleClass('active-thumbnail');
                $(this).siblings( $(this) ).removeClass('active-thumbnail');

                var swichIndex = $(this).closest('.swipers-couple-wrapper').find('.thumbnail-item').index(this);
                swipers['swiper-' + $(this).closest('.swipers-couple-wrapper').find('.swiper-control-top').attr('id')].slideTo(swichIndex);
                return false;
            });

            etTheme.resizeVideo();

            // $(document).on( 'click', '.swiper-custom-right', function () {
            //     swipers['swiper-'+$(this).siblings('.swiper-container').attr('id')].slideNext();
            // });
            //
            // $(document).on('click', '.swiper-custom-left', function () {
            //     swipers['swiper-'+$(this).siblings('.swiper-container').attr('id')].slidePrev();
            // });

        },

        heightFixMassive: function() {

            $(document).on( 'click', '.mpc-toggled .vc_tta-panel-heading', function(evt) {

                var height = $( this ).parents( '.vc_tta-panel' ).children( '.vc_tta-panel-body' ).height();
                var data_height = $( this ).parents( '.mpc-toggled' ).data( 'height' );
                height = data_height + height;

                $( this ).parents( '.mpc-toggled' ).css( 'max-height', height );
            });
        },

        funcySelect: function() {

            $('.filter-wrap select').fancySelect();
            $('.top-bar select').fancySelect();
            $('.header-wrapper #product_cat, .header-wrapper #cat').fancySelect();

        },

        secondaryMenu: function() {

            $('.et-secondary-visibility-on_click').on('click', '.secondary-title', function() {
                if($('body').hasClass('et-secondary-shown')) {
                    $('body').removeClass('et-secondary-shown');
                } else {
                    $('body').addClass('et-secondary-shown');
                }
            });

            $(document).on('click touchstart', function(event) {
                if( !$(event.target).closest('.secondary-menu-wrapper').length ) {
                    if($('body').hasClass('et-secondary-shown')) {
                        $('body').removeClass('et-secondary-shown');
                    }
                }
            })
        },

        nanoScroll: function() {
            var scrollWidget = $('.shop-filters-area .widget-inner');
            scrollWidget.each(function() {
                var content = $(this).find('> ul, > div, > form');
                if(content.height() > 260) {
                    $(this).addClass('nano-scroll-apply');
                    content.addClass('widget-content');
                    $(this).nanoScroller({
                        contentClass: 'widget-content',
                        preventPageScrolling: true
                    });
                }
            });
        },

        breadcrumbs: function() {
            if($(window).width() < 1200) return;

            var previousScroll = 0,
                deltaY = 0,
                breadcrumbs = $('.bc-effect-text-scroll').find('.container'),
                opacity = 1,
                finalOpacity = 0.3,
                scale = 1,
                finalScale = 0.8,
                scrollTo = 300;

            $(window).scroll(function(){
                var currentScroll = $(this).scrollTop();

                if(currentScroll > 1 && currentScroll < scrollTo) {

                    opacity = 1 - ( 1 - finalOpacity ) * ( currentScroll / scrollTo );
                    scale   = 1 - ( 1 - finalScale )   * ( currentScroll / scrollTo );

                    opacity = opacity.toFixed(3);
                    scale   = scale.toFixed(3);

                    breadcrumbsAnimation(breadcrumbs);
                } else if(currentScroll < 10) {
                    opacity = 1;
                    scale   = 1;

                    breadcrumbsAnimation(breadcrumbs);
                }

                var scrolledY = $(window).scrollTop();
                // $('.bc-type-8').css('background-position', 'left ' + ((scrolledY)/1.5) + 'px');

            });

            var breadcrumbsAnimation = function(el) {
                if(deltaY >= 0 || $(window).scrollTop() < 1) deltaY = 0;
                el.css({
                    'transform': 'scale(' + scale + ')',
                    '-webkit-transform': 'scale(' + scale + ')',
                    'opacity' : opacity
                });
            };

            /* Parallax on mouse move */

            var mouseParallax = $('.bc-effect-mouse'),
                x0 = 50,
                y0 = 0,
                koef = 0.35,
                time = 350;

            mouseParallax.mousemove(function(e){
                var width = $(window).width(),
                    height = $(this).outerHeight();

                var dX = width/2-e.pageX,
                    dY = height/2-e.pageY;

                var x = x0 + dX/width*100*koef,
                    y = y0 - dY/height*100*koef;

                if( x < 0 ) x = 0;
                if( y < 0 ) y = 0;

                $(this).stop().animate({
                    backgroundPositionX: x + '%',
                    backgroundPositionY: y + '%'
                }, time, 'linear');
            })
                .mouseleave(function() {
                    $(this).stop().animate({
                        backgroundPositionX: x0 + '%',
                        backgroundPositionY: y0 + '%',
                    }, time);
                });

        },

        photoSwipe: function() {

            setTimeout(function() {
                $('.zoom-images-button, .open-video-popup, .open-360-popup').addClass('showed');
            }, 400);

            // **********************************************************************//
            // ! init photoswipe
            // **********************************************************************//

            var pswpElement = document.querySelectorAll('.pswp')[0],
                mainImages = $('.images-wrapper');

            if( $('.images').hasClass('photoswipe-off') ) {

                mainImages.on('click', '.main-images .zoom, .zoom-images-button', function(e) {
                    e.preventDefault();
                });

                return;
            }


            mainImages.on('click', '.main-images .zoom, .zoom-images-button', function(e) {
                e.preventDefault();

                var index = 0;

                // build items array
                var items = [];

                var mainImage = mainImages.find('.pswp-main-image'),
                    additionalImages = (mainImages.find('.images').hasClass('gallery-slider-on')) ? $('.pswp-additional') : $('.woocommerce-main-image').not('.pswp-main-image');

                items.push({
                    src: mainImage.attr('href'),
                    w: mainImage.data('width'),
                    h: mainImage.data('height'),
                });
                if ( $( '.swiper-control-bottom' ).hasClass( 'thumbnails' ) ) {
                    index = swipers['swiper-'+$('.zoom-images-button').closest('.swiper-container').attr('id')].activeIndex;
                    console.log(index);
                }

                additionalImages.each(function() {
                    items.push({
                        src: $(this).data('large'),
                        w: $(this).data('width'),
                        h: $(this).data('height'),
                    });
                });

                // define options (if needed)
                var options = {
                    // optionName: 'option value'
                    // for example:
                    index: index // start at first slide
                };

                // Initializes and opens PhotoSwipe
                var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
                gallery.init();

            });

        },

        ajaxSearch: function() {
            var form = $('.ajax-search-form'),
                click = false,
                request = false;

            form.on('keyup', 'input[type="text"]', function(e) {

                var thisForm = $(this).parents('.ajax-search-form'),
                    results = thisForm.find('.ajax-results'),
                    s = thisForm.find('input[type="text"]').val();

                if( s.length < 1 && ! click ) {
                    results.html('').hide();
                    return;
                }

                var cat = form.find( '.fancy-select .options li.selected').data('raw-value');

                request && request.abort();

                request = $.ajax({
                    url: etConfig.ajaxurl,
                    method: 'POST',
                    data: {
                        'action': 'et_ajax_search',
                        's': s,
                        'cat' : cat
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        thisForm.addClass('ajax-in-action');
                        results.hide();
                    },
                    complete: function() {
                        thisForm.removeClass('ajax-in-action');
                        click = true;
                    },
                    success: function(response){
                        results.html(response.html).show();
                    },
                    error: function() {
                    }
                });

                $('body').on('click', function(event) {
                    if ( ! $(event.target).is('.search-form-wrapper') && $(event.target).closest('.search-form-wrapper').length ) return;
                    results.hide();
                });

            });

        },

        stickySidebar: function() {
            if( $(window).width() < 992 ) return;

            $('body').addClass('sticky-sidebar-loaded');

            $(document).on( 'click' , '.sidebar.sticky-sidebar' , function(){
                var initHeight = $( '.sidebar.sticky-sidebar' ).height();
                setTimeout(function(){
                    var currentHeight = $( '.sidebar.sticky-sidebar' ).height();
                    if ( initHeight != currentHeight ) {
                        $(document.body).trigger( 'sticky_kit:recalc' );
                    }
                }, 100 );
            });

            var args = {
                offset_top: 150
            }

            if ( ! $( '.content-page' ).hasClass( 'shop-full-width' ) && $( 'body' ).hasClass( 'woocommerce-page' ) ) {
                args['parent'] = '.container.content-page';
            }

            $('.sidebar.sticky-sidebar').stick_in_parent( args );

            if( ! $('.sidebar.sticky-sidebar').hasClass('sidebar-left') ) return;

            $('.sidebar.sticky-sidebar')
                .on('sticky_kit:stick sticky_kit:unbottom', function() {
                    var parent = $(this).parents('.row'),
                        left = parent.offset().left;
                    $(this).css('left', left);
                })
                .on('sticky_kit:unstick', function() {
                    $(this).css('left', 'auto');
                    $(this).css('position', 'relative');
                })
                .on('sticky_kit:bottom', function() {
                    $(this).css('left', 0);
                })
                .on('sticky_kit:unbottom', function() {
                    var parent = $(this).parents('.row'),
                        left = parent.offset().left;
                    $(this).css('left', left);
                });

            $('.sidebar.sticky-sidebar.sidebar-left').css({
                'position': 'relative'
            });

        },

        affixJS: function() {

            if( $(window).width() < 992 ) return;

            if ( ! $( '.product-images .images' ).is( '.gallery-slider-off' ) ) {
                $( '.fixed-product-block' ).css({ 
                    'height': $( '.product-content' ).height(), 
                    'min-height': $( '.product-content' ).height() + 20
                });
            };

            if ( $( '.fixed-product-block' ).height() > $( '.product-images' ).height() ) return;

            $('.fixed-product-block').each(function() {
                var el = $(this),
                    parent = el.parent(),
                    heightOffsetEl = $('.product-images'),
                    parentHeight = heightOffsetEl.outerHeight(),
                    firstImg = heightOffsetEl.find('img').first(),
                    firstImgHeight = firstImg.outerHeight();

                $(window).resize(function() {
                    parentHeight = heightOffsetEl.outerHeight();
                    firstImgHeight = firstImg.outerHeight();
                    el.css({
                        'maxWidth': parent.width(),
                        'minHeight': firstImgHeight,
                    });
                    parent.height(parentHeight);
                });

                $(window).resize();

                $(this).stick_in_parent({
                    offset_top: 100
                });

            });

        },
        onePageMenu: function() {
            // **********************************************************************//
            // ! One page hash navigation
            // **********************************************************************//

            // Click on menu item with hash
            $(document).on('click', '.one-page-menu a', function(e){
                if($(this).attr('href').split('#')[0] == window.location.href.split('#')[0]) {
                    e.preventDefault();
                    var hash = $(this).attr('href').split('#')[1];
                    changeActiveItem(hash);
                    scrollToId(hash);
                }

                if ( $( 'body' ).hasClass( 'mobile-menu-opened' ) ) {
                    $( 'body' ).removeClass( 'mobile-menu-opened' );
                    $( 'body' ).addClass( 'mobile-menu-closed' );
                }
            });

            $('[data-scroll-to]').click(function() {
                var hash = $(this).attr('data-scroll-to');
                changeActiveItem(hash);
                scrollToId(hash);
            });

            // if loaded page with hash
            var windowHash = window.location.hash.split('#')[1];

            if(window.location.hash.length > 1) {
                setTimeout(function(){
                    scrollToId(windowHash);
                }, 600);
            }

            function scrollToId(id){
                var offset = 130;
                var position = 0;

                if(id != 'top'){
                    if($('#'+id).length < 1) {
                        return;
                    }
                    position = $('#'+id).offset().top - offset;
                }


                if($(window).width() < 992) {
                    $('body').removeClass('show-nav');
                }

                $('html, body').stop().animate({
                    scrollTop: position
                }, 1000, function() {
                    changeActiveItem(id);
                });
            }

            function changeActiveItem(hash) {
                var itemId;
                var menu = $('.menu');
                if(!menu.parent().hasClass('one-page-menu')) return;

                menu.find('.current-menu-item').removeClass('current-menu-item');

                if(hash == 'top') {
                    menu.each(function() {
                        $(this).find('li').first().addClass('current-menu-item');
                    });
                    return;
                }

                menu.find('li').each(function() {
                    if($(this).find('>a').attr('href')) {
                        var thisHash = $(this).find('>a').attr('href').split('#')[1];
                        if(thisHash == hash) {
                            itemId = $(this).attr('id');
                        }
                    }
                });

                $('.'+itemId).addClass('current-menu-item');
            }


            $(window).scroll(function() {
                if($(window).scrollTop() < 200) {
                    changeActiveItem('top');
                }
            });
            changeActiveItem('top');

            // change active link on scroll
            $('.vc_row[id]').waypoint(function() {
                var id = $(this).attr('id');
                changeActiveItem(id);
            }, { offset: 150 });



        },

        NavbarHeader: function($location){

            // **********************************************************************//
            // ! Get header navbar data
            // **********************************************************************//

            if ( ! $( 'body' ).hasClass( 'shop-top-bar' ) || $(window).width() > 992 && $location !='fixed' ) return;

            var navbar = {};

            navbar['out'] = '';

            $( '.navbar-header' ).each( function(e){

                // ! Get wishlist
                if ( $(this).find( '.et-wishlist-widget' ).html() != null ) {
                    navbar['wishlist'] = '<div class=" asdasd ' + $(this).find( '.et-wishlist-widget' ).attr( 'class' ) + '">';
                    navbar['wishlist'] += $(this).find( '.et-wishlist-widget' ).html();
                    navbar['wishlist'] += '</div>';
                }

                // ! Get search
                if ( $(this).find( '.header-search' ).html() != null ) {
                    navbar['search'] = '<div class="' + $(this).find( '.header-search' ).attr( 'class' ) + '">';
                    navbar['search'] += $(this).find( '.header-search' ).html();
                    navbar['search'] += '</div>';
                }

                // ! Get search for unstandard header types
                if ( ( $( 'body' ).hasClass( 'global-header-center' ) || $( 'body' ).hasClass( 'global-header-center3' ) || $( 'body' ).hasClass( 'global-header-two-rows' ) || $( 'body' ).hasClass( 'global-header-advanced' ) ) && $(this).parents().find( '.header-search' ).html() != null ) {
                    navbar['search'] = '<div class="header-search act-full-width">';
                    navbar['search'] += $(this).parents().find( '.header-search' ).html();
                    navbar['search'] += '</div>';
                }

                // ! Get cart
                if ( $(this).find( '.shopping-container' ).html() != null ) {
                    navbar['cart'] = '<div class="' + $(this).find( '.shopping-container' ).attr( 'class' ) + '">';
                    navbar['cart'] += $(this).find( '.shopping-container' ).html();
                    navbar['cart'] += '</div>';
                }

                // ! Get hamburger icon for hamburger header type
                if ( $( 'body' ).is( '.global-header-hamburger-icon' ) && $(this).find( '.hamburger-icon' ).html() != null ) {
                    navbar['hamburger'] = '<div class="' + $(this).find( '.hamburger-icon' ).attr( 'class' ) + '">';
                    navbar['hamburger'] += $(this).find( '.hamburger-icon' ).html();
                    navbar['hamburger'] += '</div>';
                }

            });

            if ( $location != 'fixed' ) $( '.navbar-header.show-in-header' ).remove();

            // ! Create out data
            navbar['out'] += ( $location != 'fixed' ) ? '<div class="navbar-header show-in-header">' : '';
            navbar['out'] += ( navbar['search'] != null ) ? navbar['search'] : '';
            navbar['out'] += ( navbar['wishlist'] != null ) ? navbar['wishlist'] : '';
            navbar['out'] += ( navbar['cart'] != null ) ? navbar['cart'] : '';
            navbar['out'] += ( navbar['hamburger'] != null ) ? navbar['hamburger'] : '';
            navbar['out'] += ( $location != 'fixed' ) ? '</div>' : '';

            // ! Do it for fixed header
            if ( $location == 'fixed' ) return navbar['out'];

            // ! Do it for mobile menu
            $( 'header.main-header .navbar-toggle' ).before( navbar['out'] );
        },

        fixedHeader: function() {

            // **********************************************************************//
            // ! Fixed header
            // **********************************************************************//

            if ( $( 'body' ).hasClass( 'et-fixed-disable' ) ) return;
            if ( $( 'body' ).hasClass( 'et-vertical-fixed' ) && $(window).width() > 992 ) return;

            var header = $('.header-wrapper'),
                logo = header.find('.header-logo').html(),
                menu = header.find('.menu-wrapper').first(),
                menuClass = menu.attr('class'),
                menuRight = header.find('.menu-wrapper-right'),
                navbar = header.find('.navbar-header').html(),
                menuBtn = header.find('.navbar-toggle').html(),
                color = $('.page-wrapper').data('fixed-color'),
                startOffset = 240,
                menuHtml;

            // Do it for non standard navbar
            if ( $( 'body' ).hasClass( 'shop-top-bar' ) ){
                navbar = this.NavbarHeader( 'fixed' );
            }

            if( menuRight.length > 0 ) {
                menuHtml = menu.html() + menuRight.html();
            } else {
                menuHtml = menu.html();
            }

            // Check values for "Toolset Layouts" plugin
            if ( logo == null ) logo = '';
            if ( menuHtml == null ) menuHtml = '';
            if ( navbar == null ) navbar = '';
            if ( menuBtn == null ) menuBtn = '<span class="sr-only">Menu</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>';

            var fixedHeaderHtml = '<div class="fixed-header header-color-' + color + '"><div class="container"><div class="header-logo">' + logo + '</div><div class="' + menuClass + '">' + menuHtml + '</div><div class="navbar-header">' + navbar + '</div><div class="navbar-toggle">' + menuBtn + '</div></div></div>';

            header.before(fixedHeaderHtml);

            if ($(window).width() < 768 ) { startOffset = 120; }

            var fixed = $('.fixed-header');
            if ( $('body').hasClass('et-header-fixed') ) {
                $(window).scroll(function(){
                    var currentScroll = $(this).scrollTop();

                    if( currentScroll > startOffset ) {
                        showFixed();
                    } else {
                        hideFixed();
                    }

                });
            }
            else {
                if ( $('body').hasClass('et-header-sticky') ) {
                    var previousScroll = 0,
                    animatedTimer = 0,
                    stickyHeight = fixed.outerHeight(),
                    stickyAfter = fixed.outerHeight() + 20;
                        $(window).scroll(function() {
                            var currentScroll = $(this).scrollTop();

                            // sticky header
                            if( ( currentScroll < previousScroll ) && ( currentScroll > startOffset ) ) {
                                fixed.addClass('sticky-header-enabled');
                            } else {
                                fixed.removeClass('sticky-header-enabled');
                            }

                        /*if (currentScroll < previousScroll){
                            // Scroll up
                        } else {
                            //Scroll down
                        }*/

                        previousScroll = currentScroll;
                    });
                }
            }

            var showFixed = function() {
                fixed.addClass('fixed-enabled');
            };

            var hideFixed = function() {
                fixed.removeClass('fixed-enabled');
            };
        },

        fixedFooter: function() {
            if( ! $('body').hasClass('et-footer-fixed-on')) return;
            var footer = $('.et-footers-wrapper');
            var pageWrapper = $('.page-wrapper');

            pageWrapper.css('marginBottom', footer.outerHeight() );
            $(window).resize(function() {
                pageWrapper.css('marginBottom', footer.outerHeight() );
            });

        },
        resizeVideo: function() {
            $(document).find('.single-product .product-video-popup iframe[src*="youtube.com"], .single-product .product-video-popup iframe[src*="vimeo.com"], article.blog-post iframe[src*="youtube.com"], article.blog-post iframe[src*="vimeo.com"]').each(function() {
                var video = $(this);
                video.attr('width', '100%');
                var videoWidth = video.width();
                video.css('height', videoWidth * 0.56, 'important');
            });
        },
        windowsPhoneFix: function() {
            // **********************************************************************//
            // ! Windows Phone Responsive Fix
            // **********************************************************************//
            if ("-ms-user-select" in document.documentElement.style && navigator.userAgent.match(/IEMobile\/10\.0/)) {
                var msViewportStyle = document.createElement("style");
                msViewportStyle.appendChild(
                    document.createTextNode("@-ms-viewport{width:auto!important}")
                );
                document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
            }
        },
        popup: function() {
            var et_popup_closed = $.cookie('etheme_popup_closed');
            $('.etheme-popup').magnificPopup({
                items: {
                    src: '#etheme-popup',
                    type: 'inline'
                },
                removalDelay: 300, //delay removal by X to allow out-animation
                callbacks: {
                    beforeOpen: function() {
                        this.st.mainClass = 'mfp-zoom-out';
                    },
                    beforeClose: function() {
                        //if($('#showagain:checked').val() == 'do-not-show')
                        $.cookie('etheme_popup_closed', 'do-not-show', { expires: 1, path: '/' } );
                    },
                }
            });

            if(et_popup_closed != 'do-not-show' && $('.etheme-popup').length > 0 ) {
                if( $('body').hasClass('scroll-popup') ) {
                    var localShown = false;
                    $(window).scroll(function() {
                        if( localShown ) return false;
                        if( $(document).scrollTop() > $(document).height() - $(window).height() - 300 ) {
                            $('.etheme-popup').magnificPopup('open');
                            localShown = true;
                        }
                    });
                } else if( $('body').hasClass('open-popup') ) {
                    $('.etheme-popup').magnificPopup('open');
                }
            }
        },


        imagesLightbox: function() {
            // **********************************************************************//
            // ! Images lightbox
            // **********************************************************************//
            $("a[rel^='lightboxGall']").magnificPopup({
                type:'image',
                gallery:{
                    enabled:true
                }
            });

            $("a[rel='lightbox'], a[rel='pphoto']").magnificPopup({
                type:'image',
                closeBtnInside: true,
                midClick: true,
                image: {
                    verticalFit: false, // Fits image in area vertically
                },
                removalDelay: 500,
                callbacks: {
                    beforeOpen: function() {
                        // just a hack that adds mfp-anim class to markup
                        this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                        this.st.mainClass = 'mfp-zoom-out';
                    }
                },
            });
        },
        animateCounter: function(el) {
            // **********************************************************************//
            // ! Animated Counters
            // **********************************************************************//
            var initVal = parseInt(el.text());
            var finalVal = el.data('value');
            if(finalVal <= initVal) return;
            var intervalTime = 1;
            var time = 200;
            var step = parseInt((finalVal - initVal)/time.toFixed());
            if(step < 1) {
                step = 1;
                time = finalVal - initVal;
            }
            var firstAdd = (finalVal - initVal)/step - time;
            var counter = parseInt((firstAdd*step).toFixed()) + initVal;
            var i = 0;
            var interval = setInterval(function(){
                i++;
                counter = counter + step;
                el.text(counter);
                if(i == time) {
                    clearInterval(interval);
                }
            }, intervalTime);
        },
        loadInView: function() {
            // **********************************************************************//
            // ! Load in view
            // **********************************************************************//

            var counters = $('.animated-counter');

            counters.each(function(){
                $(this).waypoint(function(){
                    etTheme.animateCounter($(this));
                }, { offset: '100%' });
            });

            var progressBars = $('.progress-bars');
            progressBars.waypoint(function() {
                i = 0;
                $(this).find('.progress-bar').each(function () {
                    i++;

                    var el = $(this);
                    var width = $(this).data('width');
                    setTimeout(function(){
                        el.find('div').animate({
                            'width' : width + '%'
                        },400);
                        el.find('span').css({
                            'opacity' : 1
                        });
                    },i*300, "easeOutCirc");

                });
            }, { offset: '85%' });


            var elements = $('.content-product');

            elements.each(function(){
                $(this).waypoint(function(){
                    $(this).addClass('product-inview');
                }, { offset: '85%' });
            });

        },
        cleanSpaces: function() {
            // **********************************************************************//
            // ! Remove some br and p
            // **********************************************************************//
            $('.toggle-element ~ br').remove();
            $('.toggle-element ~ p').remove();
            $('.block-with-ico h5').next('p').remove();
            $('.tab-content .row-fluid').next('p').remove();
            $('.tab-content .row-fluid').prev('p').remove();
        },
        contentProdImages: function() {
            // **********************************************************************//
            // ! Products grid images slider
            // **********************************************************************//
            $('.hover-effect-slider').each(function() {
                var slider = $(this),
                    index = 0,
                    process = false,
                    time = 300,
                    autoSlide,
                    imageLink = slider.find('.product-content-image'),
                    image = imageLink.find('img'),
                    imagesList = imageLink.data('images').split(","),
                    arrowsHTML = '<div class="sm-arrow arrow-left">left</div><div class="sm-arrow arrow-right">right</div>',
                    counterHTML = '<div class="slider-counter"><span class="current-index">1</span>/<span class="slides-count">' + imagesList.length + '</span></div>';

                if(imagesList.length > 1) {
                    slider.prepend(arrowsHTML);
                    //slider.prepend(counterHTML);

                    // Previous image on click on left arrow
                    slider.find('.arrow-left').click(function(event) {
                        if( process ) return;
                        process = true;
                        prevImage();
                    });

                    // Next image on click on left arrow
                    slider.find('.arrow-right').click(function(event) {
                        if( process ) return;
                        process = true;
                        nextImage();
                    });
                }

                function nextImage() {
                    if(index < imagesList.length - 1) {
                        index++;
                    } else {
                        index = 0; // if the last image set it to first
                    }
                    changeImage(index);
                }

                function prevImage() {
                    if(index > 0) {
                        index--;
                    } else {
                        index = imagesList.length-1; // if the first item set it to last
                    }
                    changeImage(index);
                }

                function changeImage(index) {

                    process = false;
                    image.attr('src', imagesList[index]).attr('srcset','');
                    image.removeAttr('srcset');
                    //slider.find('.current-index').text(index);// update slider counter
                }

            });
        },
        wishlist: function() {
            // **********************************************************************//
            // ! Wishlist
            // **********************************************************************//
            if( $('.et-wishlist-widget').length == 0 ) return;

            setTimeout(function() {
                $('body').addClass('wishlist-show');
            }, 1000);

            $('.yith-wcwl-add-button.show').each(function(){
                var wishListText = $(this).find('a').text();
                $(this).find('a').attr('data-hover',wishListText);
            });

            /* Storage Handling */
            var $supports_html5_storage;
            try {
                $supports_html5_storage = ( 'sessionStorage' in window && window.sessionStorage !== null );
                window.sessionStorage.setItem( 'etheme', 'test' );
                window.sessionStorage.removeItem( 'etheme' );
            } catch( err ) {
                $supports_html5_storage = false;
            }

            /* Cart session creation time to base expiration on */
            function set_wishlist_creation_timestamp() {
                if ( $supports_html5_storage ) {
                    sessionStorage.setItem( 'et_wishlist_created', ( new Date() ).getTime() );
                }
            }

            /** Set the cart hash in both session and local storage */
            function set_wishlist_hash( hash ) {
                if ( $supports_html5_storage ) {
                    localStorage.setItem( 'et_wishlist_hash', hash );
                    sessionStorage.setItem( 'et_wishlist_hash', hash );
                }
            }

            var $fragment_refresh = {
                url: etConfig.ajaxurl,
                data: {
                    action: 'etheme_wishlist_fragments'
                },
                method: 'get',
                success: function(data) {
                    setWishlist(data.wishlist);
                    if ( $supports_html5_storage ) {
                        sessionStorage.setItem( 'etheme_wishlist', data.wishlist );

                        set_wishlist_hash( data.wishlist_hash );

                        if ( data.wishlist_hash ) {
                            set_wishlist_creation_timestamp();
                        }
                    }
                }
            };

            function refresh_wishlist_fragment() {
                $.ajax( $fragment_refresh );
            }

            /* Refresh wishlist after window is loaded */
            jQuery('.wpml-ls-item a').on('click', function(){
                var url = jQuery(this).attr('href');
                sessionStorage.setItem('lang_url', url);
            });
            if (sessionStorage.getItem('lang_url')) {
                refresh_wishlist_fragment();
                sessionStorage.removeItem('lang_url'); 
            }

            /* Cart Handling */
            if ( $supports_html5_storage ) {

                var wishlist_timeout = null,
                    day_in_ms    = ( 24 * 60 * 60 * 1000 );

                $( document.body ).bind( 'added_to_cart added_to_wishlist removed_from_wishlist', function() {
                    var prev_wishlist_hash = sessionStorage.getItem( 'et_wishlist_hash' );

                    if ( prev_wishlist_hash === null || prev_wishlist_hash === undefined || prev_wishlist_hash === '' ) {
                        set_wishlist_creation_timestamp();
                    }

                    refresh_wishlist_fragment();

                });

                try {
                    var wishlist_fragment = sessionStorage.getItem( 'etheme_wishlist' ),
                        wishlist_hash    = sessionStorage.getItem( 'et_wishlist_hash' ),
                        cookie_hash  = $.cookie( 'et_wishlist_hash'),
                        wishlist_created = sessionStorage.getItem( 'et_wishlist_created' );

                    if ( wishlist_hash === null || wishlist_hash === undefined || wishlist_hash === '' ) {
                        wishlist_hash = '';
                    }

                    if ( cookie_hash === null || cookie_hash === undefined || cookie_hash === '' ) {
                        cookie_hash = '';
                    }

                    if ( wishlist_hash && ( wishlist_created === null || wishlist_created === undefined || wishlist_created === '' ) ) {
                        throw 'No wishlist_created';
                    }

                    if ( wishlist_fragment && wishlist_hash === cookie_hash ) {

                        setWishlist(wishlist_fragment);

                    } else {
                        throw 'No fragment';
                    }

                } catch( err ) {
                    refresh_wishlist_fragment();
                }

            } else {
                refresh_wishlist_fragment();
            }

            function setWishlist( wishlist ) {
                $('.et-wishlist-widget').replaceWith(wishlist);
            }

            var timeout = 0;

            $( document.body ).bind( 'added_to_wishlist', function() {
                var navbar = $('.header .navbar-header');

                clearTimeout(timeout);

                if( $('body').hasClass('et-header-fixed') && $('.fixed-header').hasClass('fixed-enabled') ) {
                    navbar = $('.fixed-header .navbar-header');
                }

                navbar.addClass('wishlist-widget-show');

                setTimeout(function() {
                    navbar.addClass('wishlist-widget-show');
                }, 1000);

                timeout = setTimeout(function() {
                    navbar.removeClass('wishlist-widget-show');
                }, 4500);
            });

        },
        mainNavigation: function() {
            // **********************************************************************//
            // ! Main Navigation plugin
            // **********************************************************************//
            $.fn.et_menu = function ( options ) {
                var methods = {
                    init: function(el) {
                        methods.el = el;

                        if ( $(window).width() <= 1024 ) {
                            methods.responsive();
                        }

                        if ( $(window).width() <= 1440 ) {
                            methods.TouchHoverDropdown();
                        }

                        $(window).resize(function() {
                            if ( ! $( 'body' ).hasClass( 'et-vertical-fixed' ) ) methods.setOffsets();
                            methods.sideMenu();
                        });

                        if ( ! $( 'body' ).hasClass( 'et-vertical-fixed' ) ) methods.setOffsets();
                        methods.alignLeft();

                        el.find('a').has('.nav-item-tooltip').hover(function() {
                            var newContent = '';
                            var tooltip = $(this).find('.nav-item-tooltip');
                            var src = tooltip.find('>div').first().attr('data-src');
                            if(src.length > 10) {
                                newContent = '<img src="' + src + '" />';
                                tooltip.html(newContent);
                            }
                        });

                    },
                    responsive: function(){
                        $( '.menu-main-container li a' ).on( 'click', function(e){
                            if ( ! $(this).parent('li').hasClass( 'menu-item-has-children' ) ) return;
                            if ( ! $(this).is('[q]') ) {
                                $(this).attr( 'q', 0 );
                            } 
                            var q = $(this).attr( 'q' );
                            if ( q < 1 ) {
                                q++;
                                $(this).attr( 'q', q );
                                e.preventDefault();
                            }
                        });
                    },
                    setOffsets: function() {

                        methods.el.find('.item-design-mega-menu > .nav-sublist-dropdown, .item-design-posts-subcategories > .nav-sublist-dropdown').each(function() {
                            var boxed = ($('body').hasClass('boxed') || $('body').hasClass('framed'));
                            var smartMenu = $('body').hasClass('header-smart-responsive');
                            var extraBoxedOffset = 0;
                            if(boxed) {
                                extraBoxedOffset = $('.page-wrapper').offset().left;
                            }

                            var li = $(this).parent();
                            var liOffset = li.offset().left - extraBoxedOffset;
                            var liOffsetTop = li.offset().top;
                            var liWidth = $(this).parent().width();
                            var dropdowntMarginLeft = liWidth/2;
                            var dropdownWidth = $(this).outerWidth();
                            var dropdowntLeft = liOffset - dropdownWidth/2;
                            var dropdownBottom = liOffsetTop - $(window).scrollTop() + $(this).outerHeight();
                            var left = 0;
                            var top = $('.header').outerHeight()/2;
                            var fitHeight = false;

                            if(dropdowntLeft < 0) {
                                left = liOffset - 10;
                                dropdowntMarginLeft = 0;
                            } else {
                                left = dropdownWidth/2;
                            }

                            if (smartMenu !== true) {
                                $(this).css({
                                    'top': top,
                                    'left': - left,
                                    'marginLeft': dropdowntMarginLeft
                                });
                            }

                            var dropdownRight = ($(window).width() - extraBoxedOffset*2) - (liOffset - left + dropdownWidth + dropdowntMarginLeft);

                            if(dropdownRight < 0) {
                                $(this).css({
                                    'left': 'auto',
                                    'right': - ($(window).width() - liOffset - liWidth - 10) + extraBoxedOffset*2
                                });
                            }

                            if(fitHeight && dropdownBottom > $(window).height()) {
                                $(this).css({
                                    'top': 'auto',
                                    'bottom': - ($(window).height() - (liOffsetTop - $(window).scrollTop() + li.outerHeight())) + 15
                                });
                            }

                        });
                        
                        if ($('body').hasClass('header-smart-responsive') !== true) {

                            methods.el.find('.item-design-dropdown > .nav-sublist-dropdown, .item-design-mega-menu > .nav-sublist-dropdown').each(function() {
                                var boxed = ($('body').hasClass('boxed') || $('body').hasClass('framed'));
                                var top = $('.header').outerHeight()/2;
                                 
                               $(this).css({
                                    'top': top
                                });

                            });

                        }

                        if ($('body').find('.fixed-header')) {
                            $('.fixed-header .item-design-dropdown > .nav-sublist-dropdown, .fixed-header .item-design-mega-menu > .nav-sublist-dropdown').each(function() {

                                $(this).css({
                                    'top': $(this).parent().outerHeight()
                                });

                            });
                        }
                    },

                    alignLeft: function() {
                        //var li = $('.item-design-posts-subcategories');
                        //
                        //if(li.length < 1) return;
                        //
                        //var dropdown = li.find('.nav-sublist-dropdown'),
                        //    dropdownOffset = li.offset().left,
                        //    contentOffset = $('.page-wrapper').find('> .container').first().offset().left,
                        //    dropdownContainerOffset = dropdownOffset - contentOffset;
                        //
                        //dropdown.css({
                        //    'left': - dropdownContainerOffset + 30
                        //});

                    },

                    sideMenu: function() {
                        if($(window).height() < 800) {
                            $('.header-wrapper').addClass('header-scrolling');
                        } else {
                            $('.header-wrapper').removeClass('header-scrolling');
                        }
                    },

                    TouchHoverDropdown: function () {
                        if ( $(window).width() < 992 ) return;
                        var times = 0;
                        var isTouch = ('ontouchstart' in document.documentElement);
                        if( isTouch ) {
                            $('.menu-item-has-children a').click(function(e) {
                                if (times == 0) {
                                    e.preventDefault();
                                    times = 1;
                                }
                                else {
                                    $('.menu-item-has-children a').dblclick(function() {
                                        window.location = $(this).attr('href');
                                    });
                                }
                            });
                        }
                    }
                };

                var settings = $.extend({
                    type: "default"
                }, options );

                methods.init(this);


                return this;
            }

            // First Type of column Menu
            $('.menu-main-container .menu:not(.header-type-vertical .menu, .header-type-vertical2 .menu)').et_menu({
                type: "default"
            });

        },
        backToTop: function() {
            // **********************************************************************//
            // ! "Top" button
            // **********************************************************************//

            var scroll_timer;
            var displayed = false;
            var $message = $('.back-top');

            $(window).scroll(function () {
                window.clearTimeout(scroll_timer);
                scroll_timer = window.setTimeout(function () {
                    if($(window).scrollTop() <= 0) {
                        displayed = false;
                        $message.addClass('bounceOut').removeClass('bounceIn');
                    }
                    else if(displayed == false) {
                        displayed = true;
                        $message.stop(true, true).removeClass('bounceOut').addClass('bounceIn').click(function () { $message.addClass('bounceOut').removeClass('bounceIn'); });
                    }
                }, 400);
            });

            $('.back-top').click(function(e) {
                $('html, body').animate({scrollTop:0}, 600);
                return false;
            });
        },
        portfolio: function() {
            // **********************************************************************//
            // ! Portfolio
            // **********************************************************************//

            var $portfolio = $('.portfolio');

            $portfolio.each(function() {

                var $grid = $(this).isotope({
                    itemSelector: '.portfolio-item',
                    isOriginLeft: ! $('body').hasClass('rtl'),
                    masonry: {
                        columnWidth: '.grid-sizer'
                    }
                });

                // fix for brands list
                //if ( ! $( 'body' ).hasClass( 'page-template-portfolio' ) ) $grid.isotope( 'cellsByRow' );

                // layout Isotope after each image loads
                $grid.imagesLoaded().progress( function() {
                    $grid.isotope('layout');
                });

                $grid.parent().find('.portfolio-filters a').click(function(){
                    var selector = $(this).attr('data-filter');
                    $grid.parent().find('.portfolio-filters a').removeClass('active');
                    if(!$(this).hasClass('active')) {
                        $(this).addClass('active');
                    }
                    $grid.isotope({ filter: selector });
                    return false;
                });
            });

            setTimeout(function(){
                $('.portfolio').addClass('with-transition');
                $('.portfolio-item').addClass('with-transition');
                $(window).resize();
            },500);
        },

        isotope: function() {
            // **********************************************************************//
            // ! Blog isotope
            // **********************************************************************//

            var $blog = $('.blog-masonry');

            $blog.each(function() {

                var $grid = $(this).isotope({
                    isOriginLeft: ! $('body').hasClass('rtl'),
                    itemSelector: '.post-grid'
                });

                // layout Isotope after each image loads
                $grid.imagesLoaded().progress( function() {
                    $grid.isotope('layout');
                });

            });
            // **********************************************************************//
            // ! Other elements isotope
            // **********************************************************************//

            var $container = $('.isotope-container');

            var $isotope = $('.et-isotope');

            $isotope.each(function() {

                var $grid = $(this).isotope({
                    itemSelector: '.et-isotope-item',
                    isOriginLeft: ! $('body').hasClass('rtl'),
                    masonry: {
                        columnWidth: '.grid-sizer'
                    }
                });

                // layout Isotope after each image loads
                $grid.imagesLoaded().progress( function() {
                    $grid.isotope('layout').trigger('layout-changed');
                });

            });

            //$isotope.imagesLoaded( function() {
            //});
        },
        woocommerce: function() {
            // **********************************************************************//
            // ! WooCommerce
            // **********************************************************************//

            $(window).load(function(){

                if ( $( 'body' ).is( '.single-product' ) && document.URL.split( '#reviews' ).length == 2 ) {
                    $('#tab_reviews').click();
                    setTimeout(function() {
                        $('html, body').animate({scrollTop: $('.woocommerce-tabs').offset().top }, 300);
                    },  300 );
                }

                if ( $( 'body' ).is( '.single-product' ) && document.URL.split( '#comment' ).length == 2 ) {
                    var id = document.URL.split( '#' )[1];
                    $('#tab_reviews').click();
                    setTimeout(function() {
                        $('html, body').animate({scrollTop: $('#' + id).offset().top }, 300);
                    },  300 );
                }
            });

            $('.woocommerce-review-link').click(function(e) {
                e.preventDefault();
                if( ! $('#tab_reviews').hasClass('opened')) $('#tab_reviews').click();
                $('html, body').animate({scrollTop: $('.woocommerce-tabs').offset().top }, 300);
            });

        },

        quantityIncrements: function( reinit ) {
            if ( $( 'body' ).is( '.et_quantity-off' ) ) return;

            // Quantity buttons
            $( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).append( '<span value="+" class="plus" ></span>' ).prepend( '<span value="-" class="minus" ></span>' );

            if( reinit ) return;

            $( document ).on( 'click', '.plus, .minus', function() {

                // Get values
                var $qty        = $( this ).closest( '.quantity' ).find( '.qty' ),
                    currentVal  = parseFloat( $qty.val() ),
                    max         = parseFloat( $qty.attr( 'max' ) ),
                    min         = parseFloat( $qty.attr( 'min' ) ),
                    step        = $qty.attr( 'step' );
                // Format values
                if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
                if ( max === '' || max === 'NaN' ) max = '';
                if ( min === '' || min === 'NaN' ) min = 0;
                if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

                // Change the value
                if ( $( this ).is( '.plus' ) ) {

                    if ( max && ( max == currentVal || currentVal > max ) ) {
                        $qty.val( max );
                    } else {
                        $qty.val( currentVal + parseFloat( step ) );
                    }

                } else {

                    if ( min && ( min == currentVal || currentVal < min ) ) {
                        $qty.val( min );
                    } else if ( currentVal > 0 ) {
                        $qty.val( currentVal - parseFloat( step ) );
                    }

                }

                // Trigger change event
                $qty.trigger( 'change' );

            });

            $( document.body ).on( 'updated_wc_div', function() {
                etTheme.quantityIncrements( true );
            } );
        },

        isIE: function  () {
            if (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0) {
                return true;
            }
            return false;
        },

        updateFavicon: function() {
            var itemsCount = $('.badge-number').data('items-count'),
                enableBadge = $('.shopping-container').data('fav-badge');

            var favicon = new Favico({
                animation : 'popFade',
                fontStyle : 'normal',
                bgColor: '#000'
            });


            if (enableBadge == 'enable') {
                favicon.badge(itemsCount);
            }
        },

        ajaxAddToCartInit: function() {
            var timeout = 0;

            etTheme.updateFavicon();

            $( document.body )
                .on( 'adding_to_cart', function(event, $thisbutton, data) {

                    if ( $thisbutton == null ) return;

                    var product = $thisbutton.parents('.content-product');

                    product.addClass('adding-to-cart');

                    if($thisbutton.hasClass('single_add_to_cart_button')) {
                        $('body').addClass('global-adding-to-cart');
                    }

                })
                .on( 'added_to_cart', function(event, fragments, cart_hash, $thisbutton) {
                    var product = $thisbutton.parents('.content-product, .type-product'),
                        name = product.find('.product-title a').text(),
                        imageSrc = product.find('.wp-post-image').attr('src'),
                        cart = $('.header .shopping-container'),
                        tooltip = $('<div/>').addClass('added-cart-tooltip tooltip-shown').html( etConfig.successfullyAdded + ' <span>' + etConfig.checkCart + '</span>');

                    clearTimeout(timeout);

                    $thisbutton.siblings('.added-cart-tooltip').remove();
                    $thisbutton.before(tooltip);

                    if( $('body').hasClass('et-header-fixed') && $('.fixed-header').hasClass('fixed-enabled') ) {
                        cart = $('.fixed-header .shopping-container');
                    }

                    etTheme.updateFavicon();

                    setTimeout( function() {
                        product.removeClass('adding-to-cart');
                        $('body').removeClass('global-adding-to-cart');
                    }, 400 );

                    cart.addClass('cart-show');
                    timeout = setTimeout(function() {
                        cart.removeClass('cart-show');
                        tooltip.removeClass('tooltip-shown');
                    }, 3500);
                } );

            /* Quantity sync */
            $(document).on('change', 'form.cart input.qty', function() {
                $(this.form).find('button[data-quantity]').data('quantity', this.value);
            });

            $( document.body ).on( 'wc_fragments_refreshed',function() {
                etTheme.updateFavicon();
            } );

        },

        variationsThumbs: function() {
            /* Variations images */

            var firstThumb = $('.thumbnails-list .thumbnail-item').first().find('a');

            if( ! firstThumb ) return;

            var img = firstThumb.find('img'),
                origSrc = img.attr('src'),
                origSrcset = img.attr('srcset'),
                origHref = firstThumb.attr('href');

            $( '.variations_form' ).on('found_variation', function( event, variation ) {
                if( variation.image_link ) {
                    firstThumb.attr('href', variation.image_link);
                }
                if( variation.image_src ) {
                    img.attr('src', variation.image_src);
                }
                if( variation.image_srcset ) {
                    img.attr('srcset', variation.image_srcset);
                }

                goToFirst();
            })
                .on('reset_data', function() {
                    firstThumb.attr('href', origHref);
                    img.attr('src', origSrc);
                    img.attr('srcset', origSrcset);
                });

            var goToFirst = function() {
                var swiperMain = $(".main-images").data('Swiper');
                if( typeof swiperMain != 'undefined') {
                    swipers['swiper-'+index].slideTo(0);
                }
            };

        },

        videoPopup: function() {
            $('.open-video-popup').magnificPopup({
                type:'inline',
                midClick: true,
                callbacks: {
                    open: function() {
                        etTheme.resizeVideo();
                    }
                }
            });
            $('.open-360-popup').magnificPopup({
                type:'inline',
                midClick: true
            });
        },

        quickView: function() {
            // **********************************************************************//
            // ! AJAX Quick View
            // **********************************************************************//
            $(document).on('click', '.show-quickly, .show-quickly-btn', (function() {
                var $thisbutton = $(this);
                var $productCont = $(this).parent().parent().parent();
                var prodid = $thisbutton.data('prodid');
                // var magnificPopup;
                $.ajax({
                    url: etConfig.ajaxurl,
                    method: 'POST',
                    data: {
                        'action': 'etheme_product_quick_view',
                        'prodid': prodid
                    },
                    dataType: 'html',
                    beforeSend: function() {
                        $productCont.addClass('loading');
                        $productCont.append('<div id="floatingCirclesG"><div class="f_circleG" id="frotateG_01"></div><div class="f_circleG" id="frotateG_02"></div><div class="f_circleG" id="frotateG_03"></div><div class="f_circleG" id="frotateG_04"></div><div class="f_circleG" id="frotateG_05"></div><div class="f_circleG" id="frotateG_06"></div><div class="f_circleG" id="frotateG_07"></div><div class="f_circleG" id="frotateG_08"></div></div>');
                    },
                    complete: function() {
                        $productCont.find('#floatingCirclesG').remove();
                        $productCont.removeClass('loading');
                        etTheme.quantityIncrements( true );
                    },
                    success: function(response){
                        $.magnificPopup.open({
                            items: { src: '<div class="quick-view-popup mfp-with-anim"><div class="doubled-border">' + response + '</div></div>' },
                            type: 'inline',
                            removalDelay: 500,
                            callbacks: {
                                beforeOpen: function() {
                                    // just a hack that adds mfp-anim class to markup
                                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                                    this.st.mainClass = 'mfp-zoom-out';
                                    $('body').addClass('quick-view-open');

                                },
                                afterClose: function() {
                                    $('body').removeClass('quick-view-open');
                                }
                            },
                        }, 0);

                        $('.images').addClass('shown');

                        var excerpt = $('.quick-view-excerpts'),
                            info = $('.quick-view-info');

                        excerpt.on('click', '.excerpt-title', function() {
                            if( ! info.hasClass('info-hidden') ) {
                                info.slideUp(500).addClass('info-hidden');
                            } else {
                                info.slideDown(500).removeClass('info-hidden');
                            }
                            excerpt.toggleClass('show-content');
                        });

                        excerpt.find('.excerpt-content').nanoScroller({
                            contentClass: 'excerpt-content-inner',
                            preventPageScrolling: true
                        });
                        etTheme.swiperFunc();
                    },
                    error: function() {
                        $.magnificPopup.open({
                            items: {
                                src: '<div class="quick-view-popup mfp-with-anim"><div class="doubled-border">Error with AJAX request</div></div>'
                            },
                            type: 'inline',
                            removalDelay: 500, //delay removal by X to allow out-animation
                            callbacks: {
                                beforeOpen: function() {
                                    this.st.mainClass = 'mfp-zoom-in-to-left-out';
                                }
                            }
                        }, 0);
                    }
                });

            }));

            $('body').on('click', '.quick-view-popup .main-images a', function(e) {
                e.preventDefault();
            });
        },
        searchform: function() {
            // **********************************************************************//
            // ! Search form
            // **********************************************************************//

            var search = $('.header-search');

            search.each(function(){
                var s = $(this);

                s.on('click', '.search-btn', function( e ) {
                    e.preventDefault();

                    if( search.hasClass('search-open') ) {
                        closeSearch();
                    } else {
                        openSearch();
                    }
                });

                $('body').on("click", ".page-wrapper", function(event) {

                    if ( ! $(event.target).is('.header-search') && $(event.target).closest('.header-search').length ) return;

                    if( s.hasClass('search-open') ) {
                        closeSearch();
                    }
                });

                var openSearch = function() {
                    //$('body').addClass('global-search-open');
                    $('.navbar-header').addClass('search-active');
                    s.parents('.header-wrapper, .fixed-header').addClass('search-now-opened');
                    s.addClass('search-open');
                    s.find('.search-form-wrapper').fadeIn(200);
                    s.find('input[type="text"]').focus();
                };

                var closeSearch = function() {
                    //$('body').removeClass('global-search-open');
                    s.parents('.header-wrapper, .fixed-header').removeClass('search-now-opened');
                    s.removeClass('search-open');
                    s.find('.search-form-wrapper').fadeOut(200);
                    $('.navbar-header').removeClass('search-active');
                };
            });

        },
        tabs: function() {
            // **********************************************************************//
            // ! Tabs
            // **********************************************************************//

            var tabs = $('.tabs');
            $('.tabs > p > a').unwrap('p');

            var leftTabs = $('.left-bar, .right-bar');
            var newTitles;
            var time = 50;

            leftTabs.each(function(){

                var $this = $(this);

                newTitles = $this.find('.tabs-nav').clone();

                newTitles.removeClass('tabs-nav').find('a').addClass('tab-title-left');

                newTitles.first().addClass('opened');

                var tabNewTitles = $('<div class="left-titles"></div>').prependTo($this);
                tabNewTitles.html(newTitles);

                $this.find('.tab-content').css({
                    'minHeight' : tabNewTitles.height()
                });
            });


            tabs.each(function(){
                var $this = $(this);
                var href = [];
                var id = '';

                if( $('.tabs').find('.swiper-container').length ) {
                    swipers['swiper-'+tabs.first('.et-tab').find('.swiper-container').attr('id')].onResize();
                }

                if( tabs.hasClass('accordion') || tabs.hasClass('left-bar') ) {
                    $this.find('.tabs-nav').remove();
                    $this.find('.accordion-title').first().addClass('opened-parent');
                }

                $.each( $this.find('.tab-title'), function( i, val ) {
                    href[i] = val.href;
                });

                if ( $.inArray( document.URL, href ) != -1 ) {
                    id = document.URL.split( '#' );
                    $( '#' + id[1] ).addClass( 'opened' ).parent().addClass( 'et-opened' );
                    $this.find('.accordion-title').first().addClass( 'opened' );
                    $this.addClass('tabs-ready');
                    $this.find('#content_' + id[1] + '.et-tab').show();
                } else {
                    $this.find('.tab-title').first().addClass('opened').parent().addClass('et-opened');
                    $this.find('.accordion-title').first().addClass('opened');
                    $this.addClass('tabs-ready');
                    $this.find('.et-tab').first().show();
                }

                $this.on('click', '.tab-title, .tab-title-left', function(e){
                    e.preventDefault();
                    var tabId = $(this).attr('id');

                    if(tabOpened(tabId)){
                        //closeTab($this, tabId, false);
                    }else{
                        var reopen = ( $(this).parents( '.tabs' ).first().find( '.et-tabs-wrapper' ).length > 0 ) ? tabReopen( $(this) ) : '';

                        closeAllTabs( $this, $(this) );
                        setTimeout(function() {
                            openTab($this, tabId);
                            if ( reopen != '' ) openTab($this, reopen);
                        }, time );

                        if ( $(this).parent().is( '.accordion-title' ) ) {
                            setTimeout(function() {
                               scrollToId(tabId);
                            }, time + 150 );
                        };
                    }

                    function scrollToId(id){
                        var offset = 130;
                        var position = 0;

                        position = $('#'+id).offset().top - offset;

                        $('html, body').animate({
                            scrollTop: position
                        }, 1000);
                    }
                });

                $this.on('click', '.accordion-title', function(e){
                    e.preventDefault();
                    if ( $this.parents( '.woocommerce-tabs' ).length > 0 ) return;
                    var tabId = $(this).attr('data-id');

                    if(tabOpened(tabId)){
                        closeTab($this, tabId, false);
                    }else{
                        var reopen = ( $(this).parents( '.tabs' ).first().find( '.et-tabs-wrapper' ).length > 0 ) ? tabReopen( $(this) ) : '';

                        closeAllTabs( $this, $(this) );
                        setTimeout(function() {
                            openTab($this, tabId);
                            if ( reopen != '' ) openTab($this, reopen);
                        }, time );
                    }
                });
            });

            var tabReopen = function( tab ) {
                var reopen = '';
                tab.parents( '.tabs' ).first().find( '.et-tabs-wrapper .tab-title, .et-tabs-wrapper .tab-title-left' ).each(function(){
                    if ( $(this).hasClass( 'opened' ) ) {
                        reopen = $(this).attr('id');
                    }

                });
                return reopen;
            };

            var tabOpened = function(id) {
                return $('#' + id).hasClass('opened');
            };

            var openTab = function(tabs, id) {
                if( tabs.hasClass('accordion') || ($(window).width() < 767 && ! tabs.hasClass('products-tabs')) ) {
                    $('#content_'+id).fadeIn(time); // Fix it
                    $('#' + id).parent().addClass('opened-parent');
                } else {
                    $('#content_' + id).fadeIn(time);
                }

                $('#' + id).addClass('opened').parent().addClass('et-opened');
                $('[data-id="' + id +'"]').addClass('opened');

                if( $('.tabs').find('.swiper-container').length ) {
                    swipers['swiper-'+$('#content_' + id).find('.swiper-container').attr('id')].onResize();
                }

                setTimeout(function() { $(window).resize(); }, 100 );
            };

            var closeTab = function(tabs, id, forceClose) {
                if( tabs.hasClass('accordion') || ($(window).width() < 767 && ! tabs.hasClass('products-tabs'))){
                    $('#content_' + id).fadeOut(time);
                    $('#' + id).removeClass('opened').parent().removeClass('et-opened');
                    $('#' + id).parent().removeClass('opened-parent');
                    $('[data-id="' + id +'"]').removeClass('opened');
                } else if(forceClose) {
                    $('#content_' + id).fadeOut(time);
                    $('#' + id).removeClass('opened').parent().removeClass('et-opened');
                    $('[data-id="' + id +'"]').removeClass('opened');
                }

            };

            var closeAllTabs = function( tabs, curretTab ) {
                curretTab.parents( '.tabs' ).first().find( '.tab-title, .tab-title-left' ).each(function(){
                    var tabId = $(this).attr('id');
                    if(tabOpened(tabId)) {
                        closeTab(tabs, tabId, true);
                    }
                });
            };

            $('.tabs-with-scroll .tab-content-inner').nanoScroller({
                contentClass: 'tab-content-scroll',
                preventPageScrolling: true
            });
        },
        categoriesAccordion: function() {
            // **********************************************************************//
            // ! Categories Accordion
            // **********************************************************************//

            $.fn.etAccordionMenu = function ( options ) {

                var $this = $(this);

                var etCats = $('.product-categories');
                $this.addClass('with-accordion');
                var openerHTML = '<i class="fa fa-angle-down open-this" aria-hidden="true"></i>';

                $this.find('> li').has('.children, .nav-sublist-dropdown').has('li').addClass('parent-level0');
                $this.find('li').has('.children, .nav-sublist-dropdown').prepend(openerHTML);
                if ( $this.closest('.sidebar').hasClass('first-category-closed') !== true ) {
	                if($this.find('.current-cat, .current-cat-parent').length > 0) {
	                    $this.find('.current-cat, .current-cat-parent').find('> .open-this').removeClass( 'fa-angle-down' ).addClass('fa-angle-down').parent().addClass('opened').find('> ul.children').show();
	                } else {
	                    $this.find('>li').first().find('> .open-this').removeClass( 'fa-angle-down' ).addClass('fa-angle-down').parent().addClass('opened').find('> ul.children').show();
	                }
	            }

                $this.find('.open-this').click(function() {
                    if($(this).parent().hasClass('opened')) {
                        $(this).removeClass( 'fa-angle-down' ).addClass('fa-angle-up').parent().removeClass('opened').find('> ul, > div.nav-sublist-dropdown').slideUp(200);
                    }else {
                        $(this).removeClass( 'fa-angle-down' ).addClass('fa-angle-down').parent().addClass('opened').find('> ul, > div.nav-sublist-dropdown').slideDown(200);
                    }
                });

                return this;
            }

            if(etConfig.catsAccordion) {
                $('.product-categories').etAccordionMenu();
            }
        },

        CustomMenuAccordion: function() {
            // **********************************************************************//
            // ! Custom Menu Accordion
            // **********************************************************************//

            $.fn.etAccordionMenu = function ( options ) {

                var $this = $(this);

                $this.addClass('with-accordion');
                var openerHTML = '<i class="fa fa-angle-down open-this" aria-hidden="true"></i>';

                $this.find('> li').has('.menu-item-has-children, .sub-menu').has('li').addClass('parent-level0');
                $this.find('li').has('.menu-item-has-children, .sub-menu').prepend(openerHTML);

                if($this.find('.current-menu-item').length > 0) {
                    $this.find('.current-menu-item').find('> .open-this').removeClass( 'fa-angle-down' ).addClass('fa-angle-down').parent().addClass('opened').find('> ul.children').show();
                } else {
                    $this.find('>li').first().find('> .open-this').removeClass( 'fa-angle-down' ).addClass('fa-angle-down').parent().addClass('opened').find('> ul.children').show();
                }

                $this.find('.open-this').click(function() {
                    if($(this).parent().hasClass('opened')) {
                        $(this).removeClass( 'fa-angle-down' ).addClass('fa-angle-up').parent().removeClass('opened').find('> ul, > div.nav-sublist-dropdown').slideUp(200);
                    }else {
                        $(this).removeClass( 'fa-angle-down' ).addClass('fa-angle-down').parent().addClass('opened').find('> ul, > div.nav-sublist-dropdown').slideDown(200);
                    }
                });

                return this;
            }

            $( '.sidebar-widget.widget_nav_menu .menu' ).etAccordionMenu();
        },

        toggles: function() {
            // **********************************************************************//
            // ! Toggle elements
            // **********************************************************************//

            var etoggle = $('.toggle-block');
            var etoggleEl = etoggle.find('.toggle-element');

            var plusIcon = '+';
            var minusIcon = '&ndash;';

            //etoggleEl.first().addClass('opened').find('.open-this').html(minusIcon).parent().parent().find('.toggle-content').show();

            etoggleEl.click(function(e) {
                e.preventDefault();
                if($(this).hasClass('opened')) {
                    $(this).removeClass('opened').find('.open-this').html(plusIcon).parent().parent().find('.toggle-content').slideUp(200);
                }else {
                    if($(this).parent().hasClass('noMultiple')){
                        $(this).parent().find('.toggle-element').removeClass('opened').find('.open-this').html(plusIcon).parent().parent().find('.toggle-content').slideUp(200);
                    }
                    $(this).addClass('opened').find('.open-this').html(minusIcon).parent().parent().find('.toggle-content').slideDown(200);
                }
            });
        },
        closeParentBtn: function() {
            // **********************************************************************//
            // ! Alerts
            // **********************************************************************//
            var closeParentBtn = $('.close-parent');

            closeParentBtn.click(function(e){
                closeParent(this);
            });

            function closeParent(el) {
                $(el).parent().slideUp(100);
            }
        },

        commentsForm: function() {
            // **********************************************************************//
            // ! Custom Comment Form Validation
            // **********************************************************************//
            var commentForm = $('#commentform');

            commentForm.on('click', '#submit', function(e){
                $('#commentsMsgs').html('');

                commentForm.find('.required-field').each(function(){
                    if($(this).val() == '') {
                        $(this).addClass('validation-failed');
                        e.preventDefault();
                    }
                });

            });
        },
        mobileMenu: function() {
            // **********************************************************************//
            // ! Mobile Menu
            // **********************************************************************//
            $('.navbar-toggle').click(function(){
                if($('body').hasClass('mobile-menu-opened')) {
                    closeMenu();
                } else {
                    openMenu();
                }
            });

            var navList = $('.mobile-menu-wrapper .menu');
            var opener = '<span class="open-child">(open)</span>';

            navList.find('li:has(ul)',this).each(function() {
                var $this = $(this),
                    backtext,
                    allLink;
                // if ( $this.parents( '.navbar-collapse' ).hasClass( 'fullscreenMenu-collapse' ) ) {
                //     var thisHtml = $this.html();
                //     $this.html('');
                //     $this.prepend( '<div class="inside">' + opener + thisHtml + '</div><!-- .insid -->' );
                // } else {
                $this.prepend(opener);
                // }

                //if( $this.hasClass('item-level-0') ) {
                //    backtext = etConfig.menuBack;
                //} else {
                //    backtext = $this.parents('li').find('> a').text();
                //}
                backtext = etConfig.menuBack;
                allLink = $this.find('> a').clone();
                $this.find('> ul').prepend('<li class="menu-show-all">' + allLink.wrap('<div>').parent().html() + '</li>');
                $this.find('> ul').prepend('<li class="menu-back"><a href="javascript:void(0);">' + backtext + '</a></li>');
            });

            navList.on('click', '.open-child', function(){
                if ($(this).parent().hasClass('over')) {
                    $(this).parent().removeClass('over');
                    if($(this).parent().hasClass('item-level-0')) {
                        navList.removeClass('moves-out');
                    }
                }else{
                    $(this).parent().parent().find('>li.over').removeClass('over');
                    $(this).parent().addClass('over');
                    if($(this).parent().hasClass('item-level-0')) {
                        navList.addClass('moves-out');
                    }
                }
            });

            navList.on('click', '.menu-back', function(){
                var $parent = $(this).parent().parent();
                if ($parent.hasClass('over')) {
                    $parent.removeClass('over');
                    if($parent.hasClass('item-level-0')) {
                        navList.removeClass('moves-out');
                    }
                }
            });

            $(document).on('click touchstart', function(event) {
                if(!$(event.target).closest('.mobile-menu-wrapper').length && ! $(event.target).closest('.navbar-toggle').length) {
                    if($('body').hasClass('mobile-menu-opened')) {
                        closeMenu();
                    }
                }
            })

            heightSubmenu();

            $( '.mobile-menu-wrapper .open-child' ).on('click touchstart', function(event) {
                setTimeout(function(){ $('.navbar-collapse').animate({scrollTop:0}, 600); }, 500);
            });

            if ( ! $( '.mobile-menu-wrapper' ).hasClass( 'fullscreenMenu' ) ) {
                $( ".mobile-menu-wrapper > .container" ).nanoScroller({
                    contentClass: 'navbar-collapse'
                });
            } else {
                $( "#fullscreenMenu > .container.fullscreenMenu-container" ).nanoScroller({
                    contentClass: 'fullscreenMenu-collapse'
                });
            }

            function openMenu() {
                $('body').removeClass('mobile-menu-closed').addClass('mobile-menu-opened');
                $('.navbar-toggle').addClass('show-nav');
                //$('html, body').animate({scrollTop:0}, 0);
            }

            function closeMenu() {
                $('.navbar-toggle').removeClass('show-nav');
                $('body').removeClass('mobile-menu-opened').addClass('mobile-menu-closed');
            }

            function heightSubmenu() {
                var subHeight = navList.outerHeight();
                navList.find('.sub-menu').css({height: subHeight});
            }

        },
        topPanel: function() {
            // **********************************************************************//
            // ! Top panel
            // **********************************************************************//
            $('.top-panel-open').click(function(){
                if($('body').hasClass('top-panel-opened')) {
                    closePanel();
                } else {
                    openPanel();
                }
            });

            $('.close-panel').click(function() {
                $('.template-content').click();
            });

            function openPanel() {
                $('body').removeClass('top-panel-closed').addClass('top-panel-opened');

                setTimeout(function() {
                    $('.template-content').one('click', function(event) {
                        if($('body').hasClass('top-panel-opened')) {
                            closePanel();
                        }
                    });
                }, 1);
            }

            function closePanel() {
                $('body').removeClass('top-panel-opened').addClass('top-panel-closed');
            }
        },
        menuPosts: function () {
            var widget      = $('.posts-subcategories'),
                nav         = widget.find('.subcategories-tabs'),
                content     = widget.find('.posts-content'),
                ajaxProcess = false,
                activeClass = 'active';

            nav.on('mouseover', 'li', function() {
                if( ajaxProcess || $(this).hasClass(activeClass) ) return;

                ajaxProcess = true;
                widget.addClass('loading-posts');
                nav.find('li').removeClass(activeClass);
                $(this).addClass(activeClass);
                var cat = $(this).data('cat');

                $.ajax( {
                    url: etConfig.ajaxurl,
                    type: 'GET',
                    dataType: 'html',
                    cache   : true,
                    data: { action: 'menu_posts', cat: cat },
                    success: function( data ) {
                        content.html(data);
                    },
                    complete: function() {
                        widget.removeClass('loading-posts');
                        ajaxProcess = false;
                    },
                    error: function() {
                        console.log('problem with ajax menu_posts action');
                    }
                } );
            });
        },

        postLayout: function() {
            var postImage = $('.post-template-large .wp-picture img, .post-template-large2 .wp-picture img, .content-article .post-gallery-slider img').first(),
                postHead = $(".single-post-large");

            if( postImage.length > 0 )
                postHead.backstretch(postImage.attr('src'));

            $(window).scroll(function(){
                var scrolledY = $(window).scrollTop();
                $(".single-post-large img").css('transform', 'translate3d(0px, ' + scrolledY/1.2 + 'px, 0px)');

            });

            $('.swiper-entry').closest('.blog-post').find('> div').addClass('swiper-class-blog');
        },

        theLook: function() {
            var looks = $('.et-looks'),
                nav = looks.find('.et-looks-nav'),
                content = looks.find('.et-looks-content'),
                openedClass = 'active-look',
                productClass = 'product-ready',
                originalTimeout = 100,
                timeout = 0;

            var recalcul = function() {
                var look = content.find('.' + openedClass ).first();
                if( look.length < 1 ) {
                    look = content.find('.et-look').first();
                }
                var height = look.attr('style','').outerHeight();
                looks.height(height);
            };

            $(window).resize(function() {
                recalcul();
            });

            looks.find('.et-isotope').on('layout-changed', function() {
                recalcul();
            })

            nav.find('li').first().addClass('active');

            nav.on('click', 'a', function(e) {

                e.preventDefault();

                var index = $(this).parent().index(),
                    openLook = content.find('.et-look').eq(index);

                timeout = originalTimeout;

                if(openLook.hasClass(openedClass)) return;

                content.removeClass('has-no-active-item');

                content.find('.' + openedClass).removeClass(openedClass);
                openLook.addClass(openedClass);

                content.find('.' + productClass).removeClass(productClass);
                openLook.find('.et-isotope-item').each(function() {
                    var product = $(this).find('.content-product');
                    setTimeout(function() {
                        product.addClass(productClass);
                    }, timeout);
                    timeout = timeout + originalTimeout;
                });

                nav.find('.active').removeClass('active');
                $(this).parent().addClass('active');

                etTheme.isotope();

            });
        },

        filtersArea: function() {
            var filters = $('.shop-filters'),
                time = 200;
            $('.open-filters-btn').on('click', 'a', function(e) {
                e.preventDefault();
                if(filters.is(':visible')) {
                    $(this).removeClass('active');
                    filters.slideUp(time);
                } else {
                    $(this).addClass('active');
                    filters.slideDown(time);
                    etTheme.nanoScroll();
                    $('.shop-filters-area').isotope({
                        itemSelector: '.sidebar-widget',
                        isOriginLeft: ! $('body').hasClass('rtl'),
                        masonry: {
                            columnWidth: '.sidebar-widget'
                        }
                    });
                }
            });
        },

        stickyProductImages: function() {
            if( $(window).width() < 992 ) return;

            var imgHeight = $('.single-product .product-fixed-images .images-wrapper').innerHeight();
            var infHeight = $('.single-product .product-information').innerHeight();

            if ( imgHeight >= infHeight ) return;

            $('.product-fixed-images .images-wrapper').stick_in_parent({
                offset_top: 150
            });

            $('.product-fixed-content .product-information-inner').stick_in_parent({
                offset_top: 150
            });


        },

        countdown: function() {
            $('.et-timer').each(function () {
                var countdown = $(this),
                    update = function() {

                        var eventDate = Date.parse(countdown.data('final')) / 1000;
                        var currentDate = Math.floor($.now() / 1000);
                        var days = countdown.find('.days');
                        var hours = countdown.find('.hours');
                        var minutes = countdown.find('.minutes');
                        var seconds = countdown.find('.seconds');

                        var remindSeconds = eventDate - currentDate;

                        if (remindSeconds > 0) {
                            var remindDays = Math.floor(remindSeconds / (60 * 60 * 24));
                            remindSeconds -= remindDays * 60 * 60 * 24;
                            var remindHours = Math.floor(remindSeconds / (60 * 60));
                            remindSeconds -= remindHours * 60 * 60;
                            var remindMinutes = Math.floor(remindSeconds / (60));
                            remindSeconds -= remindMinutes * 60;

                            updateCircle($('.days').parent().find('circle'), remindDays);
                            updateCircle($('.hours').parent().find('circle'), remindHours);
                            updateCircle($('.minutes').parent().find('circle'), remindMinutes);
                            updateCircle($('.seconds').parent().find('circle'), remindSeconds);

                            if (remindDays < 10) remindDays = '0' + remindDays;
                            if (remindHours < 10) remindHours = '0' + remindHours;
                            if (remindMinutes < 10) remindMinutes = '0' + remindMinutes;
                            if (remindSeconds < 10) remindSeconds = '0' + remindSeconds;

                            if (days < 1 || remindDays == '00') {
                                days.parent().hide().next().hide();
                            } else {
                                days.text(remindDays);
                            }
                            hours.text(remindHours);
                            minutes.text(remindMinutes);
                            seconds.text(remindSeconds);
                        }
                    };
                setInterval(update, 1000);
                update();
            });

            function updateCircle(circle, value){
                var val = parseInt((value/parseInt(circle.data('max-val')))*100, 10);
                var r = parseInt(circle.attr('r'), 10);
                var c = Math.PI*(r*2);
                circle.attr('stroke-dasharray', c);
                var pct = ((val)/100)*c;
                circle.css({ strokeDashoffset: pct});
            }
        },

        // For Compare
        ForCompare: function() {

            $(document).on( 'click', 'a.compare.button', function() {

                $('body').addClass('et-compare');

            });

            $(document).on( 'click', '#cboxOverlay, #cboxClose', function() {

                $('body').removeClass('et-compare');

            });

        },

        tooltips: function() {

            var $tooltipHTML = $('<span class="et-tooltip"></span>'),
                $product = $('.single-product'),
                $compare = $product.find('.compare'),
                $wishlist = $product.find('.add_to_wishlist');


            // $compare.prepend($tooltipHTML.html($compare.text()));
            // $wishlist.prepend($tooltipHTML.clone().text($wishlist.text()));

        },

        vcRTLRows: function() {
            if( ! $('body').hasClass('rtl') ) return;
            $(document).on("vc-full-width-row", function(event, el) {
                var $elements = $('[data-vc-full-width="true"]');
                $elements.each(function() {
                    var $el = $(this);
                    var left = parseInt($el.css("left"), 10);
                    $el.css({
                        left: -left
                    });
                });
            })
        },

        // Link hover on Header Simple
        headerSimpleHover: function () {
            var halfHeaderHeight = $('.header-simple header').outerHeight() / 2,
                linkAfter = $('.header-simple .menu-wrapper .menu > li > a:after ');

            linkAfter.css( 'top', -halfHeaderHeight );
        },

        // **********************************************************************//
        // ! Jump to first slide for variable product
        // **********************************************************************//
       jumpToSlide: function() {

            $(document).on( 'found_variation' ,'form.variations_form', function( evt, variation ) {

                if ( $( '.main-slider-on' ).hasClass( 'gallery-slider-on' ) ) {
                    $( '.swiper-wrapper.thumbnails-list .swiper-slide.swiper-slide-active img' ).attr( 'src', variation.image.thumb_src );
                    if (variation.image.srcset) {
                        $( '.swiper-wrapper.thumbnails-list .swiper-slide.swiper-slide-active img' ).attr( 'srcset', variation.image.thumb_src );
                    } else {
                        $( '.swiper-wrapper.thumbnails-list .swiper-slide.swiper-slide-active img' ).attr( 'srcset', variation.image.thumb_src );
                    }
                }
            });

            $(document).on( 'reset_image', 'form.variations_form', function( evt ) {
                if ( $( '.main-slider-on' ).hasClass( 'gallery-slider-on' ) ) {

                    var red = $( '.swiper-wrapper.thumbnails-list .swiper-slide.swiper-slide-active img' ).attr('src');

                    console.log(red);

                    $( '.swiper-wrapper.thumbnails-list .swiper-slide.swiper-slide-active img' ).attr( 'src', $( '.main-images .swiper-slide.swiper-slide-active woocommerce-product-gallery__image' ).data( 'thumb' ) );
                    $( '.swiper-wrapper.thumbnails-list .swiper-slide.swiper-slide-active img' ).attr( 'srcset', $( '.main-images .swiper-slide.swiper-slide-active woocommerce-product-gallery__image' ).data( 'thumb' ) );
                }
            });

            $(document).on( 'click', '.swiper-wrapper.thumbnails-list .swiper-slide img', function (e) {
                e.preventDefault();
            });
        },

        // **********************************************************************//
        // ! ScrollMenu
        // **********************************************************************//
        scrollMenu: function(){
            var scrollMenuInside = jQuery('.header-vertical .item-design-mega-menu > .nav-sublist-dropdown > .container, .header-vertical2 .item-design-mega-menu > .nav-sublist-dropdown > .container');

            scrollMenuInside.each(function() {
                var $this = jQuery(this);
                var innerContent = $this.find('> ul');

                $this.on('mousemove', function(e) {
                    var parentOffset = $this.offset();

                    var relY = e.pageY - parentOffset.top;

                    var deltaHeight = innerContent.outerHeight() - $this.height();

                    if( deltaHeight < 0 ) return;

                    var percentY = relY / $this.height();

                    var margin = 0;

                    if( percentY <= 0 ) {
                        margin = 0;
                    } else if( percentY >= 1 ) {
                        margin = - deltaHeight;
                    } else {
                        margin = - percentY * deltaHeight;
                    }

                    margin = parseInt(margin);

                    innerContent.css({
                        'position': 'relative',
                        'top': margin
                    });
                });
            });
        },
        customCss: function () {
            var shortcodeCss = $('.etheme-css');
            if( shortcodeCss.length > 0 ){
                var css='';
                shortcodeCss.each( function(i, e){
                    var $e = $(e), data = $e.data('css');
                    if(data){
                        css += data;
                        $e.attr('data-css','');
                    }
                });
                $('head').append('<style>'+css+'</style>');
            }
        },


        // **********************************************************************//
        // ! blogAjaxLoad
        // **********************************************************************//        
        blogAjaxLoad: function() {
            // ! Loading for button
            $( 'body' ).on( 'click', '.et_load-posts a', function(e){
                e.preventDefault();

                if ( $(this).is( '.loading' ) ) return;

                $(this).addClass( 'loading' );

                var url = $(this).attr( 'href' );

                if( $(this).length > 0 ) {
                    et_load_posts( url );
                }
            });

            // ! Loading for lazy(scroll)
            if ( $('.et_load-posts').is( '.lazy-loading' ) ) {
                $(window).scroll(function(){
                    var load_btn = $('.et_load-posts');
                    var btn_top = load_btn.offset().top;
                    var btn_height = load_btn.outerHeight();
                    var window_height = $(window).height();
                    var window_scroll = $(this).scrollTop();
                    var url = load_btn.find( 'a' ).attr( 'href' );

                    if ( window_scroll < ( btn_top + btn_height - window_height ) ) return;
                    if ( load_btn.is( '.all-loaded' ) ) return;
                    if ( load_btn.find( 'a' ).is( '.loading' ) ) return;
                    if ( url.length < 1 ) return;

                    load_btn.find( 'a' ).addClass( 'loading' );

                    et_load_posts( url );
                });
            };

            function et_load_posts( url ){
                // ! Page elements
                var load_posts = $( '.et_blog-ajax' );
                var load_btn = $( '.et_load-posts' );
                var loader = load_btn.find( '.et-loader' );

                if ( load_btn.find( 'a' ).length < 1 ) return;

                load_btn.removeClass( 'loaded' ).addClass( 'loading' );
                loader.css( 'opacity', '1' );

                $.ajax({
                    url: url,
                    method: 'GET',
                    timeout: 10000,
                    dataType: 'text',
                    success: function(respond) {
                        // ! Respond elements
                        var respond_load_btn =  $( respond ).find( '.et_load-posts' );
                        var respond_posts = $( respond ).find( '.et_blog-ajax' ).html();

                        // ! Add articles to page content
                        if ( load_posts.is( '.blog-masonry' ) ) {
                            load_posts.isotope( 'insert', $( respond_posts ) );
                        } else {
                            // ! Change article class
                            respond_posts = respond_posts.replace( /article class="/g, 'article class="loading ' );
                            load_posts.append(  respond_posts );
                        }

                        // ! Add more post btn
                        if ( $( respond ).find( '.et_load-posts a' ).length < 1 ){
                            load_btn.html( '<p>' + respond_load_btn.data('loaded') + '</p>' );
                            load_btn.addClass( 'all-loaded' );
                        } else {
                            load_btn.html( respond_load_btn.html() );
                        };

                        load_btn.removeClass( 'loading' ).addClass( 'loaded' );
                    },
                    error: function(data) {
                        alert( 'Ajax error' );
                    },
                    complete: function() {
                        load_btn.removeClass('loading');
                        setTimeout(function(){ 
                            $( 'article.loading' ).removeClass( 'loading' ).addClass( 'loaded' );
                            etTheme.resizeVideo();
                            etTheme.swiperFunc();
                            if ( load_posts.is( '.blog-masonry' ) ) etTheme.isotope();
                            loader.css( 'opacity', '0' );
                        }, 300);
                    }
                });
            }
        },
        /* Navigation smart */
        navMenuSmart: function () {
            if ($('body').hasClass('global-header-vertical') || $('body').hasClass('global-header-vertical2') || $('body').hasClass('global-header-hamburger-icon')) {
                return;
            }
            if (window.innerWidth > 991 && ($('body').hasClass('header-smart-responsive')) ) {
                $('.menu-wrapper > .menu-main-container .menu').append('<li class="more menu-more item-design-dropdown"><div class="menu-more-toggle"><span></span></div><div class="nav-sublist-dropdown"><div class="container"><ul></ul></div></div></li>');
                $('.header-wrapper').addClass('header-resizing');
                $('.menu-more').on('click', function(){
                    if ($(this).hasClass('opened')) {
                        $(this).removeClass('opened');
                    }
                    else {
                        $(this).addClass('opened');
                    }
                });
                function calcWidth() {
                    if (window.innerWidth < 993) return;
                    // Prefix '_f' for fixed headers 
                    var fixed_check = false,
                        double_header = false,
                        secondaryMenu = false,
                        items_f,
                        availablespace_h;

                    var menu_wrapper = $('.header-wrapper .menu-wrapper');

                    var each_item_of = $(menu_wrapper).find(' .menu > li:not(.more)');
                    if ($('body').hasClass('et-fixed-disable') !== true ) {
                        var fixed_check = true;
                        each_item_of = $('.header-wrapper .menu-wrapper .menu > li:not(.more), .fixed-header .menu-wrapper .menu > li:not(.more)');
                    }

                    if ( $('body').hasClass('et-secondary-menu-on') ) {
                        secondaryMenu = true;
                    }

                    $(each_item_of).each(function() {
                        $(this).attr('data-width', $(this).outerWidth(true));
                    }); 

                    var morewidth_f = $('.fixed-header .menu-wrapper .menu .more').outerWidth(true); 
                    var morewidth = $(menu_wrapper).find(' .menu .more').outerWidth(true);
                    var extra_space = morewidth,
                    extra_space_f = morewidth_f;

                    // Save the origin size of toggle into the attribute just one time
                    $(document).one('ready', function (){
                        $('.header-wrapper .menu-main-container .menu .more').attr('data-width', morewidth);
                        if (fixed_check) {
                            $('.fixed-header .menu-main-container .menu .more').attr('data-width', morewidth_f);
                        }
                    });

                    //var availablespace = $('nav').outerWidth(true) - morewidth;
                    var extra_space = $(menu_wrapper).find(' .menu .more').attr('data-width');
                    var extra_space_f = $('.fixed-header .menu-main-container .menu .more').attr('data-width');
                    var availablespace_h = $('.header-wrapper .menu-wrapper > .menu-main-container').outerWidth(true) - extra_space*1.5;

                    if ( $('body').hasClass('global-header-two-rows') && secondaryMenu ) {
                        availablespace_h = $('.header .container-wrapper').outerWidth(true) - $('.header .container-wrapper .secondary-menu-wrapper').outerWidth(true) - extra_space*1.5;
                    }
                    else if ($('body').hasClass('global-header-simple') || $('body').hasClass('global-header-xstore') || $('body').hasClass('global-header-center')) {
                        availablespace_h = availablespace_h - extra_space/2; // only for these header types 
                    }

                    else if ($('body').hasClass('global-header-double-menu')) {

                        double_header = true;
                        availablespace_h = [];
                        var i = 0;
                        $(menu_wrapper).each( function() {
                            availablespace_h.push($(this).outerWidth(true) - extra_space*1.5 );
                            i+=1;
                        });

                        var children_width = 0;
                        $('.menu-wrapper:eq('+i+')').next('.navbar-header').children().each(function(){
                            children_width +=  $(this).outerWidth(true);
                        });

                        availablespace_h[availablespace_h.length-1] = $('.menu-wrapper:eq('+i+')').outerWidth(true) - Math.ceil(children_width) - extra_space*1.5;

                    }

                    else if ( $('body').hasClass('global-header-advanced') && secondaryMenu ) {
                        availablespace_h = $('.header-wrapper .menu-inner').outerWidth(true) - $(menu_wrapper).prevAll().outerWidth(true) - extra_space*2;
                    }
                    else if ( ($('body').hasClass('global-header-center3') || $('body').hasClass('global-header-standard')) && secondaryMenu ) {
                        availablespace_h = $('.header-wrapper .menu-inner').outerWidth(true) - $(menu_wrapper).find('> .menu-main-container').prevAll().outerWidth(true) - $(menu_wrapper).nextAll().outerWidth(true) - extra_space*2;
                    }
                    else if ($('body').hasClass('global-header-center3') || $('body').hasClass('global-header-standard') || $('body').hasClass('global-header-advanced')) {
                        availablespace_h = $('.header-wrapper .menu-inner').outerWidth(true) - $(menu_wrapper).nextAll().outerWidth(true) - extra_space*2;
                    }

                    if (availablespace_h < 0) {return;}

                    /* check the length of all items */
                    function et_checking_h () {
                        var navwidth = 0;

                        if (double_header) {

                            var i = 0;
                            var array = [];

                            // For multiple menu in header let's count the width of each one 
                            $(menu_wrapper).each( function() {
                                var navwidth = 0;
                                $(this).find('.menu > li:not(.more)').each( function() {
                                    navwidth += $(this).data('width'); 
                                });
                                array.push(navwidth);
                                i += 1;
                            });
                            navwidth = array;

                        }

                        else {
                            $(menu_wrapper).find('> .menu-main-container .menu > li:not(.more)').each( function (){
                                navwidth += $(this).data('width'); 
                            });;
                        }
                        return navwidth;
                    }
                    /* remove item and place in submenu if their width is more than available*/
                    function et_removing_h () {
                        var navwidth = et_checking_h();
                        // if ( navwidth < 0 ) { return; }

                        if ($.isArray(navwidth)) {
                            var i = 0; // for array 
                            var j = 1; // for menu number 
                            $($(menu_wrapper)).each( function() {

                                // Remove items in each menu of header and add on resize if there is enought space 
                                function et_multiple_removing () {
                                    navwidth = et_checking_h();
                                    if ( navwidth[i] > availablespace_h[i] || navwidth[i] == availablespace_h[i]) {
                                            var lastitem = $( '.menu-wrapper:eq('+(j)+') > .menu-main-container .menu > li:not(.more)').last();
                                            lastitem.prependTo( $('.menu-wrapper:eq('+(j)+') > .menu-main-container .menu .more ul').first());
                                            et_multiple_removing();
                                        }

                                    else {
                                        var firstItem = $('.menu-wrapper:eq('+(j)+') > .menu-main-container .menu .more ul').first().find('li').first();
                                        var firstItemWidth = firstItem.data('width');
                                        if ( (navwidth[i] + firstItemWidth ) < availablespace_h[i] ) {
                                            firstItem.insertBefore($('.menu-wrapper:eq('+(j)+') > .menu-main-container .menu .more'));
                                        }
                                    }
                                }
                                et_multiple_removing();
                                i += 1;
                                j += 1;
                            });
                        }
                        else {
                            if ( navwidth > availablespace_h || navwidth == availablespace_h) {
                                var lastitem = $(menu_wrapper).find('.menu > li:not(.more)').last();
                                lastitem.prependTo($(menu_wrapper).find('.menu .more ul').first());
                                et_removing_h();
                            }
                            else {
                                var firstItem = $(menu_wrapper).find('.menu .more ul').first().find('li').first();
                                var firstItemWidth = firstItem.data('width');
                                if ( (navwidth + firstItemWidth ) < availablespace_h ) {
                                    firstItem.insertBefore($('.header-wrapper .menu .more'));
                                }
                            }
                        }
                    }
                    et_removing_h();
                    if ( fixed_check ) {
                        var availablespace_f = $('.fixed-header .menu-wrapper > .menu-main-container').outerWidth(true) - extra_space_f*2; // extra space ( morewidth_f * 2), because sometimes there is enought space but toggle jumps down ( because of padd )
                        if (double_header) {
                            var availablespace_f = $('.fixed-header .menu-wrapper').outerWidth(true) - extra_space_f*2;
                            var toggle_check = $('.fixed-header').find('.menu-main-container:eq(1)').find('.more ul li').length;
                            availablespace_f = availablespace_f - extra_space_f/2;
                            if ( toggle_check < 0 || toggle_check == 0 ) {
                                $('.fixed-header').find('.menu-main-container:eq(1)').find('.more').remove();
                            }
                        }
                        function et_checking_f () {
                            var navwidth = 0;
                                $('.fixed-header .menu-wrapper > .menu-main-container .menu > li:not(.more)').each( function (){
                                    navwidth += $(this).outerWidth(true); 
                                });
                                return navwidth;
                        }
                        function et_removing_f () {
                            var navwidth = et_checking_f();
                            if ( navwidth < 0 ) { return; } 
                            if ( navwidth > availablespace_f || navwidth == availablespace_f ) {
                                var lastitem = $('.fixed-header .menu-wrapper .menu > li:not(.more)').last();
                                lastitem.prependTo($('.fixed-header .menu-wrapper .menu .more ul').first());
                                et_removing_f();
                            }
                            else {
                                var firstItem = $('.fixed-header .menu-wrapper .menu .more ul').first().find('li').first();
                                var firstItemWidth = firstItem.data('width');
                                if ( (navwidth + firstItemWidth ) < availablespace_f ) {
                                    firstItem.insertBefore($('.fixed-header .menu .more'));
                                }
                            }
                        }
                        et_removing_f();
                        
                        header_toggle('.fixed-header .menu-wrapper .menu .more');
                    }

                    // header_toggle - remove or show more toggle  

                    function header_toggle (header) {
                        if ($( header ).find('ul li').length > 0) {
                            if ($( header ).hasClass('hidden')) {
                                $( header ).removeClass('hidden');
                            }
                        }
                        else {
                            if ($( header ).hasClass('hidden') === false) {
                                $( header ).addClass('hidden');
                            }
                        }
                    }

                    // if double header let's check each menu for overcount items in it 

                    if (double_header) {
                        var i = 0;
                        $.each($(menu_wrapper), function() {
                            header_toggle($('.header-wrapper .menu-wrapper:eq('+i+')').find('.menu .more'));
                            i += 1;
                        });
                    }
                    else {
                        header_toggle('.header-wrapper .menu-wrapper .menu .more');
                    }
                } // end calcWidth
                $(window).on('load resize', function(){
                	var header_wrap = $('.header-wrapper');
                    var s_height = $(header_wrap).height();
                    if ( header_wrap.hasClass('header-resizing') ) {
	                    if ( header_wrap.attr('data-height') ) {
	                    	calcWidth();
	                    	var e_height = header_wrap.height();
	                    	header_wrap.css('height', header_wrap.attr('data-height'));
	                    	if ( header_wrap.attr('data-end-height') ) {
	                    		header_wrap.animate({
		                    		height: header_wrap.attr('data-end-height')
		                    	}, 300); 
		                    	header_wrap.removeAttr('data-height').removeAttr('data-end-height');
		                    	setTimeout(function(){
		                    		header_wrap.removeClass('header-resizing').attr('style', '');
		                    	}, 1500);
	                    	}
	                    	else {
	                    		header_wrap.attr('data-end-height', e_height);
	                    	}
	                    }
	                    else {
	                    	header_wrap.attr('data-height', s_height);
	                    	calcWidth();
	                    }
	                }
	                else {
                    	calcWidth();
                	}
                    
                });
            } // end check for window width 
        },
    };

    $(document).ready(function(){
        etTheme.init();
    });


})(jQuery);