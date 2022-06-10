<?php
/**
 * The template for displaying featured posts
 *
 * Used for index.
 *
 * @package Pick
 */
?>
<?php 
    $softhopper_pick = get_option('softhopper_pick');
    (isset($_GET["display_featured"])) ? $display_featured = $_GET["display_featured"] : $display_featured = "";
    if ( $display_featured != "no" ) :
    if ( $softhopper_pick['featured_display'] == 1 ) :
    if ( !is_archive() && !is_paged() && !is_search() ) : 

    // query for featured post
    $query_args = array();

    $max =  $softhopper_pick['featured_per_page'] !== NULL ? $softhopper_pick['featured_per_page'] : 4;

    if( $max ) {
        $query_args['posts_per_page'] = $max;
    }

    $query_args['post_status'] = array( 'publish', 'private' );
    $query_args['has_password'] = false;
    $query_args['ignore_sticky_posts'] = true;
    $query_args['paged'] = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;;
    $query_args['featured'] = 'yes';

    $query = new WP_Query( $query_args );

    if ( $query->have_posts() ) : 
?>
<!-- Featured Aria 
===================================== -->
<div id="featured" class="feature-area">
    <div id="featured-header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">                     
                    <div id="featured-item" class="owl-carousel">
                        <?php
                            while ( $query->have_posts() ) : $query->the_post();
                        ?>
                        <div class="item">
                            <?php
                            if ( has_post_thumbnail() ) {
                                $featured_img_url = get_the_post_thumbnail_url( get_the_ID(),'full'  ); 
                            } else {
                                $featured_img_url = '';
                            } ?>
                            <div class="featured-item-content" style="background-image: url( <?php echo esc_url( $featured_img_url ); ?> );">
                                <div class="feat-ctn">
                                    <div class="feat-bottom-ctn">
                                        <header class="entry-header text-center">
                                            <div class="entry-category">
                                                <?php esc_html_e('In: ','pick') . the_category( ', ' ); ?>
                                            </div><!--  /.entry-category -->
                                            <?php       
                                                the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                                            ?>
                                        </header>
                                    </div><!--  /.feat-bottom-ctn -->
                                </div><!--  /.feat-ctn -->
                            </div><!--  /.featured-item-content -->
                        </div> <!-- /.item -->
                        <?php 
                            endwhile;
                            wp_reset_postdata(); 
                        ?>
                    </div> <!-- /.featured-item--> 
                </div> <!-- /.col-md-12 -->                 
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- #featured-header -->
</div> <!-- /#featured -->
<?php endif; endif; endif; endif; ?>
