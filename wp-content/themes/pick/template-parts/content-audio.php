<?php
/**
 * The default template for displaying content
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
		 	$meta = get_post_custom($post->ID);
			$soundcloud = isset( $meta["_pick_theme_format_audio_soundcloud"][0] ) ? $meta["_pick_theme_format_audio_soundcloud"][0] : '';
			if( !empty( $soundcloud ) ) {
				?>
				<div class="post-media">						
				<?php
					echo pick_theme_soundcloud( $soundcloud );
				?>
				</div>
				<?php
			} else { ?>
				<div class="post-media">
					<div class="audio-images">
                    <?php
                        pick_theme_cropping_image_size();
                        global $image_size;

                    if ( is_single() ) {
                        $meta = get_post_meta( $post->ID );
                        if ( isset($meta["_pick_theme_custom_layout"][0]) ) {
                            ( $meta["_pick_theme_layout"][0] == 'full-content' ) ? $image_size = "pick-theme-single-full" : $image_size = "pick-theme-single-list" ;
                        } else {
                            ( $softhopper_pick['sidebar_layout_single'] == 1 ) ? $image_size = "pick-theme-single-full" : $image_size = "pick-theme-single-list" ;
                        }
                        if ( isset($meta["_pick_theme_format_audio_bg_img"][0]) ) {
                            echo wp_get_attachment_image( get_post_meta( get_the_ID(), '_pick_theme_format_audio_bg_img_id', 1 ), $image_size );
                        }
                    } else {
                        ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php 
                                if ( isset($meta["_pick_theme_format_audio_bg_img"][0]) ) {
                                    echo wp_get_attachment_image( get_post_meta( get_the_ID(), '_pick_theme_format_audio_bg_img_id', 1 ), $image_size );
                                }
                            ?>
                        </a>
                        <?php
                    }
                    ?>
                    </div>	
                    <?php
                        $audio_file = isset( $meta["_pick_theme_format_audio_file"][0] ) ? $meta["_pick_theme_format_audio_file"][0] : "" ;
                        $format_audio_type = wp_check_filetype($audio_file);
                        $mp3 = ( $format_audio_type['ext'] == "mp3" ) ? $meta["_pick_theme_format_audio_file"][0] : '';
                        $ogg = ( $format_audio_type['ext'] == "ogg" ) ? $meta["_pick_theme_format_audio_file"][0] : '';
                        $m4a = ( $format_audio_type['ext'] == "m4a" ) ? $meta["_pick_theme_format_audio_file"][0] : '';
                        echo '<div class="post-audio-player">'.do_shortcode('[audio mp3="'.$mp3.'" ogg="'.$ogg.'" m4a="'.$m4a.'"]').'</div>';
    				?>
				</div>
			<?php
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