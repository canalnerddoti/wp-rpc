<?php
/**
 * The template for displaying aside post formats
 *
 * Used for both single and index/archive/search.
 *
 * @package Pick
 */
    $softhopper_pick = get_option('softhopper_pick');

    // check list or grid post layout
    pick_theme_post_grid_list_class();
    global $post_layout;
?>
<div class="<?php echo esc_attr($post_layout); ?>">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	   	<header class="entry-header">
            <div class="post-format">
                <?php
                esc_html_e('In Aside','pick'); 
                ?>
            </div>
        </header> <!-- /.entry-header -->

	    <div class="entry-content">
	        <?php 
                if ( has_excerpt() ) {
                    the_excerpt();
                } else {
                    the_content();
                } 
            ?>    
	        <?php pick_theme_entry_header(); ?>  
	    </div> <!-- .entry-content -->
	</article> <!-- /.post-->
</div> <!-- /.col-md-12 -->