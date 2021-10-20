<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package avrilly
 */

/*
 * avrilly Slider
 */
if ( ! function_exists( 'avrilly_slider' ) ) :

/*
 * Featured image slider, displayed on front page for static page and blog
 */
function avrilly_slider() {

	$show_avrilly_slider = get_theme_mod( 'show_avrilly_slider' );
	$show_avrilly_slider = isset($show_avrilly_slider) ? $show_avrilly_slider : '';

	if ( ( is_home() || is_front_page() ) && $show_avrilly_slider == true ) {

		echo '<div class="container-fluid2"><div class="mz-slider">';

		$count = 4;
		$slidecat = get_theme_mod( 'avrilly_slider_cat' );
		$slidecat = isset($slidecat) ? $slidecat : '';
		$active_slide = "active";

		$query = new WP_Query( array( 'cat' => $slidecat,'posts_per_page' => $count ) );

		if ($query->have_posts()) :
			while ($query->have_posts()) : $query->the_post();

				$num_comments = get_comments_number(); // get_comments_number returns only a numeric value

				if ( comments_open() ) {
					if ( $num_comments == 0 ) {
						$comments = __('No Comments','avrilly');
					} elseif ( $num_comments > 1 ) {
						$comments = $num_comments . __(' Comments','avrilly');
					} else {
						$comments = __('1 Comment','avrilly');
					}
					$write_comments = $comments;
				} else {
					$write_comments =  __('Comments are off for this post.','avrilly');
				}

				echo '<div><div class="mz-slider-item">';
				echo '<a href="' . esc_url(get_permalink()) . '">';
				if ( (function_exists( 'has_post_thumbnail' )) && ( has_post_thumbnail() ) ) :
					echo get_the_post_thumbnail( get_the_ID(), 'avrilly-slider-thumbnail' );
				endif;

				echo '<div class="mz-slide-title">';
				if ( get_the_title() != '' ) {
					echo '<h2 class="entry-title">'. esc_html(get_the_title()).'</h2>';
					echo '<div class="post-meta">';
					echo '<span><i class="fa fa-clock-o"></i>'. get_the_date(). '</span>';
					if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) :
						echo '<span><i class="fa fa-comment-o"></i>'.esc_html($write_comments).'</span>';
					endif;
					echo '</div>';

				}
				echo '</div>'; // .mz-slide-title
				echo '</a>';
				echo '</div>'; // .mz-slider-item
				echo '</div>';
				$active_slide = "";

			endwhile; wp_reset_postdata();
		endif;

		echo '</div></div>';
	}

}
endif;

/**
 * Returns just the URL of an image attachment.
 *
 * @param int $image_id The Attachment ID of the desired image.
 * @param string $size The size of the image to return.
 * @return bool|string False on failure, image URL on success.
 */
function avrilly_get_image_src( $image_id, $size = 'full' ) {
	$img_attr = wp_get_attachment_image_src( intval( $image_id ), $size );
	if ( ! empty( $img_attr[0] ) ) {
		return $img_attr[0];
	}
}

/*
 * Add boostrap classes fot tables
 */
add_filter( 'the_content', 'avrilly_add_custom_table_class' );

function avrilly_add_custom_table_class( $content ) {
	return str_replace( '<table>', '<table class="table table-hover">', $content );
}