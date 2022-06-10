<?php
/**
 * Hooks for template header
 *
 * @package Pick
 */

/**
 * Get favicon and home screen icons
 *
 * @since  1.0
 */
if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
	function pick_theme_header_icons() {
		$softhopper_pick = get_option('softhopper_pick');
		$favicon = $softhopper_pick['favicon']['url'];
		$header_icons =  ( $favicon ) ? '<link rel="shortcut icon" type="image/x-ico" href="' . esc_url( $favicon ) . '" />' : '';

		$icon_iphone = $softhopper_pick['icon_iphone']['url'];
		$header_icons .= ( $icon_iphone ) ? '<link rel="apple-touch-icon" sizes="57x57"  href="' . esc_url( $icon_iphone ) . '" />' : '';

		$icon_iphone_retina = $softhopper_pick['icon_iphone_retina']['url'];
		$header_icons .= ( $icon_iphone_retina ) ? '<link rel="apple-touch-icon" sizes="114x114" href="' . esc_url( $icon_iphone_retina ). '" />' : '';

		$icon_ipad = $softhopper_pick['icon_ipad']['url'];
		$header_icons .= ( $icon_ipad ) ? '<link rel="apple-touch-icon" sizes="72x72" href="' . esc_url( $icon_ipad ) . '" />' : '';

		$icon_ipad_retina = $softhopper_pick['icon_ipad_retina']['url'];
		$header_icons .= ( $icon_ipad_retina ) ? '<link rel="apple-touch-icon" sizes="144x144" href="' . esc_url( $icon_ipad_retina ) . '" />' : '';

		$allowed_html_array = array(
	        'link' => array(
	            'rel' => array(),
	            'sizes' => array(),
	            'href' => array(),
	        ),
	    );
	    
	    if ( isset ( $header_icons ) ) echo wp_kses( $header_icons, $allowed_html_array );
	}
	add_action( 'wp_head', 'pick_theme_header_icons' );
}

if ( ! function_exists( 'pick_theme_header_scripts' ) ) :
/**
 * Custom scripts and styles on header
 *
 * @since  1.0
 */
function pick_theme_header_scripts() {
	$softhopper_pick = get_option('softhopper_pick'); 
    global $post;
	// Include color schemer code
	require get_template_directory() . '/inc/frontend/color-schemer.php';
	
	$custom_background = '';                          
	$custom_background = get_theme_mod( 'background_color' ); 
	if ( $custom_background == "" ) {
	    $custom_background = "#f7f7f7";
	}
	?>
	<style type="text/css"> 
		body {
			background: <?php echo esc_attr($custom_background); ?>;
		}	
		<?php if ($softhopper_pick['post_format_meta'] == 0) { ?>
		.post-format {
		  display: none !important;
		}
		.post-format + .entry-title {
		  margin-top: 0 !important;
		}	
		<?php } ?>
	</style> 						
	<?php
	// Custom CSS
	if ( isset( $post->ID ) ) $meta = get_post_meta( $post->ID );
	$inline_css='';
	isset( $meta["_pick_theme_custom_css"][0] ) ? $softhopper_pick_theme_custom_css = $meta["_pick_theme_custom_css"][0] : $softhopper_pick_theme_custom_css = '';
	isset( $softhopper_pick['custom_css'] ) ? $custom_css = $softhopper_pick['custom_css'] : $custom_css = '';
	$inline_css = $softhopper_pick_theme_custom_css . $custom_css;
	
	if( $inline_css ) {
		echo '<style type="text/css">';
		echo esc_html($inline_css);
		echo '</style>';
	}	
}
add_action( 'wp_head', 'pick_theme_header_scripts', 300 );
endif;