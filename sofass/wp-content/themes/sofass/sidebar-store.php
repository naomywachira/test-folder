<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Sofass
 * @since Sofass 1.0
 */


if ( is_active_sidebar( 'store-sidebar' ) ) { ?>

	<div class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'store-sidebar' ); ?>
	</div>

<?php } ?>