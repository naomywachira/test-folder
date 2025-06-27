<?php 
global $post;
$thumbsize = !isset($thumbsize) ? sofass_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;
$thumb = sofass_display_post_thumb($thumbsize);
?>
<article <?php post_class('post post-layout post-list-item'); ?>>
    <div class="list-inner ">
        <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
            <span class="post-sticky"><?php echo esc_html__('Featured','sofass'); ?></span>
        <?php endif; ?>
        <div class="row <?php echo (!empty($thumb))?'flex-middle-sm':''; ?>">
            <?php
                if ( !empty($thumb) ) {
                    ?>
                    <div class="image col-sm-6 col-xs-12">
                        <?php echo trim($thumb); ?>
                    </div>
                    <?php
                }
            ?>
            <div class="<?php echo (!empty($thumb))?'col-xs-12 col-sm-6':'col-sm-12 col-xs-12 no-image'; ?>">
            
                <div class="post-info">
                    
                    <?php if (get_the_title()) { ?>
                        <h4 class="entry-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h4>
                    <?php } ?>

                    <div class="top-info">
                        <a href="<?php the_permalink(); ?>"><i class="fa fa-calendar"></i><?php the_time( get_option('date_format', 'd M, Y') ); ?></a>
                        <span class="comments"><i class="fa fa-comments"></i><?php comments_number( esc_html__('0 Comments', 'sofass'), esc_html__('1 Comment', 'sofass'), esc_html__('% Comments', 'sofass') ); ?></span>
                        <!-- <?php sofass_post_categories($post); ?> -->
                    </div>

                    <?php if (sofass_get_config('show_excerpt', false)) { ?>
                        <div class="description"><?php echo sofass_substring( get_the_excerpt(), 20, '...' ); ?></div>
                    <?php } else{ ?>
                        <div class="description"><?php echo sofass_substring( get_the_content(), 20, '...' ); ?></div>
                    <?php } ?>
                    
                    <a class="btn btn-theme-second readmore radius-5x" href="<?php the_permalink(); ?>">
                        <?php esc_html_e('Read More', 'sofass'); ?>
                       <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
            
        </div>
    </div>
</article>