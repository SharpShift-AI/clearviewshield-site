<?php
/**
 * Template part for displaying the booking form
 *
 * @package ClearViewShield
 */
?>

<div class="booking-form-wrapper">
    <form id="clearviewshield-booking-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
        <?php wp_nonce_field('clearviewshield_booking', 'clearviewshield_booking_nonce'); ?>
        <input type="hidden" name="action" value="clearviewshield_booking">
        
        <div class="form-group">
            <label for="service-type"><?php esc_html_e('Service Type', 'clearviewshield'); ?></label>
            <select id="service-type" name="service-type" required>
                <option value=""><?php esc_html_e('Select Service', 'clearviewshield'); ?></option>
                <option value="rock-chip"><?php esc_html_e('Rock Chip Repair', 'clearviewshield'); ?></option>
                <option value="crack"><?php esc_html_e('Crack Repair (up to 6 inches)', 'clearviewshield'); ?></option>
                <option value="multiple"><?php esc_html_e('Multiple Damage Points', 'clearviewshield'); ?></option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="booking-date"><?php esc_html_e('Preferred Date', 'clearviewshield'); ?></label>
            <input type="date" id="booking-date" name="booking-date" required min="<?php echo date('Y-m-d'); ?>">
        </div>
        
        <div class="form-group">
            <label for="booking-time"><?php esc_html_e('Preferred Time', 'clearviewshield'); ?></label>
            <select id="booking-time" name="booking-time" required>
                <option value=""><?php esc_html_e('Select Time', 'clearviewshield'); ?></option>
                <option value="morning"><?php esc_html_e('Morning (8am-12pm)', 'clearviewshield'); ?></option>
                <option value="afternoon"><?php esc_html_e('Afternoon (12pm-5pm)', 'clearviewshield'); ?></option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="customer-name"><?php esc_html_e('Your Name', 'clearviewshield'); ?></label>
            <input type="text" id="customer-name" name="customer-name" required>
        </div>
        
        <div class="form-group">
            <label for="customer-phone"><?php esc_html_e('Phone Number', 'clearviewshield'); ?></label>
            <input type="tel" id="customer-phone" name="customer-phone" required pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="319-555-1234">
            <small><?php esc_html_e('Format: 319-555-1234', 'clearviewshield'); ?></small>
        </div>
        
        <div class="form-group">
            <label for="customer-address"><?php esc_html_e('Service Address', 'clearviewshield'); ?></label>
            <input type="text" id="customer-address" name="customer-address" required placeholder="<?php esc_attr_e('Where should we meet you?', 'clearviewshield'); ?>">
        </div>
        
        <div class="form-group">
            <label for="vehicle-info"><?php esc_html_e('Vehicle Information', 'clearviewshield'); ?></label>
            <input type="text" id="vehicle-info" name="vehicle-info" required placeholder="<?php esc_attr_e('Year, Make, Model', 'clearviewshield'); ?>">
        </div>
        
        <div class="form-group">
            <label for="customer-notes"><?php esc_html_e('Additional Notes', 'clearviewshield'); ?></label>
            <textarea id="customer-notes" name="customer-notes" rows="3" placeholder="<?php esc_attr_e('Any additional details about the damage or location', 'clearviewshield'); ?>"></textarea>
        </div>
        
        <div class="form-group form-checkbox">
            <input type="checkbox" id="sms-consent" name="sms-consent" checked>
            <label for="sms-consent"><?php esc_html_e('I consent to receive SMS notifications about my booking', 'clearviewshield'); ?></label>
        </div>
        
        <div class="form-submit">
            <button type="submit" class="btn btn-primary"><?php esc_html_e('Book Now', 'clearviewshield'); ?></button>
        </div>
    </form>
</div>
