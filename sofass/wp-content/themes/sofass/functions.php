<?php
/**
 * sofass functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Sofass
 * @since Sofass 1.3.7
 */

define( 'SOFASS_THEME_VERSION', '1.3.7' );
define( 'SOFASS_DEMO_MODE', false );

if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

if ( ! function_exists( 'sofass_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Sofass 1.3.7
 */
function sofass_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on sofass, use a find and replace
	 * to change 'sofass' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'sofass', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1300, 943, true );
	add_image_size( 'sofass-shop-mansory-large', 850, 850, true );
	add_image_size( 'sofass-shop-mansory-small', 410, 410, true );
	add_image_size( 'sofass-shop-special', 410, 410, true );
	add_image_size( 'sofass-blog-small', 100, 100, true );


	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'sofass' ),
		'mobile-primary' => esc_html__( 'Mobile Primary Menu', 'sofass' ),
		'vertical-menu' => esc_html__( 'Vertical Menu', 'sofass' ),
		'my-account' => esc_html__( 'My Account Menu', 'sofass' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	add_theme_support( "woocommerce", array('gallery_thumbnail_image_width' => 410) );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = sofass_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'sofass_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( array( 'css/style-editor.css' ) );

	sofass_get_load_plugins();
}
endif; // sofass_setup
add_action( 'after_setup_theme', 'sofass_setup' );

/**
 * Load Google Front
 */
