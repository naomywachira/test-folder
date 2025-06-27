<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Sofass_Elementor_Testimonials extends Widget_Base {

    public function get_name() {
        return 'sofass_testimonials';
    }

    public function get_title() {
        return esc_html__( 'Goal Testimonials', 'sofass' );
    }

    public function get_icon() {
        return 'eicon-testimonial';
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

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__( 'Rating', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    1 => esc_html__('1 Star', 'sofass'),
                    2 => esc_html__('2 Star', 'sofass'),
                    3 => esc_html__('3 Star', 'sofass'),
                    4 => esc_html__('4 Star', 'sofass'),
                    5 => esc_html__('5 Star', 'sofass'),
                ),
                'default' => 5,
            ]
        );

        $repeater->add_control(
            'description', [
                'label' => esc_html__( 'Description', 'sofass' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Description' , 'sofass' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'info',
            [
                'label' => esc_html__( 'Name', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'job',
            [
                'label' => esc_html__( 'Job', 'sofass' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $repeater->add_control(
            'img_src',
            [
                'name' => 'image',
                'label' => esc_html__( 'Choose Image', 'sofass' ),
                'type' => Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Brand Image', 'sofass' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Widget Title', 'sofass' ),
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
            'testimonials',
            [
                'label' => esc_html__( 'Testimonials', 'sofass' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
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
                'default' => 1,
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
                ],
                'frontend_available' => true,
                'default' => 1,
            ]
        );

        $this->add_control(
            'show_nav',
            [
                'label' => esc_html__( 'Show Nav', 'sofass' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'sofass' ),
                'label_off' => esc_html__( 'Show', 'sofass' ),
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => esc_html__( 'Show Pagination', 'sofass' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'sofass' ),
                'label_off' => esc_html__( 'Show', 'sofass' ),
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
            'section_title_style',
            [
                'label' => esc_html__( 'Style', 'sofass' ),
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
                    '{{WRAPPER}} .testimonials-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Widget Title Typography', 'sofass' ),
                'name' => 'widget_title_typography',
                'selector' => '{{WRAPPER}} .testimonials-title',
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
                'selector' => '{{WRAPPER}} .sub-widget-title',
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'sofass' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'test_description_color',
            [
                'label' => esc_html__( 'Description Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Description Typography', 'sofass' ),
                'name' => 'test_description_typography',
                'selector' => '{{WRAPPER}} .description',
            ]
        );

        $this->add_control(
            'test_info_color',
            [
                'label' => esc_html__( 'Info Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .name-client' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Info Typography', 'sofass' ),
                'name' => 'test_info_typography',
                'selector' => '{{WRAPPER}} .name-client',
            ]
        );

        $this->add_control(
            'job',
            [
                'label' => esc_html__( 'Job Color', 'sofass' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Job Typography', 'sofass' ),
                'name' => 'test_job_typography',
                'selector' => '{{WRAPPER}} .job',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if ( !empty($testimonials) ) {

            $columns = !empty($columns) ? $columns : 3;
            $columns_tablet = !empty($columns_tablet) ? $columns_tablet : 3;
            $columns_mobile = !empty($columns_mobile) ? $columns_mobile : 1;
            
            $slides_to_scroll = !empty($slides_to_scroll) ? $slides_to_scroll : 1;
            $slides_to_scroll_tablet = !empty($slides_to_scroll_tablet) ? $slides_to_scroll_tablet : 1;
            $slides_to_scroll_mobile = !empty($slides_to_scroll_mobile) ? $slides_to_scroll_mobile : 1;

            ?>
            <div class="widget widget-testimonials <?php echo esc_attr($el_class.' '.$style); ?>">
                <div class="widget-title text-center">
                    <?php if ( !empty($title) ): ?>
                        <h3 class="testimonials-title">
                            <?php echo esc_attr( $title ); ?>
                        </h3>
                    <?php endif; ?>
                    <?php if ( !empty($sub_text) ): ?>
                        <p class="sub-text">
                            <?php echo esc_attr( $sub_text ); ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="slick-carousel <?php echo esc_attr($columns < count($testimonials)?'':'hidden-dots'); ?>"
                                data-items="<?php echo esc_attr($columns); ?>"
                                data-smallmedium="<?php echo esc_attr( $columns_tablet ); ?>"
                                data-extrasmall="<?php echo esc_attr($columns_mobile); ?>"

                                data-slidestoscroll="<?php echo esc_attr($slides_to_scroll); ?>"
                                data-slidestoscroll_smallmedium="<?php echo esc_attr( $slides_to_scroll_tablet ); ?>"
                                data-slidestoscroll_extrasmall="<?php echo esc_attr($slides_to_scroll_mobile); ?>"

                                data-pagination="<?php echo esc_attr($show_pagination ? 'true' : 'false'); ?>" data-nav="<?php echo esc_attr($show_nav ? 'true' : 'false'); ?>" data-infinite="<?php echo esc_attr( $infinite_loop ? 'true' : 'false' ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ? 'true' : 'false' ); ?>">
                    <?php if($style == 'style1') { ?>
                        <?php foreach ($testimonials as $item) { ?>
                            <div class="item">
                                <div class="testimonials-item">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6">
                                            <div class="info-testimonials">
                                                <?php if ( !empty($item['title']) ) { ?>
                                                    <h4 class="title"><?php echo trim($item['title']); ?></h4>
                                                <?php } ?> 

                                                <div class="rating-customers">
                                                    <div class="inner" style="width: <?php echo esc_attr($item['rating']*20).'%'; ?>">
                                                    </div>
                                                </div>

                                                <?php if ( !empty($item['description']) ) { ?>
                                                    <div class="description"><?php echo trim($item['description']); ?></div>
                                                <?php } ?>
                                                <?php if ( !empty($item['info']) ) { ?>
                                                    <div class="name-client"><?php echo trim($item['info']); ?></div>
                                                <?php } ?>

                                                <?php if ( !empty($item['job']) ) { ?>
                                                    <div class="job"><?php echo trim($item['job']); ?></div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6">
                                            <?php
                                            $img_src = ( isset( $item['img_src']['id'] ) && $item['img_src']['id'] != 0 ) ? wp_get_attachment_url( $item['img_src']['id'] ) : '';
                                            if ( $img_src ) {
                                            ?>
                                                <div class="avarta">
                                                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr(!empty($item['name']) ? $item['name'] : ''); ?>">
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php }else{ ?>
                        <?php foreach ($testimonials as $item) { ?>
                            <div class="item">
                                <div class="testimonials-item-<?php echo trim($style); ?>">
                                    <div class="clearfix">
                                        <div class="info-testimonials"> 
                                            <div class="rating-customers">
                                                <div class="inner" style="width: <?php echo esc_attr($item['rating']*20).'%'; ?>">
                                                </div>
                                            </div>

                                            <?php if ( !empty($item['title']) ) { ?>
                                                <h4 class="title"><?php echo trim($item['title']); ?></h4>
                                            <?php } ?> 
                                            
                                            <?php if ( !empty($item['description']) ) { ?>
                                                <div class="description"><?php echo trim($item['description']); ?></div>
                                            <?php } ?>

                                            
                                            <div class="bottom-info flex-middle">
                                                <?php
                                                $img_src = ( isset( $item['img_src']['id'] ) && $item['img_src']['id'] != 0 ) ? wp_get_attachment_url( $item['img_src']['id'] ) : '';
                                                if ( $img_src ) {
                                                ?>
                                                    <div class="avarta">
                                                        <img src="<?php echo esc_url($img_src); ?>" alt="<?php echo esc_attr(!empty($item['name']) ? $item['name'] : ''); ?>">
                                                    </div>
                                                <?php } ?>
                                                <div class="info-testimonials">
                                                    <?php if ( !empty($item['info']) ) { ?>
                                                        <div class="name-client"><?php echo trim($item['info']); ?></div>
                                                    <?php } ?>
                                                    <?php if ( !empty($item['job']) ) { ?>
                                                        <div class="job"><?php echo trim($item['job']); ?></div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <?php
        }
    }
}
if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Sofass_Elementor_Testimonials );
} else {
    Plugin::instance()->widgets_manager->register( new Sofass_Elementor_Testimonials );
}