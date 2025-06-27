<?php $thumbsize = !isset($thumbsize) ? sofass_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;?>
<article <?php post_class('post post-layout post-grid-v3'); ?>>
    <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
        <span class="post-sticky"><?php echo esc_html__('Featured','sofass'); ?></span>
    <?php endif; ?>
    <?php
        $thumb = sofass_display_post_thumb($thumbsize);
        echo trim($thumb);
    ?>
    <div class="top-image image">
        
    <a href="<?php the_permalink(); ?>" class="date">
        <span class="moth"><?php the_time( 'M' ); ?></span>
        <span class="day"><?php the_time( 'd'); ?></span>
    </a>
    <div class="content">
        <div class="post-info">
                <div class="top-info">
            
                     <?php sofass_post_categories($post); ?>
                </div>
                <?php if (get_the_title()) { ?>
                    <h4 class="entry-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h4>
                <?php } ?>
               <!--  <?php if (sofass_get_config('show_excerpt', false)) { ?>
                    <div class="description"><?php echo sofass_substring( get_the_excerpt(), 15, '...' ); ?></div>
                <?php } else{ ?>
                    <div class="description"><?php echo sofass_substring( get_the_content(), 15, '...' ); ?></div>
                <?php } ?> -->
                <!-- <?php if (sofass_get_config('show_readmore', false)) { ?>
               <a class="btn btn-theme-second readmore radius-5x" href="<?php the_permalink(); ?>">
                    <?php esc_html_e('Read More', 'sofass'); ?>
                   <i class="fas fa-angle-double-right" aria-hidden="true"></i>
                </a>
                <?php } ?> -->
            </div>
       </div>
    </div>
</article>