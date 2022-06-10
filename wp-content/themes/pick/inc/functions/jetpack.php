<?php
/**
 * Jetpack Compatibility File
 * See: https://jetpack.me/
 *
 * @package Pick
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function pick_theme_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'pick_theme_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function pick_theme_jetpack_setup
add_action( 'after_setup_theme', 'pick_theme_jetpack_setup' );

function pick_theme_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function pick_theme_infinite_scroll_render