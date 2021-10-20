<?php
/**
 * avrilly theme Customizer
 *
 * @package avrilly
 */

function avrilly_theme_options( $wp_customize ) {
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}

add_action( 'customize_register' , 'avrilly_theme_options' );

/**
 * Options for WordPress Theme Customizer.
 */
function avrilly_customizer( $wp_customize ) {

	global $avrilly_site_layout;

	/**
	 * Section: Color Settings
	 */

	// Change accent color
	$wp_customize->add_setting( 'avrilly_accent_color', array(
		'default'        => '#ffc3bd',
		'sanitize_callback' => 'avrilly_sanitize_hexcolor',
		'transport'  =>  'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'avrilly_accent_color', array(
		'label'     => __('Accent color','avrilly'),
		'section'   => 'colors',
		'priority'  => 1,
	)));

	/**
	 * Section: Theme layout options
	 */

	$wp_customize->add_section('avrilly_layout_section', 
		array(
			'priority' => 32,
			'title' => __('Layout options', 'avrilly'),
			'description' => __('Choose website layout', 'avrilly'),
			)
		);

		// Sidebar position
		$wp_customize->add_setting('avrilly_sidebar_position', array(
			'default' => 'mz-sidebar-right',
			'sanitize_callback' => 'avrilly_sanitize_layout'
		));

		$wp_customize->add_control('avrilly_sidebar_position', array(
			'priority'  => 1,
			'label' => __('Website Layout Options', 'avrilly'),
			'section' => 'avrilly_layout_section',
			'type'    => 'select',
			'description' => __('Choose between different layout options to be used as default', 'avrilly'),
			'choices'    => $avrilly_site_layout
		));

	/**
	 * Section: Change footer text
	 */

	// Change footer copyright text
	$wp_customize->add_setting( 'avrilly_footer_text', array(
		'default'        => '',
		'sanitize_callback' => 'avrilly_sanitize_input',
		'transport'  =>  'refresh',
	));

	$wp_customize->add_control( 'avrilly_footer_text', array(
		'label'     => __('Footer Copyright Text','avrilly'),
		'section'   => 'title_tagline',
		'priority'    => 31,
	));

	/**
	 * Section: Slider settings
	 */

	$wp_customize->add_section( 
		'avrilly_slider_options', 
		array(
			'priority'    => 33,
			'title'       => __( 'Slider Settings', 'avrilly' ),
			'capability'  => 'edit_theme_options',
			'description' => __('Change slider settings here.', 'avrilly'), 
		) 
	);

		// chose category for slider
		$wp_customize->add_setting( 'avrilly_slider_cat', array(
			'default' => 0,
			'transport'   => 'refresh',
			'sanitize_callback' => 'avrilly_sanitize_slidercat'
		) );	

		$wp_customize->add_control( 'avrilly_slider_cat', array(
			'priority'  => 1,
			'type' => 'select',
			'label' => __('Choose a category.', 'avrilly'),
			'choices' => avrilly_cats(),
			'section' => 'avrilly_slider_options',
		) );

		// checkbox show/hide slider
		$wp_customize->add_setting( 'show_avrilly_slider', array(
			'default'        => false,
			'transport'  =>  'refresh',
			'sanitize_callback' => 'avrilly_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'show_avrilly_slider', array(
			'priority'  => 2,
			'label'     => __('Show Slider?','avrilly'),
			'section'   => 'avrilly_slider_options',
			'type'      => 'checkbox',
		) );

}

add_action( 'customize_register', 'avrilly_customizer' );

/**
 * Adds sanitization for text inputs
 */
function avrilly_sanitize_input($input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Adds sanitization callback function: Slider Category
 */
function avrilly_sanitize_slidercat( $input ) {
	if ( array_key_exists( $input, avrilly_cats()) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitze checkbox for WordPress customizer
 */
function avrilly_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Sanitze number for WordPress customizer
 */
function avrilly_sanitize_number($input) {
	if ( isset( $input ) && is_numeric( $input ) ) {
		return $input;
	}
}

/**
 * Sanitze blog layout
 */
function avrilly_sanitize_layout( $input ) {
	global $avrilly_site_layout;
	if ( array_key_exists( $input, $avrilly_site_layout ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitze thumbs layout
 */
function avrilly_sanitize_thumbs( $input ) {
	global $avrilly_thumbs_layout;
	if ( array_key_exists( $input, $avrilly_thumbs_layout ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitze colors
 */
function avrilly_sanitize_hexcolor($color)
{
	if ($unhashed = sanitize_hex_color_no_hash($color)) {
		return '#'.$unhashed;
	}

	return $color;
}