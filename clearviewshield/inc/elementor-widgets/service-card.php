<?php
/**
 * Service Card Elementor Widget
 *
 * @package ClearViewShield
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Service Card Widget
 */
class ClearViewShield_Service_Card extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'clearviewshield_service_card';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Service Card', 'clearviewshield');
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-info-box';
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
        return ['service', 'card', 'box', 'windshield', 'repair'];
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
                'default' => __('Windshield Chip Repair', 'clearviewshield'),
                'placeholder' => __('Enter service title', 'clearviewshield'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('Professional repair for rock chips, star breaks, and bull\'s-eyes. Our advanced resin technology restores your windshield\'s integrity.', 'clearviewshield'),
                'placeholder' => __('Enter service description', 'clearviewshield'),
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __('Icon', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-car',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => __('Price', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '75',
                'placeholder' => __('Enter price', 'clearviewshield'),
            ]
        );

        $this->add_control(
            'show_price',
            [
                'label' => __('Show Price', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'clearviewshield'),
                'label_off' => __('No', 'clearviewshield'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __('Button Text', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Book Repair', 'clearviewshield'),
                'placeholder' => __('Enter button text', 'clearviewshield'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Link', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'clearviewshield'),
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
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
            'card_background',
            [
                'label' => __('Card Background', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-card' => 'background-color: {{VALUE}}',
                ],
                'default' => '#ffffff',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'card_border',
                'selector' => '{{WRAPPER}} .service-card',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'card_border_radius',
            [
                'label' => __('Border Radius', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .service-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'name' => 'card_box_shadow',
                'selector' => '{{WRAPPER}} .service-card',
            ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label' => __('Padding', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .service-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 30,
                    'right' => 30,
                    'bottom' => 30,
                    'left' => 30,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );

        $this->add_control(
            'heading_icon_style',
            [
                'label' => __('Icon', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-icon i' => 'color: {{VALUE}}',
                ],
                'default' => '#4C7FB2',
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => __('Icon Size', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 40,
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_margin_bottom',
            [
                'label' => __('Icon Margin Bottom', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_title_style',
            [
                'label' => __('Title', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-title' => 'color: {{VALUE}}',
                ],
                'default' => '#4C7FB2',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .service-title',
            ]
        );

        $this->add_control(
            'title_margin_bottom',
            [
                'label' => __('Title Margin Bottom', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_description_style',
            [
                'label' => __('Description', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __('Description Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-description' => 'color: {{VALUE}}',
                ],
                'default' => '#7F7F7F',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .service-description',
            ]
        );

        $this->add_control(
            'description_margin_bottom',
            [
                'label' => __('Description Margin Bottom', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_price_style',
            [
                'label' => __('Price', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_price' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => __('Price Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price-tag' => 'color: {{VALUE}}',
                ],
                'default' => '#4C7FB2',
                'condition' => [
                    'show_price' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .price-tag',
                'condition' => [
                    'show_price' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'price_margin_bottom',
            [
                'label' => __('Price Margin Bottom', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-price' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_price' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'heading_button_style',
            [
                'label' => __('Button', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs('button_style_tabs');

        $this->start_controls_tab(
            'button_normal_tab',
            [
                'label' => __('Normal', 'clearviewshield'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __('Text Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-card .btn' => 'color: {{VALUE}}',
                ],
                'default' => '#ffffff',
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => __('Background Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-card .btn' => 'background-color: {{VALUE}}',
                ],
                'default' => '#4C7FB2',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .service-card .btn',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __('Border Radius', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .service-card .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 4,
                    'right' => 4,
                    'bottom' => 4,
                    'left' => 4,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Padding', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .service-card .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 10,
                    'right' => 20,
                    'bottom' => 10,
                    'left' => 20,
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover_tab',
            [
                'label' => __('Hover', 'clearviewshield'),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => __('Text Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-card .btn:hover' => 'color: {{VALUE}}',
                ],
                'default' => '#ffffff',
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label' => __('Background Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-card .btn:hover' => 'background-color: {{VALUE}}',
                ],
                'default' => '#7FB2CC',
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __('Border Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-card .btn:hover' => 'border-color: {{VALUE}}',
                ],
                'default' => '#7FB2CC',
                'condition' => [
                    'button_border_border!' => '',
                ],
            ]
        );

        $this->add_control(
            'button_hover_animation',
            [
                'label' => __('Hover Animation', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $title = $settings['title'];
        $description = $settings['description'];
        $price = $settings['price'];
        $show_price = $settings['show_price'];
        $button_text = $settings['button_text'];
        
        $this->add_render_attribute('wrapper', 'class', 'service-card');
        
        if ($settings['button_hover_animation']) {
            $this->add_render_attribute('button', 'class', 'elementor-animation-' . $settings['button_hover_animation']);
        }
        
        $this->add_render_attribute('button', 'class', 'btn');
        
        if (!empty($settings['link']['url'])) {
            $this->add_link_attributes('button', $settings['link']);
        }
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div class="service-icon">
                <?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
            </div>
            
            <h3 class="service-title"><?php echo esc_html($title); ?></h3>
            <p class="service-description"><?php echo esc_html($description); ?></p>
            
            <?php if ('yes' === $show_price && !empty($price)) : ?>
                <p class="service-price"><strong>Price: <span class="price-tag">$<?php echo esc_html($price); ?></span></strong></p>
            <?php endif; ?>
            
            <a <?php echo $this->get_render_attribute_string('button'); ?>><?php echo esc_html($button_text); ?></a>
        </div>
        <?php
    }

    /**
     * Render widget output in the editor.
     */
    protected function content_template() {
        ?>
        <#
        var iconHTML = elementor.helpers.renderIcon(view, settings.icon, { 'aria-hidden': true }, 'i', 'object');
        #>
        <div class="service-card">
            <div class="service-icon">
                {{{ iconHTML.value }}}
            </div>
            
            <h3 class="service-title">{{{ settings.title }}}</h3>
            <p class="service-description">{{{ settings.description }}}</p>
            
            <# if ('yes' === settings.show_price && settings.price) { #>
                <p class="service-price"><strong>Price: <span class="price-tag">${{ settings.price }}</span></strong></p>
            <# } #>
            
            <a class="btn elementor-animation-{{ settings.button_hover_animation }}" href="{{ settings.link.url }}">{{{ settings.button_text }}}</a>
        </div>
        <?php
    }
}
