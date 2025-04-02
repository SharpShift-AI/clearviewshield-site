<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package ClearViewShield
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function clearviewshield_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'clearviewshield_pingback_header' );

/**
 * Add custom classes to the body tag
 */
function clearviewshield_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_action( 'body_class', 'clearviewshield_body_classes' );

/**
 * Add custom meta tags for SEO
 */
function clearviewshield_meta_tags() {
    // Default meta description
    $meta_description = 'Fast mobile windshield repair in Cedar Rapids—$75 for rock chips & cracks. Call or text 319-775-0717 now! ClearViewShield LLC.';
    
    // Page-specific meta descriptions
    if (is_front_page()) {
        $meta_title = 'Mobile Windshield Repair Cedar Rapids - $75 | ClearViewShield LLC';
        $meta_description = 'Fast mobile windshield repair in Cedar Rapids—$75 for rock chips & cracks. Call or text 319-775-0717 now! ClearViewShield LLC.';
    } elseif (is_page('about')) {
        $meta_title = 'About ClearViewShield - Windshield Repair Experts';
        $meta_description = 'Since 2021, ClearViewShield has provided mobile windshield repair in Cedar Rapids. Call or text 319-775-0717 for professional service. ClearViewShield LLC.';
    } elseif (is_page('booking')) {
        $meta_title = 'Book Windshield Repair Cedar Rapids - $75';
        $meta_description = 'Book fast mobile windshield repair in Cedar Rapids—$75, call or text 319-775-0717 or schedule now! ClearViewShield LLC.';
    } elseif (is_page('terms-of-use')) {
        $meta_title = 'Terms of Use - ClearViewShield Windshield Repair';
        $meta_description = 'Terms of use for ClearViewShield mobile windshield repair services in Cedar Rapids. Call or text 319-775-0717 for questions. ClearViewShield LLC.';
    } elseif (is_page('contact')) {
        $meta_title = 'Contact ClearViewShield - Windshield Repair Cedar Rapids';
        $meta_description = 'Contact ClearViewShield for mobile windshield repair in Cedar Rapids. Call or text 319-775-0717 for immediate service. ClearViewShield LLC.';
    } else {
        $meta_title = get_the_title() . ' | ClearViewShield LLC';
    }
    
    // Output meta tags
    if (!is_front_page()) {
        echo '<meta name="title" content="' . esc_attr($meta_title) . '">' . "\n";
    }
    echo '<meta name="description" content="' . esc_attr($meta_description) . '">' . "\n";
    
    // Open Graph meta tags
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($meta_title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($meta_description) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url(get_template_directory_uri() . '/assets/images/og-image.jpg') . '">' . "\n";
    
    // Twitter Card meta tags
    echo '<meta property="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta property="twitter:url" content="' . esc_url(get_permalink()) . '">' . "\n";
    echo '<meta property="twitter:title" content="' . esc_attr($meta_title) . '">' . "\n";
    echo '<meta property="twitter:description" content="' . esc_attr($meta_description) . '">' . "\n";
    echo '<meta property="twitter:image" content="' . esc_url(get_template_directory_uri() . '/assets/images/og-image.jpg') . '">' . "\n";
    
    // Local business meta tags
    echo '<meta name="geo.region" content="US-IA">' . "\n";
    echo '<meta name="geo.placename" content="Cedar Rapids">' . "\n";
    echo '<meta name="geo.position" content="41.9779;-91.6656">' . "\n";
    echo '<meta name="ICBM" content="41.9779, -91.6656">' . "\n";

    // Add Local Business Schema Markup
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => 'ClearViewShield LLC',
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Cedar Rapids',
            'addressRegion' => 'IA',
            'postalCode' => '52402',
            'addressCountry' => 'US'
        ],
        'telephone' => '319-775-0717',
        'priceRange' => '$75',
        'openingHours' => 'Mo-Sa 08:00-19:00',
        'url' => esc_url(home_url('/')),
        'sameAs' => [
            'https://www.facebook.com/clearviewshield',
            'https://www.instagram.com/clearviewshield',
            'https://twitter.com/clearviewshield'
        ]
    ];
    echo '<script type="application/ld+json">' . json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'clearviewshield_meta_tags', 1);

/**
 * Process booking form submission
 */
