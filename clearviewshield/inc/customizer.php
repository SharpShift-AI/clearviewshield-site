<?php
/**
 * ClearViewShield Theme Customizer
 *
 * @package ClearViewShield
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clearviewshield_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport         = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'clearviewshield_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'clearviewshield_customize_partial_blogdescription',
            )
        );
    }

    // Add Theme Options Panel
    $wp_customize->add_panel('clearviewshield_theme_options', array(
        'title'       => __('ClearViewShield Options', 'clearviewshield'),
        'description' => __('Theme options for ClearViewShield', 'clearviewshield'),
        'priority'    => 130,
    ));

    // Add Color Scheme Section
    $wp_customize->add_section('clearviewshield_color_scheme', array(
        'title'       => __('Color Scheme', 'clearviewshield'),
        'description' => __('Customize the theme colors', 'clearviewshield'),
        'panel'       => 'clearviewshield_theme_options',
        'priority'    => 10,
    ));

    // Light Blue Color
    $wp_customize->add_setting('clearviewshield_light_blue', array(
        'default'           => '#7FB2CC',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'clearviewshield_light_blue', array(
        'label'    => __('Light Blue', 'clearviewshield'),
        'section'  => 'clearviewshield_color_scheme',
        'settings' => 'clearviewshield_light_blue',
    )));

    // Medium Blue Color
    $wp_customize->add_setting('clearviewshield_medium_blue', array(
        'default'           => '#4C7FB2',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'clearviewshield_medium_blue', array(
        'label'    => __('Medium Blue', 'clearviewshield'),
        'section'  => 'clearviewshield_color_scheme',
        'settings' => 'clearviewshield_medium_blue',
    )));

    // Gray Color
    $wp_customize->add_setting('clearviewshield_gray', array(
        'default'           => '#7F7F7F',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'clearviewshield_gray', array(
        'label'    => __('Gray', 'clearviewshield'),
        'section'  => 'clearviewshield_color_scheme',
        'settings' => 'clearviewshield_gray',
    )));

    // Add Header Options Section
    $wp_customize->add_section('clearviewshield_header_options', array(
        'title'       => __('Header Options', 'clearviewshield'),
        'description' => __('Customize the header', 'clearviewshield'),
        'panel'       => 'clearviewshield_theme_options',
        'priority'    => 20,
    ));

    // Header Style
    $wp_customize->add_setting('clearviewshield_header_style', array(
        'default'           => 'standard',
        'sanitize_callback' => 'clearviewshield_sanitize_select',
    ));

    $wp_customize->add_control('clearviewshield_header_style', array(
        'label'    => __('Header Style', 'clearviewshield'),
        'section'  => 'clearviewshield_header_options',
        'settings' => 'clearviewshield_header_style',
        'type'     => 'select',
        'choices'  => array(
            'standard' => __('Standard', 'clearviewshield'),
            'centered' => __('Centered', 'clearviewshield'),
            'minimal'  => __('Minimal', 'clearviewshield'),
        ),
    ));

    // Sticky Header
    $wp_customize->add_setting('clearviewshield_sticky_header', array(
        'default'           => true,
        'sanitize_callback' => 'clearviewshield_sanitize_checkbox',
    ));

    $wp_customize->add_control('clearviewshield_sticky_header', array(
        'label'    => __('Enable Sticky Header', 'clearviewshield'),
        'section'  => 'clearviewshield_header_options',
        'settings' => 'clearviewshield_sticky_header',
        'type'     => 'checkbox',
    ));

    // Add Footer Options Section
    $wp_customize->add_section('clearviewshield_footer_options', array(
        'title'       => __('Footer Options', 'clearviewshield'),
        'description' => __('Customize the footer', 'clearviewshield'),
        'panel'       => 'clearviewshield_theme_options',
        'priority'    => 30,
    ));

    // Footer Columns
    $wp_customize->add_setting('clearviewshield_footer_columns', array(
        'default'           => '3',
        'sanitize_callback' => 'clearviewshield_sanitize_select',
    ));

    $wp_customize->add_control('clearviewshield_footer_columns', array(
        'label'    => __('Footer Widget Columns', 'clearviewshield'),
        'section'  => 'clearviewshield_footer_options',
        'settings' => 'clearviewshield_footer_columns',
        'type'     => 'select',
        'choices'  => array(
            '1' => __('1 Column', 'clearviewshield'),
            '2' => __('2 Columns', 'clearviewshield'),
            '3' => __('3 Columns', 'clearviewshield'),
            '4' => __('4 Columns', 'clearviewshield'),
        ),
    ));

    // Footer Copyright Text
    $wp_customize->add_setting('clearviewshield_footer_copyright', array(
        'default'           => '© ' . date('Y') . ' ClearViewShield. All rights reserved.',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('clearviewshield_footer_copyright', array(
        'label'    => __('Copyright Text', 'clearviewshield'),
        'section'  => 'clearviewshield_footer_options',
        'settings' => 'clearviewshield_footer_copyright',
        'type'     => 'textarea',
    ));

    // Add Business Information Section
    $wp_customize->add_section('clearviewshield_business_info', array(
        'title'       => __('Business Information', 'clearviewshield'),
        'description' => __('Enter your business details', 'clearviewshield'),
        'panel'       => 'clearviewshield_theme_options',
        'priority'    => 40,
    ));

    // Phone Number
    $wp_customize->add_setting('clearviewshield_phone', array(
        'default'           => '319-775-0717',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_phone', array(
        'label'    => __('Phone Number', 'clearviewshield'),
        'section'  => 'clearviewshield_business_info',
        'settings' => 'clearviewshield_phone',
        'type'     => 'text',
    ));

    // Email Address
    $wp_customize->add_setting('clearviewshield_email', array(
        'default'           => 'info@clearviewshield.com',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('clearviewshield_email', array(
        'label'    => __('Email Address', 'clearviewshield'),
        'section'  => 'clearviewshield_business_info',
        'settings' => 'clearviewshield_email',
        'type'     => 'email',
    ));

    // Street Address
    $wp_customize->add_setting('clearviewshield_street', array(
        'default'           => '123 Main Street',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_street', array(
        'label'    => __('Street Address', 'clearviewshield'),
        'section'  => 'clearviewshield_business_info',
        'settings' => 'clearviewshield_street',
        'type'     => 'text',
    ));

    // City
    $wp_customize->add_setting('clearviewshield_city', array(
        'default'           => 'Cedar Rapids',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_city', array(
        'label'    => __('City', 'clearviewshield'),
        'section'  => 'clearviewshield_business_info',
        'settings' => 'clearviewshield_city',
        'type'     => 'text',
    ));

    // State
    $wp_customize->add_setting('clearviewshield_state', array(
        'default'           => 'IA',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_state', array(
        'label'    => __('State', 'clearviewshield'),
        'section'  => 'clearviewshield_business_info',
        'settings' => 'clearviewshield_state',
        'type'     => 'text',
    ));

    // ZIP Code
    $wp_customize->add_setting('clearviewshield_zip', array(
        'default'           => '52401',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_zip', array(
        'label'    => __('ZIP Code', 'clearviewshield'),
        'section'  => 'clearviewshield_business_info',
        'settings' => 'clearviewshield_zip',
        'type'     => 'text',
    ));

    // Country
    $wp_customize->add_setting('clearviewshield_country', array(
        'default'           => 'US',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_country', array(
        'label'    => __('Country', 'clearviewshield'),
        'section'  => 'clearviewshield_business_info',
        'settings' => 'clearviewshield_country',
        'type'     => 'text',
    ));

    // Add Business Hours Section
    $wp_customize->add_section('clearviewshield_business_hours', array(
        'title'       => __('Business Hours', 'clearviewshield'),
        'description' => __('Set your business hours', 'clearviewshield'),
        'panel'       => 'clearviewshield_theme_options',
        'priority'    => 50,
    ));

    // Monday Hours
    $wp_customize->add_setting('clearviewshield_monday_open', array(
        'default'           => '08:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_monday_open', array(
        'label'    => __('Monday Opening Time', 'clearviewshield'),
        'section'  => 'clearviewshield_business_hours',
        'settings' => 'clearviewshield_monday_open',
        'type'     => 'time',
    ));

    $wp_customize->add_setting('clearviewshield_monday_close', array(
        'default'           => '18:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_monday_close', array(
        'label'    => __('Monday Closing Time', 'clearviewshield'),
        'section'  => 'clearviewshield_business_hours',
        'settings' => 'clearviewshield_monday_close',
        'type'     => 'time',
    ));

    // Tuesday Hours
    $wp_customize->add_setting('clearviewshield_tuesday_open', array(
        'default'           => '08:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_tuesday_open', array(
        'label'    => __('Tuesday Opening Time', 'clearviewshield'),
        'section'  => 'clearviewshield_business_hours',
        'settings' => 'clearviewshield_tuesday_open',
        'type'     => 'time',
    ));

    $wp_customize->add_setting('clearviewshield_tuesday_close', array(
        'default'           => '18:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_tuesday_close', array(
        'label'    => __('Tuesday Closing Time', 'clearviewshield'),
        'section'  => 'clearviewshield_business_hours',
        'settings' => 'clearviewshield_tuesday_close',
        'type'     => 'time',
    ));

    // Wednesday Hours
    $wp_customize->add_setting('clearviewshield_wednesday_open', array(
        'default'           => '08:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_wednesday_open', array(
        'label'    => __('Wednesday Opening Time', 'clearviewshield'),
        'section'  => 'clearviewshield_business_hours',
        'settings' => 'clearviewshield_wednesday_open',
        'type'     => 'time',
    ));

    $wp_customize->add_setting('clearviewshield_wednesday_close', array(
        'default'           => '18:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_wednesday_close', array(
        'label'    => __('Wednesday Closing Time', 'clearviewshield'),
        'section'  => 'clearviewshield_business_hours',
        'settings' => 'clearviewshield_wednesday_close',
        'type'     => 'time',
    ));

    // Thursday Hours
    $wp_customize->add_setting('clearviewshield_thursday_open', array(
        'default'           => '08:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_thursday_open', array(
        'label'    => __('Thursday Opening Time', 'clearviewshield'),
        'section'  => 'clearviewshield_business_hours',
        'settings' => 'clearviewshield_thursday_open',
        'type'     => 'time',
    ));

    $wp_customize->add_setting('clearviewshield_thursday_close', array(
        'default'           => '18:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_thursday_close', array(
        'label'    => __('Thursday Closing Time', 'clearviewshield'),
        'section'  => 'clearviewshield_business_hours',
        'settings' => 'clearviewshield_thursday_close',
        'type'     => 'time',
    ));

    // Friday Hours
    $wp_customize->add_setting('clearviewshield_friday_open', array(
        'default'           => '08:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_friday_open', array(
        'label'    => __('Friday Opening Time', 'clearviewshield'),
        'section'  => 'clearviewshield_business_hours',
        'settings' => 'clearviewshield_friday_open',
        'type'     => 'time',
    ));

    $wp_customize->add_setting('clearviewshield_friday_close', array(
        'default'           => '18:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_friday_close', array(
        'label'    => __('Friday Closing Time', 'clearviewshield'),
        'section'  => 'clearviewshield_business_hours',
        'settings' => 'clearviewshield_friday_close',
        'type'     => 'time',
    ));

    // Saturday Hours
    $wp_customize->add_setting('clearviewshield_saturday_open', array(
        'default'           => '09:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_saturday_open', array(
        'label'    => __('Saturday Opening Time', 'clearviewshield'),
        'section'  => 'clearviewshield_business_hours',
        'settings' => 'clearviewshield_saturday_open',
        'type'     => 'time',
    ));

    $wp_customize->add_setting('clearviewshield_saturday_close', array(
        'default'           => '16:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_saturday_close', array(
        'label'    => __('Saturday Closing Time', 'clearviewshield'),
        'section'  => 'clearviewshield_business_hours',
        'settings' => 'clearviewshield_saturday_close',
        'type'     => 'time',
    ));

    // Sunday Hours
    $wp_customize->add_setting('clearviewshield_sunday_open', array(
        'default'           => 'closed',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_sunday_open', array(
        'label'    => __('Sunday Opening Time', 'clearviewshield'),
        'section'  => 'clearviewshield_business_hours',
        'settings' => 'clearviewshield_sunday_open',
        'type'     => 'text',
        'description' => __('Enter "closed" if not open', 'clearviewshield'),
    ));

    $wp_customize->add_setting('clearviewshield_sunday_close', array(
        'default'           => 'closed',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_sunday_close', array(
        'label'    => __('Sunday Closing Time', 'clearviewshield'),
        'section'  => 'clearviewshield_business_hours',
        'settings' => 'clearviewshield_sunday_close',
        'type'     => 'text',
        'description' => __('Enter "closed" if not open', 'clearviewshield'),
    ));

    // Add Social Media Section
    $wp_customize->add_section('clearviewshield_social_media', array(
        'title'       => __('Social Media', 'clearviewshield'),
        'description' => __('Enter your social media profiles', 'clearviewshield'),
        'panel'       => 'clearviewshield_theme_options',
        'priority'    => 60,
    ));

    // Facebook
    $wp_customize->add_setting('clearviewshield_facebook_url', array(
        'default'           => 'https://www.facebook.com/clearviewshield',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('clearviewshield_facebook_url', array(
        'label'    => __('Facebook URL', 'clearviewshield'),
        'section'  => 'clearviewshield_social_media',
        'settings' => 'clearviewshield_facebook_url',
        'type'     => 'url',
    ));

    // Instagram
    $wp_customize->add_setting('clearviewshield_instagram_url', array(
        'default'           => 'https://www.instagram.com/clearviewshield',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('clearviewshield_instagram_url', array(
        'label'    => __('Instagram URL', 'clearviewshield'),
        'section'  => 'clearviewshield_social_media',
        'settings' => 'clearviewshield_instagram_url',
        'type'     => 'url',
    ));

    // Twitter
    $wp_customize->add_setting('clearviewshield_twitter_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('clearviewshield_twitter_url', array(
        'label'    => __('Twitter URL', 'clearviewshield'),
        'section'  => 'clearviewshield_social_media',
        'settings' => 'clearviewshield_twitter_url',
        'type'     => 'url',
    ));

    // LinkedIn
    $wp_customize->add_setting('clearviewshield_linkedin_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('clearviewshield_linkedin_url', array(
        'label'    => __('LinkedIn URL', 'clearviewshield'),
        'section'  => 'clearviewshield_social_media',
        'settings' => 'clearviewshield_linkedin_url',
        'type'     => 'url',
    ));

    // YouTube
    $wp_customize->add_setting('clearviewshield_youtube_url', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('clearviewshield_youtube_url', array(
        'label'    => __('YouTube URL', 'clearviewshield'),
        'section'  => 'clearviewshield_social_media',
        'settings' => 'clearviewshield_youtube_url',
        'type'     => 'url',
    ));

    // Add Booking Options Section
    $wp_customize->add_section('clearviewshield_booking_options', array(
        'title'       => __('Booking Options', 'clearviewshield'),
        'description' => __('Configure booking settings', 'clearviewshield'),
        'panel'       => 'clearviewshield_theme_options',
        'priority'    => 70,
    ));

    // Booking Page
    $wp_customize->add_setting('clearviewshield_booking_page_id', array(
        'default'           => 0,
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('clearviewshield_booking_page_id', array(
        'label'    => __('Booking Page', 'clearviewshield'),
        'section'  => 'clearviewshield_booking_options',
        'settings' => 'clearviewshield_booking_page_id',
        'type'     => 'dropdown-pages',
    ));

    // Service Price
    $wp_customize->add_setting('clearviewshield_service_price', array(
        'default'           => '75',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_service_price', array(
        'label'    => __('Service Price', 'clearviewshield'),
        'section'  => 'clearviewshield_booking_options',
        'settings' => 'clearviewshield_service_price',
        'type'     => 'text',
    ));

    // Add Typography Section
    $wp_customize->add_section('clearviewshield_typography', array(
        'title'       => __('Typography', 'clearviewshield'),
        'description' => __('Customize fonts', 'clearviewshield'),
        'panel'       => 'clearviewshield_theme_options',
        'priority'    => 80,
    ));

    // Heading Font
    $wp_customize->add_setting('clearviewshield_heading_font', array(
        'default'           => 'Michroma',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_heading_font', array(
        'label'    => __('Heading Font', 'clearviewshield'),
        'section'  => 'clearviewshield_typography',
        'settings' => 'clearviewshield_heading_font',
        'type'     => 'select',
        'choices'  => array(
            'Michroma' => 'Michroma',
            'Roboto'   => 'Roboto',
            'Oswald'   => 'Oswald',
            'Montserrat' => 'Montserrat',
            'Raleway'  => 'Raleway',
        ),
    ));

    // Body Font
    $wp_customize->add_setting('clearviewshield_body_font', array(
        'default'           => 'Inter',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('clearviewshield_body_font', array(
        'label'    => __('Body Font', 'clearviewshield'),
        'section'  => 'clearviewshield_typography',
        'settings' => 'clearviewshield_body_font',
        'type'     => 'select',
        'choices'  => array(
            'Inter'    => 'Inter',
            'Roboto'   => 'Roboto',
            'Open Sans' => 'Open Sans',
            'Lato'     => 'Lato',
            'Poppins'  => 'Poppins',
        ),
    ));

    // Base Font Size
    $wp_customize->add_setting('clearviewshield_base_font_size', array(
        'default'           => '16',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('clearviewshield_base_font_size', array(
        'label'    => __('Base Font Size (px)', 'clearviewshield'),
        'section'  => 'clearviewshield_typography',
        'settings' => 'clearviewshield_base_font_size',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 12,
            'max'  => 24,
            'step' => 1,
        ),
    ));

    // Add Layout Options Section
    $wp_customize->add_section('clearviewshield_layout_options', array(
        'title'       => __('Layout Options', 'clearviewshield'),
        'description' => __('Customize layout settings', 'clearviewshield'),
        'panel'       => 'clearviewshield_theme_options',
        'priority'    => 90,
    ));

    // Container Width
    $wp_customize->add_setting('clearviewshield_container_width', array(
        'default'           => '1200',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('clearviewshield_container_width', array(
        'label'    => __('Container Width (px)', 'clearviewshield'),
        'section'  => 'clearviewshield_layout_options',
        'settings' => 'clearviewshield_container_width',
        'type'     => 'number',
        'input_attrs' => array(
            'min'  => 960,
            'max'  => 1600,
            'step' => 10,
        ),
    ));

    // Sidebar Position
    $wp_customize->add_setting('clearviewshield_sidebar_position', array(
        'default'           => 'right',
        'sanitize_callback' => 'clearviewshield_sanitize_select',
    ));

    $wp_customize->add_control('clearviewshield_sidebar_position', array(
        'label'    => __('Sidebar Position', 'clearviewshield'),
        'section'  => 'clearviewshield_layout_options',
        'settings' => 'clearviewshield_sidebar_position',
        'type'     => 'select',
        'choices'  => array(
            'right' => __('Right', 'clearviewshield'),
            'left'  => __('Left', 'clearviewshield'),
            'none'  => __('No Sidebar', 'clearviewshield'),
        ),
    ));

    // Add Animation Options Section
    $wp_customize->add_section('clearviewshield_animation_options', array(
        'title'       => __('Animation Options', 'clearviewshield'),
        'description' => __('Customize animation settings', 'clearviewshield'),
        'panel'       => 'clearviewshield_theme_options',
        'priority'    => 100,
    ));

    // Enable Animations
    $wp_customize->add_setting('clearviewshield_enable_animations', array(
        'default'           => true,
        'sanitize_callback' => 'clearviewshield_sanitize_checkbox',
    ));

    $wp_customize->add_control('clearviewshield_enable_animations', array(
        'label'    => __('Enable Animations', 'clearviewshield'),
        'section'  => 'clearviewshield_animation_options',
        'settings' => 'clearviewshield_enable_animations',
        'type'     => 'checkbox',
    ));

    // Animation Speed
    $wp_customize->add_setting('clearviewshield_animation_speed', array(
        'default'           => 'normal',
        'sanitize_callback' => 'clearviewshield_sanitize_select',
    ));

    $wp_customize->add_control('clearviewshield_animation_speed', array(
        'label'    => __('Animation Speed', 'clearviewshield'),
        'section'  => 'clearviewshield_animation_options',
        'settings' => 'clearviewshield_animation_speed',
        'type'     => 'select',
        'choices'  => array(
            'slow'   => __('Slow', 'clearviewshield'),
            'normal' => __('Normal', 'clearviewshield'),
            'fast'   => __('Fast', 'clearviewshield'),
        ),
    ));
}
add_action('customize_register', 'clearviewshield_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function clearviewshield_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function clearviewshield_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function clearviewshield_customize_preview_js() {
    wp_enqueue_script('clearviewshield-customizer', get_stylesheet_directory_uri() . '/js/customizer.js', array('customize-preview'), CLEARVIEWSHIELD_THEME_VERSION, true);
}
add_action('customize_preview_init', 'clearviewshield_customize_preview_js');

/**
 * Sanitize checkbox values.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool
 */
