<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');
// **********************************************************************//
// ! Page heading
// **********************************************************************//
if(!function_exists('etheme_page_heading')) {

	add_action('etheme_page_heading', 'etheme_page_heading', 10);

	function etheme_page_heading() {

		$l = etheme_page_config();

		if ($l['breadcrumb'] !== 'disable' && !$l['slider']): ?>

			<div class="page-heading bc-type-<?php echo esc_attr( $l['breadcrumb'] ); ?> bc-effect-<?php echo esc_attr( $l['bc_effect'] ); ?> bc-color-<?php echo esc_attr( $l['bc_color'] ); ?> bc-size-<?php echo esc_attr( $l['bc_size'] ); ?>">
				<div class="container">
					<div class="row">
						<div class="col-md-12 a-center">
							<?php etheme_breadcrumbs(); ?>
							<h1 class="title"><span><?php echo etheme_get_the_title(); ?></span></h1>
						</div>
					</div>
				</div>
			</div>

		<?php endif;

		if($l['slider']): ?>
			<div class="page-heading-slider">
				<?php echo do_shortcode('[rev_slider_vc alias="'.$l['slider'].'"]'); ?>
			</div>
		<?php endif;
	}
}

// **********************************************************************//
// ! Get logo
// **********************************************************************//
if (!function_exists('etheme_logo')) {
    function etheme_logo($fixed_header = false) {
    	$logo = etheme_get_logo_data();
    	?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo $logo['logo']['src']; ?>" alt="<?php echo $logo['logo']['alt']; ?>" width="<?php echo $logo['logo']['width']; ?>" height="<?php echo $logo['logo']['height']; ?>" class="logo-default" />
            	<img src="<?php echo $logo['fixed_logo']['src']; ?>" alt="<?php echo $logo['fixed_logo']['alt']; ?>" width="<?php echo $logo['fixed_logo']['width']; ?>" height="<?php echo $logo['fixed_logo']['height']; ?>" class="logo-fixed" />
            </a>
        <?php
        do_action('etheme_after_logo');
    }
}


// **********************************************************************//
// ! Get top links
// **********************************************************************//
if(!function_exists('etheme_top_links')) {
    function etheme_top_links($args = array()) {

    $links = etheme_get_links($args);
    if( ! empty($links)) :
        ?>
        <ul class="links">
            <?php foreach ($links as $link): ?>

                <?php

					$submenu = '';

					if( isset( $link['submenu'] ) ) {
						$submenu = $link['submenu'];
					}

					printf(
                        '<li class="%s"><a href="%s" class="%s">%s</a>%s</li>',
                        $link['class'],
                        $link['href'],
                        $link['link_class'],
                        $link['title'],
						$submenu
                    );
                ?>
            <?php endforeach ?>

        </ul>
    <?php endif;

    }
}


// **********************************************************************//
// ! Post content image
// **********************************************************************//

if(! function_exists('etheme_post_thumb')) {
	function etheme_post_thumb($args = array() ) {
		global $et_loop;

		$defaults = array(
			'size' => 'large',
			'in_slider' => false,
			'link' => true,
		);

		$args = wp_parse_args( $args, $defaults );

		$hover = etheme_get_option('blog_hover');
		$post_format 	= get_post_format();
	    $post_content 	= get_the_content();
	    $gallery_filter = etheme_gallery_from_content( $post_content );
    	$slider_id 		= rand(100,10000);
    	$layout = etheme_get_option( 'blog_layout' );
		$gallery = array( 'default', 'center', 'timeline', 'framed', 'with-author' );

		if( ! empty( $et_loop['blog_hover'] ) ) {
			$hover = $et_loop['blog_hover'];
		}

		?>
		<?php if($post_format == 'gallery' && ! $args['in_slider']): ?>
            <?php if(count($gallery_filter['ids']) > 0): ?>
                <div class="<?php if ( ! in_array( $layout, $gallery ) && ! is_single() ) echo 'swiper-entry '; ?> et_post-slider">
	                <div class="swiper-container slider_id-<?php echo $slider_id; ?>" data-autoheight="1">
	                    <div class="swiper-wrapper">
	                        <?php foreach($gallery_filter['ids'] as $attach_id): ?>
	                            <div class="swiper-slide">
	                                <?php echo etheme_get_image($attach_id, $args['size'] ); ?>
	                            </div>
	                        <?php endforeach; ?>
	                    </div>
	                    <div class="swiper-pagination"></div>
	                </div>
	                <div class="swiper-custom-left"></div>
	                <div class="swiper-custom-right"></div>
	            </div>
            <?php endif; ?>
		<?php elseif($post_format == 'video' && etheme_has_post_video()): ?>

			<div class="featured-video">
				<?php etheme_the_post_video(); ?>
			</div>

		<?php elseif($post_format == 'audio' && etheme_has_post_audio()): ?>

			<div class="featured-audio">
				<?php etheme_the_post_audio(); ?>
			</div>

		<?php elseif(has_post_thumbnail()): ?>
			<div class="wp-picture blog-hover-<?php echo esc_attr( $hover ); ?>">
				<?php if ( $args['link']): ?>
					<a href="<?php the_permalink(); ?>">
						<?php echo etheme_get_image( get_post_thumbnail_id(), $args['size'] ); ?>
					</a>
				<?php else: ?>
					<?php echo etheme_get_image( get_post_thumbnail_id(), $args['size'] ); ?>
				<?php endif ?>

	            <div class="post-categories"><?php etheme_get_primary_category(); ?></div>

	            <?php if ( ! is_single() || $args['in_slider'] ): ?>
	            	<div class="blog-mask">
	            		<div class="blog-mask-inner">
							<div class="svg-wrapper">
								<svg height="40" width="150" xmlns="http://www.w3.org/2000/svg">
									<rect class="shape" height="40" width="150" />
								</svg>
								<a href="<?php the_permalink(); ?>" class="btn btn-read-more"><?php esc_html_e('Read more', 'xstore'); ?></a>
							</div>
	            		</div>
	            	</div>
	            <?php endif ?>

                <?php if($post_format == 'quote'): ?>
                    <div class="featured-quote">
                        <div class="quote-content">
                            <?php etheme_the_post_quote( get_the_ID() ); ?>
                        </div>
                    </div>
                <?php endif; ?>
			</div>
		<?php endif; ?>
		<?php
	}
}

