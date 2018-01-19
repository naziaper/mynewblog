<?php  if ( ! defined('ETHEME_FW')) exit('No direct script access allowed');
// **********************************************************************//
// ! Ititialize theme configuration and variables
// **********************************************************************//

add_action('wp_head', 'etheme_assets');
if(!function_exists('etheme_assets')) {
function etheme_assets() {
global $et_selectors;
$et_selectors = array();

$et_selectors['active_color'] = '
.active-color,
.cart-widget-products a:hover,
.star-rating span:before,
.price ins .amount,
.big-coast .amount,
.tabs .tab-title.opened,
.tabs .tab-title:hover,
.product-brands .view-products,
.shipping-calculator-button,
.views-count,
.post-comments-count,
.read-more,
span.active,
.active-link,
.active-link:hover,
ul.active > li:before,
.author-info .author-link,
.comment-reply-link,
.lost_password a,
.product-content .compare:hover:before,
.product-content .compare.added:before,
.footer-product .compare:hover:before,
.footer-product .compare.added:before,
.product-content .compare:hover,
.mobile-menu-wrapper .links li a:hover,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active>a,
.page-404 .largest,
.meta-post-timeline .time-mon,
.portfolio-filters .active,
.portfolio-item .firstLetter,
.tabs .accordion-title.opened-parent:after,
.item-design-mega-menu .nav-sublist-dropdown .item-level-1:hover > a,
.text-color-dark .category-grid .categories-mask span,
.header-standard .navbar-header .et-wishlist-widget .fa,
.team-member .member-details h5,
.team-member .member-content .menu-social-icons li:hover i,
.fixed-header .menu-wrapper .menu > li.current-menu-item > a,
.et-header-not-overlap.header-wrapper .menu-wrapper .menu > li.current-menu-item > a,
.sidebar-widget ul li > ul.children li > a:hover,
.product-information .out-of-stock,
.sidebar-widget li a:hover,
#etheme-popup .mfp-close:hover:before,
.etheme_widget_brands li a strong,
.widget_product_categories.sidebar-widget ul li.current-cat > a,
.shipping-calculator-button:focus,
table.cart .product-details a:hover,
.mobile-menu-wrapper .menu li a:hover,
.mobile-menu-wrapper .menu > li .sub-menu li a:hover,
.mobile-menu-wrapper .menu > li .sub-menu .menu-show-all a,
#review_form .stars a:hover:before, #review_form .stars a.active:before,
.item-design-mega-menu .nav-sublist-dropdown .nav-sublist li.current-menu-item a,
.item-design-dropdown .nav-sublist-dropdown ul > li.current-menu-item > a,
.mobile-menu-wrapper .mobile-sidebar-widget.etheme_widget_socials a:hover,
.mobile-sidebar-widget.etheme_widget_socials .et-follow-buttons.buttons-size-large a:hover,
.product-view-mask2.view-color-transparent .footer-product .button:hover:before, .product-view-mask2.view-color-transparent .show-quickly:hover:before,
.product-view-mask2.view-color-transparent .yith-wcwl-add-button a.add_to_wishlist:hover:before,
.product-view-default .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse.show a:before, .product-view-default .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse.show a:before,
.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse.show a:before, .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse.show a:before,
.product-view-mask2.view-color-transparent .yith-wcwl-wishlistexistsbrowse a:hover:before, .product-view-mask2.view-color-transparent .yith-wcwl-wishlistaddedbrowse a:hover:before,
.product-information .yith-wcwl-add-to-wishlist a:hover:before, .product-info-wrapper .yith-wcwl-add-to-wishlist a:hover:before, .product-summary-center .yith-wcwl-add-to-wishlist a:hover:before,
.widget_product_categories.sidebar-widget ul li a:hover,
.et-wishlist-widget .wishlist-dropdown li .product-title a:hover,
.woocommerce-MyAccount-navigation li.is-active a,
.wcpv-sold-by-single a,
.sb-infinite-scroll-load-more:not(.finished):hover,
.single-product-booking .product-side-information-inner .price .amount,
.product-view-booking .price .amount,
.product-view-booking .content-product .button.compare:hover,
.secondary-menu-wrapper .menu li:hover >a,
.secondary-menu-wrapper .nav-sublist-dropdown .menu-item-has-children .nav-sublist ul > li > a:hover,
.secondary-menu-wrapper .item-design-dropdown.menu-item-has-children ul .item-level-1 a:hover,
.product-information .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:not(.alt):before,
.header-wrapper.header-advanced .header-search.act-default div.fancy-select ul.options li:hover,
.mc4wp-alert.mc4wp-error,
.et-tabs-wrapper.title-hover .tabs-nav li a span,
.et-timer.product-sale-counter .time-block span,
.fullscreen-menu .menu > li > a:hover,
.slide-view-timeline2 .meta-post-timeline .time-day,
article.content-timeline2 .timeline-content .meta-post-timeline .time-day,
.content-grid2 .meta-post-timeline .time-day,
.menu-social-icons li a:hover,
body .team-member:hover .menu-social-icons i,
body .team-member:hover .menu-social-icons li i:hover,
.product-information .yith-wcwl-add-to-wishlist a:not(.alt):hover,
.summary-content .yith-wcwl-add-to-wishlist a:not(.alt):hover,
.product-view-booking .content-product .button.compare:hover:before

';

$et_selectors['active_bg'] = '
.tagcloud a:hover,
.button.active,
.btn.active,
.btn.active:hover,
.btn-checkout,
.btn-checkout:hover,
.btn-advanced,
.btn-underline:after,
input[type="submit"].btn-advanced,
.button:hover, .btn:hover, input[type="submit"]:hover,
.type-label-2,
.et-loader svg .outline,
.header-search.act-default #searchform .btn:hover,
.widget_product_categories .widget-title,
.price_slider_wrapper .ui-slider .ui-slider-handle,
.price_slider_wrapper .ui-slider-range,
.pagination-cubic ul li span.current,
.pagination-cubic ul li a:hover,
.view-switcher .switch-list:hover a,
.view-switcher .switch-grid:hover a,
.view-switcher .switch-list.switcher-active a,
.view-switcher .switch-grid.switcher-active a,

.tabs .tab-title.opened span:after,
.wpb_tabs .wpb_tabs_nav li a.opened span:after,
table.shop_table .remove-item:hover,
.et-tabs-wrapper .tabs-nav li:after,
.checkout-button,
.active-link:before,
.block-title .label,
.form-row.place-order input[type="submit"],
.wp-picture .post-categories,
.single-tags a:hover,
.portfolio-filters li a:after,
.form-submit input[type="submit"],
body .et-isotope-item .et-timer .time-block span,
.woocommerce table.wishlist_table .product-remove a:hover,
.vc_tta-color-grey.vc_tta-style-classic .vc_tta-tab.vc_active > a:after,
.vc_tta-style-classic .vc_tta-panel.vc_active .vc_tta-panel-heading a span:after,
.posts-nav-btn:hover .button,
.posts-nav-btn .post-info,
#cboxClose:hover,
.global-post-template-large .post-categories,
.global-post-template-large2 .post-categories,
.portfolio-item .portfolio-image,
.header-standard.header-color-dark .ico-design-1 .cart-bag,
.testimonials-slider .owl-buttons .owl-prev:hover, .testimonials-slider .owl-buttons .owl-next:hover,
.item-design-posts-subcategories .posts-content .post-preview-thumbnail .post-category,
.sidebar-slider .owl-carousel .owl-controls .owl-next:hover,
.sidebar-slider .owl-carousel .owl-controls .owl-prev:hover,
.ibox-block .ibox-symbol i,
ol.active > li:before,
span.dropcap.dark,
.fixed-header .menu-wrapper .menu > li.current-menu-item > a:after,
.etheme_widget_entries_tabs .tabs .tab-title:after,
.articles-pagination .current, .articles-pagination a:hover,
.product-information .yith-wcwl-add-to-wishlist a:hover:before,
.product-information .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a:before,
.product-information .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a:before,
.top-panel-container .menu-social-icons a:hover,
.wp-picture .blog-mask:before,
.main-images .owl-controls .owl-prev:hover,
.main-images .owl-controls .owl-next:hover,
.thumbnails-list .owl-controls .owl-next:hover,
.thumbnails-list .owl-controls .owl-prev:hover,
.portfolio-single-item .menu-social-icons a:hover i,
.flexslider .flex-direction-nav a:hover,
.back-top:hover,
.tagcloud a:hover,
.footer.text-color-light .tagcloud a:hover,
.widget_search button:hover,
.thumbnails-list .video-thumbnail span,
.carousel-area .owl-prev:hover,
.carousel-area .owl-next:hover,
.brands-carousel .owl-prev:hover, .owl-images-carousel .owl-prev:hover, .brands-carousel .owl-next:hover, .owl-images-carousel .owl-next:hover,
.post-gallery-slider .owl-controls .owl-buttons >div:hover,
.quantity.buttons_added span:hover,
.openswatch_widget_layered_nav ul li.chosen, .openswatch_widget_layered_nav ul li:hover,
ul.swatch li.selected,
.open-filters-btn a:hover,
.owl-carousel .owl-pagination .owl-page:hover, .owl-carousel .owl-pagination .owl-page.active,
.zoom-images-button:hover, .open-video-popup:hover, .open-360-popup:hover,
.et-products-navigation > div:hover,
.et-looks .et-looks-nav li.active a,
.et-looks .et-looks-nav li:hover a,
.quick-view-popup .mfp-close:hover,
.read-more:before,
.team-member .member-image:before,
#cookie-notice .button,
#cookie-notice .button.bootstrap,
#cookie-notice .button.wp-default,
#cookie-notice .button.wp-default:hover,
.mfp-image-holder .mfp-close:hover, .mfp-iframe-holder .mfp-close:hover,#product-video-popup .mfp-close:hover,
.et-products-navigation > div:hover .swiper-nav-arrow,
.product-view-default .footer-product .show-quickly,
.et-tabs-wrapper .tabs-nav li:after,
.et-tabs-wrapper .tabs .accordion-title:after,
div.pp_default .pp_content_container a.pp_next:hover, div.pp_default .pp_content_container a.pp_previous:hover,
.header-wrapper.header-advanced .header-search.act-default #searchform .btn,
.content-framed .content-article .read-more,
.l2d-body footer .coupon-code .cc-wrapper .closed-text,
.et-tabs-wrapper.title-hover .tabs-nav li:hover a span:hover, .et-tabs-wrapper.title-hover .tabs-nav li.et-opened a span:hover,
.et-tabs-wrapper.title-hover .tabs-nav .delimiter,
.header-simple .menu-wrapper .menu > li > a:after,
.global-header-simple .header-color-dark .cart-bag,
.header-simple .menu-wrapper .menu > li > a:hover:after,
.header-simple .menu-wrapper .menu > li.current-menu-item > a:after,
.team-member.member-type-2:hover .content-section,
.product-view-mask3 .footer-product .yith-wcwl-add-button a.add_to_wishlist, .product-view-mask3 .footer-product .yith-wcwl-wishlistexistsbrowse a, .product-view-mask3 .footer-product .yith-wcwl-wishlistaddedbrowse a,
.product-view-mask3 .footer-product .yith-wcwl-add-button a.add_to_wishlist.alt:hover,
.product-view-mask3 .footer-product .button,
.product-view-mask3 .footer-product .button:hover,
.product-view-mask3 .footer-product .show-quickly,
.product-view-mask3 .footer-product .compare,
.product-view-mask3 .content-product .footer-product .yith-wcwl-add-button a.add_to_wishlist,
.slide-view-timeline2:hover .meta-post-timeline,
.swiper-entry .swiper-custom-left:hover, .swiper-entry .swiper-custom-right:hover,
.et_post-slider .swiper-custom-right:hover, .et_post-slider .swiper-custom-left:hover,
.swiper-pagination .swiper-pagination-bullet-active,
article.content-timeline2:hover .meta-post-timeline
.content-grid2:hover .meta-post-timeline,
.swiper-slide #loader-1 span,
article.content-timeline2:hover .meta-post-timeline,
.content-grid2:hover .meta-post-timeline,
.header-wrapper .et-wishlist-widget .wishlist-count, 
.header-wrapper .navbar-header .et-wishlist-widget .wishlist-count,
.shopping-container .cart-bag .badge-number,
.fixed-header .navbar-header .et-wishlist-widget .wishlist-count,
.shopping-container.ico-design-1.ico-bg-yes .badge-number,
.top-bar .shopping-container:not(.ico-design-1) .cart-bag .badge-number

';

$et_selectors['active_border'] = '
.tagcloud a:hover,
.button.active,
.btn.active,
.btn.active:hover,
.btn-checkout,
.btn-checkout:hover,
.btn-advanced,
input[type="submit"].btn-advanced,
.button:hover, input[type="submit"]:hover, .btn:hover,
.form-row.place-order input[type="submit"],
.pagination-cubic ul li span.current,
.pagination-cubic ul li a:hover,
.form-submit input[type="submit"],
.fixed-header,
.single-product-center .quantity.buttons_added span:hover,
.header-standard.header-color-dark .cart-bag:before,
.articles-pagination .current, .articles-pagination a:hover,
.widget_search button:hover,
table.cart .remove-item:hover,
.checkout-button,
.openswatch_widget_layered_nav ul li.chosen,
.openswatch_widget_layered_nav ul li:hover,
.open-filters-btn a:hover,
.header-standard.header-color-dark .cart-bag,
.header-standard.header-color-dark .cart-summ:hover .cart-bag,
.header-standard .header-standard.header-color-dark,
.header-standard .shopping-container.ico-design-1.ico-bg-yes .cart-bag:before,
.header-standard .shopping-container .cart-summ:hover .cart-bag:before,
.header-standard .shopping-container.ico-design-1.ico-bg-yes .cart-bag,
.et-tabs-wrapper .tabs-nav li.et-opened:before,
.et-tabs-wrapper .tabs .accordion-title.opened:before,
.secondary-menu-wrapper .menu,
.secondary-menu-wrapper .menu li.menu-item-has-children > .nav-sublist-dropdown,
.header-wrapper.header-advanced .secondary-title,
.secondary-menu-wrapper .item-design-dropdown .nav-sublist-dropdown ul > li.menu-item-has-children:hover > .nav-sublist ul,
.quantity.buttons_added span:hover,
.et-offer,
.et-tabs-wrapper.title-hover .tabs-nav li a span,
.global-header-simple .header-color-dark .cart-bag,
.global-header-simple .header-color-dark .cart-bag:before,
.global-header-simple .header-color-dark .cart-summ:hover .cart-bag,
.global-header-simple .header-color-dark .cart-summ:hover .cart-bag:before,
.team-member.member-type-2:hover .content-section:before,
.slide-view-timeline2 .meta-post-timeline,
article.content-timeline2 .timeline-content .meta-post-timeline,
.content-grid2 .meta-post-timeline,
.content-grid2:hover .meta-post-timeline
';

$et_selectors['active_stroke'] = '
.et-loader svg .outline,
.et-timer.dark .time-block .circle-box svg circle
';

?>

<?php
$activeColor = (etheme_get_option('activecol')) ? etheme_get_option('activecol') : '#8a8a8a';
$post_id = etheme_get_page_id();

$light_buttons_radius = etheme_get_option('light_buttons_border_radius');
$dark_buttons_radius = etheme_get_option('dark_buttons_border_radius');
$active_buttons_radius = etheme_get_option('active_buttons_border_radius');
if ( $light_buttons_radius ) {
	$light_buttons_radius = $light_buttons_radius['border-top'] . ' ' . $light_buttons_radius['border-right'] . ' ' . $light_buttons_radius['border-left'] . ' ' . $light_buttons_radius['border-bottom'];
}
if ( $dark_buttons_radius ) {
	$dark_buttons_radius = $dark_buttons_radius['border-top'] . ' ' . $dark_buttons_radius['border-right'] . ' ' . $dark_buttons_radius['border-left'] . ' ' . $dark_buttons_radius['border-bottom'];
}
if ( $active_buttons_radius ) {
	$active_buttons_radius = $active_buttons_radius['border-top'] . ' ' . $active_buttons_radius['border-right'] . ' ' . $active_buttons_radius['border-left'] . ' ' . $active_buttons_radius['border-bottom'];
}
$menu_links_border_radius = etheme_get_option('menu-links-border-radius');
if ( $menu_links_border_radius ) {
	$menu_links_border_radius = $menu_links_border_radius['border-top'] . ' ' . $menu_links_border_radius['border-right'] . ' ' . $menu_links_border_radius['border-left'] . ' ' . $menu_links_border_radius['border-bottom'];
}
$menu_links_border_style_o = etheme_get_option('menu-border-style');
$menu_links_border_style = !empty($menu_links_border_style_o['border-style']) ? $menu_links_border_style_o['border-style'] : '';

$menu_links_border_style_o = etheme_get_option('menu-border-style-hover');
$menu_links_border_style_hover = !empty($menu_links_border_style_o['border-style']) ? $menu_links_border_style_o['border-style'] : '';

$menu_dr_border_style_o = etheme_get_option('menu_dropdown_border_style');
$menu_dropdown_border_style = !empty($menu_dr_border_style_o['border-style']) ? $menu_dr_border_style_o['border-style'] : '';

$f_menu_links_border_style_o = etheme_get_option('f_menu-border-style');
$f_menu_links_border_style = !empty($f_menu_links_border_style_o['border-style']) ? $f_menu_links_border_style_o['border-style'] : '' ;

$f_menu_links_border_style_hover_o = etheme_get_option('f_menu-border-style-hover');
$f_menu_links_border_style_hover = !empty($f_menu_links_border_style_hover_o['border-style']) ? $f_menu_links_border_style_hover_o['border-style'] : '';

$header_bg = etheme_get_custom_field('header_bg', $post_id['id']);
$header_bg_transparent = etheme_get_custom_field('header_transparent', $post_id['id']);
if ( $header_bg_transparent ) {
	$header_bg = 'transparent';
}
$header_padding = etheme_get_option('header_padding');
if ( !empty($header_padding) ) {
	$header_padding = $header_padding['padding-top'] . ' ' . $header_padding['padding-right'] . ' ' . $header_padding['padding-bottom'] . ' ' . $header_padding['padding-left'];
}
$header_margin_bottom = etheme_get_option('header_margin_bottom');
$sale_zise = etheme_get_option('sale_icon_size');
$sale_zise = explode( 'x', $sale_zise );

if ( ! isset( $sale_zise[0] ) ) $sale_zise[0] = 3.75;
if ( ! isset( $sale_zise[1] ) ) $sale_zise[1] = $sale_zise[0];

$preloader = etheme_get_option( 'preloader_img' );

$keyframes = array();
$keyframes['swiper-loader'] = '
	@-webkit-keyframes scale {
		0% {
		-webkit-transform: scale(0);
		        transform: scale(0);
		}
		25% {
		-webkit-transform: scale(0.9, 0.9);
		        transform: scale(0.9, 0.9);
		background: ' . $activeColor . ';
		}
		50% {
		-webkit-transform: scale(1, 1);
		        transform: scale(1, 1);
		margin: 0 3px;
		background: ' . $activeColor . ';
		}
		100% {
		-webkit-transform: scale(0);
		        transform: scale(0);
		}
		}
		@keyframes scale {
		0% {
		-webkit-transform: scale(0);
		        transform: scale(0);
		}
		25% {
		-webkit-transform: scale(0.9, 0.9);
		        transform: scale(0.9, 0.9);
		background: ' . $activeColor . ';
		}
		50% {
		-webkit-transform: scale(1, 1);
		        transform: scale(1, 1);
		margin: 0 3px;
		background: ' . $activeColor . ';
		}
		100% {
		-webkit-transform: scale(0);
		        transform: scale(0);
		}
	}
';

$fonts = get_option( 'etheme-fonts', false );
$style = '';
if ( $fonts ) {
    foreach ( $fonts as $value ) {
    	// ! Validate format
        switch ( $value['file']['extension'] ) {
            case 'ttf':
                $format = 'truetype';
                break;
            case 'otf':
                $format = 'opentype';
                break;
            case 'eot':
                $format = false;
                break;
            case 'eot?#iefix':
                $format = 'embedded-opentype';
                break;
            case 'woff2':
                $format = 'woff2';
                break;
            case 'woff':
                $format = 'woff';
                break;
            default:
                $format = false;
                break;
        }

        $format = ( $format ) ? 'format("' . $format . '")' : '';

        // ! Set fonts
        $style .= '
            @font-face {
                font-family: ' . $value['name'] . ';
                src: url(' . $value['file']['url'] . ') ' . $format . ';
            }
        ';
    }
}

?>

<style type="text/css">
    <?php echo etheme_js2tring($et_selectors['active_color']); ?>              { color: <?php echo $activeColor; ?>; }
    <?php echo etheme_js2tring($et_selectors['active_bg']); ?>                 { background-color: <?php echo $activeColor; ?>; }
    <?php echo etheme_js2tring($et_selectors['active_border']); ?>             { border-color: <?php echo $activeColor; ?>; }
    <?php echo etheme_js2tring($et_selectors['active_stroke']); ?>             { stroke: <?php echo $activeColor; ?>; }
	
	.onsale, .product-images .sale-value{
		color: <?php echo etheme_get_option('sale_icon_color'); ?>;
		background-color: <?php echo etheme_get_option('sale_icon_bg_color'); ?>;
		border-radius: <?php echo etheme_get_option('sale_br_radius'); ?>%;
		width: <?php echo $sale_zise[0]; ?>em;
	    height: <?php echo $sale_zise[1]; ?>em;
	    line-height: <?php echo $sale_zise[1]; ?>em;
	}

	<?php if ( ! empty( $preloader ) ) echo $keyframes['swiper-loader']; ?>

	.et-header-full-width .main-header .container,
	.et-header-full-width .navigation-wrapper .container,
	.et-header-full-width .fixed-header .container {
		max-width: <?php etheme_option('header_width'); ?>px;
	}

	@media (min-width: 1200px){
		.container {
			width: <?php etheme_option('site_width'); ?>px;
		}

		.boxed .template-container, .framed .template-container{
			width: calc( <?php etheme_option('site_width'); ?>px + 30px );
		}

		.boxed .header-wrapper, .framed .header-wrapper{
			width: calc( <?php etheme_option('site_width'); ?>px + 30px );
		}
	}

	<?php if( ! empty( $header_bg) ): ?>
		.main-header {
			background-color: <?php echo $header_bg; ?> !important;
		}
	<?php endif; ?>
	<?php if ( ! empty($light_buttons_radius) ) : ?>
		input[type="submit"], .open-filters-btn .btn, .content-product .product-details .button, .woocommerce table.wishlist_table td.product-add-to-cart a, .woocommerce-Button {
			border-radius: <?php echo $light_buttons_radius; ?> !important;
		}
	<?php endif; ?>
	<?php if ( ! empty( $dark_buttons_radius ) ) : ?>
	.et-wishlist-widget .wishlist-dropdown .buttons .btn-view-wishlist, .checkout-button, .single_add_to_cart_button, .shopping-container .btn-view-cart, .before-checkout-form .button, 
	form.login .button, form.register .button, .price_slider_wrapper .button, .empty-cart-block .btn {
		border-radius: <?php echo $dark_buttons_radius; ?>;
	}

	<?php endif; ?>
	<?php if ( ! empty($active_buttons_radius) ) : ?>
		.btn-checkout, .form-submit input[type=submit], .form-row.place-order input[type=submit] {
			border-radius: <?php echo $active_buttons_radius; ?>;
		}
	<?php endif; ?>
	<?php if ( ! empty($menu_links_border_radius) ) : ?>
		.menu-wrapper .menu > li, .secondary-title, .fullscreen-menu .menu > li, .fullscreen-menu .menu > li, .header-wrapper.header-advanced .menu-wrapper .menu > li {
			border-radius: <?php echo $menu_links_border_radius; ?>;
		}
	<?php endif; ?>
	<?php if ( !empty($menu_links_border_style) ): ?> 
		.menu-wrapper .menu > li, .secondary-title, .fullscreen-menu .menu > li, .fullscreen-menu .menu > li, .header-wrapper.header-advanced .menu-wrapper .menu > li {
			border-style: <?php echo $menu_links_border_style; ?> !important;
		}
	<?php endif; ?>
	<?php if ( !empty($menu_dropdown_border_style) ) : ?>
		.nav-sublist-dropdown {
			border-style: <?php echo $menu_dropdown_border_style; ?>;
		}
	<?php endif; ?>

	<?php if ( ! empty($f_menu_links_border_radius) ) : ?>
		.fixed-header .menu-wrapper .menu > li {
			border-radius: <?php echo $f_menu_links_border_radius; ?>;
		}
	<?php endif; ?>
	<?php if ( !empty($f_menu_links_border_style) ): ?> 
		.fixed-header .menu-wrapper .menu > li {
			border-style: <?php echo $f_menu_links_border_style; ?> !important;
		}
	<?php endif; ?>

	<?php if ( ! empty( $header_padding ) ) : ?>
		@media only screen and (min-width: 992px) {
			.header-wrapper header > .container .container-wrapper, 
			.header-smart-responsive .header-wrapper header > .container .container-wrapper,
			.header-wrapper.header-two-rows .header-top .container-top-wrapper {
				padding: <?php echo $header_padding; ?>
			}
		}
	<?php endif; ?>
	<?php if ( ! empty($header_margin_bottom) ) : ?>
		.breadcrumbs-type-disable.et-header-not-overlap:not(.home) .header-wrapper {
			margin-bottom: <?php echo $header_margin_bottom . 'px'; ?>
		}
	<?php endif; ?>
	<?php echo $style; ?>
</style>
<?php
}
}