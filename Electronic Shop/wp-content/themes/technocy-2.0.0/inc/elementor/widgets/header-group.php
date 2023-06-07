<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;

class Technocy_Elementor_Header_Group extends Elementor\Widget_Base {

    public function get_name() {
        return 'technocy-header-group';
    }

    public function get_title() {
        return esc_html__('Technocy Header Group', 'technocy');
    }

    public function get_icon() {
        return 'eicon-lock-user';
    }

    public function get_categories() {
        return array('technocy-addons');
    }

    public function get_script_depends() {
        return ['technocy-elementor-header-group', 'slick', 'technocy-cart-canvas'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'header_group_config',
            [
                'label' => esc_html__('Config', 'technocy'),
            ]
        );

        $this->add_control(
            'show_search',
            [
                'label' => esc_html__('Show search', 'technocy'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_account',
            [
                'label' => esc_html__('Show account', 'technocy'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_wishlist',
            [
                'label' => esc_html__('Show wishlist', 'technocy'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_cart',
            [
                'label' => esc_html__('Show cart', 'technocy'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'header-group-style',
            [
                'label' => esc_html__('Icon', 'technocy'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a:not(:hover) i:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a:not(:hover):before'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div .button-content:not(:hover) > span'   => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action .count'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a:hover i:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a:hover:before'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => esc_html__('Font Size', 'technocy'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a i:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-header-group-wrapper .header-group-action > div a:before'   => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'elementor-header-group-wrapper');
        ?>
        <div <?php echo technocy_elementor_get_render_attribute_string('wrapper', $this); ?>>
            <div class="header-group-action">

                <?php if ($settings['show_search'] === 'yes'):{
                    technocy_header_search_button();
                }
                endif; ?>

                <?php if ($settings['show_account'] === 'yes'):{
                    technocy_header_account();
                }
                endif; ?>

                <?php if ($settings['show_wishlist'] === 'yes' && technocy_is_woocommerce_activated()):{
                    technocy_header_wishlist();
                }
                endif; ?>

                <?php if ($settings['show_cart'] === 'yes' && technocy_is_woocommerce_activated()):{
                    technocy_header_cart();
                }
                endif; ?>

            </div>
        </div>
        <?php
    }
}

$widgets_manager->register(new Technocy_Elementor_Header_Group());
