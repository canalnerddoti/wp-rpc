<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>

 *
 * @package Pick
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses pick_theme_header_style()
 * @uses pick_theme_admin_header_style()
 * @uses pick_theme_admin_header_image()
 */
function pick_theme_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'pick_theme_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'pick_theme_header_style',
		'admin-head-callback'    => 'pick_theme_admin_header_style',
		'admin-preview-callback' => 'pick_theme_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'pick_theme_custom_header_setup' );

if ( ! function_exists( 'pick_theme_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see pick_theme_custom_header_setup().
 */
function pick_theme_admin_header_image() { ?>
	<div id="headimg">
		<div class="displaying-header-text" id="desc" style="<?php echo esc_attr( 'color: #' . get_header_textcolor() ); ?>"><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'description' ); ?>">
		<?php endif; ?>
	</div>
<?php
}
endif; // pick_theme_admin_header_image