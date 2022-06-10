<?php
/**
 * The template for displaying status post formats
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
<div class="<?php echo esc_attr( $post_layout ); ?>">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="entry-header">            
            <?php pick_theme_entry_header(); ?>
        </header> <!-- /.entry-header -->

        <?php
            ob_start(); 
        ?>
        <div class="post-media">				
			<?php
		    $meta = get_post_meta( $post->ID );
			$status_bg = ( isset ( $meta["_pick_theme_format_status_bg"][0] ) ) ? $meta["_pick_theme_format_status_bg"][0] : "";
			$status_facebook = ( isset ( $meta["_pick_theme_format_status_fb"][0] ) ) ? $meta["_pick_theme_format_status_fb"][0] : "";
			$status_twitter = ( isset ( $meta["_pick_theme_format_status_twitter"][0] ) ) ? $meta["_pick_theme_format_status_twitter"][0] : "";
			$status_gplus = ( isset ( $meta["_pick_theme_format_status_gplus"][0] ) ) ? $meta["_pick_theme_format_status_gplus"][0] : "";
			$status_instagram = ( isset ( $meta["_pick_theme_format_status_instagram"][0] ) ) ? $meta["_pick_theme_format_status_instagram"][0] : "";

			if( !empty( $status_facebook ) || !empty( $status_twitter ) || !empty( $status_gplus ) || !empty( $status_instagram )):	

                    $status_bg = "";
                    $image_src = "";
                    pick_theme_cropping_image_size();
                    global $image_size;

                    if ( is_single() ) {
                        $meta = get_post_meta( $post->ID );
                        if ( isset($meta["_pick_theme_custom_layout"][0]) ) {
                            ( $meta["_pick_theme_layout"][0] == 'full-content' ) ? $image_size = "pick-theme-single-full" : $image_size = "pick-theme-single-list" ;
                        } else {
                            ( $softhopper_pick['sidebar_layout_single'] == 1 ) ? $image_size = "pick-theme-single-full" : $image_size = "pick-theme-single-list" ;
                        }
                        if ( isset($meta["_pick_theme_format_status_bg"][0]) ) {
                            $img_tag = wp_get_attachment_image_src( get_post_meta( get_the_ID(), '_pick_theme_format_status_bg_id', 1 ), $image_size );
                            $image_src = $img_tag[0];
                        }
                    } else {
                        if ( isset($meta["_pick_theme_format_status_bg"][0]) ) {
                            $img_tag = wp_get_attachment_image_src( get_post_meta( get_the_ID(), '_pick_theme_format_status_bg_id', 1 ), $image_size );
                            $image_src = $img_tag[0];
                        } 
                    }

                    if ( $image_src ) {
                        $status_bg = $image_src;
                    }
                ?>
				<div class="post-status-wrapper" style="background: url(<?php echo esc_url( $status_bg ); ?>);">
				<?php if( !empty( $status_facebook ) ) : ?>
					<div id="fb-root"></div>
					<script>
						(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];
						if (d.getElementById(id)) return;  js = d.createElement(s);
						js.id = id;  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
						fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));
					</script>
					<div class="fb-post" data-href="<?php echo esc_url( $status_facebook ); ?>"></div>
				<?php elseif( !empty( $status_twitter ) ) : ?>
					<blockquote class="twitter-tweet"><a href="<?php echo esc_url( $status_twitter ); ?>"></a></blockquote>
					<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
				<?php elseif( !empty( $status_gplus ) ) : ?>
					<script type="text/javascript" src="//apis.google.com/js/plusone.js"></script>
					<div class="g-post" data-href="<?php echo esc_url( $status_gplus ); ?>"></div>
				<?php elseif( !empty( $status_instagram ) ) : ?>
					<?php echo ( $status_instagram ) ?>
				<?php endif; ?>
				</div><!-- /.post-status-wrapper -->
			<?php endif; ?>
		</div> <!-- /.post-media -->
        <?php   
        $status_post = ob_get_clean();

        (isset($_GET["post_layout"])) ? $post_layout_url = $_GET["post_layout"] : $post_layout_url = "";

        // status
        ob_start();
            echo '<figure class="post-thumb">';
            pick_theme_cropping_image_size();
            global $image_size;
            if ( isset($meta["_pick_theme_format_status_bg_id"][0]) ) {
                echo '<a href="'.get_the_permalink().'">';
                echo wp_get_attachment_image( get_post_meta( get_the_ID(), '_pick_theme_format_status_bg_id', 1 ), $image_size );
                echo '</a>';
            }
            echo '</figure>';
        $status_image = ob_get_clean();

        // if list layout show status or if grid layout show only image (but single post show full status)
        if (is_single()) {
            echo ( $status_post );
        } else {
            if (is_archive() || is_search()) {
                if ( $post_layout_url == "grid" || $post_layout_url == "grid_three") {
                    echo ( $status_image );
                } elseif ( $post_layout_url == "list" ) {
                    echo ( $status_post );
                } else {
                    if ($softhopper_pick['post_layout_archive'] == 'list') {
                        echo ( $status_post );
                    } else {
                        echo ( $status_image );
                    }
                }
            } else {
                if ( $post_layout_url == "grid" || $post_layout_url == "grid_three" ) {
                    echo ( $status_image );
                } elseif ( $post_layout_url == "list" ) {
                    echo ( $status_image );
                } else {
                    if ($softhopper_pick['post_layout'] == 'list') {
                        echo ( $status_image );
                    } else {
                        echo ( $status_image );
                    }
                }
            }
        }
        ?>                

        <div class="entry-content">
        <?php 
            if ( is_single() ) {
                the_content(); 
                edit_post_link( esc_html__( '(Edit Post)', 'pick' ), '<span class="edit-link">', '</span>' );
                pick_theme_tag_list();
                ?>                
                <?php
            } else {
                if ( has_excerpt() ) {
                    the_excerpt();
                } else {
                    the_content();
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