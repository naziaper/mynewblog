<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 */


add_action( 'cmb2_admin_init', 'etheme_base_metaboxes');
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */

if(!function_exists('etheme_base_metaboxes')) {
	function etheme_base_metaboxes() {

		// Start with an underscore to hide fields from custom fields list
		$prefix = '_et_';

	    $cmb = new_cmb2_box( array(
			'id'         => 'page_metabox',
			'title'      => esc_html__( '[8theme] Layout options', 'xstore' ),
			'object_types'      => array( 'page', 'post'), // Post type
			'context'    => 'normal',
			'priority'   => 'high',
			'show_names' => true, // Show field names on the left
	        // 'cmb_styles' => false, // false to disable the CMB stylesheet
	        // 'closed'     => true, // Keep the metabox closed by default
	    ) );

	    $cmb->add_field( array(
	            'id'          => ETHEME_PREFIX .'custom_logo',
	            'name'        => 'Custom logo for this page/post',
			    'desc' => 'Upload an image or enter an URL.',
			    'type' => 'file',
			    'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
	        )
    	);
    	$cmb->add_field( array(
			'name'    => 'Custom header type',
			'id'      => ETHEME_PREFIX . 'custom_header',
			'type'    => 'radio_inline',
			'options' => array(
				'xstore' => '<img src="' . ETHEME_CODE_IMAGES . 'headers/xstore.jpg' . '" title="Variant xstore" alt="Variant xstore">',
				'xstore2'   => '<img src="' . ETHEME_CODE_IMAGES . 'headers/xstore2.jpg' . '" title="Variant xstore2" alt="Variant xstore2">',
				'center'     => '<img src="' . ETHEME_CODE_IMAGES . 'headers/center.jpg' . '" title="Variant center" alt="Variant center">',
				'center2' => '<img src="' . ETHEME_CODE_IMAGES . 'headers/center2.jpg' . '" title="Variant center2" alt="Variant center2">',
				'center3' => '<img src="' . ETHEME_CODE_IMAGES . 'headers/center3.jpg' . '" title="Variant center3" alt="Variant center3">',
				'standard' => '<img src="' . ETHEME_CODE_IMAGES . 'headers/standard.jpg' . '" title="Variant standard" alt="Variant standard">',
				'double-menu' => '<img src="' . ETHEME_CODE_IMAGES . 'headers/double-menu.jpg' . '" title="Variant double-menu" alt="Variant double-menu">',
				'two-rows' => '<img src="' . ETHEME_CODE_IMAGES . 'headers/two-rows.jpg' . '" title="Variant two-rows" alt="Variant two-rows">',
				'advanced' => '<img src="' . ETHEME_CODE_IMAGES . 'headers/advanced.jpg' . '" title="Variant advanced" alt="Variant advanced">',
				'simple' => '<img src="' . ETHEME_CODE_IMAGES . 'headers/simple.jpg' . '" title="Variant simple" alt="Variant simple">',
				'hamburger-icon' => '<img src="' . ETHEME_CODE_IMAGES . 'headers/hamburger-icon.jpg' . '" title="Variant hamburger-icon" alt="Variant hamburger-icon">',
				'vertical' => '<img src="' . ETHEME_CODE_IMAGES . 'headers/vertical-icon.jpg' . '" title="Variant vertical" alt="Variant vertical">',
				'vertical2' => '<img src="' . ETHEME_CODE_IMAGES . 'headers/vertical-icon-2.jpg' . '" title="Variant vertical2" alt="Variant vertical2">',
				'inherit' => 'Inherit'
			),
			'default' => '',
			'classes' => 'et-ht-metabox',
		) );

	    $cmb->add_field( 
	        array(
	            'id'          => ETHEME_PREFIX .'header_overlap',
	            'name'        => 'Header overlap',
	            'default'     => false,
	            'type'        => 'checkbox'
	        )
    	);

	    $cmb->add_field( 
	        array(
	            'id'          => ETHEME_PREFIX .'header_bg',
	            'name'        => 'Header background color',
			    'type' => 'colorpicker',
	        )
    	);

      	$cmb->add_field( 
	        array(
	            'id'          => ETHEME_PREFIX .'header_transparent',
	            'name'        => 'Header transparent',
	            'default'     => false,
	            'type'        => 'checkbox'
	        )
	 	);

	    $cmb->add_field(array(
	            'id'          => ETHEME_PREFIX .'header_color',
	            'name'        => 'Header text color',
	            'type'        => 'radio',
	            'options'     => array(
	                'inherit' => 'Inherit',
	                'dark' => 'Dark',
	                'white' => 'White',
	            )
	        ) 
    	);

    	$cmb->add_field(array(
	            'id'          => ETHEME_PREFIX .'top_bar_color',
	            'name'        => 'Top bar text color',
	            'type'        => 'radio',
	            'options'     => array(
	                'inherit' => 'Inherit',
	                'dark' => 'Dark',
	                'white' => 'White',
	            )
	        ) 
    	);

	    $cmb->add_field(array(
	            'id'          => ETHEME_PREFIX .'sidebar_state',
	            'name'        => 'Sidebar Position',
	            'type'        => 'radio',
	            'options'     => array(
	                'default' => 'Inherit',
	                'without' => 'Without',
	                'left' => 'Left',
	                'right' => 'Right' 
	            )
	        ) 
    	);

	    $cmb->add_field( 
	        array(
	            'id'          => ETHEME_PREFIX .'widget_area',
	            'name'        => 'Widget Area',
	            'type'        => 'select',
	            'options'     => etheme_get_sidebars()
	        )
    	);

	    $cmb->add_field( array(
		        'id'          => ETHEME_PREFIX .'sidebar_width',
		        'name'        => 'Sidebar width',
		        'type'        => 'radio',
		        'options'     => array(
	                '' => 'Inherit', 
	                2 => '1/6', 
	                3 => '1/4', 
	                4 => '1/3' 
	            )
		    )
    	);

	    $cmb->add_field( 
	        array(
	            'id'          => ETHEME_PREFIX .'custom_nav',
	            'name'       => 'Custom navigation',
	            'type'        => 'select',
	            'options'     => etheme_get_menus_options()
	        )
    	);

	    $cmb->add_field( 
	        array(
	            'id'          => ETHEME_PREFIX .'custom_nav_right',
	            'name'       => 'Custom navigation right (for double menu header)',
	            'type'        => 'select',
	            'options'     => etheme_get_menus_options()
	        )
    	);

	    $cmb->add_field( 
	        array(
	            'id'          => ETHEME_PREFIX .'custom_nav_mobile',
	            'name'       => 'Custom navigation for mobile',
	            'type'        => 'select',
	            'options'     => etheme_get_menus_options()
	        )
    	);

	    $cmb->add_field( 
	        array(
	            'id'          => ETHEME_PREFIX .'one_page',
	            'name'        => 'One page navigation',
	            'default'     => false,
	            'type'        => 'checkbox'
	        )
    	);
    	
	    $cmb->add_field( 
			array(
				'id'          => ETHEME_PREFIX .'breadcrumb_type',
				'name'        => 'Breadcrumbs Style',
				'type'        => 'select',
				'options'     => array(
					''   => '',
					'default'   => 'Center',
					'left'   => 'Align left',
					'left2' => 'Left inline',
					'disable'   => 'Disable',
				)
			)
    	);
    	
	    $cmb->add_field( 
			array(
				'id'          => ETHEME_PREFIX .'breadcrumb_effect',
				'name'        => 'Breadcrumbs Effect',
				'type'        => 'select',
				'class'       => '',
				'options'     => array(
					''   => '',
					'none' => 'None',
					'mouse' => 'Parallax on mouse move',
					'text-scroll' => 'Text animation on scroll',
				)
			)
    	);
    	
	    $cmb->add_field( 
	        array(
	            'id'          => ETHEME_PREFIX .'page_slider',
	            'name'        => 'Page slider',
	            'desc'        => 'Show revolution slider instead of breadcrumbs and page title',
	            'type'        => 'select',
	            'options'     => etheme_get_revsliders()
	        )
    	);
    	
	    $cmb->add_field( 
	        array(
	            'id'          => ETHEME_PREFIX .'custom_prefooter',
	            'name'        => 'Use custom pre footer for this page/post',
	            'type'        => 'select',
	            'options'     => etheme_get_post_options( array( 'post_type' => 'staticblocks', 'numberposts' => 100 ) ),
	        )
    	);
    	
	    $cmb->add_field( 
	        array(
	            'id'          => ETHEME_PREFIX .'custom_footer',
	            'name'        => 'Use custom footer for this page/post',
	            'type'        => 'select',
	            'options'     => etheme_get_post_options( array( 'post_type' => 'staticblocks', 'numberposts' => 100 ) ),
	        )
    	);

	    $cmb->add_field(array(
	            'id'          => ETHEME_PREFIX .'footer_fixed',
	            'name'        => 'Fixed footer',
	            'type'        => 'radio',
	            'options'     => array(
	                'inherit' => 'Inherit',
	                'yes' => 'yes',
	                'no' => 'no',
	            )
	        ) 
    	);

	    $cmb->add_field( 
	        array(
	            'id'          => ETHEME_PREFIX .'remove_copyrights',
	            'name'        => 'Disable copyrights',
	            'default'     => false,
	            'type'        => 'checkbox'
	        )
    	);

	    $cmb->add_field( 
	        array(
	            'id'          => ETHEME_PREFIX .'bg_image',
	            'name'        => 'Custom background image',
			    'desc' => 'Upload an image or enter an URL.',
			    'type' => 'file',
			    'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
	        )
    	);
	    $cmb->add_field( 
	        array(
	            'id'          => ETHEME_PREFIX .'bg_color',
	            'name'        => 'Custom background color',
			    'type' => 'colorpicker',
	        )
    	);

		$static_blocks = array();
		$static_blocks[] = "--choose--";
		
		foreach (etheme_get_static_blocks() as $block) {
			$static_blocks[$block['value']] = $block['label'];
		}

	    $cmb = new_cmb2_box( array(
			'id'         => 'product_metabox',
			'title'      => esc_html__( '[8theme] Product Options', 'xstore' ),
			'object_types'      => array( 'product', ), // Post type
			'context'    => 'normal',
			'priority'   => 'low',
			'show_names' => true, // Show field names on the left
	    ) );

	    $cmb->add_field( 
			array(
				'name' => 'Product layout',
				'id' => ETHEME_PREFIX . 'single_layout',
				'type' => 'select',
				'options'          => array(
					'standard' => esc_html__( 'Inherit', 'xstore' ),
					'small' => esc_html__( 'Small', 'xstore' ),
					'default' => esc_html__( 'Default', 'xstore' ),
					'large' => esc_html__( 'Large', 'xstore' ),
					'fixed' => esc_html__( 'Fixed', 'xstore' ),
					'center' => esc_html__( 'Center', 'xstore' ),
					'xsmall' => esc_html__( 'Thin description', 'xstore' ),
					'wide' => esc_html__( 'Wide', 'xstore' ),
				),
			)
    	);
    	
	    $cmb->add_field( 
			array(
				'name' => 'Additional custom block',
				'id' => $prefix . 'additional_block',
				'type'    => 'select',
				'options' => $static_blocks
			)
    	);


    	
	    $cmb->add_field( 
			array(
				'name' => 'Disable sidebar',
				'id' => $prefix . 'disable_sidebar',
				'type'    => 'checkbox',
			)
    	);


    	
	    $cmb->add_field( 
			array(
				'name' => 'Disable thumbnails gallery',
				'id' => $prefix . 'disable_gallery',
				'type'    => 'checkbox',
			)
    	);


    	
	    $cmb->add_field( 
	        array(
	            'id'          => ETHEME_PREFIX .'size_guide_img',
	            'name'        => 'Size guide image',
			    'desc' => 'Upload an image or enter an URL.',
			    'type' => 'file',
			    'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
	        )
    	);


	
		$product_category_options = array(
			'auto' => '--Auto--',
		);

		$terms = get_terms( 'product_cat', 'hide_empty=0' );

		if( ! is_wp_error( $terms ) && $terms ) {
			foreach ( $terms as $term ) {
				$product_category_options[$term->slug] = $term->name;
			}
		}


	    $cmb->add_field( 
			array(
			    'name' => 'Primary category',
			    'id' => $prefix . 'primary_category',
			    'type' => 'select',
			    'options' => $product_category_options
			)
    	);

	
		$category_options = array(
			'auto' => '--Auto--',
		);

		$terms = get_terms( 'category', 'hide_empty=0' );

		foreach ( $terms as $term ) {
			$category_options[$term->slug] = $term->name;
		}

	    $cmb->add_field( 
			array(
			    'name' => 'Custom tab title',
			    'id' => $prefix . 'custom_tab1_title',
			    'type' => 'text',
			)
    	);

    	
	    $cmb->add_field( 
			array(
			    'name' => 'Custom tab',
			    'id' => $prefix . 'custom_tab1',
			    'type' => 'textarea',
			)
    	);
    	

	    $cmb = new_cmb2_box( array(
			'id'         => 'post_metabox',
			'title'      => esc_html__( '[8theme] Post Options', 'xstore' ),
			'object_types'      => array( 'post', ), // Post type
			'context'    => 'normal',
			'priority'   => 'low',
			'show_names' => true, // Show field names on the left
	    ) );

    	
	    $cmb->add_field( 
			array(
			    'name' => 'Post template',
			    'id' => $prefix . 'post_template',
			    'type' => 'select',
			    'options'          => array(
			        '' => esc_html__( 'Inherit', 'xstore' ),
			        'default' => esc_html__( 'Default', 'xstore' ),
			        'full-width' => esc_html__( 'Large', 'xstore' ),
			        'large' => esc_html__( 'Full width', 'xstore' ),
			        'large2' => esc_html__( 'Full width centered', 'xstore' ),
			    ),
			)
    	);


    	
	    $cmb->add_field( 
			array(
			    'name' => 'Hide featured image on single',
			    'id' => $prefix . 'post_featured',
			    'type' => 'checkbox',
			    'value' => 'enable'
			)
    	);
    	
	    $cmb->add_field( 
			array(
			    'name' => 'Post featured video (for video post format)',
			    'id' => $prefix . 'post_video',
			    'type' => 'text_medium',
			    'desc' => 'Paste a link from Vimeo or Youtube, it will be embeded in the post'
			)
    	);
    	
	    $cmb->add_field( 
			array(
			    'name' => 'Soundcloud audio shortcode (for audio post format)',
			    'id' => $prefix . 'post_audio',
			    'type' => 'text_medium',
			)
    	);
    	
	    $cmb->add_field( 
			array(
			    'name' => 'Quote (for quote post format)',
			    'id' => $prefix . 'post_quote',
			    'type' => 'textarea',
			)
    	);
    	
	    $cmb->add_field( 
			array(
			    'name' => 'Primary category',
			    'id' => $prefix . 'primary_category',
			    'type' => 'select',
			    'options' => $category_options
			)
    	);

    	// Categories metabox
	}
}

