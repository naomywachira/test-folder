<?php
if ( !function_exists ('sofass_custom_styles') ) {
	function sofass_custom_styles() {
		global $post;	
		
		ob_start();	
		?>
		    

			<?php
				$main_font = sofass_get_config('main_font');
				$main_font = isset($main_font['font-family']) ? $main_font['font-family'] : false;
			?>
			<?php if ( $main_font ): ?>
				/* Main Font */
				body,.widget .widget-title p.sub-text, .widget .widget-title p, .widget .widgettitle p.sub-text, .widget .widgettitle p, .widget .widget-heading p.sub-text, .widget .widget-heading p, .megamenu > li > a, .product-block.grid .product-cat,span.price
				{
					font-family: <?php echo trim($main_font); ?> !important;
				}
			<?php endif; ?>
			
			<?php
				$heading_font = sofass_get_config('heading_font');
				$heading_font = isset($heading_font['font-family']) ? $heading_font['font-family'] : false;
			?>
			<?php if ( $heading_font ): ?>
				/* Heading Font */
				h1, h2, h3, h4, h5, h6, .widget-title,.widgettitle
				{
					
					font-family: <?php echo trim($heading_font); ?> !important;
				}
			<?php endif; ?>

            
			<?php if ( sofass_get_config('main_color') != "" ) : ?>
				/* seting background main */
				.woocommerce-account .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link a::before ,
				.goal-checkout-step li.active,
				.details-product .goal-woocommerce-product-gallery-thumbs.vertical .slick-arrow:hover i, .details-product .goal-woocommerce-product-gallery-thumbs.vertical .slick-arrow:focus i,
				.product-block-list .quickview:hover, .product-block-list .quickview:focus,
				.goal-pagination .page-numbers li > span:hover, .goal-pagination .page-numbers li > span.current, .goal-pagination .page-numbers li > a:hover, .goal-pagination .page-numbers li > a.current, .goal-pagination .pagination li > span:hover, .goal-pagination .pagination li > span.current, .goal-pagination .pagination li > a:hover, .goal-pagination .pagination li > a.current,
				.wishlist-icon .count, .mini-cart .count,
				.woocommerce .widget_price_filter .price_slider_amount .button,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
				.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
				.widget-countdown.style3 .title::before,
				.slick-carousel .slick-arrow:hover, .slick-carousel .slick-arrow:active, .slick-carousel .slick-arrow:focus,
				.product-block.grid .groups-button .add-cart .added_to_cart:hover::before,
				.product-block.grid .groups-button .add-cart .added_to_cart::before, 
				.product-block.grid .groups-button .add-cart .button:hover::before,
				.sidebar > .widget .widget-title:before, .sidebar > .widget .widgettitle:before, .sidebar > .widget .widget-heading:before, .goal-sidebar > .widget .widget-title:before, .goal-sidebar > .widget .widgettitle:before, .goal-sidebar > .widget .widget-heading:before,
				.add-fix-top,
				.widget .widget-title::after, .widget .widgettitle::after, .widget .widget-heading::after,
				.slick-carousel .slick-dots li.slick-active button,
				.bg-theme,
				.vertical-wrapper .title-vertical, table.variations .tawcvs-swatches .swatch-label.selected, .widget-social .social a:hover, .widget-social .social a:focus,
				.goal-pagination > span:hover, .goal-pagination > span.current, .goal-pagination > a:hover, .goal-pagination > a.current
				{
					background-color: <?php echo esc_html( sofass_get_config('main_color') ) ?> ;
				}

				
				/* setting color*/
				.header-mobile .mobile-vertical-menu-title:hover, .header-mobile .mobile-vertical-menu-title.active,
				.dokan-store-menu #cat-drop-stack > ul a:hover, .dokan-store-menu #cat-drop-stack > ul:focus,
				.shopping_cart_content .cart_list .quantity,
				#order_review .order-total .amount, #order_review .cart-subtotal .amount,
				.woocommerce-account .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link.is-active > a, .woocommerce-account .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link:hover > a, .woocommerce-account .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link:active > a,
				.woocommerce table.shop_table tbody .product-subtotal,
				.woocommerce div.product p.price, .woocommerce div.product span.price,
				.goal-breadscrumb .breadcrumb a:hover, .goal-breadscrumb .breadcrumb a:active,
				.details-product .title-cat-wishlist-wrapper .yith-wcwl-add-to-wishlist a:focus, .details-product .title-cat-wishlist-wrapper .yith-wcwl-add-to-wishlist a:hover,
				.details-product .title-cat-wishlist-wrapper .yith-wcwl-add-to-wishlist a:not(.add_to_wishlist),
				.details-product .product_meta a,
				.product-block-list .yith-wcwl-add-to-wishlist a:not(.add_to_wishlist),
				.product-block-list .yith-wcwl-add-to-wishlist a:hover, .product-block-list .yith-wcwl-add-to-wishlist a:focus,
				.goal-filter .change-view:hover, .goal-filter .change-view.active,
				.woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item > a:hover, .woocommerce-widget-layered-nav-list .woocommerce-widget-layered-nav-list__item > a:active,
				.mobile-sidebar-btn,
				.btn-readmore:hover,
				.goal-countdown .times > div > span,
				.btn-link,
				.goal-vertical-menu > li > a > i, .goal-vertical-menu > li > a > img,
				.megamenu .dropdown-menu li > a:hover, .megamenu .dropdown-menu li > a:active,
				.goal-footer a:hover, .goal-footer a:focus, .goal-footer a:active, .megamenu .dropdown-menu li.current-menu-item > a, .megamenu .dropdown-menu li.open > a, .megamenu .dropdown-menu li.active > a, .comment-list .comment-reply-link, .comment-list .comment-edit-link, .product-categories li.current-cat-parent > a, .product-categories li.current-cat > a, .product-categories li:hover > a,.detail-post .top-info i, .detail-post .entry-content-detail .list-categories:before,.post-layout .top-info i,.post-layout .list-categories:before
				{
					color: <?php echo esc_html( sofass_get_config('main_color') ) ?>;
				}
				/* setting border color*/
				.goal-checkout-step li.active::after,
				.details-product .goal-woocommerce-product-gallery-thumbs .slick-slide:hover .thumbs-inner, .details-product .goal-woocommerce-product-gallery-thumbs .slick-slide:active .thumbs-inner, .details-product .goal-woocommerce-product-gallery-thumbs .slick-slide.slick-current .thumbs-inner,
				.product-block-list:hover,
				.woocommerce .widget_price_filter .price_slider_amount .button,
				.border-theme, .widget-social .social a:hover, .widget-social .social a:focus, .post .entry-description .wp-block-quote,
				.tabs-v1 .nav-tabs > li.active{
					border-color: <?php echo esc_html( sofass_get_config('main_color') ) ?> !important;
				}

				.details-product .information .price,
				.product-block-list .price,
				.text-theme{
					color: <?php echo esc_html( sofass_get_config('main_color') ) ?> !important;
				}
				.goal-checkout-step li.active .inner::after {
					border-color: #fff <?php echo esc_html( sofass_get_config('main_color') ) ?>;
				}
			<?php endif; ?>

			<?php if ( sofass_get_config('text_color') != "" ) : ?>
			/* setting text color*/
			body{
				color: <?php echo esc_html( sofass_get_config('text_color') ) ?>;
			}
			<?php endif; ?>

			<?php if ( sofass_get_config('link_color') != "" ) : ?>
			/* setting link color*/
			a, .show-search-header,.post-layout .top-info a, .post-layout .top-info span, .detail-post .top-info a, .detail-post .top-info span{
				color: <?php echo esc_html( sofass_get_config('link_color') ) ?> !important;
			}
			<?php endif; ?>

			<?php if ( sofass_get_config('hover_color') != "" ) : ?>
			/* setting hover color*/
			a:hover{
				color: <?php echo esc_html( sofass_get_config('hover_color') ) ?> !important;
			}
			<?php endif; ?>

			<?php if ( sofass_get_config('heading_color') != "" ) : ?>
			/* setting heading color*/
			h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6,.widget .widget-title, .widget .widgettitle, .widget .widget-heading{
				color: <?php echo esc_html( sofass_get_config('heading_color') ) ?> !important;
			}
			<?php endif; ?>

			<?php if ( sofass_get_config('button_color') != "" ) : ?>
				/* seting background main */
				.btn-theme-second:hover,
				.slick-carousel .slick-arrow,
				.product-block-list .compare:hover,
				.widget-mailchimp.default .btn, .widget-mailchimp.default .viewmore-products-btn,
				.viewmore-products-btn, .woocommerce .wishlist_table td.product-add-to-cart a, .woocommerce .return-to-shop .button, .woocommerce .track_order .button, .woocommerce #respond input#submit,.product-block-list .add-cart .added_to_cart, .product-block-list .add-cart a.button,
				.product-block.grid .yith-wcwl-add-to-wishlist:not(.add_to_wishlist) a,
				.product-block.grid .yith-wcwl-add-to-wishlist a,
				.product-block.grid .view .quickview,
				.product-block.grid .yith-compare .compare,
				.product-block.grid .add-cart a.button, .product-block.grid .add-cart a.added_to_cart,
				.btn-theme,.woocommerce div.product form.cart .button, .woocommerce div.product form.cart .added_to_cart,
				.add-to-cart-bottom-wrapper .cart .added_to_cart, .add-to-cart-bottom-wrapper .cart button.single_add_to_cart_button
				{
					background-color: <?php echo esc_html( sofass_get_config('button_color') ) ?> ;
					border-color: <?php echo esc_html( sofass_get_config('button_color') ) ?> ;
				}
				.woocommerce div.product form.cart .button,
				.product-block-list .add-cart .added_to_cart, .product-block-list .add-cart a.button,
				.btn-theme.btn-outline{
					border-color: <?php echo esc_html( sofass_get_config('button_color') ) ?> ;
				}

				
			<?php endif; ?>
			<?php if ( sofass_get_config('button_hover_color') != "" ) : ?>
				/* seting background main */
				.btn-theme-second,
				.slick-carousel .slick-arrow:hover,
				.product-block-list .compare,
				.widget-mailchimp.default .btn:hover, .widget-mailchimp.default .viewmore-products-btn:hover,
				.viewmore-products-btn:hover, .woocommerce .wishlist_table td.product-add-to-cart a:hover, .woocommerce .return-to-shop .button:hover, .woocommerce .track_order .button:hover, .woocommerce #respond input#submit:hover,
				.woocommerce div.product form.cart .button:hover, .woocommerce div.product form.cart .button:focus,
				.details-product .information .compare:hover, .details-product .information .compare:focus,
				.product-block.grid .add-cart a.button:hover, .product-block.grid .add-cart a.added_to_cart:hover,
				.btn-theme:hover,
				.btn-theme:focus,
				.product-block.grid .yith-wcwl-add-to-wishlist:hover:not(.add_to_wishlist) a,
				.product-block.grid .view .quickview:active, .product-block.grid .view .quickview:hover ,
				.product-block.grid .yith-compare .compare:hover,
				.product-block-list .compare.added, .product-block-list .compare:hover, .product-block-list .compare:focus,
				.product-block-list .add-cart .added_to_cart:hover, .product-block-list .add-cart .added_to_cart:focus, .product-block-list .add-cart a.button:hover, .product-block-list .add-cart a.button:focus,
				.btn-theme.btn-outline:hover,
				.btn-theme.btn-outline:focus,
				.add-to-cart-bottom-wrapper .cart .added_to_cart, .add-to-cart-bottom-wrapper .cart button.single_add_to_cart_button{
					border-color: <?php echo esc_html( sofass_get_config('button_hover_color') ) ?> ;
					background-color: <?php echo esc_html( sofass_get_config('button_hover_color') ) ?> ;
				}
				
			<?php endif; ?>
	<?php
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		$lines = explode("\n", $content);
		$new_lines = array();
		foreach ($lines as $i => $line) {
			if (!empty($line)) {
				$new_lines[] = trim($line);
			}
		}
		
		return implode($new_lines);
	}
}