
<?php
// Image
use Elementor\Controls_Manager;


add_action('elementor/element/image/section_image/before_section_end', function ($element, $args) {
	$element->add_control(
		'image_style_theme',
		[
			'label' => esc_html__('Theme Style', 'technocy'),
			'type' => Controls_Manager::SWITCHER,
			'default' => '',
			'prefix_class' => 'image-style-technocy-',
			'condition' => [
				'link_to!' => 'none',
			],
		]
	);

}, 10, 2);

