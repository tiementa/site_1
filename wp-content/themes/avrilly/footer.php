<?php
/**
 * The template used for displaying content single
 *
 * @package avrilly
 */
?>


				</div><!-- END #content -->
			
			</div><!-- END .row -->
		
		</div><!-- END .container -->

		<footer class="mz-footer" id="footer">
			<div class="container">

					<?php if ( has_nav_menu( 'footer-menu' ) ) { ?>
						<div class="mz-footer-menu">
							<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_id' => 'footer-menu' ) ); ?>
						</div>
					<?php } ?>

					<div class="mz-footer-bottom">
						<?php do_action('avrilly_footer'); ?>
					</div>

			</div>
		</footer>

		<!-- back to top button -->
		<p id="back-top">
			<a href="#top"><i class="fa fa-angle-up"></i></a>
		</p>

		<?php wp_footer(); ?>

	</body>
</html>