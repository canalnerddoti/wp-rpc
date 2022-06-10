<?php 
/**
 * The template for displaying author page.
 *
 * @package Pick
 */
    get_header();
    $softhopper_pick = get_option('softhopper_pick');
?>
 <!-- Content
================================================== -->
<div id="content" class="site-content">
    <div class="container">
        <div class="row">
        <?php
            /* Show sidebar with user condition */
            $columns_grid = 8;
            $columns_offset  = '';
            $content_push = '';
            if ( $softhopper_pick['sidebar_layout_archive'] == 2 ) {
                $content_push = 'col-md-push-4';
            } elseif ( $softhopper_pick['sidebar_layout_archive'] == 1 ) {
                $columns_grid = 10;
                $columns_offset = 'col-md-offset-1';
            }
        ?>
        <div class="<?php echo esc_attr($columns_offset); ?> col-md-<?php echo esc_attr($columns_grid); ?> <?php echo esc_attr($content_push); ?>">
                <!-- Content Area -->
                <div id="primary" class="content-area">
                    <main id="main" class="site-main"> 
                        <?php get_template_part( 'template-parts/content', 'authorinfo' ); ?>
                        
                        <div class="row" <?php echo ( $softhopper_pick['post_layout_archive'] == 'list' ) ? '' : 'id="masonry-layout"'; ?>>
                        <?php
                            // for infinity scroll
                            $infinite_scroll = ( $softhopper_pick['infinity_scroll'] == 1 ) ? 'id="pick-theme-infinity-scroll"' : "" ;
                        ?>
                        <div <?php echo esc_attr($infinite_scroll); ?>>                              
                        <?php                             
                        if ( have_posts() ) : ?>

                        <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>

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
                if ( $softhopper_pick['sidebar_layout_archive'] != 1 ) {
                    get_sidebar();
                }
            ?>                      
        </div> <!-- /.row -->
    </div> <!-- /.container -->     
</div><!-- #content -->
<?php get_footer(); ?>