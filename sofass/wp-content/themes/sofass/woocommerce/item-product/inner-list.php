<?php 
global $product;
$product_id = $product->get_id();
$image_size = isset($image_size) ? $image_size : 'woocommerce_thumbnail';

?>
<div class="product-block product-block-list" data-product-id="<?php echo esc_attr($product_id); ?>">
    
    <div class="row flex-middle-sm">
        <div class="col-xs-5 col-sm-3 col-lg-3">    
            <div class="wrapper-image">
                 
                <?php if (sofass_get_config('show_quickview', false)) { ?>
                    <a href="#" class="quickview" data-product_id="<?php echo esc_attr($product_id); ?>" data-toggle="modal" data-target="#goal-quickview-modal">
                        <?php echo esc_html('quick view','sofass'); ?>
                    </a>
                <?php } ?>
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
               
            </div> 
        </div>
        <div class="col-xs-7 col-sm-5 col-lg-6">
            <div class="wrapper-info">
                <div class="top-list-info">
                    <?php if (sofass_get_config('show_shop_cat_title', false)) { ?>
                        <?php sofass_woo_display_product_cat($product_id); ?>
                    <?php } ?>
                    <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <?php
                        /**
                        * woocommerce_after_shop_loop_item_title hook
                        *
                        * @hooked woocommerce_template_loop_rating - 5
                        * @hooked woocommerce_template_loop_price - 10
                        */
                        remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price', 10);
                        do_action( 'woocommerce_after_shop_loop_item_title');
                    ?>
                    <?php if (sofass_get_config('show_rating', false)) { ?>
                        <div class="rating clearfix">
                            <?php
                                $rating_html = wc_get_rating_html( $product->get_average_rating() );
                                $count = $product->get_rating_count();
                                if ( $rating_html ) {
                                    echo trim( $rating_html );
                                } else {
                                    echo '<div class="star-rating"></div>';
                                }
                                echo '<span class="counts">('.$count.')</span>';
                            ?>
                        </div>
                    <?php } ?>
                    
                
                </div>
                <div class="product-excerpt">
                   <?php echo sofass_substring( get_the_excerpt(), 30, '...' ); ?>
                </div>


               
                
            </div>
        </div> 
        <div class="col-xs-12 col-sm-4 col-lg-3">
            <div class="left-infor">

                <?php 
                    do_action('sofass_list_shipping_info');
                    add_action( 'sofass_list_price', 'woocommerce_template_loop_price', 10 );
                    do_action('sofass_list_price');
                ?>

                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
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
            </div>
        </div> 
    </div>
</div>