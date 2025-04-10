<?php
/**
 * ClearViewShield functions and definitions
 *
 * @package ClearViewShield
 */

// Enable WordPress debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set('log_errors', 1);
ini_set('error_log', WP_CONTENT_DIR . '/debug.log');

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define( 'CLEARVIEWSHIELD_THEME_VERSION', '1.0.0' );
define( 'CLEARVIEWSHIELD_THEME_DIR', get_stylesheet_directory() );
define( 'CLEARVIEWSHIELD_THEME_URI', get_stylesheet_directory_uri() );

/**
 * Theme Setup
 */
function clearviewshield_setup() {
    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'primary' => esc_html__( 'Primary Menu', 'clearviewshield' ),
            'footer'  => esc_html__( 'Footer Menu', 'clearviewshield' ),
        )
    );

    // Switch default core markup for search form, comment form, and comments to output valid HTML5.
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'clearviewshield_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for core custom logo.
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );

    // Add support for editor styles.
    add_theme_support( 'editor-styles' );

    // Add support for responsive embeds.
    add_theme_support( 'responsive-embeds' );

    // Add support for Elementor Pro locations.
    add_theme_support( 'elementor-pro' );
}
add_action( 'after_setup_theme', 'clearviewshield_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function clearviewshield_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'clearviewshield_content_width', 1200 );
}
add_action( 'after_setup_theme', 'clearviewshield_content_width', 0 );

/**
 * Register widget area.
 */
function clearviewshield_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'clearviewshield' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'clearviewshield' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer 1', 'clearviewshield' ),
            'id'            => 'footer-1',
            'description'   => esc_html__( 'Add footer widgets here.', 'clearviewshield' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer 2', 'clearviewshield' ),
            'id'            => 'footer-2',
            'description'   => esc_html__( 'Add footer widgets here.', 'clearviewshield' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer 3', 'clearviewshield' ),
            'id'            => 'footer-3',
            'description'   => esc_html__( 'Add footer widgets here.', 'clearviewshield' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'clearviewshield_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function clearviewshield_enqueue_styles() {
    // Enqueue Bootstrap CSS and JS
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0');
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.0', true);

    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4');

    // Enqueue Slick Slider CSS and JS
    wp_enqueue_style('slick-slider-css', get_stylesheet_directory_uri() . '/css/vendor/slick.min.css', array(), '1.8.1');
    wp_enqueue_script('slick-slider-js', get_stylesheet_directory_uri() . '/js/vendor/slick.min.js', array('jquery'), '1.8.1', true);
    wp_enqueue_script('twentytwenty-js', get_stylesheet_directory_uri() . '/js/vendor/twentytwenty.js', array('jquery'), '1.0.0', true);

    // Enqueue Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Michroma&family=Roboto:wght@300;400;500;700&display=swap', array(), null);

    // Enqueue main stylesheet
    wp_enqueue_style('clearviewshield-style', get_stylesheet_uri(), array(), CLEARVIEWSHIELD_THEME_VERSION);

    // Enqueue custom scripts
    wp_enqueue_script('clearviewshield-custom', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), CLEARVIEWSHIELD_THEME_VERSION, true);

    // Localize script for AJAX
    wp_localize_script(
        'clearviewshield-custom',
        'clearviewshield_ajax',
        array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('clearviewshield-nonce'),
        )
    );
}
add_action('wp_enqueue_scripts', 'clearviewshield_enqueue_styles');

/**
 * Enqueue admin scripts and styles.
 */
function clearviewshield_admin_enqueue_scripts() {
    wp_enqueue_style('clearviewshield-admin-style', get_stylesheet_directory_uri() . '/css/admin.css', array(), CLEARVIEWSHIELD_THEME_VERSION);
}
add_action('admin_enqueue_scripts', 'clearviewshield_admin_enqueue_scripts');

/**
 * Enqueue login scripts and styles.
 */
function clearviewshield_login_enqueue_scripts() {
    wp_enqueue_style('clearviewshield-login-style', get_stylesheet_directory_uri() . '/css/login.css', array(), CLEARVIEWSHIELD_THEME_VERSION);
}
add_action('login_enqueue_scripts', 'clearviewshield_login_enqueue_scripts');