function sofass_get_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Montserrat, translate this to 'off'. Do not translate
    * into your own language.
    */
    $manrope = _x( 'on', 'Manrope font: on or off', 'sofass' );

    if ( 'off' !== $manrope ) {
        $font_families = array();
        if ( 'off' !== $manrope ) {
            $font_families[] = 'Manrope:300,300i,400,400i,500,600,700,800';
        }
        $query_args = array(
            'family' => ( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 		
 		$protocol = is_ssl() ? 'https:' : 'http:';
        $fonts_url = add_query_arg( $query_args, $protocol .'//fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function sofass_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'sofass_pingback_header' );

function sofass_admin_enqueue_styles() {
    
	// load font
	wp_enqueue_style( 'sofass-theme-fonts', sofass_get_fonts_url(), array(), null );

	wp_enqueue_style( 'all-awesome', get_template_directory_uri() . '/css/all-awesome.css', array(), '5.11.2' );

	// load font themify icon
	wp_enqueue_style( 'font-themify', get_template_directory_uri() . '/css/themify-icons.css', array(), '1.0.0' );

	// load font flaticon icon
	wp_enqueue_style( 'font-flaticon', get_template_directory_uri() . '/css/flaticon.css', array(), '1.0.0' );

}
add_action( 'admin_enqueue_scripts', 'sofass_admin_enqueue_styles', 100 );
/**
 * Enqueue styles.
 *
 * @since Sofass 1.3.7
 */
function sofass_enqueue_styles() {
	
	// load font
	wp_enqueue_style( 'sofass-theme-fonts', sofass_get_fonts_url(), array(), null );

	//load font awesome
	wp_enqueue_style( 'all-awesome', get_template_directory_uri() . '/css/all-awesome.css', array(), '5.11.2' );
    wp_enqueue_style( 'font-icomoon', get_template_directory_uri() . '/css/font-icomoon.css', array(), '1.0.0' );
	// load font themify icon
	wp_enqueue_style( 'font-themify', get_template_directory_uri() . '/css/themify-icons.css', array(), '1.0.0' );

	// load font flaticon icon
	wp_enqueue_style( 'font-flaticon', get_template_directory_uri() . '/css/flaticon.css', array(), '1.0.0' );
	
	wp_enqueue_style( 'font-eleganticon', get_template_directory_uri() . '/css/eleganticon-style.css', array(), '1.0.0' );
	
	// load animate version 3.6.0
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css', array(), '3.6.0' );

	// load bootstrap style
	if( is_rtl() ){
		wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/sass/bootstrap-rtl.css', array(), '3.2.0' );
	} else {
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/sass/bootstrap.css', array(), '3.2.0' );
	}
	// slick
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css', array(), '1.8.0' );
	// magnific-popup
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css', array(), '1.3.7' );
	// perfect scrollbar
	wp_enqueue_style( 'perfect-scrollbar', get_template_directory_uri() . '/css/perfect-scrollbar.css', array(), '0.6.12' );

	wp_enqueue_style( 'sliding-menu', get_template_directory_uri() . '/css/sliding-menu.min.css', array(), '0.3.0' );
	
	// main style
	wp_enqueue_style( 'sofass-wc-quantity-increment', get_template_directory_uri() .'/css/wc-quantity-increment.css' );

	wp_enqueue_style( 'sofass-woocommerce-smallscreen', get_template_directory_uri() .'/css/woocommerce-smallscreen.css' );

	wp_dequeue_style( 'woocommerce-smallscreen' ); 
	wp_enqueue_style( 'sofass-template', get_template_directory_uri() . '/sass/template.css', array(), '1.0' );
	
	$custom_style = sofass_custom_styles();
	if ( !empty($custom_style) ) {
		wp_add_inline_style( 'sofass-template', $custom_style );
	}
	wp_enqueue_style( 'sofass-style', get_template_directory_uri() . '/style.css', array(), '1.0' );

	wp_deregister_style('yith-wcwl-font-awesome');
}
add_action( 'wp_enqueue_scripts', 'sofass_enqueue_styles', 100 );
/**
 * Enqueue scripts.
 *
 * @since Sofass 1.3.7
 */
function sofass_enqueue_scripts() {
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	// bootstrap
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20150330', true );
	// slick
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array( 'jquery' ), '1.8.0', true );
	
	// countdown
	wp_register_script( 'countdown', get_template_directory_uri() . '/js/countdown.js', array( 'jquery' ), '20150315', true );
	wp_localize_script( 'countdown', 'sofass_countdown_opts', array(
		'days' => esc_html__('Days', 'sofass'),
		'hours' => esc_html__('Hrs', 'sofass'),
		'mins' => esc_html__('Mins', 'sofass'),
		'secs' => esc_html__('Secs', 'sofass'),
	));
	wp_enqueue_script( 'countdown' );
	// popup
	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery' ), '1.3.7', true );
	// unviel
	wp_enqueue_script( 'jquery-unveil', get_template_directory_uri() . '/js/jquery.unveil.js', array( 'jquery' ), '1.3.7', true );
	// perfect scrollbar
	wp_enqueue_script( 'perfect-scrollbar', get_template_directory_uri() . '/js/perfect-scrollbar.jquery.min.js', array( 'jquery' ), '0.6.12', true );
    
    if ( sofass_get_config('keep_header') ) {
		wp_enqueue_script( 'sticky', get_template_directory_uri() . '/js/sticky.min.js', array( 'jquery', 'elementor-waypoints' ), '4.0.1', true );
	}

	wp_enqueue_script( 'sliding-menu', get_template_directory_uri() . '/js/sliding-menu.min.js', array( 'jquery' ), '0.3.0', true );
	
	// main script
	wp_register_script( 'sofass-functions', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'sofass-functions', 'sofass_ajax', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'previous' => esc_html__('Previous', 'sofass'),
		'next' => esc_html__('Next', 'sofass'),
	));
	wp_enqueue_script( 'sofass-functions' );
	
	wp_add_inline_script( 'sofass-functions', "(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);" );

}
add_action( 'wp_enqueue_scripts', 'sofass_enqueue_scripts', 1 );

add_filter('http_request_timeout','http_request_timeout_callback');
function http_request_timeout_callback() {
    return 30000;    
}
/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Sofass 1.3.7
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function sofass_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'sofass_search_form_modify' );

/**
 * Function get opt_name
 *
 */
function sofass_get_opt_name() {
	return 'sofass_theme_options';
}
add_filter( 'goal_framework_get_opt_name', 'sofass_get_opt_name' );


function sofass_register_demo_mode() {
	if ( defined('SOFASS_DEMO_MODE') && SOFASS_DEMO_MODE ) {
		return true;
	}
	return false;
}
add_filter( 'goal_framework_register_demo_mode', 'sofass_register_demo_mode' );

function sofass_get_demo_preset() {
	$preset = '';
    if ( defined('SOFASS_DEMO_MODE') && SOFASS_DEMO_MODE ) {
        if ( isset($_REQUEST['_preset']) && $_REQUEST['_preset'] ) {
            $presets = get_option( 'goal_framework_presets' );
            if ( is_array($presets) && isset($presets[$_REQUEST['_preset']]) ) {
                $preset = $_REQUEST['_preset'];
            }
        } else {
            $preset = get_option( 'goal_framework_preset_default' );
        }
    }
    return $preset;
}

function sofass_get_config($name, $default = '') {
	global $sofass_options;
    if ( isset($sofass_options[$name]) ) {
        return $sofass_options[$name];
    }
    return $default;
}

function sofass_set_exporter_settings_option_keys($option_keys) {
	return array_merge($option_keys, array(
		'elementor_disable_color_schemes',
		'elementor_disable_typography_schemes',
		'elementor_allow_tracking',
		'elementor_cpt_support',
		'goal_salespopup_settings'
	));
}
add_filter( 'goal_exporter_settings_option_keys', 'sofass_set_exporter_settings_option_keys' );

function sofass_disable_one_click_import() {
	return false;
}
add_filter('goal_frammework_enable_one_click_import', 'sofass_disable_one_click_import');

function sofass_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Default', 'sofass' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Add widgets here to appear in your Sidebar.', 'sofass' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Topbar Right', 'sofass' ),
		'id'            => 'sidebar-topbar-right',
		'description'   => esc_html__( 'Add widgets here to appear in your Topbar Right.', 'sofass' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Blog sidebar', 'sofass' ),
		'id'            => 'blog-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'sofass' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );

	register_sidebar( array(
		'name' 				=> esc_html__( 'Shop Sidebar', 'sofass' ),
		'id' 				=> 'shop-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'sofass' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	));

	register_sidebar( array(
		'name' 				=> esc_html__( 'Shop Filter Sidebar', 'sofass' ),
		'id' 				=> 'shop-filter-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'sofass' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	));

	register_sidebar( array(
		'name' 				=> esc_html__( 'Shop Single Sidebar', 'sofass' ),
		'id' 				=> 'shop-single-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your single sidebar.', 'sofass' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	));

	register_sidebar( array(
		'name' 				=> esc_html__( 'Popup Newsletter', 'sofass' ),
		'id' 				=> 'popup-newsletter',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'sofass' ),
		'before_widget' => '<aside class="%2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	));

	register_sidebar( array(
		'name' 				=> esc_html__( 'Header Mobile Bottom', 'sofass' ),
		'id' 				=> 'header-mobile-bottom',
		'description'   => esc_html__( 'Add widgets here to appear in your header mobile.', 'sofass' ),
		'before_widget' => '<aside class="%2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="title"><span>',
		'after_title'   => '</span></h2>',
	));
}
add_action( 'widgets_init', 'sofass_widgets_init' );

function sofass_get_load_plugins() {

	$plugins[] = array(
		'name'                     => esc_html__( 'Goal Framework For Themes', 'sofass' ),
        'slug'                     => 'goal-framework',
        'required'                 => true ,
        'source'				   => get_template_directory() . '/inc/plugins/goal-framework.zip'
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Elementor Page Builder', 'sofass' ),
	    'slug'                     => 'elementor',
	    'required'                 => true,
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Revolution Slider', 'sofass' ),
        'slug'                     => 'revslider',
        'required'                 => true ,
        'source'				   => get_template_directory() . '/inc/plugins/revslider.zip'
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Cmb2', 'sofass' ),
	    'slug'                     => 'cmb2',
	    'required'                 => true,
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'MailChimp for WordPress', 'sofass' ),
	    'slug'                     => 'mailchimp-for-wp',
	    'required'                 =>  true
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Contact Form 7', 'sofass' ),
	    'slug'                     => 'contact-form-7',
	    'required'                 => true,
	);

	// woocommerce plugins
	$plugins[] = array(
		'name'                     => esc_html__( 'Woocommerce', 'sofass' ),
	    'slug'                     => 'woocommerce',
	    'required'                 => true,
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'WooCommerce Variation Swatches', 'sofass' ),
	    'slug'                     => 'variation-swatches-for-woocommerce',
	    'required'                 =>  false
	);

	$plugins[] = array(
        'name'     				   => esc_html__( 'WPC Smart Compare for WooCommerce', 'sofass' ),
        'slug'     				   => 'woo-smart-compare',
        'required' 				   => false,
    );
    
	$plugins[] = array(
        'name'     				   => esc_html__( 'WPC Smart Wishlist for WooCommerce', 'sofass' ),
        'slug'     				   => 'woo-smart-wishlist',
        'required' 				   => false,
    );

	$plugins[] = array(
		'name'                     => esc_html__( 'Goal Size Guides', 'sofass' ),
        'slug'                     => 'goal-sizeguides',
        'required'                 => true ,
        'source'				   => get_template_directory() . '/inc/plugins/goal-sizeguides.zip'
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Goal Lookbook', 'sofass' ),
        'slug'                     => 'goal-lookbook',
        'required'                 => true ,
        'source'				   => get_template_directory() . '/inc/plugins/goal-lookbook.zip'
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Goal Salespopup', 'sofass' ),
        'slug'                     => 'goal-salespopup',
        'required'                 => true ,
        'source'				   => get_template_directory() . '/inc/plugins/goal-salespopup.zip'
	);
	
	$plugins[] = array(
        'name'                  => esc_html__( 'One Click Demo Import', 'sofass' ),
        'slug'                  => 'one-click-demo-import',
        'required'              => false,
    );

	tgmpa( $plugins );
}

require get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/functions-helper.php';
require get_template_directory() . '/inc/functions-frontend.php';

/**
 * Implement the Custom Header feature.
 *
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/classes/megamenu.php';
require get_template_directory() . '/inc/classes/mobilemenu.php';
require get_template_directory() . '/inc/classes/mobileverticalmenu.php';

/**
 * Custom template tags for this theme.
 *
 */
require get_template_directory() . '/inc/template-tags.php';

if ( defined( 'GOAL_FRAMEWORK_REDUX_ACTIVED' ) ) {
	require get_template_directory() . '/inc/vendors/redux-framework/redux-config.php';
	define( 'SOFASS_REDUX_FRAMEWORK_ACTIVED', true );
}
if( sofass_is_cmb2_activated() ) {
	require get_template_directory() . '/inc/vendors/cmb2/page.php';
	require get_template_directory() . '/inc/vendors/cmb2/product.php';
	define( 'SOFASS_CMB2_ACTIVED', true );
}
if( sofass_is_woocommerce_activated() ) {
	require get_template_directory() . '/inc/vendors/woocommerce/functions.php';
	require get_template_directory() . '/inc/vendors/woocommerce/functions-search.php';
	require get_template_directory() . '/inc/vendors/woocommerce/functions-redux-configs.php';
	require get_template_directory() . '/inc/vendors/woocommerce/functions-swatches.php';
	require get_template_directory() . '/inc/vendors/woocommerce/functions-brand.php';
	require get_template_directory() . '/inc/vendors/woocommerce/functions-categories.php';
	require get_template_directory() . '/inc/vendors/woocommerce/walk-category.php';
	define( 'SOFASS_WOOCOMMERCE_ACTIVED', true );
	if ( sofass_is_dokan_activated() ) {
		require get_template_directory() . '/inc/vendors/dokan/functions.php';
		require get_template_directory() . '/inc/vendors/dokan/functions-redux-configs.php';
	}
}
if( sofass_is_goal_framework_activated() ) {
	require get_template_directory() . '/inc/widgets/custom_menu.php';
	require get_template_directory() . '/inc/widgets/popup_newsletter.php';
	require get_template_directory() . '/inc/widgets/recent_post.php';
	require get_template_directory() . '/inc/widgets/search.php';
	require get_template_directory() . '/inc/widgets/socials.php';

	if( sofass_is_woocommerce_activated() ) {
		require get_template_directory() . '/inc/widgets/woo-price-filter.php';
		require get_template_directory() . '/inc/widgets/woo-product-sorting.php';
		require get_template_directory() . '/inc/widgets/woo-layered-nav.php';
	}
	if ( did_action( 'elementor/loaded' ) ) {
		require get_template_directory() . '/inc/widgets/elementor-template.php';
	}
	define( 'SOFASS_FRAMEWORK_ACTIVED', true );
}
// add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
// add_filter( 'use_widgets_block_editor', '__return_false' );
if( sofass_is_dokan_activated() ) {
	require get_template_directory() . '/inc/vendors/dokan/functions.php';
}

require get_template_directory() . '/inc/vendors/elementor/functions.php';
require get_template_directory() . '/inc/vendors/one-click-demo-import/functions.php';

function sofass_register_post_types($post_types) {
	foreach ($post_types as $key => $post_type) {
		if ( $post_type == 'brand' || $post_type == 'testimonial' ) {
			unset($post_types[$key]);
		}
	}
	if ( !in_array('header', $post_types) ) {
		$post_types[] = 'header';
	}
	return $post_types;
}
add_filter( 'goal_framework_register_post_types', 'sofass_register_post_types' );

add_filter( 'http_request_host_is_external', '__return_true' );
/**
 * Customizer additions.
 *
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Styles
 *
 */
require get_template_directory() . '/inc/custom-styles.php';

