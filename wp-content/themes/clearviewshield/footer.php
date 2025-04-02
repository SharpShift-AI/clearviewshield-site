<?php
/**
 * The footer for our theme
 *
 * @package ClearViewShield
 */
?>

	<footer id="colophon" class="site-footer">
		<div class="container">
			<div class="footer-container">
				<div class="footer-column">
					<h3 class="footer-title">About ClearViewShield</h3>
					<div class="footer-content">
						<p>Since 2021, ClearViewShield has been providing mobile windshield repair services to Cedar Rapids and surrounding areas. We come to you for convenient $75 repairs backed by our lifetime warranty.</p>
					</div>
				</div>
				
				<div class="footer-column">
					<h3 class="footer-title">Contact Us</h3>
					<div class="contact-info">
						<p><i class="fas fa-phone"></i> <a href="tel:3197750717">319-775-0717</a></p>
						<p><i class="fas fa-envelope"></i> <a href="mailto:info@clearviewshield.com">info@clearviewshield.com</a></p>
						<p><i class="fas fa-map-marker-alt"></i> Mobile Service - Cedar Rapids, IA</p>
					</div>
					<div class="social-icons">
						<a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
						<a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
						<a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
						<a href="#" class="social-icon"><i class="fab fa-google"></i></a>
					</div>
				</div>
				
				<div class="footer-column">
					<h3 class="footer-title">Quick Links</h3>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'footer',
							'menu_class'     => 'footer-menu',
							'fallback_cb'    => false,
						)
					);
					?>
				</div>
			</div>
			
			<div class="copyright">
				<p>&copy; <?php echo date('Y'); ?> ClearViewShield LLC. All rights reserved. <a href="<?php echo esc_url(home_url('/terms-of-use')); ?>">Terms of Use</a></p>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
