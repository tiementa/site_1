<?php
/**
 *
 * @package avrilly
 */

global $avrilly_site_layout;
$avrilly_site_layout = array(
					'mz-sidebar-left' =>  esc_html__('Left Sidebar','avrilly'),
					'mz-sidebar-right' => esc_html__('Right Sidebar','avrilly'),
					'no-sidebar' => esc_html__('No Sidebar','avrilly')
					);
$avrilly_thumbs_layout = array(
					'landscape' =>  esc_html__('Landscape','avrilly'),
					'portrait' => esc_html__('Portrait','avrilly')
					);

if ( ! function_exists( 'avrilly_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function avrilly_setup() {

	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	*/
	load_theme_textdomain( 'avrilly', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'avrilly-slider-thumbnail', 700, 390, true );
	add_image_size( 'avrilly-large-thumbnail', 1140, 640, true );
	add_image_size( 'avrilly-middle-thumbnail', 730, 476, true );
	add_image_size( 'avrilly-author-thumbnail', 170, 170, true );
	add_image_size( 'avrilly-small-thumbnail', 100, 80, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'footer-menu' => esc_html__( 'Footer Menu', 'avrilly' ),
		'primary' => esc_html__( 'Primary Menu', 'avrilly' ),
	) );

	// Set the content width based on the theme's design and stylesheet.
	global $content_width;
	if ( ! isset( $content_width ) ) {
	$content_width = 1140; /* pixels */
	} 

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support( 'html5', array(
		'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'editor-style.css' );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-logo', array(
		'height'      => 77,
		'width'       => 240,
		'flex-width'  => false,
		'flex-height' => true,
	) );

}
endif; // avrilly_setup
add_action( 'after_setup_theme', 'avrilly_setup' );


/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
if ( ! function_exists( 'avrilly_the_custom_logo' ) ) :
function avrilly_the_custom_logo() {
	// Try to retrieve the Custom Logo
	if ((function_exists('the_custom_logo'))&&(has_custom_logo())) {
		the_custom_logo();
	} else {
		// Nothing in the output: Custom Logo is not supported, or there is no selected logo
		// In both cases we display the site's name
		echo '<hgroup><h1><a href="' . esc_url(home_url('/')) . '" rel="home">' . esc_html(get_bloginfo('name')) . '</a></h1><div class="description">'.esc_html(get_bloginfo('description')).'</div></hgroup>';
	}
}
endif; // neila_custom_logo

/*
 * Add Bootstrap classes to the main-content-area wrapper.
 */
if ( ! function_exists( 'avrilly_content_bootstrap_classes' ) ) :
function avrilly_content_bootstrap_classes() {
	if ( is_page_template( 'template-fullwidth.php' ) ) {
		return 'col-md-12';
	}
	return 'col-md-8';
}
endif; // avrilly_content_bootstrap_classes

/*
 * Checked if function is exits, if not exits then make a function called wp_body_open();
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/*
 * Generate categories for slider customizer
 */
function avrilly_cats() {
	$cats = array();
	$cats[0] = esc_html__("All", "avrilly");
	
	foreach ( get_categories() as $categories => $category ) {
		$cats[$category->term_id] = $category->name;
	}

	return $cats;
}

/*
 * generate navigation from default bootstrap classes
 */
include( get_template_directory() . '/inc/wp_bootstrap_navwalker.php');

if ( ! function_exists( 'avrilly_header_menu' ) ) :
/*
 * Header menu (should you choose to use one)
 */
function avrilly_header_menu() {

	$avrilly_menu_center = get_theme_mod( 'avrilly_menu_center' );

	/* display the WordPress Custom Menu if available */
	$avrilly_add_center_class = "";
	if ( true == $avrilly_menu_center ) {
		$avrilly_add_center_class = " navbar-center";
	}

	wp_nav_menu(array(
		'theme_location'    => 'primary',
		'depth'             => 3,
		'container'         => 'div',
		'container_class'   => 'collapse navbar-collapse navbar-ex2-collapse'.$avrilly_add_center_class,
		'menu_class'        => 'nav navbar-nav',
		'fallback_cb'       => 'avrilly_bootstrap_navwalker::fallback',
		'walker'            => new avrilly_bootstrap_navwalker()
	));
} /* end header menu */
endif;

if ( ! function_exists( 'avrilly_top_menu' ) ) :
/*
 * Header menu (should you choose to use one)
 */
function avrilly_top_menu() {

	wp_nav_menu(array(
		'theme_location'    => 'top-menu',
		'depth'             => 2,
		'container'         => 'div',
		'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
		'menu_class'        => 'nav navbar-nav',
		'fallback_cb'       => 'avrilly_bootstrap_navwalker::fallback',
		'walker'            => new avrilly_bootstrap_navwalker()
	));
} /* end header menu */
endif;

/*
 * Register Google fonts for theme.
 */
if ( ! function_exists( 'avrilly_fonts_url' ) ) :
/**
 * Create your own avrilly_fonts_url() function to override in a child theme.
 *
 * @since avrilly 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function avrilly_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Crimson Text, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Muli font: on or off', 'avrilly' ) ) {
		$fonts[] = 'Muli:400,400italic,600,600italic,700,700italic,800,800italic,900,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Noto Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'avrilly' ) ) {
		$fonts[] = 'Open Sans:400,500,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/*
 * load css/js
 */
function avrilly_scripts() {

	// Add Google Fonts
	wp_enqueue_style( 'avrilly-webfonts', avrilly_fonts_url(), array(), null, null );

	// Add Bootstrap default CSS
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css' );

	// Add main theme stylesheet
	wp_enqueue_style( 'avrilly-style', get_stylesheet_uri() );

	// Add JS Files
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery') );
	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/js/slick.min.js', array('jquery') );
	wp_enqueue_script( 'avrilly-js', get_template_directory_uri().'/js/avrilly.js', array('jquery') );

	// Threaded comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'avrilly_scripts' );

/*
 * Add custom colors css to header
 */
if (!function_exists('avrilly_custom_css_output'))  {
	function avrilly_custom_css_output() {

		$avrilly_accent_color = get_theme_mod( 'avrilly_accent_color' );

		echo '<style type="text/css" id="avrilly-custom-theme-css">';

		if ( $avrilly_accent_color != "") {
			echo '.widget-title span, .widget ul li a:hover { box-shadow: ' . esc_attr($avrilly_accent_color) . ' 0 -3px 0 inset;}' .
			'.nav>li>a:focus, .nav>li>a:hover, .dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover, .post-header .cat a:hover, #back-top a { background-color: ' . esc_attr($avrilly_accent_color) . '; }' .
			'.post-header .cat a, .page-numbers li a, .widget_tag_cloud a, .widget_tag_cloud a:hover { border-color: ' . esc_attr($avrilly_accent_color) . '; }' .
			'.post-meta span i, .post-header span i, blockquote:before { color: ' . esc_attr($avrilly_accent_color) . '; }' .
			'.read-more a, .ot-widget-about-author .author-post .read-more a, .null-instagram-feed p a, button, input[type="button"], input[type="reset"], input[type="submit"], .comments-title { background-color:' . esc_attr($avrilly_accent_color) . '}' .
			'.comment-reply-link:hover, .comment-reply-login:hover, .page-numbers .current, .page-numbers li a:hover, .ot-widget-socials a, .widget_search button { border-color: ' . esc_attr($avrilly_accent_color) . '; background-color: ' . esc_attr($avrilly_accent_color) . ';}';
		}

		echo '</style>';

	}
}
add_action( 'wp_head', 'avrilly_custom_css_output');

/*
 * Customizer additions.
 */
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';

/*
 * Register widget areas.
 */

// if no title then add widget content wrapper to before widget
add_filter( 'dynamic_sidebar_params', 'avrilly_check_sidebar_params' );
function avrilly_check_sidebar_params( $params ) {
	global $wp_registered_widgets;

	$settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
	$settings = $settings_getter->get_settings();
	$settings = $settings[ $params[1]['number'] ];

	if ( $params[0][ 'after_widget' ] == '</div></div>' && isset( $settings[ 'title' ] ) && empty( $settings[ 'title' ] ) )
		$params[0][ 'before_widget' ] .= '<div class="content">';

	return $params;
}

function avrilly_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'avrilly' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the left.', 'avrilly' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );

}
add_action( 'widgets_init', 'avrilly_widgets_init' );

/*
 * Misc. functions
 */

/**
 * Footer credits
 */
function avrilly_footer_credits() {
	$avrilly_footer_text = sanitize_text_field ( get_theme_mod( 'avrilly_footer_text' ) );
	?>
	<div class="site-info">
	<?php if ($avrilly_footer_text == '') { ?>
	&copy; <?php bloginfo( 'name' ); ?><?php esc_html_e('. All rights reserved.', 'avrilly'); ?>
	<?php } else { echo esc_html( $avrilly_footer_text ); } ?>
	</div><!-- .site-info -->

	<?php
	/* translators: %1$s and %2$s is replaced with links to developer website and WordPress.org website */
	printf( esc_html__( 'Theme by %1$s Powered by %2$s', 'avrilly' ) , '<a href="https://moozthemes.com" rel="nofollow" target="_blank">MOOZ Themes</a>', '<a href="http://wordpress.org/" target="_blank">WordPress</a>');
}
add_action( 'avrilly_footer', 'avrilly_footer_credits' );

/* Wrap Post count in a span */
add_filter('wp_list_categories', 'avrilly_cat_count_span');
function avrilly_cat_count_span($links) {
	$links = str_replace('</a> (', '</a> <span>', $links);
	$links = str_replace(')', '</span>', $links);
	return $links;
}

/* Change excerpt to 40 words */
function avrilly_excerpt_length( $length ) {
	if ( is_admin() ) {
		return $length;
	}
	return 40;
}
add_filter( 'excerpt_length', 'avrilly_excerpt_length', 999 );