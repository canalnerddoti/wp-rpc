<?php
/**
 * Hooks for template footer
 *
 * @package Pick
 */

/**
 * Custom scripts  on footer
 *
 * @since  1.0
 */
function pick_theme_footer_scripts() {
	$softhopper_pick = get_option('softhopper_pick'); 
    global $post;
	// Custom javascript
	if ( isset( $post->ID ) ) $meta = get_post_meta( $post->ID );
	$inline_js = '';
	isset( $meta["_pick_theme_custom_js"][0] ) ? $softhopper_pick_theme_custom_js = $meta["_pick_theme_custom_js"][0] : $softhopper_pick_theme_custom_js = '';
	isset( $softhopper_pick['custom_js'] ) ? $custom_js = $softhopper_pick['custom_js'] : $custom_js = '';
	
	$js_custom = $softhopper_pick_theme_custom_js. $custom_js;
	
	if( $js_custom ) {
		echo '<script type="text/javascript">';
		echo esc_js( $js_custom );
		echo '</script>';
	}
}
add_action( 'wp_footer', 'pick_theme_footer_scripts', 200 );
