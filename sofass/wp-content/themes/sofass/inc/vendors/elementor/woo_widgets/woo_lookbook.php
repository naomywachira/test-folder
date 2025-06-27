<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Sofass_Elementor_Woo_Lookbook extends Widget_Base {

	public function get_name() {
        return 'goal_element_woo_lookbook';
    }

	public function get_title() {
        return esc_html__( 'Goal Lookbook', 'sofass' );
    }

    public function get_icon() {
        return 'ti-bag';
    }

	public function get_categories() {
        return [ 'sofass-elements' ];
    }

	protected function register_controls() {
        $posts = get_posts(
            array(
                'post_type' => 'lookbook',
                'number' => -1,
            )
        );
        $pposts = [ '' => esc_html__('Choose a lookbook', 'sofass') ];
        if ( !empty($posts) ) {
            foreach ($posts as $post) {
                $pposts[$post->post_name] = $post->post_title;
            }
        }
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'sofass' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'lookbook',
            [
                'label' => esc_html__( 'Lookbook', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => $pposts,
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Carousel Style', 'sofass' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Style 1', 'sofass'),
                    'style2' => esc_html__('Style 2', 'sofass'),
                    'style3' => esc_html__('Style 3', 'sofass'),
                ),
                'default' => 'style1',
            ]
        );

   		$this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'sofass' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particsofassr content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'sofass' ),
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        if ( !empty($lookbook) ) {
            ?>
            <div class="widget widget-lookbook <?php echo esc_attr($el_class); ?>">
               <?php echo do_shortcode('[lookbook slug="'.$lookbook.'" style="'.$style.'"]'); ?>
            </div>
            <?php
        }
    }
}
if ( version_compare(ELEMENTOR_VERSION, '3.5.0', '<') ) {
    Plugin::instance()->widgets_manager->register_widget_type( new Sofass_Elementor_Woo_Lookbook );
} else {
    Plugin::instance()->widgets_manager->register( new Sofass_Elementor_Woo_Lookbook );
}