/**
 * Automatically apply homepage template to front page
 */
function clearviewshield_set_homepage_template($template) {
    if (is_front_page()) {
        $new_template = locate_template(array('templates/homepage-template.php'));
        if (!empty($new_template)) {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'clearviewshield_set_homepage_template');

/**
 * Register custom page templates.
 */
function clearviewshield_add_page_templates($templates) {
    $templates['templates/homepage-template.php'] = 'Homepage Template';
    $templates['templates/booking-template.php'] = 'Booking Template';
    return $templates;
}
add_filter('theme_page_templates', 'clearviewshield_add_page_templates');

/**
 * Include required files.
 */
require_once CLEARVIEWSHIELD_THEME_DIR . '/inc/template-functions.php';
require_once CLEARVIEWSHIELD_THEME_DIR . '/inc/template-tags.php';
require_once CLEARVIEWSHIELD_THEME_DIR . '/inc/customizer.php';

/**
 * Elementor integration.
 */
function clearviewshield_elementor_integration() {
    // Check if Elementor is installed and activated
    if (!did_action('elementor/loaded')) {
        return;
    }

    // Register custom category for Elementor widgets
    add_action('elementor/elements/categories_registered', function ($elements_manager) {
        $elements_manager->add_category(
            'clearviewshield-elements',
            [
                'title' => __('ClearViewShield Elements', 'clearviewshield'),
                'icon'  => 'fa fa-shield',
            ]
        );
    });

    // Register custom widgets
    add_action('elementor/widgets/widgets_registered', function () {
        // Include widget files
        require_once CLEARVIEWSHIELD_THEME_DIR . '/inc/elementor-widgets/before-after-slider.php';
        require_once CLEARVIEWSHIELD_THEME_DIR . '/inc/elementor-widgets/service-card.php';
        require_once CLEARVIEWSHIELD_THEME_DIR . '/inc/elementor-widgets/testimonial-slider.php';

        // Register widgets
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new ClearViewShield_Before_After_Slider());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new ClearViewShield_Service_Card());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new ClearViewShield_Testimonial_Slider());
    });

    // Register custom controls
    add_action('elementor/controls/controls_registered', function () {
        require_once CLEARVIEWSHIELD_THEME_DIR . '/inc/elementor-controls/color-controls.php';
        new ClearViewShield_Color_Controls();
    });
}
add_action('init', 'clearviewshield_elementor_integration');

/**
 * Add custom body classes.
 */
function clearviewshield_body_classes($classes) {
    // Add a class if we're on the homepage
    if (is_front_page()) {
        $classes[] = 'clearviewshield-home';
    }

    // Add a class for the booking page
    if (is_page_template('templates/booking-template.php')) {
        $classes[] = 'clearviewshield-booking';
    }

    return $classes;
}
add_filter('body_class', 'clearviewshield_body_classes');

/**
 * Modify the excerpt length.
 */
function clearviewshield_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'clearviewshield_excerpt_length');

/**
 * Modify the excerpt more string.
 */
function clearviewshield_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'clearviewshield_excerpt_more');

/**
 * Add schema markup for local business.
 */
function clearviewshield_add_local_business_schema() {
    if (is_front_page()) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => 'ClearViewShield',
            'description' => 'Mobile windshield rock chip and crack repair service in Cedar Rapids, Iowa',
            'image' => get_stylesheet_directory_uri() . '/images/logo.png',
            'url' => home_url(),
            'telephone' => '319-775-0717',
            'priceRange' => '$75',
            'address' => array(
                '@type' => 'PostalAddress',
                'streetAddress' => '123 Main Street',
                'addressLocality' => 'Cedar Rapids',
                'addressRegion' => 'IA',
                'postalCode' => '52401',
                'addressCountry' => 'US'
            ),
            'geo' => array(
                '@type' => 'GeoCoordinates',
                'latitude' => '41.9779',
                'longitude' => '-91.6656'
            ),
            'openingHoursSpecification' => array(
                array(
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'),
                    'opens' => '08:00',
                    'closes' => '18:00'
                ),
                array(
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => 'Saturday',
                    'opens' => '09:00',
                    'closes' => '16:00'
                )
            ),
            'sameAs' => array(
                'https://www.facebook.com/clearviewshield',
                'https://www.instagram.com/clearviewshield'
            )
        );

        echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
    }
}
add_action('wp_head', 'clearviewshield_add_local_business_schema');

