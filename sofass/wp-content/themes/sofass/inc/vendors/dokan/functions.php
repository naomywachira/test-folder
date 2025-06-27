<?php

if ( ! function_exists( 'sofass_dokan_sidebars' ) ) {
	
	function sofass_dokan_sidebars() {
		register_sidebar( array(
			'name' 				=> esc_html__( 'Store Sidebar', 'sofass' ),
			'id' 				=> 'store-sidebar',
			'before_widget'		=> '<aside class="widget %2$s">',
			'after_widget' 		=> '</aside>',
			'before_title' 		=> '<h2 class="widget-title">',
			'after_title' 		=> '</h2>'
		));
	}

}

add_action( 'widgets_init', 'sofass_dokan_sidebars' );


function sofass_dokan_redux_config( $sections, $sidebars, $columns ) {
	// Dokan Store Sidebar
    $dokan_fields = array(
        array(
            'id' => 'dokan_sidebar_layout',
            'type' => 'image_select',
            'compiler' => true,
            'title' => esc_html__('Dokan Store Layout', 'sofass'),
            'subtitle' => esc_html__('Select the layout you want to apply on your Single Product Page.', 'sofass'),
            'options' => array(
                'main' => array(
                    'title' => esc_html__('Main Only', 'sofass'),
                    'alt' => esc_html__('Main Only', 'sofass'),
                    'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                ),
                'left-main' => array(
                    'title' => esc_html__('Left - Main Sidebar', 'sofass'),
                    'alt' => esc_html__('Left - Main Sidebar', 'sofass'),
                    'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                ),
                'main-right' => array(
                    'title' => esc_html__('Main - Right Sidebar', 'sofass'),
                    'alt' => esc_html__('Main - Right Sidebar', 'sofass'),
                    'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                ),
            ),
            'default' => 'left-main'
        ),
        array(
            'id' => 'dokan_product_columns',
            'type' => 'select',
            'title' => esc_html__('Product Columns', 'sofass'),
            'options' => $columns,
            'default' => 4,
        ),
        array(
            'id' => 'dokan_sidebar_fullwidth',
            'type' => 'switch',
            'title' => esc_html__('Is Full Width?', 'sofass'),
            'default' => false
        ),
    );

    if ( dokan_get_option( 'enable_theme_store_sidebar', 'dokan_general', 'off' ) !== 'off' ) {
    	
    	$dokan_fields[] = array(
            'id' => 'dokan_left_sidebar',
            'type' => 'select',
            'title' => esc_html__('Dokan Store Left Sidebar', 'sofass'),
            'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'sofass'),
            'options' => $sidebars
        );

        $dokan_fields[] = array(
            'id' => 'dokan_right_sidebar',
            'type' => 'select',
            'title' => esc_html__('Dokan Store Right Sidebar', 'sofass'),
            'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'sofass'),
            'options' => $sidebars
        );
    }
    $sections[] = array(
        'title' => esc_html__('Dokan Store Sidebar', 'sofass'),
        'fields' => $dokan_fields
    );

    return $sections;
}
add_filter( 'sofass_redux_framwork_configs', 'sofass_dokan_redux_config', 20, 3 );



// layout class for woo page
if ( !function_exists('sofass_dokan_content_class') ) {
    function sofass_dokan_content_class( $class ) {
        if( sofass_get_config('dokan_sidebar_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'sofass_dokan_content_class', 'sofass_dokan_content_class' );

// get layout configs
if ( !function_exists('sofass_get_dokan_layout_configs') ) {
    function sofass_get_dokan_layout_configs() {
        
                // lg and md for fullwidth
        if( sofass_get_config('dokan_sidebar_fullwidth') ) {
            $sidebar_width = 'col-lg-2 col-md-3 ';
            $main_width = 'col-lg-10 col-md-9';
        }else{
            $sidebar_width = 'col-lg-3 col-md-3 ';
            $main_width = 'col-lg-9 col-md-9 ';
        }

        $left = sofass_get_config('dokan_left_sidebar');
        $right = sofass_get_config('dokan_right_sidebar');

        switch ( sofass_get_config('dokan_sidebar_layout') ) {
            case 'left-main':
                $configs['left'] = array( 'sidebar' => $left, 'class' => $sidebar_width.' col-sm-12 col-xs-12'  );
                $configs['main'] = array( 'class' => $main_width.' col-sm-12 col-xs-12' );
                break;
            case 'main-right':
                $configs['right'] = array( 'sidebar' => $right,  'class' => $sidebar_width.' col-sm-12 col-xs-12' ); 
                $configs['main'] = array( 'class' => $main_width.' col-sm-12 col-xs-12' );
                break;
            case 'main':
                $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
                break;
            case 'left-main-right':
                $configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3 col-sm-12 col-xs-12'  );
                $configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
                $configs['main'] = array( 'class' => 'col-md-6 col-sm-12 col-xs-12' );
                break;
            default:
                $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
                break;
        }

        return $configs; 
    }
}