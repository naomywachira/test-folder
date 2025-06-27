<header id="goal-header" class="goal-header header-default visible-lg" role="banner">
    <div class="<?php echo (sofass_get_config('keep_header') ? 'main-sticky-header-wrapper' : ''); ?>">
        <div class="<?php echo (sofass_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
            <div class="container p-relative">
                <div class="row flex-middle">
                    <div class="col-md-3">
                        <div class="logo-in-theme">
                            <?php get_template_part( 'template-parts/logo/logo' ); ?>
                        </div>
                    </div>
                    <div class="col-md-9 p-static flex-middle">
                        <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            <div class="pull-left">
                                <div class="main-menu">
                                    <nav data-duration="400" class="goal-megamenu slide animate navbar p-static" role="navigation">
                                    <?php
                                        $args = array(
                                            'theme_location' => 'primary',
                                            'container_class' => 'collapse navbar-collapse no-padding',
                                            'menu_class' => 'nav navbar-nav megamenu effect1',
                                            'fallback_cb' => '',
                                            'menu_id' => 'primary-menu',
                                            'walker' => new Sofass_Nav_Menu()
                                        );
                                        wp_nav_menu($args);
                                    ?>
                                    </nav>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="header-right pull-right clearfix">
                            <?php if ( defined('SOFASS_WOOCOMMERCE_ACTIVED') && sofass_get_config('show_cartbtn') && !sofass_get_config( 'enable_shop_catalog' ) ): ?>
                                <div class="pull-right">
                                    <?php get_template_part( 'woocommerce/cart/mini-cart-button' ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( class_exists( 'YITH_WCWL' ) && sofass_get_config('show_wishlist_btn', true) ){
                                $wishlist_url = YITH_WCWL()->get_wishlist_url();
                            ?>
                                <div class="pull-right">
                                    <a class="wishlist-icon" href="<?php echo esc_url($wishlist_url);?>">
                                        <i class="ti-heart"></i>
                                        <?php if ( function_exists('yith_wcwl_count_products') ) { ?>
                                            <span class="count"><?php echo yith_wcwl_count_products(); ?></span>
                                        <?php } ?>
                                    </a>
                                </div>
                            <?php } elseif( sofass_is_woosw_activated() ) {
                                $woosw_page_id = WPCleverWoosw::get_page_id();
                            ?>
                                <div class="pull-right">
                                    <a class="wishlist-icon" href="<?php echo esc_url(get_permalink($woosw_page_id));?>">
                                        <i class="ti-heart"></i>
                                        <span class="count woosw-custom-menu-item">0</span>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>