// **********************************************************************//
// ! Meta data block (byline)
// **********************************************************************//
if(!function_exists('etheme_byline')) {
	function etheme_byline($atts = array() ) {
        extract( shortcode_atts( array(
            'author' => 0,
            'time' => 0,
            'slide_view' => 0,
        ), $atts ) );
        if(!etheme_get_option('blog_byline')) return '';
        $views = etheme_get_views();
        $comment_link_template = '<span>%s</span> <span>%s</span>';
        $blog_layout = etheme_get_option('blog_layout');

		?>
            <div class="meta-post">
    	        <?php if(etheme_get_option('blog_byline') && ! in_array( $blog_layout , array( 'timeline', 'timeline2', 'grid2' ) ) && $slide_view !== 'timeline2' ): ?>
					<time class="entry-date published updated" datetime="<?php the_time('F j, Y'); ?>"><?php the_time(get_option('date_format')); ?></time>
                    <?php if ( $time ): ?>
						<?php esc_html_e('at', 'xstore');?>
						<?php the_time(get_option('time_format')); ?>
                    <?php endif ?>
                    <?php if ( $author ): ?>
                        <?php esc_html_e('by', 'xstore');?> <?php the_author_posts_link(); ?>
                    <?php endif ?>
                     <span class="meta-divider">/</span>
                    <?php if (etheme_get_option('views_counter')): ?>
                        <span class="views-count"><?php echo  $views; ?></span>
                     <?php endif ?>
                    <?php // Display Comments
                        if(comments_open() && !post_password_required()) {
                        	?><span class="meta-divider">/</span><?php
                            comments_popup_link(
                                sprintf( $comment_link_template, '0', esc_html__( 'comments', 'xstore' ) ),
                                sprintf( $comment_link_template, '1', esc_html__( 'comment', 'xstore' ) ),
                                sprintf( $comment_link_template, '%', esc_html__( 'comments', 'xstore' ) ),
                                'post-comments-count'
                            );
                        }
                     ?>
    	        <?php elseif(etheme_get_option('blog_byline') && ( in_array( $blog_layout , array( 'timeline', 'timeline2', 'grid2' ) ) || $slide_view == 'timeline2' ) ): ?>
                    <?php esc_html_e('Posted by', 'xstore');?> <?php the_author_posts_link(); ?>
                     <span class="meta-divider">/</span>
                     <?php if (etheme_get_option('views_counter')): ?>
                        <span class="views-count"><?php echo  $views; ?></span>
                     <?php endif ?>
                    <?php // Display Comments
                        if(comments_open() && !post_password_required()) {
                        	?><span class="meta-divider">/</span> <?php
							comments_popup_link(
								sprintf( $comment_link_template, '0', esc_html__( 'comments', 'xstore' ) ),
								sprintf( $comment_link_template, '1', esc_html__( 'comment', 'xstore' ) ),
								sprintf( $comment_link_template, '%', esc_html__( 'comments', 'xstore' ) ),
                                'post-comments-count'
							);
                        }
                     ?>
    	        <?php endif; ?>
            </div>
        <?php
	}
}

// **********************************************************************//
// ! ET loader HTML
// **********************************************************************//
if (!function_exists('etheme_loader')) {
	function etheme_loader() {
		?>

		<?php $img = etheme_get_option( 'preloader_img' ); ?>

		<div class="et-loader">
			<?php if ( ! empty( $img['url'] ) ) : ?>
				<img class="et-loader-img" src="<?php echo $img['url']; ?>" alt="et-loader">
			<?php else : ?>
				<svg viewBox="0 0 187.3 93.7" preserveAspectRatio="xMidYMid meet">
					<path stroke="#ededed" class="outline" fill="none" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1 c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" />
					<path class="outline-bg" opacity="0.05" fill="none" stroke="#ededed" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M93.9,46.4c9.3,9.5,13.8,17.9,23.5,17.9s17.5-7.8,17.5-17.5s-7.8-17.6-17.5-17.5c-9.7,0.1-13.3,7.2-22.1,17.1c-8.9,8.8-15.7,17.9-25.4,17.9s-17.5-7.8-17.5-17.5s7.8-17.5,17.5-17.5S86.2,38.6,93.9,46.4z" />
				</svg>
			<?php endif; ?>
		</div>
		<?php
	}
}

add_action( 'et_after_body', 'etheme_loader', 100);


// **********************************************************************//
// ! Show main navigation
// **********************************************************************//

