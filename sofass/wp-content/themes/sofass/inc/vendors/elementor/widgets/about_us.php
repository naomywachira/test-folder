<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Sofass_Elementor_About_Us extends Widget_Base {

	public function get_name() {
        return 'sofass_about_us';
    }

	public function get_title() {
        return esc_html__( 'Goal About Us', 'sofass' );
    }
    
	public function get_categories() {
        return [ 'sofass-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'About Us', 'sofass' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'img_bg_src',
            [
                'name' => 'image',
                'label' => esc_html__( 'Image Background', 'sofass' ),
                'type' => Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Image Background Here', 'sofass' ),
            ]
        );
        $this->add_control(
            'img_src',
            [
                'name' => 'image',
                'label' => esc_html__( 'Image', 'sofass' ),
                'type' => Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Image Here', 'sofass' ),
            ]
        );

        $this->add_responsive_control(
            'img_align',
            [
                'label' => esc_html__( 'Image Alignment', 'sofass' ),
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
                    '{{WRAPPER}} .banner-image' => 'text-align: {{VALUE}};',
                ],
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
            'content',
            [
                'label' => esc_html__( 'Content', 'sofass' ),
                'type' => Controls_Manager::WYSIWYG,
                'placeholder' => esc_html__( 'Enter your content here', 'sofass' ),
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
                    'btn-gradient' => esc_html__('Theme Gradient Color', 'sofass'),
                    'btn-theme btn-outline' => esc_html__('Theme Outline Color', 'sofass'),
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

        $this->add_responsive_control(
            'content_align',
            [
                'label' => esc_html__( 'Content Alignment', 'sofass' ),
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
                    '{{WRAPPER}} .banner-content' => 'text-align: {{VALUE}};',
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
                    'style4' => esc_html__('Style 4', 'sofass'),
                ),
                'default' => 'style1'
            ]
        );
        $this->add_control(
            'vertical',
            [
                'label' => esc_html__( 'Vertical Content', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'flex-top' => esc_html__('Top', 'sofass'),
                    'flex-middle' => esc_html__('Middle', 'sofass'),
                    'flex-bottom' => esc_html__('Bottom', 'sofass'),
                ),
                'default' => 'flex-middle'
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

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Widget Title Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label' => esc_html__( 'Widget Sub Title Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .sub-widget-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Content Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .content p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        $img_bg_src = ( isset( $img_bg_src['id'] ) && $img_bg_src['id'] != 0 ) ? wp_get_attachment_url( $img_bg_src['id'] ) : '';
        $style_bg = '';
        if ( !empty($img_bg_src) ) {
            $style_bg = 'style="background-image:url('.esc_url($img_bg_src).')"';
        }
        ?>
        <div class="widget widget-about updow <?php echo esc_attr($el_class.' '.$style); ?>" <?php echo trim($style_bg); ?>>
            <?php if ( !empty($link) ) { ?>
                <a href="<?php echo esc_url($link); ?>">
            <?php } ?>
                <div class="inner <?php echo esc_attr($vertical); ?>">
                    <?php
                    if ( !empty($img_src['id']) ) {
                    ?>
                        <div class="p-static col-sm-<?php echo esc_attr(!empty($content) ? '6':'12' ); ?> col-xs-<?php echo esc_attr(!empty($content) ? '12':'12' ); ?>">
                            <div class="about-image">
                                <?php echo sofass_get_attachment_thumbnail($img_src['id'], 'full'); ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="col-sm-1 col-xs-12"></div>

                    <?php if ( (!empty($content) && !empty($btn_text)) || !empty($content) ) { ?>
                        <div class="p-static col-xs-<?php echo esc_attr( (!empty($img_src['id']))? '12':'12' ); ?> col-sm-<?php echo esc_attr( (!empty($img_src['id']))? '5':'12' ); ?>">
                            <div class="about-content">
                                <div class="widget-title">
                                    <?php if ( !empty($sub_title) ): ?>
                                        <span class="sub-widget-title <?php echo esc_attr($tab_type); ?>">
                                            <?php echo esc_attr( $sub_title ); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if ( !empty($title) ): ?>
                                    <h3 class="title <?php echo esc_attr($tab_type); ?>">
                                            <?php echo esc_attr( $title ); ?>
                                        </h3>
                                    <?php endif; ?>
                                    <div class="content">
                                        <?php if ( !empty($content) ) { ?>
                                            <?php echo wp_kses_post($content); ?>
                                        <?php } ?>
                                    </div>
                                    <?php if ( !empty($btn_text) ) { ?>
                                        <div class="link-bottom">
                                            <span class="btn radius-0 btn-theme <?php echo esc_attr(!empty($btn_style) ? $btn_style : ''); ?>"><?php echo wp_kses_post($btn_text); ?></span>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if ( !empty($btn_text) && empty($content) ) { ?> 
                        <span class="btn radius-5x btn-theme <?php echo esc_attr(!empty($btn_style) ? $btn_style : ''); ?>"><?php echo wp_kses_post($btn_text); ?></span>
                    <?php } ?>
                </div>
            <?php if ( !empty($link) ) { ?> 
                </a>
            <?php } ?>
        </div>
        <?php

    }

}
if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Sofass_Elementor_About_Us );
} else {
    Plugin::instance()->widgets_manager->register( new Sofass_Elementor_About_Us );
}