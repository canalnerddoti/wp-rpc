<?php
/*---------------------------------------*/
# Chat Post Format
/*---------------------------------------*/
add_filter( 'the_content', 'pick_theme_format_chat_content' );
add_filter( 'pick_theme_post_format_chat_text', 'wpautop' );
function pick_theme_format_chat_content( $content ) {
	global $_post_format_chat_ids;

	if ( !has_post_format( 'chat' ) )
		return $content;

	$_post_format_chat_ids = array();

	$separator = apply_filters( 'pick_theme_post_format_chat_separator', ':' );
	$chat_output = "\n\t\t\t" . '<div id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat-transcript">';
	$chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );
	foreach ( $chat_rows as $chat_row ) {
		if ( strpos( $chat_row, $separator ) ) {
			$chat_row_split = explode( $separator, trim( $chat_row ), 2 );
			$chat_author = strip_tags( trim( $chat_row_split[0] ) );
			$chat_text = trim( $chat_row_split[1] );
			$speaker_id = pick_theme_format_chat_row_id( $chat_author );
			$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';
			$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard"><cite class="fn">' . apply_filters( 'pick_theme_post_format_chat_author', $chat_author, $speaker_id ) . '</cite>' . /*$separator .*/ '</div>';
			$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'pick_theme_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</div>';
			$chat_output .= "\n\t\t\t\t" . '</div><!-- .chat-row -->';
		}

		else {
			if ( !empty( $chat_row ) ) {
				$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';
				$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'pick_theme_post_format_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</div>';
				$chat_output .= "\n\t\t\t</div><!-- .chat-row -->";
			}
		}
	}
	$chat_output .= "\n\t\t\t</div><!-- .chat-transcript -->\n";
	return apply_filters( 'pick_theme_post_format_chat_content', $chat_output );
}

function pick_theme_format_chat_row_id( $chat_author ) {
	global $_post_format_chat_ids;
	$chat_author = strtolower( strip_tags( $chat_author ) );
	$_post_format_chat_ids[] = $chat_author;
	$_post_format_chat_ids = array_unique( $_post_format_chat_ids );
	return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1;
}
