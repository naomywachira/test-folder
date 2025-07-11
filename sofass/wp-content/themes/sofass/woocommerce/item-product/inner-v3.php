<?php 
global $product;
$product_id = $product->get_id();
$image_size = isset($image_size) ? $image_size : 'woocommerce_thumbnail';

?>
<div class="product-block grid grid-v3" data-product-id="<?php echo esc_attr($product_id); ?>">
    <div class="grid-inner">
        <div class="block-inner">
            <figure class="image product-image">
                <?php
                    sofass_product_image($image_size);
                    do_action( 'woocommerce_before_shop_loop_item_title' );
                ?>
                <?php 
                    do_action( 'sofass_woocommerce_loop_sale_flash' );
                ?>
                <div class="clearfix swatches_list">
                    <?php Sofass_Woo_Swatches::swatches_list( $image_size ); ?>
                </div>
            </figure>
            <div class="groups-button clearfix">
                <div class="groups-button-inner">
                    <?php
                        if ( class_exists( 'YITH_WCWL' ) ) {
                            echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                        } elseif ( sofass_is_woosw_activated() && get_option('woosw_button_position_archive') == "0" ) {
                            echo do_shortcode('[woosw]');
                        }
                    ?>
                    <?php if( class_exists( 'YITH_Woocompare_Frontend' ) ) { ?>
                    <?php
                        $obj = new YITH_Woocompare_Frontend();
                        $url = $obj->add_product_url($product_id);
                        $compare_class = '';
                        if ( isset($_COOKIE['yith_woocompare_list']) ) {
                            $compare_ids = json_decode( $_COOKIE['yith_woocompare_list'] );
                            if ( in_array($product_id, $compare_ids) ) {
                                $compare_class = 'added';
                                $url = $obj->view_table_url($product_id);
                            }
                        }
                    ?>
                    <div class="yith-compare">
                        <a title="<?php esc_attr_e('compare', 'sofass') ?>" href="<?php echo esc_url( $url ); ?>" class="compare <?php echo esc_attr($compare_class); ?>" data-product_id="<?php echo esc_attr($product_id); ?>">
                        </a>
                    </div>
                    <?php } elseif( sofass_is_woosc_activated() && get_option('woosc_button_archive') == "0" ) {?>
                        <?php echo do_shortcode('[woosc]'); ?>
                    <?php } ?>
                    <?php if (sofass_get_config('show_quickview', false)) { ?>
                        <div class="view">
                            <a href="javascript:void(0);" class="quickview" data-product_id="<?php echo esc_attr($product_id); ?>">
                                <i class="ti-fullscreen"></i>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
       <div class="metas clearfix">
            <div class="title-wrapper">
                <div class="clearfix">
                    
                    <?php sofass_woo_display_product_cat($product_id); ?>

                    <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php
                        /**
                        * woocommerce_after_shop_loop_item_title hook
                        *
                        * @hooked woocommerce_template_loop_rating - 5
                        * @hooked woocommerce_template_loop_price - 10
                        */
                        do_action( 'woocommerce_after_shop_loop_item_title');
                    ?>    
                   
                    
                </div>
                
            </div>
            <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
        </div>
    </div>
</div>