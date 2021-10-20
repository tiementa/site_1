<!--===// Start: Footer
    =================================-->
    <footer id="footer-section" class="footer-section footer footer-dark">
		<?php if ( is_active_sidebar( 'avril-footer-widget-area' ) ) { ?>
			<div class="footer-main">
				<div class="av-container">
					<div class="av-columns-area wow fadeInDown">
						<?php  dynamic_sidebar( 'avril-footer-widget-area' ); ?>
					</div>
				</div>
			</div>
		<?php } ?>	
		
    </footer>
    <!-- End: Footer
    =================================-->
	 <!-- ScrollUp -->
	 <?php 
		$hs_scroller 	= get_theme_mod('hs_scroller','1');	
		if($hs_scroller == '1') :
	?>
		<button type=button class="scrollup"><i class="fa fa-arrow-up"></i></button>
	<?php endif; ?>	
  <!-- / -->  
</div>
</div>
<?php 
wp_footer(); ?>
</body>
</html>
