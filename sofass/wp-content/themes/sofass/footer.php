<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Sofass
 * @since Sofass 1.0
 */
$footer = apply_filters( 'sofass_get_footer_layout', 'default' );
$show_footer_desktop_mobile = sofass_get_config('show_footer_desktop_mobile', false);
$show_footer_mobile = sofass_get_config('show_footer_mobile', true);
?>
	</div><!-- .site-content -->
	<?php if ( !empty($footer) ): ?>
		<?php sofass_display_footer_builder($footer); ?>
	<?php else: ?>
		<footer id="goal-footer" class="goal-footer <?php echo esc_attr(!$show_footer_desktop_mobile ? 'hidden-xs hidden-sm' : ''); ?>" role="contentinfo">
			<div class="footer-default">
				<div class="goal-footer-inner">
					<div class="goal-copyright">
						<div class="container">
							<div class="copyright-content clearfix">
								<div class="text-copyright">
									<?php
										
										$allowed_html_array = array( 'a' => array('href' => array()) );
										echo wp_kses(sprintf(__('&copy; %s - Sofass. All Rights Reserved. <br/> Powered by <a href="//goalthemes.com">GoalThemes</a>', 'sofass'), date("Y")), $allowed_html_array);
									?>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer><!-- .site-footer -->
	<?php endif; ?>
	<?php
	if ( sofass_get_config('back_to_top') ) { ?>
		<a href="#" id="back-to-top" class="add-fix-top">
			<i class="fa fa-angle-up" aria-hidden="true"></i>
		</a>
	<?php
	}
	?>

	<?php if ( is_active_sidebar( 'popup-newsletter' ) ): ?>
		<?php dynamic_sidebar( 'popup-newsletter' ); ?>
	<?php endif; ?>
	
	<?php
		if ( $show_footer_mobile ) {
			get_template_part( 'footer-mobile' );
		}
	?>
</div><!-- .site -->
<?php wp_footer(); ?>
</body>
</html>