function clearviewshield_process_booking_form() {
    if (!isset($_POST['clearviewshield_booking_nonce']) || !wp_verify_nonce($_POST['clearviewshield_booking_nonce'], 'clearviewshield_booking')) {
        return;
    }
    
    // Get form data
    $service_type = sanitize_text_field($_POST['service-type']);
    $booking_date = sanitize_text_field($_POST['booking-date']);
    $booking_time = sanitize_text_field($_POST['booking-time']);
    $customer_name = sanitize_text_field($_POST['customer-name']);
    $customer_phone = sanitize_text_field($_POST['customer-phone']);
    $customer_address = sanitize_text_field($_POST['customer-address']);
    $vehicle_info = sanitize_text_field($_POST['vehicle-info']);
    $customer_notes = sanitize_textarea_field($_POST['customer-notes']);
    $sms_consent = isset($_POST['sms-consent']) ? true : false;
    
    // Create booking post
    $booking_data = array(
        'post_title'    => 'Booking: ' . $customer_name . ' - ' . $booking_date,
        'post_content'  => $customer_notes,
        'post_status'   => 'publish',
        'post_type'     => 'booking',
    );
    
    $booking_id = wp_insert_post($booking_data);
    
    if ($booking_id) {
        // Add booking meta data
        update_post_meta($booking_id, '_service_type', $service_type);
        update_post_meta($booking_id, '_booking_date', $booking_date);
        update_post_meta($booking_id, '_booking_time', $booking_time);
        update_post_meta($booking_id, '_customer_name', $customer_name);
        update_post_meta($booking_id, '_customer_phone', $customer_phone);
        update_post_meta($booking_id, '_customer_address', $customer_address);
        update_post_meta($booking_id, '_vehicle_info', $vehicle_info);
        update_post_meta($booking_id, '_sms_consent', $sms_consent);
        
        // Send confirmation email
        $to = get_option('admin_email');
        $subject = 'New Windshield Repair Booking - ' . $customer_name;
        $message = "New booking details:\n\n";
        $message .= "Service: " . $service_type . "\n";
        $message .= "Date: " . $booking_date . "\n";
        $message .= "Time: " . $booking_time . "\n";
        $message .= "Customer: " . $customer_name . "\n";
        $message .= "Phone: " . $customer_phone . "\n";
        $message .= "Address: " . $customer_address . "\n";
        $message .= "Vehicle: " . $vehicle_info . "\n";
        $message .= "Notes: " . $customer_notes . "\n";
        
        wp_mail($to, $subject, $message);
        
        // Send SMS notification if consent given
        if ($sms_consent && function_exists('clearviewshield_send_sms_notification')) {
            $sms_message = "Thank you for booking with ClearViewShield! Your windshield repair is scheduled for " . $booking_date . " (" . $booking_time . "). We'll text you a reminder 24 hours before. Reply to confirm.";
            clearviewshield_send_sms_notification($customer_phone, $sms_message);
        }
        
        // Redirect to thank you page
        wp_redirect(home_url('/booking-confirmation/?booking_id=' . $booking_id));
        exit;
    }
}
add_action('init', 'clearviewshield_process_booking_form');

/**
 * Add custom image sizes
 */
function clearviewshield_custom_image_sizes() {
    add_image_size('before-after', 400, 300, true);
    add_image_size('blog-teaser', 350, 200, true);
    add_image_size('service-thumbnail', 600, 400, true);
}
add_action('after_setup_theme', 'clearviewshield_custom_image_sizes');

/**
 * Modify the excerpt length
 */
function clearviewshield_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'clearviewshield_excerpt_length');

/**
 * Modify the excerpt more string
 */
function clearviewshield_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'clearviewshield_excerpt_more');

/**
 * Add custom query vars
 */
function clearviewshield_query_vars($vars) {
    $vars[] = 'booking_id';
    return $vars;
}
add_filter('query_vars', 'clearviewshield_query_vars');

/**
 * Add mobile detection
 */
function clearviewshield_is_mobile() {
    return wp_is_mobile();
}

/**
 * Add phone number formatting
 */
function clearviewshield_format_phone($phone) {
    $phone = preg_replace('/[^0-9]/', '', $phone);
    
    if (strlen($phone) === 10) {
        return '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . '-' . substr($phone, 6);
    }
    
    return $phone;
}

/**
 * Add custom admin columns for bookings
 */
function clearviewshield_booking_columns($columns) {
    $columns = array(
        'cb' => $columns['cb'],
        'title' => __('Booking', 'clearviewshield'),
        'customer' => __('Customer', 'clearviewshield'),
        'phone' => __('Phone', 'clearviewshield'),
        'service' => __('Service', 'clearviewshield'),
        'date_time' => __('Date & Time', 'clearviewshield'),
        'date' => $columns['date'],
    );
    
    return $columns;
}
add_filter('manage_booking_posts_columns', 'clearviewshield_booking_columns');

/**
 * Add content to custom admin columns for bookings
 */
function clearviewshield_booking_column_content($column, $post_id) {
    switch ($column) {
        case 'customer':
            echo esc_html(get_post_meta($post_id, '_customer_name', true));
            break;
        case 'phone':
            $phone = get_post_meta($post_id, '_customer_phone', true);
            echo '<a href="tel:' . esc_attr($phone) . '">' . esc_html(clearviewshield_format_phone($phone)) . '</a>';
            break;
        case 'service':
            echo esc_html(get_post_meta($post_id, '_service_type', true));
            break;
        case 'date_time':
            $date = get_post_meta($post_id, '_booking_date', true);
            $time = get_post_meta($post_id, '_booking_time', true);
            echo esc_html($date) . ' (' . esc_html($time) . ')';
            break;
    }
}
add_action('manage_booking_posts_custom_column', 'clearviewshield_booking_column_content', 10, 2);