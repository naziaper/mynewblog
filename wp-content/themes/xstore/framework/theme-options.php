<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */


if ( ! class_exists( 'Redux' ) || ! etheme_is_activated() ) {
    global $et_options;

    $et_options = array(
        'main_layout' => 'wide',
        'header_type' => 'xstore',
        'header_full_width' => '1',
        'header_color' => 'white',
        'header_overlap' => '1',
        'top_bar' => '1',
        'top_bar_color' => 'white',
        'logo_width' => '200',
        'top_links' => '1',
        'search_form' => 'header',
        'breadcrumb_type' => 'default',
        'breadcrumb_size' => 'small',
        'breadcrumb_effect' => 'none',
        'breadcrumb_bg' =>
            array (
                'background-color' => '#d64444',
            ),
        'breadcrumb_color' => 'white',
        'activecol' => '#d64444',
        'blog_hover' => 'default',
        'blog_byline' => '1',
        'read_more' => '1',
        'views_counter' => '1',
        'blog_sidebar' => 'right',
        'excerpt_length' => '25',
        'excerpt_words' => '...',
        'post_template' => 'default',
        'blog_featured_image' => '1',
        'search_form' => 'header',
        'top_wishlist_widget' => 'header', 
        'cart_widget' => 'header' 
    );
    return;
}


// ! Get options that need plugins
if ( ! function_exists( 'etheme_depend_options' ) ) :
    function etheme_depend_options( $plugin = '', $opt = '', $type = 'class' ){

        if ( empty( $plugin ) || empty( $opt ) || empty( $type ) ) return array();

        $options = array();

        switch ( $plugin ) {
            // ! Wishlist options
            case 'YITH_WCWL_Shortcode':
                if ( class_exists( 'YITH_WCWL_Shortcode' ) ) {
                    switch ( $opt ) {
                        case 'single_wishlist_type':
                            $options = array (
                                'id' => 'single_wishlist_type',
                                'type' => 'select',
                                'title' => __( 'Wishlist type', 'xstore' ),
                                'desc' => __( 'Only for "Use shortcode" wislist position', 'xstore' ),
                                'options' => array (
                                    'icon' => __( 'Icon', 'xstore' ),
                                    'icon-text' => __( 'Icon + text', 'xstore' ),
                                ),
                                'default' => 'icon'
                            );
                            break;
                        case 'single_wishlist_position':
                            $options = array (
                                'id' => 'single_wishlist_position',
                                'type' => 'select',
                                'title' => __( 'Wishlist position', 'xstore' ),
                                'desc' => __( 'Only for "Use shortcode" wislist position', 'xstore' ),
                                'options' => array (
                                    'after' => __( 'After "add to cart" button', 'xstore' ),
                                    'under' => __( 'Under "add to cart" button', 'xstore' ),
                                ),
                                'default' => 'after'
                            );
                            break;
                        default:
                            return $options;
                            break;
                    }
                }
                break;
            
            default:
                return $options;
                break;
        }

        return $options;
    }
endif;