if(!function_exists('etheme_get_main_menu')) {
	function etheme_get_main_menu($menu_id = 'main-menu') {
		$custom_menu = etheme_get_custom_field('custom_nav');
        $one_page_menu = '';
        if(etheme_get_custom_field('one_page')) $one_page_menu = ' one-page-menu';
        if(!empty($custom_menu) && $custom_menu != '') {
            $output = false;
            $output = wp_cache_get( $custom_menu, 'etheme_get_main_menu' . $menu_id );
            if ( !$output ) {
                ob_start();

                wp_nav_menu(array(
                    'menu' => $custom_menu,
                    'before' => '',
                    'container_class' => 'menu-main-container'.$one_page_menu,
                    'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'depth' => 100,
                    'fallback_cb' => false,
                    'walker' => new ETheme_Navigation
                ));

                $output = ob_get_contents();
                ob_end_clean();

                wp_cache_add( $custom_menu, $output, 'etheme_get_main_menu' . $menu_id );
            }

            echo $output;
            return;
        }
		if ( has_nav_menu( $menu_id ) ) {
	    	$output = false;
	    	$output = wp_cache_get( $menu_id, 'etheme_get_main_menu' . $menu_id );
		    if ( !$output ) {
			    ob_start();

		    	wp_nav_menu(array(
					'theme_location' => $menu_id,
					'before' => '',
					'container_class' => 'menu-main-container',
					'after' => '',
					'link_before' => '',
					'link_after' => '',
					'depth' => 100,
					'fallback_cb' => false,
					'walker' => new ETheme_Navigation
				));

				$output = ob_get_contents();
				ob_end_clean();

		        wp_cache_add( $menu_id, $output, 'etheme_get_main_menu' . $menu_id );
		    }

	        echo $output;
		} else {
			printf( '<br><h4 class="a-center">%s <em>%s</em></h4>', esc_html__( 'Set your main menu in', 'xstore' ), esc_html__( 'Appearance &gt; Menus', 'xstore' ) );
		}
	}
}


// **********************************************************************//
// ! Show main navigation (right)
// **********************************************************************//

if(!function_exists('etheme_get_main_menu_right')) {
	function etheme_get_main_menu_right($menu_id = 'main-menu-right') {
		$custom_menu = etheme_get_custom_field('custom_nav_right');
        $one_page_menu = '';
        if(etheme_get_custom_field('one_page')) $one_page_menu = ' one-page-menu';
        if(!empty($custom_menu) && $custom_menu != '') {
            $output = false;
            $output = wp_cache_get( $custom_menu, 'etheme_get_main_menu_right' );
            if ( !$output ) {
                ob_start();

                wp_nav_menu(array(
                    'menu' => $custom_menu,
                    'before' => '',
                    'container_class' => 'menu-main-container'.$one_page_menu,
                    'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'depth' => 100,
                    'fallback_cb' => false,
                    'walker' => new ETheme_Navigation
                ));

                $output = ob_get_contents();
                ob_end_clean();

                wp_cache_add( $custom_menu, $output, 'etheme_get_main_menu_right' );
            }

            echo $output;
            return;
        }
		if ( has_nav_menu( $menu_id ) ) {
	    	$output = false;
	    	$output = wp_cache_get( $menu_id, 'etheme_get_main_menu_right' );
		    if ( !$output ) {
			    ob_start();

		    	wp_nav_menu(array(
					'theme_location' => $menu_id,
					'before' => '',
					'container_class' => 'menu-main-container',
					'after' => '',
					'link_before' => '',
					'link_after' => '',
					'depth' => 100,
					'fallback_cb' => false,
					'walker' => new ETheme_Navigation
				));

				$output = ob_get_contents();
				ob_end_clean();

		        wp_cache_add( $menu_id, $output, 'etheme_get_main_menu_right' );
		    }

	        echo $output;
		} else {
			printf( '<br><h4 class="a-center">%s <em>%s</em></h4>', esc_html__( 'Set your main menu in', 'xstore' ), esc_html__( 'Appearance &gt; Menus', 'xstore' ) );
		}
	}
}


if(!function_exists('etheme_get_mobile_menu')) {
	function etheme_get_mobile_menu($menu_id = 'mobile-menu') {

        $custom_menu = etheme_get_custom_field('custom_nav_mobile');
        $one_page_menu = '';
        if(etheme_get_custom_field('one_page')) $one_page_menu = ' one-page-menu';

        if(!empty($custom_menu) && $custom_menu != '') {
            $output = false;
            $output = wp_cache_get( $custom_menu, 'etheme_get_mobile_menu' );
            if ( !$output ) {
                ob_start();

                wp_nav_menu(array(
                    'menu' => $custom_menu,
                    'before' => '',
                    'container_class' => 'menu-mobile-container'.$one_page_menu,
                    'after' => '',
                    'link_before' => '',
                    'link_after' => '',
                    'depth' => 4,
                    'fallback_cb' => false,
                    'walker' => new ETheme_Navigation_Mobile
                ));

                $output = ob_get_contents();
                ob_end_clean();

                wp_cache_add( $custom_menu, $output, 'etheme_get_mobile_menu' );
            }

            echo $output;
            return;
        }

		if ( has_nav_menu( $menu_id ) ) {
	    	$output = false;
	    	$output = wp_cache_get( $menu_id, 'etheme_get_mobile_menu' );

		    if ( !$output ) {
			    ob_start();

				wp_nav_menu(array(
                    'container_class' => $one_page_menu,
					'theme_location' => 'mobile-menu',
                    'walker' => new ETheme_Navigation_Mobile
				));

				$output = ob_get_contents();
				ob_end_clean();

		        wp_cache_add( $menu_id, $output, 'etheme_get_mobile_menu' );
		    }

	        echo $output;
		} else {
			printf( '<br><h4 class="a-center">%s <em>%s</em></h4>', esc_html__( 'Set your main menu in', 'xstore' ), esc_html__( 'Appearance &gt; Menus', 'xstore' ) );
		}
	}
}




// **********************************************************************// 
// ! Pagination links
// **********************************************************************// 

