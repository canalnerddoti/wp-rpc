<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package Pick
 */
    $softhopper_pick = get_option('softhopper_pick');
    (isset($_GET["post_layout"])) ? $post_layout_url = $_GET["post_layout"] : $post_layout_url = "";

 	$post_format = get_post_format();
	$meta = get_post_meta( $post->ID );
	if ( false === $post_format ) {
		$post_format = "standard";
	}

    // check list or grid post layout
    pick_theme_post_grid_list_class();
    global $post_layout;
?>
<div class="<?php echo esc_attr( $post_layout ); ?>">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="entry-header">            
            <?php pick_theme_entry_header(); ?>
        </header> <!-- /.entry-header -->

        <?php
            if( $post_format == 'video' )
            {
                echo '<div class="post-media">';
                    echo pick_theme_vedio(); 
                echo '</div>';
            } elseif ( $post_format == "link" ) {
                if ( isset ( $meta["_pick_theme_format_link"][0] ) ) :
                ?>
                <div class="post-link">
                    <div class="post-link-wrapper">
                        <div class="tb">
                            <div class="icon-area tb-cell">
                                <i class="fa fa-link"></i>
                            </div>
                            <div class="link-content tb-cell">
                                <h2>
                                    <a href="<?php if( isset ( $meta["_pick_theme_format_link"][0] ) ) echo esc_url( $meta["_pick_theme_format_link"][0] ); ?>"><?php if( isset ( $meta["_pick_theme_format_link_text"][0] ) ) echo esc_html( $meta["_pick_theme_format_link_text"][0] ); ?>
                                    </a>
                                </h2>
                                <a href="<?php if( isset ( $meta["_pick_theme_format_link"][0] ) ) echo esc_url( $meta["_pick_theme_format_link"][0] ); ?>" target="_blank"><?php if( isset ( $meta["_pick_theme_format_link"][0] ) ) echo esc_url( $meta["_pick_theme_format_link"][0] ); ?></a>
                            </div>
                        </div> <!-- /.tb -->
                    </div>
                    <div class="images">
                        <?php
                            pick_theme_cropping_image_size();
                            global $image_size;
                            
                            if ( isset($meta["_pick_theme_format_link_bg_img"][0]) ) {
                                echo wp_get_attachment_image( get_post_meta( get_the_ID(), '_pick_theme_format_link_bg_img_id', 1 ), $image_size );
                            }
                        ?>
                    </div>
                </div> <!-- /.post-link -->
                <?php
                endif;
            } else {
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
            }
        ?>

        <div class="entry-content">
        <?php 
            if ( is_single() ) {
                the_content(); 
                edit_post_link( esc_html__( '(Edit Post)', 'pick' ), '<span class="edit-link">', '</span>' );
                pick_theme_tag_list();
            } else {
                echo pick_excerpt( $softhopper_pick['post_excerpt'] );
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

        <footer class="entry-footer">                          
            <?php pick_theme_entry_footer(); ?>
        </footer> <!-- .entry-footer -->
    </article> <!-- /.post-->
</div> <!-- /.col-md-12 -->