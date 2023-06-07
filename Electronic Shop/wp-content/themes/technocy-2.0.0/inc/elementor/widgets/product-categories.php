<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
if (!technocy_is_woocommerce_activated()) {
    return;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;

/**
 * Elementor Technocy_Elementor_Products_Categories
 * @since 1.0.0
 */
class Technocy_Elementor_Products_Categories extends Elementor\Widget_Base {

    public function get_categories() {
        return array('technocy-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'technocy-product-categories';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Product Categories', 'technocy');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_script_depends() {
        return ['technocy-elementor-product-categories', 'slick'];
    }

    protected function register_controls() {

        //Section Query
        $this->start_controls_section(
            'section_setting',
            [
                'label' => esc_html__('Categories', 'technocy'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            'categories_type',
            [
                'label'   => esc_html__('Type', 'technocy'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'cate_image',
                'options' => [
                    'cate_image' => esc_html__('Image', 'technocy'),
                    'cate_icon'  => esc_html__('Icon', 'technocy'),
                ]
            ]
        );

        $repeater->add_control(
            'categories_name',
            [
                'label' => esc_html__('Alternate Name', 'technocy'),
                'type'  => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'categories_description',
            [
                'label' => esc_html__('Description', 'technocy'),
                'type'  => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'categories',
            [
                'label'       => esc_html__('Categories', 'technocy'),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'options'     => $this->get_product_categories(),
                'multiple'    => false,
            ]
        );

        $repeater->add_control(
            'category_image',
            [
                'label'      => esc_html__('Choose Image', 'technocy'),
                'default'    => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
                'condition'  => [
                    'categories_type' => 'cate_image'
                ]
            ]

        );

        $repeater->add_control(
            'category_icon',
            [
                'label'     => esc_html__('Icon', 'technocy'),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'   => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'categories_type' => 'cate_icon'
                ]
            ]
        );

        $this->add_control(
            'categories_list',
            [
                'label'       => esc_html__('Items', 'technocy'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ categories }}}',
            ]
        );
        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `brand_image_size` and `brand_image_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'     => esc_html__('Alignment', 'technocy'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
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
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .cat-title'                  => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'vertical_alignment',
            [
                'label'        => esc_html__('Vertical Alignment', 'technocy'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'top'    => esc_html__('Top', 'technocy'),
                    'middle' => esc_html__('Middle', 'technocy'),
                    'bottom' => esc_html__('Bottom', 'technocy'),
                ],
                'default'      => 'top',
                'prefix_class' => 'vertical-align-',
            ]
        );

        $this->add_control(
            'product_cate_layout',
            [
                'label'   => esc_html__('Layout', 'technocy'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('Layout 1', 'technocy'),
                    '2' => esc_html__('Layout 2', 'technocy'),
                    '3' => esc_html__('Layout 3', 'technocy'),
                    '4' => esc_html__('Layout 4', 'technocy'),
                    '5' => esc_html__('Layout 5', 'technocy'),
                    '6' => esc_html__('Layout 6', 'technocy'),
                ],
                'prefix_class' => 'product-cate-layout-',
            ]
        );
        $this->add_responsive_control(
            'column',
            [
                'label'   => esc_html__('Columns', 'technocy'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 1,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8],
            ]
        );
        $this->add_responsive_control(
            'product_gutter',
            [
                'label'      => esc_html__('Gutter', 'technocy'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} [data-elementor-columns] .column-item' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2); margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .technocy-carousel .column-item'       => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2);',
                    '{{WRAPPER}} .row'                                  => 'margin-left: calc({{SIZE}}{{UNIT}} / -2); margin-right: calc({{SIZE}}{{UNIT}} / -2);',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'product_cate_style',
            [
                'label' => esc_html__('Box', 'technocy'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => esc_html__('Padding', 'technocy'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .product-cat' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        $this->add_control(
            'layout_bkg_color',
            [
                'label'     => esc_html__('Background', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-cat' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'min-height',
            [
                'label'      => esc_html__('Height', 'technocy'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', 'vh'],
                'selectors'  => [
                    '{{WRAPPER}} .product-cat' => 'min-height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'wrapper_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .product-cat',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'box_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'technocy'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .product-cat' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'image_style',
            [
                'label' => esc_html__('Image', 'technocy'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .link_category_product img',
            ]
        );
        $this->add_responsive_control(
            'image_width',
            [
                'label'          => esc_html__('Width', 'technocy'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .link_category_product img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_max_width',
            [
                'label'          => esc_html__('Max Width', 'technocy'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .link_category_product' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_height',
            [
                'label'          => esc_html__('Height', 'technocy'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units'     => ['px', 'vh'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .link_category_product img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'tabs_img_style',
            [
                'condition' => [
                    'product_cate_layout' => '1'
                ]
            ]
        );
        $this->start_controls_tab(
            'tab_img_normal',
            [
                'label' => esc_html__('Normal', 'technocy'),
            ]
        );
        $this->add_control(
            'img_layout_1_bacground',
            [
                'label'     => esc_html__('Background Color', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .link_category_product:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'img_layout_1_opacity',
            [
                'label'     => esc_html__('Opacity', 'technocy'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .link_category_product:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_img_hover',
            [
                'label' => esc_html__('Hover', 'technocy'),
            ]
        );

        $this->add_control(
            'img_bacground_hover',
            [
                'label'     => esc_html__('Background Color', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .link_category_product:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'img_opacity_hover',
            [
                'label'     => esc_html__('Opacity', 'technocy'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .link_category_product:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'technocy'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .link_category_product' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_padding',
            [
                'label'      => esc_html__('Padding', 'technocy'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .link_category_product' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => esc_html__('Margin', 'technocy'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .link_category_product img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label' => esc_html__('Title', 'technocy'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tilte_typography',
                'selector' => '{{WRAPPER}} .cat-title-text',
            ]
        );


        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__('Margin', 'technocy'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .cat-title-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => esc_html__('Padding', 'technocy'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .cat-title-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tab_title');
        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => esc_html__('Normal', 'technocy'),
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .cat-title-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => esc_html__('Hover', 'technocy'),
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Hover Color', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .cat-title-text:hover '             => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-cat:hover .cat-title-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        // Description
        $this->start_controls_section(
            'description_style',
            [
                'label' => esc_html__('Description', 'technocy'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => esc_html__('Color', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .categories-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .categories-description',
            ]
        );

        $this->add_responsive_control(
            'description_space',
            [
                'label'     => esc_html__('Spacing', 'technocy'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .categories-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'total_style',
            [
                'label' => esc_html__('Total', 'technocy'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'total_typography',
                'selector' => '{{WRAPPER}} .cat-total',
            ]
        );

        $this->add_control(
            'total_color',
            [
                'label'     => esc_html__('Color', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .product-cat-caption .cat-title .cat-total' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'total_color_hover',
            [
                'label'     => esc_html__('Color hover', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover .cat-title .cat-total' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'icon_style',
            [
                'label' => esc_html__('Icon', 'technocy'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_space',
            [
                'label'     => esc_html__('Spacing', 'technocy'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 15,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-cat i' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => esc_html__('Size', 'technocy'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 6,
                        'max' => 200,
                    ],
                ],
                'default'   => [
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-cat i'   => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .product-cat svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tab_icon');
        $this->start_controls_tab(
            'tab_icon_normal',
            [
                'label' => esc_html__('Normal', 'technocy'),
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .product-cat i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_icon_hover',
            [
                'label' => esc_html__('Hover', 'technocy'),
            ]
        );
        $this->add_control(
            'icon_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .product-cat:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Carousel options
        $this->add_control_carousel();
    }

    protected function get_product_categories() {
        $categories = get_terms(array(
                'taxonomy'   => 'product_cat',
                'hide_empty' => false,
            )
        );
        $results    = array();
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $results[$category->slug] = $category->name;
            }
        }
        return $results;
    }

    protected function add_control_carousel($condition = array()) {
        $this->start_controls_section(
            'section_carousel_options',
            [
                'label'     => esc_html__('Carousel Options', 'technocy'),
                'type'      => Controls_Manager::SECTION,
                'condition' => $condition,
            ]
        );

        $this->add_control(
            'enable_carousel',
            [
                'label'     => esc_html__('Enable', 'technocy'),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'product_cate_layout!' => '2'
                ]
            ]
        );

        $this->add_control(
            'variableWidth',
            [
                'label'     => esc_html__('Variable Width', 'technocy'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'maxVariableWidth',
            [
                'label'      => esc_html__('Max Width', 'technocy'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => '',
                ],
                'condition'  => [
                    'enable_carousel'  => 'yes',
                    'variableWidth'    => 'yes',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-slide' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'centerMode',
            [
                'label'     => esc_html__('Center Mode', 'technocy'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
                'condition' => [
                    'enable_carousel'  => 'yes',
                ],
            ]
        );


        $this->add_control(
            'navigation',
            [
                'label'     => esc_html__('Navigation', 'technocy'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'dots',
                'options'   => [
                    'both'   => esc_html__('Arrows and Dots', 'technocy'),
                    'arrows' => esc_html__('Arrows', 'technocy'),
                    'dots'   => esc_html__('Dots', 'technocy'),
                    'none'   => esc_html__('None', 'technocy'),
                ],
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label'     => esc_html__('Pause on Hover', 'technocy'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'     => esc_html__('Autoplay', 'technocy'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'     => esc_html__('Autoplay Speed', 'technocy'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5000,
                'condition' => [
                    'autoplay'        => 'yes',
                    'enable_carousel' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
                ],
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label'     => esc_html__('Infinite Loop', 'technocy'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_arrows',
            [
                'label'      => esc_html__('Carousel Arrows', 'technocy'),
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'enable_carousel',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'none',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'dots',
                        ],
                    ],
                ],
            ]
        );


        $this->add_responsive_control(
            'arrow_size',
            [
                'label' => esc_html__('Size', 'technocy'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_control(
            'next_heading',
            [
                'label' => esc_html__('Next button', 'technocy'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'next_vertical',
            [
                'label'       => esc_html__('Next Vertical', 'technocy'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'top'    => [
                        'title' => esc_html__('Top', 'technocy'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'technocy'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ]
            ]
        );

        $this->add_responsive_control(
            'next_vertical_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-next' => 'top: unset; bottom: unset; {{next_vertical.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'next_horizontal',
            [
                'label'       => esc_html__('Next Horizontal', 'technocy'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'  => [
                        'title' => esc_html__('Left', 'technocy'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'technocy'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'defautl'     => 'right'
            ]
        );
        $this->add_responsive_control(
            'next_horizontal_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => -45,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-next' => 'left: unset; right: unset;{{next_horizontal.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'prev_heading',
            [
                'label'     => esc_html__('Prev button', 'technocy'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'prev_vertical',
            [
                'label'       => esc_html__('Prev Vertical', 'technocy'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'top'    => [
                        'title' => esc_html__('Top', 'technocy'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'technocy'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ]
            ]
        );

        $this->add_responsive_control(
            'prev_vertical_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-prev' => 'top: unset; bottom: unset; {{prev_vertical.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'prev_horizontal',
            [
                'label'       => esc_html__('Prev Horizontal', 'technocy'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'  => [
                        'title' => esc_html__('Left', 'technocy'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'technocy'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'defautl'     => 'left'
            ]
        );
        $this->add_responsive_control(
            'prev_horizontal_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => -45,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-prev' => 'left: unset; right: unset; {{prev_horizontal.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'color_button',
            [
                'label' => esc_html__('Color button', 'technocy'),
                'type'  => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'button_color_normal',
            [
                'label'     => esc_html__('Color normal', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .slick-slider button.slick-next:before' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__('Color active', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev:hover:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .slick-slider button.slick-next:hover:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .slick-slider button.slick-prev:focus:before' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .slick-slider button.slick-next:focus:before' => 'color: {{VALUE}}',
                ],
            ]
        );



        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_dots',
            [
                'label'      => esc_html__('Carousel Dots', 'technocy'),
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'enable_carousel',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'none',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'both',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'arrows',
                        ],
                    ],
                ],
            ]
        );

        $this->start_controls_tabs('tabs_carousel_dots_style');

        $this->start_controls_tab(
            'tab_carousel_dots_normal',
            [
                'label' => esc_html__('Normal', 'technocy'),
            ]
        );

        $this->add_control(
            'carousel_dots_color',
            [
                'label'     => esc_html__('Color', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity',
            [
                'label'     => esc_html__('Opacity', 'technocy'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_carousel_dots_hover',
            [
                'label' => esc_html__('Hover', 'technocy'),
            ]
        );

        $this->add_control(
            'carousel_dots_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:hover:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slick-dots li button:focus:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity_hover',
            [
                'label'     => esc_html__('Opacity', 'technocy'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:hover:before' => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .slick-dots li button:focus:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_carousel_dots_activate',
            [
                'label' => esc_html__('Activate', 'technocy'),
            ]
        );

        $this->add_control(
            'carousel_dots_color_activate',
            [
                'label'     => esc_html__('Color', 'technocy'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li.slick-active button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity_activate',
            [
                'label'     => esc_html__('Opacity', 'technocy'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li.slick-active button:before' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'dots_vertical_value',
            [
                'label'      => esc_html__('Spacing', 'technocy'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => '',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['categories_list']) && is_array($settings['categories_list'])) {
            $this->add_render_attribute('wrapper', 'class', 'elementor-categories-item-wrapper');

            // Row
            $this->add_render_attribute('row', 'class', 'row');
            $this->add_render_attribute('row', 'class', 'layout-' . esc_attr($settings['product_cate_layout']));
            // Carousel
            if ($settings['enable_carousel'] === 'yes') {

                $this->add_render_attribute('row', 'class', 'technocy-carousel');
                $carousel_settings = $this->get_carousel_settings();
                $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));

            } else {

                if (!empty($settings['column_widescreen'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-widescreen', $settings['column_widescreen']);
                }

                if (!empty($settings['column'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
                } else {
                    $this->add_render_attribute('row', 'data-elementor-columns', 5);
                }

                if (!empty($settings['column_laptop'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-laptop', $settings['column_laptop']);
                }

                if (!empty($settings['column_tablet_extra'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-tablet-extra', $settings['column_tablet_extra']);
                }

                if (!empty($settings['column_tablet'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['column_tablet']);
                } else {
                    $this->add_render_attribute('row', 'data-elementor-columns-tablet', 2);
                }

                if (!empty($settings['column_mobile_extra'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-mobile-extra', $settings['column_mobile_extra']);
                }

                if (!empty($settings['column_mobile'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['column_mobile']);
                } else {
                    $this->add_render_attribute('row', 'data-elementor-columns-mobile', 1);
                }

            }
            // Item
            $this->add_render_attribute('item', 'class', 'column-item elementor-categories-item');

            ?>
            <div <?php echo technocy_elementor_get_render_attribute_string('wrapper', $this); // WPCS: XSS ok. ?>>
                <div <?php echo technocy_elementor_get_render_attribute_string('row', $this); // WPCS: XSS ok. ?>>
                    <?php foreach ($settings['categories_list'] as $categorieslist): ?>
                        <div <?php echo technocy_elementor_get_render_attribute_string('item', $this); // WPCS: XSS ok. ?>>
                            <?php if (empty($categorieslist['categories'])) {
                                echo esc_html__('Choose Category', 'technocy');
                                return;
                            }
                            $category = get_term_by('slug', $categorieslist['categories'], 'product_cat');
                            if (!is_wp_error($category)) {
                                if (!empty($categorieslist['category_image']['id'])) {
                                    $image = Group_Control_Image_Size::get_attachment_image_src($categorieslist['category_image']['id'], 'image', $settings);
                                } else {
                                    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                                    if (!empty($thumbnail_id)) {
                                        $image = wp_get_attachment_url($thumbnail_id);
                                    } else {
                                        $image = wc_placeholder_img_src();
                                    }
                                } ?>
                                <?php if ($settings['product_cate_layout'] == '1' || $settings['product_cate_layout'] == '3' || $settings['product_cate_layout'] == '5'): ?>
                                    <div class="product-cat">
                                        <a class="link_category_product"
                                           href="<?php echo esc_url(get_term_link($category)); ?>"
                                           title="<?php echo esc_attr($category->name); ?>">
                                            <?php if ($categorieslist['categories_type'] == 'cate_image'): ?>
                                                <img src="<?php echo esc_url_raw($image); ?>"
                                                     alt="<?php echo esc_attr($category->name); ?>">
                                            <?php endif; ?>
                                            <?php if ($categorieslist['categories_type'] == 'cate_icon'): ?>
                                                <?php Icons_Manager::render_icon($categorieslist['category_icon'], ['aria-hidden' => 'true']); ?>
                                            <?php endif; ?>
                                        </a>
                                        <div class="product-cat-caption">
                                            <div class="cat-title">
                                                <a href="<?php echo esc_url(get_term_link($category)); ?>"
                                                   title="<?php echo esc_attr($category->name); ?>">
                                                    <span class="cat-title-text"><?php echo empty($categorieslist['categories_name']) ? esc_html($category->name) : sprintf('%s', $categorieslist['categories_name']); ?></span>
                                                </a>

                                                <?php if (!empty($categorieslist['categories_description'])) : ?>
                                                    <div class="categories-description"><?php echo sprintf('%s', $categorieslist['categories_description']); ?></div>
                                                <?php endif; ?>

                                                <span class="cat-total"><?php echo esc_html($category->count) . ' ' . esc_html__('products', 'technocy'); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($settings['product_cate_layout'] == '2'): ?>
                                    <div class="header">
                                        <a href="<?php echo esc_url(get_term_link($category)); ?>">
                                            <span class="cat-title-text"><?php echo empty($categorieslist['categories_name']) ? esc_html($category->name) : sprintf('%s', $categorieslist['categories_name']); ?></span>
                                            <span class="cat-total"><?php echo esc_html($category->count) . ' ' . esc_html__('products', 'technocy'); ?></span>
                                            <i class="technocy-icon-right-arrow-3"></i>
                                        </a>
                                    </div>
                                    <div class="image">
                                        <?php if ($categorieslist['categories_type'] == 'cate_image'): ?>
                                            <img src="<?php echo esc_url_raw($image); ?>"
                                                 alt="<?php echo esc_attr($category->name); ?>">
                                        <?php endif; ?>
                                        <?php if ($categorieslist['categories_type'] == 'cate_icon'): ?>
                                            <?php Icons_Manager::render_icon($categorieslist['category_icon'], ['aria-hidden' => 'true']); ?>
                                        <?php endif; ?>
                                        <a href="<?php echo esc_url(get_term_link($category)); ?>"></a>
                                    </div>
                                <?php endif; ?>
                                <?php if ($settings['product_cate_layout'] == '4'): ?>
                                    <a class="product-cat" href="<?php echo esc_url(get_term_link($category)); ?>"
                                       title="<?php echo esc_attr($category->name); ?>">
                                        <?php if ($categorieslist['categories_type'] == 'cate_image'): ?>
                                            <img src="<?php echo esc_url_raw($image); ?>"
                                                 alt="<?php echo esc_attr($category->name); ?>">
                                        <?php endif; ?>
                                        <?php if ($categorieslist['categories_type'] == 'cate_icon'): ?>
                                            <?php Icons_Manager::render_icon($categorieslist['category_icon'], ['aria-hidden' => 'true']); ?>
                                        <?php endif; ?>
                                        <div class="product-cat-caption">
                                            <div class="cat-title">
                                                <span class="cat-title-text"><?php echo empty($categorieslist['categories_name']) ? esc_html($category->name) : sprintf('%s', $categorieslist['categories_name']); ?></span>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>
                                <?php if ($settings['product_cate_layout'] == '6'): ?>
                                    <a class="product-cat" href="<?php echo esc_url(get_term_link($category)); ?>"
                                       title="<?php echo esc_attr($category->name); ?>">
                                        <span class="cat-title-text"><?php echo empty($categorieslist['categories_name']) ? esc_html($category->name) : sprintf('%s', $categorieslist['categories_name']); ?></span>
                                    </a>
                                <?php endif; ?>
                            <?php } ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
        }
    }

    protected function get_carousel_settings() {
        $settings    = $this->get_settings_for_display();
        $breakpoints = \Elementor\Plugin::$instance->breakpoints->get_breakpoints();

        return array(
            'navigation'              => $settings['navigation'],
            'centerMode'              => $settings['centerMode'] === 'yes' ? true : false,
            'variableWidth'           => $settings['variableWidth'] === 'yes' ? true : false,
            'autoplayHoverPause'      => $settings['pause_on_hover'] === 'yes' ? true : false,
            'autoplay'                => $settings['autoplay'] === 'yes' ? true : false,
            'autoplaySpeed'           => $settings['autoplay_speed'],
            'items'                   => $settings['column'],
            'items_laptop'            => isset($settings['column_laptop']) ? $settings['column_laptop'] : 4,
            'items_tablet_extra'      => isset($settings['column_tablet_extra']) ? $settings['column_tablet_extra'] : 3,
            'items_tablet'            => isset($settings['column_tablet']) ? $settings['column_tablet'] : 2,
            'items_mobile_extra'      => isset($settings['column_mobile_extra']) ? $settings['column_mobile_extra'] : 2,
            'items_mobile'            => isset($settings['column_mobile']) ? $settings['column_mobile'] : 1,
            'loop'                    => isset($settings['infinite']) === 'yes' ? true : false,
            'breakpoint_laptop'       => $breakpoints['laptop']->get_value(),
            'breakpoint_tablet_extra' => $breakpoints['tablet_extra']->get_value(),
            'breakpoint_tablet'       => $breakpoints['tablet']->get_value(),
            'breakpoint_mobile_extra' => $breakpoints['mobile_extra']->get_value(),
            'breakpoint_mobile'       => $breakpoints['mobile']->get_value(),
            'rtl'                     => is_rtl() ? true : false,
        );
    }
}

$widgets_manager->register(new Technocy_Elementor_Products_Categories());

