<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Sofass
 * @since Sofass 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
        <div class="comment-list-wrap"> 
	        <h3 class="comments-title"><?php comments_number( esc_html__('0 Comments', 'sofass'), esc_html__('1 Comment', 'sofass'), esc_html__('% Comments', 'sofass') ); ?></h3>
			<?php sofass_comment_nav(); ?>
			<ol class="comment-list">
				<?php wp_list_comments('callback=sofass_list_comment'); ?>
			</ol><!-- .comment-list -->
		</div>

		<?php sofass_comment_nav(); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'sofass' ); ?></p>
	<?php endif; ?>

	<?php
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $comment_args = array(
                        'title_reply'=> '<h4 class="title">'.esc_html__('Leave a Comment','sofass').'</h4>',
                        'comment_field' => '<div class="form-group space-comment">
                                                <textarea rows="7" placeholder="'.esc_attr__('Your Comment', 'sofass').'" id="comment" class="form-control"  name="comment"'.$aria_req.'></textarea>
                                            </div>',
                        'fields' => apply_filters(
                        	'comment_form_default_fields',
	                    		array(
	                                'author' => '<div class="row"><div class="col-sm-12 col-xs-12"><div class="form-group ">
	                                            <input type="text" name="author" placeholder="'.esc_attr__('Name*', 'sofass').'" class="form-control" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' />
	                                            </div></div>',
	                                'email' => ' <div class="col-sm-12 col-xs-12"><div class="form-group ">
	                                            <input id="email"  name="email" placeholder="'.esc_attr__('Email*', 'sofass').'" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' />
	                                            </div></div>',
	                                'Website' => ' <div class="col-xs-12"><div class="form-group ">
	                                            <input id="website" name="website" placeholder="'.esc_attr__('Website', 'sofass').'" class="form-control" type="text" value="' . esc_attr(  $commenter['comment_author_url'] ) . '" ' . $aria_req . ' />
	                                            </div></div></div>',
	                            )
							),
	                        'label_submit' => esc_html__('Post Comment', 'sofass'),
							'comment_notes_before' => '<div class="form-group h-info">'.esc_html__('Your email address will not be published.','sofass').'</div>',
							'comment_notes_after' => '',
                        );
    ?>

	<?php sofass_comment_form($comment_args); ?>
</div><!-- .comments-area --> 