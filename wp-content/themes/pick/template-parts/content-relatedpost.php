<?php
/**
 * The template for displaying related posts in the single page
 *
 * @package Pick
 */
$softhopper_pick = get_option('softhopper_pick'); 
global $post;
?>
<?php if ( $softhopper_pick['related_post'] ) : ?>
<?php
    $query_type = $softhopper_pick['related_query'];
    $related_no = 2;
    if ( $query_type == 'author' ) {
        $args=array('post__not_in' => array($post->ID),'posts_per_page'=> $related_no, 'no_found_rows'=> 1, 'author'=> get_the_author_meta( 'ID' ));
    } elseif ( $query_type == 'tag' ) {
        $tags = wp_get_post_tags($post->ID);
        $tags_ids = array();
        foreach($tags as $individual_tag) $tags_ids[] = $individual_tag->term_id;
        $args=array('post__not_in' => array($post->ID),'posts_per_page'=> $related_no, 'no_found_rows'=> 1, 'tag__in'=> $tags_ids );
    } else {
        $categories = get_the_category($post->ID);
        $category_ids = array();
        foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
        $args=array('post__not_in' => array($post->ID),'posts_per_page'=> $related_no, 'no_found_rows'=> 1, 'category__in'=> $category_ids );
    }       
    
    $my_query = new wp_query( $args );
?>
<?php
    if( $my_query->have_posts() ) :
?>
    <!-- related post -->
    <div class="related-post clearfix">
    <h3 class="related-post-title"><span><?php esc_html_e('Related Post','pick'); ?></span></h3>
        <div class="row">
            <?php
                while( $my_query->have_posts() ) {
                $my_query->the_post();
            ?>
            <div class="col-md-4 col-sm-6">
                <div class="related-post-item">
                    <div class="post-media">
                    <?php
                        $meta = get_post_meta( get_the_ID() );
                        $post_format = get_post_format();
                        if ( false === $post_format ) {
                            $post_format = "standard";
                        }
                        
                        if ( $post_format == "gallery" ) {  
                            // show first image of gallery post
                            if ( isset ( $meta["_pick_theme_format_gallery"][0] ) ) {
                                $images = get_post_meta( get_the_ID(), '_pick_theme_format_gallery', true);
                                if ( $images ) {
                                  $i = 1;
                                  foreach ( $images as $attachment_id => $img_full_url ) {
                                   if ( $i == 2 ) continue;
                                    echo  wp_get_attachment_link($attachment_id, 'pick-theme-related-posts');
                                    $i++;
                                  }
                                }                          
                            }  else {
                                ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_template_directory_uri().'/images/post/no-media-big/gallery.jpg'; ?>" alt="<?php the_title(); ?>"> 
                                    </a>
                                <?php 
                            }
                        } elseif ( $post_format == "audio" ){
                            if( isset($meta["_pick_theme_format_audio_bg_img"][0]) ) {
                                ?>
                                <a href="<?php the_permalink(); ?>">
                                <?php
                                echo wp_get_attachment_image( get_post_meta( get_the_ID(), '_pick_theme_format_audio_bg_img_id', 1 ), 'pick-theme-related-posts' );
                                ?>
                                </a> 
                                <?php
                            } else {
                                ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_template_directory_uri().'/images/post/no-media-big/audio.jpg'; ?>" alt="<?php the_title(); ?>"> 
                                    </a>
                                <?php 
                            }
                        } elseif ( $post_format == "video" ){
                            if ( has_post_thumbnail() ) {
                                ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                            the_post_thumbnail('pick-theme-related-posts', array( 'alt' => get_the_title()));
                                        ?>
                                    </a>
                                <?php
                            } else {
                            ?>
                                    <a href="<?php the_permalink(); ?>">
                                       <img src="<?php echo get_template_directory_uri(); ?>/images/post/no-media-big/video.jpg" alt="<?php the_title(); ?>" />
                                    </a>
                            <?php
                            } //end else
                        } elseif ( $post_format == "quote" ){
                                ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_template_directory_uri().'/images/post/no-media-big/quote.jpg'; ?>" alt="<?php the_title(); ?>"> 
                                    </a>
                                <?php 
                        } elseif ( $post_format == "aside" ){
                                ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_template_directory_uri().'/images/post/no-media-big/aside.jpg'; ?>" alt="<?php the_title(); ?>"> 
                                    </a>
                                <?php 
                        } elseif ( $post_format == "chat" ){
                            if ( has_post_thumbnail() ) {
                                ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                            the_post_thumbnail('pick-theme-related-posts', array( 'alt' => get_the_title()));
                                        ?>
                                    </a>
                                <?php
                            } else {
                            ?>
                                <a href="<?php the_permalink(); ?>">
                                   <img src="<?php echo get_template_directory_uri(); ?>/images/post/no-media-big/chat.jpg" alt="<?php the_title(); ?>" />
                                </a>
                            <?php
                            } //end else
                        } elseif ( $post_format == "link" ){
                            if( isset($meta["_pick_theme_format_link_bg_img"][0]) ) {
                                ?>
                                <a href="<?php the_permalink(); ?>">
                                <?php
                                echo wp_get_attachment_image( get_post_meta( get_the_ID(), '_pick_theme_format_link_bg_img_id', 1 ), 'pick-theme-related-posts' );
                                ?>
                                </a> 
                                <?php
                            } else {
                                ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_template_directory_uri().'/images/post/no-media-big/link.jpg'; ?>" alt="<?php the_title(); ?>"> 
                                    </a>
                                <?php 
                            }
                        } elseif ( $post_format == "status" ){
                            if( isset($meta["_pick_theme_format_status_bg"][0]) ) {
                                ?>
                                <a href="<?php the_permalink(); ?>">
                                <?php
                                echo wp_get_attachment_image( get_post_meta( get_the_ID(), '_pick_theme_format_status_bg_id', 1 ), 'pick-theme-related-posts' );
                                ?>
                                </a> 
                                <?php
                            } else {
                                ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo get_template_directory_uri().'/images/post/no-media-big/status.jpg'; ?>" alt="<?php the_title(); ?>"> 
                                    </a>
                                <?php 
                            }
                        } else {
                            if ( has_post_thumbnail() ) {
                                ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                            the_post_thumbnail('pick-theme-related-posts', array( 'alt' => get_the_title()));
                                        ?>
                                    </a>
                                <?php
                            } else {
                            ?>
                                <a href="<?php the_permalink(); ?>">
                                   <img src="<?php echo get_template_directory_uri(); ?>/images/post/no-media-big/image.jpg" alt="<?php the_title(); ?>" />
                                </a>
                            <?php
                            } //end else
                        } //end else
                    ?>
                    </div> <!-- /.post-media -->
                    <div class="post-body">
                        <div class="entry-date">
                            <?php the_time( get_option( 'date_format' ) ); ?>
                        </div>
                        <?php       
                            the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); 
                        ?>
                    </div>
                </div> <!-- /.related-post-item -->  
            </div> <!-- /.col-md-4 -->           
            <?php   
                } // end while loop
            ?> 
        </div> <!-- /.row -->    
    </div> <!-- /.related-post -->
    <?php 
    endif;  
    wp_reset_postdata();
?> 
<?php endif; ?>