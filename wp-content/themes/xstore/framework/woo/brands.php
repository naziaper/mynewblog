<?php  if ( ! defined('ABSPATH')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Product brand label
// **********************************************************************//

add_action( 'admin_enqueue_scripts', 'etheme_brand_admin_scripts');
if(!function_exists('etheme_brand_admin_scripts')) {
    function etheme_brand_admin_scripts() {
        $screen = get_current_screen();
        if ( in_array( $screen->id, array('edit-brand') ) )
		  wp_enqueue_media();
    }
}

if(!function_exists('etheme_product_brand_image')) {
    function etheme_product_brand_image() {
        global $post;
        $terms = wp_get_post_terms( $post->ID, 'brand' );

        if(! is_wp_error( $terms ) && count($terms)>0 && etheme_get_option('show_brand') ) {
            ?>
            <div class="sidebar-widget product-brands">
                <h4 class="widget-title"><span><?php esc_html_e('Product brand', 'xstore') ?></span></h4>
                <?php
                foreach($terms as $brand) {
                    $thumbnail_id 	= absint( get_woocommerce_term_meta( $brand->term_id, 'thumbnail_id', true ) );
                    ?>
                    <a href="<?php echo get_term_link($brand); ?>">
                        <?php if ( etheme_get_option('show_brand_title') ) : ?>
                            <div class="view-products-title colorGrey"><?php echo $brand->name;?></div>
                        <?php endif;
                        if ($thumbnail_id && etheme_get_option('show_brand_image') ) :
                            echo wp_get_attachment_image( $thumbnail_id, 'full' );
                        endif; ?>
                    </a>
                    <?php if ( etheme_get_option('show_brand_desc') ) : ?>
                        <div class="short-description text-center colorGrey"><p><?php echo $brand->description;?></p></div>
                    <?php endif; ?>
                    <a href="<?php echo get_term_link($brand); ?>" id="test-slyle-less" class="view-products"><?php esc_html_e('View all products', 'xstore'); ?></a>
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }
}

add_action( 'brand_add_form_fields', 'etheme_brand_fileds');

if(!function_exists('etheme_brand_fileds')) {
	function etheme_brand_fileds() {
		global $woocommerce;
		?>
		<div class="form-field">
			<label><?php esc_html_e( 'Thumbnail', 'xstore' ); ?></label>
			<div id="brand_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo wc_placeholder_img_src(); ?>" width="60px" height="60px" /></div>
			<div style="line-height:60px;">
				<input type="hidden" id="brand_thumbnail_id" name="brand_thumbnail_id" />
				<button type="submit" class="upload_image_button button"><?php _e( 'Upload/Add image', 'xstore' ); ?></button>
				<button type="submit" class="remove_image_button button"><?php _e( 'Remove image', 'xstore' ); ?></button>
			</div>
			<script type="text/javascript">
            jQuery(function($){
                $(document).ready(function () {
    				 // Only show the "remove image" button when needed
    				 if ( ! $('#brand_thumbnail_id').val() )
                         $('.remove_image_button').hide();

    				// Uploading files
    				var file_frame;

                    $(document).on( 'click', '.upload_image_button', function( event ){

    					event.preventDefault();

    					// If the media frame already exists, reopen it.
    					if ( file_frame ) {
    						file_frame.open();
    						return;
    					}

    					// Create the media frame.
    					file_frame = wp.media.frames.downloadable_file = wp.media({
    						title: '<?php esc_html_e( 'Choose an image', 'xstore' ); ?>',
    						button: {
    							text: '<?php esc_html_e( 'Use image', 'xstore' ); ?>',
    						},
    						multiple: false
    					});

    					// When an image is selected, run a callback.
    					file_frame.on( 'select', function() {
    						attachment = file_frame.state().get('selection').first().toJSON();

                            $('#brand_thumbnail_id').val( attachment.id );
                            $('#brand_thumbnail img').attr('src', attachment.url );
                            $('.remove_image_button').show();
    					});

    					// Finally, open the modal.
    					file_frame.open();
    				});

                    $(document).on( 'click', '.remove_image_button', function( event ){
                        $('#brand_thumbnail img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
                        $('#brand_thumbnail_id').val('');
                        $('.remove_image_button').hide();
    					return false;
    				});
                });
            });
			</script>
			<div class="clear"></div>
		</div>
		<?php
	}
}


add_action( 'brand_edit_form_fields', 'etheme_edit_brand_fields', 10,2 );
if(!function_exists('etheme_edit_brand_fields')) {
    function etheme_edit_brand_fields($term, $taxonomy ) {
    	$thumbnail_id 	= absint( get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ) );
    	if ($thumbnail_id) :
    		$image = wp_get_attachment_thumb_url( $thumbnail_id );
    	else :
    		$image = wc_placeholder_img_src();
    	endif;
    	?>
    	<tr class="form-field">
    		<th scope="row" valign="top"><label><?php esc_html_e( 'Thumbnail', 'xstore' ); ?></label></th>
    		<td>
    			<div id="brand_thumbnail" style="float:left;margin-right:10px;"><img src="<?php echo $image; ?>" width="60px" height="60px" /></div>
    			<div style="line-height:60px;">
    				<input type="hidden" id="brand_thumbnail_id" name="brand_thumbnail_id" value="<?php echo $thumbnail_id; ?>" />
    				<button type="submit" class="upload_image_button button"><?php _e( 'Upload/Add image', 'xstore' ); ?></button>
    				<button type="submit" class="remove_image_button button"><?php _e( 'Remove image', 'xstore' ); ?></button>
    			</div>
    			<script type="text/javascript">
                jQuery(function($){
                    $(document).ready(function ($) {

                        // Uploading files
                        var file_frame;

                        $(document).on('click', '.upload_image_button', function (event) {

                            event.preventDefault();

                            // If the media frame already exists, reopen it.
                            if (file_frame) {
                                file_frame.open();
                                return;
                            }

                            // Create the media frame.
                            file_frame = wp.media.frames.downloadable_file = wp.media({
                                title: '<?php esc_html_e('Choose an image', 'xstore'); ?>',
                                button: {
                                    text: '<?php esc_html_e('Use image', 'xstore'); ?>',
                                },
                                multiple: false
                            });

                            // When an image is selected, run a callback.
                            file_frame.on('select', function () {
                                attachment = file_frame.state().get('selection').first().toJSON();

                                $('#brand_thumbnail_id').val(attachment.id);
                                $('#brand_thumbnail img').attr('src', attachment.url);
                                $('.remove_image_button').show();
                            });

                            // Finally, open the modal.
                            file_frame.open();
                        });

                        $(document).on('click', '.remove_image_button', function (event) {
                            $('#brand_thumbnail img').attr('src', '<?php echo wc_placeholder_img_src(); ?>');
                            $('#brand_thumbnail_id').val('');
                            $('.remove_image_button').hide();
                            return false;
                        });
                    });
                });
    			</script>
    			<div class="clear"></div>
    		</td>
    	</tr>
    	<?php
    }
}

if(!function_exists('etheme_brands_fields_save')) {
    function etheme_brands_fields_save($term_id, $tt_id, $taxonomy ) {

    	if ( isset( $_POST['brand_thumbnail_id'] ) )
    		update_woocommerce_term_meta( $term_id, 'thumbnail_id', absint( $_POST['brand_thumbnail_id'] ) );

    	delete_transient( 'wc_term_counts' );
    }
}

add_action( 'created_term', 'etheme_brands_fields_save', 10,3 );
add_action( 'edit_term', 'etheme_brands_fields_save', 10,3 );