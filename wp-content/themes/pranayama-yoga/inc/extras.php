<?php 
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package pranayama_yoga
 */

if( ! function_exists( 'pranayama_yoga_get_post_meta' ) ) :
/**
 * Post meta info
*/
function pranayama_yoga_get_post_meta(){    
    printf( '<span class="byline"><a class="url fn n" href="%1$s">%2$s</a></span>', esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), esc_html( get_the_author() ) );

    if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link">';
        /* translators: %s: post title */
            comments_popup_link( esc_html__( 'Leave a comment', 'pranayama-yoga' ), esc_html__( '1 Comment', 'pranayama-yoga' ), esc_html__( '% Comments', 'pranayama-yoga' ) );
        echo '</span>';
    }

	printf( '<span class="posted-on"><a href="%1$s" rel="bookmark"><time class="entry-date published updated" datetime="%2$s">%3$s</time></a></span>', esc_url( get_permalink() ), esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date( 'j M Y' ) ) );
}
endif;

if ( ! function_exists( 'pranayama_yoga_entry_footer' ) ) :
/**
 * Prints edit links
 */
function pranayama_yoga_entry_footer() {	

    	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'pranayama-yoga' ) );
		if ( $categories_list && pranayama_yoga_categorized_blog() ) {
			echo '<span class="cat-links">' . $categories_list . '</span>'; // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'pranayama-yoga' ) );
		if ( $tags_list ) {
			echo '<span class="tag-links">' . $tags_list . '</span>'; // WPCS: XSS OK.
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'pranayama-yoga' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function pranayama_yoga_categorized_blog() {
	
	if ( false === ( $all_the_cool_cats = get_transient( 'pranayama_yoga_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'pranayama_yoga_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so pranayama_yoga_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so pranayama_yoga_categorized_blog should return false.
		return false;
	}
}

/**
 * Return sidebar layouts for pages
*/
function pranayama_yoga_sidebar_layout(){
    global $post;
    
    if( get_post_meta( $post->ID, 'pranayama_yoga_sidebar_layout', true ) ){
        return get_post_meta( $post->ID, 'pranayama_yoga_sidebar_layout', true );    
    }else{
        return 'right-sidebar';
    }
}

if( ! function_exists( 'pranayama_yoga_pagination' ) ):

	function pranayama_yoga_pagination(){
        
    if( is_single() ){
        the_post_navigation();
    }else{
        the_posts_pagination( array(
            'prev_text'          => __( 'Prev', 'pranayama-yoga' ),
            'next_text'          => __( 'Next', 'pranayama-yoga' ),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'pranayama-yoga' ) . ' </span>',
        ) );
    }
}
endif;

if( ! function_exists('pranayama_yoga_social_cb')):
/** Callback for Social Links */
 function pranayama_yoga_social_cb(){
    $facebook  = get_theme_mod( 'pranayama_yoga_facebook' );
    $twitter   = get_theme_mod( 'pranayama_yoga_twitter' );
    $google    = get_theme_mod( 'pranayama_yoga_google_plus' );
    $pinterest = get_theme_mod( 'pranayama_yoga_pinterest' );
    $linkedin  = get_theme_mod( 'pranayama_yoga_linkedin' );
    $instagram = get_theme_mod( 'pranayama_yoga_instagram' );
    $youtube   = get_theme_mod( 'pranayama_yoga_youtube' );
    $ok        = get_theme_mod( 'pranayama_yoga_ok' );
    $vk        = get_theme_mod( 'pranayama_yoga_vk' );
    $xing      = get_theme_mod( 'pranayama_yoga_xing' );
    
    if( $facebook || $twitter || $google || $linkedin || $pinterest || $instagram || $youtube || $ok || $vk || $xing ){
    ?>
    <ul class="social-networks">
      
      <?php if( $facebook ){ ?>
            
            <li><a href="<?php echo esc_url( $facebook );?>" target="_blank" title="<?php esc_attr_e( 'Facebook', 'pranayama-yoga' ); ?>"><span class="fa fa-facebook"></span></a></li>
      
      <?php } if( $twitter ){?>    
           
            <li><a href="<?php echo esc_url( $twitter );?>" target="_blank" title="<?php esc_attr_e( 'Twitter', 'pranayama-yoga' ); ?>"><span class="fa fa-twitter"></span></a></li>
      
      <?php } if( $google ){?>
            
            <li><a href="<?php echo esc_url( $google );?>" target="_blank" title="<?php esc_attr_e( 'Google Plus', 'pranayama-yoga' ); ?>"><span class="fa fa-google-plus"></span></a></li>
      
      <?php } if( $linkedin ){?>
            
            <li><a href="<?php echo esc_url( $linkedin );?>" target="_blank" title="<?php esc_attr_e( 'LinkedIn', 'pranayama-yoga' ); ?>"><span class="fa fa-linkedin"></span></a></li>

      <?php } if( $pinterest ){?>
            
            <li><a href="<?php echo esc_url( $pinterest );?>" target="_blank" title="<?php esc_attr_e( 'Pinterest', 'pranayama-yoga' ); ?>"><span class="fa fa-pinterest"></span></a></li>

      <?php } if( $instagram ){?>
            
            <li><a href="<?php echo esc_url( $instagram );?>" target="_blank" title="<?php esc_attr_e( 'Instagram', 'pranayama-yoga' ); ?>"><span class="fa fa-instagram"></span></a></li>

      <?php } if( $youtube ){?>
            
            <li><a href="<?php echo esc_url( $youtube );?>" target="_blank" title="<?php esc_attr_e( 'Youtube', 'pranayama-yoga' ); ?>"><span class="fa fa-youtube"></span></a></li>
        
       <?php } if( $ok ){ ?>

            <li><a href="<?php echo esc_url( $ok ); ?>" target="_blank" title="<?php esc_attr_e( 'OK', 'pranayama-yoga' );?>"><i class="fa fa-odnoklassniki"></i></a></li>

        <?php } if( $vk ){ ?>
                
            <li><a href="<?php echo esc_url( $vk ); ?>" target="_blank" title="<?php esc_attr_e( 'VK', 'pranayama-yoga' );?>"><i class="fa fa-vk"></i></a></li>
                
        <?php } if( $xing ){ ?>
           
            <li><a href="<?php echo esc_url( $xing ); ?>" target="_blank" title="<?php esc_attr_e( 'Xing', 'pranayama-yoga' );?>"><i class="fa fa-xing"></i></a></li>

        <?php } ?>
    </ul>
    <?php
    }
 }
 endif;

 if( ! function_exists( 'pranayama_yoga_ed_section') ):
    /**
     * Check if home page section are enable or not.
    */
    function pranayama_yoga_ed_section(){
        $pranayama_yoga_sections = array( 'slider', 'about', 'info', 'yogaclasses', 'promotional', 'trainer', 'testimonials', 'blog', 'reason', 'subscription' );
        $en_sec = false;
        foreach( $pranayama_yoga_sections as $section ){ 
            if( get_theme_mod( 'pranayama_yoga_ed_' . $section . '_section' ) == 1 ){
                $en_sec = true;
            }
        }
        return $en_sec;
    }
endif;

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
	/**
	 * Triggered after the opening <body> tag.
    */
	do_action( 'wp_body_open' );
}
endif;

if( ! function_exists( 'pranayama_yoga_get_image_sizes' ) ) :
/**
 * Get information about available image sizes
 */
function pranayama_yoga_get_image_sizes( $size = '' ) {
 
    global $_wp_additional_image_sizes;
 
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
 
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array( 
                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    } 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
endif;

if ( ! function_exists( 'pranayama_yoga_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function pranayama_yoga_get_fallback_svg( $post_thumbnail ) {
    if( ! $post_thumbnail ){
        return;
    }
    
    $image_size = pranayama_yoga_get_image_sizes( $post_thumbnail );
     
    if( $image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:#dedbdb;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

if( ! function_exists( 'pranayama_yoga_fonts_url' ) ) :
/**
 * Register custom fonts.
 */
function pranayama_yoga_fonts_url() {
    $fonts_url = '';

    /*
    * translators: If there are characters in your language that are not supported
    * by Catamaran, translate this to 'off'. Do not translate into your own language.
    */
    $catamaran = _x( 'on', 'Catamaran font: on or off', 'pranayama-yoga' );
    
    /*
    * translators: If there are characters in your language that are not supported
    * by Nunito, translate this to 'off'. Do not translate into your own language.
    */
    $nunito = _x( 'on', 'Nunito font: on or off', 'pranayama-yoga' );

    if ( 'off' !== $catamaran || 'off' !== $nunito ) {
        $font_families = array();

        if( 'off' !== $catamaran ){
            $font_families[] = 'Catamaran:100,400,500,600,700,800';
        }

        if( 'off' !== $nunito ){
            $font_families[] = 'Nunito:700';
        }

        $query_args = array(
            'family'  => urlencode( implode( '|', $font_families ) ),
            'display' => urlencode( 'fallback' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url( $fonts_url );
}
endif;