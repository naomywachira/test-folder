<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Sofass_Elementor_Woo_Category_Banner extends Widget_Base {

	public function get_name() {
        return 'sofass_woo_category_banner';
    }

	public function get_title() {
        return esc_html__( 'Goal Product Category Banner', 'sofass' );
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

        $this->add_responsive_control(
            'height',
            [
                'label' => esc_html__( 'Height', 'sofass' ),
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
                    '{{WRAPPER}} .widget-category-banner' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default' => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'This is the heading', 'sofass' ),
                'placeholder' => esc_html__( 'Enter your title', 'sofass' ),
            ]
        );

        $this->add_control(
            'slug', [
                'label' => esc_html__( 'Category Slug', 'sofass' ),
                'type' => Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'link_url',
            [
                'label' => esc_html__( 'Link', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'https://your-link.com', 'sofass' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__( 'Button Text', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your button text', 'sofass' ),
                'default' => 'SHOP NOW',
            ]
        );

        $this->add_control(
            'show_nb_products',
            [
                'label' => esc_html__( 'Show Number Products', 'sofass' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'sofass' ),
                'label_off' => esc_html__( 'Show', 'sofass' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Style 1', 'sofass'),
                    'style2' => esc_html__('Style 2', 'sofass'),
                    'style3' => esc_html__('Style 3', 'sofass'),
                ),
                'default' => 'style1'
            ]
        );

        $this->add_control(
            'show_subcategories',
            [
                'label' => esc_html__( 'Show SubCategories', 'sofass' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'sofass' ),
                'label_off' => esc_html__( 'Show', 'sofass' ),
                'condition' => [
                    'style' => ['style1', 'style3'],
                ],
            ]
        );

        $this->add_control(
            'number_subcategories',
            [
                'label' => esc_html__( 'Number SubCategories', 'sofass' ),
                'type' => Controls_Manager::NUMBER,
                'placeholder' => esc_html__( 'Enter number subcategories', 'sofass' ),
                'default' => 5,
                'condition' => [
                    'style' => ['style1', 'style3'],
                ],
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
                'label' => esc_html__( 'Style', 'sofass' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'sofass' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .widget-category-banner',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .item-inner-categories:hover .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'sofass' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'nb_color',
            [
                'label' => esc_html__( 'Number item Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .product-nb' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Number item Typography', 'sofass' ),
                'name' => 'nb_typography',
                'selector' => '{{WRAPPER}} .product-nb',
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        ?>
        <?php if($style == 'style3') { ?>
            <div class="widget-category-banner <?php echo esc_attr($el_class); ?> <?php echo esc_attr($style); ?>"></div>
            <div class="widget-category-v3">
                <?php
                $html = $link = '';
                $title_html = $title;
                $term = get_term_by('slug', $slug, 'product_cat');
                
                if ( ! empty( $link_url ) ) {
                    $link = $link_url;
                }

                $html .= '<div class="category-box-content">';

                if ( ! empty( $link ) ) {
                    $html .= '<a href="'.esc_url($link).'"><h3 class="title">'.$title_html.'</h3></a>';
                } else {
                    $html .= sprintf( '<h3 class="title">%1$s</h3>', $title_html );
                }

                if ( $term ) {
                    $link = get_term_link($term);
                    if ( empty($title_html) ) {
                        $title_html = $term->name;
                    }
                    if ( $show_subcategories ) {
                        $terms_children = get_terms( 'product_cat',
                            array(
                                'parent'        => $term->term_id,
                                'hierarchical'  => true,
                                'hide_empty'    => false,
                                'number'    => $number_subcategories,
                            )
                        );
                        if ( ! empty( $terms_children ) && ! is_wp_error( $terms_children ) ) {
                            $html .= '<ul class="subcategories">';
                                foreach ($terms_children as $term_children) {
                                    $html .= '<li><a href="'.get_term_link($term_children).'">'.$term_children->name.'</li>';
                                }
                            $html .= '</ul>';
                        }
                    }
                }

                if ( $show_nb_products && $term ) {
                    $html .= '<div class="product-nb">'.sprintf(_n('%d Product', '%d Products', $term->count, 'sofass'), $term->count).'</div>';
                }

                if( !empty( $link )){
                    $html .= '<a class="text-theme link-v3" href="'.esc_url($link).'">'. $btn_text .'</a>';
                }
                $html .= '</div>';

                echo trim($html);
                ?>

            </div>
        <?php }else{ ?>
            <div class="widget-category-banner <?php echo esc_attr($el_class); ?> <?php echo esc_attr($style); ?>">
                
                <div class="item-inner">
                    <?php
                    $html = $link = '';
                    $title_html = $title;
                    $term = get_term_by('slug', $slug, 'product_cat');
                    
                    if ( ! empty( $link_url ) ) {
                        $link = $link_url;
                    }

                    $html .= '<div class="category-box-content">';

                    if ( ! empty( $link ) ) {
                        $html .= '<a href="'.esc_url($link).'"><h3 data-hover="'.$title_html.'" class="title">'.$title_html.'</h3></a>';
                    } else {
                        $html .= sprintf( '<h3 class="title">%1$s</h3>', $title_html );
                    }

                    if ( $term ) {
                        $link = get_term_link($term);
                        if ( empty($title_html) ) {
                            $title_html = $term->name;
                        }
                        if (  ($style == 'style3' || $style == 'style1') && $show_subcategories ) {
                            $terms_children = get_terms( 'product_cat',
                                array(
                                    'parent'        => $term->term_id,
                                    'hierarchical'  => true,
                                    'hide_empty'    => false,
                                    'number'    => $number_subcategories,
                                )
                            );
                            if ( ! empty( $terms_children ) && ! is_wp_error( $terms_children ) ) {
                                $html .= '<ul class="subcategories">';
                                    foreach ($terms_children as $term_children) {
                                        $html .= '<li><a href="'.get_term_link($term_children).'">'.$term_children->name.'</a></li>';
                                    }
                                $html .= '</ul>';
                            }
                        }
                    }

                    

                    if ( $show_nb_products && $term ) {
                        $html .= '<div class="product-nb">'.sprintf(_n('%d Product', '%d Products', $term->count, 'sofass'), $term->count).'</div>';
                    }

                    
                    $html .= '</div>';

                    echo trim($html);
                    ?>

                </div>
                <?php
                if ( ! empty( $link ) ) {
                ?>
                    <div class="more-categories">
                        <a href="<?php echo esc_url($link); ?>" class="btn-banner st-theme"><?php echo esc_html__('VIEW ALL','sofass'); ?></a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <?php
    }
}
if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Sofass_Elementor_Woo_Category_Banner );
} else {
    Plugin::instance()->widgets_manager->register( new Sofass_Elementor_Woo_Category_Banner );
}