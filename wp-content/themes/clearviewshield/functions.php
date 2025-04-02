<?php
/**
 * ClearViewShield functions and definitions
 *
 * @package ClearViewShield
 */

if ( ! defined( '_S_VERSION' ) ) {
    // Replace the version number of the theme on each release.
    define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function clearviewshield_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_theme_textdomain( 'clearviewshield', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(
        array(
            'primary' => esc_html__( 'Primary Menu', 'clearviewshield' ),
            'footer' => esc_html__( 'Footer Menu', 'clearviewshield' ),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
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

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action( 'after_setup_theme', 'clearviewshield_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function clearviewshield_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'clearviewshield_content_width', 1200 );
}
add_action( 'after_setup_theme', 'clearviewshield_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
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
            'name'          => esc_html__( 'Footer Widget Area 1', 'clearviewshield' ),
            'id'            => 'footer-1',
            'description'   => esc_html__( 'Add widgets here.', 'clearviewshield' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="footer-title">',
            'after_title'   => '</h3>',
        )
    );
    
    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer Widget Area 2', 'clearviewshield' ),
            'id'            => 'footer-2',
            'description'   => esc_html__( 'Add widgets here.', 'clearviewshield' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="footer-title">',
            'after_title'   => '</h3>',
        )
    );
    
    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer Widget Area 3', 'clearviewshield' ),
            'id'            => 'footer-3',
            'description'   => esc_html__( 'Add widgets here.', 'clearviewshield' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="footer-title">',
            'after_title'   => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'clearviewshield_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function clearviewshield_scripts() {
    wp_enqueue_style( 'clearviewshield-style', get_stylesheet_directory_uri() . '/style.min.css', array(), _S_VERSION );
    wp_enqueue_style( 'clearviewshield-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&family=Roboto:wght@300;400;500;700&display=swap', array(), null );
    wp_enqueue_style( 'clearviewshield-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4' );
    
    wp_enqueue_script( 'clearviewshield-navigation', get_template_directory_uri() . '/assets/js/navigation.min.js', array('jquery'), _S_VERSION, true );
    wp_script_add_data( 'clearviewshield-navigation', 'defer', true );
    wp_enqueue_script( 'clearviewshield-main', get_template_directory_uri() . '/assets/js/main.min.js', array('jquery'), _S_VERSION, true );
    wp_script_add_data( 'clearviewshield-main', 'defer', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'clearviewshield_scripts' );

/**
 * Register Custom Post Type for Bookings
 */
function clearviewshield_register_booking_post_type() {
    $labels = array(
        'name'                  => _x( 'Bookings', 'Post type general name', 'clearviewshield' ),
        'singular_name'         => _x( 'Booking', 'Post type singular name', 'clearviewshield' ),
        'menu_name'             => _x( 'Bookings', 'Admin Menu text', 'clearviewshield' ),
        'name_admin_bar'        => _x( 'Booking', 'Add New on Toolbar', 'clearviewshield' ),
        'add_new'               => __( 'Add New', 'clearviewshield' ),
        'add_new_item'          => __( 'Add New Booking', 'clearviewshield' ),
        'new_item'              => __( 'New Booking', 'clearviewshield' ),
        'edit_item'             => __( 'Edit Booking', 'clearviewshield' ),
        'view_item'             => __( 'View Booking', 'clearviewshield' ),
        'all_items'             => __( 'All Bookings', 'clearviewshield' ),
        'search_items'          => __( 'Search Bookings', 'clearviewshield' ),
        'parent_item_colon'     => __( 'Parent Bookings:', 'clearviewshield' ),
        'not_found'             => __( 'No bookings found.', 'clearviewshield' ),
        'not_found_in_trash'    => __( 'No bookings found in Trash.', 'clearviewshield' ),
        'featured_image'        => _x( 'Booking Cover Image', 'Overrides the "Featured Image" phrase', 'clearviewshield' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the "Set featured image" phrase', 'clearviewshield' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the "Remove featured image" phrase', 'clearviewshield' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the "Use as featured image" phrase', 'clearviewshield' ),
        'archives'              => _x( 'Booking archives', 'The post type archive label used in nav menus', 'clearviewshield' ),
        'insert_into_item'      => _x( 'Insert into booking', 'Overrides the "Insert into post" phrase', 'clearviewshield' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this booking', 'Overrides the "Uploaded to this post" phrase', 'clearviewshield' ),
        'filter_items_list'     => _x( 'Filter bookings list', 'Screen reader text for the filter links', 'clearviewshield' ),
        'items_list_navigation' => _x( 'Bookings list navigation', 'Screen reader text for the pagination', 'clearviewshield' ),
        'items_list'            => _x( 'Bookings list', 'Screen reader text for the items list', 'clearviewshield' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'booking' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 20,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array( 'title', 'editor', 'author', 'custom-fields' ),
    );

    register_post_type( 'booking', $args );
}
add_action( 'init', 'clearviewshield_register_booking_post_type' );

/**
 * Send SMS notification using Twilio
 */
function clearviewshield_send_sms_notification($phone_number, $message) {
    // Check if WP Twilio Core plugin is active
    if (!function_exists('twl_send_sms')) {
        return false;
    }
    
    // Format phone number
    $phone_number = preg_replace('/[^0-9]/', '', $phone_number);
    
    // Add country code if not present
    if (strlen($phone_number) === 10) {
        $phone_number = '+1' . $phone_number;
    } elseif (substr($phone_number, 0, 1) !== '+') {
        $phone_number = '+' . $phone_number;
    }
    
    // Send SMS
    $result = twl_send_sms($phone_number, $message);
    
    return $result;
}

/**
 * Add shortcode for booking form
 */
function clearviewshield_booking_form_shortcode() {
    ob_start();
    get_template_part('template-parts/booking-form');
    return ob_get_clean();
}
add_shortcode('booking_form', 'clearviewshield_booking_form_shortcode');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
// require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
// require get_template_directory() . '/inc/customizer.php';