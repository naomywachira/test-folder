<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Sofass_Elementor_Woo_Product_Tabs extends Widget_Base {

    public function get_name() {
        return 'sofass_woo_product_tabs';
    }

    public function get_title() {
        return esc_html__( 'Goal Product Tabs', 'sofass' );
    }

    public function get_icon() {
        return 'ti-bag';
    }

    public function get_categories() {
        return [ 'sofass-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'sofass' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title', [
                'label' => esc_html__( 'Tab Title', 'sofass' ),
                'type' => Controls_Manager::TEXT
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'sofass' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-star',
            ]
        );

        $repeater->add_control(
            'type',
            [
                'label' => esc_html__( 'Get Products By', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'recent_product' => esc_html__('Recent Products', 'sofass' ),
                    'best_selling' => esc_html__('Best Selling', 'sofass' ),
                    'featured_product' => esc_html__('Featured Products', 'sofass' ),
                    'top_rate' => esc_html__('Top Rate', 'sofass' ),
                    'on_sale' => esc_html__('On Sale', 'sofass' ),
                    'recent_review' => esc_html__('Recent Review', 'sofass' ),
                    'recently_viewed' => esc_html__('Recent Viewed', 'sofass' ),
                ),
                'default' => 'recent_product'
            ]
        );

        $repeater->add_control(
            'slugs',
            [
                'label' => esc_html__( 'Category Slug', 'sofass' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter slug spearate by comma(,)', 'sofass' ),
            ]
        );


        // banner
        $repeater->add_control(
            'show_banner',
            [
                'label'         => esc_html__( 'Show Banner', 'sofass' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'sofass' ),
                'label_off'     => esc_html__( 'No', 'sofass' ),
                'return_value'  => true,
                'default'       => false,
                'separator' => 'before',
            ]
        );

        $columns = range( 1, 12 );
        $columns = array_combine( $columns, $columns );

        $repeater->add_responsive_control(
            'banner_columns',
            [
                'label' => esc_html__( 'Columns', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => $columns,
                'frontend_available' => true,
                'default' => 3,
            ]
        );

        $repeater->add_control(
            'img_src',
            [
                'name' => 'image',
                'label' => esc_html__( 'Banner Image', 'sofass' ),
                'type' => Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Background Image', 'sofass' ),
            ]
        );

        $repeater->add_control(
            'banner_sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your Sub title here', 'sofass' ),
                'default' => '',
            ]
        );

        $repeater->add_control(
            'banner_title',
            [
                'label' => esc_html__( 'Title', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your title here', 'sofass' ),
                'default' => '',
            ]
        );

        $repeater->add_control(
            'banner_btn_text',
            [
                'label' => esc_html__( 'Button Text', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your button text here', 'sofass' ),
                'default' => '',
            ]
        );

        $repeater->add_control(
            'banner_link',
            [
                'label' => esc_html__( 'URL', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'Enter your Button Link here', 'sofass' ),
                'default' => '',
            ]
        );
        
        $repeater->add_control(
            'style_banner',
            [
                'label' => esc_html__( 'Style', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Style 1', 'sofass'),
                    'style2' => esc_html__('Style 2', 'sofass'),
                ),
                'default' => 'style1'
            ]
        );

        ///

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Widget Title', 'sofass' ),
                'type' => Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'sub_title', [
                'label' => esc_html__( 'Widget Sub Title', 'sofass' ),
                'type' => Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'sub_text', [
                'label' => esc_html__( 'Sub Text', 'sofass' ),
                'type' => Controls_Manager::TEXTAREA
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => esc_html__( 'Tabs', 'sofass' ),
                'type' => Controls_Manager::REPEATER,
                'placeholder' => esc_html__( 'Enter your product tabs here', 'sofass' ),
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => esc_html__( 'Height Banner', 'sofass' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                ],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .content-banner' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'limit',
            [
                'label' => esc_html__( 'Limit', 'sofass' ),
                'type' => Controls_Manager::NUMBER,
                'placeholder' => esc_html__( 'Enter number products to display', 'sofass' ),
                'default' => 4
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label' => esc_html__( 'Layout', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'grid' => esc_html__('Grid', 'sofass'),
                    'carousel' => esc_html__('Carousel', 'sofass'),
                ),
                'default' => 'grid'
            ]
        );

        $this->add_control(
            'arrow_position',
            [
                'label' => esc_html__( 'Navigation Position', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Normal', 'sofass'),
                    'arrow-top' => esc_html__('Top', 'sofass'),
                ),
                'condition' => [
                    'layout_type' => 'carousel',
                ],
                'default' => ''
            ]
        );

        $this->add_control(
            'navigation_position_hr',
            [
                'label' => esc_html__( 'Navigation Position Horizontal', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Normal', 'sofass'),
                    'arrow-full' => esc_html__('Outside', 'sofass'),
                    'arrow-small' => esc_html__('Inside', 'sofass'),
                ),
                'default' => '',
                'condition' => [
                    'layout_type' => 'carousel',
                ]
            ]
        );

        $this->add_responsive_control(
            'top',
            [
                'label' => esc_html__( 'Top', 'sofass' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => -46,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .arrow-top .slick-arrow' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'arrow_position' => 'arrow-top',
                ],
            ]
        );

        $this->add_control(
            'product_item',
            [
                'label' => esc_html__( 'Product Item', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'inner' => esc_html__('Item 1', 'sofass'),
                    'inner-v2' => esc_html__('Item 2', 'sofass'),
                    'inner-v3' => esc_html__('Item 3', 'sofass'),
                ),
                'default' => 'inner',
            ]
        );

        $columns = range( 1, 12 );
        $columns = array_combine( $columns, $columns );

        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => $columns,
                'frontend_available' => true,
                'default' => 3,
            ]
        );

        $this->add_responsive_control(
            'slides_to_scroll',
            [
                'label' => esc_html__( 'Slides to Scroll', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'sofass' ),
                'options' => $columns,
                'condition' => [
                    'columns!' => '1',
                    'layout_type' => 'carousel',
                ],
                'frontend_available' => true,
                'default' => 1,
            ]
        );

        $this->add_control(
            'rows',
            [
                'label' => esc_html__( 'Rows', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'number',
                'placeholder' => esc_html__( 'Enter your rows number here', 'sofass' ),
                'default' => 1,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'show_nav',
            [
                'label'         => esc_html__( 'Show Navigation', 'sofass' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'sofass' ),
                'label_off'     => esc_html__( 'Hide', 'sofass' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label'         => esc_html__( 'Show Pagination', 'sofass' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'sofass' ),
                'label_off'     => esc_html__( 'Hide', 'sofass' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'         => esc_html__( 'Autoplay', 'sofass' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'sofass' ),
                'label_off'     => esc_html__( 'No', 'sofass' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'infinite_loop',
            [
                'label'         => esc_html__( 'Infinite Loop', 'sofass' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'sofass' ),
                'label_off'     => esc_html__( 'No', 'sofass' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'tab_type',
            [
                'label' => esc_html__( 'Position Tab', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'left' => esc_html__('Left', 'sofass'),
                    'right' => esc_html__('Right Box', 'sofass'),
                    'right st_normal' => esc_html__('Right Normal', 'sofass'),
                    'right st_normal no_border' => esc_html__('Right No Border', 'sofass'),
                    'center' => esc_html__('Center', 'sofass'),
                ),
                'default' => 'center'
            ]
        );

        $this->add_control(
            'tab_stye',
            [
                'label' => esc_html__( 'Style Tab', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'st_1' => esc_html__('Style 1', 'sofass'),
                    'st_2' => esc_html__('Style 2', 'sofass'),
                    'st_3' => esc_html__('Style 3', 'sofass'),
                ),
                'default' => 'st_1'
            ]
        );

        $this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'sofass' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'sofass' ),
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Widget Style', 'sofass' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'widget_title_color',
            [
                'label' => esc_html__( 'Widget Title Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .products-tabs-title' => 'color: {{VALUE}};',
                   
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Widget Title Typography', 'sofass' ),
                'name' => 'widget_title_typography',
                'selector' => '{{WRAPPER}} .products-tabs-title',
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label' => esc_html__( 'Sub Title Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .sub-widget-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sub-widget-title:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .sub-widget-title:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Sub Title Typography', 'sofass' ),
                'name' => 'sub_title_typography',
                'selector' => '{{WRAPPER}} .sub-widget-title',
            ]
        );

        $this->add_control(
            'sub_text_color',
            [
                'label' => esc_html__( 'Sub Text Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .sub-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Sub Text Typography', 'sofass' ),
                'name' => 'sub_text_typography',
                'selector' => '{{WRAPPER}} .sub-text',
            ]
        );

        

        $this->end_controls_section();

        

        $this->start_controls_section(
            'section_tab_style',
            [
                'label' => esc_html__( 'Tabs Style', 'sofass' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'tab_color',
            [
                'label' => esc_html__( 'Tab Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .nav-tabs > li > a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_hover_color',
            [
                'label' => esc_html__( 'Tab Hover/Active Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .nav-tabs > li.active > a, {{WRAPPER}} .nav-tabs > li.active > a:hover, {{WRAPPER}} .nav-tabs > li.active > a:focus, {{WRAPPER}} .nav-tabs > li > a:hover, {{WRAPPER}} .nav-tabs > li > a:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_active_color',
            [
                'label' => esc_html__( 'Border Active Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .nav.tabs-product > li > a::before, {{WRAPPER}} .widget-title:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Tab Typography', 'sofass' ),
                'name' => 'tab_typography',
                'selector' => '{{WRAPPER}} .nav-tabs > li > a',
            ]
        );

        $this->add_control(
            'dot_color',
            [
                'label' => esc_html__( 'Dot Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .slick-dots li button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dot_active_color',
            [
                'label' => esc_html__( 'Dot Active Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .slick-dots li.slick-active button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style
        $this->start_controls_section(
            'section_box_style',
            [
                'label' => esc_html__( 'Box Style', 'sofass' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__( 'Border', 'sofass' ),
                'selector' => '{{WRAPPER}} .product-block',
            ]
        );

        $this->add_control(
            'box_hover_border_color',
            [
                'label' => esc_html__( 'Border Hover Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-block:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow Hover', 'sofass' ),
                'selector' => '{{WRAPPER}} .product-block:hover',
            ]
        );

        $this->add_control(
            'bg-image',
            [
                'label' => esc_html__( 'Background Color Top Image', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'product_item' => 'inner-v7',
                ],
                'selectors' => [
                    '{{WRAPPER}} .block-inner' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style
        $this->start_controls_section(
            'section_banner_style',
            [
                'label' => esc_html__( 'Banner Style', 'sofass' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'padding-box',
            [
                'label' => esc_html__( 'Padding Inner', 'sofass' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'banner_title_color',
            [
                'label' => esc_html__( 'Color Title', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .title1 ' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'banner_title_hover_color',
            [
                'label' => esc_html__( 'Hover Color Title', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .wrapper-banner:hover .title1 ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Typography Title', 'sofass' ),
                'name' => 'title1_typography',
                'selector' => '{{WRAPPER}} .title1',
            ]
        );

        $this->add_control(
            'banner_sub_title_color',
            [
                'label' => esc_html__( 'Color Sub', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .sub-title ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'banner_sub_title_hover_color',
            [
                'label' => esc_html__( 'Hover Color Sub', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .wrapper-banner:hover .sub-title ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Typography Sub', 'sofass' ),
                'name' => 'banner_sub_title_typography',
                'selector' => '{{WRAPPER}} .sub-title',
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__( 'Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .btn-banner ' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__( 'Hover Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .wrapper-banner:hover .btn-banner ' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_line_color',
            [
                'label' => esc_html__( 'Line Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .wrapper-banner .btn-banner::before ' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_line_hover_color',
            [
                'label' => esc_html__( 'Line Hover Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .wrapper-banner:hover .btn-banner::before ' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'section_product_style',
            [
                'label' => esc_html__( 'Product Style', 'sofass' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'margin-bottom-item',
            [
                'label' => esc_html__( 'Space Bottom Item', 'sofass' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 30,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .product-block' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius Button', 'sofass' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .product-block.grid .button,
                    {{WRAPPER}} .product-block.grid .button.loading:before,
                     {{WRAPPER}} .product-block.grid .added_to_cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        if ( !empty($tabs) ) {
            $_id = sofass_random_key();
            ?>
            <div class="widget woocommerce widget-products-tabs <?php echo esc_attr($product_item.' '.$el_class); ?>">
                
                <div class="widget-content <?php echo esc_attr($layout_type); ?>">
                    <div class="top-info-tabs <?php echo esc_attr($tab_type); ?>">
                            <div class="widget-title">
                            <?php if ( !empty($sub_title) ): ?>
                                <span class="sub-widget-title">
                                    <?php echo esc_attr( $sub_title ); ?>
                                </span>
                            <?php endif; ?>

                            <?php if ( !empty($title) ): ?>
                                <h3 class="products-tabs-title">
                                    <?php echo esc_attr( $title ); ?>
                                </h3>
                            <?php endif; ?>
                           
                            <?php if ( !empty($sub_text) ): ?>
                                <p class="sub-text">
                                    <?php echo esc_attr( $sub_text ); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <ul role="tablist" class="nav nav-tabs tabs-product <?php echo esc_attr($tab_stye); ?>" data-load="ajax">
                            <?php $i = 0; foreach ($tabs as $tab) : ?>
                                <li class="<?php echo esc_attr($i == 0 ? 'active' : '');?>">
                                    <a href="#tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($i); ?>">
                                        <?php if ( !empty($tab['icon']) ) { ?>
                                            <i class="<?php echo esc_attr($tab['icon']); ?>"></i>
                                        <?php } ?>
                                        <?php if ( !empty($tab['title']) ) { ?>
                                            <span>
                                                <?php echo trim($tab['title']); ?>
                                            </span>
                                        <?php } ?>
                                    </a>
                                </li>
                            <?php $i++; endforeach; ?>
                        </ul>

                    </div>
                    <div class="widget-inner">
                        <div class="tab-content">
                            <?php $i = 0; foreach ($tabs as $tab) : 
                                $encoded_atts = json_encode( $settings );
                                $encoded_tab = json_encode( $tab );
                            ?>
                                <div id="tab-<?php echo esc_attr($_id);?>-<?php echo esc_attr($i); ?>" class="tab-pane <?php echo esc_attr($i == 0 ? 'active' : ''); ?>" data-loaded="<?php echo esc_attr($i == 0 ? 'true' : 'false'); ?>" data-settings="<?php echo esc_attr($encoded_atts); ?>" data-tab="<?php echo esc_attr($encoded_tab); ?>">

                                    <div class="tab-content-products-wrapper">
                                        <div class="row">
                                            <?php
                                            $banner_columns = $banner_columns_tablet = $banner_columns_mobile = 0;
                                            if ( !empty($tab['show_banner']) && $tab['show_banner'] ) {
                                                $banner_columns = !empty($tab['banner_columns']) ? $tab['banner_columns'] : 3;
                                                $banner_columns_tablet = !empty($tab['banner_columns_tablet']) ? $tab['banner_columns_tablet'] : 3;
                                                $banner_columns_mobile = !empty($tab['banner_columns_mobile']) ? $tab['banner_columns_mobile'] : 12;

                                                $classes = 'col-lg-'.$banner_columns.' col-sm-'.$banner_columns_tablet.' col-xs-'.$banner_columns_mobile;
                                            ?>
                                                <div class="banner-wrapper <?php echo esc_attr($classes); ?>">
                                                    <?php if ( !empty($tab['banner_link']) ) { ?>
                                                        <a href="<?php echo esc_url($tab['banner_link']); ?>">
                                                    <?php } ?>
                                                        <div class="wrapper-banner <?php echo esc_attr($tab['style_banner']); ?>">
                                                            <?php if ( !empty($tab['img_src']['id']) ) { ?>
                                                                <div class="content-banner">
                                                                    <?php echo sofass_get_attachment_thumbnail($tab['img_src']['id'], 'full'); ?>
                                                                </div>
                                                            <?php } ?>
                                                            <div class="inner">
                                                                <?php if ( !empty($tab['banner_sub_title']) ) { ?>
                                                                    <div class="sub-title"><?php echo trim($tab['banner_sub_title']); ?></div>
                                                                <?php } ?>

                                                                <?php if ( !empty($tab['banner_title']) ) { ?>
                                                                    <h2 class="title1"><?php echo trim($tab['banner_title']); ?></h2>
                                                                <?php } ?>

                                                                <?php if ( !empty($tab['banner_btn_text']) ) { ?>
                                                                    <div class="link-bottom">
                                                                        <span class="btn-banner"><?php echo trim($tab['banner_btn_text']); ?></span>
                                                                    </div>
                                                                <?php } ?>
                                                                
                                                            </div>
                                                        </div>
                                                    <?php if ( !empty($tab['banner_link']) ) { ?>
                                                        </a>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>

                                            <?php
                                            if( $banner_columns == 12 ){
                                                $banner_columns = 0;
                                            }
                                            if( $banner_columns_tablet == 12 ){
                                                $banner_columns_tablet = 0;
                                            }
                                            if( $banner_columns_mobile == 12 ){
                                                $banner_columns_mobile = 0;
                                            }

                                            $classes = 'col-lg-'.(12 - $banner_columns).' col-sm-'.(12 - $banner_columns_tablet).' col-xs-'.(12 - $banner_columns_mobile);
                                            ?>
                                            <div class="<?php echo esc_attr($classes); ?>">
                                                <div class="tab-content-products">
                                                    <?php if ( $i == 0 ): ?>
                                                        <?php
                                                            $slugs = !empty($tab['slugs']) ? array_map('trim', explode(',', $tab['slugs'])) : array();
                                                            $type = isset($tab['type']) ? $tab['type'] : 'recent_product';
                                                            $args = array(
                                                                'categories' => $slugs,
                                                                'product_type' => $type,
                                                                'post_per_page' => $limit,
                                                            );
                                                            $loop = sofass_get_products( $args );
                                                        ?>

                                                        <?php wc_get_template( 'layout-products/'.$layout_type.'.php' , array(
                                                            'loop' => $loop,
                                                            'columns' => $columns,
                                                            'columns_tablet' => $columns_tablet,
                                                            'columns_mobile' => $columns_mobile,
                                                            'slides_to_scroll' => $slides_to_scroll,
                                                            'slides_to_scroll_tablet' => $slides_to_scroll_tablet,
                                                            'slides_to_scroll_mobile' => $slides_to_scroll_mobile,
                                                            'show_nav' => $show_nav,
                                                            'show_pagination' => $show_pagination,
                                                            'autoplay' => $autoplay,
                                                            'infinite_loop' => $infinite_loop,
                                                            'rows' => $rows,
                                                            'product_item' => $product_item,
                                                            'arrow_position' => $arrow_position,
                                                            'navigation_position_hr' => $navigation_position_hr,
                                                            'elementor_element' => true,
                                                        ) ); ?>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php $i++; endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }

}
if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Sofass_Elementor_Woo_Product_Tabs );
} else {
    Plugin::instance()->widgets_manager->register( new Sofass_Elementor_Woo_Product_Tabs );
}