<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Sofass_Elementor_Search_Form extends Elementor\Widget_Base {

    public function get_name() {
        return 'sofass_element_search_form';
    }

    public function get_title() {
        return esc_html__( 'Goal Header Search Form', 'sofass' );
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
            'show_categories',
            [
                'label' => esc_html__( 'Show Categories', 'sofass' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Show', 'sofass' ),
                'label_off' => esc_html__( 'Hide', 'sofass' ),
            ]
        );

        $this->add_control(
            'show_auto_search',
            [
                'label' => esc_html__( 'Show Autocomplete Search', 'sofass' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Show', 'sofass' ),
                'label_off' => esc_html__( 'Hide', 'sofass' ),
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label' => esc_html__( 'Show Icon', 'sofass' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Show', 'sofass' ),
                'label_off' => esc_html__( 'Hide', 'sofass' ),
            ]
        );

        $this->add_control(
            'show_text',
            [
                'label' => esc_html__( 'Show text Search', 'sofass' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_on' => esc_html__( 'Show', 'sofass' ),
                'label_off' => esc_html__( 'Hide', 'sofass' ),
            ]
        );

        $this->add_responsive_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'sofass' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => [
                    'style1' => esc_html__( 'Style 1', 'sofass' ),
                    'style2' => esc_html__( 'Style 2', 'sofass' ),
                    'style3' => esc_html__( 'Style 3', 'sofass' ),
                ],
                'default' => 'style1'
            ]
        );

        $this->add_control(
            'quick_links_title',
            [
                'label' => esc_html__( 'Quick Links Title', 'sofass' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your title here', 'sofass' ),
                'condition' => [
                    'style' => 'style2',
                ],
            ]
        );

        $custom_menus = array();
        $menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
        if ( is_array( $menus ) && ! empty( $menus ) ) {
            foreach ( $menus as $menu ) {
                if ( is_object( $menu ) && isset( $menu->name, $menu->slug ) ) {
                    $custom_menus[ $menu->slug ] = $menu->name;
                }
            }
        }

        $this->add_control(
            'nav_menu',
            [
                'label' => esc_html__( 'Quick Links Menu', 'sofass' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $custom_menus,
                'default' => '',
                'condition' => [
                    'style' => 'style2',
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
            'section_box_style',
            [
                'label' => esc_html__( 'Box', 'sofass' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'sofass' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => esc_html__( 'Icon', 'sofass' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Color', 'sofass' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .show-search-header' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_color_hover',
            [
                'label' => esc_html__( 'Color Hover', 'sofass' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .show-search-header:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .show-search-header:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__( 'Button', 'sofass' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__( 'Color', 'sofass' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .btn-search' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hv_color',
            [
                'label' => esc_html__( 'Color Hover', 'sofass' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .btn-search:hover, {{WRAPPER}} .btn-search:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();

        extract( $settings );
        ?>
        
        <div class="goal-search-form <?php echo esc_attr($el_class.' '.$style); ?>">
            <?php if ( $style == 'style2' ) { ?>
                <span class="show-search-header"><i class="ti-search"></i></span>
            <?php } ?>
            <div class="goal-search-form-inner <?php echo esc_attr($style); ?>">
                <?php if ( $style == 'style2' ) { ?>
                    <div class="container">
                        <h3 class="title"><?php esc_html_e('WHAT ARE YOU LOOKING FOR?', 'sofass'); ?></h3>
                <?php } ?>
                <form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
                    <?php 
                        if ( $show_categories && sofass_is_woocommerce_activated() ) {
                            $args = array(
                                'show_count' => 0,
                                'hierarchical' => true,
                                'show_uncategorized' => 0
                            );
                            echo '<div class="select-category">';
                                wc_product_dropdown_categories( $args );
                            echo '</div>';
                        }
                    ?>
                    <div class="main-search">
                        <?php if ( $show_auto_search ) echo '<div class="twitter-typeahead">'; ?>
                            <input type="text" placeholder="<?php esc_attr_e( 'Search products...', 'sofass' ); ?>" name="s" class="goal-search form-control <?php echo esc_attr($show_auto_search ? 'goal-autocompleate-input' : ''); ?>" autocomplete="off"/>
                        <?php if ( $show_auto_search ) echo '</div>'; ?>
                    </div>
                    <input type="hidden" name="post_type" value="product" class="post_type" />
                   
                    <button type="submit" class="btn btn-theme radius-5x btn-search <?php echo esc_attr(($show_icon && !$show_text)?'st_small':''); ?>"><?php if($show_icon){ ?><i class="ti-search"></i><?php } ?><?php if($show_text){ ?><span class="text"><?php esc_html_e('Search', 'sofass'); ?></span><?php } ?></button>
                    

                </form>
                <?php if ( $style == 'style2' ) {

                        $menu_id = 0;
                        if ($nav_menu) {
                            $term = get_term_by( 'slug', $nav_menu, 'nav_menu' );
                            if ( !empty($term) ) {
                                $menu_id = $term->term_id;
                            }
                        }
                        ?>
                        <?php if ( !empty($menu_id) ) { ?>
                            <div class="quick-links-wrapper">
                                <?php if ( $quick_links_title ) {
                                    ?>
                                    <h4 class="title-quick-links"><?php echo esc_html($quick_links_title); ?></h4>
                                    <?php
                                }
                                    $nav_menu_args = array(
                                        'fallback_cb' => '',
                                        'menu'        => $menu_id
                                    );

                                    wp_nav_menu( $nav_menu_args, $menu_id );
                                ?>
                            </div>
                        <?php } ?>

                    </div>
                <?php } ?>
            </div>
            <?php if ( $style == 'style2' ) { ?>
                <div class="overlay-search-header"></div>
            <?php } ?>
        </div>
        <?php
    }
}
if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Sofass_Elementor_Search_Form );
} else {
    Elementor\Plugin::instance()->widgets_manager->register( new Sofass_Elementor_Search_Form );
}