if(!function_exists('etheme_redux_init')) {
    function etheme_redux_init() {
        // This is your option name where all the Redux data is stored.
        $opt_name = "et_options";


        /**
         * ---> SET ARGUMENTS
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */

        $theme = wp_get_theme(); // For use with some settings. Not necessary.

        $activated_data = get_option( 'etheme_activated_data' );
        $activated_data = ( isset( $activated_data['purchase'] ) && ! empty( $activated_data['purchase'] ) ) ? $activated_data['purchase'] : '';
        $args = array(
            // TYPICAL -> Change these values as you need/desire
            'opt_name'             => $opt_name,
            // This is where your data is stored in the database and also becomes your global variable name.
            'display_name'         => ETHEME_THEME_NAME . ' <span class="et_purchase-code">' . esc_html__('Theme Activated', 'xstore') . ' - <small>' . $activated_data .'</small></span><span class="et_theme-deactivator">Deactivate theme</span>',
            // Name that appears at the top of your panel
            'display_version'      => $theme->get( 'Version' ),
            // Version that appears at the top of your panel
            'menu_type'            => 'menu',
            //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
            'allow_sub_menu'       => true,
            // Show the sections below the admin menu item or not
            'menu_title'           => esc_html__( '8Theme Options', 'xstore' ),
            'page_title'           => esc_html__( '8Theme Options', 'xstore' ),
            // You will need to generate a Google API key to use this feature.
            // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
            'google_api_key'       => '',
            // Set it you want google fonts to update weekly. A google_api_key value is required.
            'google_update_weekly' => false,
            // Must be defined to add google fonts to the typography module
            'async_typography'     => false,
            // Use a asynchronous font on the front end or font string
            //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
            'admin_bar'            => false,
            // Show the panel pages on the admin bar
            'admin_bar_icon'       => 'dashicons-portfolio',
            // Choose an icon for the admin bar menu
            'admin_bar_priority'   => 50,
            // Choose an priority for the admin bar menu
            'global_variable'      => '',
            // Set a different name for your global variable other than the opt_name
            'dev_mode'             => false,
            // Show the time the page took to load, etc
            'update_notice'        => true,
            // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
            'customizer'           => true,
            // Enable basic customizer support
            //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
            //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

            // OPTIONAL -> Give you extra features
            'page_priority'        => 63,
            // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
            'page_parent'          => 'themes.php',
            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
            'page_permissions'     => 'manage_options',
            // Permissions needed to access the options panel.
            'menu_icon'            => ETHEME_CODE_IMAGES . 'icon-etheme.png',
            // Specify a custom URL to an icon
            'last_tab'             => '',
            // Force your panel to always open to a specific tab (by id)
            'page_icon'            => 'icon-themes',
            // Icon displayed in the admin panel next to your menu_title
            'page_slug'            => '_options',
            // Page slug used to denote the panel
            'save_defaults'        => true,
            // On load save the defaults to DB before user clicks save or not
            'default_show'         => false,
            // If true, shows the default value next to each field that is not the default value.
            'default_mark'         => '',
            // What to print by the field's title if the value shown is default. Suggested: *
            'show_import_export'   => true,
            // Shows the Import/Export panel when not used as a field.

            // CAREFUL -> These options are for advanced use only
            'transient_time'       => 60 * MINUTE_IN_SECONDS,
            'output'               => true,
            // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
            'output_tag'           => true,
            // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
            'footer_credit'     => '8theme',                   // Disable the footer credit of Redux. Please leave if you can help it.


            'templates_path' => ETHEME_BASE . ETHEME_CODE_3D . 'options-framework/et-templates/',

            // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
            'database'             => '',
            // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
            'system_info'          => false
        );


        // **************************************************************************************************** //
        // ! Custom fonts
        // **************************************************************************************************** //

        // ! Get standart redux font list
        $std_fonts = array(
            "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
            "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
            "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
            "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
            "Courier, monospace"                                   => "Courier, monospace",
            "Garamond, serif"                                      => "Garamond, serif",
            "Georgia, serif"                                       => "Georgia, serif",
            "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
            "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
            "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
            "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
            "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
            "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
            "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
            "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
        );

        // ! Get custom fonts list
        $fonts = get_option( 'etheme-fonts', false );

        if ( $fonts ) {
            $valid_fonts = array();
            foreach ( $fonts as $value ) {
                $valid_fonts[$value['name']] = $value['name'];
            }
            $fonts_list = array_merge( $std_fonts, $valid_fonts );
        } else {
            $fonts_list = '';
        }


        Redux::setArgs( $opt_name, $args );

        /*
         * ---> END ARGUMENTS
         */

        // -> START Basic Fields

        Redux::setSection( $opt_name, array(
            'title' => __( 'General', 'xstore' ),
            'id' => 'general',
            'icon' => 'el-icon-home',
        ) );


        Redux::setSection( $opt_name, array(
            'title' => __( 'Layout', 'xstore' ),
            'id' => 'general-layout',
            'subsection' => true,
            'icon' => 'el-icon-home',
            'fields' => array (
                array (
                    'id' => 'main_layout',
                    'type' => 'select',
                    'operator' => 'and',
                    'title' => __( 'Site Layout', 'xstore' ),
                    'options' => array (
                        'wide' => __( 'Wide layout', 'xstore' ),
                        'boxed' => __( 'Boxed', 'xstore' ),
                        'framed' => __( 'Framed', 'xstore' ),
                        'bordered' => __( 'Bordered', 'xstore' ),
                    ),
                    'default' => 'wide'
                ),
                array (
                    'id'        => 'site_width',
                    'type'      => 'slider',
                    'title'     => __( 'Site width', 'xstore' ),
                    "default"   => 1170,
                    "min"       => 970,
                    "step"      => 1,
                    "max"       => 3000,
                    'display_value' => 'text',
                ),
                array (
                    'id' => 'site_preloader',
                    'type' => 'switch',
                    'title' => __( 'Use site preloader', 'xstore' ),
                    'default' => false,
                ),

                array (
                    'id' => 'preloader_img',
                    'type' => 'media',
                    'desc' => __( 'Upload image: png, jpg or gif file', 'xstore' ),
                    'title' => __( 'Preloader image', 'xstore' ),
                    'required' => array( array( 'site_preloader', 'equals', true ) )
                ),

                array (
                    'id' => 'support_chat',
                    'type' => 'switch',
                    'title' => __( 'Support chat', 'xstore' ),
                    'default' => true,
                    'description' => ( ! etheme_support_date() ) ? '<p class="et-expired-support hidden">' . __( 'You support expired. To renew go to ', 'xstore' ) . '<a href="https://help.market.envato.com/hc/en-us/articles/207886473-Extending-and-Renewing-Item-Support" target="_blank">' . __( 'ThemeForest', 'xstore' ) . '</a></p>' : ''
                ),
                
                array (
                    'id' => 'static_blocks',
                    'type' => 'switch',
                    'title' => __( 'Enable static blocks', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'portfolio_projects',
                    'type' => 'switch',
                    'title' => __( 'Portfolio projects', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'testimonials_type',
                    'type' => 'switch',
                    'title' => __( 'Testimonials', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'enable_brands',
                    'type' => 'switch',
                    'title' => __( 'Brands', 'xstore' ),
                    'default' => true,
                ),
            ),
        ) );

        Redux::setSection( $opt_name, array(
            'title' => __( 'Header Type', 'xstore' ),
            'id' => 'general-header',
            'icon' => 'el-icon-cog',
            'subsection' => true,
            'fields' => array (
                array (
                    'id' => 'header_type',
                    'type' => 'image_select',
                    'title' => __( 'Header Type', 'xstore' ),
                    'options' => array (
                        'xstore' => array (
                            'title' => __( 'Variant xstore', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'headers/xstore.jpg',
                        ),
                        'xstore2' => array (
                            'title' => __( 'Variant xstore2', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'headers/xstore2.jpg',
                        ),
                        'center' => array (
                            'title' => __( 'Variant center', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'headers/center.jpg',
                        ),
                        'center2' => array (
                            'title' => __( 'Variant center 2', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'headers/center2.jpg',
                        ),
                        'center3' => array (
                            'title' => __( 'Variant center 3', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'headers/center3.jpg',
                        ),
                        'standard' => array (
                            'title' => __( 'Variant standard', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'headers/standard.jpg',
                        ),
                        'double-menu' => array (
                            'title' => __( 'Double menu', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'headers/double-menu.jpg',
                        ),
                        'two-rows' => array (
                            'title' => __( 'Two rows', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'headers/two-rows.jpg',
                        ),
                        'advanced' => array (
                            'title' => __( 'Advanced', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'headers/advanced.jpg',
                        ),
                        'simple' => array (
                            'title' => __( 'Variant simple', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'headers/simple.jpg',
                        ),
                        'hamburger-icon' => array (
                            'title' => __( 'Variant hamburger', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'headers/hamburger-icon.jpg',
                        ),
                        'vertical' => array (
                            'title' => __( 'Variant vertical', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'headers/vertical-icon.jpg',
                        ),
                        'vertical2' => array (
                            'title' => __( 'Variant vertical 2', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'headers/vertical-icon-2.jpg',
                        ),
                    ),
                    'default' => 'xstore'
                ),
            ),
        ) );

        Redux::setSection( $opt_name, array(
            'title' => __( 'Header Settings', 'xstore' ),
            'id' => 'general-header-settings',
            'icon' => 'el-icon-cog',
            'subsection' => true,
            'fields' => array (
                array (
                    'id' => 'logo',
                    'type' => 'media',
                    'desc' => __( 'Upload image: png, jpg or gif file', 'xstore' ),
                    'title' => __( 'Logo image', 'xstore' ),
                ),
                array (
                    'id' => 'logo_fixed',
                    'type' => 'media',
                    'desc' => __( 'Upload image: png, jpg or gif file', 'xstore' ),
                    'title' => __( 'Logo image for fixed header', 'xstore' ),
                ),
                array (
                    'id'        => 'logo_width',
                    'type'      => 'slider',
                    'title'     => __( 'Logo max width', 'xstore' ),
                    "default"   => 200,
                    "min"       => 50,
                    "step"      => 1,
                    "max"       => 500,
                    'display_value' => 'text',
                ),
                array (
                    'id' => 'header_full_width',
                    'type' => 'switch',
                    'title' => __( 'Header wide', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id'        => 'header_width',
                    'type'      => 'slider',
                    'title'     => __( 'Header maximum width', 'xstore' ),
                    "default"   => 1600,
                    "min"       => 1300,
                    "step"      => 1,
                    "max"       => 3000,
                    'display_value' => 'text',
                    'required' => array(
                        array( 'header_full_width', 'equals', true)
                    )
                ),
                array (
                    'id' => 'header_padding',
                    'type' => 'spacing',
                    'title' => __( 'Header padding', 'xstore' ),
                    'units'          => array('em', 'px'),
                    'units_extended' => 'false',
                    'default' => '',
                ),
                array (
                    'id' => 'header_margin_bottom',
                    'type'      => 'slider',
                    'title'     => __( 'Header margin bottom', 'xstore' ),
                    "default"   => 30,
                    "min"       => 0,
                    "step"      => 5,
                    "max"       => 100,
                    'display_value' => 'text',
                ),
                array (
                    'id' => 'header_overlap',
                    'type' => 'switch',
                    'title' => __( 'Header overlaps the content', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'header_color',
                    'type' => 'select',
                    'title' => __( 'Header text color', 'xstore' ),
                    'options' => array (
                        'dark' => __( 'Dark', 'xstore' ),
                        'white' => __( 'White', 'xstore' ),
                    ),
                    'default' => 'white'
                ),
                array (
                    'id' => 'header_bg',
                    'type' => 'background',
                    'title' => __( 'Header background', 'xstore' ),
                    'output' => array('.header-bg-block, .header-vertical, .header-vertical2')
                ),
                array (
                    'id' => 'smart_header_menu',
                    'type' => 'switch',
                    'title' => __( 'Smart menu', 'xstore' ),
                    'desc' => __('If menu includes more items than it can be per row then other items will be hidden into toggle', 'xstore'),
                    'default' => false,
                    'required' => array(
                            array('header_type','!=', 'hamburger-icon' ),
                            array('header_type', '!=', 'vertical'),
                            array('header_type', '!=', 'vertical2')
                    )
                ),
                array (
                    'id' => 'fixed_header',
                    'type' => 'select',
                    'title' => __( 'Fixed header type', 'xstore' ),
                    'options' => array (
                        'fixed' => __('Fixed', 'xstore'),
                        'smart' => __('Smart', 'xstore'),
                        ''  => __('Disable', 'xstore'),
                    ),
                    'default' => ''
                ),
                array (
                    'id' => 'fixed_header_color',
                    'type' => 'select',
                    'title' => __( 'Fixed header text color', 'xstore' ),
                    'options' => array (
                        'dark' => __( 'Dark', 'xstore' ),
                        'white' => __( 'White', 'xstore' ),
                    ),
                    'default' => 'dark'
                ),
                array (
                    'id' => 'fixed_header_bg',
                    'type' => 'background',
                    'title' => __( 'Fixed header background', 'xstore' ),
                    'output' => array('.fixed-header')
                ),
                array (
                    'id' => 'top_bar',
                    'type' => 'switch',
                    'title' => __( 'Enable top bar', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'top_bar_bg',
                    'type' => 'background',
                    'title' => __( 'Top bar background', 'xstore' ),
                    'output' => array('.top-bar')
                ),
                array (
                    'id' => 'top_bar_color',
                    'type' => 'select',
                    'title' => __( 'Top bar text color', 'xstore' ),
                    'options' => array (
                        'dark' => __( 'Dark', 'xstore' ),
                        'white' => __( 'White', 'xstore' ),
                    ),
                    'default' => 'white'
                ),
                array (
                    'id' => 'header_custom_block',
                    'type' => 'editor',
                    'title' => __( 'Header custom HTML', 'xstore' ),
                    'required' => array(
                        array( 'header_type', 'equals', array( 'standard', 'advanced', 'double-menu' ) )
                    )
                ),
                array (
                    'id' => 'top_wishlist_widget',
                    'type' => 'select',
                    'title' => __( 'Wishlist icon position', 'xstore' ),
                    'options' => array (
                        'header' => __( 'Header', 'xstore' ),
                        'tb-left' => __( 'Top bar left', 'xstore' ),
                        'tb-right' => __( 'Top bar right', 'xstore' ),
                        false => __( 'Disable', 'xstore' ),
                    ),
                    'default' => 'header',
                ),
                array (
                    'id' => 'top_links',
                    'type' => 'switch',
                    'title' => __( 'Enable Sign In link', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'search_form',
                    'type' => 'select',
                    'title' => __( 'Enable search form in', 'xstore' ),
                    'options' => array (
                        'header' => __( 'Header', 'xstore' ),
                        'tb-left' => __( 'Top bar left', 'xstore' ),
                        'tb-right' => __( 'Top bar right', 'xstore' ),
                        false => __( 'Disable', 'xstore' ),
                    ),
                    'default' => 'header',
                ),
                array (
                    'id' => 'search_ajax',
                    'type' => 'switch',
                    'title' => __( 'AJAX Search', 'xstore' ),
                    'default' => true,
                    'required' => array(
                        array( 'search_form', 'equals', array( 'header', 'tb-left', 'tb-right' ) )
                    )
                ),
                array (
                    'id' => 'search_ajax_post',
                    'type' => 'switch',
                    'title' => __( 'Search by posts', 'xstore' ),
                    'default' => true,
                    'required' => array(
                        array( 'search_ajax', 'equals', true)
                    )
                ),
                array (
                    'id' => 'search_ajax_page',
                    'type' => 'switch',
                    'title' => __( 'Search by pages', 'xstore' ),
                    'default' => false,
                    'required' => array(
                        array( 'search_ajax', 'equals', true),
                        array( 'search_ajax_post', 'equals', true)
                    )
                ),
                array (
                    'id' => 'search_ajax_product',
                    'type' => 'switch',
                    'title' => __( 'Search by products', 'xstore' ),
                    'default' => true,
                    'required' => array(
                        array( 'search_ajax', 'equals', true)
                    )
                ),
                array (
                    'id' => 'search_by_sku',
                    'type' => 'switch',
                    'title' => __( 'Search by sku', 'xstore' ),
                    'default' => true,
                    'required' => array(
                        array( 'search_form', 'equals', array( 'header', 'tb-left', 'tb-right' ) ) 
                    )
                ),
                array (
                    'id' => 'top_panel',
                    'type' => 'switch',
                    'title' => __( 'Enable top panel', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'shopping_cart_icon',
                    'type' => 'image_select',
                    'title' => __( 'Shopping cart icon', 'xstore' ),
                    'options' => array (
                        1 => array (
                            'img' => ETHEME_CODE_IMAGES . 'cart/default.png',
                        ),
                        2 => array (
                            'img' => ETHEME_CODE_IMAGES . 'cart/additional_2.png',
                        ),
                        3 => array (
                            'img' => ETHEME_CODE_IMAGES . 'cart/additional_1.png',
                        ),
                        4 => array (
                            'img' => ETHEME_CODE_IMAGES . 'cart/additional_3.png',
                        ),

                    ),
                    'default' => 1
                ),
                array (
                    'id' => 'shopping_cart_icon_bg',
                    'type' => 'switch',
                    'title' => __( 'Icon with background', 'xstore' ),
                    'default' => false,
                ),
                array (
                    'id' => 'favicon_label',
                    'type' => 'switch',
                    'title' => __( 'Show number of cart items on favicon', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'favicon_label_zero',
                    'type' => 'switch',
                    'title' => __( 'Show zero number of cart items on label', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'cart_badge_color',
                    'type' => 'color_rgba',
                    'title' => __( 'Color for cart number label', 'xstore' ),
                    'options' => array (
                        'show_buttons' => false,
                    ),
                    'output' => array(
                        'color' => '.header-color-inherit .et-wishlist-widget .wishlist-count, .header-color-dark .et-wishlist-widget .wishlist-count, .header-color-white .et-wishlist-widget .wishlist-count, .shopping-container .cart-bag .badge-number, .shopping-container.ico-design-1 .cart-bag .badge-number, .shopping-container.ico-design-2 .cart-bag .badge-number, .shopping-container.ico-design-3 .cart-bag .badge-number, .shopping-container.ico-design-4 .cart-bag .badge-number,.shopping-container.ico-design-1.ico-bg-yes .cart-bag .badge-number, .header-color-dark .shopping-container.ico-design-2 .cart-bag .badge-number,.header-color-dark .shopping-container.ico-design-3 .cart-bag .badge-number, .header-color-dark .shopping-container.ico-design-4 .cart-bag .badge-number, .header-wrapper .navbar-header .et-wishlist-widget .wishlist-count, .fixed-header .navbar-header .et-wishlist-widget .wishlist-count, .fixed-header .shopping-container .cart-bag .badge-number, .top-bar.topbar-color-white .shopping-container:not(.ico-design-1) .badge-number '
                    )
                ),
                array (
                    'id' => 'cart_badge_bg',
                    'type' => 'color_rgba',
                    'title' => __( 'Background color for cart number label', 'xstore' ),
                    'options' => array (
                        'show_buttons' => false,
                    ),
                    'output' => array(
                        'background-color' => '.header-color-inherit .et-wishlist-widget .wishlist-count, .header-color-dark .et-wishlist-widget .wishlist-count, .header-color-white .et-wishlist-widget .wishlist-count, .shopping-container .cart-bag .badge-number, .shopping-container.ico-design-2 .cart-bag .badge-number, .shopping-container.ico-design-3 .cart-bag .badge-number, .shopping-container.ico-design-1.ico-bg-yes .badge-number,.badge-number, .shopping-container.ico-design-1.ico-bg-yes .badge-number, .header-color-dark .shopping-container.ico-design-4 .badge-number, .header-wrapper .navbar-header .et-wishlist-widget .wishlist-count, .fixed-header .navbar-header .et-wishlist-widget .wishlist-count, .fixed-header .shopping-container.ico-design-2 .badge-number, .fixed-header .shopping-container.ico-design-3 .badge-number, .fixed-header .shopping-container .cart-bag .badge-number, .top-bar .shopping-container:not(.ico-design-1) .cart-bag .badge-number'
                    )
                ),
                array (
                    'id' => 'cart_icon_label',
                    'type' => 'select',
                    'title' => __( 'Label position', 'xstore' ),
                    'options' => array (
                        'top' => __( 'Top', 'xstore' ),
                        'bottom' => __( 'Bottom', 'xstore' ),
                    ),
                    'default' => 'top'
                ),
            ),
        ) );

        Redux::setSection( $opt_name, array(
            'title' => __( 'Secondary menu', 'xstore' ),
            'id' => 'general-header-secondary',
            'icon' => 'el-icon-cog',
            'subsection' => true,
            'fields' => array (
                array (
                    'id' => 'secondary_menu',
                    'type' => 'switch',
                    'title' => __( 'Enable secondary menu', 'xstore' ),
                    'default' => false,
                ),
                array (
                    'id' => 'secondary_menu_visibility',
                    'type' => 'select',
                    'title' => __( 'Secondary menu visibility', 'xstore' ),
                    'options' => array (
                        'opened' => __( 'Opened', 'xstore' ),
                        'on_click' => __( 'Opened by click', 'xstore' ),
                        'on_hover' => __( 'Opened on hover', 'xstore' ),
                    ),
                    'default' => 'on_hover',
                    'required' => array(
                        array( 'secondary_menu', 'equals', true )
                    )
                ),
                array (
                    'id' => 'secondary_menu_home',
                    'type' => 'switch',
                    'title' => __( 'For home page only', 'xstore' ),
                    'default' => true,
                    'required' => array(
                        array( 'secondary_menu_visibility', 'equals', 'opened')
                    )
                ),
                array (
                    'id' => 'secondary_menu_darkening',
                    'type' => 'switch',
                    'title' => __( 'Darkening', 'xstore' ),
                    'default' => true,
                    'required' => array(
                        array( 'secondary_menu_visibility', 'equals', array( 'on_click', 'on_hover'))
                    )
                ),
                array (
                    'id' => 'all_departments_text',
                    'type' => 'text',
                    'title' => __( 'All departments text', 'xstore' ),
                    'default' => __( 'All departments', 'xstore' ),
                    'required' => array(
                        array( 'secondary_menu', 'equals', true )
                    )
                ),
            ),
        ) );

        Redux::setSection( $opt_name, array(
            'title' => __( 'Breadcrumbs', 'xstore' ),
            'id' => 'general-header-breadcrumbs',
            'icon' => 'el-icon-cog',
            'subsection' => true,
            'fields' => array (
                array (
                    'id' => 'breadcrumb_type',
                    'type' => 'select',
                    'title' => __( 'Breadcrumbs Style', 'xstore' ),
                    'options' => array (
                        'default' => __( 'Align center', 'xstore' ),
                        'left' => __( 'Align left', 'xstore' ),
                        'left2' => __( 'Left inline', 'xstore' ),
                        'disable' => __( 'Disable', 'xstore' ),
                    ),
                    'default' => 'default'
                ),
                array (
                    'id' => 'breadcrumb_size',
                    'type' => 'select',
                    'title' => __( 'Breadcrumbs size', 'xstore' ),
                    'options' => array (
                        'small' => __( 'Small', 'xstore' ),
                        'large' => __( 'Large', 'xstore' ),
                    ),
                    'default' => 'large'
                ),
                array (
                    'id' => 'breadcrumb_effect',
                    'type' => 'select',
                    'title' => __( 'Breadcrumbs effect', 'xstore' ),
                    'options' => array (
                        'none' => __( 'None', 'xstore' ),
                        'mouse' => __( 'Parallax on mouse move', 'xstore' ),
                        'text-scroll' => __( 'Text animation on scroll', 'xstore' ),
                    ),
                    'default' => 'mouse'
                ),
                array (
                    'id' => 'breadcrumb_bg',
                    'type' => 'background',
                    'title' => __( 'Breadcrumbs background', 'xstore' ),
                    'default' => array(
                        'background-color' => '#dc5958',
                        'background-image' => 'http://8theme.com/import/xstore/wp-content/uploads/2016/05/breadcrumb-1.png'
                    )
                ),
                array (
                    'id' => 'breadcrumb_color',
                    'type' => 'select',
                    'title' => __( 'Breadcrumbs text color', 'xstore' ),
                    'options' => array (
                        'dark' => __( 'Dark', 'xstore' ),
                        'white' => __( 'White', 'xstore' ),
                    ),
                    'default' => 'white'
                ),
                array (
                    'id' => 'return_to_previous',
                    'type' => 'switch',
                    'title' => __( '"Back to previous page" button', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'breadcrumb_padding',
                    'type' => 'spacing',
                    'title' => __( 'Breadcrumbs padding', 'xstore' ),
                    'output' => array('.page-heading, .et-header-overlap .page-heading, .et-header-overlap .page-heading.bc-size-small, .page-heading.bc-size-small'),
                    'units'          => array('em', 'px'),
                    'units_extended' => 'false',
                    'default' => ''
                ),
                array (
                    'id' => 'bc_title_font',
                    'type' => 'typography',
                    'fonts' => $fonts_list,
                    'title' => __( 'Breadcrumbs title font', 'xstore' ),
                    'output' => '.page-heading .title, .page-heading.bc-size-small .title, .page-heading.bc-type-left2.bc-color-white .title .page-heading.bc-type-left2 .title, .page-heading.bc-type-left2.bc-color-white .title',
                    'text-align' => false,
                    'text-transform' => true,
                ),
                array (
                    'id' => 'bc_breadcrumbs_font',
                    'type' => 'typography',
                    'fonts' => $fonts_list,
                    'title' => __( 'Breadcrumbs font', 'xstore' ),
                    'output' => '.page-heading.bc-type-left2.bc-color-white .woocommerce-breadcrumb a, .woocommerce-breadcrumb, #breadcrumb, .bbp-breadcrumb, .woocommerce-breadcrumb a, #breadcrumb a, .bbp-breadcrumb a, .woocommerce-breadcrumb .delimeter, #breadcrumb .delimeter, .bbp-breadcrumb .delimeter, .page-heading.bc-type-left2 .back-history, .page-heading.bc-type-left2 .title, .page-heading.bc-type-left2 .woocommerce-breadcrumb a, .page-heading.bc-type-left .woocommerce-breadcrumb a, .page-heading.bc-type-left2 .breadcrumbs a',
                    'text-align' => false,
                    'text-transform' => true,
                ),
                array (
                    'id' => 'bc_return_font',
                    'type' => 'typography',
                    'fonts' => $fonts_list,
                    'title' => __( '"Return to previous page" font', 'xstore' ),
                    'output' => '.page-heading .back-history, .page-heading a.back-history, .page-heading.bc-type-left2.bc-color-white .back-history',
                    'text-align' => false,
                    'text-transform' => true,
                ),
            ),
        ) );


        Redux::setSection( $opt_name, array(
            'title' => 'Footer',
            'id' => 'general-footer',
            'subsection' => true,
            'icon' => 'el-icon-cog',
            'fields' => array (
                array (
                    'id' => 'footer_columns',
                    'type' => 'select',
                    'title' => __( 'Footer columns', 'xstore' ),
                    'options' => array (
                        1 => __( '1 Column', 'xstore' ),
                        2 => __( '2 Columns', 'xstore' ),
                        3 => __( '3 Columns', 'xstore' ),
                        4 => __( '4 Columns', 'xstore' ),
                    ),
                    'default' => 4
                ),
                array (
                    'id' => 'footer_demo',
                    'type' => 'switch',
                    'title' => __( 'Show footer demo blocks', 'xstore' ),
                    'desc' => __( 'Will be shown if footer sidebars are empty', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'footer_fixed',
                    'type' => 'switch',
                    'title' => __( 'Footer fixed', 'xstore' ),
                    'default' => false,
                ),
                array (
                    'id' => 'to_top',
                    'type' => 'switch',
                    'title' => __( '"Back To Top" button', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'to_top_mobile',
                    'type' => 'switch',
                    'title' => __( '"Back To Top" button on mobile', 'xstore' ),
                    'default' => true,
                ),
            ),
        ));

        Redux::setSection( $opt_name, array(
            'title' => __( '404 page', 'xstore' ),
            'id' => 'general-page-not-found',
            'subsection' => true,
            'icon' => 'el-icon-cog',
            'fields' => array (
                array (
                    'id' => '404_text',
                    'type' => 'editor',
                    'title' => __( '404 page content', 'xstore' )
                ),
            ),
        ));

        Redux::setSection( $opt_name, array(
            'title' => __( 'Facebook Login', 'xstore' ),
            'id' => 'general-facebook',
            'subsection' => true,
            'icon' => 'el-icon-facebook',
            'fields' => array (
                array(
                    'id'   => 'fb_info',
                    'type' => 'info',
                    'desc' => __( 'To create Facebook APP ID follow the instructions <a href="https://developers.facebook.com/docs/apps/register" target="_blank">https://developers.facebook.com/docs/apps/register</a>', 'xstore' )
                ),
                array (
                    'id' => 'facebook_app_id',
                    'type' => 'text',
                    'title' => __( 'Facebook APP ID', 'xstore' )
                ),
                array (
                    'id' => 'facebook_app_secret',
                    'type' => 'text',
                    'title' => __( 'Facebook APP SECRET', 'xstore' )
                ),
            ),
        ));


        Redux::setSection( $opt_name, array(
            'title' => __( 'Share buttons', 'xstore' ),
            'id' => 'general-share',
            'subsection' => true,
            'icon' => 'el-icon-share',
            'fields' => array (
                array (
                    'id' => 'share_twitter',
                    'type' => 'switch',
                    'title' => __( 'Share twitter', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'share_facebook',
                    'type' => 'switch',
                    'title' => __( 'Share facebook', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'share_vk',
                    'type' => 'switch',
                    'title' => __( 'Share vk', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'share_pinterest',
                    'type' => 'switch',
                    'title' => __( 'Share pinterest', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'share_google',
                    'type' => 'switch',
                    'title' => __( 'Share google', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'share_mail',
                    'type' => 'switch',
                    'title' => __( 'Share mail', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'share_linkedin',
                    'type' => 'switch',
                    'title' => __( 'Share linkedin', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'share_whatsapp',
                    'type' => 'switch',
                    'title' => __( 'Share whatsapp', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'share_skype',
                    'type' => 'switch',
                    'title' => __( 'Share skype', 'xstore' ),
                    'default' => true,
                ),
            ),
        ));

        Redux::setSection( $opt_name, array(
            'title' => __( 'Styling', 'xstore' ),
            'id' => 'style',
            'icon' => 'el-icon-picture',
        ) );

        Redux::setSection( $opt_name, array(
            'title' => __( 'Content', 'xstore' ),
            'id' => 'style-content',
            'icon' => 'el-icon-picture',
            'subsection' => true,
            'fields' => array (
                array (
                    'id' => 'dark_styles',
                    'type' => 'switch',
                    'title' => __( 'Dark version', 'xstore' ),
                ),
                array (
                    'id' => 'activecol',
                    'type' => 'color',
                    'title' => __( 'Main Color', 'xstore' ),
                    'default' => '#d64444'
                ),
                array (
                    'id' => 'background_img',
                    'type' => 'background',
                    'output' => 'body',
                    'title' => __( 'Site Background', 'xstore' ),
                ),

                array (
                    'id' => 'container_bg',
                    'type' => 'color_rgba',
                    'title' => __( 'Container Background Color', 'xstore' ),
                    'options' => array (
                        'show_buttons' => false,
                    ),
                    'output' => array(
                        'background-color' =>'article.content-timeline2 .timeline-content, .select2-results, .select2-drop, .select2-container .select2-choice, .form-control, .page-wrapper, .cart-popup-container, select, .quantity input[type="number"], .emodal, input[type="text"], input[type="email"], input[type="password"], input[type="tel"], input[type="url"], textarea, #searchModal, .quick-view-popup, #etheme-popup, .et-wishlist-widget .wishlist-dropdown, textarea.form-control, textarea'
                    )
                ),
                array (
                    'id' => 'forms_inputs_bg',
                    'type' => 'color_rgba',
                    'title' => __( 'Form inputs background color', 'xstore' ),
                    'options' => array (
                        'show_buttons' => false,
                    ),
                    'output' => array(
                        'background-color' =>'.select2-results, .select2-drop, .select2-container .select2-choice, .form-control, select, .quantity input[type="number"], .emodal, input[type="text"], input[type="email"], input[type="password"], input[type="tel"], input[type="url"], textarea, textarea.form-control, textarea, input[type="search"], .select2-container--default .select2-selection--single, .header-search.act-default input[type="text"], .header-wrapper.header-advanced .header-search.act-default input[type="text"], .header-wrapper.header-advanced .header-search.act-default div.fancy-select div.trigger'
                    )
                ),
                array (
                    'id' => 'forms_inputs_br',
                    'type' => 'color_rgba',
                    'title' => __( 'Form inputs border color', 'xstore' ),
                    'options' => array (
                        'show_buttons' => false,
                    ),
                    'output' => array(
                        'border-color' =>'.select2-results, .select2-drop, .select2-container .select2-choice, .form-control, select, .quantity input[type="number"], .emodal, input[type="text"], input[type="email"], input[type="password"], input[type="tel"], input[type="url"], textarea, textarea.form-control, textarea, .header-search.act-default input[type="text"], .header-wrapper.header-advanced .header-search.act-default input[type="text"], .header-wrapper.header-advanced .header-search.act-default div.fancy-select div.trigger, .header-wrapper.header-advanced .search-form-wrapper, .select2-container--default .select2-selection--single',
                    )
                ),
                array (
                    'id' => 'buttons-customize-container',
                    'title' => 'Customize buttons',
                    'type' => 'table_closer',
                    'columns' => 3,
                    'text' => 'Customize'
                ),
                    array (
                        'id' => 'light-buttons-column',
                        'title' => '',
                        'type' => 'custom_column_opener',
                        'column_title' => 'Light buttons options',
                    ),
                        array (
                            'id' => 'light_buttons_bg',
                            'type' => 'color_rgba',
                            'title' => 'Background color',
                            'output' => array( 'background-color' => 'input[type="submit"], .open-filters-btn .btn, .content-product .product-details .button, .woocommerce table.wishlist_table td.product-add-to-cart a, .woocommerce-Button' ),
                            'options' => array (
                                'show_buttons' => false,
                            ),
                        ),
                    
                        array (
                            'id' => 'light_buttons_color',
                            'type' => 'link_color',
                            'title' => 'Buttons text colors',
                            'output' => 'input[type="submit"], .open-filters-btn .btn, .content-product .product-details .button, .woocommerce table.wishlist_table td.product-add-to-cart a, .woocommerce-Button',
                            'hover' => false,
                        ),

                        array (
                            'id' => 'light_buttons_border',
                            'type' => 'border',
                            'title' => 'Buttons border',
                            'output' => 'input[type="submit"], .open-filters-btn .btn, .content-product .product-details .button, .woocommerce table.wishlist_table td.product-add-to-cart a, .woocommerce-Button',
                            'all' => false,
                            'default' => array (
                                'border-style' => 'solid',
                                'border-color' => '#f2f2f2'
                            ),
                        ),
                         array (
                            'id' => 'light_buttons_border_radius',
                            'title' => 'Buttons border radius',
                            'type' => 'border',
                            'all' => false,
                            'style' => false,
                            'color' => false,
                            'default' => array (
                                'border-top'    => '0px', 
                                'border-right'  => '0px', 
                                'border-bottom' => '0px', 
                                'border-left'   => '0px'
                            ),
                        ),
                     array (
                        'id' => 'light-buttons-column-closer',
                        'title' => false,
                        'type' => 'custom_column_closer',
                    ),

                    array (
                        'id' => 'dark-buttons-column',
                        'title' => false,
                        'type' => 'custom_column_opener',
                        'column_title' => 'Dark buttons options',
                    ),
                         array (
                            'id' => 'dark_buttons_bg',
                            'type' => 'color_rgba',
                            'title' => false,
                            'title' => 'Background color',
                            'output' => array( 'background-color' => ' .et-wishlist-widget .wishlist-dropdown .buttons .btn-view-wishlist, .before-checkout-form .button, .checkout-button, .shipping-calculator-form .button, .single_add_to_cart_button, .shopping-container .btn-view-cart, form.login .button, form.register .button, .price_slider_wrapper .button, .empty-cart-block .btn' ),
                            'options' => array (
                                'show_buttons' => false,
                            ),
                        ),
                        array (
                            'id' => 'dark_buttons_color',
                            'type' => 'link_color',
                            'title' => 'Buttons text colors',
                            'output' => '.et-wishlist-widget .wishlist-dropdown .buttons .btn-view-wishlist, .before-checkout-form .button, .checkout-button, .shipping-calculator-form .button, .single_add_to_cart_button, .single_add_to_cart_button:focus, .shopping-container .btn-view-cart, form.login .button, form.register .button, .price_slider_wrapper .button, .empty-cart-block .btn',
                            'hover' => false,
                        ),
                        array (
                            'id' => 'dark_buttons_border',
                            'type' => 'border',
                            'title' => 'Buttons border',
                            'output' => '.et-wishlist-widget .wishlist-dropdown .buttons .btn-view-wishlist, .before-checkout-form .button, .checkout-button, .shipping-calculator-form .button, .single_add_to_cart_button, .shopping-container .btn-view-cart, form.login .button, form.register .button, .price_slider_wrapper .button, .empty-cart-block .btn',
                            'all' => false,
                            'default' => array (
                                'border-style' => 'solid',
                                'border-color' => '#262626'
                            ),
                            'required' => array (
                            ),
                        ),
                        array (
                            'id' => 'dark_buttons_border_radius',
                            'title' => 'Buttons border radius',
                            'type' => 'border',
                            'all' => false,
                            'style' => false,
                            'color' => false,
                            'default' => array (
                                'border-top'    => '0px', 
                                'border-right'  => '0px', 
                                'border-bottom' => '0px', 
                                'border-left'   => '0px'
                            ),
                        ),
                    array (
                        'id' => 'dark-buttons-column-closer',
                        'title' => '',
                        'type' => 'custom_column_closer',
                    ),
                    array (
                        'id' => 'active-buttons-column',
                        'title' => false,
                        'type' => 'custom_column_opener',
                        'column_title' => 'Active buttons options',
                    ),
                        array (
                            'id' => 'active_buttons_bg',
                            'type' => 'color_rgba',
                            'title' => false,
                            'title' => 'Background color',
                            'output' => array( 'background-color' => '.btn-checkout, .form-submit input[type="submit"], .form-row.place-order input[type="submit"]' ),
                            'options' => array (
                                'show_buttons' => false,
                            ),
                        ),
                        array (
                            'id' => 'active_buttons_color',
                            'type' => 'link_color',
                            'title' => 'Buttons text colors',
                            'output' => '.btn-checkout, .form-submit input[type="submit"], .form-row.place-order input[type="submit"], .form-submit input[type="submit"]:focus',
                            'hover' => false,
                        ),
                        array (
                            'id' => 'active_buttons_border',
                            'type' => 'border',
                            'title' => 'Buttons border',
                            'output' => '.btn-checkout, .form-submit input[type="submit"], .form-row.place-order input[type="submit"]',
                            'all' => false,
                            'default' => array (
                                'border-style' => 'solid',
                                'border-color' => '#f2f2f2'
                            ),
                        ),
                        array (
                            'id' => 'active_buttons_border_radius',
                            'title' => 'Buttons border radius',
                            'type' => 'border',
                            'all' => false,
                            'style' => false,
                            'color' => false,
                            'default' => array (
                                'border-top'    => '0px', 
                                'border-right'  => '0px', 
                                'border-bottom' => '0px', 
                                'border-left'   => '0px'
                            ),
                        ),  
                    array (
                        'id' => 'active-buttons-column-closer',
                        'title' => '',
                        'type' => 'custom_column_closer',
                    ),

                 array (
                    'id' => 'buttons-container-closer',
                    'type' => 'table_opener',
                ),

                 array (
                    'id' => 'buttons-hoverCustomize-container',
                    'title' => 'Customize buttons on hover state',
                    'type' => 'table_closer',
                    'columns' => 3,
                    'text' => 'Customize'
                ),
                array (
                    'id' => 'light-buttons-hover-column',
                    'title' => false,
                    'type' => 'custom_column_opener',
                    'column_title' => 'Light buttons options (hover)',
                ),
                    array (
                        'id' => 'light_buttons_bg_hover',
                        'type' => 'color_rgba',
                        'title' => 'Background color',
                        'output' => array( 'background-color' => 'input[type="submit"]:hover, .open-filters-btn .btn:hover, .content-product .product-details .button:hover, .woocommerce table.wishlist_table td.product-add-to-cart a:hover, .woocommerce-Button:hover' ),
                        'options' => array (
                            'show_buttons' => false,
                        ),
                    ),
                    array (
                        'id' => 'light_buttons_color_hover',
                        'type' => 'link_color',
                        'title' => 'Buttons text colors',
                        'output' => 'input[type="submit"], .open-filters-btn .btn, .content-product .product-details .button, .woocommerce table.wishlist_table td.product-add-to-cart a, .woocommerce-Button',
                        'regular' => false,
                        'active' => false,
                    ),
                    
                    array (
                        'id' => 'light_buttons_border_hover',
                        'type' => 'border',
                        'title' => 'Buttons border',
                        'output' => 'input[type="submit"]:hover, .open-filters-btn .btn:hover, .content-product .product-details .button:hover, .woocommerce table.wishlist_table td.product-add-to-cart a:hover, .woocommerce-Button:hover',
                        'all' => false,
                        'default' => array (
                            'border-style' => 'solid',
                        ),
                    ),

                array (
                    'id' => 'light-buttons-hover-column-closed',
                    'title' => '',
                    'type' => 'custom_column_closer',
                ),
                array (
                    'id' => 'dark-buttons-hover-column',
                    'title' => '',
                    'type' => 'custom_column_opener',
                    'column_title' => 'Dark buttons options (hover)',
                ),

                    array (
                        'id' => 'dark_buttons_bg_hover',
                        'type' => 'color_rgba',
                        'title' => 'Background color',
                        'output' => array( 'background-color' => ' .et-wishlist-widget .wishlist-dropdown .buttons .btn-view-wishlist:hover, .before-checkout-form .button:hover, .checkout-button:hover, .shipping-calculator-form .button:hover, .single_add_to_cart_button:hover, .shopping-container .btn-view-cart:hover, .form-row.place-order input[type="submit"]:hover, form.login .button:hover, form.register .button:hover, .price_slider_wrapper .button:hover, .empty-cart-block .btn:hover' ),
                        'options' => array (
                            'show_buttons' => false,
                        ),
                    ),
                 
                    
                    array (
                        'id' => 'dark_buttons_color_hover',
                        'type' => 'link_color',
                        'title' => 'Buttons text colors',
                        'output' => '.et-wishlist-widget .wishlist-dropdown .buttons .btn-view-wishlist, .before-checkout-form .button, .checkout-button, .shipping-calculator-form .button, .single_add_to_cart_button, .shopping-container .btn-view-cart,  .form-row.place-order input[type="submit"], form.login .button, form.register .button, .price_slider_wrapper .button, .empty-cart-block .btn',
                        'regular' => false,
                        'active' => false,
                    ),
                    
                    array (
                        'id' => 'dark_buttons_border_hover',
                        'type' => 'border',
                        'title' => 'Buttons border',
                        'output' => '.et-wishlist-widget .wishlist-dropdown .buttons .btn-view-wishlist:hover, .before-checkout-form .button:hover, .checkout-button:hover, .shipping-calculator-form .button:hover, .single_add_to_cart_button:hover, .shopping-container .btn-view-cart:hover, .form-row.place-order input[type="submit"]:hover, form.login .button:hover, form.register .button:hover, .price_slider_wrapper .button:hover, .empty-cart-block .btn:hover',
                        'all' => false,
                        'default' => array (
                            'border-style' => 'solid',
                        ),
                    ),
                array (
                    'id' => 'dark-buttons-hover-column-closed',
                    'title' => '',
                    'type' => 'custom_column_closer',
                ),
                array (
                    'id' => 'active-buttons-hover-column',
                    'title' => '',
                    'type' => 'custom_column_opener',
                    'column_title' => 'Active buttons options (hover)',
                ),
               
                    array (
                        'id' => 'active_buttons_bg_hover',
                        'type' => 'color_rgba',
                        'title' => 'Background color',
                        'output' => array( 'background-color' => '.btn-checkout:hover, .form-submit input[type="submit"]:hover, .form-row.place-order input[type="submit"]:hover' ),
                        'options' => array (
                            'show_buttons' => false,
                        ),
                    ),
                   
                    array (
                        'id' => 'active_buttons_color_hover',
                        'type' => 'link_color',
                        'title' => 'Buttons text colors',
                        'output' => '.btn-checkout, .form-submit input[type="submit"], .form-row.place-order input[type="submit"]',
                        'regular' => false,
                        'active' => false,
                    ),
                   
                    array (
                        'id' => 'active_buttons_border_hover',
                        'type' => 'border',
                        'title' => 'Buttons border',
                        'output' => '.btn-checkout:hover, .form-submit input[type="submit"]:hover, .form-row.place-order input[type="submit"]:hover',
                        'all' => false,
                        'default' => array (
                            'border-style' => 'solid',
                        ),
                    ),
                array (
                    'id' => 'active-buttons-hover-column-closed',
                    'title' => '',
                    'type' => 'custom_column_closer',
                ),
                array (
                    'id' => 'buttons-hoverCustomize-container-closed',
                    'title' => '',
                    'type' => 'table_opener',
                ),
            ),
        ));

        
        Redux::setSection( $opt_name, array(
            'title' => __( 'Navigation', 'xstore' ),
            'id' => 'style-nav',
            'icon' => 'el-icon-picture',
            'subsection' => true,
            'fields' => array (
                array (
                    'id' => 'menu_align',
                    'type' => 'select',
                    'title' => __( 'Menu links align', 'xstore' ),
                    'options' => array (
                        'center' => __( 'Center', 'xstore' ),
                        'left' => __( 'Left', 'xstore' ),
                        'right' => __( 'Right', 'xstore' ),
                    ),
                    'default' => 'center'
                ),
                array (
                    'id' => 'menu-links-customize-container',
                    'title' => 'Main menu links',
                    'type' => 'table_closer',
                    'add_info' => 'Text styles you can adjust from Typography -> Navigation',
                    'columns' => 2,
                    'text' => 'Customize'
                ),
                    array (
                        'id' => 'menu-links-styles',
                        'title' => '',
                        'type' => 'custom_column_opener',
                        'column_title' => __('Menu links', 'xstore'),
                    ),
                    array (
                        'id' => 'menu-background',
                        'title' => 'Background color',
                        'type' => 'color_rgba',
                        'options' => array (
                            'show_buttons' => false,
                        ),
                        'output' => array( 'background-color' => '.menu-wrapper .menu > li, .secondary-title, .fullscreen-menu .menu > li, .fullscreen-menu .menu > li, .header-wrapper.header-advanced .menu-wrapper .menu > li',
                         ),
                    ),
                    array (
                        'id' => 'menu-border-width',
                        'title' => 'Border width',
                        'type' => 'border',
                        'color' => false,
                        'all' => false,
                        'style' => false,
                        'output' => '.menu-wrapper .menu > li, .secondary-title, .fullscreen-menu .menu > li, .fullscreen-menu .menu > li, .header-wrapper.header-advanced .menu-wrapper .menu > li',
                    ),
                     array (
                        'id' => 'menu-border-style',
                        'title' => 'Border style',
                        'type' => 'border',
                        'color' => false,
                        'all' => false,
                        'left' => false,
                        'right' => false,
                        'top' => false,
                        'bottom' => false,
                        'default' => array (
                            'border-style' => 'none'
                        ),
                    ),
                    array (
                        'id' => 'menu-border-color',
                        'title' => 'Border color',
                        'type' => 'color_rgba',
                        'options' => array (
                            'show_buttons' => false,
                        ),
                        'output' => array( 'border-color' => '.menu-wrapper .menu > li, .secondary-title, .fullscreen-menu .menu > li, .fullscreen-menu .menu > li, .header-wrapper.header-advanced .menu-wrapper .menu > li'),
                    ),
                    array (
                        'id' => 'menu-links-border-radius',
                        'title' => 'Border radius',
                        'type' => 'border',
                        'color' => false,
                        'all' => false,
                        'style' => false,
                    ),
                    array (
                        'id' => 'menu-links-divider-bottom',
                        'title' => 'Underline color',
                        'type' => 'color_rgba',
                        'options' => array (
                            'show_buttons' => false,
                        ),
                        'output' => array ('background-color' => '.menu-wrapper .menu > li > a:after, .menu-wrapper .menu > li.current-menu-item > a:after, .header-color-dark .menu-wrapper .menu > li > a:hover:after, .header-color-white .menu-wrapper .menu > li > a:hover:after, .header-color-dark .menu-wrapper .menu > li > a:after, .header-color-white .menu-wrapper .menu > li > a:after, .header-color-dark .menu-wrapper .menu > li.current-menu-item > a:after, .header-color-white .menu-wrapper .menu > li.current-menu-item > a:after')
                    ),
                    array (
                        'id' => 'menu-links-padding',
                        'title' => 'Padding',
                        'type' => 'spacing',
                        'output' => '.menu-wrapper .menu > li, .header-smart-responsive .page-wrapper .header-wrapper .menu-main-container .menu > li',
                        'units' => array ( 'px', '%', 'em' ),
                    ),
                    array (
                        'id' => 'menu-links-styles-closer',
                        'title' => false,
                        'type' => 'custom_column_closer',
                    ),

                    array (
                        'id' => 'menu-links-styles_hover',
                        'title' => '',
                        'type' => 'custom_column_opener',
                        'column_title' => __('Menu links on hover', 'xstore'),
                    ),
                    array (
                        'id' => 'menu-background-hover',
                        'title' => 'Background color',
                        'type' => 'color_rgba',
                        'options' => array (
                            'show_buttons' => false,
                        ),
                        'output' => array( 'background-color' => '.menu-wrapper .menu > li:hover, .secondary-title:hover, .fullscreen-menu .menu > li:hover, .fullscreen-menu .menu > li:hover, .header-wrapper.header-advanced .menu-wrapper .menu > li:hover'),
                    ),
                    array (
                        'id' => 'menu-border-width-hover',
                        'title' => 'Border width',
                        'type' => 'border',
                        'color' => false,
                        'all' => false,
                        'style' => false,
                        'output' => '.menu-wrapper .menu > li:hover, .secondary-title:hover, .fullscreen-menu .menu > li:hover, .fullscreen-menu .menu > li:hover, .header-wrapper.header-advanced .menu-wrapper .menu > li:hover',
                    ),
                    array (
                        'id' => 'menu-border-style-hover',
                        'title' => 'Border style',
                        'type' => 'border',
                        'color' => false,
                        'all' => false,
                        'left' => false,
                        'right' => false,
                        'top' => false,
                        'bottom' => false,
                        'default' => array (
                            'border-style' => 'none',
                        ),
                        'output' => '.menu-wrapper .menu > li:hover, .secondary-title:hover, .fullscreen-menu .menu > li:hover, .fullscreen-menu .menu > li:hover, .header-wrapper.header-advanced .menu-wrapper .menu > li:hover',
                    ),
                    array (
                        'id' => 'menu-border-color-hover',
                        'title' => 'Border color',
                        'type' => 'color_rgba',
                        'options' => array (
                            'show_buttons' => false,
                        ),
                        'output' => array( 'border-color' => '.menu-wrapper .menu > li:hover, .secondary-title:hover, .fullscreen-menu .menu > li:hover, .fullscreen-menu .menu > li:hover, .header-wrapper.header-advanced .menu-wrapper .menu > li:hover'),
                    ),
                    array (
                        'id' => 'menu-links-styles_hover_closer',
                        'title' => false,
                        'type' => 'custom_column_closer',
                    ),
                array (
                    'id' => 'menu-links-container-closer',
                    'type' => 'table_opener',
                ),

                array (
                    'id' => 'menu-links-customize-container_f',
                    'title' => 'Fixed menu links',
                    'type' => 'table_closer',
                    'add_info' => 'Text styles you can adjust from Typography -> Navigation',
                    'columns' => 2,
                    'text' => 'Customize'
                ),
                    array (
                        'id' => 'f_menu-links-styles',
                        'title' => '',
                        'type' => 'custom_column_opener',
                        'column_title' => __('Menu links', 'xstore'),
                    ),
                    array (
                        'id' => 'f_menu-background',
                        'title' => 'Background color',
                        'type' => 'color_rgba',
                        'options' => array (
                            'show_buttons' => false,
                        ),
                        'output' => array( 'background-color' => '.fixed-header .menu-wrapper .menu > li',
                         ),
                    ),
                    array (
                        'id' => 'f_menu-border-width',
                        'title' => 'Border width',
                        'type' => 'border',
                        'color' => false,
                        'all' => false,
                        'style' => false,
                        'output' => '.fixed-header .menu-wrapper .menu > li',
                    ),
                     array (
                        'id' => 'f_menu-border-style_s',
                        'title' => 'Border style',
                        'type' => 'border',
                        'color' => false,
                        'all' => false,
                        'left' => false,
                        'right' => false,
                        'top' => false,
                        'bottom' => false,
                        'default' => array (
                            'border-style' => 'none'
                        ),
                    ),
                    array (
                        'id' => 'f_menu-border-color',
                        'title' => 'Border color',
                        'type' => 'color_rgba',
                        'options' => array (
                            'show_buttons' => false,
                        ),
                        'output' => array( 'border-color' => '.fixed-header .menu-wrapper .menu > li'),
                    ),
                    array (
                        'id' => 'f_menu-links-border-radius',
                        'title' => 'Border radius',
                        'type' => 'border',
                        'color' => false,
                        'all' => false,
                        'style' => false,
                    ),
                    array (
                        'id' => 'f_menu-links-divider-bottom',
                        'title' => 'Underline color',
                        'type' => 'color_rgba',
                        'options' => array (
                            'show_buttons' => false,
                        ),
                        'output' => array ('background-color' => '.fixed-header .menu-wrapper .menu > li > a:after, .fixed-header .menu-wrapper .menu > li > a:hover:after'),
                    ),
                    array (
                        'id' => 'f_menu-links-padding',
                        'title' => 'Padding',
                        'type' => 'spacing',
                        'output' => '.fixed-header .menu-wrapper .menu > li, .header-smart-responsive .fixed-header .menu-wrapper .menu > li',
                        'units' => array ( 'px', '%', 'em' ),
                    ),
                    array (
                        'id' => 'f_menu-links-styles-closer',
                        'title' => false,
                        'type' => 'custom_column_closer',
                    ),

                    array (
                        'id' => 'f_menu-links-styles_hover',
                        'title' => '',
                        'type' => 'custom_column_opener',
                        'column_title' => __('Menu links on hover', 'xstore'),
                    ),
                    array (
                        'id' => 'f_menu-background-hover',
                        'title' => 'Background color',
                        'type' => 'color_rgba',
                        'options' => array (
                            'show_buttons' => false,
                        ),
                        'output' => array( 'background-color' => '.fixed-header .menu-wrapper .menu > li:hover'),
                    ),
                    array (
                        'id' => 'f_menu-border-width-hover',
                        'title' => 'Border width',
                        'type' => 'border',
                        'color' => false,
                        'all' => false,
                        'style' => false,
                        'output' => '.fixed-header .menu-wrapper .menu > li:hover',
                    ),
                    array (
                        'id' => 'f_menu-border-style-hover',
                        'title' => 'Border style',
                        'type' => 'border',
                        'color' => false,
                        'all' => false,
                        'left' => false,
                        'right' => false,
                        'top' => false,
                        'bottom' => false,
                        'default' => array (
                            'border-style' => 'none',
                        ),
                        'output' => '.fixed-header .menu-wrapper .menu > li:hover',
                    ),
                    array (
                        'id' => 'f_menu-border-color-hover',
                        'title' => 'Border color',
                        'type' => 'color_rgba',
                        'options' => array (
                            'show_buttons' => false,
                        ),
                        'output' => array( 'border-color' => '.fixed-header .menu-wrapper .menu > li:hover'),
                    ),
                    array (
                        'id' => 'f_menu-links-styles_hover_closer',
                        'title' => false,
                        'type' => 'custom_column_closer',
                    ),
                array (
                    'id' => 'menu-links-container-closer_f',
                    'type' => 'table_opener',
                ),

                array (
                    'id' => 'dropdown-links-customize-container',
                    'title' => 'Dropdown options',
                    'type' => 'table_closer',
                    'columns' => 2,
                    'add_info' => 'Text styles you can adjust from Typography -> Navigation',
                    'text' => 'Customize',
                    'container_title' => 'Menu dropdown (Mega menu)',
                ),
                array (
                    'id' => 'dropdown-links-styles',
                    'title' => '',
                    'type' => 'custom_column_opener',
                    'column_title' => false,
                ),
                    array (
                        'id' => 'menu_dropdown_bg',
                        'type' => 'color_rgba',
                        'title' => __('Dropdown background', 'xstore'),
                        'output' => array ( 'background-color' => '.nav-sublist-dropdown' ),
                        'options' => array (
                            'show_buttons'=> false,
                        ),
                    ),
                    array (
                        'id' => 'menu_dropdown_border_color',
                        'type' => 'color_rgba',
                        'title' => __('Dropdown border color', 'xstore'),
                        'output' => array ( 'border-color' => '.nav-sublist-dropdown, .header-smart-responsive .fixed-header .menu-more .nav-sublist-dropdown, .header-smart-responsive .header-wrapper .menu-more .nav-sublist-dropdown' ),
                        'options' => array (
                            'show_buttons'=> false,
                        ),
                    ),
                    array (
                        'id' => 'menu_dropdown_links_bg',
                        'type' => 'color_rgba',
                        'title' => __('Dropdown links background', 'xstore'),
                        'output' => array ( 'background-color' => '.item-design-mega-menu .nav-sublist-dropdown .nav-sublist a, .item-design-dropdown .nav-sublist-dropdown ul > li > a'),
                        'options' => array (
                            'show_buttons'=> false,
                        ),
                    ),
                    array (
                        'id' => 'menu_dropdown_links_bg_hover',
                        'type' => 'color_rgba',
                        'title' => __('Dropdown links background on hover', 'xstore'),
                        'output' => array ( 'background-color' => '.item-design-mega-menu .nav-sublist-dropdown .nav-sublist a:hover, .item-design-dropdown .nav-sublist-dropdown ul > li > a:hover'),
                        'options' => array (
                            'show_buttons'=> false,
                        ),
                    ),
                    array (
                        'id' => 'menu_dropdown_divider',
                        'type' => 'color_rgba',
                        'title' => __('Divider color', 'xstore'),
                        'output' => array ( 'border-color' => '.item-design-mega-menu .nav-sublist-dropdown .item-level-1.menu-item-has-children'),
                        'options' => array (
                            'show_buttons'=> false,
                        ),
                    ),
                    
                array (
                    'id' => 'dropdown-links-styles-closer',
                    'title' => false,
                    'type' => 'custom_column_closer',
                ),

                array (
                    'id' => 'dropdown-links-styles_hover',
                    'title' => '',
                    'type' => 'custom_column_opener',
                    'column_title' => '',
                ),
                    array (
                        'id' => 'menu_dropdown_links_padding',
                        'title' => 'Paddings',
                        'type' => 'spacing',
                        'output' => '.item-design-mega-menu .nav-sublist-dropdown > .container > ul',
                        'units' => array ( 'px', '%', 'em' ),
                    ),
                    array (
                        'id' => 'menu_dropdown_border',
                        'type' => 'border',
                        'color' => false,
                        'all' => false,
                        'style' => false,
                        'title' => __('Dropdown border width', 'xstore'),
                        'output' => '.nav-sublist-dropdown',
                    ),
                    array (
                        'id' => 'menu_dropdown_border_style',
                        'type' => 'border',
                        'color' => false,
                        'all' => false,
                        'left' => false,
                        'right' => false,
                        'top' => false,
                        'bottom' => false,
                        'default' => array (
                            'border-style' => 'solid',
                        ),
                        'title' => __('Dropdown border style', 'xstore'),
                    ),
                array (
                    'id' => 'dropdown-links-styles_hover_closer',
                    'title' => false,
                    'type' => 'custom_column_closer',
                ),
                array (
                'id' => 'dropdown-container-closer',
                'type' => 'table_opener',
                ),
                array (
                    'id' => 'mobile-links-customize-container',
                    'title' => 'Mobile menu links',
                    'type' => 'table_closer',
                    'add_info' => 'Text styles you can adjust from Typography -> Navigation',
                    'container_title' => 'Mobile menu',
                    'columns' => 2,
                    'text' => 'Customize'
                ),
                    array (
                        'id' => 'mobile-links-styles',
                        'title' => '',
                        'type' => 'custom_column_opener',
                        'column_title' => false,
                    ),
                        array (
                            'id' => 'mobile_bg',
                            'title' => 'Background color',
                            'type' => 'color_rgba',
                            'options' => array (
                                'show_buttons' => false,
                            ),
                            'output' => array ( 'background-color' => '.mobile-menu-wrapper, .mobile-menu-wrapper .menu > li .sub-menu' )
                        ),
                        array (
                            'id' => 'mobile_search_bg',
                            'title' => 'Background color for mobile title & search area',
                            'type' => 'color_rgba',
                            'options' => array (
                                'show_buttons' => false,
                            ),
                            'output' => array ( 'background-color' => '.mobile-menu-wrapper .header-search.act-default, .mobile-menu-wrapper .menu > li .sub-menu .menu-back',
                                'border-top-color' => '.mobile-menu-wrapper .menu > li .sub-menu .menu-back:after',
                                'border-color' => '.mobile-menu-wrapper .header-search.act-default, .mobile-menu-wrapper .menu > li .sub-menu .menu-back' )
                        ),
                        array (
                            'id' => 'mobile_search_input_bg',
                            'title' => 'Background color for search input',
                            'type' => 'color_rgba',
                            'options' => array (
                                'show_buttons' => false,
                            ),
                            'output' => array ( 'background-color' => '.mobile-menu-wrapper .header-search.act-default .search-btn' )
                        ),
                        array (
                            'id' => 'mobile_search_input_active_bg',
                            'title' => 'Background color for search input (active state)',
                            'type' => 'color_rgba',
                            'options' => array (
                                'show_buttons' => false,
                            ),
                            'output' => array ( 'background-color' => '.mobile-menu-wrapper .header-search.act-default input[type="text"]' )
                        ),
                    array (
                        'id' => 'mobile-links-styles_closer',
                        'title' => '',
                        'type' => 'custom_column_closer',
                    ),
                    array (
                        'id' => 'mobile-links-styles2',
                        'title' => '',
                        'type' => 'custom_column_opener',
                    ),
                        array (
                            'id' => 'mobile_search_input_border_width',
                            'title' => 'Border width for search input ',
                            'type' => 'border',
                            'all' => false,
                            'color' => false,
                            'default' => array (
                                'border-style' => 'none',
                            ),
                            'output' => array( 'border-width' => '.mobile-menu-wrapper .header-search.act-default .search-btn, .mobile-menu-wrapper .header-search.act-default input[type="text"]', 
                                                'border-style' => '.mobile-menu-wrapper .header-search.act-default .search-btn, .mobile-menu-wrapper .header-search.act-default input[type="text"]',
                            ),
                        ),
                        array (
                            'id' => 'mobile_search_input_border_color',
                            'title' => 'Border color for search input ',
                            'type' => 'color_rgba',
                            'options' => array (
                                'show_buttons' => false,
                            ),
                            'output' => array( 'border-color' => '.mobile-menu-wrapper .header-search.act-default .search-btn, .mobile-menu-wrapper .header-search.act-default input[type="text"]'),
                        ),
                        array (
                            'id' => 'mobile_divider_bg',
                            'title' => 'Divider color',
                            'type' => 'color_rgba',
                            'options' => array (
                                'show_buttons' => false,
                            ),
                            'output' => array ( 'border-color' => '.mobile-menu-wrapper .menu > li, .mobile-menu-wrapper .links li, .mobile-menu-wrapper .links, .mobile-menu-wrapper .mobile-sidebar-widget.etheme_widget_socials, .mobile-menu-wrapper .menu > li .sub-menu li',
                            )
                        ),
                    array (
                        'id' => 'mobile-links-styles2_closer',
                        'title' => '',
                        'type' => 'custom_column_closer',
                    ),
                array (
                    'id' => 'mobile-links-customize-container_closer',
                    'title' => false,
                    'type' => 'table_opener',
                ),
            ),
        ));

        Redux::setSection( $opt_name, array(
            'title' => __( 'Footer', 'xstore' ),
            'id' => 'style-footer',
            'subsection' => true,
            'icon' => 'el-icon-cog',
            'fields' => array (
                array (
                    'id' => 'footer_color',
                    'type' => 'select',
                    'title' => __( 'Footer text color scheme', 'xstore' ),
                    'options' => array (
                        'light' => __( 'Light', 'xstore' ),
                        'dark' => __( 'Dark', 'xstore' ),
                    ),
                    'default' => 'light'
                ),
                array (
                    'id' => 'footer-links',
                    'type' => 'link_color',
                    'title' => __( 'Footer Links', 'xstore' ),
                    'output' => array('.template-container .template-content .footer a, .template-container .template-content .footer .vc_wp_posts .widget_recent_entries li a')
                ),
                array (
                    'id' => 'footer_bg_color',
                    'type' => 'background',
                    'title' => __( 'Footer Background Color', 'xstore' ),
                    'output' => array(
                        'background' => 'footer.footer'
                    )
                ),
                array (
                    'id' => 'footer_padding',
                    'type' => 'spacing',
                    'title' => __( 'Footer padding', 'xstore' ),
                    'output' => array('.footer'),
                    'units'          => array('em', 'px'),
                    'units_extended' => 'false',
                    'default' => ''
                ),
            ),
        ));

        Redux::setSection( $opt_name, array(
            'title' => __( 'Copyrights', 'xstore' ),
            'id' => 'style-copyrights',
            'subsection' => true,
            'icon' => 'el-icon-cog',
            'fields' => array (
                array (
                    'id' => 'copyrights_color',
                    'type' => 'select',
                    'title' => __( 'Copyrights text color scheme', 'xstore' ),
                    'options' => array (
                        'light' => __( 'Light', 'xstore' ),
                        'dark' => __( 'Dark', 'xstore' ),
                    ),
                    'default' => 'light'
                ),
                array (
                    'id' => 'copyrights-links',
                    'type' => 'link_color',
                    'title' => __( 'Copyrights Links', 'xstore' ),
                    'output' => array('.footer-bottom a')
                ),
                array (
                    'id' => 'copyrights_bg_color',
                    'type' => 'background',
                    'title' => __( 'Copyrights Background Color', 'xstore' ),
                    'output' => array(
                        'background' => '.footer-bottom'
                    )
                ),
                array (
                    'id' => 'copyrights_padding',
                    'type' => 'spacing',
                    'title' => __( 'Copyrights padding', 'xstore' ),
                    'output' => array('.footer-bottom'),
                    'units'          => array('em', 'px'),
                    'units_extended' => 'false',
                    'default' => ''
                ),
            ),
        ));
        
        Redux::setSection( $opt_name, array(
            'title' => __( 'Custom CSS', 'xstore' ),
            'id' => 'style-custom_css',
            'icon' => 'el-icon-css',
            'subsection' => true,
            'fields' => array (
                array (
                    'id' => 'custom_css',
                    'type' => 'ace_editor',
                    'mode' => 'css',
                    'title' => __( 'Global Custom CSS', 'xstore' ),
                ),
                array (
                    'id' => 'custom_css_desktop',
                    'type' => 'ace_editor',
                    'mode' => 'css',
                    'title' => __( 'Custom CSS for desktop (992px+)', 'xstore' ),
                ),
                array (
                    'id' => 'custom_css_tablet',
                    'type' => 'ace_editor',
                    'mode' => 'css',
                    'title' => __( 'Custom CSS for tablet (768px - 991px)', 'xstore' ),
                ),
                array (
                    'id' => 'custom_css_wide_mobile',
                    'type' => 'ace_editor',
                    'mode' => 'css',
                    'title' => __( 'Custom CSS for mobile landscape (481px - 767px)', 'xstore' ),
                ),
                array (
                    'id' => 'custom_css_mobile',
                    'type' => 'ace_editor',
                    'mode' => 'css',
                    'title' => __( 'Custom CSS for mobile (0 - 420px)', 'xstore' ),
                ),
            ),
        ));

        Redux::setSection( $opt_name, array(
            'title' => __( 'Typography', 'xstore' ),
            'id' => 'typography',
            'icon' => 'el-icon-font',
        ));

        Redux::setSection( $opt_name, array(
            'title' => __( 'Page', 'xstore' ),
            'id' => 'typography-page',
            'icon' => 'el-icon-font',
            'subsection' => true,
            'fields' => array(
                array (
                    'id' => 'sfont',
                    'type' => 'typography',
                    'fonts' => $fonts_list,
                    'title' => __( 'Body Font', 'xstore' ),
                    'output' => 'body, .quantity input[type="number"], .page-wrapper, p',
                    'text-align' => false,
                    'text-transform' => true,
                ),
                array (
                    'id' => 'headings',
                    'type' => 'typography',
                    'fonts' => $fonts_list,
                    'title' => __( 'Headings', 'xstore' ),
                    'output' => 'h1, h2, h3, h4, h5, h6, .title h3, blockquote, .share-post .share-title, .sidebar-widget .tabs .tab-title, .widget-title, .related-posts .title span, .posts-slider article h2 a, .content-product .product-title a, table.cart .product-details a, .product_list_widget .product-title a, .woocommerce table.wishlist_table .product-name a, .comment-reply-title, .et-tabs .vc_tta-title-text, .single-product-right .product-information-inner .product_title, .single-product-right .product-information-inner h1.title, .post-heading h2 a, .sidebar .recent-posts-widget .post-widget-item h4 a, .et-tabs-wrapper .tabs .accordion-title span, .vc_tta-tabs .vc_tta-title-text',
                    'text-align' => false,
                    'font-size' => false,
                    'text-transform' => true,
                ),
            )
        ));


        Redux::setSection( $opt_name, array(
            'title' => __( 'Navigation', 'xstore' ),
            'id' => 'typography-menu',
            'icon' => 'el-icon-font',
            'subsection' => true,
            'fields' => array(
                array (
                    'id' => 'menu_level_1',
                    'type' => 'typography',
                    'fonts' => $fonts_list,
                    'title' => __( 'Menu first level', 'xstore' ),
                    'output' => '.menu-wrapper .menu > li > a, .mobile-menu-wrapper .menu > li > a, .mobile-menu-wrapper .links li a, .secondary-title, .fullscreen-menu .menu > li > a, .fullscreen-menu .menu > li .inside > a, .header-wrapper.header-advanced .menu-wrapper .menu > li > a',
                    'text-align' => false,
                    'text-transform' => true,
                    'letter-spacing' => true,
                ),
                 array (
                    'id' => 'menu_level_1_hover',
                    'type' => 'color_rgba',
                    'options' => array (
                        'show_buttons' => false,
                        'show_alpha' => false,
                    ),
                    'title' => __('Menu first level hover (active)', 'xstore'),
                    'output' => '.menu-wrapper .menu > li.current-menu-item > a, .mobile-menu-wrapper .menu > li.current-menu-item > a, .mobile-menu-wrapper .li.current-menu-itemnks li.current-menu-item a, .secondary-title, .fullscreen-menu .menu > li.current-menu-item > a, .fullscreen-menu .menu > li.current-menu-item .inside > a, .header-wrapper.header-advanced .menu-wrapper .menu > li.current-menu-item > a,
                    .menu-wrapper .menu > li > a:hover, .mobile-menu-wrapper .menu > li > a:hover, .mobile-menu-wrapper .links li a:hover, .secondary-title, .fullscreen-menu .menu > li > a:hover, .fullscreen-menu .menu > li .inside > a:hover, .header-wrapper.header-advanced .menu-wrapper .menu > li > a:hover,
                    .menu-wrapper .menu > li.current-menu-item > a:hover, .mobile-menu-wrapper .menu > li.current-menu-item > a:hover, .mobile-menu-wrapper .li.current-menu-itemnks li.current-menu-item a:hover, .secondary-title, .fullscreen-menu .menu > li.current-menu-item > a:hover, .fullscreen-menu .menu > li.current-menu-item .inside > a:hover, .header-wrapper.header-advanced .menu-wrapper .menu > li.current-menu-item > a:hover'
                ),
				array (
                    'id' => 'f_menu_level_1',
                    'type' => 'color_rgba',
                    'options' => array (
                        'show_buttons' => false,
                        'show_alpha' => false,
                    ),
                    'title' => __('Fixed menu links colors', 'xstore'),
                    'output' => '.fixed-header .menu-wrapper .menu > li > a', 
                ),
                array (
                    'id' => 'f_menu_level_1_hover',
                    'type' => 'color_rgba',
                    'options' => array (
                        'show_buttons' => false,
                        'show_alpha' => false,
                    ),
                    'title' => __('Fixed menu links colors on hover (active)', 'xstore'),
                    'output' => '.fixed-header .menu-wrapper .menu > li.current-menu-item > a, .fixed-header .menu-wrapper .menu > li > a:hover', 
                ),
                array (
                    'id' => 'menu_level_2',
                    'type' => 'typography',
                    'fonts' => $fonts_list,
                    'title' => __( 'Menu second level', 'xstore' ),
                    'output' => '.item-design-mega-menu .nav-sublist-dropdown .item-level-1 > a, .fullscreen-menu .menu-item-has-children .nav-sublist-dropdown li a',
                    'text-align' => false,
                    'text-transform' => true,
                    'letter-spacing' => true,
                ),
                array (
                    'id' => 'menu_level_2_hover',
                    'type' => 'color_rgba',
                    'options' => array (
                        'show_buttons' => false,
                        'show_alpha' => false,
                    ),
                    'title' => __('Menu second level hover (active)', 'xstore'),
                    'output' => '.item-design-mega-menu .nav-sublist-dropdown .item-level-1.current-menu-item > a, .fullscreen-menu .menu-item-has-children .nav-sublist-dropdown li.current-menu-item a,
                    .item-design-mega-menu .nav-sublist-dropdown .item-level-1 > a:hover, .fullscreen-menu .menu-item-has-children .nav-sublist-dropdown li a:hover, .item-design-mega-menu .nav-sublist-dropdown .item-level-1.current-menu-item > a:hover, .fullscreen-menu .menu-item-has-children .nav-sublist-dropdown li.current-menu-item a:hover'
                ),
                array (
                    'id' => 'menu_level_3',
                    'type' => 'typography',
                    'fonts' => $fonts_list,
                    'title' => __( 'Menu third level', 'xstore' ),
                    'output' => '.item-design-dropdown .nav-sublist-dropdown ul > li > a, .item-design-mega-menu .nav-sublist-dropdown .item-link, .item-design-mega-menu .nav-sublist-dropdown .nav-sublist a, .fullscreen-menu .menu-item-has-children .nav-sublist-dropdown ul > li > a',
                    'text-align' => false,
                    'text-transform' => true,
                    'letter-spacing' => true,
                ),
                 array (
                    'id' => 'menu_level_3_hover',
                    'type' => 'color_rgba',
                    'options' => array (
                        'show_buttons' => false,
                        'show_alpha' => false,
                    ),
                    'title' => __('Menu third level hover (active)', 'xstore'),
                    'output' => '.item-design-dropdown .nav-sublist-dropdown ul > li.current-menu-item > a, .item-design-mega-menu .nav-sublist-dropdown .current-menu-item .item-link, .item-design-mega-menu .nav-sublist-dropdown .nav-sublist .current-menu-item a, .fullscreen-menu .menu-item-has-children .nav-sublist-dropdown ul > li.current-menu-item > a,
                    .item-design-dropdown .nav-sublist-dropdown ul > li > a:hover, .item-design-mega-menu .nav-sublist-dropdown .item-link, .item-design-mega-menu .nav-sublist-dropdown .nav-sublist a:hover:hover, .fullscreen-menu .menu-item-has-children .nav-sublist-dropdown ul > li > a:hover,
                    .item-design-dropdown .nav-sublist-dropdown ul > li.current-menu-item > a:hover, .item-design-mega-menu .nav-sublist-dropdown .current-menu-item .item-link:hover, .item-design-mega-menu .nav-sublist-dropdown .nav-sublist .current-menu-item a:hover:hover, .fullscreen-menu .menu-item-has-children .nav-sublist-dropdown ul > li.current-menu-item > a:hover'
                ),
                array (
                    'id' => 'mobile-menu-colors',
                    'title' => 'Customize mobile menu links',
                    'type' => 'table_closer',
                    'columns' => 2,
                    'text' => 'Customize'
                ),
                    array (
                        'id' => 'mobile-colors',
                        'title' => false,
                        'type' => 'custom_column_opener',
                        'column_title' => 'Mobile menu links',
                    ),
                         array (
                            'id' => 'mobile-links-fonts',
                            'type' => 'typography',
                            'title' => 'Typography for mobile links',
                            'fonts' => $fonts_list,
                            'output' => '.mobile-menu-wrapper .menu > li > a, .mobile-menu-wrapper .menu > li .sub-menu li a, .mobile-menu-wrapper .links li a',
                            'color' => false,
                            'text-align' => false,
                            'text-transform' => true,
                            'letter-spacing' => true,
                        ),
                        array (
                            'id' => 'mobile-links-colors-regular',
                            'type' => 'color_rgba',
                            'title' => 'Mobile links regular color',
                            'hover' => false,
                            'active' => false,
                            'options' => array (
                                'show_buttons' => false,
                            ),
                            'output' => '.mobile-menu-wrapper .menu > li > a, .mobile-menu-wrapper .menu > li .sub-menu li a, .mobile-menu-wrapper .links li a, .mobile-menu-wrapper .mobile-sidebar-widget.etheme_widget_socials a, .mobile-menu-wrapper .menu > li .open-child:before, .mobile-menu-wrapper .menu > li .sub-menu .menu-show-all a',
                        ),
                        array (
                            'id' => 'mobile-links-colors-hover',
                            'type' => 'color_rgba',
                            'title' => 'Mobile links color (on hover)',
                            'regular' => false,
                            'active' => false,
                            'options' => array (
                                'show_buttons' => false,
                            ),
                            'output' => '.mobile-menu-wrapper .menu > li > a:hover, .mobile-menu-wrapper .menu > li .sub-menu li a:hover, .mobile-menu-wrapper .links li a:hover, .mobile-menu-wrapper .mobile-sidebar-widget.etheme_widget_socials a:hover',
                        ),
                        array (
                            'id' => 'mobile-links-colors-active',
                            'type' => 'color_rgba',
                            'options' => array (
                                'show_buttons' => false,
                            ),
                            'title' => 'Mobile links color (active)',
                            'output' => '.mobile-menu-wrapper .menu > li.current_page_item > a, .mobile-menu-wrapper .menu > li .sub-menu li.current_page_item a, .mobile-menu-wrapper .links li.current_page_item a, .mobile-menu-wrapper .menu li.current_page_item > .open-child:before, .mobile-menu-wrapper .menu .current-menu-item > a, .mobile-menu-wrapper .menu > li .sub-menu .current-menu-item > a',
                        ),
                    array (
                        'id' => 'mobile-colors-closer',
                        'type' => 'custom_column_closer',
                    ),
                    array (
                        'id' => 'mobile-title-colors',
                        'title' => false,
                        'type' => 'custom_column_opener',
                        'column_title' => 'Mobile title color',
                    ),
                        array (
                            'id' => 'mobile-search-colors',
                            'type' => 'color_rgba',
                            'options' => array (
                                'show_buttons' => false,
                                'show_alpha' => false,
                            ),
                            'title' => 'Search color',
                            'transparent' => false,
                            'output' => '.mobile-menu-wrapper .header-search.act-default .search-btn',
                        ),
                        array (
                            'id' => 'mobile-search-colors-hover',
                            'type' => 'color_rgba',
                            'options' => array (
                                'show_buttons' => false,
                                'show_alpha' => false,
                            ),
                            'title' => 'Search hover color',
                            'output' => '.header-search.act-default.search-open .fa-search:before, .mobile-menu-wrapper .header-search.act-default input[type="text"], .mobile-menu-wrapper .header-search.act-default input[type="text"]::-webkit-input-placeholder',
                        ),
                        array (
                            'id' => 'mobile-back-colors',
                            'type' => 'color_rgba',
                            'options' => array (
                                'show_buttons' => false,
                                'show_alpha' => false,
                            ),
                            'title' => '"Back" link color',
                            'output' => '.mobile-menu-wrapper .menu > li .sub-menu .menu-back a, .mobile-menu-wrapper .menu > li .sub-menu .menu-back:before, .mobile-menu-wrapper .menu > li .sub-menu .menu-back a:hover, .mobile-menu-wrapper .menu > li .sub-menu li.current_page_item a',
                        ), 
                    array (
                        'id' => 'mobile-title-colors-closer',
                        'type' => 'custom_column_closer',
                    ),
                 array (
                    'id' => 'mobile-menu-colors-closer',
                    'type' => 'table_opener',
                ),
            )
        ));

        Redux::setSection( $opt_name, array(
            'title' => __( 'Secondary Navigation', 'xstore' ),
            'id' => 'typography-secondary-menu',
            'icon' => 'el-icon-font',
            'subsection' => true,
            'fields' => array(
                array (
                    'id' => 'secondary-menu_level_1',
                    'type' => 'typography',
                    'fonts' => $fonts_list,
                    'title' => __( 'Menu first level font', 'xstore' ),
                    'output' => '.secondary-menu-wrapper .menu > li > a, .secondary-title',
                    'text-align' => false,
                    'text-transform' => true,
                ),
                array (
                    'id' => 'secondary-menu_level_2',
                    'type' => 'typography',
                    'fonts' => $fonts_list,
                    'title' => __( 'Menu second level', 'xstore' ),
                    'output' => 'body .secondary-menu-wrapper .item-design-mega-menu .nav-sublist-dropdown .item-level-1 > a, body .secondary-menu-wrapper .nav-sublist-dropdown .menu-item-has-children.item-level-1 > a, body .secondary-menu-wrapper .nav-sublist-dropdown .menu-widgets .widget-title, body .secondary-menu-wrapper .fullscreen-menu .menu-item-has-children .nav-sublist-dropdown li a, body .secondary-menu-wrapper .item-design-mega-menu .nav-sublist-dropdown > .container > ul .item-level-1 > a',
                    'text-align' => false,
                    'text-transform' => true,
                ),
                array (
                    'id' => 'secondary-menu_level_3',
                    'type' => 'typography',
                    'fonts' => $fonts_list,
                    'title' => __( 'Menu third level', 'xstore' ),
                    'output' => 'body .secondary-menu-wrapper .item-design-dropdown .nav-sublist-dropdown ul > li > a, body .secondary-menu-wrapper .item-design-mega-menu .nav-sublist-dropdown .item-link, body .secondary-menu-wrapper .nav-sublist-dropdown .menu-item-has-children .nav-sublist ul > li > a, body .secondary-menu-wrapper .item-design-mega-menu .nav-sublist-dropdown .nav-sublist a, body .secondary-menu-wrapper .fullscreen-menu .menu-item-has-children .nav-sublist-dropdown ul > li > a',
                    'text-align' => false,
                    'text-transform' => true,
                ),
            )
        ));

        Redux::setSection( $opt_name, array(
            'title' => __( 'Upload custom font', 'xstore' ),
            'id' => 'fonts-uploader',
            'subsection' => true,
            'desc'   => esc_html__( 'Font that you upload here will be available in the font-family drop-downs at the Typography options', 'xstore' ),
            'icon' => 'el-icon-inbox',
            'class' => 'et_fonts-section',
            'fields' => array (
                array(
                    'id'         => 'fonts-uploader',
                    'type'       => 'fonts_uploader',
                    'title'      => false
                ),
            )
        ));

        if( current_theme_supports('woocommerce') ) {

            Redux::setSection( $opt_name, array(
                'title' => __( 'E-Commerce', 'xstore' ),
                'id' => 'shop',
                'icon' => 'el-icon-shopping-cart',
            ));

            Redux::setSection( $opt_name, array(
                'title' => __( 'Shop', 'xstore' ),
                'id' => 'shop-shop',
                'icon' => 'el-icon-shopping-cart',
                'subsection' => true,
                'fields' => array (
                    array (
                        'id' => 'cart_widget',
                        'type' => 'select',
                        'title' => __( 'Enable cart widget in ', 'xstore' ),
                        'options' => array (
                                'header' => __( 'Header', 'xstore' ),
                                'tb-left' => __( 'Top bar left', 'xstore' ),
                                'tb-right' => __( 'Top bar right', 'xstore' ),
                                false => __( 'Disable', 'xstore' ),
                            ),
                        'default' => 'header',
                    ),
                    array (
                        'id' => 'just_catalog',
                        'type' => 'switch',
                        'description' => __( 'Disable "Add To Cart" button and shopping cart', 'xstore' ),
                        'title' => __( 'Just Catalog', 'xstore' ),
                    ),
                    array (
                        'id' => 'top_toolbar',
                        'type' => 'switch',
                        'title' => __( 'Show products toolbar on the shop page', 'xstore' ),
                        'default' => true,
                    ),
                    array (
                        'id' => 'filters_columns',
                        'type' => 'select',
                        'title' => __( 'Widgets columns for filters area', 'xstore' ),
                        'options' => array (
                            2 => '2',
                            3 => '3',
                            4 => '4',
                            5 => '5',
                        ),
                        'default' => 3
                    ),
                    array (
                        'id' => 'filter_opened',
                        'type' => 'switch',
                        'title' => __( 'Open filter by default', 'xstore' ),
                        'default' => false,
                    ),
                    array (
                        'id' => 'cats_accordion',
                        'type' => 'switch',
                        'title' => __( 'Enable Accordion for product categories widget', 'xstore' ),
                        'default' => true,
                    ),
                    array (
                        'id' => 'first_catItem_opened',
                        'type' => 'switch',
                        'title' => __( 'Open first category item by default', 'xstore' ),
                        'default' => true,
                        'required' => array (
                            array('cats_accordion', 'equals', true),
                        )
                    ),
                    array (
                        'id' => 'out_of_icon',
                        'type' => 'switch',
                        'title' => __( 'Enable "Out of stock" icon', 'xstore' ),
                        'default' => true,
                    ),
                    array (
                        'id' => 'sale_icon',
                        'type' => 'switch',
                        'title' => __( 'Enable "Sale" icon', 'xstore' ),
                        'default' => true,
                    ),
                    array (
                        'id' => 'sale_icon_text',
                        'type' => 'text',
                        'title' => __( 'Sale Icon Text', 'xstore' ),
                        'default' => __( 'Sale', 'xstore' ),
                        'required' => array(
                            array('sale_icon','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'sale_icon_color',
                        'type' => 'color',
                        'title' => __( 'Sale Icon Text Color', 'xstore' ),
                        'default' => '#fffff',
                        'required' => array(
                            array('sale_icon','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'sale_icon_bg_color',
                        'type' => 'color',
                        'title' => __( 'Sale Icon Background Color', 'xstore' ),
                        'default' => '#d64444',
                        'required' => array(
                            array('sale_icon','equals', true),
                        ),
                    ),
                    array (
                        'id'        => 'sale_br_radius',
                        'type'      => 'slider',
                        'title'     => __( 'Sale Icon Border Radius "in percent"', 'xstore' ),
                        "default"   => 50,
                        "min"       => 0,
                        "step"      => 1,
                        "max"       => 50,
                        'display_value' => 'label',
                        'required' => array(
                            array('sale_icon','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'sale_icon_size',
                        'type' => 'text',
                        'title' => __( 'Sale Icon Size "in em"', 'xstore' ),
                        'default' => __( '3.75x3.75', 'xstore' ),
                        'required' => array(
                            array('sale_icon','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'sale_percentage',
                        'type' => 'switch',
                        'title' => __( 'Show sale percentage', 'xstore' ),
                        'desc' => __( 'For simple and external product types', 'xstore' ),
                        'default' => false,
                    ),

                    array (
                        'id' => 'product_bage_banner_pos',
                        'type' => 'select',
                        'title' => __( 'Product Page Banner', 'xstore' ),
                        'options' => array (
                            1 => __( 'At the top of page', 'xstore' ),
                            2 => __( 'At the bottom of page', 'xstore' ),
                            0 => __( 'Disable', 'xstore' ),
                        ),
                        'default' => 1,

                    ),

                    array (
                        'id' => 'product_bage_banner',
                        'type' => 'editor',
                        'desc' => __( 'Upload image: png, jpg or gif file', 'xstore' ),
                        'title' => __( 'Product Page Banner Content', 'xstore' ),
                        'required' => array(
                            array( 'product_bage_banner_pos','equals', array( 1, 2 ) ),
                        ),
                    ),
                    array (
                        'id' => 'empty_cart_content',
                        'type' => 'editor',
                        'title' => __( 'Text for empty cart', 'xstore' ),
                        'default' => '<h1 style="text-align: center;">YOUR SHOPPING CART IS EMPTY</h1>
<p style="text-align: center;">We invite you to get acquainted with an assortment of our shop.
Surely you can find something for yourself!</p> ',
                    ),
                    // array (
                    //     'id' => 'register_text',
                    //     'type' => 'editor',
                    //     'title' => 'Text for registration page',
                    //     'default' => 'text',
                    // ),
                ),
            ));

            Redux::setSection( $opt_name, array(
                'title' => __( 'Categories', 'xstore' ),
                'id' => 'shop-categories',
                'icon' => 'el-icon-shopping-cart',
                'subsection' => true,
                'fields' => array (
                    array (
                        'id' => 'cat_style',
                        'type' => 'select',
                        'title' => __( 'Categories style', 'xstore' ),
                        'options' => array (
                            'default' => __( 'Default', 'xstore' ),
                            'with-bg' => __( 'Title with background', 'xstore' ),
                            'zoom' => __( 'Zoom', 'xstore' ) ,
                            'diagonal' => __( 'Diagonal', 'xstore' ),
                            'classic' => __( 'Classic', 'xstore' ),
                        ),
                        'default' => 'default'
                    ),
                    array (
                        'id' => 'cat_text_color',
                        'type' => 'select',
                        'title' => __( 'Categories text color', 'xstore' ),
                        'options' => array (
                            'dark' => __( 'Dark', 'xstore' ),
                            'white' => __( 'Light', 'xstore' ),
                        ),
                        'default' => 'dark'
                    ),
                    array (
                        'id' => 'cat_valign',
                        'type' => 'select',
                        'title' => __( 'Text vertical align', 'xstore' ),
                        'options' => array (
                            'center' => __( 'Center', 'xstore' ),
                            'top' => __( 'Top', 'xstore' ),
                            'bottom' => __( 'Bottom', 'xstore' ),
                        ),
                        'default' => 'center'
                    ),
                    array (
                        'id' => 'cat_widget_title_color',
                        'type' => 'color_rgba',
                        'title' => __('Product categories widget title color'),
                        'options' => array (
                            'show_buttons' => false,
                        ),
                        'output' => array('color' => '.sidebar-widget.widget_product_categories .widget-title')
                    ),
                    array (
                        'id' => 'cat_widget_title',
                        'type' => 'color_rgba',
                        'title' => __('Product categories widget title background color'),
                        'options' => array (
                            'show_buttons' => false,
                        ),
                        'output' => array('background-color' => '.sidebar-widget.widget_product_categories .widget-title')
                    ),
                ),
            ));

            Redux::setSection( $opt_name, array(
                'title' => __( 'Products Page Layout', 'xstore' ),
                'id' => 'shop-product_grid',
                'icon' => 'el-icon-view-mode',
                'subsection' => true,
                'fields' => array (
                    array (
                        'id' => 'view_mode',
                        'type' => 'select',
                        'title' => __( 'Products view mode', 'xstore' ),
                        'options' => array (
                            'grid_list' => __( 'Grid/List', 'xstore' ),
                            'list_grid' => __( 'List/Grid', 'xstore' ),
                            'grid' => __( 'Only Grid', 'xstore' ),
                            'list' => __( 'Only List', 'xstore' ),
                        ),
                        'default' => 'grid_list'
                    ),
                    array (
                        'id' => 'prodcuts_per_row',
                        'type' => 'select',
                        'title' => __( 'Products per row', 'xstore' ),
                        'options' => array (
                            1 => '1',
                            2 => '2',
                            3 => '3',
                            4 => '4',
                            5 => '5',
                            6 => '6',
                        ),
                        'default' => 3
                    ),
                    array (
                        'id' => 'products_per_page',
                        'type' => 'text',
                        'title' => __( 'Products per page', 'xstore' ),
                    ),
                    array (
                        'id' => 'et_ppp_options',
                        'type' => 'text',
                        'title' => __( 'Per page variants separated by commas', 'xstore' ),
                        'default' => __( '12,24,36,-1', 'xstore' ),
                        'desc' => __( 'For example: 12,24,36,-1. Set -1 to show all products', 'xstore' )
                    ),
                    array (
                        'id' => 'grid_sidebar',
                        'type' => 'image_select',
                        'desc' => __( 'Sidebar position', 'xstore' ),
                        'title' => __( 'Layout', 'xstore' ),
                        'options' => array (
                            'without' => array (
                                'alt' => __( 'full width', 'xstore' ),
                                'img' => ETHEME_CODE_IMAGES . 'layout/full-width.png',
                            ),
                            'left' => array (
                                'alt' => __( 'Left Sidebar', 'xstore' ),
                                'img' => ETHEME_CODE_IMAGES . 'layout/left-sidebar.png',
                            ),
                            'right' => array (
                                'alt' => __( 'Right Sidebar', 'xstore' ),
                                'img' => ETHEME_CODE_IMAGES . 'layout/right-sidebar.png',
                            ),
                        ),
                        'default' => 'left'
                    ),
                    array (
                        'id' => 'shop_sticky_sidebar',
                        'type' => 'switch',
                        'title' => __( 'Enable sticky sidebar', 'xstore' ),
                        'default' => false,
                    ),
                    array (
                        'id' => 'sidebar_for_mobile',
                        'type' => 'select',
                        'title' => __( 'Sidebar position for mobile', 'xstore' ),
                        'options' => array (
                            'top' => __( 'Top', 'xstore' ),
                            'bottom' => __( 'Bottom', 'xstore' ),
                        ),
                        'default' => 'top',
                    ),
                    array (
                        'id' => 'shop_sidebar_hide_mobile',
                        'type' => 'switch',
                        'title' => __( 'Hide sidebar for mobile devices', 'xstore' ),
                    ),
                    array (
                        'id' => 'shop_full_width',
                        'type' => 'switch',
                        'title' => __( 'Full width', 'xstore' ),
                    ),
                    array (
                        'id' => 'products_masonry',
                        'type' => 'switch',
                        'title' => __( 'Products masonry', 'xstore' ),
                        'default' => false,
                    ),
                    array (
                        'id' => 'product_img_hover',
                        'type' => 'select',
                        'title' => __( 'Image hover effect', 'xstore' ),
                        'options' => array (
                            'disable' => __( 'Disable', 'xstore' ),
                            'swap' => __( 'Swap', 'xstore' ),
                            'slider' => __( 'Images Slider', 'xstore' ),
                        ),
                        'default' => 'slider',
                    ),
                    array (
                        'id' => 'product_view',
                        'type' => 'select',
                        'title' => __( 'Buttons hover', 'xstore' ),
                        'options' => array (
                            'disable' => __( 'Disable', 'xstore' ),
                            'default' => __( 'Default', 'xstore' ),
                            'mask3' => __( 'Buttons on hover middle', 'xstore' ),
                            'mask' => __( 'Buttons on hover bottom', 'xstore' ),
                            'mask2' => __( 'Buttons on hover right', 'xstore' ),
                            'info' => __( 'Information mask', 'xstore' ),
                            'booking' => __( 'Booking', 'xstore' ),
                            'light' => __( 'Light', 'xstore' ),
                        ),
                        'default' => 'disable',
                    ),
                    array (
                        'id' => 'product_view_color',
                        'type' => 'select',
                        'title' => __( 'Hover Color Scheme', 'xstore' ),
                        'options' => array (
                            'white' => __( 'White', 'xstore' ),
                            'dark' => __( 'Dark', 'xstore' ),
                            'transparent' => 'Transparent',
                        ),
                        'default' => 'white',
                        'required' => array(
                            array('product_view','equals', array('info','mask','mask2')),
                        )
                    ),
                    array (
                        'id' => 'hide_buttons_mobile',
                        'type' => 'switch',
                        'title' => __( 'Hide hover buttons on mobile', 'xstore' ),
                        'default' => false,
                    ),
                    array (
                        'id' => 'product_page_productname',
                        'type' => 'switch',
                        'title' => __( 'Show product name', 'xstore' ),
                        'default' => true,
                    ),
                    array (
                        'id' => 'product_page_cats',
                        'type' => 'switch',
                        'title' => __( 'Show product categories', 'xstore' ),
                    ),
                    array (
                        'id' => 'product_page_brands',
                        'type' => 'switch',
                        'title' => __( 'Show product brands', 'xstore' ),
                        'required' => array(
                            array( 'enable_brands', 'equals', true )
                        )
                    ),
                    array (
                        'id' => 'product_page_price',
                        'type' => 'switch',
                        'title' => __( 'Show Price', 'xstore' ),
                        'default' => true,
                    ),
                    array (
                        'id' => 'product_page_addtocart',
                        'type' => 'switch',
                        'title' => __( 'Show "Add to cart" button', 'xstore' ),
                        'default' => true,
                    ),
                ),
            ));


            Redux::setSection( $opt_name, array(
                'title' => __( 'Single Product Page', 'xstore' ),
                'id' => 'shop-single_product',
                'subsection' => true,
                'icon' => 'el-icon-indent-left',
                'fields' => array (
                    array (
                        'id' => 'single_sidebar',
                        'type' => 'image_select',
                        'title' => __( 'Sidebar position', 'xstore' ),
                        'options' => array (
                            'without' => array (
                                'alt' => __( 'Without Sidebar', 'xstore' ),
                                'img' => ETHEME_CODE_IMAGES . 'layout/full-width.png',
                            ),
                            'left' => array (
                                'alt' => __( 'Left Sidebar', 'xstore' ),
                                'img' => ETHEME_CODE_IMAGES . 'layout/left-sidebar.png',
                            ),
                            'right' => array (
                                'alt' => __( 'Right Sidebar', 'xstore' ),
                                'img' => ETHEME_CODE_IMAGES . 'layout/right-sidebar.png',
                            ),
                        ),
                        'default' => 'without'
                    ),
                    array (
                        'id' => 'single_layout',
                        'type' => 'image_select',
                        'title' => __( 'Page Layout', 'xstore' ),
                        'options' => array (
                            'small' => array (
                                'alt' => __( 'Small', 'xstore' ),
                                'img' => ETHEME_CODE_IMAGES . 'layout/product-small.png',
                            ),
                            'default' => array (
                                'alt' => __( 'Default', 'xstore' ),
                                'img' => ETHEME_CODE_IMAGES . 'layout/product-medium.png',
                            ),
                            'xsmall' => array (
                                'alt' => __( 'Thin description', 'xstore' ),
                                'img' => ETHEME_CODE_IMAGES . 'layout/product-thin.png',
                            ),
                            'large' => array (
                                'alt' => __( 'Large', 'xstore' ),
                                'img' => ETHEME_CODE_IMAGES . 'layout/product-large.png',
                            ),
                            'fixed' => array (
                                'alt' => __( 'Fixed content', 'xstore' ),
                                'img' => ETHEME_CODE_IMAGES . 'layout/product-fixed.png',
                            ),
                            'center' => array (
                                'alt' => __( 'Image center', 'xstore' ),
                                'img' => ETHEME_CODE_IMAGES . 'layout/product-center.png',
                            ),
                            'wide' => array (
                                'alt' => __( 'Wide', 'xstore' ),
                                'img' => ETHEME_CODE_IMAGES . 'layout/product-wide.png',
                            ),
                            'right' => array (
                                'alt' => __( 'Image right', 'xstore' ),
                                'img' => ETHEME_CODE_IMAGES . 'layout/product-right.png',
                            ),
                            'booking' => array (
                                'alt' => __( 'Booking', 'xstore' ),
                                'img' => ETHEME_CODE_IMAGES . 'layout/product-booking.png',
                            ),
                        ),
                        'default' => 'default'
                    ),
                    array (
                        'id' => 'single_product_hide_sidebar',
                        'type' => 'switch',
                        'title' => __( 'Hide sidebar on mobile', 'xstore' ),
                        'default' => false
                    ),
                    array (
                        'id' => 'fixed_images',
                        'type' => 'switch',
                        'title' => __( 'Fixed product image', 'xstore' ),
                        'default' => false,
                        'required' => array(
                            array('single_layout','equals', array('small', 'default', 'xsmall', 'wide', 'right')),
                        )
                    ),
                    array (
                        'id' => 'fixed_content',
                        'type' => 'switch',
                        'title' => __( 'Fixed product content', 'xstore' ),
                        'default' => false,
                        'required' => array(
                            array('single_layout','equals', array('small', 'default', 'xsmall', 'wide', 'right')),
                        )
                    ),
                    array (
                        'id' => 'product_name_signle',
                        'type' => 'switch',
                        'title' => __( 'Show product name above the price', 'xstore' ),
                        'default' => true,
                    ),

                    //etheme_depend_options( 'YITH_WCWL_Shortcode', 'single_wishlist_type' ),
                    //etheme_depend_options( 'YITH_WCWL_Shortcode', 'single_wishlist_position' ),

                    array (
                        'id' => 'upsell_location',
                        'type' => 'select',
                        'title' => __( 'Location of upsell products', 'xstore' ),
                        'options' => array (
                            'sidebar' => __( 'Sidebar', 'xstore' ),
                            'after_content' => __( 'After content', 'xstore' ),
                        ),
                    ),
                    array (
                        'id' => 'ajax_add_to_cart',
                        'type' => 'switch',
                        'title' => __( 'AJAX add to cart for simple products', 'xstore' ),
                        'default' => true,
                    ),
                    array (
                        'id' => 'product_photoswipe',
                        'type' => 'switch',
                        'title' => __( 'Lightbox for product images', 'xstore' ),
                        'default' => true,
                    ),
                    array (
                        'id' => 'product_zoom',
                        'type' => 'switch',
                        'title' => __( 'Zoom for product images', 'xstore' ),
                        'default' => true,
                    ),
                    array (
                        'id' => 'show_related',
                        'type' => 'switch',
                        'title' => __( 'Display related products', 'xstore' ),
                        'default' => true,
                    ),
                    array (
                        'id' => 'related_limit',
                        'type' => 'text',
                        'title' => __( 'Display related products', 'xstore' ),
                        'default' => 10,
                        'required' => array(
                            array('show_related','equals', true),
                        )
                    ),
                    array (
                        'id' => 'show_brand',
                        'type' => 'switch',
                        'title' => __( 'Show brand', 'xstore' ),
                        'default' => true,
                    ),
                    array (
                        'id' => 'show_brand_image',
                        'type' => 'switch',
                        'title' => __( 'Show brand image', 'xstore' ),
                        'default' => true,
                        'required' => array(
                            array('show_brand','equals', true),
                        )
                    ),
                    array (
                        'id' => 'show_brand_title',
                        'type' => 'switch',
                        'title' => __( 'Show brand title', 'xstore' ),
                        'default' => true,
                        'required' => array(
                            array('show_brand','equals', true),
                        )
                    ),
                    array (
                        'id' => 'show_brand_desc',
                        'type' => 'switch',
                        'title' => __( 'Show brand description', 'xstore' ),
                        'default' => true,
                        'required' => array(
                            array('show_brand','equals', true),
                        )
                    ),
                    array (
                        'id' => 'thumbs_slider',
                        'type' => 'switch',
                        'title' => __( 'Enable slider for gallery thumbnails', 'xstore' ),
                        'default' => true,
                    ),
                    array (
                        'id' => 'product_posts_links',
                        'type' => 'switch',
                        'title' => __( 'Show Next/Previous product navigation', 'xstore' ),
                        'default' => true,
                    ),
                    array (
                        'id' => 'share_icons',
                        'type' => 'switch',
                        'title' => __( 'Show share buttons', 'xstore' ),
                        'default' => true,
                    ),
                    array (
                        'id' => 'size_guide_img',
                        'type' => 'media',
                        'desc' => __( 'Upload image: png, jpg or gif file', 'xstore' ),
                        'title' => __( 'Size guide image', 'xstore' ),
                    ),
                    array (
                        'id' => 'tabs_type',
                        'type' => 'select',
                        'title' => __( 'Tabs type', 'xstore' ),
                        'options' => array (
                            'tabs-default' => __( 'Default', 'xstore' ),
                            'left-bar' => __( 'Left Bar', 'xstore' ),
                            'accordion' => __( 'Accordion', 'xstore' ),
                            'disable' => __( 'Disable', 'xstore' ),
                        ),
                        'default' => 'tabs-default'
                    ),
                    array (
                        'id' => 'tabs_scroll',
                        'type' => 'switch',
                        'title' => __( 'Tabs content scroll', 'xstore' ),
                        'default' => false,
                        'required' => array(
                            array('tabs_type', 'equals', 'accordion'),
                        )
                    ),
                    array(
                        'id'        => 'tab_height',
                        'type'      => 'slider',
                        'title'     => __('Tab content height', 'redux-framework-demo'),
                        "default"   => 250,
                        "min"       => 50,
                        "step"      => 1,
                        "max"       => 800,
                        'display_value' => 'label',
                        'required' => array(
                            array('tabs_type', 'equals', 'accordion'),
                            array('tabs_scroll', 'equals', true),
                        )
                    ),
                    array (
                        'id' => 'tabs_location',
                        'type' => 'select',
                        'title' => __( 'Location of product tabs', 'xstore' ),
                        'options' => array (
                            'after_image' => __( 'Next to image', 'xstore' ),
                            'after_content' => __( 'Under content', 'xstore' ),
                        ),
                        'default' => 'after_content',
                        'required' => array(
                            array('tabs_type','!=', 'disable'),
                        )
                    ),
                    array (
                        'id' => 'reviews_position',
                        'type' => 'select',
                        'title' => __( 'Reviews position', 'xstore' ),
                        'options' => array (
                            'tabs' => __( 'Tabs', 'xstore' ),
                            'outside' => __( 'Next to tabs', 'xstore' ),
                        ),
                        'default' => 'tabs',
                        'required' => array(
                            array('tabs_type','!=', 'disable'),
                        )
                    ),
                    array (
                        'id' => 'custom_tab_title',
                        'type' => 'text',
                        'title' => __( 'Custom Tab Title', 'xstore' ),
                        'required' => array(
                            array('tabs_type','!=', 'disable'),
                        ),
                    ),
                    array (
                        'id' => 'custom_tab',
                        'type' => 'editor',
                        'desc' => __( 'Enter custom content you would like to output to the product custom tab (for all products)', 'xstore' ),
                        'title' => __( 'Custom tab content', 'xstore' ),
                        'required' => array(
                            array('tabs_type','!=', 'disable'),
                        ),
                    ),
                ),
            ));


            Redux::setSection( $opt_name, array(
                'title' => __( 'Quick View', 'xstore' ),
                'id' => 'shop-quick_view',
                'subsection' => true,
                'icon' => 'el-icon-zoom-in',
                'fields' => array (
                    array (
                        'id' => 'quick_view',
                        'type' => 'switch',
                        'title' => __( 'Enable Quick View', 'xstore' ),
                        'default' => true,
                    ),
                    array (
                        'id' => 'quick_images',
                        'type' => 'select',
                        'title' => __( 'Product images', 'xstore' ),
                        'options' => array (
                            'slider' => __( 'Slider', 'xstore' ),
                            'single' => __( 'Single', 'xstore' ),
                        ),
                        'default' => 'slider',
                        'required' => array(
                            array('quick_view','equals', true),
                        )
                    ),
                    array (
                        'id' => 'quick_view_layout',
                        'type' => 'select',
                        'title' => __( 'Quick view layout', 'xstore' ),
                        'options' => array (
                            'default' => __( 'Default', 'xstore' ),
                            'centered' => __( 'Centered', 'xstore' ),
                        ),
                        'default' => 'default',
                        'required' => array(
                            array('quick_view','equals', true),
                        )
                    ),
                    array (
                        'id' => 'quick_product_name',
                        'type' => 'switch',
                        'title' => __( 'Product name', 'xstore' ),
                        'default' => true,
                        'required' => array(
                            array('quick_view','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'quick_categories',
                        'type' => 'switch',
                        'title' => __( 'Product categories', 'xstore' ),
                        'default' => true,
                        'required' => array(
                            array('quick_view','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'quick_price',
                        'type' => 'switch',
                        'title' => __( 'Price', 'xstore' ),
                        'default' => true,
                        'required' => array(
                            array('quick_view','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'quick_rating',
                        'type' => 'switch',
                        'title' => __( 'Product star rating', 'xstore' ),
                        'default' => true,
                        'required' => array(
                            array('quick_view','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'quick_descr',
                        'type' => 'switch',
                        'title' => __( 'Short description', 'xstore' ),
                        'default' => true,
                        'required' => array(
                            array('quick_view','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'quick_descr_length',
                        'type' => 'text',
                        'title' => __( 'Description length', 'xstore' ),
                        'default' => 120,
                        'required' => array(
                            array('quick_descr','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'quick_add_to_cart',
                        'type' => 'switch',
                        'title' => __( 'Add to cart', 'xstore' ),
                        'default' => true,
                        'required' => array(
                            array('quick_view','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'quick_share',
                        'type' => 'switch',
                        'title' => __( 'Share icons', 'xstore' ),
                        'default' => true,
                        'required' => array(
                            array('quick_view','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'product_link',
                        'type' => 'switch',
                        'title' => __( 'Product link', 'xstore' ),
                        'default' => true,
                        'required' => array(
                            array('quick_view','equals', true),
                        ),
                    ),

                ),
            ));



            Redux::setSection( $opt_name, array(
                'title' => __( 'Promo Popup', 'xstore' ),
                'id' => 'shop-promo_popup',
                'subsection' => true,
                'icon' => 'el-icon-tag',
                'fields' => array (
                    array (
                        'id' => 'promo_popup',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => __( 'Enable promo popup', 'xstore' ),
                        'default' => true,
                    ),
                    array (
                        'id' => 'promo_auto_open',
                        'type' => 'switch',
                        'title' => __( 'Open popup on enter', 'xstore' ),
                        'required' => array(
                            array('promo_popup','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'promo_open_scroll',
                        'type' => 'switch',
                        'title' => __( 'Open when scrolled to the bottom of the page', 'xstore' ),
                        'required' => array(
                            array('promo_auto_open','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'promo_link',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => __( 'Show link in the top bar', 'xstore' ),
                        'default' => true,
                        'required' => array(
                            array('promo_popup','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'promo-link-text',
                        'type' => 'text',
                        'title' => __( 'Promo link text', 'xstore' ),
                        'default' => __( 'Newsletter', 'xstore' ),
                        'required' => array(
                            array('promo_popup','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'pp_content',
                        'type' => 'editor',
                        'operator' => 'and',
                        'title' => __( 'Popup content', 'xstore' ),
                        'default' => '<p>You can add any HTML here (admin -&gt; Theme Options -&gt; E-Commerce -&gt; Promo Popup).<br /> We suggest you create a static block and put it here using shortcode</p>',
                        'required' => array(
                            array('promo_popup','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'pp_width',
                        'type' => 'text',
                        'operator' => 'and',
                        'title' => __( 'Popup width', 'xstore' ),
                        'required' => array(
                            array('promo_popup','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'pp_height',
                        'type' => 'text',
                        'operator' => 'and',
                        'title' => __( 'Popup height', 'xstore' ),
                        'required' => array(
                            array('promo_popup','equals', true),
                        ),
                    ),
                    array (
                        'id' => 'pp_bg',
                        'type' => 'background',
                        'title' => __( 'Popup background', 'xstore' ),
                        'required' => array(
                            array('promo_popup','equals', true),
                        ),
                    ),
                ),
            ));

        }

        Redux::setSection( $opt_name, array(
            'title' => __( 'Blog & Portfolio', 'xstore' ),
            'id' => 'blog',
            'icon' => 'el-icon-wordpress',
        ));

        Redux::setSection( $opt_name, array(
            'title' => __( 'Blog Layout', 'xstore' ),
            'id' => 'blog-blog_page',
            'subsection' => true,
            'icon' => 'el-icon-wordpress',
            'fields' => array (
                array (
                    'id' => 'blog_layout',
                    'type' => 'image_select',
                    'title' => __( 'Blog Layout', 'xstore' ),
                    'options' => array(
                        'default' => array(
                            'title' => __( 'Default', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'blog/posts1-1.png',
                        ),
                        'center' => array(
                            'title' => __( 'Center', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'blog/posts-center.png',
                        ),
                        'grid' => array(
                            'title' => __( 'Grid', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'blog/posts2-1.png',
                        ),
                        'grid2' => array(
                            'title' => __( 'Grid 2', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'blog/posts2-2.png',
                        ),
                        'timeline' => array(
                            'title' => __( 'Timeline', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'blog/posts5-1.png',
                        ),
                        'timeline2' => array(
                            'title' => __( 'Timeline 2', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'blog/timeline2.png',
                        ),
                        'small' => array(
                            'title' => __( 'List', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'blog/posts3-1.png',
                        ),
                        'chess' => array(
                            'title' => __( 'Chess', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'blog/posts-chess.png',
                        ),
                        'framed' => array(
                            'title' => __( 'Framed', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'blog/posts-framed.png',
                        ),
                        'with-author' => array(
                            'title' => __( 'With author', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'blog/posts-with-author.png',
                        ),
                    ),
                    'default' => 'default',
                ),
                array (
                    'id' => 'blog_columns',
                    'type' => 'select',
                    'title' => __( 'Columns', 'xstore' ),
                    'options' => array (
                        2 => '2',
                        3 => '3',
                        4 => '4',
                    ),
                    'default' => 3,
                    'required' => array(
                        array( 'blog_layout','equals', array( 'grid', 'grid2' ) ),
                    ),
                ),
                array (
                    'id' => 'blog_full_width',
                    'type' => 'switch',
                    'title' => __( 'Full width', 'xstore' ),
                    'required' => array(
                        array( 'blog_layout','equals', array( 'grid', 'grid2' ) ),
                    ),
                ),
                array (
                    'id' => 'blog_masonry',
                    'type' => 'switch',
                    'title' => __( 'Masonry', 'xstore' ),
                    'required' => array(
                        array( 'blog_layout','equals', array( 'grid', 'grid2' ) ),
                    ),
                    'default' => true,
                ),
                array (
                    'id' => 'blog_hover',
                    'type' => 'select',
                    'title' => __( 'Blog image hover', 'xstore' ),
                    'options' => array (
                        'default' => __( 'Default', 'xstore' ),
                        'zoom' => __( 'Zoom', 'xstore' ),
                        'animated' => __( 'Animated', 'xstore' ),
                    ),
                    'default' => 'default',
                ),
                array (
                    'id' => 'blog_byline',
                    'type' => 'switch',
                    'title' => __( 'Show "byline" on the blog', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'read_more',
                    'type' => 'select',
                    'title' => __( 'Show "Continue reading link"', 'xstore' ),
                    'options' => array (
                        'link' => 'Link',
                        'btn' => 'Button',
                        'off' => 'Disable',
                    ),
                    'default' => 'link',
                ),
                array (
                    'id' => 'views_counter',
                    'type' => 'switch',
                    'title' => __( 'Enable views counter', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'blog_sidebar',
                    'type' => 'image_select',
                    'title' => __( 'Sidebar position', 'xstore' ),
                    'options' => array (
                        'without' => array (
                            'alt' => __( 'Without Sidebar', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'layout/full-width.png',
                        ),
                        'left' => array (
                            'alt' => __( 'Left Sidebar', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'layout/left-sidebar.png',
                        ),
                        'right' => array (
                            'alt' => __( 'Right Sidebar', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'layout/right-sidebar.png',
                        ),
                    ),
                    'default' => 'right'
                ),
                array (
                    'id' => 'blog_navigation_type',
                    'type' => 'select',
                    'title' => __( 'Navigation type', 'xstore' ),
                    'options' => array (
                        'pagination' => __( 'Pagination', 'xstore' ),
                        'button' => __( 'More Button', 'xstore' ),
                        'lazy' => __( 'Lazy Loading', 'xstore' ),
                    ),
                    'default' => 'pagination'
                ),
                array (
                    'id' => 'blog_pagination_align',
                    'type' => 'select',
                    'title' => __( 'Pagination align', 'xstore' ),
                    'options' => array (
                        'left' => __( 'Left', 'xstore' ),
                        'center' => __( 'Center', 'xstore' ),
                        'right' => __( 'Right', 'xstore' ),
                    ),
                    'default' => 'right',
                    'required' => array(
                        array( 'blog_navigation_type','equals', 'pagination' ),
                    ),
                ),
                array (
                    'id' => 'blog_pagination_prev_next',
                    'type' => 'switch',
                    'title' => __( 'Enable prev/next pagination links', 'xstore' ),
                    'default' => false,
                    'required' => array(
                        array( 'blog_navigation_type','equals', 'pagination' ),
                    ),
                ),
                array (
                    'id' => 'sticky_sidebar',
                    'type' => 'switch',
                    'title' => __( 'Enable sticky sidebar', 'xstore' ),
                    'default' => false,
                ),
                array (
                    'id' => 'excerpt_words',
                    'type' => 'text',
                    'title' => __( 'Excerpt symbols', 'xstore' ),
                    'default' => '...',
                ),
                array (
                    'id' => 'excerpt_length',
                    'type' => 'text',
                    'title' => __( 'Excerpt length (words)', 'xstore' ),
                    'default' => 25,
                ),
                array (
                    'id' => 'blog_images_size',
                    'type' => 'text',
                    'title' => __( 'Images sizes for blog', 'xstore' ),
                    'subtitle' => __( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'js_composer' ),
                    'default' => 'large',
                ),
                array (
                    'id' => 'blog_related_images_size',
                    'type' => 'text',
                    'title' => __( 'Images sizes for related articles', 'xstore' ),
                    'subtitle' => __( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'js_composer' ),
                    'default' => 'medium',
                ),
            ),
        ));

        Redux::setSection( $opt_name, array(
            'title' => __( 'Single post', 'xstore' ),
            'id' => 'blog-single-post',
            'subsection' => true,
            'icon' => 'el-icon-wordpress',
            'fields' => array (
                array (
                    'id' => 'post_template',
                    'type' => 'image_select',
                    'title' => __( 'Post template', 'xstore' ),
                    'options' => array (
                        'default' => array(
                            'title' => __( 'Default', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'blog/3.png',
                        ),
                        'full-width' => array(
                            'title' => __( 'Large', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'blog/2.png',
                        ),
                        'large' => array(
                            'title' => __( 'Full width', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'blog/1.png',
                        ),
                        'large2' => array(
                            'title' => __( 'Full width centered', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'blog/5.png',
                        ),
                        'framed' => array(
                            'title' => __( 'Framed', 'xstore' ),
                            'img' => ETHEME_CODE_IMAGES . 'blog/6.png',
                        ),
                    ),
                    'default' => 'default'
                ),
                array (
                    'id' => 'blog_featured_image',
                    'type' => 'switch',
                    'title' => __( 'Display featured image on single post', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'single_post_title',
                    'type' => 'switch',
                    'title' => __( 'Display Title/Meta on single post', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'post_share',
                    'type' => 'switch',
                    'operator' => 'and',
                    'title' => __( 'Show Share buttons', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'about_author',
                    'type' => 'switch',
                    'operator' => 'and',
                    'title' => __( 'Show About Author block', 'xstore' ),
                    'default' => false,
                ),
                array (
                    'id' => 'posts_links',
                    'type' => 'switch',
                    'title' => __( 'Posts previous/next buttons', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'post_related',
                    'type' => 'switch',
                    'operator' => 'and',
                    'title' => __( 'Show Related posts', 'xstore' ),
                    'default' => true,
                ),
                array (
                    'id' => 'related_query',
                    'type' => 'select',
                    'title' => __( 'Related query type', 'xstore' ),
                    'options' => array (
                        'categories' => __( 'Categories', 'xstore' ),
                        'tags' => __( 'Tags', 'xstore' ),
                    ),
                    'default' => 'categories',
                    'required' => array(
                        array('post_related','equals', true),
                    ),
                ),

            ),
        ));



        Redux::setSection( $opt_name, array(
            'title' => __( 'Portfolio', 'xstore' ),
            'id' => 'blog-portfolioo',
            'subsection' => true,
            'icon' => 'el-icon-briefcase',
            'fields' => array (
                array (
                    'id' => 'portfolio_style',
                    'type' => 'select',
                    'title' => __( 'Project grid style', 'xstore' ),
                    'options' => array (
                        'default' => __( 'With title', 'xstore' ),
                        'classic' => __( 'Classic', 'xstore' ),
                    ),
                    'default' => 'default'
                ),
                array (
                    'id' => 'portfolio_fullwidth',
                    'type' => 'switch',
                    'title' => __( 'Full width portfolio', 'xstore' ),
                    'default' => false
                ),
                array (
                    'id' => 'port_first_wide',
                    'type' => 'switch',
                    'title' => __( 'Make first project wide', 'xstore' ),
                    'default' => false
                ),
                array (
                    'id' => 'port_single_nav',
                    'type' => 'switch',
                    'title' => __( 'Show Next/Previous projects navigation', 'xstore' ),
                    'default' => false
                ),
                array (
                    'id' => 'portfolio_images_size',
                    'type' => 'text',
                    'title' => __( 'Images sizes for portfolio', 'xstore' ),
                    'subtitle' => __( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'js_composer' ),
                    'default' => 'large',
                ),
                array (
                    'id' => 'portfolio_columns',
                    'type' => 'select',
                    'title' => __( 'Columns', 'xstore' ),
                    'options' => array (
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                        6 => '6',
                    ),
                    'default' => 3
                ),
                array (
                    'id' => 'portfolio_margin',
                    'type' => 'select',
                    'title' => __( 'Portfolio item spacing', 'xstore' ),
                    'options' => array (
                        1 => '0',
                        5 => '5',
                        10 => '10',
                        15 => '15',
                        20 => '20',
                        30 => '30',
                    ),
                    'default' => 15
                ),
                array (
                    'id' => 'portfolio_count',
                    'type' => 'text',
                    'desc' => __( 'Use -1 to show all items', 'xstore' ),
                    'title' => __( 'Items per page', 'xstore' ),
                ),

                array (
                    'id' => 'portfolio_order',
                    'type' => 'select',
                    'title' => __( 'Portfolio order way', 'xstore' ),
                    'options' => array (
                        'DESC' => 'Descending',
                        'ASC' => 'Ascending',
                    ),
                    'default' => 'DESC'
                ),
                array (
                    'id' => 'portfolio_orderby',
                    'type' => 'select',
                    'title' => __( 'Portfolio order by', 'xstore' ),
                    'options' => array (
                        'title' => 'Title',
                        'date' => 'Date',
                        'ID' => 'ID',
                    ),
                    'default' => 'title'
                ),

            ),
        ));

        Redux::setSection( $opt_name, array(
            'title' => __( 'Import / Export', 'xstore' ),
            'id' => 'import',
            'icon'   => 'el-icon-refresh',
        ));

        Redux::setSection( $opt_name, array(
            'title' => __( 'Dummy content', 'xstore' ),
            'id' => 'import-dummy',
            'subsection' => true,
            'icon' => 'el-icon-inbox',
            'fields' => array (
                array(
                    'id'         => 'dummy-content',
                    'type'       => 'dummy_content',
                    'title'      => __( 'Install Dummy content', 'xstore' )
                ),
            )
        ));

        Redux::setSection( $opt_name, array(
            'title'  => esc_html__( 'Options', 'xstore' ),
            'desc'   => esc_html__( 'Import and Export your theme settings from file, text or URL.', 'xstore' ),
            'id' => 'import-export',
            'subsection' => true,
            'icon'   => 'el-icon-refresh',
            'fields' => array(
                array(
                    'id'         => 'opt-import-export',
                    'type'       => 'import_export',
                    'title'      => __( 'Import Export', 'xstore' ),
                    'subtitle'   => __( 'Save and restore your theme options', 'xstore' ),
                    'full_width' => false,
                ),
            ),
        ));


        /*
         * <--- END SECTIONS
         */
    }

    add_action( 'after_setup_theme', 'etheme_redux_init', 1 );
}


// If Redux is running as a plugin, this will remove the demo notice and links
add_action( 'redux/loaded', 'remove_demo' );

// Remove the demo link and the notice of integrated demo from the redux-framework plugin

if ( ! function_exists( 'remove_demo' ) ) {
    function remove_demo() {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
}