/**
 * Customize the login page.
 */
function clearviewshield_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'clearviewshield_login_logo_url');

function clearviewshield_login_logo_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'clearviewshield_login_logo_title');

/**
 * Add custom image sizes.
 */
function clearviewshield_add_image_sizes() {
    add_image_size('clearviewshield-featured', 1200, 600, true);
    add_image_size('clearviewshield-service', 600, 400, true);
    add_image_size('clearviewshield-testimonial', 150, 150, true);
}
add_action('after_setup_theme', 'clearviewshield_add_image_sizes');

/**
 * Bookly integration.
 */
function clearviewshield_bookly_integration() {
    // Check if Bookly is active
    if (!class_exists('Bookly\Lib\Plugin')) {
        return;
    }

    // Add custom fields to Bookly's form output
    add_filter('bookly_form_shortcode', function($output) {
        $custom_fields = array(
            array(
                'id' => 'vehicle_make',
                'type' => 'text',
                'label' => __('Vehicle Make', 'clearviewshield'),
                'required' => true,
            ),
            array(
                'id' => 'vehicle_model',
                'type' => 'text',
                'label' => __('Vehicle Model', 'clearviewshield'),
                'required' => true,
            ),
            array(
                'id' => 'vehicle_year',
                'type' => 'number',
                'label' => __('Vehicle Year', 'clearviewshield'),
                'required' => true,
            ),
            array(
                'id' => 'damage_description',
                'type' => 'textarea',
                'label' => __('Damage Description', 'clearviewshield'),
                'required' => true,
            ),
        );

        // Generate HTML for custom fields
        $custom_fields_html = '<div class="bookly-custom-fields">';
        foreach ($custom_fields as $field) {
            $custom_fields_html .= '<div class="bookly-custom-field">';
            $custom_fields_html .= '<label>' . esc_html($field['label']) . ($field['required'] ? ' <span class="required">*</span>' : '') . '</label>';
            if ($field['type'] === 'textarea') {
                $custom_fields_html .= '<textarea name="' . esc_attr($field['id']) . '" class="bookly-custom-textarea"' . ($field['required'] ? ' required' : '') . '></textarea>';
            } else {
                $custom_fields_html .= '<input type="' . esc_attr($field['type']) . '" name="' . esc_attr($field['id']) . '" class="bookly-custom-input"' . ($field['required'] ? ' required' : '') . ' />';
            }
            $custom_fields_html .= '</div>';
        }
        $custom_fields_html .= '</div>';

        // Append custom fields to Bookly's form output (before the submit button)
        $output = str_replace('</form>', $custom_fields_html . '</form>', $output);

        return $output;
    });

    // Save the custom field data when the form is submitted
    add_action('bookly_save_booking_data', function($booking_data) {
        $custom_fields = array('vehicle_make', 'vehicle_model', 'vehicle_year', 'damage_description');
        foreach ($custom_fields as $field_id) {
            if (isset($_POST[$field_id])) {
                $booking_data['custom_fields'][$field_id] = sanitize_text_field($_POST[$field_id]);
            }
        }
        return $booking_data;
    }, 10, 1);
}
add_action('init', 'clearviewshield_bookly_integration');
/**
 * WP Rocket integration.
 */
function clearviewshield_wp_rocket_integration() {
    // Check if WP Rocket is active
    if (!function_exists('rocket_clean_domain')) {
        return;
    }

    // Clear cache when updating theme options
    add_action('customize_save_after', 'rocket_clean_domain');
}
add_action('init', 'clearviewshield_wp_rocket_integration');

/**
 * Yoast SEO integration.
 */
