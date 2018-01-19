<?php  if ( ! defined('ETHEME_FW')) exit('No direct script access allowed');

// **********************************************************************// 
// ! Add admin styles and scripts
// **********************************************************************// 

if(!function_exists('etheme_load_admin_styles')) {
	add_action( 'admin_enqueue_scripts', 'etheme_load_admin_styles', 150 );
	function etheme_load_admin_styles() {
		global $pagenow;
		
	    wp_enqueue_style('farbtastic');
	    $depends = '';
	    if(class_exists('Redux') && $pagenow == 'admin.php' && @$_GET['page'] == '_options') {
	    	$depends = array('redux-admin-css', 'select2-css');
	    	wp_dequeue_style( 'woocommerce_admin_styles' );
	    }
	    wp_enqueue_style('etheme_admin_css', ETHEME_CODE_CSS.'admin.css', $depends);
	    wp_enqueue_style("font-awesome", get_template_directory_uri().'/css/font-awesome.min.css');
	}
}

if(!function_exists('etheme_add_admin_script')) {
	add_action('admin_init','etheme_add_admin_script', 1130);
	function etheme_add_admin_script(){
		global $pagenow;
	    add_thickbox();

		$depends = array();
		if( $pagenow == 'widgets.php' ) {
			$depends = array();
		}
	    wp_enqueue_script('theme-preview');
	    wp_enqueue_script('common');
	    wp_enqueue_script('wp-lists');
	    wp_enqueue_script('postbox');
	    wp_enqueue_script('farbtastic');
	    //wp_enqueue_script('et_masonry', get_template_directory_uri().'/js/jquery.masonry.min.js',array(),false,true);
	    wp_enqueue_script('etheme_admin_js', ETHEME_CODE_JS.'admin.js', $depends, false,true);
	}
}


if(!function_exists('etheme_rate_redirect')) {
	add_action( 'init', 'etheme_rate_redirect');
	function etheme_rate_redirect() {
		if( isset( $_GET['page'] ) && $_GET['page'] === '_et_open_support' && false === headers_sent() ) {
			wp_redirect( ETHEME_SUPPORT_LINK );
			exit;
		}
		if( isset( $_GET['page'] ) && $_GET['page'] === '_et_rate_theme' && false === headers_sent() ) {
			wp_redirect( ETHEME_RATE_LINK );
			exit;
		}
		if( isset( $_GET['page'] ) && $_GET['page'] === '_et_open_documentation' && false === headers_sent() ) {
			wp_redirect( ETHEME_DOCS_LINK );
			exit;
		}
	}
}


if(!function_exists('etheme_support_chat')) {
	function etheme_support_chat() {
		if( ! etheme_get_option( 'support_chat' ) ) return;
		$data = get_option( 'etheme_activated_data' );
		$data = $data['item'];
		$support_date = strtotime( $data['supported_until'] );
		$current_date = strtotime( date( "Y-m-d" ) );
		$remaining = $support_date - $current_date;
		$days_remaining = floor( $remaining / 86400 );
		$hours_remaining = floor( ( $remaining % 86400) / 3600 );
		?>
		<script>
			window.intercomSettings = {
			app_id: 't84fcdk1',
			"buyer": "<?php echo $data['buyer']; ?>",
			"support" : "<?php echo ( etheme_support_date() ) ? 'ON' : 'OFF' ?>",
			"supported_until": "<?php echo $data['supported_until']; ?>",
			"support_time_left" : "<?php echo $days_remaining . ' days ' . $hours_remaining . ' hours' ; ?>",
			"theme": "Xstore"
		};
		</script>
		<script data-cfasync="false">(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/t84fcdk1';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()
		</script>
		<?php
	}
}


add_action('wp_ajax_etheme_deactivate_theme', 'etheme_deactivate_theme');
if( ! function_exists( 'etheme_deactivate_theme' ) ) {
	function etheme_deactivate_theme() {
		$activated_data = get_option( 'etheme_activated_data' );
		$theme_id = 15780546;
		$api_url = ETHEME_API;
		$status = '';
		$errors = array();
		$api = ( ! empty( $activated_data['api_key'] ) ) ? $activated_data['api_key'] : false;

		$domain = get_option( 'siteurl' );
	    $domain = str_replace( 'http://', '', $domain );
	    $domain = str_replace( 'https://', '', $domain );
	    $domain = str_replace( 'www', '', $domain );
	    $domain = urlencode( $domain );

		$response = wp_remote_get( $api_url . 'deactivate/' . $api . '?envato_id='. $theme_id .'&domain=' . $domain );
		$response_code = wp_remote_retrieve_response_code( $response );

        if( $response_code != '200' ) {
            $errors[] = 'API error (5)';
            echo json_encode( $errors );
            die();
        }

        $data = json_decode( wp_remote_retrieve_body( $response ), true );

        if( isset( $data['error'] ) ) {
            $errors[] = $data['error'];
            echo json_encode( $errors );
            die();
        }

		if ( isset( $data['status'] ) ) {
			$status = $data['status'];
			$data = array(
				'api_key' => 0,
				'theme' => 0,
				'purchase' => 0,
	      	);
			update_option( 'etheme_activated_data', maybe_unserialize( $data ) );

			echo json_encode( $status );
			die();
		}
	}
}