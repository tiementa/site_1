<?php
/**
 *
 * The template used for displaying articles & search results
 *
 * @package avrilly
 */
$avrilly_options = get_theme_mods();

?>
					<article  id="post-<?php the_ID(); ?>" <?php post_class("list-post"); ?>>

						<div class="post-inner-content">

							<?php if ( has_post_thumbnail() ) : ?>
							<div class="post-image">
									<?php
										$avrilly_thumb_size = array_key_exists('avrilly_sidebar_position', $avrilly_options) ? $avrilly_options['avrilly_sidebar_position'] : '';
										$avrilly_thumbnail = 'avrilly-landscape-thumbnail';
										if ($avrilly_thumb_size == 'mz-full-width') $avrilly_thumbnail = 'avrilly-large-thumbnail';
									?>
									
									<?php echo get_the_post_thumbnail( get_the_ID(), $avrilly_thumbnail ); ?>

							</div>
							<?php endif; ?>
							<div class="list-post-body">

								<div class="post-header">

									<span class="cat"><?php the_category( ' ' ); ?></span>
									<h2><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

									<div class="post-meta">
										<span><i class="fa fa-calendar"></i><?php echo get_the_date(); ?></span>
										<span><i class="fa fa-user"></i><?php echo get_the_author(); ?></span>
									</div>


									<?php the_excerpt(); ?>
									
								</div>

								
							</div>

						</div><!-- end: post-inner-content -->

					</article>
