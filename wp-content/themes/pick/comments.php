<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package Pick
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

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<span><?php comments_number( esc_html__( 'No Comments', 'pick' ), esc_html__( '1 Comment', 'pick' ), '% '.esc_html__( 'Comments', 'pick' ) ); ?></span>
			<span class='border'></span>
		</h2>
		
		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'callback' => 'pick_theme_comment_list',
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation comment-navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'pick' ); ?></h2>
			<div class="nav-links">
				<?php
					$allowed_html_array = array(
				        'span' => array()
				    );
				?>
				<div class="nav-previous"><?php previous_comments_link( wp_kses( __( '<span>&laquo;</span> Older Comments', 'pick' ), $allowed_html_array ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( wp_kses( __( 'Newer Comments <span>&raquo;</span>', 'pick' ), $allowed_html_array ) ); ?></div>
			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'pick' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>
	<script>
   		jQuery("#contact_form > p").wrap("<div class='col-md-12'></div>");
        jQuery("#contact_form > div").wrapAll("<div class='row'></div>");
        jQuery("#reply-title").append("<span class='border'></span>");
	</script>
</div><!-- #comments -->
