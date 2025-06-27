<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Sofass_Elementor_Banner extends Widget_Base {

    public function get_name() {
        return 'sofass_banner';
    }

    public function get_title() {
        return esc_html__( 'Goal Banner', 'sofass' );
    }
    
    public function get_categories() {
        return [ 'sofass-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Banner', 'sofass' ),
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
                    '{{WRAPPER}} .content-banner' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your Sub title here', 'sofass' ),
            ]
        );

        $this->add_control(
            'title1',
            [
                'label' => esc_html__( 'Title 1', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your title here', 'sofass' ),
            ]
        );

        $this->add_control(
            'title2',
            [
                'label' => esc_html__( 'Title 2', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your title here', 'sofass' ),
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__( 'Button Text', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your button text here', 'sofass' ),
            ]
        );

        $this->add_control(
            'btn_style',
            [
                'label' => esc_html__( 'Button Style', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'btn-theme' => esc_html__('Theme Color', 'sofass'),
                    'btn-theme btn-outline' => esc_html__('Theme Outline Color', 'sofass'),
                    'btn-banner' => esc_html__('Banner', 'sofass'),
                    'btn-default' => esc_html__('Default ', 'sofass'),
                    'btn-primary' => esc_html__('Primary ', 'sofass'),
                    'btn-success' => esc_html__('Success ', 'sofass'),
                    'btn-info' => esc_html__('Info ', 'sofass'),
                    'btn-warning' => esc_html__('Warning ', 'sofass'),
                    'btn-danger' => esc_html__('Danger ', 'sofass'),
                    'btn-pink' => esc_html__('Pink ', 'sofass'),
                    'btn-white' => esc_html__('White ', 'sofass'),
                ),
                'default' => 'btn-default'
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'URL', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'Enter your Button Link here', 'sofass' ),
            ]
        );

        $this->add_responsive_control(
            'banner_align',
            [
                'label' => esc_html__( 'Alignment', 'sofass' ),
                'type' => Controls_Manager::CHOOSE,
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
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'sofass' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wrapper-banner' => 'text-align: {{VALUE}};',
                ],
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
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'sofass' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'sofass' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_box',
            [
                'label' => esc_html__( 'Box', 'sofass' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'sofass' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .content-banner',
            ]
        );

        $this->add_responsive_control(
            'padding-box',
            [
                'label' => esc_html__( 'Padding', 'sofass' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'sofass' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wrapper-banner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section1_title',
            [
                'label' => esc_html__( 'Title', 'sofass' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'title1_color',
                [
                    'label' => esc_html__( 'Color', 'sofass' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        // Stronger selector to avoid section style from overwriting
                        '{{WRAPPER}} .title1 ' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'title1_hover_color',
                [
                    'label' => esc_html__( 'Hover Color', 'sofass' ),
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
                    'label' => esc_html__( 'Typography', 'sofass' ),
                    'name' => 'title1_typography',
                    'selector' => '{{WRAPPER}} .title1',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title2',
            [
                'label' => esc_html__( 'Title 2', 'sofass' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'title2_color',
                [
                    'label' => esc_html__( 'Color', 'sofass' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        // Stronger selector to avoid section style from overwriting
                        '{{WRAPPER}} .title2 ' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'title2_hover_color',
                [
                    'label' => esc_html__( 'Hover Color', 'sofass' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        // Stronger selector to avoid section style from overwriting
                        '{{WRAPPER}} .wrapper-banner:hover .title2 ' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => esc_html__( 'Typography', 'sofass' ),
                    'name' => 'title2_typography',
                    'selector' => '{{WRAPPER}} .title2',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'sofass' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'sub_title_color',
                [
                    'label' => esc_html__( 'Color', 'sofass' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        // Stronger selector to avoid section style from overwriting
                        '{{WRAPPER}} .sub-title ' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'sub_title_hover_color',
                [
                    'label' => esc_html__( 'Hover Color', 'sofass' ),
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
                    'label' => esc_html__( 'Typography', 'sofass' ),
                    'name' => 'sub_title_typography',
                    'selector' => '{{WRAPPER}} .sub-title',
                ]
            );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_button',
            [
                'label' => esc_html__( 'Button', 'sofass' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'margin-link-bottom',
                [
                    'label' => esc_html__( 'Margin', 'sofass' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .link-bottom' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
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

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'label' => esc_html__( 'Typography', 'sofass' ),
                    'name' => 'button_typography',
                    'selector' => '{{WRAPPER}} .btn-banner',
                ]
            );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        ?>
        <div class="widget-banner <?php echo esc_attr($el_class); ?>">
            <?php if ( !empty($link) ) { ?>
                <a href="<?php echo esc_url($link); ?>">
            <?php } ?>
                <div class="wrapper-banner <?php echo esc_attr($style); ?>">
                    <div class="content-banner">
                    </div>
                    <div class="inner">
                        <?php if ( $sub_title ) { ?>
                            <div class="sub-title"><?php echo trim($sub_title); ?></div>
                        <?php } ?>

                        <?php if ( $title1 ) { ?>
                            <h2 class="title1"><?php echo trim($title1); ?></h2>
                        <?php } ?>

                        <?php if ( $title2 ) { ?>
                            <h2 class="title2"><?php echo trim($title2); ?></h2>
                        <?php } ?>

                        <?php if ( !empty($btn_text) ) { ?>
                            <div class="link-bottom">
                                <span class="btn radius-5x <?php echo esc_attr(!empty($btn_style) ? $btn_style : ''); ?>"><?php echo trim($btn_text); ?></span>
                            </div>
                        <?php } ?>
                        
                    </div>
                </div>

            <?php if ( !empty($link) ) { ?>
                </a>
            <?php } ?>
        </div>
        <?php
    }
}
if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Sofass_Elementor_Banner );
} else {
    Plugin::instance()->widgets_manager->register( new Sofass_Elementor_Banner );
}