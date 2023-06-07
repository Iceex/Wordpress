<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Technocy_Customize')) {

    class Technocy_Customize {


        public function __construct() {
            add_action('customize_register', array($this, 'customize_register'));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         */
        public function customize_register($wp_customize) {

            /**
             * Theme options.
             */
            require_once get_theme_file_path('inc/customize-control/editor.php');
            $this->init_technocy_blog($wp_customize);

            $this->init_technocy_social($wp_customize);

            if (technocy_is_woocommerce_activated()) {
                $this->init_woocommerce($wp_customize);
            }

            do_action('technocy_customize_register', $wp_customize);
        }


        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_technocy_blog($wp_customize) {

            $wp_customize->add_section('technocy_blog_archive', array(
                'title' => esc_html__('Blog', 'technocy'),
            ));

            // =========================================
            // Select Style
            // =========================================

            $wp_customize->add_setting('technocy_options_blog_style', array(
                'type'              => 'option',
                'default'           => 'standard',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('technocy_options_blog_style', array(
                'section' => 'technocy_blog_archive',
                'label'   => esc_html__('Blog style', 'technocy'),
                'type'    => 'select',
                'choices' => array(
                    'standard' => esc_html__('Blog Standard', 'technocy'),
                    'style-1'  => esc_html__('Style 1', 'technocy'),
                ),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_technocy_social($wp_customize) {

            $wp_customize->add_section('technocy_social', array(
                'title' => esc_html__('Socials', 'technocy'),
            ));
            $wp_customize->add_setting('technocy_options_social_share', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('technocy_options_social_share', array(
                'type'    => 'checkbox',
                'section' => 'technocy_social',
                'label'   => esc_html__('Show Social Share', 'technocy'),
            ));
            $wp_customize->add_setting('technocy_options_social_share_facebook', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('technocy_options_social_share_facebook', array(
                'type'    => 'checkbox',
                'section' => 'technocy_social',
                'label'   => esc_html__('Share on Facebook', 'technocy'),
            ));
            $wp_customize->add_setting('technocy_options_social_share_twitter', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('technocy_options_social_share_twitter', array(
                'type'    => 'checkbox',
                'section' => 'technocy_social',
                'label'   => esc_html__('Share on Twitter', 'technocy'),
            ));
            $wp_customize->add_setting('technocy_options_social_share_linkedin', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('technocy_options_social_share_linkedin', array(
                'type'    => 'checkbox',
                'section' => 'technocy_social',
                'label'   => esc_html__('Share on Linkedin', 'technocy'),
            ));
            $wp_customize->add_setting('technocy_options_social_share_google-plus', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('technocy_options_social_share_google-plus', array(
                'type'    => 'checkbox',
                'section' => 'technocy_social',
                'label'   => esc_html__('Share on Google+', 'technocy'),
            ));

            $wp_customize->add_setting('technocy_options_social_share_pinterest', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('technocy_options_social_share_pinterest', array(
                'type'    => 'checkbox',
                'section' => 'technocy_social',
                'label'   => esc_html__('Share on Pinterest', 'technocy'),
            ));
            $wp_customize->add_setting('technocy_options_social_share_email', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('technocy_options_social_share_email', array(
                'type'    => 'checkbox',
                'section' => 'technocy_social',
                'label'   => esc_html__('Share on Email', 'technocy'),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_woocommerce($wp_customize) {

            $wp_customize->add_panel('woocommerce', array(
                'title' => esc_html__('Woocommerce', 'technocy'),
            ));

            $wp_customize->add_section('technocy_woocommerce_archive', array(
                'title'      => esc_html__('Archive', 'technocy'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
                'priority'   => 1,
            ));

            $wp_customize->add_setting('technocy_options_woocommerce_archive_layout', array(
                'type'              => 'option',
                'default'           => 'default',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('technocy_options_woocommerce_archive_layout', array(
                'section' => 'technocy_woocommerce_archive',
                'label'   => esc_html__('Layout Style', 'technocy'),
                'type'    => 'select',
                'choices' => array(
                    'default'   => esc_html__('Sidebar', 'technocy'),
                    'canvas'    => esc_html__('Canvas Filter', 'technocy'),
                    'dropdown'  => esc_html__('Dropdown Filter', 'technocy'),
                    'fullwidth' => esc_html__('Full Width', 'technocy'),
                ),
            ));

            $wp_customize->add_setting('technocy_options_woocommerce_archive_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('technocy_options_woocommerce_archive_sidebar', array(
                'section' => 'technocy_woocommerce_archive',
                'label'   => esc_html__('Sidebar Position', 'technocy'),
                'type'    => 'select',
                'choices' => array(
                    'left'  => esc_html__('Left', 'technocy'),
                    'right' => esc_html__('Right', 'technocy'),

                ),
            ));

            // =========================================
            // Single Product
            // =========================================

            $wp_customize->add_section('technocy_woocommerce_single', array(
                'title'      => esc_html__('Single Product', 'technocy'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
            ));

            $wp_customize->add_setting('technocy_options_single_product_gallery_layout', array(
                'type'              => 'option',
                'default'           => 'horizontal',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('technocy_options_single_product_gallery_layout', array(
                'section' => 'technocy_woocommerce_single',
                'label'   => esc_html__('Style', 'technocy'),
                'type'    => 'select',
                'choices' => array(
                    'horizontal'      => esc_html__('Horizontal', 'technocy'),
                    'vertical'        => esc_html__('Vertical', 'technocy'),
                ),
            ));

            $wp_customize->add_setting('technocy_options_single_product_archive_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('technocy_options_single_product_archive_sidebar', array(
                'section' => 'technocy_woocommerce_single',
                'label'   => esc_html__('Sidebar Position', 'technocy'),
                'type'    => 'select',
                'choices' => array(
                    'left'  => esc_html__('Left', 'technocy'),
                    'right' => esc_html__('Right', 'technocy'),

                ),
            ));


            // =========================================
            // Product
            // =========================================

            $wp_customize->add_section('technocy_woocommerce_product', array(
                'title'      => esc_html__('Product Block', 'technocy'),
                'capability' => 'edit_theme_options',
                'panel'      => 'woocommerce',
            ));

            $wp_customize->add_setting('technocy_options_wocommerce_block_style', array(
                'type'              => 'option',
                'default'           => '1',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('technocy_options_wocommerce_block_style', array(
                'section' => 'technocy_woocommerce_product',
                'label'   => esc_html__('Style', 'technocy'),
                'type'    => 'select',
                'choices' => array(
                    '1' => esc_html__('Style 1', 'technocy')
                ),
            ));

            $wp_customize->add_setting('technocy_options_woocommerce_product_hover', array(
                'type'              => 'option',
                'default'           => 'none',
                'transport'         => 'refresh',
                'sanitize_callback' => 'sanitize_text_field',
            ));
            $wp_customize->add_control('technocy_options_woocommerce_product_hover', array(
                'section' => 'technocy_woocommerce_product',
                'label'   => esc_html__('Animation Image Hover', 'technocy'),
                'type'    => 'select',
                'choices' => array(
                    'none'          => esc_html__('None', 'technocy'),
                    'bottom-to-top' => esc_html__('Bottom to Top', 'technocy'),
                    'top-to-bottom' => esc_html__('Top to Bottom', 'technocy'),
                    'right-to-left' => esc_html__('Right to Left', 'technocy'),
                    'left-to-right' => esc_html__('Left to Right', 'technocy'),
                    'swap'          => esc_html__('Swap', 'technocy'),
                    'fade'          => esc_html__('Fade', 'technocy'),
                    'zoom-in'       => esc_html__('Zoom In', 'technocy'),
                    'zoom-out'      => esc_html__('Zoom Out', 'technocy'),
                ),
            ));
        }
    }
}
return new Technocy_Customize();
