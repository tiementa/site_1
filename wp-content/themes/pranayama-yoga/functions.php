<?php
/**
 * Pranayama Yoga functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Pranayama_Yoga
 */

$pranayama_yoga_theme_data = wp_get_theme();
if( ! defined( 'PRANAYAMA_YOGA_THEME_VERSION' ) ) define ( 'PRANAYAMA_YOGA_THEME_VERSION', $pranayama_yoga_theme_data->get( 'Version' ) );
if( ! defined( 'PRANAYAMA_YOGA_THEME_NAME' ) ) define( 'PRANAYAMA_YOGA_THEME_NAME', $pranayama_yoga_theme_data->get( 'Name' ) );

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Metabox for Sidebar Layout
*/
require get_template_directory() .'/inc/metabox.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 ** Custom template functions for this theme.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Widgets.
 */
require get_template_directory() .'/inc/widgets/widgets.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Getting Started
*/
require get_template_directory() . '/inc/getting-started/getting-started.php';
/**
 * Info Section
 */
require get_template_directory() . '/inc/info.php';

/**
 * TGMPA Plugin Recommendation
 */
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';