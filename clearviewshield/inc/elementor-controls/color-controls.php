<?php
/**
 * Elementor Color Controls
 *
 * @package ClearViewShield
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Custom color controls for Elementor
 */
class ClearViewShield_Color_Controls {

    /**
     * Constructor
     */
    public function __construct() {
        // Add custom colors to color picker
        add_action('elementor/editor/before_enqueue_scripts', array($this, 'add_custom_colors'));
        
        // Add custom color schemes
        add_filter('elementor/schemes/colors', array($this, 'add_custom_color_schemes'));
    }

    /**
     * Add custom colors to Elementor color picker
     */
    public function add_custom_colors() {
        // Get theme colors from customizer
        $light_blue = get_theme_mod('clearviewshield_light_blue', '#7FB2CC');
        $medium_blue = get_theme_mod('clearviewshield_medium_blue', '#4C7FB2');
        $gray = get_theme_mod('clearviewshield_gray', '#7F7F7F');
        
        // Add custom colors to Elementor color picker
        $script = "
            jQuery(document).ready(function() {
                if (typeof elementor !== 'undefined') {
                    elementor.settings.editorPreferences.addChangeCallback('ui_theme', function() {
                        elementor.schemes.addSchemeValue('color-picker', {
                            value: '{$light_blue}',
                            label: 'ClearViewShield Light Blue'
                        });
                        
                        elementor.schemes.addSchemeValue('color-picker', {
                            value: '{$medium_blue}',
                            label: 'ClearViewShield Medium Blue'
                        });
                        
                        elementor.schemes.addSchemeValue('color-picker', {
                            value: '{$gray}',
                            label: 'ClearViewShield Gray'
                        });
                    });
                }
            });
        ";
        
        wp_add_inline_script('elementor-editor', $script);
    }

    /**
     * Add custom color schemes to Elementor
     *
     * @param array $schemes Current color schemes.
     * @return array Modified color schemes.
     */
    public function add_custom_color_schemes($schemes) {
        // Get theme colors from customizer
        $light_blue = get_theme_mod('clearviewshield_light_blue', '#7FB2CC');
        $medium_blue = get_theme_mod('clearviewshield_medium_blue', '#4C7FB2');
        $gray = get_theme_mod('clearviewshield_gray', '#7F7F7F');
        
        // Add ClearViewShield color scheme
        $schemes['color']->add_scheme('clearviewshield', array(
            'title' => 'ClearViewShield',
            'items' => array(
                '1' => $medium_blue,
                '2' => $light_blue,
                '3' => $gray,
                '4' => '#ffffff',
            ),
        ));
        
        return $schemes;
    }

    /**
     * Get theme color by name
     *
     * @param string $color_name Color name.
     * @return string Color hex code.
     */
    public static function get_color($color_name) {
        switch ($color_name) {
            case 'light_blue':
                return get_theme_mod('clearviewshield_light_blue', '#7FB2CC');
            case 'medium_blue':
                return get_theme_mod('clearviewshield_medium_blue', '#4C7FB2');
            case 'gray':
                return get_theme_mod('clearviewshield_gray', '#7F7F7F');
            default:
                return '';
        }
    }

    /**
     * Register custom color controls for Elementor widgets
     *
     * @param \Elementor\Controls_Manager $controls_manager Elementor controls manager.
     */
    public static function register_controls($controls_manager) {
        $controls_manager->add_control(
            'clearviewshield_color_scheme',
            [
                'label' => __('ClearViewShield Color Scheme', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __('Default', 'clearviewshield'),
                    'light_blue' => __('Light Blue', 'clearviewshield'),
                    'medium_blue' => __('Medium Blue', 'clearviewshield'),
                    'gray' => __('Gray', 'clearviewshield'),
                ],
                'selectors' => [
                    '{{WRAPPER}}' => '--clearviewshield-color: {{VALUE}};',
                ],
            ]
        );
    }

    /**
     * Add custom color controls to a section
     *
     * @param \Elementor\Widget_Base $widget Elementor widget.
     * @param string $section_id Section ID.
     */
    public static function add_color_controls($widget, $section_id) {
        $widget->start_controls_section(
            $section_id,
            [
                'label' => __('ClearViewShield Colors', 'clearviewshield'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $widget->add_control(
            'clearviewshield_primary_color',
            [
                'label' => __('Primary Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => self::get_color('medium_blue'),
                'selectors' => [
                    '{{WRAPPER}} .clearviewshield-primary-color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .clearviewshield-primary-background' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .clearviewshield-primary-border' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $widget->add_control(
            'clearviewshield_secondary_color',
            [
                'label' => __('Secondary Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => self::get_color('light_blue'),
                'selectors' => [
                    '{{WRAPPER}} .clearviewshield-secondary-color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .clearviewshield-secondary-background' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .clearviewshield-secondary-border' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $widget->add_control(
            'clearviewshield_accent_color',
            [
                'label' => __('Accent Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => self::get_color('gray'),
                'selectors' => [
                    '{{WRAPPER}} .clearviewshield-accent-color' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .clearviewshield-accent-background' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .clearviewshield-accent-border' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $widget->end_controls_section();
    }

    /**
     * Get color scheme CSS variables
     *
     * @return string CSS variables.
     */
    public static function get_color_scheme_css() {
        $light_blue = self::get_color('light_blue');
        $medium_blue = self::get_color('medium_blue');
        $gray = self::get_color('gray');
        
        return "
            :root {
                --clearviewshield-light-blue: {$light_blue};
                --clearviewshield-medium-blue: {$medium_blue};
                --clearviewshield-gray: {$gray};
            }
            
            .clearviewshield-light-blue {
                color: {$light_blue};
            }
            
            .clearviewshield-medium-blue {
                color: {$medium_blue};
            }
            
            .clearviewshield-gray {
                color: {$gray};
            }
            
            .clearviewshield-light-blue-bg {
                background-color: {$light_blue};
            }
            
            .clearviewshield-medium-blue-bg {
                background-color: {$medium_blue};
            }
            
            .clearviewshield-gray-bg {
                background-color: {$gray};
            }
        ";
    }
}
