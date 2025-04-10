<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ClearViewShield
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="footer-widgets">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="footer-widget-area footer-widget-1">
							<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
								<?php dynamic_sidebar( 'footer-1' ); ?>
							<?php else : ?>
								<div class="footer-logo">
									<?php
									if ( has_custom_logo() ) :
										the_custom_logo();
									else :
										?>
										<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
									<?php endif; ?>
								</div>
								<p class="footer-description">Professional mobile windshield repair service in Cedar Rapids, Marion, Hiawatha, and Linn County, Iowa. We come to you for convenient, quality repairs.</p>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="footer-widget-area footer-widget-2">
							<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
								<?php dynamic_sidebar( 'footer-2' ); ?>
							<?php else : ?>
								<h3 class="widget-title">Contact Us</h3>
								<ul class="contact-info">
									<li><i class="fas fa-phone-alt"></i> <a href="tel:3197750717">319-775-0717</a></li>
									<li><i class="fas fa-envelope"></i> <a href="mailto:info@clearviewshield.com">info@clearviewshield.com</a></li>
									<li><i class="fas fa-map-marker-alt"></i> Cedar Rapids, Iowa</li>
								</ul>
								<div class="social-links">
									<a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
									<a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
									<a href="#" class="social-link"><i class="fab fa-google"></i></a>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="col-md-4">
						<div class="footer-widget-area footer-widget-3">
							<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
								<?php dynamic_sidebar( 'footer-3' ); ?>
							<?php else : ?>
								<h3 class="widget-title">Hours</h3>
								<ul class="hours-list">
									<li><span>Monday - Friday:</span> 8:00 AM - 6:00 PM</li>
									<li><span>Saturday:</span> 9:00 AM - 4:00 PM</li>
									<li><span>Sunday:</span> Closed</li>
								</ul>
								<div class="cta-button">
									<a href="<?php echo esc_url( home_url( '/booking/' ) ); ?>" class="btn btn-primary">Book Your Repair</a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="site-info">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="copyright">
							&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved.
						</div>
					</div>
					<div class="col-md-6">
						<nav class="footer-navigation">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'footer',
									'menu_id'        => 'footer-menu',
									'container'      => false,
									'depth'          => 1,
									'fallback_cb'    => false,
								)
							);
							?>
						</nav>
					</div>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
