<?php
/**
 * The template for displaying search results pages.
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
                /* Show breadcrumbs with condition */
                $columns_grid = 12;
                $columns_offset  = '';
                if ( $softhopper_pick['sidebar_layout'] == 1 ) {
                    $columns_grid = 10;
                    $columns_offset = 'col-md-offset-1';
                }
            ?>
            <div class="<?php echo esc_attr($columns_offset); ?> col-md-<?php echo esc_attr($columns_grid); ?>">
                <header class="page-header">
                    <h1 class="page-title"><?php printf( '<span>'.esc_html__( 'Search Results for:', 'pick' ).'</span>%s', get_search_query() ); ?></h1>

                    <?php if ( $softhopper_pick['search_form_in_search_page'] == 1 ) : ?>
                        <div class="search">
                            <?php get_search_form(); ?>                               
                        </div> <!-- /.search-form -->
                    <?php endif; ?>
                </header><!-- .page-header -->
            </div> <!-- /.col-md-8 -->                                    
        </div> <!-- /.row -->
    </div> <!-- /.container --> 

    <div class="container">
        <div class="row">
        <?php
            /* Show sidebar with user condition */
            $columns_grid = 8;
            $columns_offset  = '';
            $content_push = '';
            if ( $softhopper_pick['sidebar_layout'] == 2 ) {
                $content_push = 'col-md-push-4';
            } elseif ( $softhopper_pick['sidebar_layout'] == 1 ) {
                $columns_grid = 10;
                $columns_offset = 'col-md-offset-1';
            }
        ?>
        <div class="<?php echo esc_attr($columns_offset); ?> col-md-<?php echo esc_attr($columns_grid); ?> <?php echo esc_attr($content_push); ?>">
                
                <!-- Content Area -->
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">   


                        <div class="row" id="<?php echo ( $softhopper_pick['post_layout'] == 'list' ) ? '' : 'masonry-layout'; ?>">  
                        <?php
                            // for infinity scroll
                            $infinite_scroll = ( $softhopper_pick['infinity_scroll'] == 1 ) ? 'id="pick-theme-infinity-scroll"' : "" ;
                        ?>
                        <div <?php echo esc_attr( $infinite_scroll ); ?>>                         
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
                if ( $softhopper_pick['sidebar_layout'] != 1 ) {
                    get_sidebar();
                }
            ?>                      
        </div> <!-- /.row -->
    </div> <!-- /.container -->     
</div><!-- #content -->
<?php get_footer(); ?>