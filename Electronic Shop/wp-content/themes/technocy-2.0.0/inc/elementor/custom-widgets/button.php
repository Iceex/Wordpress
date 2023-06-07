<?php
// Button
use Elementor\Controls_Manager;

add_action( 'elementor/element/button/section_style/after_section_end', function ($element, $args ) {

    $element->update_control(
        'background_color',
        [
            'global' => [
                'default' => '',
            ],
			'selectors' => [
				'{{WRAPPER}} .elementor-button' => ' background-color: {{VALUE}};',
			],
        ]
    );
}, 10, 2 );

add_action('elementor/element/button/section_style/before_section_end', function ($element, $args) {
    $element->add_control(
        'icon_button_size',
        [
            'label' => esc_html__('Icon Size', 'technocy'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 6,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button .elementor-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'selected_icon[value]!' => '',
            ],
        ]
    );
    $element->add_control(
        'button_icon_color',
        [
            'label'     => esc_html__('Icon Color', 'technocy'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'selectors' => [
                '{{WRAPPER}} .elementor-button .elementor-button-icon' => 'fill: {{VALUE}}; color: {{VALUE}};',
            ],
            'condition' => [
                'selected_icon[value]!' => '',
            ],
        ]
    );
}, 10, 2);

add_action('elementor/element/button/section_button/before_section_end', function ($element, $args) {
	$element->add_control(
		'button_style_theme',
		[
			'label'        => esc_html__('Theme Style', 'technocy'),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '',
			'prefix_class' => 'button-style-technocy-',
		]
	);

    $element->add_control(
        'button_style_theme_layout_color',
        [
            'label'     => esc_html__('Border Color', 'technocy'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '',
            'condition' => [
                'button_style_theme' => 'yes',
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button:hover .elementor-button-icon:before' => 'border-top-color: {{VALUE}}; border-right-color: {{VALUE}}; border-bottom-color: {{VALUE}};',
                '{{WRAPPER}} .elementor-button:hover .elementor-button-icon:after' => 'border-top-color: {{VALUE}};',
            ],
        ]
    );


}, 10, 2);
