<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Sofass_Elementor_Woo_Products extends Widget_Base {

    public function get_name() {
        return 'sofass_woo_products';
    }

    public function get_title() {
        return esc_html__( 'Goal Products', 'sofass' );
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

        $this->add_control(
            'slugs',
            [
                'label' => esc_html__( 'Categories Slug', 'sofass' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter slug spearate by comma(,)', 'sofass' ),
            ]
        );
        
        $this->add_control(
            'limit',
            [
                'label' => esc_html__( 'Limit', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'number',
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
            'product_item',
            [
                'label' => esc_html__( 'Product Item', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'inner' => esc_html__('Item 1', 'sofass'),
                    'inner-v2' => esc_html__('Item 2', 'sofass'),
                    'inner-v3' => esc_html__('Item 3', 'sofass'),
                    'inner-v4' => esc_html__('List Item', 'sofass'),
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
            'carousel_type',
            [
                'label' => esc_html__( 'Carousel Type', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'sofass'),
                    'carousel_2' => esc_html__('Style 2', 'sofass'),
                    'carousel_vertical carousel_2' => esc_html__('Vertical 2', 'sofass'),
                    'carousel_white' => esc_html__('White', 'sofass'),
                    'carousel_circle' => esc_html__('Circle', 'sofass'),
                    'carousel_circle st_center' => esc_html__('Circle Center', 'sofass'),
                ),
                'default' => '',
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'title_type',
            [
                'label' => esc_html__( 'Position Title', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'left' => esc_html__('Left', 'sofass'),
                    'center' => esc_html__('Center', 'sofass'),
                ),
                'default' => 'center'
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


        // Style
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Box Style', 'sofass' ),
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

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__( 'Border', 'sofass' ),
                'selector' => '{{WRAPPER}} .product-block.grid .grid-inner, {{WRAPPER}} .products-grid.colection_gutter .row-products-wrapper:after, {{WRAPPER}} .products-grid.colection_gutter .products-wrapper-mansory:after'

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
                    '{{WRAPPER}} .product-block.grid .grid-inner:hover' => 'border-color: {{VALUE}};',
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

        
        $this->start_controls_section(
            'section_product_style',
            [
                'label' => esc_html__( 'Product Style', 'sofass' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} h3.name a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__( 'Title Hover Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block h3.name a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-block h3.name a:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'sofass' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} h3.name a',
            ]
        );

        $this->add_control(
            'cat_color',
            [
                'label' => esc_html__( 'Category Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block .product-cat a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Category Typography', 'sofass' ),
                'name' => 'cat_typography',
                'selector' => '{{WRAPPER}} .product-block .product-cat a',
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => esc_html__( 'Price Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block .price' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .product-block .price ins' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'price_old_color',
            [
                'label' => esc_html__( 'Price Old Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block .price del' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Price Typography', 'sofass' ),
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .product-block .price',
            ]
        );

        $this->add_control(
            'info_color',
            [
                'label' => esc_html__( 'Info Action Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block .yith-wcwl-add-to-wishlist a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-block .view .quickview' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-block .view .quickview' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-block .view .quickview:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-block .yith-compare .compare' => 'color: {{VALUE}};',
                ],
                
            ]
        );


        $this->add_control(
            'info_hv_color',
            [
                'label' => esc_html__( 'Info Action Hover Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block .yith-wcwl-add-to-wishlist:focus a' => 'color: {{VALUE}} ;',
                    '{{WRAPPER}} .product-block .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-block .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-block .yith-wcwl-add-to-wishlist a:hover' => 'color: {{VALUE}} ;',
                    '{{WRAPPER}} .product-block .yith-compare:focus .compare' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-block .yith-compare:hover .compare' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-block .yith-compare .compare.added' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-block .view .quickview:hover' => 'color: {{VALUE}};',
                ],
                
            ]
        );

        $this->add_control(
            'info_bg_color',
            [
                'label' => esc_html__( 'Info Action Background Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block.grid .yith-wcwl-add-to-wishlist:not(.add_to_wishlist) a' => 'background-color: {{VALUE}} ;', 
                    '{{WRAPPER}} .product-block.grid .yith-wcwl-add-to-wishlist a' => 'background-color: {{VALUE}} ;', 
                    '{{WRAPPER}} .product-block .view .quickview' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .product-block.grid .yith-compare .compare' => 'background-color: {{VALUE}};',
                ],
                
            ]
        );

        $this->add_control(
            'info_bg_hv_color',
            [
                'label' => esc_html__( 'Info Action Background Color Hover', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block .view .quickview:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .product-block .view .quickview:focus' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .product-block .view .quickview.loading::after' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .product-block.grid .yith-wcwl-add-to-wishlist a:hover' => 'background-color: {{VALUE}} ;',
                    '{{WRAPPER}} .product-block.grid .yith-compare .compare:hover' => 'background-color: {{VALUE}};',
                    
                ],
               
            ]
        );

        $this->add_control(
            'Addtocart_color',
            [
                'label' => esc_html__( 'Addtocart Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block.grid .add-cart a.button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product .product-block.grid.grid-v3 .added_to_cart, .product .product-block.grid.grid-v3 .button' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .product .product-block.grid.grid-v3 .added_to_cart:before, .product .product-block.grid.grid-v3 .button:before' => 'background-color: {{VALUE}} !important;',  
                ],
                
            ]
        );

        $this->add_control(
            'Addtocarted_color',
            [
                'label' => esc_html__( 'Addtocart Added Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product .product-block.grid.grid-v3 .added_to_cart:hover, .product .product-block.grid.grid-v3 .button:hover' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .product .product-block.grid.grid-v3 .added_to_cart:focus, .product .product-block.grid.grid-v3 .button:focus' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .product-block.grid .add-cart a.added_to_cart' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-block.grid .add-cart:hover a.button' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .product-block.grid .add-cart:focus a.button' => 'background-color: {{VALUE}};',
                ],
                
            ]
        );

        $this->add_control(
            'add_bg_color',
            [
                'label' => esc_html__( 'Addtocart Background Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block.grid .add-cart a.button' => 'background-color: {{VALUE}};',
                   
                ],
                
            ]
        );

        $this->add_control(
            'add_bg_hv_color',
            [
                'label' => esc_html__( 'Addtocart Background Hover Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-block.grid .add-cart a.button:hover, .product-block.grid .add-cart a.added_to_cart:hover' => 'background-color: {{VALUE}};',
                ],
                
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        ?>
        <div class="widget woocommerce widget-products <?php echo esc_attr($product_item.' '.$el_class); ?>">
            <div class="top-info <?php echo esc_attr(($title_type != 'center')?'flex-middle-sm':'text-center'); ?>">
                <?php if ( !empty($title) ): ?>
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
                <?php endif; ?>
            </div>
            <div class="widget-content <?php echo esc_attr($layout_type); ?>">
                
                <?php
                    $slugs = !empty($slugs) ? array_map('trim', explode(',', $slugs)) : array();
                    $type = isset($type) ? $type : 'recent_product';
                    $args = array(
                        'categories' => $slugs,
                        'product_type' => $type,
                        'post_per_page' => $limit,
                    );
                    $loop = sofass_get_products( $args );
                    
                    wc_get_template( 'layout-products/'.$layout_type.'.php' , array(
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
                        'slick_top' => '',
                        'carousel_type' => $carousel_type,
                        'elementor_element' => true,
                    ) );
                ?>

            </div>
            
        </div>
        <?php
    }
}
if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Sofass_Elementor_Woo_Products );
} else {
    Plugin::instance()->widgets_manager->register( new Sofass_Elementor_Woo_Products );
}