<?php
/**
 * Template part for displaying the booking confirmation
 *
 * @package ClearViewShield
 */
?>

<div class="booking-confirmation">
    <div class="confirmation-icon">
        <i class="fas fa-check-circle"></i>
    </div>
    
    <h2 class="confirmation-title"><?php esc_html_e('Booking Confirmed!', 'clearviewshield'); ?></h2>
    
    <div class="confirmation-message">
        <p><?php esc_html_e('Thank you for booking your windshield repair with ClearViewShield!', 'clearviewshield'); ?></p>
        
        <?php
        // Get booking details if available
        $booking_id = get_query_var('booking_id');
        if ($booking_id) {
            $booking = get_post($booking_id);
            if ($booking) {
                $customer_name = get_post_meta($booking_id, '_customer_name', true);
                $booking_date = get_post_meta($booking_id, '_booking_date', true);
                $booking_time = get_post_meta($booking_id, '_booking_time', true);
                
                echo '<div class="booking-details">';
                echo '<h3>' . esc_html__('Your Booking Details', 'clearviewshield') . '</h3>';
                
                if ($customer_name) {
                    echo '<p><strong>' . esc_html__('Name:', 'clearviewshield') . '</strong> ' . esc_html($customer_name) . '</p>';
                }
                
                if ($booking_date) {
                    echo '<p><strong>' . esc_html__('Date:', 'clearviewshield') . '</strong> ' . esc_html($booking_date) . '</p>';
                }
                
                if ($booking_time) {
                    echo '<p><strong>' . esc_html__('Time:', 'clearviewshield') . '</strong> ' . esc_html($booking_time) . '</p>';
                }
                
                echo '</div>';
            }
        }
        ?>
        
        <p><?php esc_html_e('We\'ll be in touch shortly to confirm your appointment details.', 'clearviewshield'); ?></p>
        
        <p><?php esc_html_e('If you have any questions, please call or text us at', 'clearviewshield'); ?> <a href="tel:3197750717">319-775-0717</a>.</p>
    </div>
    
    <div class="confirmation-next-steps">
        <h3><?php esc_html_e('What\'s Next?', 'clearviewshield'); ?></h3>
        <ol>
            <li><?php esc_html_e('You\'ll receive a text message confirmation shortly.', 'clearviewshield'); ?></li>
            <li><?php esc_html_e('We\'ll send a reminder 24 hours before your appointment.', 'clearviewshield'); ?></li>
            <li><?php esc_html_e('Our technician will arrive at your location at the scheduled time.', 'clearviewshield'); ?></li>
            <li><?php esc_html_e('The repair typically takes 30-45 minutes to complete.', 'clearviewshield'); ?></li>
        </ol>
    </div>
    
    <div class="confirmation-actions">
        <a href="<?php echo esc_url(home_url()); ?>" class="btn btn-primary"><?php esc_html_e('Return to Home', 'clearviewshield'); ?></a>
    </div>
</div>
