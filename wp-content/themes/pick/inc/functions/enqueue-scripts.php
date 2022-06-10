<?php
/**
 * Enqueue scripts and styles.
 */
function pick_theme_scripts() {
	global $wp_scripts, $softhopper_pick;
	$protocol = is_ssl() ? 'https' : 'http';
	// enqueue style
	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style('pick-theme-font-awesome', get_template_directory_uri() . "/fonts/font-awsome/css/font-awesome.min.css");
	wp_enqueue_style('pick-theme-bootstrap', get_template_directory_uri() . "/lib/bootstrap/css/bootstrap.min.css");
	wp_enqueue_style('pick-theme-owl-carousel', get_template_directory_uri() . "/lib/plugin.css");
	wp_enqueue_style( 'pick-theme-style', get_stylesheet_uri() );

	// load RTL
	if ( is_rtl() ) {
		wp_enqueue_style('pick-theme-rtl', get_template_directory_uri() . "/rtl.css");
	}

	// enqueue scripts
	wp_enqueue_script('pick-theme-bootstrap-js', get_template_directory_uri() . "/lib/bootstrap/js/bootstrap.min.js", array("jquery"), false, true);	
	
    // for infinity scroll
	(isset($_GET["infinity_scroll"])) ? $infinity_scroll_url = $_GET["infinity_scroll"] : $infinity_scroll_url = "";
	if ( $softhopper_pick['infinity_scroll'] == 1 || $infinity_scroll_url == "on") {
		wp_enqueue_script('pick-theme-infinity-scroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array("jquery"), false, true);
	}

	wp_enqueue_script('pick-theme-plugins-js', get_template_directory_uri() . '/js/plugins.js', array("jquery"), false, true);

	//circliful load only contact page
	if ( pick_theme_get_current_template() == "aboutme-page.php" ) {
		wp_enqueue_script('pick-theme-circliful-js', get_template_directory_uri() . '/lib/circliful/jquery.circliful.min.js', array("jquery"), false, true);
	}
	// load masonry from wordpress for grid layout
	wp_enqueue_script('masonry');
	
	//google map load only contact page
	if ( pick_theme_get_current_template() == "contact-page.php" ) {
		wp_enqueue_script('pick-theme-googleapis-js', "$protocol://maps.googleapis.com/maps/api/js?sensor=true", array("jquery"), false, true);
		wp_enqueue_script('pick-theme-gmaps-js', get_template_directory_uri() . '/js/gmaps.min.js', array("jquery"), false, true);
	}
	wp_enqueue_script('pick-theme-magnific-popup-js', get_template_directory_uri() . '/lib/magnific-popup/jquery.magnific-popup.min.js', array("jquery"), false, true);
	wp_enqueue_script('pick-theme-justified-gallery-js', get_template_directory_uri() . '/lib/justifiedgallery/jquery.justifiedGallery.min.js', array("jquery"), false, true);
	wp_enqueue_script('pick-theme-js', get_template_directory_uri() . '/js/pick.js', array("jquery"), false, true);
	//wp_enqueue_script( 'pick-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'pick-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	// check list or grid layout
	(isset($_GET["post_layout"])) ? $post_layout_url = $_GET["post_layout"] : $post_layout_url = "";
	$list_layout = false;
    if ($softhopper_pick['post_layout'] == 'list' || $post_layout_url == "list") { // check variable from url
        $list_layout = true;
    } 

    $check_rtl = false;
    if ( is_rtl() ) {
    	$check_rtl = true;
    }

	( $softhopper_pick['sidebar_layout'] == 1 ) ? $owl_item = 7 : $owl_item = 5;
    wp_localize_script("pick-theme-js", "pick", array (
        	"lat" => $softhopper_pick['contact_lat'],
        	"lon" => $softhopper_pick['contact_lon'],
        	"map_mouse_wheel" => $softhopper_pick['map_mouse_wheel'],
        	"map_zoom_control" => $softhopper_pick['map_zoom_control'],
        	"map_point_img" => $softhopper_pick['contact_map_point_img']['url'],
        	"infinity_scroll_img" => $softhopper_pick['infinity_scroll_img']['url'],
        	"featured_post_in_slider" => $softhopper_pick['featured_post_in_slider'],
        	"featured_post_auto_slide" => $softhopper_pick['featured_post_auto_slide'],
        	"featured_slide_speed" => $softhopper_pick['featured_slide_speed'],
        	"featured_autoplay_timeout" => $softhopper_pick['featured_autoplay_timeout'],
        	"tiled_gallery_row_height" => $softhopper_pick['tiled_gallery_row_height'],
        	"owl_item" => $owl_item,
        	"list_layout" => $list_layout,
        	"check_rtl" => $check_rtl,
        	"theme_uri" => get_template_directory_uri() 
    	)
    );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pick_theme_scripts' );

// Remove Open Sans that WP adds from frontend
if (!function_exists('remove_wp_open_sans')) :
function remove_wp_open_sans() {
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', false );
}
add_action('wp_enqueue_scripts', 'remove_wp_open_sans');
// Uncomment below to remove from admin
// add_action('admin_enqueue_scripts', 'remove_wp_open_sans');
endif;

/**
 * Enqueue scripts and styles for WordPress admin panel.
 */
function pick_theme_admin_panel_scripts($hook) {
	// enqueue style
	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style('pick-theme-admin-font-awesome', get_template_directory_uri() . "/fonts/font-awsome/css/font-awesome.min.css");
	wp_enqueue_style('pick-theme-admin-custom', get_template_directory_uri() . "/css/backend/custom.css");
	wp_enqueue_style('pick-theme-redux-custom', get_template_directory_uri() . "/css/backend/redux-custom.css");	
	if( $hook == 'widgets.php' ) {
		wp_enqueue_style('thickbox');
	}

	// enqueue scripts
	wp_enqueue_script('pick-theme-backend-js', get_template_directory_uri() . '/js/backend/admin.js', array("jquery"), false, true);
	if( $hook == 'widgets.php' ) {		 
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('pick-theme-widget-js', get_template_directory_uri() . '/js/backend/widget.js', null, null, true);
	}
}
add_action( 'admin_enqueue_scripts', 'pick_theme_admin_panel_scripts' );