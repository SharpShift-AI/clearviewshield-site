<?php
/**
 * Template Name: Contact Page
 *
 * @package ClearViewShield
 */

get_header();
?>

<main id="primary" class="site-main contact-page">
    <div class="container">
        <header class="page-header">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </header>

        <div class="contact-page-content">
            <div class="contact-intro">
                <p>Have questions about our mobile windshield repair service? Need to schedule a repair? We're here to help! Contact ClearViewShield using any of the methods below.</p>
            </div>

            <div class="contact-methods">
                <div class="contact-method">
                    <div class="contact-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="contact-details">
                        <h3>Call or Text</h3>
                        <p><a href="tel:3197750717">319-775-0717</a></p>
                        <p class="contact-note">Available 7 days a week, 8am-7pm</p>
                    </div>
                </div>
                
                <div class="contact-method">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-details">
                        <h3>Email</h3>
                        <p><a href="mailto:info@clearviewshield.com">info@clearviewshield.com</a></p>
                        <p class="contact-note">We respond to all emails within 24 hours</p>
                    </div>
                </div>
                
                <div class="contact-method">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-details">
                        <h3>Service Area</h3>
                        <p>Cedar Rapids, Marion, Hiawatha, and Linn County, Iowa</p>
                        <p class="contact-note">We come to your location!</p>
                    </div>
                </div>
            </div>

            <div class="contact-form-container">
                <h2>Send Us a Message</h2>
                <form id="contact-form" class="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                    <?php wp_nonce_field('clearviewshield_contact', 'clearviewshield_contact_nonce'); ?>
                    <input type="hidden" name="action" value="clearviewshield_contact">
                    
                    <div class="form-group">
                        <label for="contact-name"><?php esc_html_e('Your Name', 'clearviewshield'); ?></label>
                        <input type="text" id="contact-name" name="contact-name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact-email"><?php esc_html_e('Email Address', 'clearviewshield'); ?></label>
                        <input type="email" id="contact-email" name="contact-email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact-phone"><?php esc_html_e('Phone Number', 'clearviewshield'); ?></label>
                        <input type="tel" id="contact-phone" name="contact-phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="319-555-1234">
                        <small><?php esc_html_e('Format: 319-555-1234 (Optional)', 'clearviewshield'); ?></small>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact-subject"><?php esc_html_e('Subject', 'clearviewshield'); ?></label>
                        <select id="contact-subject" name="contact-subject" required>
                            <option value=""><?php esc_html_e('Select Subject', 'clearviewshield'); ?></option>
                            <option value="booking"><?php esc_html_e('Schedule a Repair', 'clearviewshield'); ?></option>
                            <option value="question"><?php esc_html_e('General Question', 'clearviewshield'); ?></option>
                            <option value="quote"><?php esc_html_e('Request a Quote', 'clearviewshield'); ?></option>
                            <option value="feedback"><?php esc_html_e('Feedback', 'clearviewshield'); ?></option>
                            <option value="other"><?php esc_html_e('Other', 'clearviewshield'); ?></option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="contact-message"><?php esc_html_e('Message', 'clearviewshield'); ?></label>
                        <textarea id="contact-message" name="contact-message" rows="5" required></textarea>
                    </div>
                    
                    <div class="form-submit">
                        <button type="submit" class="btn btn-primary"><?php esc_html_e('Send Message', 'clearviewshield'); ?></button>
                    </div>
                </form>
            </div>

            <div class="contact-faq">
                <h2>Frequently Asked Questions</h2>
                
                <div class="faq-item">
                    <h3>How quickly can you schedule a repair?</h3>
                    <p>In most cases, we can schedule your repair within 1-2 business days. For urgent repairs, we often have same-day availability.</p>
                </div>
                
                <div class="faq-item">
                    <h3>Do I need to be present during the repair?</h3>
                    <p>We recommend that you or someone you trust be present to provide access to the vehicle, but you don't need to stay with the technician during the entire repair process.</p>
                </div>
                
                <div class="faq-item">
                    <h3>How do I pay for the service?</h3>
                    <p>We accept cash, credit cards, debit cards, and mobile payment options like Venmo and Cash App. Payment is collected after the repair is completed.</p>
                </div>
                
                <div class="faq-item">
                    <h3>What if I need to cancel or reschedule?</h3>
                    <p>We understand that plans change. Please give us at least 2 hours notice if you need to cancel or reschedule your appointment.</p>
                </div>
            </div>

            <div class="contact-cta">
                <h2>Ready for a Fast, Convenient Repair?</h2>
                <p>Book your mobile windshield repair today and save time and money.</p>
                <div class="cta-buttons">
                    <?php clearviewshield_cta_button('Book Online', home_url('/booking'), 'btn-primary btn-large'); ?>
                    <?php clearviewshield_phone_button('Call/Text 319-775-0717', 'btn-outline btn-large'); ?>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();
