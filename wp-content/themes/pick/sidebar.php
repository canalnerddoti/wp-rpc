<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Pick
 */
    $softhopper_pick = get_option('softhopper_pick');
    /* show sidebar with condition */
    ( isset($_GET["layout"]) ) ? $layout = $_GET["layout"] : $layout = "";
    
    if ( isset( $post->ID ) ) { $meta = get_post_meta( $post->ID ); }

    $content_push = '';

    if ( $layout == "sidebar-left" ) {
        $content_push = 'col-md-pull-8';
    } elseif ( $layout == "sidebar-right" || $layout == "full-width") {
        $content_push = '';
    } else { 
        if ( is_single() ) {
            if ( isset($meta["_pick_theme_custom_layout"][0])) {
                if ( $meta["_pick_theme_layout"][0] == 'sidebar-content' ) {
                    $content_push = 'col-md-pull-8';
                }
            } elseif ( $softhopper_pick['sidebar_layout_single'] == 2 ) {
                $content_push = 'col-md-pull-8';
            }
        } elseif ( is_page() ) {
            if ( isset($meta["_pick_theme_custom_layout"][0])) {
                if ( $meta["_pick_theme_layout"][0] == 'sidebar-content' ) {
                    $content_push = 'col-md-pull-8';
                }
            } elseif ( $softhopper_pick['sidebar_layout_page'] == 2 ) {
                $content_push = 'col-md-pull-8';
            }
        } elseif ( is_archive() || is_search() ) {
            if ( $softhopper_pick['sidebar_layout_archive'] == 2 ) {
                $content_push = 'col-md-pull-8';
            }
        } else {
            if ( $softhopper_pick['sidebar_layout'] == 2 ) {
                $content_push = 'col-md-pull-8';
            }
        }
    }
?>
<div class="col-md-4 <?php echo esc_attr($content_push); ?>">
	<?php
		( is_home() ) ? $sidebar_id = "sidebar-home-page" : $sidebar_id = "sidebar-default" ; 
	?>
	<!-- Sidebar -->
	<div id="secondary" class="widget-area">
    	<?php if ( ! dynamic_sidebar( $sidebar_id ) ) : ?>

            <?php the_widget('WP_Widget_Search', '', 'before_widget=<aside class="widget clearfix widget_search">&before_title=<div class="widget-title-area"><h5 class="widget-title">&after_title=</h5></div>><div class="widget-content">&after_widget=</div></aside>'); ?>
            
            <?php the_widget('WP_Widget_Categories', '', 'before_widget=<aside class="widget clearfix widget_categories">&before_title=<div class="widget-title-area"><h5 class="widget-title">&after_title=</h5></div><div class="widget-content">&after_widget=</div></aside>'); ?>

            <?php the_widget('WP_Widget_Archives', '', 'before_widget=<aside class="widget clearfix widget_archive">&before_title=<div class="widget-title-area"><h5 class="widget-title">&after_title=</h5></div><div class="widget-content">&after_widget=</div></aside>'); ?>

            <?php the_widget('WP_Widget_Tag_Cloud', '', 'before_widget=<aside class="widget clearfix widget_tag_cloud">&before_title=<div class="widget-title-area"><h5 class="widget-title">&after_title=</h5></div><div class="widget-content">&after_widget=</div></aside>'); ?>

    	<?php endif; // end sidebar widget area ?>
    </div> <!-- #secondary -->	
</div> <!-- .col-md-4 --> 