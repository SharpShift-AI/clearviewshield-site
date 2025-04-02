<?php
/**
 * Custom template tags for ClearViewShield theme
 *
 * @package ClearViewShield
 */

if ( ! function_exists( 'clearviewshield_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function clearviewshield_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'clearviewshield' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'clearviewshield_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function clearviewshield_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'clearviewshield' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'clearviewshield_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function clearviewshield_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'clearviewshield' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'clearviewshield' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'clearviewshield' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'clearviewshield' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'clearviewshield' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'clearviewshield' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'clearviewshield_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function clearviewshield_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

/**
 * Display the ClearViewShield booking form
 */
function clearviewshield_display_booking_form() {
    ob_start();
    ?>
    <div class="booking-form">
        <form id="clearviewshield-booking-form" action="#" method="post">
            <div class="form-group">
                <label for="service-type">Service Type</label>
                <select id="service-type" name="service-type" required>
                    <option value="">Select Service</option>
                    <option value="rock-chip">Rock Chip Repair</option>
                    <option value="crack">Crack Repair (up to 6 inches)</option>
                    <option value="multiple">Multiple Damage Points</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="booking-date">Preferred Date</label>
                <input type="date" id="booking-date" name="booking-date" required min="<?php echo date('Y-m-d'); ?>">
            </div>
            
            <div class="form-group">
                <label for="booking-time">Preferred Time</label>
                <select id="booking-time" name="booking-time" required>
                    <option value="">Select Time</option>
                    <option value="morning">Morning (8am-12pm)</option>
                    <option value="afternoon">Afternoon (12pm-5pm)</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="customer-name">Your Name</label>
                <input type="text" id="customer-name" name="customer-name" required>
            </div>
            
            <div class="form-group">
                <label for="customer-phone">Phone Number</label>
                <input type="tel" id="customer-phone" name="customer-phone" required pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="319-555-1234">
                <small>Format: 319-555-1234</small>
            </div>
            
            <div class="form-group">
                <label for="customer-address">Service Address</label>
                <input type="text" id="customer-address" name="customer-address" required placeholder="Where should we meet you?">
            </div>
            
            <div class="form-group">
                <label for="vehicle-info">Vehicle Information</label>
                <input type="text" id="vehicle-info" name="vehicle-info" required placeholder="Year, Make, Model">
            </div>
            
            <div class="form-group">
                <label for="customer-notes">Additional Notes</label>
                <textarea id="customer-notes" name="customer-notes" rows="3" placeholder="Any additional details about the damage or location"></textarea>
            </div>
            
            <div class="form-group form-checkbox">
                <input type="checkbox" id="sms-consent" name="sms-consent" checked>
                <label for="sms-consent">I consent to receive SMS notifications about my booking</label>
            </div>
            
            <div class="form-submit">
                <button type="submit" class="btn btn-primary">Book Now</button>
            </div>
        </form>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Display social sharing buttons
 */
function clearviewshield_social_sharing() {
    $share_url = urlencode(get_permalink());
    $share_title = urlencode(get_the_title());
    
    echo '<div class="social-sharing">';
    echo '<span class="share-title">Share:</span>';
    echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $share_url . '" target="_blank" class="share-facebook"><i class="fab fa-facebook-f"></i></a>';
    echo '<a href="https://twitter.com/intent/tweet?url=' . $share_url . '&text=' . $share_title . '" target="_blank" class="share-twitter"><i class="fab fa-twitter"></i></a>';
    echo '<a href="https://www.linkedin.com/shareArticle?mini=true&url=' . $share_url . '&title=' . $share_title . '" target="_blank" class="share-linkedin"><i class="fab fa-linkedin-in"></i></a>';
    echo '<a href="mailto:?subject=' . $share_title . '&body=Check out this link: ' . get_permalink() . '" class="share-email"><i class="fas fa-envelope"></i></a>';
    echo '</div>';
}

/**
 * Display CTA button
 */
function clearviewshield_cta_button($text = 'Book Now', $url = '', $class = 'btn-primary') {
    if (empty($url)) {
        $url = home_url('/booking');
    }
    
    echo '<a href="' . esc_url($url) . '" class="btn ' . esc_attr($class) . '">' . esc_html($text) . '</a>';
}

/**
 * Display phone button
 */
function clearviewshield_phone_button($text = 'Call/Text 319-775-0717', $class = 'btn-outline') {
    echo '<a href="tel:3197750717" class="btn ' . esc_attr($class) . '">' . esc_html($text) . '</a>';
}

/**
 * Display warranty badge
 */
function clearviewshield_warranty_badge() {
    echo '<div class="warranty-badge">';
    echo '<div class="warranty-badge-inner">';
    echo '<span class="warranty-badge-text">Lifetime Warranty</span>';
    echo '</div>';
    echo '</div>';
}

/**
 * Display promo badge
 */
function clearviewshield_promo_badge($text = 'First 5 Bookings - $10 Off!') {
    echo '<div class="promo-badge">' . esc_html($text) . '</div>';
}
