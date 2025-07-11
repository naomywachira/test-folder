<div class="goal-footer-mobile">
	<?php if ( sofass_get_config('show_footer_search', true) ) : ?>
        <div class="footer-search-mobile">
            <?php get_template_part( 'template-parts/productsearchform-footer-mobile' ); ?>
        </div>
    <?php endif; ?>
	<ul>
		<li>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
				<i class="ti-home"></i>
	            <span><?php esc_html_e('Home', 'sofass'); ?></span>
	        </a>
        </li>

        <?php if ( sofass_get_config('show_footer_search', true) ) { ?>
	    	<li>
	    		<a class="footer-search-btn" href="javascript:void(0)">
	    			<i class="ti-search"></i>
		            <span><?php esc_html_e('Search', 'sofass'); ?></span>
		        </a>
	    	</li>
    	<?php } ?>

    	<?php if ( defined('SOFASS_WOOCOMMERCE_ACTIVED') && sofass_get_config('show_footer_cartbtn', true) && !sofass_get_config( 'enable_shop_catalog' )) { ?>
	    	<li>
	    		<a class="footer-mini-cart mini-cart" href="<?php echo wc_get_cart_url(); ?>">
		            <i class="ti-bag"></i>
		            <span class="count"><?php echo sprintf(WC()->cart->cart_contents_count); ?></span>
		            <span><?php esc_html_e('Cart', 'sofass'); ?></span>
		        </a> 
	    	</li>
    	<?php } ?>

    	<?php if ( defined('SOFASS_WOOCOMMERCE_ACTIVED') && sofass_get_config('show_footer_myaccount', true) ) { ?>
	    	<li>
	    		<a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>">
		            <i class="ti-user"></i>
		            <span><?php esc_html_e('My Account', 'sofass'); ?></span>
		        </a> 
	    	</li>
    	<?php } ?>

    	<?php
    		$morelink_menu = sofass_get_config('morelink_menu');
    		if ( sofass_get_config('show_footer_morelink', true) && $morelink_menu ) { ?>
	    	<li>
	    		<a href="javascript:void(0)" class="more">
		            <i class="ti-link"></i>
		            <span><?php esc_html_e('More', 'sofass'); ?></span>
		        </a>
		        <div class="wrapper-morelink">
			        <?php
	                    $args = array(
	                        'menu' => $morelink_menu,
	                        'menu_class'      => 'footer-morelink list-inline',
	                        'fallback_cb'     => '',
	                        'menu_id'         => 'footer-morelink'
	                    );
	                    wp_nav_menu($args);
	                ?>
	            </div>
	    	</li>
    	<?php } ?>
	</ul>
</div>