function clearviewshield_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

/**
 * Sanitize select values.
 *
 * @param string $input The input from the setting.
 * @param object $setting The selected setting.
 * @return string The sanitized input.
 */
function clearviewshield_sanitize_select($input, $setting) {
    // Get the list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control($setting->id)->choices;
    
    // If the input is a valid key, return it; otherwise, return the default.
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

/**
 * Output customizer CSS.
 */
function clearviewshield_customizer_css() {
    $light_blue = get_theme_mod('clearviewshield_light_blue', '#7FB2CC');
    $medium_blue = get_theme_mod('clearviewshield_medium_blue', '#4C7FB2');
    $gray = get_theme_mod('clearviewshield_gray', '#7F7F7F');
    $base_font_size = get_theme_mod('clearviewshield_base_font_size', '16');
    $container_width = get_theme_mod('clearviewshield_container_width', '1200');
    $heading_font = get_theme_mod('clearviewshield_heading_font', 'Michroma');
    $body_font = get_theme_mod('clearviewshield_body_font', 'Inter');
    
    $css = ':root {
        --light-blue: ' . esc_attr($light_blue) . ';
        --medium-blue: ' . esc_attr($medium_blue) . ';
        --gray: ' . esc_attr($gray) . ';
    }
    
    body {
        font-family: "' . esc_attr($body_font) . '", sans-serif;
        font-size: ' . esc_attr($base_font_size) . 'px;
    }
    
    h1, h2, h3, h4, h5, h6 {
        font-family: "' . esc_attr($heading_font) . '", sans-serif;
    }
    
    .container {
        max-width: ' . esc_attr($container_width) . 'px;
    }';
    
    // Animation speed
    $animation_speed = get_theme_mod('clearviewshield_animation_speed', 'normal');
    $speed_value = '0.3s';
    
    if ($animation_speed === 'slow') {
        $speed_value = '0.6s';
    } elseif ($animation_speed === 'fast') {
        $speed_value = '0.15s';
    }
    
    $css .= '
    .fade-in {
        transition: opacity 0.6s ease, transform ' . esc_attr($speed_value) . ' ease;
    }
    
    .btn, 
    .elementor-button,
    .wp-block-button__link,
    button,
    input[type="button"],
    input[type="submit"] {
        transition: all ' . esc_attr($speed_value) . ' ease;
    }';
    
    // Sidebar position
    $sidebar_position = get_theme_mod('clearviewshield_sidebar_position', 'right');
    
    if ($sidebar_position === 'left') {
        $css .= '
        @media (min-width: 992px) {
            .content-area {
                float: right;
            }
            .sidebar {
                float: left;
            }
        }';
    } elseif ($sidebar_position === 'none') {
        $css .= '
        .content-area {
            width: 100%;
            float: none;
        }
        .sidebar {
            display: none;
        }';
    }
    
    // Header style
    $header_style = get_theme_mod('clearviewshield_header_style', 'standard');
    
    if ($header_style === 'centered') {
        $css .= '
        .site-header .site-branding {
            text-align: center;
            float: none;
            margin: 0 auto;
        }
        .site-header .main-navigation {
            float: none;
            text-align: center;
        }
        .site-header .main-navigation ul {
            display: inline-block;
        }';
    } elseif ($header_style === 'minimal') {
        $css .= '
        .site-header {
            padding: 10px 0;
        }
        .site-header .site-branding {
            padding: 5px 0;
        }
        .site-header .site-logo img {
            max-height: 40px;
        }
        .site-header .main-navigation a {
            padding: 5px 10px;
        }';
    }
    
    // Sticky header
    $sticky_header = get_theme_mod('clearviewshield_sticky_header', true);
    
    if (!$sticky_header) {
        $css .= '
        .site-header {
            position: relative;
        }';
    }
    
    // Footer columns
    $footer_columns = get_theme_mod('clearviewshield_footer_columns', '3');
    
    $css .= '
    @media (min-width: 768px) {
        .footer-widgets .footer-widget {
            width: ' . (100 / intval($footer_columns)) . '%;
            float: left;
        }
    }';
    
    // Enable animations
    $enable_animations = get_theme_mod('clearviewshield_enable_animations', true);
    
    if (!$enable_animations) {
        $css .= '
        .fade-in {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
        }';
    }
    
    wp_add_inline_style('clearviewshield-theme-css', $css);
}
add_action('wp_enqueue_scripts', 'clearviewshield_customizer_css', 20);