add_filter('cmb2-taxonomy_meta_boxes', 'xstore_cateogires_metaboxes');

if( ! function_exists( 'xstore_cateogires_metaboxes' ) ) {
	function xstore_cateogires_metaboxes() {
		$prefix = '_et_';

		$meta_boxes['category_meta'] = array(
			'id'            => 'category_meta',
			'title'         => __( 'Category Metabox', 'xstore' ),
			'object_types'  => array( 'category', 'product_cat' ), // Taxonomy
			'context'       => 'normal',
			'priority'      => 'high',
			'show_names'    => true, // Show field names on the left
			// 'cmb_styles' => false, // false to disable the CMB stylesheet
			'fields'        => array(
				array(
		            'id'          => $prefix .'page_heading',
		            'name'        => __('Custom page heading image for this category', 'xstore'),
				    'desc' => __('Upload an image or enter an URL.', 'xstore'),
				    'type' => 'file',
				    'allow' => array( 'url', 'attachment' ) // limit to just attachments with array( 'attachment' )
		        ),
		        array(
		            'id'   => $prefix .'second_description',
		            'name' => __('Description after content', 'xstore'),
				    'desc' => __('The description is not prominent by default; however, some themes may show it.', 'xstore'),
				    'type' => 'textarea_small',
		        )
			)
		);

		return $meta_boxes;


	}
}