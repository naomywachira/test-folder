<?php

if ( !function_exists( 'sofass_product_metaboxes' ) ) {
	function sofass_product_metaboxes(array $metaboxes) {
		$prefix = 'goal_product_';
        $headers = array_merge( array('global' => esc_html__( 'Global Setting', 'sofass' )), sofass_get_header_layouts() );
	    $fields = array(
            array(
                'id' => $prefix.'header_type',
                'type' => 'select',
                'name' => esc_html__('Header Layout Type', 'sofass'),
                'options' => $headers
            ),
	    	array(
                'id' => $prefix.'layout_type',
                'type' => 'select',
                'name' => esc_html__('Layout Type', 'sofass'),
                'options' => array(
                    '' => esc_html__('Global Settings', 'sofass'),
                    'v1' => esc_html__('Layout 1', 'sofass'),
                    'v2' => esc_html__('Layout 2', 'sofass'),
                    'v3' => esc_html__('Layout 3', 'sofass'),
                    'v4' => esc_html__('Layout 4', 'sofass'),
                    'v5' => esc_html__('Layout 5', 'sofass'),
                    'v6' => esc_html__('Layout 6', 'sofass'),
                    'v7' => esc_html__('Layout 7', 'sofass'),
                    'v8' => esc_html__('Layout 8', 'sofass'),
                    'v9' => esc_html__('Layout 9', 'sofass'),
                    'v10' => esc_html__('Layout 10', 'sofass'),
                )
            ),
            array(
                'id' => $prefix.'bg_color',
                'type' => 'colorpicker',
                'name' => esc_html__('Background Color', 'sofass'),
                'description' => esc_html__('For Layout 2 ', 'sofass'),
            ),
	    	array(
				'name' => esc_html__( 'Review Video', 'sofass' ),
				'id'   => $prefix.'review_video',
				'type' => 'text',
				'description' => esc_html__( 'You can enter a video youtube or vimeo', 'sofass' ),
			),
    	);
		
		if ( sofass_is_sizeguides_activated() ) {
			$fields[] = array(
                'id' => $prefix.'sizeguides_enable',
                'type' => 'select',
                'name' => esc_html__('Size Guides Enable', 'sofass'),
                'options' => array(
                    '' => esc_html__('Global Settings', 'sofass'),
                    'enable' => esc_html__('Enable', 'sofass'),
                    'disable' => esc_html__('Disable', 'sofass'),
                )
            );
		}

	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'More Information', 'sofass' ),
			'object_types'              => array( 'product' ),
			'context'                   => 'normal',
			'priority'                  => 'low',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'sofass_product_metaboxes' );
