<?php
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function pick_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Home Page', 'pick' ),
		'id'            => 'sidebar-home-page',
		'description'   => esc_html__( 'This sidebar is only for home page', 'pick' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<div class="widget-title-area"><h5 class="widget-title">',
		'after_title'   => '</h5></div><div class="widget-content">',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Default', 'pick' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__('This sidebar is for single post, single page, archive page and others pages.', 'pick' ),
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div></aside>',
		'before_title'  => '<div class="widget-title-area"><h5 class="widget-title">',
		'after_title'   => '</h5></div><div class="widget-content">',
	) );
	// Register footer sidebars
	$widget_count = isset( get_option('softhopper_pick')['footer_widget_columns'] ) ? get_option('softhopper_pick')['footer_widget_columns'] : 3;
	register_sidebars( $widget_count, array(
		'name'          => esc_html__( 'Footer %d', 'pick' ),
		'id'            => 'footer-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title-area"><h5 class="widget-title">',
		'after_title'   => '</h5></div>',
	) );
}
add_action( 'widgets_init', 'pick_theme_widgets_init' );