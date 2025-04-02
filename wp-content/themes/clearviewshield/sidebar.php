<?php
/**
 * The sidebar containing the main widget area
 *
 * @package ClearViewShield
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	
	<div class="sidebar-cta">
		<h3>Need Windshield Repair?</h3>
		<p>We come to you in Cedar Rapids, Marion, Hiawatha, and throughout Linn County.</p>
		<p class="price-tag">Just $75</p>
		<p class="warranty-note">Lifetime Warranty Included</p>
		<div class="sidebar-buttons">
			<?php clearviewshield_cta_button('Book Online', home_url('/booking')); ?>
			<p class="or-text">or</p>
			<?php clearviewshield_phone_button('Call 319-775-0717'); ?>
		</div>
	</div>
</aside><!-- #secondary -->
