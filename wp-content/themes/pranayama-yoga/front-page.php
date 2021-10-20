<?php
/**
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pranayama Yoga
 */

$ed_section = pranayama_yoga_ed_section();
$pranayama_yoga_sections =  array( 'slider', 'about', 'info', 'yogaclasses', 'promotional', 'trainer', 'testimonials', 'blog', 'reason', 'subscription' );

if ( 'posts' == get_option( 'show_on_front' ) ) {
    include( get_home_template() );
} elseif ( $ed_section ) { 
    get_header();
    foreach( $pranayama_yoga_sections as $section ){ 
       if( get_theme_mod( 'pranayama_yoga_ed_' . $section . '_section' ) == 1 ){
            get_template_part( 'sections/' . esc_attr( $section ) );
        } 
    }
    get_footer();        
} else {
    include( get_page_template() );
}