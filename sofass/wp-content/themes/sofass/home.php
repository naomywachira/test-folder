<?php
get_header();
$sidebar_configs = sofass_get_blog_layout_configs();
if( isset($sidebar_configs['right']) ){
	$check = 'has-right';
} elseif ( isset($sidebar_configs['left']) ){
	$check = 'has-left';
} elseif (isset($sidebar_configs['right']) && isset( $sidebar_configs['left']) ) {
	$check = '';
} else{
	$check = 'no-sidebar';
}
sofass_render_breadcrumbs();
$show_top_categories = sofass_get_config('show_top_categories', false);
$style = '';
?>
<?php if(!empty($show_top_categories)){ ?>
	<?php 
		$image = sofass_get_config('blog_top_image');
	    if ( !empty($image['id']) ) {
	        $img = wp_get_attachment_image_src($image['id'], 'full');
	        if ( !empty($img[0]) ) {
	            $style = 'style="background-image:url(\''.esc_url($img[0]).'\');"';
	        }
	    }

	    $posts_page_id = get_option( 'page_for_posts');
	?>
	<div class="blog-heading" <?php echo trim($style); ?>>
		<div class="container">
			<?php if ( $posts_page_id ) { ?>
				<h1 class="page-title"><?php echo get_the_title( get_option('page_for_posts', true) );; ?></h1>
			<?php } else { ?>
				<h1 class="page-title"><?php esc_html_e('The Blog', 'sofass'); ?></h1>
			<?php } ?>
			<?php
			// list categories
			$categories = get_categories( array(
				'taxonomy' => 'category',
				'hide_empty' => false,
			) );
			$uncategorized_id = get_cat_ID( 'Uncategorized' );
			
			if ( ! empty( $categories ) && ! is_wp_error( $categories ) ){
				
				?>
				<ul class="all-categories">
					<?php if ( $posts_page_id ) { ?>
						<li class="active"><a href="<?php echo esc_url(get_permalink($posts_page_id)); ?>"><?php esc_html_e('All', 'sofass'); ?></a></li>
					<?php } ?>
					<?php
					foreach ($categories as $category) {
						if ( $category->category_parent == $uncategorized_id || $category->term_id == $uncategorized_id ) {
				            continue;
				        }
						?>
						<li><a href="<?php echo get_term_link($category); ?>"><?php echo esc_html($category->name); ?></a></li>
						<?php
					}
					?>
				</ul>
				<?php
			}
			?>
		</div>
	</div>
<?php } ?>
<section id="main-container" class="main-content home-page-default archive-blog <?php echo apply_filters('sofass_blog_content_class', 'container');?> inner">
	<?php sofass_before_content( $sidebar_configs ); ?>
	<div class="row">
		<?php sofass_display_sidebar_left( $sidebar_configs ); ?>

		<div id="main-content" class="col-sm-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
			<div id="main" class="site-main" role="main">
			<?php if ( have_posts() ) : ?>

				<?php
				
				$layout = sofass_get_config( 'blog_display_mode', 'list' );
				$args = array( 'inner_item' => $layout );
				if( $layout == "list" ){
					get_template_part( 'template-posts/layouts/list' );
				} else{
					get_template_part( 'template-posts/layouts/grid','', $args);
				}
				// Previous/next page navigation.
				sofass_paging_nav();

			// If no content, include the "No posts found" template.
			else :
				get_template_part( 'template-posts/content', 'none' );

			endif;
			?>

			</div><!-- .site-main -->
		</div><!-- .content-area -->
		
		<?php sofass_display_sidebar_right( $sidebar_configs ); ?>
		
	</div>
</section>
<?php get_footer(); ?>