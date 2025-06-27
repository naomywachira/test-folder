<?php

if ( !function_exists( 'sofass_page_metaboxes' ) ) {
	function sofass_page_metaboxes(array $metaboxes) {
		global $wp_registered_sidebars;
        $sidebars = array();

        if ( !empty($wp_registered_sidebars) ) {
            foreach ($wp_registered_sidebars as $sidebar) {
                $sidebars[$sidebar['id']] = $sidebar['name'];
            }
        }
        $headers = array_merge( array('global' => esc_html__( 'Global Setting', 'sofass' )), sofass_get_header_layouts() );
        $footers = array_merge( array('global' => esc_html__( 'Global Setting', 'sofass' )), sofass_get_footer_layouts() );

		$prefix = 'goal_page_';
	    $fields = array(
			array(
				'name' => esc_html__( 'Select Layout', 'sofass' ),
				'id'   => $prefix.'layout',
				'type' => 'select',
				'options' => array(
					'main' => esc_html__('Main Content Only', 'sofass'),
					'left-main' => esc_html__('Left Sidebar - Main Content', 'sofass'),
					'main-right' => esc_html__('Main Content - Right Sidebar', 'sofass')
				)
			),
			array(
                'id' => $prefix.'fullwidth',
                'type' => 'select',
                'name' => esc_html__('Is Full Width?', 'sofass'),
                'default' => 'no',
                'options' => array(
                    'no' => esc_html__('No', 'sofass'),
                    'yes' => esc_html__('Yes', 'sofass')
                )
            ),
            array(
                'id' => $prefix.'left_sidebar',
                'type' => 'select',
                'name' => esc_html__('Left Sidebar', 'sofass'),
                'options' => $sidebars
            ),
            array(
                'id' => $prefix.'right_sidebar',
                'type' => 'select',
                'name' => esc_html__('Right Sidebar', 'sofass'),
                'options' => $sidebars
            ),
            array(
                'id' => $prefix.'show_breadcrumb',
                'type' => 'select',
                'name' => esc_html__('Show Breadcrumb?', 'sofass'),
                'options' => array(
                    'no' => esc_html__('No', 'sofass'),
                    'yes' => esc_html__('Yes', 'sofass')
                ),
                'default' => 'yes',
            ),
            array(
                'id' => $prefix.'breadcrumb_color',
                'type' => 'colorpicker',
                'name' => esc_html__('Breadcrumb Background Color', 'sofass')
            ),
            array(
                'id' => $prefix.'breadcrumb_image',
                'type' => 'file',
                'name' => esc_html__('Breadcrumb Background Image', 'sofass')
            ),
            array(
                'id' => $prefix.'header_type',
                'type' => 'select',
                'name' => esc_html__('Header Layout Type', 'sofass'),
                'description' => esc_html__('Choose a header for your website.', 'sofass'),
                'options' => $headers,
                'default' => 'global'
            ),
            array(
                'id' => $prefix.'header_transparent',
                'type' => 'select',
                'name' => esc_html__('Header Transparent', 'sofass'),
                'description' => esc_html__('Choose a header for your website.', 'sofass'),
                'options' => array(
                    'no' => esc_html__('No', 'sofass'),
                    'yes' => esc_html__('Yes', 'sofass')
                ),
                'default' => 'global'
            ),
            array(
                'id' => $prefix.'footer_type',
                'type' => 'select',
                'name' => esc_html__('Footer Layout Type', 'sofass'),
                'description' => esc_html__('Choose a footer for your website.', 'sofass'),
                'options' => $footers,
                'default' => 'global'
            ),
            array(
                'id' => $prefix.'extra_class',
                'type' => 'text',
                'name' => esc_html__('Extra Class', 'sofass'),
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'sofass')
            )
    	);
		
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'Display Settings', 'sofass' ),
			'object_types'              => array( 'page' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'sofass_page_metaboxes' );

if ( !function_exists( 'sofass_cmb2_style' ) ) {
	function sofass_cmb2_style() {
		wp_enqueue_style( 'sofass-cmb2-style', get_template_directory_uri() . '/inc/vendors/cmb2/assets/style.css', array(), '1.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'sofass_cmb2_style' );


