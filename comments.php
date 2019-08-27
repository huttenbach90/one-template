<?php
 /*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area bg-light">

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments font-weight-bold"><?php _e( 'Diskuze byla uzavřena.', 'oneindustry' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

	<?php if ( have_comments() ) : ?>
		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 0,
					'max_depth'   => 3,
					//'callback'    => 'better_comments',
					'reply_text'  => __('Odpovědět', 'oneindustry'),
				) );
			?>
		</ol>
	<?php endif; ?>

  	<?php paginate_comments_links(); ?>

</div>
