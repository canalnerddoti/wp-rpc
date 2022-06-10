<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pick
 */
    get_header();
    $softhopper_pick = get_option('softhopper_pick');
    (isset($_GET["post_layout"])) ? $post_layout_url = $_GET["post_layout"] : $post_layout_url = "";
?>
<?php if ( class_exists( 'PickFeatured_Post' ) ) { ?>
    <?php get_template_part( 'template-parts/content', 'featured' ); ?> 
<?php } ?>

    <!-- Content
    ================================================== -->
	<div id="content" class="site-content">
		<div class="container">
			<div class="row">
                <?php
                    /* Show sidebar with user condition */
                    $columns_offset  = '';
                    $columns_grid = 8;
                    $content_push = '';
                    ( isset($_GET["layout"]) ) ? $layout = $_GET["layout"]  : $layout = "";
                    if ( $layout == "sidebar-left" ) {
                        $content_push = 'col-md-push-4';
                    } elseif ( $layout == "full-width" ) {
                        $columns_grid = 10;
                        $columns_offset = 'col-md-offset-1';
                    }  elseif ( $post_layout_url == "grid_three" ) {
                        $columns_grid = 12;
                        $columns_offset = '';
                    } else { 
                        if ( $softhopper_pick['post_layout'] == "grid_three" ) {
                            $columns_grid = 12;
                            $columns_offset = '';
                        } else {
                            if ( $softhopper_pick['sidebar_layout'] == 2 ) {
                                $content_push = 'col-md-push-4';
                            } elseif ( $softhopper_pick['sidebar_layout'] == 1 ) {
                                if ( $softhopper_pick['post_layout'] == "grid_three" ) {
                                    $columns_grid = 12;
                                    $columns_offset = '';
                                } else {
                                    $columns_grid = 10;
                                    $columns_offset = 'col-md-offset-1';
                                }
                            } 
                        }
                    }

                    // the query
                    $argsPosts = array(
                        'ignore_sticky_posts' => 1,
                        'meta_query' => array(
                            array(
                                'key' => '_is_featured',
                                'value' => 'yes',
                            )
                        ),
                    );
                    // Featured Posts
                    $ids = array();                   
                    $withoutFeatured = new WP_Query( $argsPosts );
                    if ( $withoutFeatured->have_posts() ) {
                        while ( $withoutFeatured->have_posts() ) : $withoutFeatured->the_post();
                            $ids[] = $post->ID; // building array of post ids
                        endwhile;
                    }
                ?>
                <div class="<?php echo esc_attr($columns_offset); ?> col-md-<?php echo esc_attr($columns_grid); ?> <?php echo esc_attr($content_push); ?>">
					<!-- Content Area -->
					<div id="primary" class="content-area">
						<main id="main" class="site-main">	
                            <?php
                                // this script to show post layout demo by URL
                                $masonry_id = true;
                                if ($post_layout_url == "list") { // check variable from url
                                    $masonry_id = false;
                                } elseif ($post_layout_url == "grid" || $post_layout_url == "grid_three") {
                                    $masonry_id = true;
                                } elseif ($softhopper_pick['post_layout'] == 'list') {
                                    $masonry_id = false;
                                }
                            ?>

                            <div class="row" <?php echo ($masonry_id == true ) ? 'id="masonry-layout"' : ''; ?>> 
                            <?php
                            // for infinity scroll
                            (isset($_GET["infinity_scroll"])) ? $infinity_scroll_url = $_GET["infinity_scroll"] : $infinity_scroll_url = "";

                            // for infinity scroll
                            $infinite_scroll = ( $softhopper_pick['infinity_scroll'] == 1 || $infinity_scroll_url == "on") ? 'id=pick-theme-infinity-scroll' : "" ;
                            ?>
                            <div <?php echo esc_attr( $infinite_scroll ); ?>>

                            <?php 
                            // don't show featured post in index page
                            $sticky = get_option( 'sticky_posts' );
                            if( is_sticky() && $softhopper_pick['post_layout'] == "grid_three" || $post_layout_url == "grid_three" ) {
                                $combine_id = array_merge($ids,$sticky); 
                            } else {
                                $combine_id = $ids;
                            }
                            $post_args = new WP_Query(
                                array (
                                    ( class_exists( 'PickFeatured_Post' ) && $softhopper_pick['featured_display_in_post'] == 1) ? '' : 'post__not_in' => $combine_id,
                                    'paged' => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
                                )
                            );
                            
                            if ( $post_args->have_posts() ) : ?>

                            <?php /* Start the Loop */ ?>
                            <?php while ( $post_args->have_posts() ) : $post_args->the_post(); ?>

                                <?php
                                    /* Include the Post-Format-specific template for the content.
                                     * If you want to override this in a child theme, then include a file
                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                    get_template_part( 'template-parts/content', get_post_format() );
                                ?>

                            <?php endwhile; ?>

                            <?php else : ?>

                                <?php get_template_part( 'template-parts/content', 'none' ); ?>

                            <?php endif; ?>
                            </div> <!-- /#pick-theme-infinity-scroll -->
                            </div> <!-- /.row --> 
                        </main> <!-- #main -->

                        <?php pick_theme_posts_pagination_nav(); ?>

					</div> <!-- #primary -->
				</div> <!-- /.col-md-8 -->
                <?php
                    /* Show sidebar with user condition */
                    ( isset($_GET["layout"]) ) ? $layout = $_GET["layout"]  : $layout = "";
                    if ( $softhopper_pick['sidebar_layout'] != 1 && $layout != "full-width" && $softhopper_pick['post_layout'] != 'grid_three' && $post_layout_url != "grid_three" ) {
                        get_sidebar();
                    } 
                ?>			
			</div> <!-- /.row -->
		</div> <!-- /.container -->		
	</div><!-- #content -->
<?php get_footer(); ?>