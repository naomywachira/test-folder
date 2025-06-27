<?php
$post_format = get_post_format();
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="top-info-detail post-layout">

        <?php if( $post_format == 'link' ) {
            $format = sofass_post_format_link_helper( get_the_content(), get_the_title() );
            $title = $format['title'];
            $link = sofass_get_link_attributes( $title );
            $thumb = sofass_post_thumbnail('', $link);
            echo trim($thumb);
        } else { ?>
            <div class="entry-thumb top-image <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
                <?php
                    $thumb = sofass_post_thumbnail();
                    echo trim($thumb);
                ?>
                <?php if($thumb) {?>
                <a href="<?php the_permalink(); ?>" class="date">
                    <span class="moth"><?php the_time( 'M' ); ?></span>
                    <span class="day"><?php the_time( 'd'); ?></span>
                </a>
                <?php } ?>
            </div>
        <?php } ?>
        
    </div>
	<div class="entry-content-detail">
        <div class="top-info">
            <?php if(empty($thumb)){ ?>
            <a href="<?php the_permalink(); ?> " class="blog-time"><i class="far fa-calendar-alt"></i><?php the_time( get_option('date_format', 'd M, Y') ); ?></a>
            <?php } ?>
            <span class="comments"><i class="fas fa-comments"></i><?php comments_number( esc_html__('0 Comments', 'sofass'), esc_html__('1 Comment', 'sofass'), esc_html__('% Comments', 'sofass') ); ?>
            </span>
            <?php sofass_post_categories($post); ?>
           
        </div>
         <!-- <?php if (get_the_title()) { ?>
            <h1 class="entry-title-detail">
                <?php the_title(); ?>
            </h1>
        <?php } ?> -->
    	<div class="single-info info-bottom">
            <div class="entry-description">
                <?php
                    the_content();
                ?>
            </div><!-- /entry-content -->
    		<?php
    		wp_link_pages( array(
    			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'sofass' ) . '</span>',
    			'after'       => '</div>',
    			'link_before' => '<span>',
    			'link_after'  => '</span>',
    			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'sofass' ) . ' </span>%',
    			'separator'   => '',
    		) );
    		?>
            <?php  
                $posttags = get_the_tags();
            ?>
            <?php if( !empty($posttags) || sofass_get_config('show_blog_social_share', false) ){ ?>
        		<div class="tag-social">
                    <?php sofass_post_tags(); ?>
        			<?php if( sofass_get_config('show_blog_social_share', false) ) {
        				get_template_part( 'template-parts/sharebox' );
        			} ?>
        		</div>
            <?php } ?>
    	</div>
    </div>
     <?php
        //Previous/next post navigation.
        sofass_post_nav();
        // the_post_navigation( array(
        //     'next_text' => '<span class="meta-nav"><i class="ti-angle-right"></i></span> ' .
        //         '<div class="inner">'.
        //         '<div class="navi">' . esc_html__( 'Next', 'sofass' ) . '</div>'.
        //         '<span class="title-direct">%title</span></div>',
        //     'prev_text' => '<span class="meta-nav"><i class="ti-angle-left"></i></span> ' .
        //         '<div class="inner">'.
        //         '<div class="navi"> ' . esc_html__( 'Prev', 'sofass' ) . '</div>'.
        //         '<span class="title-direct">%title</span></div>',
        // ) );
    ?>
</article>