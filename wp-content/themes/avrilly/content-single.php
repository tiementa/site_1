<?php
/**
 * The template used for displaying content single
 *
 * @package avrilly
 */
?>
						<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

							<div class="post-image">
								<?php if ( has_post_thumbnail() ) : 

										$avrilly_thumb_size = get_theme_mod( 'avrilly_sidebar_position' );
										if ((isset($avrilly_thumb_size)) && ($avrilly_thumb_size == 'mz-full-width')) $avrilly_thumbnail = 'avrilly-large-thumbnail';
										else $avrilly_thumbnail = 'avrilly-middle-thumbnail';

									?>
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail( $avrilly_thumbnail ); ?>
									</a>
								<?php endif; ?>
							</div>

							<div class="article-post-body">

							<div class="post-header">
								<div class="cat"><?php the_category( ' ' ); ?></div>
								<h1><?php the_title(); ?></h1>

								<div class="post-meta">
									<?php if ( 'post' == get_post_type() ) : ?>
										<span><i class="fa fa-calendar"></i><?php echo get_the_date(); ?></span>
										<span><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span>
										<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
											<span><i class="fa fa-commenting-o"></i><?php comments_popup_link( esc_html__( '0 Comments', 'avrilly' ), esc_html__( '1 Comment', 'avrilly' ), esc_html__( '% Comments', 'avrilly' ) ); ?></span>
										<?php endif; ?>
										<?php
											edit_post_link(
												sprintf(
													/* translators: %s: Name of current post */
													esc_html__( 'Edit %s', 'avrilly' ),
													the_title( '<span class="screen-reader-text">"', '"</span>', false )
												),
												'<span class="edit-link">',
												'</span>'
											);
									endif; ?>
								</div>

							</div>

							<div class="post-entry">
								<?php the_content(); ?>
								<?php			
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'avrilly' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
									'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'avrilly' ) . ' </span>%',
									'separator'   => '<span class="screen-reader-text">, </span>',
								) );
								?>
							</div>

							<div class="post-meta">
								<?php if(has_tag()) : ?>
								<!-- tags -->
								<div class="entry-tags">
									<?php
										$etags = get_the_tags(get_the_ID());
										foreach($etags as $etag){
											echo '<a href="'.esc_url(get_tag_link($etag->term_id)).'"><i class="fa fa-tags"></i>'.esc_html($etag->name).'</a> ';
										}
									?>

								</div>
								<!-- end tags -->
								<?php endif; ?>
							</div>

							</div>

						</article>