if(!function_exists('etheme_pagination')) {
	function etheme_pagination($wp_query, $paged, $pages = '', $range = 2) {
	     $showitems = ($range * 2)+1;  

	     if(empty($paged)) $paged = 1;

	     if($pages == '')
	     {
	         $pages = $wp_query->max_num_pages;
	         if(!$pages)
	         {
	             $pages = 1;
	         }
	     }   

	     if(1 != $pages)
	     {
	         echo "<nav class='pagination-cubic'>";
		         echo '<ul class="page-numbers">';
			         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."' class='prev page-numbers'><i class='fa fa-angle-double-left'></i></a></li>";
			
			         for ($i=1; $i <= $pages; $i++)
			         {
			             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			             {
			                 echo ($paged == $i)? "<li><span class='page-numbers current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
			             }
			         }
			
			         if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."' class='next page-numbers'><i class='fa fa-angle-double-right'></i></a></li>";
		         echo '</ul>';
	         echo "</nav>\n";
	     }
	}
}

// **********************************************************************//
// ! Show Search form
// **********************************************************************//
if(!function_exists('etheme_search_form')) {
    function etheme_search_form( $args = array() ) {
    	extract( wp_parse_args( $args, array(
    		'action' => 'full-width'
    	) ));

    	$class = '';
    	$class = ' act-' . $action;
        ?>
            <div class="header-search<?php echo esc_attr( $class ); ?>">
                <a href="#" class="search-btn"><i class="fa fa-search"></i> <span><?php esc_html_e('Search', 'xstore'); ?></span></a>
               	<div class="search-form-wrapper">
	                <?php
	                    if(!class_exists('WooCommerce')) {
	                        get_search_form();
	                    } else {
	                        get_template_part('woosearchform');
	                    }
	                ?>
               	</div>
            </div>
        <?php
    }
}

