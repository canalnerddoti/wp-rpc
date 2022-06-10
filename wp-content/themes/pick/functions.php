<?php
/**
 * Pick functions and definitions
 *
 * @package Pick
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
if ( ! function_exists( 'pick_theme_setup' ) ) :

function pick_theme_setup() {
	$softhopper_pick = get_option('softhopper_pick');
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Pick, use a find and replace
	 * to change 'pick' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'pick', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'main-menu' => esc_html__( 'Top Menu', 'pick' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) 
	);
	
	/* Define image size */
	add_image_size( 'pick-theme-featured-img', 570, 375, true );
	add_image_size( 'pick-theme-single-full', 975, 530, true );
	add_image_size( 'pick-theme-single-grid-full', 450, 295, true );
	add_image_size( 'pick-theme-single-list', 800, 470, true );
	add_image_size( 'pick-theme-single-grid', 370, 250, true );
	add_image_size( 'pick-theme-gallery-small', 170, 115, true );
	add_image_size( 'pick-theme-small-img', 66, 66, true );
	add_image_size( 'pick-theme-related-posts', 370, 250, true );
	
	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'image', 'gallery', 'audio', 'video', 'quote', 'link', 'aside', 'status', 'chat'
		) 
	);
        
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'pick_theme_custom_background_args', array (
		'default-color' => 'f2f2f2',
		'default-image' => '',
	) ) );

	/** 
	 * Enable WP Responsive embedded content
	 *
	 * @since 1.0
	 */
	add_theme_support( 'responsive-embeds' );

	/** 
	 * Enable WP Gutenberg Block Style
	 *
	 * @since 1.0
	 */
	add_theme_support( 'wp-block-styles' );

	/**
	 * Add Editor Style
	 *
	 * @since 1.0
	 */
	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	/**
	 * Enable support for custom Editor Style.
	 *
	 * @since 1.0
	 */
	add_editor_style( 'editor-style.css' );

	/**
	 * Enable fonts Google font family
	 *
	 * @since 1.0
	 */
	function google_fonts_url_editor() {
	    $font_url = '';
	    
	    /*
	    Translators: If there are characters in your language that are not supported
	    by chosen font(s), translate this to 'off'. Do not translate into your own language.
	     */
	    if ( 'off' !== esc_html_x( 'on', 'Google font: on or off', 'pick' ) ) {
	        $font_url = add_query_arg( 'family', urlencode( 'PT Serif:400,700,400italic,700italic|Lora:400%,700,400italic,700italic' ), "https://fonts.googleapis.com/css" );
	    }
	    return $font_url;
	}
	add_editor_style( google_fonts_url_editor() );
}
endif; // pick_theme_setup
add_action( 'after_setup_theme', 'pick_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! isset( $content_width ) ) {
	$content_width = 960; /* pixels */
}

/**
 * Include the Redux theme options framework
 */
if ( class_exists( 'ReduxFramework' ) ) {
	require get_template_directory() . '/inc/libs/redux-framework/redux-extensions-loader/loader.php';
    require get_template_directory() . '/inc/libs/redux-framework/redux-framework-config.php';
}

/**
 * Include Register widget function
 */
require get_template_directory() . '/inc/functions/register-widgets.php';

/**
 * Enqueue scripts and styles function
 */
require get_template_directory() . '/inc/functions/enqueue-scripts.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/functions/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/functions/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/functions/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/functions/jetpack.php';

/**
 * Include the TGM_Plugin_Activation class.
 */
require get_template_directory() . '/inc/libs/tgm-plugin-activation/tgm-admin-config.php';

/**
 * Configure CMB2 Meta Box
 */
require get_template_directory() . '/inc/libs/cmb2/cmb2-config.php';

/**
 * Register Custom Navigation Walker
 */
require get_template_directory() . '/inc/functions/sh-pick-nav-walker.php';

/**
 * Wordpress comment section override 
 */
require get_template_directory() . '/inc/functions/wp-comment-section-override.php';

/**
 * Query function to get post
 */
require get_template_directory() . '/inc/functions/function-for-post.php';

/**
 * Popular Post functions
 */
require get_template_directory() . '/inc/functions/popular-post.php';

/**
 * Include header, Hooks for template header
 */
require get_template_directory() . '/inc/frontend/header.php';

/**
 * Include header, Hooks for template header
 */
require get_template_directory() . '/inc/frontend/footer.php';

/**
 * Include chat-post-modify
 */
require get_template_directory() . '/inc/functions/chat-post-modify.php';

/**
 * Include override functions
 */
require get_template_directory() . '/inc/functions/wordpress-override.php';