function clearviewshield_yoast_seo_integration() {
    // Check if Yoast SEO is active
    if (!class_exists('WPSEO_Options')) {
        return;
    }

    // Set default title and meta description for homepage
    add_filter('wpseo_title', function ($title) {
        if (is_front_page()) {
            return 'ClearViewShield - Mobile Windshield Repair in Cedar Rapids, Iowa';
        }
        return $title;
    });

    add_filter('wpseo_metadesc', function ($desc) {
        if (is_front_page()) {
            return 'Professional mobile windshield chip and crack repair service in Cedar Rapids, Marion, Hiawatha, and Linn County, Iowa. $75 flat rate repairs.';
        }
        return $desc;
    });
}
add_action('init', 'clearviewshield_yoast_seo_integration');

/**
 * AJAX handlers for booking form.
 */
function clearviewshield_ajax_check_availability() {
    check_ajax_referer('clearviewshield-nonce', 'nonce');

    $date = sanitize_text_field($_POST['date']);
    $time = sanitize_text_field($_POST['time']);

    // Here you would check availability in Bookly
    // For now, we'll just return a success message
    wp_send_json_success(array(
        'message' => 'The selected time is available!',
        'available' => true,
    ));

    wp_die();
}
add_action('wp_ajax_clearviewshield_check_availability', 'clearviewshield_ajax_check_availability');
add_action('wp_ajax_nopriv_clearviewshield_check_availability', 'clearviewshield_ajax_check_availability');

/**
 * Handle custom booking form submission
 */
