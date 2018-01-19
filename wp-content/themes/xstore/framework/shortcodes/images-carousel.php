<?php  if ( ! defined('ETHEME_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Images Carousel
// **********************************************************************// 

function vc_theme_vc_images_carousel($atts, $content) {
	ob_start();
	$output = $title = $onclick = $custom_links = $img_size = $custom_links_target = $images = $el_class = $partial_view = '';
	$mode = $slides_per_view = $wrap = $autoplay = $hide_pagination_control = $hide_prev_next_buttons = $speed = '';
	extract( shortcode_atts( array(
		'title' => '',
		'onclick' => 'link_image',
		'custom_links' => '',
		'custom_links_target' => '',
		'img_size' => 'thumbnail',
		'images' => '',
		'el_class' => '',
		'mode' => 'horizontal',
		'slides_per_view' => '1',
		'wrap' => '',
		'autoplay' => '',
		'hide_pagination_control' => '',
		'hide_prev_next_buttons' => '',
		'speed' => '5000',
		'partial_view' => ''
	), $atts ) );
	$gal_images = '';
	$link_start = '';
	$link_end = '';
	$el_start = '';
	$el_end = '';
	$slides_wrap_start = '';
	$slides_wrap_end = '';
	$pretty_rand = $onclick == 'link_image' ? rand() : '';
	
	if ( $images == '' ) $images = '-1,-2,-3';
	if ( ! isset( $atts['css'] ) ) $atts['css'] = '';
	
	if ( 'custom_link' === $onclick ) {
		$custom_links = vc_value_from_safe( $custom_links );
		$custom_links = explode( ',', $custom_links );
	}

	$images = explode( ',', $images );
	$i = - 1;
	$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_images_carousel wpb_content_element' . $atts['css'] . vc_shortcode_custom_css_class( $el_class, ' ' ) . ' vc_clearfix', 'vc_images_carousel', $atts );
	$carousel_id = rand(1000,9999);
	?>
	<div class="swiper-entry <?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $css_class, 'vc_images_carousel', $atts ) ?>">
		<div class="swiper-container" id="carousel-<?php echo $carousel_id ?>" data-breakpoints="1" data-xs-slides="2" data-sm-slides="3" data-md-slides="4" data-lt-slides="<?php echo esc_js($slides_per_view) ?>" data-slides-per-view="<?php echo esc_attr($slides_per_view); ?>" data-autoplay="<?php echo esc_attr($speed); ?>" data-loop="<?php echo esc_attr($wrap);?>">
			<!-- Wrapper for slides -->
			<div class="swiper-wrapper swiper-images-carousel">
				<?php foreach ( $images as $attach_id ): ?>
					<?php
					$i ++;
					if ( $attach_id > 0 ) {
						$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ) );
					} else {
						$post_thumbnail = array();
						$post_thumbnail['thumbnail'] = '<img src="' . vc_asset_url( 'vc/no_image.png' ) . '" />';
						$post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
					}
					$thumbnail = $post_thumbnail['thumbnail'];
					?>
					<div class="swiper-slide">
						<?php if ( $onclick == 'link_image' ): ?>
						<?php $p_img_large = $post_thumbnail['p_img_large']; ?>
							<a class="magnific"
							   href="<?php echo $p_img_large[0] ?>" <?php echo ' rel="magnific[rel-' . $pretty_rand . ']"' ?>>
								<?php echo $thumbnail ?>
							</a>
						<?php elseif ( $onclick == 'custom_link' && isset( $custom_links[$i] ) && $custom_links[$i] != '' ): ?>
							<a
							  href="<?php echo $custom_links[$i] ?>"<?php echo ( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ) ?>>
								<?php echo $thumbnail ?>
							</a>
						<?php else: ?>
							<?php echo $thumbnail ?>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
            <?php
            if (!$hide_pagination_control){
            echo '<div class="swiper-pagination"></div>';
            }
            echo '</div>';
            if (!$hide_prev_next_buttons) {
            echo '
                <div class="swiper-custom-left"></div>
                <div class="swiper-custom-right"></div>
            ';
            } ?>
		</div>
	</div>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $("#carousel-<?php echo $carousel_id ?> a.magnific").magnificPopup({
		        type:"image",
		        gallery:{
		            enabled:true
		        }
		    });
		});
	</script>
<?php
	return ob_get_clean();
}

// **********************************************************************// 
// ! Chane Element: Images Carousel
// **********************************************************************//
add_action( 'init', 'etheme_register_vc_images_carousel');
if(!function_exists('etheme_register_vc_images_carousel')) {
	function etheme_register_vc_images_carousel() {
		if(!function_exists('vc_map')) return;
		vc_remove_param( 'vc_images_carousel', 'mode' );
		vc_remove_param( 'vc_images_carousel', 'partial_view' );
	}
}