// **********************************************************************//
// ! Function to display comments
// **********************************************************************//
if(!function_exists('etheme_comments')) {
    function etheme_comments($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        if(get_comment_type() == 'pingback' || get_comment_type() == 'trackback') :
            ?>

            <li id="comment-<?php comment_ID(); ?>" class="pingback">
                <div class="comment-block row">
                    <div class="col-md-12">
                        <div class="author-link"><?php esc_html_e('Pingback:', 'xstore') ?></div>
                        <div class="comment-reply"> <?php edit_comment_link(); ?></div>
                        <?php comment_author_link(); ?>
                    </div>
                </div>
				<div class="media">
					<h4 class="media-heading"><?php esc_html_e('Pingback:', 'xstore') ?></h4>

	                <?php comment_author_link(); ?>
					<?php edit_comment_link(); ?>
				</div>
            <?php

        elseif(get_comment_type() == 'comment') :
    	$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) ); ?>



			<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<div class="media">
					<div class="pull-left">
			            <?php
			                $avatar_size = 80;
			                echo get_avatar($comment, $avatar_size);
			             ?>
					</div>

					<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>

						<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="<?php echo sprintf( esc_html__( 'Rated %d out of 5', 'xstore' ), $rating ) ?>">
							<span style="width:<?php echo ( $rating / 5 ) * 100; ?>%"><strong itemprop="ratingValue"><?php echo $rating; ?></strong> <?php _e( 'out of 5', 'xstore' ); ?></span>
						</div>

					<?php endif; ?>

					<div class="media-body">
						<h4 class="media-heading"><?php comment_author_link(); ?></h4>
						<div class="meta-comm">
							<?php comment_date(); ?> - <?php comment_time(); ?>
						</div>

                        <?php if ($comment->comment_approved == '0'): ?>
                            <p class="awaiting-moderation"><?php esc_html__('Your comment is awaiting moderation.', 'xstore') ?></p>
                        <?php endif ?>

                        <?php comment_text(); ?>
                        <?php comment_reply_link(array_merge($args, array('reply_text' => esc_html__('Reply to comment', 'xstore'),'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>

					</div>





				</div>

        <?php endif;
    }
}


// **********************************************************************//
// ! Create products slider by args
// **********************************************************************//
if(!function_exists('etheme_create_slider')) {
    function etheme_create_slider($args, $slider_args = array()){//, $title = false, $shop_link = true, $slider_type = false, $items = '[[0, 1], [479,2], [619,2], [768,4],  [1200, 4], [1600, 4]]', $style = 'default'
        global $woocommerce_loop;

        extract(shortcode_atts(array(
	        'title' => false,
	        'shop_link' => false,
	        'slider_type' => false,
	        'from_first' => '',
			'large' => 4,
			'notebook' => 4,
			'tablet_land' => 3,
			'tablet_portrait' => 2,
			'mobile' => 2,
			'slider_autoplay' => 'no',
			'slider_speed' => 300,
			'slider_interval' => 1000,
			'pagination_type' => 'hide',
			'default_color' => '#e6e6e6',
			'active_color' => '#b3a089',
			'hide_fo' => '',
			'hide_buttons' => false,
	        'style' => 'default',
	        'product_view' => '',
	        'product_view_color' => '',
			'no_spacing' => '',
			'size' => 'shop_catalog',
	        'block_id' => false
	    ), $slider_args));

        $box_id = rand(1000,10000);
        $multislides = new WP_Query( $args );
        $class = $container_class = $title_output = $slide_class = $block = '';

		$woocommerce_loop['size'] = $size;

        if(!$slider_type) {
        	$woocommerce_loop['lazy-load'] = true;
        	$woocommerce_loop['style'] = $style;
        }

		if( $block_id && $block_id != '' && etheme_get_block($block_id) != '' ) {
			ob_start();
				echo '<div class="slide-item '.$slider_type.'-slide">';
					echo etheme_get_block($block_id);
				echo '</div><!-- slide-item -->';
			$block = ob_get_contents();
			ob_end_clean();
		}

		$slide_class .= $slider_type . '-slide';

		if( $no_spacing == 'yes' ) {
			$slide_class .= ' item-no-space';
		}
        $lines = '';
        if ($pagination_type == 'lines'){
            $lines = 'swiper-pagination-lines';
        }

        if ( $slider_speed ) {
        	$slider_speed = 'data-speed="'.$slider_speed.'"';
        } else {
        	$slider_speed = '';
        }

        if ( $slider_autoplay ) {
        	$slider_autoplay = $slider_interval;
        }

        if ( $multislides->have_posts() ) :
            if ($title) {
                $title_output = '<h2 class="products-title"><span>'.$title.'</span></h2>';
            }
            echo '<div class="swiper-entry">';
            	if (!$hide_buttons) {
                    echo '
                        <div class="swiper-custom-left"></div>
                        <div class="swiper-custom-right"></div>
                    ';
                }
              echo '<div class="swiper-container carousel-area '.$container_class.' slider-'.$box_id.' '.$lines.'" data-breakpoints="1" data-xs-slides="'.esc_js($mobile).'" data-sm-slides="'.esc_js($tablet_land).'" data-md-slides="'.esc_js($notebook).'" data-lt-slides="'.esc_js($large).'" data-slides-per-view="'.esc_js($large).'" data-autoplay="'.esc_attr($slider_autoplay).'" '.$slider_speed.'>';
	              echo $title_output;
	              echo '<div class="swiper-wrapper '.$class.' productCarousel">';
	                    $_i=0;

	                    while ($multislides->have_posts()) : $multislides->the_post();
	                        $_i++;

							if( ($from_first == 'no' && $_i == 2) || ($from_first != 'no' && $_i == 1)) {
								echo $block;
							}

	                        if(class_exists('Woocommerce')) {
	                            global $product;
	                            if (!$product->is_visible()) continue;
	                            echo '<div class="swiper-slide slide-item product-slide '. esc_attr( $slide_class ) . '">';
	                                wc_get_template_part( 'content', 'product-slider' );
	                            echo '</div><!-- slide -->';
	                        }

	                    endwhile;
	              echo '</div><!-- end wrapper -->';
                    if ($pagination_type != "hide") { echo '<div class="swiper-pagination etheme-css" data-css=".slider-'.$box_id.' .swiper-pagination-bullet{background-color:'.$default_color.'; '. $lines.';} .slider-'.$box_id.' .swiper-pagination-bullet:hover{ background-color:'.$active_color.'; } .slider-'.$box_id.' .swiper-pagination-bullet-active{ background-color:'.$active_color.'; }"></div>'; }
              echo '</div><!-- end container -->';
              echo '</div>';
        endif;
        wp_reset_query();
        unset($woocommerce_loop['lazy-load']);
        unset($woocommerce_loop['style']);

    }
}

// **********************************************************************// 
// ! Create products grid by args
// **********************************************************************//
if(!function_exists('etheme_products')) {
    function etheme_products($args,$title = false, $columns = 4){
        global $wpdb, $woocommerce_loop;
        ob_start();

        $products = new WP_Query( $args );
        $class = $title_output = '';

        if ($title != '') {
            $title_output = '<h2 class="products-title"><span>'.$title.'</span></h2>';
        }   

        $woocommerce_loop['columns'] = $columns;

        if ( $products->have_posts() ) :  echo $title_output; ?>
            <?php woocommerce_product_loop_start(); ?>

                <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                   <?php wc_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; // end of the loop. ?>
                
            <?php woocommerce_product_loop_end(); ?>

        <?php endif;

        wp_reset_postdata();

        return ob_get_clean();
            
    }
}

if( ! function_exists( 'etheme_fullscreen_products' ) ) {
	function etheme_fullscreen_products( $args, $slider_args = array() ) {
		global $woocommerce_loop;

		extract($slider_args);

		ob_start();

		$products = new WP_Query( $args );

		$images_slider_items = array();

		if ( $products->have_posts() ) : ?>

			<div class="et-full-screen-products">
				<div class="et-products-info-slider swiper-container">
					<div class="swiper-wrapper">
						<?php while ( $products->have_posts() ) : $products->the_post(); ?>
							<div class="et-product-info-slide swiper-slide swiper-no-swiping">
								<div class="product-info-wrapper">
									<p class="product-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</p>

									<?php
										etheme_product_cats();

										woocommerce_template_single_rating();

										woocommerce_template_single_price();

										woocommerce_template_single_excerpt();

										woocommerce_template_loop_add_to_cart();

										if( get_option('yith_wcwl_button_position') == 'shortcode' ) {
											etheme_wishlist_btn();
										}

										woocommerce_template_single_meta();

										if(etheme_get_option('share_icons')): ?>
											<div class="product-share">
												<?php echo do_shortcode('[share title="'.__('Share Social', 'xstore').'" text="'.get_the_title().'"]'); ?>
											</div>
										<?php endif;?>
								</div>
							</div>

							<?php
								$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
								$images_slider_items[] = '<div class="et-product-image-slide swiper-slide swiper-no-swiping" style="background-image: url(' . $image[0] . ');"></div>';
							?>

						<?php endwhile; // end of the loop. ?>
					</div>
				</div>
				<div class="et-products-images-slider swiper-container">
					<div class="swiper-wrapper">
						<?php echo implode( '', array_reverse( $images_slider_items) ); ?>
					</div>
					<div class="et-products-navigation">
						<div class="et-swiper-next">
							<span class="swiper-nav-title"></span>
							<span class="swiper-nav-price"></span>
							<span class="swiper-nav-arrow"></span>
						</div>
						<div class="et-swiper-prev">
							<span class="swiper-nav-arrow"></span>
							<span class="swiper-nav-title"></span>
							<span class="swiper-nav-price"></span>
						</div>
					</div>
				</div>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					var slidesCount = $('.et-product-info-slide').length;

					var infoSwiper = new Swiper('.et-products-info-slider', {
						paginationClickable: true,
						direction: 'vertical',
						slidesPerView: 1,
						initialSlide: slidesCount,
						simulateTouch: false,
						noSwiping: true,
						loop: true,
						onInit: function(swiper) {
							updateNavigation();
						}
					});

					var imagesSwiper = new Swiper('.et-products-images-slider', {
						paginationClickable: true,
						direction: 'vertical',
						slidesPerView: 1,
						loop: true,
						simulateTouch: false,
						noSwiping: true,
						prevButton: '.et-products-navigation .et-swiper-prev',
						nextButton: '.et-products-navigation .et-swiper-next',
						onSlideNextStart: function(swiper) {
							infoSwiper.slidePrev();
							updateNavigation();
						},
						onSlidePrevStart: function(swiper) {
							infoSwiper.slideNext();
							updateNavigation();
						}
					});

					function updateNavigation() {
						var $nextBtn = $('.et-products-navigation .et-swiper-next'),
							$prevBtn = $('.et-products-navigation .et-swiper-prev'),
							currentIndex = $('.et-product-info-slide.swiper-slide-active').data('swiper-slide-index'),
							prevIndex = ( currentIndex >= slidesCount - 1 ) ? 0 : currentIndex + 1,
							nextIndex = ( currentIndex <= 0 ) ? slidesCount - 1 : currentIndex - 1,
							$nextProduct = $('.et-product-info-slide[data-swiper-slide-index="' + nextIndex + '"]'),
							nextTitle = $nextProduct.find('.product-title a').first().text(),
							nextPrice = $nextProduct.find('.price').html(),
							$prevProduct = $('.et-product-info-slide[data-swiper-slide-index="' + prevIndex + '"]'),
							prevTitle = $prevProduct.find('.product-title a').first().text(),
							prevPrice = $prevProduct.find('.price').html();

						$nextBtn.find('.swiper-nav-title').text(nextTitle);
						$nextBtn.find('.swiper-nav-price').html(nextPrice);

						$prevBtn.find('.swiper-nav-title').text(prevTitle);
						$prevBtn.find('.swiper-nav-price').html(prevPrice);
					}
				});
			</script>

		<?php endif;
		wp_reset_postdata();
		return ob_get_clean();
	}
}



