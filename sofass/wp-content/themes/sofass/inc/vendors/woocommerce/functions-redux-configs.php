<?php

// Shop Archive settings
function sofass_woo_redux_config($sections, $sidebars, $columns) {
    $attributes = array();
    if ( is_admin() ) {
        $attrs = wc_get_attribute_taxonomies();
        if ( $attrs ) {
            foreach ( $attrs as $tax ) {
                $attributes[wc_attribute_taxonomy_name( $tax->attribute_name )] = $tax->attribute_label;
            }
        }
    }
    $sections[] = array(
        'icon' => 'el el-shopping-cart',
        'title' => esc_html__('Shop Settings', 'sofass'),
        'fields' => array(
            array(
                'id' => 'products_general_total_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('General Setting', 'sofass').'</h3>',
            ),
            array(
                'id' => 'enable_shop_catalog',
                'type' => 'switch',
                'title' => esc_html__('Enable Shop Catalog', 'sofass'),
                'default' => 0,
                'subtitle' => esc_html__('Enable Catalog Mode for disable Add To Cart button, Cart, Checkout', 'sofass'),
            ),
            array(
                'id' => 'colection_gutter',
                'type' => 'switch',
                'title' => esc_html__('Show Colection Gutter', 'sofass'),
                'default' => 1
            ),
            array(
                'id' => 'products_watches_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('Swatches Variation Setting', 'sofass').'</h3>',
            ),
            array(
                'id' => 'show_product_swatches_on_grid',
                'type' => 'switch',
                'title' => esc_html__('Show Swatches On Product Grid', 'sofass'),
                'default' => 1
            ),
            array(
                'id' => 'product_swatches_attribute',
                'type' => 'select',
                'title' => esc_html__( 'Grid swatch attribute to display', 'sofass' ),
                'subtitle' => esc_html__( 'Choose attribute that will be shown on products grid', 'sofass' ),
                'options' => $attributes
            ),
            array(
                'id' => 'show_product_swatches_use_images',
                'type' => 'switch',
                'title' => esc_html__('Use images from product variations', 'sofass'),
                'subtitle' => esc_html__( 'If enabled swatches buttons will be filled with images choosed for product variations and not with images uploaded to attribute terms.', 'sofass' ),
                'default' => 1
            ),
            array(
                'id' => 'products_breadcrumb_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('Breadcrumbs Setting', 'sofass').'</h3>',
            ),
            array(
                'id' => 'show_product_breadcrumbs',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumbs', 'sofass'),
                'default' => 1
            ),
            array(
                'title' => esc_html__('Breadcrumbs Background Color', 'sofass'),
                'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'sofass').'</em>',
                'id' => 'woo_breadcrumb_color',
                'type' => 'color',
                'transparent' => false,
            ),
            array(
                'id' => 'woo_breadcrumb_image',
                'type' => 'media',
                'title' => esc_html__('Breadcrumbs Background', 'sofass'),
                'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'sofass'),
            ),
        )
    );
    // Archive settings
    $elementor_options = ['' => esc_html__('Choose a Elementor Template', 'sofass')];
    if ( did_action( 'elementor/loaded' ) && is_admin() && !empty($_GET['page']) && $_GET['page'] == '_options' ) {
        $ele_obj = \Elementor\Plugin::$instance;
        $templates = $ele_obj->templates_manager->get_source( 'local' )->get_items();
        
        if ( !empty( $templates ) ) {
            foreach ( $templates as $template ) {
                $elementor_options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
            }
        }
    }
    $sections[] = array(
        'title' => esc_html__('Product Archives', 'sofass'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'products_top_section_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('Top Shop Setting', 'sofass').'</h3>',
            ),
            array(
                'id' => 'shop_elementor_template',
                'type' => 'select',
                'title' => esc_html__('Top Content (Elementor Template)', 'sofass'),
                'subtitle' => esc_html__('Choose a Elementor Template to show in top.', 'sofass'),
                'options' => $elementor_options,
                'default' => '',
            ),
            array(
                'id' => 'products_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('General Setting', 'sofass').'</h3>',
            ),
           
            
            array(
                'id' => 'product_columns',
                'type' => 'select',
                'title' => esc_html__('Product Columns', 'sofass'),
                'options' => $columns,
                'default' => 4,
            ),
            array(
                'id' => 'product_item_style',
                'type' => 'select',
                'title' => esc_html__('Product Style', 'sofass'),
                'options' => array(
                    'v1' => esc_html__('Style 1', 'sofass'),
                    'v2' => esc_html__('Style 2', 'sofass'),
                    'v3' => esc_html__('Style 3', 'sofass'),
                ),
                'default' => 'v1',
                // 'required' => array('product_display_mode', '=', array('grid'))
            ),

            array(
                'id' => 'number_products_per_page',
                'type' => 'text',
                'title' => esc_html__('Number of Products Per Page', 'sofass'),
                'default' => 12,
                'min' => '1',
                'step' => '1',
                'max' => '100',
                'type' => 'slider'
            ),
            
            array(
                'id' => 'show_quickview',
                'type' => 'switch',
                'title' => esc_html__('Show Quick View', 'sofass'),
                'default' => 1
            ),
            array(
                'id' => 'enable_swap_image',
                'type' => 'switch',
                'title' => esc_html__('Enable Swap Image', 'sofass'),
                'default' => 1
            ),
            array(
                'id' => 'product_pagination',
                'type' => 'select',
                'title' => esc_html__('Pagination Type', 'sofass'),
                'options' => array(
                    'default' => esc_html__('Default', 'sofass'),
                    'loadmore' => esc_html__('Load More Button', 'sofass'),
                    'infinite' => esc_html__('Infinite Scrolling', 'sofass'),
                ),
                'default' => 'default'
            ),

            array(
                'id' => 'products_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('Sidebar Setting', 'sofass').'</h3>',
            ),
            array(
                'id' => 'product_archive_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'sofass'),
                'default' => false
            ),
            array(
                'id' => 'product_archive_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Archive Product Layout', 'sofass'),
                'subtitle' => esc_html__('Select the layout you want to apply on your archive product page.', 'sofass'),
                'options' => array(
                    'main' => array(
                        'title' => esc_html__('Main Content', 'sofass'),
                        'alt' => esc_html__('Main Content', 'sofass'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                    ),
                    'left-main' => array(
                        'title' => esc_html__('Left Sidebar - Main Content', 'sofass'),
                        'alt' => esc_html__('Left Sidebar - Main Content', 'sofass'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                    ),
                    'main-right' => array(
                        'title' => esc_html__('Main Content - Right Sidebar', 'sofass'),
                        'alt' => esc_html__('Main Content - Right Sidebar', 'sofass'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                    ),
                ),
                'default' => 'left-main'
            ),
            array(
                'id' => 'product_archive_left_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Left Sidebar', 'sofass'),
                'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'sofass'),
                'options' => $sidebars,
                'required' => array('product_archive_layout', '=', array('left-main'))
            ),
            array(
                'id' => 'product_archive_right_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Right Sidebar', 'sofass'),
                'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'sofass'),
                'options' => $sidebars,
                'required' => array('product_archive_layout', '=', array('main-right'))
            ),
            array(
                'id' => 'product_archive_top_filter_style',
                'type' => 'select',
                'title' => esc_html__('Top Filter Style', 'sofass'),
                'subtitle' => esc_html__('Choose a top filter style.', 'sofass'),
                'options' => array(
                    'style1' => esc_html__('Style 1', 'sofass'),
                    'style2' => esc_html__('Style 2', 'sofass'),
                ),
                'default' => 'style1',
                'required' => array('product_archive_layout', '=', array('main'))
            ),
        )
    );
    
    
    // Product Page
    $sections[] = array(
        'title' => esc_html__('Single Product', 'sofass'),
        'subsection' => true,
        'fields' => array(
            array(
                'id' => 'product_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('General Setting', 'sofass').'</h3>',
            ),
            array(
                'id' => 'product_header_type',
                'type' => 'select',
                'title' => esc_html__('Header Layout Type (Product Details)', 'sofass'),
                'subtitle' => esc_html__('Choose a header for your website.', 'sofass'),
                'options' => array_merge( array('global' => esc_html__( 'Global Setting', 'sofass' )), sofass_get_header_layouts() ),
                'desc' => sprintf(wp_kses(__('You can add or edit a header in <a href="%s" target="_blank">Headers Builder</a>', 'sofass'), array( 'a' => array('href' => array(), 'target' => array()) )), esc_url( admin_url( 'edit.php?post_type=goal_megamenu') )),
            ),
            array(
                'id' => 'product_single_version',
                'type' => 'select',
                'title' => esc_html__('Product Layout', 'sofass'),
                'options' => array(
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
                ),
                'default' => 'v1',
            ),
            array(
                'title' => esc_html__('Background Color', 'sofass'),
                'subtitle' => '<em>'.esc_html__('The background color header.', 'sofass').'</em>',
                'id' => 'product_bg_color',
                'type' => 'color',
                'transparent' => false,
                'required' => array('product_single_version', '=', array('v2', 'v3'))
            ),
            array(
                'id' => 'enable_sticky_cart',
                'type' => 'switch',
                'title' => esc_html__('Enable Top Sticky Cart', 'sofass'),
                'default' => 1,
                'required' => array('product_single_version', '=', array('v4', 'v5', 'v6', 'v7'))
            ),
            array(
                'id' => 'product_delivery_title',
                'type' => 'text',
                'title' => esc_html__('Delivery Title', 'sofass'),
                'default' => 'Delivery and return',
            ),
            array(
                'id' => 'product_delivery_info',
                'type' => 'editor',
                'title' => esc_html__('Delivery Information', 'sofass'),
                'default' => '',
            ),
            array(
                'id' => 'product_shipping_title',
                'type' => 'text',
                'title' => esc_html__('Shipping Title', 'sofass'),
                'default' => 'Shipping Information',
            ),
            array(
                'id' => 'product_shipping_info',
                'type' => 'editor',
                'title' => esc_html__('Shipping Information', 'sofass'),
                'default' => '',
            ),
            array(
                'id' => 'product_composition_title',
                'type' => 'text',
                'title' => esc_html__('Composition Title', 'sofass'),
                'default' => 'Composition and care',
            ),
            array(
                'id' => 'product_composition_info',
                'type' => 'editor',
                'title' => esc_html__('Composition Information', 'sofass'),
                'default' => '',
            ),

            array(
                'id' => 'show_product_sticky_add_to_cart',
                'type' => 'switch',
                'title' => esc_html__('Show Bottom Sticky Add To Cart', 'sofass'),
                'default' => 1
            ),
            array(
                'id' => 'show_product_meta',
                'type' => 'switch',
                'title' => esc_html__('Show Product Meta', 'sofass'),
                'default' => 1
            ),
            array(
                'id' => 'show_product_social_share',
                'type' => 'switch',
                'title' => esc_html__('Show Social Share', 'sofass'),
                'default' => 1
            ),
            array(
                'id' => 'show_product_review_tab',
                'type' => 'switch',
                'title' => esc_html__('Show Product Review Tab', 'sofass'),
                'default' => 1
            ),
            array(
                'id' => 'hidden_product_additional_information_tab',
                'type' => 'switch',
                'title' => esc_html__('Hidden Product Additional Information Tab', 'sofass'),
                'default' => 1
            ),
            array(
                'id' => 'show_product_countdown_timer',
                'type' => 'switch',
                'title' => esc_html__('Show Product CountDown Timer', 'sofass'),
                'subtitle' => esc_html__('For only product deal', 'sofass'),
                'default' => 1
            ),
            array(
                'id' => 'number_product_thumbs',
                'title' => esc_html__('Number Thumbnails Per Row', 'sofass'),
                'default' => 4,
                'min' => '1',
                'step' => '1',
                'max' => '8',
                'type' => 'slider',
            ),
            array(
                'id' => 'product_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Sidebar Setting', 'sofass').'</h3>',
            ),
            array(
                'id' => 'product_single_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Single Product Sidebar Layout', 'sofass'),
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
                'default' => 'main'
            ),
            array(
                'id' => 'product_single_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'sofass'),
                'default' => false
            ),
            array(
                'id' => 'product_single_left_sidebar',
                'type' => 'select',
                'title' => esc_html__('Single Product Left Sidebar', 'sofass'),
                'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'sofass'),
                'options' => $sidebars
            ),
            array(
                'id' => 'product_single_right_sidebar',
                'type' => 'select',
                'title' => esc_html__('Single Product Right Sidebar', 'sofass'),
                'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'sofass'),
                'options' => $sidebars
            ),

            array(
                'id' => 'product_block_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3> '.esc_html__('Product Block Setting', 'sofass').'</h3>',
            ),
            array(
                'id' => 'show_product_releated',
                'type' => 'switch',
                'title' => esc_html__('Show Products Releated', 'sofass'),
                'default' => 1
            ),
            array(
                'id' => 'releated_product_columns',
                'type' => 'select',
                'title' => esc_html__('Releated Products Columns', 'sofass'),
                'options' => $columns,
                'default' => 4,
                'required' => array('show_product_releated', '=', true)
            ),

            array(
                'id' => 'show_product_upsells',
                'type' => 'switch',
                'title' => esc_html__('Show Products upsells', 'sofass'),
                'default' => 1
            ),
            array(
                'id' => 'upsells_product_columns',
                'type' => 'select',
                'title' => esc_html__('Upsells Products Columns', 'sofass'),
                'options' => $columns,
                'default' => 4,
                'required' => array('show_product_upsells', '=', true)
            ),
        )
    );
    
    return $sections;
}
add_filter( 'sofass_redux_framwork_configs', 'sofass_woo_redux_config', 10, 3 );