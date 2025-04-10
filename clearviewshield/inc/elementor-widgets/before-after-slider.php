<?php
/**
 * Before After Slider Elementor Widget
 *
 * @package ClearViewShield
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Before After Slider Widget
 */
class ClearViewShield_Before_After_Slider extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'clearviewshield_before_after_slider';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Before After Slider', 'clearviewshield');
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-slider-push';
    }

    /**
     * Get widget categories.
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['clearviewshield-elements'];
    }

    /**
     * Get widget keywords.
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['before', 'after', 'slider', 'comparison', 'windshield', 'repair'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'clearviewshield'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Before & After', 'clearviewshield'),
                'placeholder' => __('Enter your title', 'clearviewshield'),
            ]
        );

        $this->add_control(
            'before_image',
            [
                'label' => __('Before Image', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'after_image',
            [
                'label' => __('After Image', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'before_label',
            [
                'label' => __('Before Label', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Before', 'clearviewshield'),
                'placeholder' => __('Enter before label', 'clearviewshield'),
            ]
        );

        $this->add_control(
            'after_label',
            [
                'label' => __('After Label', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('After', 'clearviewshield'),
                'placeholder' => __('Enter after label', 'clearviewshield'),
            ]
        );

        $this->add_control(
            'initial_offset',
            [
                'label' => __('Initial Offset (%)', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'clearviewshield'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-title' => 'color: {{VALUE}}',
                ],
                'default' => '#4C7FB2',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .slider-title',
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => __('Label Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .before-after-slider .twentytwenty-before-label:before, {{WRAPPER}} .before-after-slider .twentytwenty-after-label:before' => 'color: {{VALUE}}',
                ],
                'default' => '#ffffff',
            ]
        );

        $this->add_control(
            'label_background',
            [
                'label' => __('Label Background', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .before-after-slider .twentytwenty-before-label:before, {{WRAPPER}} .before-after-slider .twentytwenty-after-label:before' => 'background: {{VALUE}}',
                ],
                'default' => 'rgba(76, 127, 178, 0.8)',
            ]
        );

        $this->add_control(
            'handle_color',
            [
                'label' => __('Handle Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .before-after-slider .twentytwenty-handle' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .before-after-slider .twentytwenty-handle:before, {{WRAPPER}} .before-after-slider .twentytwenty-handle:after' => 'background: {{VALUE}}',
                ],
                'default' => '#4C7FB2',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .before-after-slider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 8,
                    'right' => 8,
                    'bottom' => 8,
                    'left' => 8,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .before-after-slider',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $before_image = $settings['before_image']['url'];
        $after_image = $settings['after_image']['url'];
        $before_label = $settings['before_label'];
        $after_label = $settings['after_label'];
        $initial_offset = $settings['initial_offset']['size'];
        $title = $settings['title'];

        $this->add_render_attribute('wrapper', 'class', 'before-after-slider-wrapper');
        $this->add_render_attribute('slider', 'class', 'before-after-slider');
        $this->add_render_attribute('slider', 'data-offset', $initial_offset);
        $this->add_render_attribute('slider', 'data-before-label', $before_label);
        $this->add_render_attribute('slider', 'data-after-label', $after_label);
        
        // Generate a unique ID for this slider
        $slider_id = 'before-after-slider-' . $this->get_id();
        $this->add_render_attribute('slider', 'id', $slider_id);
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <?php if (!empty($title)) : ?>
                <h4 class="slider-title"><?php echo esc_html($title); ?></h4>
            <?php endif; ?>
            
            <div <?php echo $this->get_render_attribute_string('slider'); ?>>
                <img src="<?php echo esc_url($before_image); ?>" alt="<?php echo esc_attr($before_label); ?>" class="before-image">
                <img src="<?php echo esc_url($after_image); ?>" alt="<?php echo esc_attr($after_label); ?>" class="after-image">
            </div>
        </div>
        
        <script>
            jQuery(document).ready(function($) {
                $("#<?php echo esc_js($slider_id); ?>").twentytwenty({
                    default_offset_pct: <?php echo esc_js($initial_offset / 100); ?>,
                    before_label: "<?php echo esc_js($before_label); ?>",
                    after_label: "<?php echo esc_js($after_label); ?>"
                });
            });
        </script>
        <?php
    }

    /**
     * Render widget output in the editor.
     */
    protected function content_template() {
        ?>
        <#
        var before_image = settings.before_image.url;
        var after_image = settings.after_image.url;
        var before_label = settings.before_label;
        var after_label = settings.after_label;
        var initial_offset = settings.initial_offset.size;
        var title = settings.title;
        var slider_id = 'before-after-slider-' + view.getID();
        #>
        <div class="before-after-slider-wrapper">
            <# if (title) { #>
                <h4 class="slider-title">{{{ title }}}</h4>
            <# } #>
            
            <div class="before-after-slider" id="{{ slider_id }}" data-offset="{{ initial_offset }}" data-before-label="{{ before_label }}" data-after-label="{{ after_label }}">
                <img src="{{ before_image }}" alt="{{ before_label }}" class="before-image">
                <img src="{{ after_image }}" alt="{{ after_label }}" class="after-image">
            </div>
        </div>
        
        <script>
            // Note: This script won't actually run in the editor preview
            jQuery(document).ready(function($) {
                $("#{{ slider_id }}").twentytwenty({
                    default_offset_pct: {{ initial_offset / 100 }},
                    before_label: "{{ before_label }}",
                    after_label: "{{ after_label }}"
                });
            });
        </script>
        <?php
    }
}