// **********************************************************************//
// ! Create posts slider by args
// **********************************************************************//
if(!function_exists('etheme_create_posts_slider')) {
    function etheme_create_posts_slider($args,$title = false, $atts = array() ){
        global $et_loop;

        extract( shortcode_atts( array(
            'large' => 4,
            'notebook' => 3,
            'tablet_land' => 2,
            'tablet_portrait' => 2,
            'mobile' => 2,
            'slider_autoplay' => 'no',
            'slider_speed' => 300,
            'slider_interval' => 1000,
            'pagination_type' => 'hide',
            'default_color' => '#e6e6e6',
            'active_color' => '#b3a089',
            'hide_buttons' => false,
            'hide_fo' => '',
            'size' => 'medium',
            'slide_view' => '',
            'blog_align' => '',
            'el_class' => '',
        ), $atts ) );

        $box_id = rand(1000,10000);
        $multislides = new WP_Query( $args );
        $class = '';
        $et_loop['slider'] = true;
        $et_loop['blog_layout'] = 'default';
        $et_loop['size'] = $size;
        $et_loop['slide_view'] = $slide_view;
        $et_loop['blog_align'] = $blog_align;

        if ( $multislides->have_posts() ) :
            $title_output = '';
            if ($title) {
                $title_output = '<h3 class="title"><span>'.$title.'</span></h3>';
            }
            $lines = '';
            if ($pagination_type == 'lines'){
                $lines = 'swiper-pagination-lines';
            }

            if ( $slider_speed ) {
        		$slider_speed = 'data-speed="'.$slider_speed.'"';
	        } else {
	        	$slider_speed = '';
	        }

	        if ( $slider_autoplay ) {
	        	$slider_autoplay = $slider_interval;
	        }

            echo '<div class="swiper-entry">';
            if (!$hide_buttons) {
                echo '
                    <div class="swiper-button-prev swiper-custom-left"></div>
                    <div class="swiper-button-next swiper-custom-right"></div>
                ';
            }
                    echo'<div class="swiper-container '.$class.$el_class.' posts-slider slider-'.$box_id.' '.$lines.'" data-breakpoints="1" data-xs-slides="'.esc_js($mobile).'" data-sm-slides="'.esc_js($tablet_land).'" data-md-slides="'.esc_js($notebook).'" data-lt-slides="'.esc_js($large).'" data-slides-per-view="'.esc_js($large).'" data-autoheight="1" data-autoplay="'.esc_attr($slider_autoplay).'" '.$slider_speed.'>';
            echo $title_output;
            echo '<div class="swiper-wrapper">';
            $_i=0;
            while ($multislides->have_posts()) : $multislides->the_post();
                $_i++;
                echo '<div class="swiper-slide">';
                    get_template_part( 'content', 'grid' );
                echo '</div>';
            endwhile;
            echo '</div><!-- slider wrapper-->';
            if ($pagination_type != "hide") { echo '<div class="swiper-pagination etheme-css" data-css=".slider-'.$box_id.' .swiper-pagination-bullet{background-color:'.$default_color.'; '. $lines.';} .slider-'.$box_id.' .swiper-pagination-bullet:hover{ background-color:'.$active_color.'; } .slider-'.$box_id.' .swiper-pagination-bullet-active{ background-color:'.$active_color.'; }"></div>'; }
            echo '</div><!-- slider container-->';

            echo '</div><div class="clear"></div><!-- slider-entry -->';

        endif;
        unset($et_loop);
        wp_reset_postdata();
    }
}


