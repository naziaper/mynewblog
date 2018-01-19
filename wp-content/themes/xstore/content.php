<?php
global $et_loop;

$post_format 	= get_post_format();
$layout 		= etheme_get_option('blog_layout');

if( ! empty( $et_loop['blog_layout'] ) ) {
    $layout = $et_loop['blog_layout'];
}

$postClass 		= etheme_post_class( false, $layout );
$read_more 		= etheme_get_read_more();
$size           = etheme_get_option( 'blog_images_size' );

if( ! empty( $et_loop['size'] ) ) {
    $size = $et_loop['size'];
}

?>

<article <?php post_class($postClass); ?> id="post-<?php the_ID(); ?>" >
    <?php
    if ( is_sticky() && is_home() && ! is_paged() ) {
        printf( '<span class="sticky-post">%s</span>', esc_html__( 'Featured', 'xstore' ) );
    }
    ?>
    <div>

        <?php if ( $layout != 'with-author'): ?>
            <?php etheme_post_thumb( array( 'size' => $size ) ); ?>
        <?php endif ?>
    
        <div class="post-data">
            <div class="post-heading">
                <?php if( $layout == 'with-author' ): //etheme_get_option('about_author') && $layout == 'title-left' ||  ?>
                    <div class="author-info">
                        <?php echo get_avatar( get_the_author_meta('email') , 40 ); ?>
                        <?php the_author_link(); ?>
                    </div>
                <?php endif; ?>
                <div class="post-heading-inner">
                    <?php if ( $layout != 'with-author' ): ?>
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <?php endif ?>
                    <?php
                    $author = 1;
                    $time = 0;
                    if($layout == 'small' || $layout == 'title-left') $author = 0;
                    if($layout == 'title-left') $time = 1;
                    etheme_byline( array( 'author' => $author, 'time' => $time ) );
                    ?>
                    <?php if ( $layout == 'with-author' ): ?>
                        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                    <?php endif ?>
                </div>
            </div>

            <?php if ( $layout == 'with-author'): ?>
                <?php etheme_post_thumb( array( 'size' => $size ) ); ?>
            <?php endif ?>

            <div class="content-article entry-content">
                <?php the_excerpt(); ?>
                <?php if ( etheme_get_option( 'read_more' ) != 'off' ): ?>
                    <a href="<?php the_permalink(); ?>"><?php echo $read_more; ?></a>
                <?php endif ?>
            </div>

            <?php if(etheme_get_option('about_author') && $layout != 'title-left' ): ?>
                <div class="author-info">
                    <?php echo get_avatar( get_the_author_meta('email') , 40 ); ?>
                    <?php the_author_link(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <?php if(etheme_get_option('blog_byline') && ( $layout == 'timeline' || $layout == 'timeline2' ) ): ?>

        <?php if ( $layout == 'timeline2' ): ?>
            <div class="timeline-content">
        <?php endif; ?>
        <div class="meta-post-timeline">
            <span class="time-day"><?php the_time('d'); ?></span>
            <span class="time-mon"><?php the_time('M'); ?></span>
        </div>
        <?php if ( $layout == 'timeline2' ): ?>
            </div><!-- .timeline-content -->
        <?php endif; ?>
    <?php endif; ?>
</article>











