<?php
/**
 * Testimonial Slider Elementor Widget
 *
 * @package ClearViewShield
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Testimonial Slider Widget
 */
class ClearViewShield_Testimonial_Slider extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'clearviewshield_testimonial_slider';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Testimonial Slider', 'clearviewshield');
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-testimonial-carousel';
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
        return ['testimonial', 'slider', 'carousel', 'review', 'feedback'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls() {

        $this->start_controls_section(
            'section_testimonials',
            [
                'label' => __('Testimonials', 'clearviewshield'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'content',
            [
                'label' => __('Content', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __('I was amazed at how quickly and effectively they repaired the chip in my windshield. The technician was professional and the results were perfect!', 'clearviewshield'),
                'placeholder' => __('Enter testimonial content', 'clearviewshield'),
            ]
        );

        $repeater->add_control(
            'author',
            [
                'label' => __('Author', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('John Smith', 'clearviewshield'),
                'placeholder' => __('Enter author name', 'clearviewshield'),
            ]
        );

        $repeater->add_control(
            'location',
            [
                'label' => __('Location', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Cedar Rapids', 'clearviewshield'),
                'placeholder' => __('Enter author location', 'clearviewshield'),
            ]
        );

        $repeater->add_control(
            'rating',
            [
                'label' => __('Rating', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '5',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ],
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __('Author Image', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => __('Testimonial Items', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'content' => __('I was amazed at how quickly and effectively they repaired the chip in my windshield. The technician was professional and the results were perfect!', 'clearviewshield'),
                        'author' => __('John Smith', 'clearviewshield'),
                        'location' => __('Cedar Rapids', 'clearviewshield'),
                        'rating' => '5',
                    ],
                    [
                        'content' => __('Great service at a fair price. They came to my workplace and fixed my windshield in less than an hour. Highly recommend!', 'clearviewshield'),
                        'author' => __('Jane Doe', 'clearviewshield'),
                        'location' => __('Marion', 'clearviewshield'),
                        'rating' => '5',
                    ],
                    [
                        'content' => __('I had a crack that I thought would require a full windshield replacement, but they were able to repair it perfectly. Saved me hundreds of dollars!', 'clearviewshield'),
                        'author' => __('Mike Johnson', 'clearviewshield'),
                        'location' => __('Hiawatha', 'clearviewshield'),
                        'rating' => '4',
                    ],
                ],
                'title_field' => '{{{ author }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_settings',
            [
                'label' => __('Slider Settings', 'clearviewshield'),
            ]
        );

        $this->add_control(
            'slides_to_show',
            [
                'label' => __('Slides to Show', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                ],
            ]
        );

        $this->add_control(
            'slides_to_scroll',
            [
                'label' => __('Slides to Scroll', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __('Autoplay', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'clearviewshield'),
                'label_off' => __('No', 'clearviewshield'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __('Autoplay Speed', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => __('Infinite Loop', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'clearviewshield'),
                'label_off' => __('No', 'clearviewshield'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'arrows',
            [
                'label' => __('Arrows', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'clearviewshield'),
                'label_off' => __('Hide', 'clearviewshield'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'dots',
            [
                'label' => __('Dots', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'clearviewshield'),
                'label_off' => __('Hide', 'clearviewshield'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => __('Pause on Hover', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'clearviewshield'),
                'label_off' => __('No', 'clearviewshield'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adaptive_height',
            [
                'label' => __('Adaptive Height', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'clearviewshield'),
                'label_off' => __('No', 'clearviewshield'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'responsive',
            [
                'label' => __('Responsive Settings', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'tablet_slides_to_show',
            [
                'label' => __('Tablet: Slides to Show', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                ],
            ]
        );

        $this->add_control(
            'mobile_slides_to_show',
            [
                'label' => __('Mobile: Slides to Show', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => '1',
                    '2' => '2',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_testimonial',
            [
                'label' => __('Testimonial', 'clearviewshield'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'testimonial_background_color',
            [
                'label' => __('Background Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-card' => 'background-color: {{VALUE}}',
                ],
                'default' => '#ffffff',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'testimonial_border',
                'selector' => '{{WRAPPER}} .testimonial-card',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'testimonial_border_radius',
            [
                'label' => __('Border Radius', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'name' => 'testimonial_box_shadow',
                'selector' => '{{WRAPPER}} .testimonial-card',
            ]
        );

        $this->add_responsive_control(
            'testimonial_padding',
            [
                'label' => __('Padding', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'heading_content_style',
            [
                'label' => __('Content', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => __('Text Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content' => 'color: {{VALUE}}',
                ],
                'default' => '#7F7F7F',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .testimonial-content',
            ]
        );

        $this->add_control(
            'content_margin_bottom',
            [
                'label' => __('Margin Bottom', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_author_style',
            [
                'label' => __('Author', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'author_color',
            [
                'label' => __('Text Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-author' => 'color: {{VALUE}}',
                ],
                'default' => '#4C7FB2',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography',
                'selector' => '{{WRAPPER}} .testimonial-author',
            ]
        );

        $this->add_control(
            'heading_rating_style',
            [
                'label' => __('Rating', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'rating_color',
            [
                'label' => __('Star Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-rating .fas' => 'color: {{VALUE}}',
                ],
                'default' => '#FFD700',
            ]
        );

        $this->add_control(
            'rating_unmarked_color',
            [
                'label' => __('Unmarked Star Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-rating .far' => 'color: {{VALUE}}',
                ],
                'default' => '#d8d8d8',
            ]
        );

        $this->add_control(
            'rating_size',
            [
                'label' => __('Size', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-rating i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'rating_spacing',
            [
                'label' => __('Spacing', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-rating i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'rating_margin_bottom',
            [
                'label' => __('Margin Bottom', 'clearviewshield'),
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
                    '{{WRAPPER}} .testimonial-rating' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_image_style',
            [
                'label' => __('Author Image', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label' => __('Size', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 200,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .testimonial-image img',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __('Border Radius', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 50,
                    'right' => 50,
                    'bottom' => 50,
                    'left' => 50,
                    'unit' => '%',
                    'isLinked' => true,
                ],
            ]
        );

        $this->add_control(
            'image_margin_bottom',
            [
                'label' => __('Margin Bottom', 'clearviewshield'),
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
                    '{{WRAPPER}} .testimonial-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_navigation',
            [
                'label' => __('Navigation', 'clearviewshield'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_arrows_style',
            [
                'label' => __('Arrows', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrows_size',
            [
                'label' => __('Size', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 60,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider .slick-prev, {{WRAPPER}} .testimonial-slider .slick-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .testimonial-slider .slick-prev:before, {{WRAPPER}} .testimonial-slider .slick-next:before' => 'font-size: calc({{SIZE}}{{UNIT}} / 2);',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_arrows_style');

        $this->start_controls_tab(
            'tab_arrows_normal',
            [
                'label' => __('Normal', 'clearviewshield'),
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrows_color',
            [
                'label' => __('Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider .slick-prev:before, {{WRAPPER}} .testimonial-slider .slick-next:before' => 'color: {{VALUE}};',
                ],
                'default' => '#4C7FB2',
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrows_background',
            [
                'label' => __('Background Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider .slick-prev, {{WRAPPER}} .testimonial-slider .slick-next' => 'background-color: {{VALUE}};',
                ],
                'default' => '#ffffff',
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'arrows_border',
                'selector' => '{{WRAPPER}} .testimonial-slider .slick-prev, {{WRAPPER}} .testimonial-slider .slick-next',
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrows_border_radius',
            [
                'label' => __('Border Radius', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider .slick-prev, {{WRAPPER}} .testimonial-slider .slick-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => 50,
                    'right' => 50,
                    'bottom' => 50,
                    'left' => 50,
                    'unit' => '%',
                    'isLinked' => true,
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_arrows_hover',
            [
                'label' => __('Hover', 'clearviewshield'),
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrows_hover_color',
            [
                'label' => __('Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider .slick-prev:hover:before, {{WRAPPER}} .testimonial-slider .slick-next:hover:before' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff',
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrows_hover_background',
            [
                'label' => __('Background Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider .slick-prev:hover, {{WRAPPER}} .testimonial-slider .slick-next:hover' => 'background-color: {{VALUE}};',
                ],
                'default' => '#4C7FB2',
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrows_hover_border_color',
            [
                'label' => __('Border Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider .slick-prev:hover, {{WRAPPER}} .testimonial-slider .slick-next:hover' => 'border-color: {{VALUE}};',
                ],
                'default' => '#4C7FB2',
                'condition' => [
                    'arrows' => 'yes',
                    'arrows_border_border!' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'heading_dots_style',
            [
                'label' => __('Dots', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'dots' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'dots_size',
            [
                'label' => __('Size', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 20,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider .slick-dots li button:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'dots' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => __('Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider .slick-dots li button:before' => 'color: {{VALUE}};',
                ],
                'default' => '#d8d8d8',
                'condition' => [
                    'dots' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'dots_active_color',
            [
                'label' => __('Active Color', 'clearviewshield'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-slider .slick-dots li.slick-active button:before' => 'color: {{VALUE}};',
                ],
                'default' => '#4C7FB2',
                'condition' => [
                    'dots' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper', 'class', 'testimonial-slider-wrapper');
        
        // Generate a unique ID for this slider
        $slider_id = 'testimonial-slider-' . $this->get_id();
        
        // Slider settings
        $slider_options = [
            'slidesToShow' => intval($settings['slides_to_show']),
            'slidesToScroll' => intval($settings['slides_to_scroll']),
            'autoplay' => ('yes' === $settings['autoplay']),
            'autoplaySpeed' => intval($settings['autoplay_speed']),
            'infinite' => ('yes' === $settings['infinite']),
            'arrows' => ('yes' === $settings['arrows']),
            'dots' => ('yes' === $settings['dots']),
            'pauseOnHover' => ('yes' === $settings['pause_on_hover']),
            'adaptiveHeight' => ('yes' === $settings['adaptive_height']),
            'responsive' => [
                [
                    'breakpoint' => 1024,
                    'settings' => [
                        'slidesToShow' => intval($settings['tablet_slides_to_show']),
                        'slidesToScroll' => 1,
                    ],
                ],
                [
                    'breakpoint' => 767,
                    'settings' => [
                        'slidesToShow' => intval($settings['mobile_slides_to_show']),
                        'slidesToScroll' => 1,
                    ],
                ],
            ],
        ];
        
        $slider_options_json = json_encode($slider_options);
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
            <div id="<?php echo esc_attr($slider_id); ?>" class="testimonial-slider">
                <?php foreach ($settings['testimonials'] as $index => $item) : ?>
                    <div class="testimonial-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-rating">
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <?php if ($i <= $item['rating']) : ?>
                                        <i class="fas fa-star"></i>
                                    <?php else : ?>
                                        <i class="far fa-star"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </div>
                            
                            <div class="testimonial-content">
                                "<?php echo esc_html($item['content']); ?>"
                            </div>
                            
                            <?php if (!empty($item['image']['url'])) : ?>
                                <div class="testimonial-image">
                                    <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['author']); ?>">
                                </div>
                            <?php endif; ?>
                            
                            <div class="testimonial-author">
                                - <?php echo esc_html($item['author']); ?>
                                <?php if (!empty($item['location'])) : ?>
                                    , <?php echo esc_html($item['location']); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <script>
            jQuery(document).ready(function($) {
                $("#<?php echo esc_js($slider_id); ?>").slick(<?php echo $slider_options_json; ?>);
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
        var sliderId = 'testimonial-slider-' + view.getID();
        #>
        <div class="testimonial-slider-wrapper">
            <div id="{{ sliderId }}" class="testimonial-slider">
                <# _.each(settings.testimonials, function(item, index) { #>
                    <div class="testimonial-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-rating">
                                <# for (var i = 1; i <= 5; i++) { #>
                                    <# if (i <= item.rating) { #>
                                        <i class="fas fa-star"></i>
                                    <# } else { #>
                                        <i class="far fa-star"></i>
                                    <# } #>
                                <# } #>
                            </div>
                            
                            <div class="testimonial-content">
                                "{{ item.content }}"
                            </div>
                            
                            <# if (item.image.url) { #>
                                <div class="testimonial-image">
                                    <img src="{{ item.image.url }}" alt="{{ item.author }}">
                                </div>
                            <# } #>
                            
                            <div class="testimonial-author">
                                - {{ item.author }}
                                <# if (item.location) { #>
                                    , {{ item.location }}
                                <# } #>
                            </div>
                        </div>
                    </div>
                <# }); #>
            </div>
        </div>
        
        <# /* Note: This script won't actually run in the editor preview */ #>
        <script>
            jQuery(document).ready(function($) {
                $("#{{ sliderId }}").slick({
                    slidesToShow: {{ settings.slides_to_show }},
                    slidesToScroll: {{ settings.slides_to_scroll }},
                    autoplay: {{ settings.autoplay === 'yes' ? 'true' : 'false' }},
                    autoplaySpeed: {{ settings.autoplay_speed }},
                    infinite: {{ settings.infinite === 'yes' ? 'true' : 'false' }},
                    arrows: {{ settings.arrows === 'yes' ? 'true' : 'false' }},
                    dots: {{ settings.dots === 'yes' ? 'true' : 'false' }},
                    pauseOnHover: {{ settings.pause_on_hover === 'yes' ? 'true' : 'false' }},
                    adaptiveHeight: {{ settings.adaptive_height === 'yes' ? 'true' : 'false' }},
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: {{ settings.tablet_slides_to_show }},
                                slidesToScroll: 1
                            }
                        },
                        {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: {{ settings.mobile_slides_to_show }},
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            });
        </script>
        <?php
    }
}