// **********************************************************************//
// ! Products slider widget
// **********************************************************************//
if(!function_exists('etheme_create_slider_widget')) {
    function etheme_create_slider_widget($args,$title = false){
        global $wpdb;
        $box_id = rand(1000,10000);
        $multislides = new WP_Query( $args );
        if ( $multislides->have_posts() ) :
            if ($title) {
                $title_output = '<h4 class="widget-title"><span>'.$title.'</span></h4>';
            }
            echo '<div class="sidebar-slider">';
            echo '<div class="swiper-entry">';
            echo $title_output;
            echo '<div class="swiper-container" data-slides-per-view="2" data-breakpoints="1" data-xs-slides="1" data-sm-slides="2" data-md-slides="2" data-lt-slides="2" data-slidesPerColumn="2">';
            echo '<div class="swiper-wrapper">';
            while ($multislides->have_posts()) : $multislides->the_post();
                if(class_exists('Woocommerce')) {
                    global $product;
                    if (!$product->is_visible()) continue;
                        wc_get_template_part( 'content', 'widget-product-slider' );
                }
            endwhile;
            echo '</div><!-- swiper-wrapper -->';
            echo '<div class="swiper-pagination"></div>';
            echo '</div><!-- swiper-container -->';
            echo ' <div class="swiper-custom-left"></div>
                   <div class="swiper-custom-right"></div>';
            echo '</div>';
            echo '</div>';
        endif;
        wp_reset_query();

    }
}

// **********************************************************************//
// ! Site breadcrumbs
// **********************************************************************//
if(!function_exists('etheme_breadcrumbs')) {
    function etheme_breadcrumbs() {

		if( function_exists('is_bbpress') && is_bbpress() ) {
			bbp_breadcrumb();
			return;
		}

      $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
      $delimiter = '<span class="delimeter"><i class="fa fa-angle-right"></i></span>'; // delimiter between crumbs
      $home = esc_html__('Home', 'xstore'); // text for the 'Home' link
      $blogPage = esc_html__('Blog', 'xstore');
      $showCurrent = 0; // 1 - show current post/page title in breadcrumbs, 0 - don't show
      $before = '<span class="current">'; // tag before the current crumb
      $after = '</span>'; // tag after the current crumb

      global $post;

      $homeLink = home_url();

      if (is_front_page()) {

        if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';

	      } else if (class_exists('bbPress') && is_bbpress()) {
      	$bbp_args = array(
      		'before' => '<div class="breadcrumbs" id="breadcrumb">',
      		'after' => '</div>'
      	);
      	bbp_breadcrumb($bbp_args);
      } else {
        do_action('etheme_before_breadcrumbs');

        echo '<div class="breadcrumbs">';
        echo '<div id="breadcrumb">';
        echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

        if ( is_category() ) {
          $thisCat = get_category(get_query_var('cat'), false);
          if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
          echo $before . esc_html__('Archive by category ', 'xstore') . '"' . single_cat_title('', false) . '"' . $after;

        } elseif ( is_search() ) {
          echo $before . esc_html__('Search results for ', 'xstore') . '"' . get_search_query() . '"' . $after;

        } elseif ( is_day() ) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
          echo $before . get_the_time('d') . $after;

        } elseif ( is_month() ) {
          echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
          echo $before . get_the_time('F') . $after;

        } elseif ( is_year() ) {
          echo $before . get_the_time('Y') . $after;

        } elseif ( is_single() && !is_attachment() ) {
          if ( get_post_type() == 'etheme_portfolio' ) {
            $portfolioId = etheme_tpl2id('portfolio.php');
            $portfolioLink = get_permalink($portfolioId);
            $post_type = get_post_type_object(get_post_type());
            $page = get_page( $portfolioId );
            $slug = $post_type->rewrite;
            echo '<a href="' . $portfolioLink . '">' . $page->post_title . '</a>';
            if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
          } elseif ( get_post_type() != 'post' ) {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
            if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
          } else {
            $cat = get_the_category();
            if(isset($cat[0])) {
	            $cat = $cat[0];
	            $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
	            if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
	            echo $cats;
            }
	        if ($showCurrent == 1) echo $before . get_the_title() . $after;
          }

        } elseif ( is_tax('portfolio_category') ) {
        	$portfolioId = etheme_tpl2id('portfolio.php');
        	$post = get_page( $portfolioId );
        	$portfolioLink = get_permalink($portfolioId);
        	echo '<a href="' . $portfolioLink . '">' . $post->post_title . '</a>' . $delimiter;
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
          $post_type = get_post_type_object(get_post_type());
          echo $before . $post_type->labels->singular_name . $after;

        } elseif ( is_attachment() ) {
          $parent = get_post($post->post_parent);
          //$cat = get_the_category($parent->ID); $cat = $cat[0];
          //echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
          //echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
          if ($showCurrent == 1) echo ' '  . $before . get_the_title() . $after;

        } elseif ( is_page() && !$post->post_parent ) {
          if ($showCurrent == 1) echo $before . get_the_title() . $after;

        } elseif ( is_page() && $post->post_parent ) {
          $parent_id  = $post->post_parent;
          $breadcrumbs = array();
          while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id  = $page->post_parent;
          }
          $breadcrumbs = array_reverse($breadcrumbs);
          for ($i = 0; $i < count($breadcrumbs); $i++) {
            echo $breadcrumbs[$i];
            if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
          }
          if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

        } elseif ( is_tag() ) {
          echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

        } elseif ( is_author() ) {
           global $author;
          $userdata = get_userdata($author);
          echo $before . 'Articles posted by ' . $userdata->display_name . $after;

        } elseif ( is_404() ) {
          echo $before . 'Error 404' . $after;
        }else{

            echo $blogPage;
        }

        if ( get_query_var('paged') ) {
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
          echo ' ('.esc_html__('Page', 'xstore') . ' ' . get_query_var('paged').')';
          if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }

        echo '</div>';
		  if( etheme_get_option('return_to_previous') )
        	etheme_back_to_page();
        echo '</div>';

      }
    }
}

