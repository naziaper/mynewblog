<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$posts_per_page = etheme_get_option('related_limit');

// updated for woocommerce v3.0
$related = array_map( 'absint', array_values( wc_get_related_products( $product->get_id(), $posts_per_page ) ) );

if ( sizeof( $related ) == 0 ) return;

echo '<h2 class="products-title"><span>' . esc_html__( 'Related Products', 'xstore' ) . '</span></h2>';

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->get_id() )
) );

$slider_args = array(
	'slider_autoplay' => false,
	'slider_speed' => false,
);

etheme_create_slider( $args, $slider_args );

wp_reset_postdata();
