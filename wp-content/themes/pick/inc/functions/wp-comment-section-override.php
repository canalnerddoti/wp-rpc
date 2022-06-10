<?php
function pick_theme_comment_form($args) {
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );

	$args['fields'] = array(
      'author' =>
        '<div class="col-md-6 pd-right"><p><input id="name" class="form-controller" name="author" required="required" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30"' . ( $req ? " aria-required='true'" : '' ) . ' placeholder="' . esc_html__( 'Your Name', 'pick' ) . ( $req ? '*' : '' ) . '" /></p></div>',

      'email' =>
        '<div class="col-md-6 pd-left"><p><input id="email" class="form-controller" name="email" required="required" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
        '" size="30"' . ( $req ? " aria-required='true'" : '' ) . ' placeholder="' . esc_html__( 'Your Email', 'pick' ) . ( $req ? '*' : '' ) . '" /></p></div>',

      'url' =>
        '<div class="col-md-12"><p><input id="url" class="form-controller" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
        '" size="30" placeholder="' . esc_html__( 'Got a Website?', 'pick' ) . '" /></p></div>'
      );
	$args['id_form'] = "contact_form";
	//$args['class_form'] = "commentform";
	$args['id_submit'] = "submit";
	$args['class_submit'] = "submit";
	$args['name_submit'] = "submit";
	$allowed_html_array = array(
        'span' => array(),
	    'a'     => array(
	        'href' => array()
	    )
    );

	$args['title_reply'] = wp_kses( __( '<span>Leave a Reply</span>', 'pick' ), $allowed_html_array );
	$args['title_reply_to'] =  wp_kses( __( 'Leave a Reply to %s', 'pick' ), $allowed_html_array );
	$args['cancel_reply_link'] = esc_html__( 'Cancel Reply', 'pick' );
	$args['comment_notes_before'] = "";
	$args['comment_notes_after'] = "";
	$args['label_submit'] = esc_html__( 'Submit', 'pick' );
	$args['comment_field'] = '<div class="col-md-12"><p><textarea id="message" class="form-controller" name="comment" aria-required="true" rows="8" cols="45" placeholder="'. esc_html__( 'Your Comment here&hellip;', 'pick' ) .'" ></textarea></p></div>';
	return $args;
}

add_filter('comment_form_defaults', 'pick_theme_comment_form');

function pick_theme_comment_list($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo ( $tag ) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>

	
	<div class="comment-meta">
		<div class="comment-author vcard">	
			<div class="author-img">
				<?php //if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>		<?php echo get_avatar($comment,$size='80'); ?>				
			</div><!-- /.author-img -->
			
		</div><!-- /.comment-author .vcard -->

		<div class="comment-metadata">

			<?php printf( '<b class="fn">%s</b>', get_comment_author_link() ); ?>
		<span class="date">
			<?php
				/* translators: 1: date, 2: time */
				printf( '%1$s '.esc_html__('at','pick').' %2$s', get_comment_date()." ",  get_comment_time()." " ); ?> <?php edit_comment_link( esc_html__( '(Edit)','pick' ), '  ', '' );
			?>
		</span>
			
		</div><!-- /.comment-metadata -->
	</div><!-- /.comment-meta -->

	

	<div class="comment-details">		
		<div class="comment-content">
			<?php comment_text(); ?>
			<?php if ( $comment->comment_approved == '0' ) : ?>
				<p><em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.','pick' ); ?></em>
				</p>
			<?php endif; ?>
		</div><!-- /.comment-content -->

		<div class="reply">
		<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- /.reply -->
	</div><!-- /.comment-details -->
	
	<?php if ( 'div' != $args['style'] ) : ?>
	</div><!-- /.comment-body -->
	<?php endif; ?>
<?php
}