if(!function_exists('etheme_back_to_page')) {
    function etheme_back_to_page() {
        echo '<a class="back-history" href="javascript: history.go(-1)">' . esc_html__( 'Return to previous page', 'xstore' ) . '</a>';
    }
}


// **********************************************************************//
// ! Back to top button
// **********************************************************************//
if(!function_exists('etheme_btt_button')) {
	function etheme_btt_button() {
		if (etheme_get_option('to_top')): ?>
			<div id="back-top" class="back-top <?php if(!etheme_get_option('to_top_mobile')): ?>visible-lg<?php endif; ?> bounceOut">
				<a href="#top">
					<span></span>
				</a>
			</div>
		<?php endif;
	}
}

add_action('after_page_wrapper', 'etheme_btt_button');


// **********************************************************************//
// ! Promo Popup
// **********************************************************************//
add_action('after_page_wrapper', 'etheme_promo_popup');
if(!function_exists('etheme_promo_popup')) {
    function etheme_promo_popup() {
        if(!etheme_get_option('promo_popup')) return;
        $bg = etheme_get_option('pp_bg');
        $padding = etheme_get_option('pp_padding');
        ?>
            <div id="etheme-popup" class="white-popup-block mfp-hide mfp-with-anim zoom-anim-dialog">
                <?php echo do_shortcode(etheme_get_option('pp_content')); ?>
            </div>
            <style type="text/css">
                #etheme-popup {
                    width: <?php echo (etheme_get_option('pp_width') != '') ? etheme_get_option('pp_width') : 700 ; ?>px;
                    height: <?php echo (etheme_get_option('pp_height') != '') ? etheme_get_option('pp_height') : 350 ; ?>px;
                    <?php if(!empty($bg['background-color'])): ?>  background-color: <?php echo $bg['background-color']; ?>;<?php endif; ?>
                    <?php if(!empty($bg['background-image'])): ?>  background-image: url(<?php echo $bg['background-image']; ?>) ; <?php endif; ?>
                    <?php if(!empty($bg['background-attachment'])): ?>  background-attachment: <?php echo $bg['background-attachment']; ?>;<?php endif; ?>
                    <?php if(!empty($bg['background-repeat'])): ?>  background-repeat: <?php echo $bg['background-repeat']; ?>;<?php  endif; ?>
                    <?php if(!empty($bg['background-position'])): ?>  background-position: <?php echo $bg['background-position']; ?>;<?php endif; ?>
                }
            </style>
        <?php
    }
}


// **********************************************************************//
// ! QR Code generation
// **********************************************************************//
if(!function_exists('etheme_qr_code')) {
    function etheme_qr_code($text='QR Code', $title = 'QR Code', $size = 128, $class = '', $self_link = false, $lightbox = false ) {
        if($self_link) {
            $text = @$_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
            if ( $_SERVER['SERVER_PORT'] != '80' )
                $text .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
            else
                $text .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        }
        $image = 'https://chart.googleapis.com/chart?chs=' . $size . 'x' . $size . '&cht=qr&chld=H|1&chl=' . $text;

        if($lightbox) {
            $class .= ' qr-lighbox';
            $output = '<a href="'.$image.'" rel="lightbox" class="'.$class.'">'.$title.'</a>';
        } else{
            $class .= ' qr-image';
            $output = '<img src="'.$image.'"  class="'.$class.'" />';
        }

        return $output;
    }
}


// **********************************************************************//
// ! Show shop navbar
// **********************************************************************//
if( ! function_exists( 'etheme_shop_navbar' ) ) {
    function etheme_shop_navbar( $location = 'header', $exclude = array(), $force = false ) {

    	$args['wishlist'] = ( ! in_array( 'wishlist', $exclude ) && etheme_woocommerce_installed() && etheme_get_option( 'top_wishlist_widget' ) == $location ) ? true : false ;
		$args['search'] = ( ! in_array( 'search', $exclude ) && etheme_get_option( 'search_form' ) == $location ) ? true : false;
		$args['cart'] = ( ! in_array( 'cart', $exclude ) && etheme_woocommerce_installed() && ! etheme_get_option( 'just_catalog' ) && etheme_get_option( 'cart_widget' ) == $location ) ? true : false ;

    	if ( ! $args['wishlist'] && ! $args['search'] && ! $args['cart'] && ! $force ) return;

   		do_action( 'etheme_before_shop_navbar' );

		echo '<div class="navbar-header show-in-' . $location . '">';
			if( $args['search'] ) etheme_search_form();
			if( $args['wishlist'] ) etheme_wishlist_widget();
			if( $args['cart'] ) etheme_top_cart();
		echo '</div>';

		do_action( 'etheme_after_shop_navbar' );

    }
}
