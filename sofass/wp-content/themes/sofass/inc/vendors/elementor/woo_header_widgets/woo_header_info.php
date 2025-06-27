<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Sofass_Elementor_Woo_Header_Info extends Elementor\Widget_Base {

    public function get_name() {
        return 'sofass_woo_header';
    }

    public function get_title() {
        return esc_html__( 'Goal Header Woo Button', 'sofass' );
    }
    
    public function get_categories() {
        return [ 'sofass-header-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'sofass' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'hide_wishlist',
            [
                'label' => esc_html__( 'Hide Wishlist', 'sofass' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'sofass' ),
                'label_off' => esc_html__( 'Show', 'sofass' ),
            ]
        );

        $this->add_control(
            'hide_cart',
            [
                'label' => esc_html__( 'Hide Cart', 'sofass' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'sofass' ),
                'label_off' => esc_html__( 'Show', 'sofass' ),
            ]
        );

        $this->add_control(
            'hide_total',
            [
                'label' => esc_html__( 'Hide Total', 'sofass' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'sofass' ),
                'label_off' => esc_html__( 'Show', 'sofass' ),
            ]
        );

        

        $this->add_control(
            'mini_cart',
            [
                'label' => esc_html__( 'Mini Cart Layout', 'sofass' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => [
                    'offcanvas' => esc_html__( 'Offcanvas', 'sofass' ),
                    'dropdown_box' => esc_html__( 'Dropdown Box', 'sofass' ),
                ],
                'default' => 'dropdown_box'
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'sofass' ),
                'type' => Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'sofass' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'sofass' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'sofass' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'sofass' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'sofass' ),
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Title', 'sofass' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__( 'Background Color Count', 'sofass' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .wishlist-icon .count,{{WRAPPER}} .mini-cart .count' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $add_class = '';
        if ( !empty($align) ) {
            $add_class = 'menu-'.$align;
        }
        ?>
        <div class="header-button-woo clearfix <?php echo esc_attr($add_class.' '.$el_class); ?>">
            <?php
            global $woocommerce;
            if ( $hide_cart && is_object($woocommerce) && is_object($woocommerce->cart) ) {
            ?>
                <div class="pull-right">
                    <div class="goal-topcart">
                        <div class="cart">
                            <?php if ( $mini_cart == 'dropdown_box' ) { ?>
                                <a class="dropdown-toggle mini-cart" data-toggle="dropdown" aria-expanded="true" href="#" title="<?php esc_attr_e('View your shopping cart', 'sofass'); ?>">
                                    <i class="ti-bag"></i>
                                    <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                    <span class="total-minicart"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="widget_shopping_cart_content">
                                        <?php woocommerce_mini_cart(); ?>
                                    </div> 
                                </div>
                            <?php } else { ?>
                                <a class="offcanvas mini-cart" href="#" title="<?php esc_attr_e('View your shopping cart', 'sofass'); ?>">
                                    <i class="ti-bag"></i>
                                    <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                    <?php
                                    if ( $hide_total && class_exists( 'YITH_WCWL' ) ) { ?>
                                    <span class="total-minicart"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                                    <?php } ?>
                                </a>
                                <div class="offcanvas-content">
                                    <h3 class="title-cart-canvas"><i class="ti-close close-cart"></i> <?php echo esc_html__(' Your Cart', 'sofass'); ?></h3>
                                    <div class="widget_shopping_cart_content">
                                        <?php woocommerce_mini_cart(); ?>
                                    </div>
                                </div>
                                <div class="overlay-offcanvas-content"></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php
            }

            if ( $hide_wishlist && class_exists( 'YITH_WCWL' ) ) {
                $wishlist_url = YITH_WCWL()->get_wishlist_url();
            ?>
                <div class="pull-right">
                    <a class="wishlist-icon" href="<?php echo esc_url($wishlist_url);?>">
                        <i class="ti-heart"></i>
                        <?php if ( function_exists('yith_wcwl_count_products') ) { ?>
                            <span class="count"><?php echo yith_wcwl_count_products(); ?></span>
                        <?php } ?>
                    </a>
                </div>
            <?php } elseif( $hide_wishlist && sofass_is_woosw_activated() ) {
                $woosw_page_id = WPCleverWoosw::get_page_id();
            ?>
                <div class="pull-right">
                    <a class="wishlist-icon" href="<?php echo esc_url(get_permalink($woosw_page_id));?>">
                        <i class="ti-heart"></i>
                        <span class="count woosw-custom-menu-item">0</span>
                    </a>
                </div>
            <?php } ?>
        </div>
        <?php
    }

}
if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Sofass_Elementor_Woo_Header_Info );
} else {
    Elementor\Plugin::instance()->widgets_manager->register( new Sofass_Elementor_Woo_Header_Info );
}