<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
if (!technocy_is_contactform_activated()) {
    return;
}

use Elementor\Controls_Manager;

class Technocy_Elementor_ContactForm extends Elementor\Widget_Base {

    public function get_name() {
        return 'technocy-contactform';
    }

    public function get_title() {
        return esc_html__('Technocy Contact Form', 'technocy');
    }

    public function get_categories() {
        return array('technocy-addons');
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    protected function register_controls() {
        $this->start_controls_section(
            'contactform7',
            [
                'label' => esc_html__('General', 'technocy'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $cf7               = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');
        $contact_forms[''] = esc_html__('Please select form', 'technocy');
        if ($cf7) {
            foreach ($cf7 as $cform) {
                $contact_forms[$cform->ID] = $cform->post_title;
            }
        } else {
            $contact_forms[0] = esc_html__('No contact forms found', 'technocy');
        }

        $this->add_control(
            'cf_id',
            [
                'label'   => esc_html__('Select contact form', 'technocy'),
                'type'    => Controls_Manager::SELECT,
                'options' => $contact_forms,
                'default' => ''
            ]
        );

        $this->add_control(
            'form_name',
            [
                'label'   => esc_html__('Form name', 'technocy'),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__('Contact form', 'technocy'),
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'        => esc_html__('Alignment', 'technocy'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => esc_html__('Left', 'technocy'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'technocy'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'technocy'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'prefix_class' => 'contact-form-align-',
                'default'      => '',
            ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!$settings['cf_id']) {
            return;
        }
        $args['id']    = $settings['cf_id'];
        $args['title'] = $settings['form_name'];

        echo technocy_do_shortcode('contact-form-7', $args);
    }
}

$widgets_manager->register(new Technocy_Elementor_ContactForm());
