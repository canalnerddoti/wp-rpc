<?php
/**
 * The template for displaying chat post formats
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
            <?php pick_theme_entry_header(); ?>
        </header> <!-- /.entry-header -->

        <?php
            if ( has_post_thumbnail() ) {
            ?>
            <figure class="post-thumb">
                <?php 
                if ( is_single() ) {
                    $meta = get_post_meta( $post->ID );
                    if ( isset($meta["_pick_theme_custom_layout"][0]) ) {
                        ( $meta["_pick_theme_layout"][0] == 'full-content' ) ? $image_size = "pick-theme-single-full" : $image_size = "pick-theme-single-list" ;
                    } else {
                        ( $softhopper_pick['sidebar_layout_single'] == 1 ) ? $image_size = "pick-theme-single-full" : $image_size = "pick-theme-single-list" ;
                    }
                    the_post_thumbnail( $image_size, array( 'class' => " img-responsive", 'alt' => get_the_title() ));
                } else {
                    ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php                                
                            pick_theme_cropping_image_size();
                            global $image_size;

                            the_post_thumbnail( $image_size, array( 'class' => " img-responsive", 'alt' => get_the_title() ));
                        ?>
                    </a>
                    <?php
                }
                ?>
            </figure> <!-- /.post-thumb -->
            <?php
            }
        ?>

        <script type="text/javascript">
			jQuery( window ).load(function() {
				jQuery('.format-chat .chat-text p:contains("more-link")').parent().parent().css('display', 'none');  
			});	
	    </script>

        <div class="entry-content">
        <?php 
            if ( is_single() ) {
                the_content(); 
                edit_post_link( esc_html__( '(Edit Post)', 'pick' ), '<span class="edit-link">', '</span>' );
                pick_theme_tag_list();
                ?>                
                <?php
            } else {
                if ( $softhopper_pick['post_layout'] == 'grid' ) {
                    if ( has_excerpt() ) {
                        the_excerpt();
                    } else {
                        the_content();
                    } 
                } else {
                    if ( has_excerpt() ) {
                        the_excerpt();
                    } else {
                        the_content();
                    }
				    echo '<div id="readmore-add"></div>';
                }
			}
        ?>  
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pick' ),
                'after'  => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) );
        ?>
        </div> <!-- .entry-content -->

        <footer class="entry-footer clearfix">                          
            <?php pick_theme_entry_footer(); ?>
        </footer> <!-- .entry-footer -->
    </article> <!-- /.post-->
</div> <!-- /.col-md-12 -->