add_action('wp_ajax_clearviewshield_book_appointment', 'clearviewshield_book_appointment');
add_action('wp_ajax_nopriv_clearviewshield_book_appointment', 'clearviewshield_book_appointment');
// Grok test: Workflow verification
function clearviewshield_book_appointment() {
    error_log('Starting clearviewshield_book_appointment function');
    check_ajax_referer('clearviewshield_book_appointment_nonce', 'nonce');
    error_log('Nonce check passed');

    $vehicle_make = sanitize_text_field($_POST['vehicle_make']);
    $vehicle_model = sanitize_text_field($_POST['vehicle_model']);
    $vehicle_year = sanitize_text_field($_POST['vehicle_year']);
    $vehicle_color = sanitize_text_field($_POST['vehicle_color']);
    $license_plate = sanitize_text_field($_POST['license_plate']);
    $damage_location = sanitize_text_field($_POST['damage_location']);
    $additional_comments = sanitize_textarea_field($_POST['additional_comments']);
    $contact_method = sanitize_text_field($_POST['contact_method']);
    $referral_source = sanitize_text_field($_POST['referral_source']);
    $service = sanitize_text_field($_POST['service']);
    $booking_date = sanitize_text_field($_POST['booking_date']);
    $booking_time = sanitize_text_field($_POST['booking_time']);
    $customer_name = sanitize_text_field($_POST['customer_name']);
    $customer_email = sanitize_email($_POST['customer_email']);
    $customer_phone = sanitize_text_field($_POST['customer_phone']);
    $customer_address = sanitize_text_field($_POST['customer_address']);
    $sms_consent = isset($_POST['sms_consent']) && $_POST['sms_consent'] === 'yes' ? true : false;

    // Handle photo upload
    $photo_url = '';
    if (!empty($_FILES['damage_photo']['name'])) {
        $upload = wp_handle_upload($_FILES['damage_photo'], array('test_form' => false));
        if (isset($upload['error']) && $upload['error']) {
            error_log('Photo upload error: ' . $upload['error']);
        } else {
            $photo_url = $upload['url'];
            error_log('Photo uploaded: ' . $photo_url);
        }
    }

    error_log('Form data: ' . print_r([
        'vehicle_make' => $vehicle_make,
        'vehicle_model' => $vehicle_model,
        'vehicle_year' => $vehicle_year,
        'vehicle_color' => $vehicle_color,
        'license_plate' => $license_plate,
        'damage_location' => $damage_location,
        'additional_comments' => $additional_comments,
        'contact_method' => $contact_method,
        'referral_source' => $referral_source,
        'service' => $service,
        'booking_date' => $booking_date,
        'booking_time' => $booking_time,
        'customer_name' => $customer_name,
        'customer_email' => $customer_email,
        'customer_phone' => $customer_phone,
        'customer_address' => $customer_address,
        'sms_consent' => $sms_consent,
        'photo_url' => $photo_url
    ], true));

    // Validate required fields
    if (empty($vehicle_make) || empty($vehicle_model) || empty($vehicle_year) || empty($vehicle_color) ||
        empty($damage_location) || empty($contact_method) || empty($service) ||
        empty($booking_date) || empty($booking_time) || empty($customer_name) ||
        empty($customer_email) || empty($customer_phone) || empty($customer_address)) {
        error_log('Validation failed: Missing required fields');
        wp_send_json_error(['message' => 'All fields are required.']);
    }
    error_log('Validation passed');

    // Set the timezone to WordPress's timezone
    $timezone = wp_timezone();
    $now = new DateTime('now', $timezone);
    $booking_datetime = new DateTime($booking_date . ' ' . $booking_time, $timezone);

    // Log the times for debugging
    error_log('Current time (server): ' . $now->format('Y-m-d H:i:s T'));
    error_log('Booking time: ' . $booking_datetime->format('Y-m-d H:i:s T'));

    // Calculate the difference in hours
    $interval = $now->diff($booking_datetime);
    $hours_until_booking = ($interval->days * 24) + $interval->h + ($interval->i / 60);
    if ($interval->invert || $hours_until_booking < 2) {
        error_log('Validation failed: Booking must be at least 2 hours in the future. Hours until booking: ' . $hours_until_booking);
        wp_send_json_error(['message' => 'Booking must be at least 2 hours in the future.']);
    }
    error_log('Lead time validation passed. Hours until booking: ' . $hours_until_booking);

    // Format the appointment time
    $start_datetime = $booking_datetime->format('Y-m-d H:i:s');
    $end_datetime = $booking_datetime->modify('+1 hour')->format('Y-m-d H:i:s');
    error_log('Appointment times: start=' . $start_datetime . ', end=' . $end_datetime);

    // Create appointment in Bookly
    if (class_exists('Bookly\Lib\Entities\Appointment')) {
        error_log('Creating Bookly customer');
        $customer = new Bookly\Lib\Entities\Customer();
        $customer->setFirstName($customer_name);
        $customer->setEmail($customer_email);
        $customer->setPhone($customer_phone);
        $customer->save();
        error_log('Customer saved with ID: ' . $customer->getId());

        error_log('Creating Bookly appointment');
        $appointment = new Bookly\Lib\Entities\Appointment();
        $appointment->setServiceId($service); // Use the selected service ID
        $appointment->setStaffId(1);   // Assumes staff ID 1 - adjust as needed
        $appointment->setStartDate($start_datetime);
        $appointment->setEndDate($end_datetime);
        $notes = "Vehicle: $vehicle_make $vehicle_model ($vehicle_year)\nColor: $vehicle_color\nLicense Plate: " . ($license_plate ?: 'N/A') . "\nDamage Location: $damage_location\nComments: " . ($additional_comments ?: 'N/A') . "\nContact Method: $contact_method\nReferral Source: " . ($referral_source ?: 'N/A') . "\nAddress: $customer_address\nPhoto: " . ($photo_url ?: 'N/A');
        error_log('Setting appointment notes: ' . $notes);
        $appointment->setNotes($notes);
        $appointment->save();
        error_log('Appointment saved with ID: ' . $appointment->getId());
        // Verify the notes were saved
        $saved_appointment = new Bookly\Lib\Entities\Appointment();
        $saved_appointment->load($appointment->getId());
        error_log('Saved appointment notes: ' . $saved_appointment->getNotes());

        error_log('Creating Bookly customer appointment');
        $ca = new Bookly\Lib\Entities\CustomerAppointment();
        $ca->setCustomerId($customer->getId());
        $ca->setAppointmentId($appointment->getId());
        $ca->setStatus(Bookly\Lib\Entities\CustomerAppointment::STATUS_APPROVED);
        $ca->setCreatedAt(current_time('mysql')); // Explicitly set created_at to current timestamp
        $ca->setUpdatedAt(current_time('mysql')); // Set updated_at as well
        $ca->save();
        error_log('Customer appointment saved');

        // Trigger Bookly notifications
        if (class_exists('Bookly\Lib\NotificationSender')) {
            Bookly\Lib\NotificationSender::sendForAppointment($appointment, $ca);
            error_log('Triggered Bookly notifications for appointment ID: ' . $appointment->getId());
        } else {
            error_log('Bookly NotificationSender class not found');
        }
    } else {
        error_log('Bookly plugin not active');
        wp_send_json_error(['message' => 'Bookly plugin is not active.']);
    }

    // Save booking details to custom table
    global $wpdb;
    $table_name = $wpdb->prefix . 'clearviewshield_bookings';
    $wpdb->insert(
        $table_name,
        [
            'customer_name' => $customer_name,
            'customer_email' => $customer_email,
            'customer_phone' => $customer_phone,
            'customer_address' => $customer_address,
            'vehicle_make' => $vehicle_make,
            'vehicle_model' => $vehicle_model,
            'vehicle_year' => $vehicle_year,
            'vehicle_color' => $vehicle_color,
            'license_plate' => $license_plate,
            'damage_location' => $damage_location,
            'additional_comments' => $additional_comments,
            'contact_method' => $contact_method,
            'referral_source' => $referral_source,
            'service' => $service,
            'booking_date' => $booking_date,
            'booking_time' => $booking_time,
            'created_at' => current_time('mysql'),
            'photo_url' => $photo_url,
            'status' => 'active'
        ],
        ['%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s']
    );
    error_log('Booking saved to custom table with ID: ' . $wpdb->insert_id);

    // Generate iCalendar (.ics) file with all details
    error_log('Generating .ics file');
    $ics_content = "BEGIN:VCALENDAR\n";
    $ics_content .= "VERSION:2.0\n";
    $ics_content .= "PRODID:-//ClearViewShield//Appointment//EN\n";
    $ics_content .= "BEGIN:VEVENT\n";
    $ics_content .= "UID:" . uniqid() . "@clearviewshield.com\n";
    $ics_content .= "DTSTAMP:" . gmdate('Ymd\THis\Z') . "\n";
    $ics_content .= "DTSTART:" . date('Ymd\THis', strtotime($start_datetime)) . "Z\n";
    $ics_content .= "DTEND:" . date('Ymd\THis', strtotime($end_datetime)) . "Z\n";
    $ics_content .= "SUMMARY:Windshield Repair Appointment for $customer_name\n";
    $ics_content .= "DESCRIPTION:Customer: $customer_name\\nEmail: $customer_email\\nPhone: $customer_phone\\nVehicle: $vehicle_make $vehicle_model ($vehicle_year)\\nColor: $vehicle_color\\nLicense Plate: " . ($license_plate ?: 'N/A') . "\\nDamage Location: $damage_location\\nComments: " . ($additional_comments ?: 'N/A') . "\\nContact Method: $contact_method\\nReferral Source: " . ($referral_source ?: 'N/A') . "\\nService: $service\\nPhoto: " . ($photo_url ?: 'N/A') . "\n";
    $ics_content .= "LOCATION:" . str_replace(',', '\,', $customer_address) . "\n";
    $ics_content .= "END:VEVENT\n";
    $ics_content .= "END:VCALENDAR\n";

    // Save the .ics file
    $upload_dir = wp_upload_dir();
    $ics_file = $upload_dir['path'] . '/appointment-' . $appointment->getId() . '.ics';
    $ics_url = $upload_dir['url'] . '/appointment-' . $appointment->getId() . '.ics';
    file_put_contents($ics_file, $ics_content);
    error_log('ICS file saved: ' . $ics_file);

    // Send email confirmation with .ics attachment
    error_log('Sending email to customer: ' . $customer_email);
    $subject = 'Appointment Confirmation - ClearViewShield';
    $message = "Dear $customer_name,\n\nYour appointment for Windshield Repair has been confirmed.\n\nDetails:\n- Date: $booking_date\n- Time: $booking_time\n- Location: $customer_address\n- Service: $service\n\nAdd this event to your calendar using the attached .ics file, which is compatible with Apple Calendar, Microsoft Outlook, Google Calendar, Yahoo Calendar, Zoho Calendar, Office 365, Calendly, Proton Calendar, Nextcloud Calendar, and Cozi Family Calendar.\n\nWe look forward to serving you!\n\nBest,\nClearViewShield Team";
    $headers = ['Content-Type: text/plain; charset=UTF-8'];
    $attachments = [$ics_file];
    $email_sent = wp_mail($customer_email, $subject, $message, $headers, $attachments);
    if (!$email_sent) {
        error_log('Failed to send email to customer: ' . $customer_email . ' - Error: ' . print_r(error_get_last(), true));
    } else {
        error_log('Email sent to customer: ' . $customer_email);
    }

    // Send a copy to your email
    $your_email = 'appointment@clearviewshield.com';
    error_log('Sending email to owner: ' . $your_email);
    $email_sent_owner = wp_mail($your_email, $subject, $message, $headers, $attachments);
    if (!$email_sent_owner) {
        error_log('Failed to send email to owner: ' . $your_email . ' - Error: ' . print_r(error_get_last(), true));
    } else {
        error_log('Email sent to owner: ' . $your_email);
    }

    // SMS notifications are handled by Bookly, so we skip Twilio for now
    error_log('SMS notifications are handled by Bookly');

    // Return appointment details for calendar links
    error_log('Preparing response');
    $response = [
        'message' => 'Appointment booked successfully!',
        'start_datetime' => $start_datetime,
        'end_datetime' => $end_datetime,
        'ics_url' => $ics_url
    ];
    error_log('Sending response: ' . print_r($response, true));
    wp_send_json_success($response);
}

