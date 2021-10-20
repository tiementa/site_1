<?php get_header(); ?>
		
	<div id="primary" class="content-area">
		<?php $avrilly_paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
		<main id="main" class="site-main <?php echo "page-".esc_html($avrilly_paged);?>" role="main">
		
			<?php if ( have_posts() ) : ?>

				<div class="article-container">
	
					<?php
					// Start the loop.
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );

					// End the loop.
					endwhile;
					?>

				</div>

	<?php

	// Previous/next page navigation.
	the_posts_pagination( array(
		'type'          => 'list',
		'prev_text'          => __( 'Previous page', 'avrilly' ),
		'next_text'          => __( 'Next page', 'avrilly' )
	) );


// If no content, include the "No posts found" template.
else :

	get_template_part( 'content', 'none' );

endif;
?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();

get_footer();