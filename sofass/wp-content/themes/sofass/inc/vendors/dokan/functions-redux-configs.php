<?php

// Shop Archive settings
function sofass_woo_dokan_redux_config($sections, $sidebars, $columns) {

    // Product Page
    $sections[] = array(
        'title' => esc_html__('Dokan Settings', 'sofass'),
        'fields' => array(
            array(
                'id' => 'dokan_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('General Setting', 'sofass').'</h3>',
            ),
            
            array(
                'id' => 'dokan_show_vendor_name',
                'type' => 'switch',
                'title' => esc_html__('Show Vendor Name', 'sofass'),
                'default' => 1
            ),
            
            array(
                'id' => 'dokan_show_more_products',
                'type' => 'switch',
                'title' => esc_html__('Show More Products From This Vendor', 'sofass'),
                'default' => 1
            ),

            array(
                'id' => 'dokan_show_vendor_info',
                'type' => 'switch',
                'title' => esc_html__('Show Vendor Info', 'sofass'),
                'default' => 1
            ),
        )
    );
    
    return $sections;
}
add_filter( 'sofass_redux_framwork_configs', 'sofass_woo_dokan_redux_config', 10, 3 );