/**
 * Create a custom table for storing booking information
 */
function clearviewshield_create_bookings_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'clearviewshield_bookings';
    $charset_collate = $wpdb->get_charset_collate();

    // Check if the table exists
    $table_exists = $wpdb->get_var("SHOW TABLES LIKE '$table_name'") == $table_name;

    // Create the table if it doesn't exist
    if (!$table_exists) {
        $sql = "CREATE TABLE $table_name (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            customer_name varchar(255) NOT NULL,
            customer_email varchar(255) NOT NULL,
            customer_phone varchar(20) NOT NULL,
            customer_address text NOT NULL,
            vehicle_make varchar(100) NOT NULL,
            vehicle_model varchar(100) NOT NULL,
            vehicle_year varchar(10) NOT NULL,
            vehicle_color varchar(50) NOT NULL,
            license_plate varchar(20) DEFAULT '',
            damage_location varchar(50) NOT NULL,
            additional_comments text DEFAULT '',
            contact_method varchar(50) NOT NULL,
            referral_source varchar(50) DEFAULT '',
            service varchar(100) NOT NULL,
            booking_date date NOT NULL,
            booking_time varchar(20) NOT NULL,
            created_at datetime NOT NULL,
            photo_url varchar(255) DEFAULT '',
            status ENUM('active', 'deleted') NOT NULL DEFAULT 'active',
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        error_log('Created table: ' . $table_name);
    } else {
        // Migrate existing table to add new columns if they don't exist
        $columns = $wpdb->get_results("SHOW COLUMNS FROM $table_name");
        $column_names = array_column($columns, 'Field');

        if (!in_array('photo_url', $column_names)) {
            $wpdb->query("ALTER TABLE $table_name ADD photo_url varchar(255) DEFAULT ''");
            error_log('Added photo_url column to table: ' . $table_name);
        }
        if (!in_array('contact_method', $column_names)) {
            $wpdb->query("ALTER TABLE $table_name ADD contact_method varchar(50) NOT NULL DEFAULT ''");
            error_log('Added contact_method column to table: ' . $table_name);
        }
        if (!in_array('referral_source', $column_names)) {
            $wpdb->query("ALTER TABLE $table_name ADD referral_source varchar(50) DEFAULT ''");
            error_log('Added referral_source column to table: ' . $table_name);
        }
        if (!in_array('status', $column_names)) {
            $wpdb->query("ALTER TABLE $table_name ADD status ENUM('active', 'deleted') NOT NULL DEFAULT 'active'");
            error_log('Added status column to table: ' . $table_name);
        }
    }
}
add_action('init', 'clearviewshield_create_bookings_table');

