<?php 
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
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
                $meta = get_post_meta( $post->ID );
                $columns_grid = 8; 
                $columns_offset  = ''; 
                $content_push = '';
                if ( isset($meta["_pick_theme_custom_layout"][0])) {
                    if ( $meta["_pick_theme_layout"][0] == 'sidebar-content' ) {
                        $content_push = 'col-md-push-4';
                    } elseif ( $meta["_pick_theme_layout"][0] == 'full-content' ) {
                        $columns_grid = 10;
                        $columns_offset = 'col-md-offset-1';
                    }
                } elseif ( $softhopper_pick['sidebar_layout_page'] == 2 ) {
                    $content_push = 'col-md-push-4';
                } elseif ( $softhopper_pick['sidebar_layout_page'] == 1 ) {
                    $columns_grid = 10;
                    $columns_offset = 'col-md-offset-1';
                }
            ?>
            <div class="<?php echo esc_attr($columns_offset); ?> col-md-<?php echo esc_attr($columns_grid); ?> <?php echo esc_attr($content_push); ?>">
                <!-- Content Area -->
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">
                        <div class="row">                            
                            <?php if ( have_posts() ) : ?>

                            <?php /* Start the Loop */ ?>
                            <?php while ( have_posts() ) : the_post(); ?>

                                <?php
                                    /* Include the Post-Format-specific template for the content.
                                     * If you want to override this in a child theme, then include a file
                                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                                     */
                                    get_template_part( 'template-parts/content', 'page' );
                                ?>

                            <?php endwhile; ?>

                            <?php else : ?>

                                <?php get_template_part( 'template-parts/content', 'none' ); ?>

                            <?php endif; ?>
                            <div class="col-md-12">
                                <!-- Include author info template part -->
                                <?php get_template_part( 'template-parts/content', 'authorinfo' ); ?>
                                <?php
                                    // If comments are open or we have at least one comment, load up the comment template
                                    if ( comments_open() || get_comments_number() ) :
                                        comments_template();
                                    endif;
                                ?>
                            </div>
                        </div>  
                    </main> <!-- #main -->
                </div> <!-- #primary -->
            </div> <!-- /.col-md-8 -->
            <?php
                /* Show sidebar with user condition */
                $meta = get_post_meta( $post->ID );
                if ( isset($meta["_pick_theme_custom_layout"][0])) {
                    if ( $meta["_pick_theme_layout"][0] != 'full-content') {
                        get_sidebar();
                    } 
                } elseif ( $softhopper_pick['sidebar_layout_page'] != 1 ) {
                    get_sidebar();
                }
            ?>                     
        </div> <!-- /.row -->
    </div> <!-- /.container -->     
</div><!-- #content -->
<?php get_footer(); ?>