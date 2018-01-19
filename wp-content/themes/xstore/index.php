<?php
/**
 * The main template file.
 *
 */
get_header();
?>
<?php

$l = etheme_page_config();

$content_layout = etheme_get_option('blog_layout');
$navigation_type = etheme_get_option( 'blog_navigation_type' );

$full_width = false;

if($content_layout == 'grid') {
	$full_width = etheme_get_option('blog_full_width');
	$content_layout = 'grid';
}

if ( $content_layout == 'grid2' ) {
	$full_width = etheme_get_option('blog_full_width');
	$content_layout = 'grid-2';
}

$class = 'hfeed';

$class .= ' et_blog-ajax';



if ( $content_layout == 'grid' || $content_layout == 'grid-2' ) {
	$class .= ' row';
	if ( etheme_get_option( 'blog_masonry' ) ) $class .= ' blog-masonry';
}

?>

<?php do_action( 'etheme_page_heading' ); ?>

	<div class="content-page <?php echo ( ! $full_width ) ? 'container' : 'blog-full-width'; ?>">
		<div class="sidebar-position-<?php echo esc_attr( $l['sidebar'] ); ?>">
			<div class="row">
				<div class="content <?php echo esc_attr( $l['content-class'] ); ?>">
					<?php if ( is_category() && category_description() ) : ?>
						<div class="blog-category-description"><?php echo do_shortcode( category_description() ); ?></div>
					<?php endif; ?>
					<div class="<?php echo $class; ?>">
						<?php if(have_posts()):
							while(have_posts()) : the_post(); ?>

								<?php get_template_part('content', $content_layout); ?>

							<?php endwhile; ?>
						<?php else: ?>

							<h1><?php esc_html_e('No posts were found!', 'xstore') ?></h1>

							<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords', 'xstore') ?></p>

							<?php get_search_form(); ?>

						<?php endif; ?>
					</div>

					<?php
						switch ( $navigation_type ) {
							case 'pagination': ?>
								<?php
									$pag_align = etheme_get_option( 'blog_pagination_align' );
									$paginate_args = array(
										'prev_text' => esc_html__( 'Prev page', 'xstore' ),
										'next_text' => esc_html__( 'Next page', 'xstore' ),
										'prev_next' => etheme_get_option( 'blog_pagination_prev_next' )
									);
								?>
								
								<div class="articles-pagination align-<?php echo esc_attr( $pag_align ); ?>">
									<?php if ( $pag_align == 'right' ) etheme_count_posts(); ?>
									<?php echo paginate_links( $paginate_args ); ?>
									<?php if ( $pag_align != 'right' ) etheme_count_posts(); ?>
								</div>
								<?php break;

							case 'button': ?>
									<div class="et_load-posts button-loading" data-loaded="<?php esc_html_e( 'No more posts to load', 'xstore' ) ?>">
										<?php etheme_loader() ?>
										<span class="btn"><?php next_posts_link( esc_html__( 'Load More Posts', 'xstore' ) ); ?></span>
									</div>
								<?php break;

							case 'lazy': ?>
									<div class="et_load-posts lazy-loading" data-loaded="<?php esc_html_e( 'No more posts to load', 'xstore' ) ?>" data-loading="<?php esc_html_e( 'Loading', 'xstore' ) ?>">
										<?php etheme_loader() ?>
										<span class="btn"><?php next_posts_link(); ?></span>
									</div>
								<?php break;

							default: ?>
								
								<?php break;
						}
		 			?>

				</div>

				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>

<?php
get_footer();
?>