/**
 * Generate an iCal feed for upcoming appointments
 */
function clearviewshield_generate_ical_feed() {
    if (is_page(97)) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'clearviewshield_bookings';

        // Get all appointments (active and deleted) to include in the feed
        $appointments = $wpdb->get_results("SELECT * FROM $table_name WHERE booking_date >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)", ARRAY_A);
        error_log('Appointments for iCal feed: ' . print_r($appointments, true));

        // Set headers for .ics file with no-cache directives
        ob_clean();
        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: inline; filename=clearviewshield-appointments.ics');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Start iCal content
        $ical = "BEGIN:VCALENDAR\n";
        $ical .= "VERSION:2.0\n";
        $ical .= "PRODID:-//ClearViewShield//Appointment//EN\n";

        if (empty($appointments)) {
            error_log('No upcoming appointments found for iCal feed');
            // Add a dummy event to ensure the .ics file is valid
            $ical .= "BEGIN:VEVENT\n";
            $ical .= "UID:" . uniqid() . "@clearviewshield.com\n";
            $ical .= "DTSTAMP:" . gmdate('Ymd\THis\Z') . "\n";
            $ical .= "DTSTART:" . gmdate('Ymd\THis\Z') . "\n";
            $ical .= "DTEND:" . gmdate('Ymd\THis\Z', strtotime('+1 hour')) . "\n";
            $ical .= "SUMMARY:No Upcoming Appointments\n";
            $ical .= "DESCRIPTION:There are currently no upcoming appointments.\n";
            $ical .= "END:VEVENT\n";
        } else {
            foreach ($appointments as $appointment) {
                $start_datetime = $appointment['booking_date'] . ' ' . $appointment['booking_time'];
                $end_datetime = date('Y-m-d H:i:s', strtotime($start_datetime) + 3600);
                $ical .= "BEGIN:VEVENT\n";
                $ical .= "UID:" . $appointment['id'] . "@clearviewshield.com\n"; // Use booking ID as UID
                $ical .= "DTSTAMP:" . gmdate('Ymd\THis\Z') . "\n";
                $ical .= "DTSTART:" . date('Ymd\THis', strtotime($start_datetime)) . "Z\n";
                $ical .= "DTEND:" . date('Ymd\THis', strtotime($end_datetime)) . "Z\n";
                if ($appointment['status'] === 'deleted') {
                    $ical .= "STATUS:CANCELLED\n";
                    $ical .= "SUMMARY:Cancelled Appointment\n";
                    $ical .= "DESCRIPTION:This appointment has been cancelled.\n";
                } else {
                    $ical .= "SUMMARY:Windshield Repair Appointment for {$appointment['customer_name']}\n";
                    $ical .= "DESCRIPTION:Customer: {$appointment['customer_name']}\\nEmail: {$appointment['customer_email']}\\nPhone: {$appointment['customer_phone']}\\nVehicle: {$appointment['vehicle_make']} {$appointment['vehicle_model']} ({$appointment['vehicle_year']})\\nColor: {$appointment['vehicle_color']}\\nLicense Plate: " . ($appointment['license_plate'] ?: 'N/A') . "\\nDamage Location: {$appointment['damage_location']}\\nComments: " . ($appointment['additional_comments'] ?: 'N/A') . "\\nContact Method: {$appointment['contact_method']}\\nReferral Source: " . ($appointment['referral_source'] ?: 'N/A') . "\\nService: {$appointment['service']}\\nPhoto: " . ($appointment['photo_url'] ?: 'N/A') . "\n";
                    $ical .= "LOCATION:" . str_replace(',', '\,', $appointment['customer_address']) . "\n";
                }
                $ical .= "END:VEVENT\n";
            }
        }

        $ical .= "END:VCALENDAR\n";
        echo $ical;
        exit;
    }
}
add_action('template_redirect', 'clearviewshield_generate_ical_feed');