<?php 
global $product;
$product_id = $product->get_id();
$image_size = isset($image_size) ? $image_size : 'woocommerce_thumbnail';

$already_sold = !empty($already_sold) ? $already_sold : 0;
$available = !empty($available) ? $available : 0;
$total_stock = $already_sold + $available;
$percentage = ( $available > 0 ? round($already_sold/$total_stock * 100) : 0 );

wp_enqueue_script( 'countdown' );
?>
<div class="product-block grid grid-v2 grid-deal" data-product-id="<?php echo esc_attr($product_id); ?>">

    <div class="grid-inner">
        <div class="block-inner">
            <figure class="image">
                <?php
                    sofass_product_image($image_size);
                    do_action( 'woocommerce_before_shop_loop_item_title' );
                ?>
                <?php 
                    do_action( 'sofass_woocommerce_loop_sale_flash' );
                ?>
                <?php Sofass_Woo_Swatches::swatches_list( $image_size ); ?>
            </figure>
            <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
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
            <div class="meta-bottom">
                <?php
                $end_date = !empty($end_date) ? strtotime($end_date) : '';
                if ( $end_date ) {
                    $format = '<div class="times"><div class="day">%%D%% '.esc_html__('Days', 'sofass').'</div><div class="hours">%%H%%</div><div class="minutes">%%M%%</div><div class="seconds">%%S%%</div></div>';
                    ?>
                    <div class="goal-countdown clearfix" data-time="timmer"
                        data-date="<?php echo date('m', $end_date).'-'.date('d', $end_date).'-'.date('Y', $end_date).'-'. date('H', $end_date) . '-' . date('i', $end_date) . '-' .  date('s', $end_date) ; ?>" data-format="<?php echo esc_attr($format); ?>">
                    </div>
                    
                <?php } ?>

                <?php if ( $available && $already_sold ) { ?>
                <div class="special-progress">
                    <div class="progress">
                        <span class="progress-bar" style="<?php echo esc_attr('width:' . $percentage . '%'); ?>"></span>
                    </div>
                    <div class="info_sold clearfix">
                        <div class="pull-left">
                            <?php echo esc_html__('Available: ','sofass').'<span>'.$available.'</span>'; ?>
                        </div>
                        <div class="pull-right">
                            <?php echo esc_html__('Already Sold: ','sofass').'<span>'.$already_sold.'</span>'; ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>