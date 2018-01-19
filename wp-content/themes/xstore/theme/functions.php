<?php  if ( ! defined('ETHEME_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Script, styles, fonts
// **********************************************************************//  
if(!function_exists('etheme_theme_styles')) {
    function etheme_theme_styles() {
        if ( !is_admin() ) {
            wp_enqueue_style("fa",get_template_directory_uri().'/css/font-awesome.min.css');
            wp_enqueue_style("bootstrap",get_template_directory_uri().'/css/bootstrap.min.css');
            wp_enqueue_style("parent-style",get_template_directory_uri().'/style.css', array("bootstrap"));
            wp_enqueue_style( 'js_composer_front');
            wp_enqueue_style("google-fonts",etheme_http()."fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic");
        	
        	if( etheme_get_option('dark_styles') ) {
            	wp_enqueue_style("dark-style",get_template_directory_uri().'/css/dark.css');
        	}
        }
    }
}

add_action( 'wp_enqueue_scripts', 'etheme_theme_styles', 40);

// **********************************************************************// 
// ! Plugins activation
// **********************************************************************// 
if(!function_exists('etheme_register_required_plugins')) {
	add_action('tgmpa_register', 'etheme_register_required_plugins');
	function etheme_register_required_plugins() {
		if( ! etheme_is_activated() ) return;

		$activated_data = get_option( 'etheme_activated_data' );

		$key = $activated_data['api_key'];

		if( ! $key || empty( $key ) ) return;

		$plugins_dir = ETHEME_API . 'files/get/';
		$token = '?token=' . $key;
		$plugins = array(
			array(
				'name'     				=> 'Redux Framework', // The plugin name
				'slug'     				=> 'redux-framework', // The plugin slug (typically the folder name)
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'details_url' 			=> 'https://wordpress.org/plugins/redux-framework/', 
			),
			array(
				'name'     				=> '8theme Core', // The plugin name
				'slug'     				=> 'et-core-plugin', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'et-core-plugin.zip' . $token, // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '1.0.19', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'WooCommerce', // The plugin name
				'slug'     				=> 'woocommerce', // The plugin slug (typically the folder name)
				//'source'   				=> get_template_directory_uri() . '/framework/plugins/screets-chat.zip', // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> 'woocommerce', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://wordpress.org/plugins/woocommerce/', 
			),
			array(
				'name'     				=> 'Visual Composer', // The plugin name
				'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'js_composer.zip' . $token, // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431', 
			),
			array(
				'name'     				=> 'Revolution Slider', // The plugin name
				'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'revslider.zip' . $token, // The plugin source
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/slider-revolution-responsive-wordpress-plugin/2751380', 
			),        
			// array(
	  //           'name' => 'Envato Market',
	  //           'slug' => 'envato-market',
	  //           'source' => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
	  //           'required' => true,
	  //           'recommended' => true,
	  //           'force_activation' => false,
	  //       ),
			array(
				'name'     				=> 'Massive Addons', // The plugin name
				'slug'     				=> 'mpc-massive', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'mpc-massive.zip' . $token, // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/massive-addons-for-visual-composer/14429839', 
			),
			array(
				'name'     				=> 'Google map', // The plugin name
				'slug'     				=> 'wwp-vc-gmaps', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'wwp-vc-gmaps.zip' . $token, // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/gmaps-for-visual-composer/16393566', 
			),
			array(
				'name'     				=> '360 smart view', // The plugin name
				'slug'     				=> 'smart-product-viewer', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'smart-product-viewer.zip' . $token, // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/smart-product-viewer-360-animation-plugin/6277697', 
			),
			array(
				'name'     				=> 'Infinite scroll', // The plugin name
				'slug'     				=> 'sb-woocommerce-infinite-scroll', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'sb-woocommerce-infinite-scroll.zip' . $token, // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/woocommerce-infinite-scroll-and-ajax-pagination/10192075', 
			),
			array(
				'name'     				=> 'WooCommerce subscriptions', // The plugin name
				'slug'     				=> 'subscriptio', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'subscriptio.zip' . $token, // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/subscriptio-woocommerce-subscriptions/8754068', 
			),
			array(
				'name'     				=> 'WooCommerce Amazon', // The plugin name
				'slug'     				=> 'woozone', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'woozone.zip' . $token, // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/woocommerce-amazon-affiliates-wordpress-plugin/3057503', 
			),
			array(
				'name'     				=> 'Like 2 discount', // The plugin name
				'slug'     				=> 'like2discount', // The plugin slug (typically the folder name)
				'source'   				=> $plugins_dir . 'like2discount.zip' . $token, // The plugin source
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://codecanyon.net/item/like-2-discount-coupons-for-likes/8535477', 
			),
			array(
				'name'     				=> 'WishList', // The plugin name
				'slug'     				=> 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name)
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> 'yith-woocommerce-wishlist', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://wordpress.org/plugins/yith-woocommerce-wishlist/', 
			),
			array(
				'name'     				=> 'Compare', // The plugin name
				'slug'     				=> 'yith-woocommerce-compare', // The plugin slug (typically the folder name)
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> 'yith-woocommerce-compare', // If set, overrides default API URL and points to an external URL
				'details_url' 			=> 'https://wordpress.org/plugins/yith-woocommerce-compare/', 
			),
			array(
				'name'     				=> 'Contact form 7', // The plugin name
				'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'details_url' 			=> 'https://wordpress.org/plugins/contact-form-7/', 
			),
			array(
				'name'     				=> 'Metaboxes framework', // The plugin name
				'slug'     				=> 'cmb2', // The plugin slug (typically the folder name)
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'details_url' 			=> 'https://wordpress.org/plugins/cmb2/', 
			),
			array(
				'name'     				=> 'Mailchimp', // The plugin name
				'slug'     				=> 'mailchimp-for-wp', // The plugin slug (typically the folder name)
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'details_url' 			=> 'https://wordpress.org/plugins/mailchimp-for-wp/', 
			),
			array(
				'name'     				=> 'Cookie Notice', // The plugin name
				'slug'     				=> 'cookie-notice', // The plugin slug (typically the folder name)
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'details_url' 			=> 'https://wordpress.org/plugins/cookie-notice/', 
			)	
		);

		// Change this to your theme text domain, used for internationalising strings

		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'domain'       		=> 'xstore',         	// Text domain - likely want to be the same as your theme.
			'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
			'menu'         		=> 'install-required-plugins', 	// Menu slug
			'has_notices'      	=> true,                       	// Show admin notices or not
			'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
			'message' 			=> '',							// Message to output right before the plugins table
			'strings'      		=> array(
				'page_title'                       			=> esc_html__( 'Install Required Plugins', 'xstore'),
				'menu_title'                       			=> esc_html__( 'Install Plugins', 'xstore' ),
				'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'xstore' ), // %1$s = plugin name
				'downloading_package'                       => esc_html__( 'Downloading the install package&#8230;', 'xstore' ), // %1$s = plugin name
				'installing'                       			=> esc_html__( 'Installing Plugin: %s', 'xstore' ), // %1$s = plugin name
				'oops'                             			=> esc_html__( 'Something went wrong with the plugin API.', 'xstore' ),
				'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'xstore' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'xstore' ), // %1$s = plugin name(s)
				'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'xstore' ), // %1$s = plugin name(s)
				'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'xstore' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'xstore' ), // %1$s = plugin name(s)
				'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'xstore' ), // %1$s = plugin name(s)
				'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'xstore' ), // %1$s = plugin name(s)
				'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'xstore' ), // %1$s = plugin name(s)
				'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'xstore' ),
				'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'xstore' ),
				'return'                           			=> esc_html__( 'Return to Required Plugins Installer', 'xstore' ),
				'plugin_activated'                 			=> esc_html__( 'Plugin activated successfully.', 'xstore' ),
				'complete' 									=> esc_html__( 'All plugins installed and activated successfully. %s', 'xstore' ), // %1$s = dashboard link
				'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);

		tgmpa($plugins, $config);
	}
}

// **********************************************************************// 
// ! Footer Demo Widgets
// **********************************************************************// 

if(!function_exists('etheme_footer_demo')) {
    function etheme_footer_demo($position){
        switch ($position) {
            case 'footer-copyrights':
                ?>
					© Created by <a href="#"><i class="fa fa-heart"></i> &nbsp;<strong>8theme</strong></a> - Power Elite ThemeForest Author.
                <?php
            break;
        }
    }
}