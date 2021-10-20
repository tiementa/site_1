<?php
/**
 * Template Name: Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pranayama Yoga
 */
$sidebar_layout = pranayama_yoga_sidebar_layout();

 get_header();
    ?>
    <div id="content" class="site-content">
        <div class="container">
            <div class="row">
			    <div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">			
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						    <div class="post-thumbnail">
						    	<?php the_post_thumbnail(); ?>
						    </div>
						    <?php 
								while ( have_posts() ) : the_post(); ?> 
							        <div class="entry-content" itemprop="text">
							            <?php the_content(); ?> 
							        </div><!-- .entry-content -->
							    <?php endwhile; ?>
						</article><!-- #post-## -->
					</main><!-- #main -->
				</div>
				<?php if( $sidebar_layout == 'right-sidebar' ) get_sidebar(); ?>
			</div>
		</div>
	</div>
<?php
if( $sidebar_layout == 'right-sidebar' ) get_sidebar();
 get_footer();