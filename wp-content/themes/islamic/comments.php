<?php 
	/*
	 * This file is used to generate comments form.
	 */	
?>

<!-- Check Authorize -->
<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
	if (post_password_required()){
		?> <p class="nopassword"><?php _e('This post is password protected. Enter the password to view comments.','crunchpress')?></p> <?php
		return;
	}
?>
<!-- Comment List -->
<?php if ( have_comments() ) : ?>
	<div id="comments" class="comment-title cp-link-title cp-title">
	<?php comments_number(__('No Comment','cp_front_end'), __('One Comment','cp_front_end'), __('% Comments','cp_front_end') );?>
	</div>
	<ol class="comment-list">
		<?php wp_list_comments(array('callback' => 'get_comment_list')); ?>
	</ol>
	<!-- Comment Navigation -->
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<br>
		<div class="comments-navigation">
			<div class="previous"> <?php previous_comments_link('Older Comments'); ?> </div>
			<div class="next"> <?php next_comments_link('Newer Comments'); ?> </div>
		</div>
	<?php endif; ?>
<?php endif; ?>
<!-- Comment Form -->
<?php 

	$comment_form = array( 
		'fields' => apply_filters( 'comment_form_default_fields', array(
			'author' => '<div class="comment-form-author">' .
						'<label for="author">' . __( 'Name', 'cp_front_end' ) . '</label> ' .
						( $req ? '<span class="required">*</span>' : '' ) .	
						'<input id="author" name="author" type="text" value="' .
						esc_attr( $commenter['comment_author'] ) . '" size="30" tabindex="1" />' .						
						'<div class="clear"></div>' .
						'</div><!-- #form-section-author .form-section -->',
			'email'  => '<div class="comment-form-email">' .
						'<label for="email">' . __( 'Email', 'cp_front_end' ) . '</label> ' .
						( $req ? '<span class="required">*</span>' : '' ) .
						'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" tabindex="2" />' .						
						'<div class="clear"></div>' .
						'</div><!-- #form-section-email .form-section -->',
			'url'    => '<div class="comment-form-url">' .
						'<label for="url">' . __( 'Website', 'cp_front_end' ) . '</label>' .
						'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" tabindex="3" />' .						
						'<div class="clear"></div>' .
						'</div><!-- #form-section-url .form-section -->' ) ),
			'comment_field' => '<div class="comment-form-comment">' .
						'<label for="url">' . __( 'Comment Here', 'cp_front_end' ) . '</label>' .
						'<textarea id="comment" name="comment" aria-required="true"></textarea>' .
						'</div><!-- #form-section-comment .form-section -->',
		'comment_notes_before' => '',
		'comment_notes_after' => '',
		'title_reply' => __('Leave a Reply','cp_front_end'),
	);
	comment_form($comment_form, $post->ID); 

?>
