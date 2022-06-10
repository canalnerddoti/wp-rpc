<?php
/**
 * The template for displaying post format image if not set image.
 *
 * Used for both single and page.
 *
 * @package Pick
 */
?>
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
                echo wp_get_attachment_link($attachment_id, 'pick-theme-small-img');
                $i++;
              }
            }
        }  else {
            ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo get_template_directory_uri().'/images/post/no-media/gallery.jpg'; ?>" alt="<?php the_title(); ?>"> 
            </a>                            
            <?php 
        }
    } elseif ( $post_format == "audio" ) {
        if( isset($meta["_pick_theme_format_audio_bg_img"][0]) ) {
            ?>
            <a href="<?php the_permalink(); ?>">
            <?php
            echo wp_get_attachment_image( get_post_meta( get_the_ID(), '_pick_theme_format_audio_bg_img_id', 1 ), 'pick-theme-small-img' );
            ?>
            </a> 
            <?php
        } else {
            ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo get_template_directory_uri().'/images/post/no-media/audio.jpg'; ?>" alt="<?php the_title(); ?>">
            </a>                            
            <?php 
        }
    } elseif ( $post_format == "video" ){
        if ( has_post_thumbnail() ) {
            ?>
            <a href="<?php the_permalink(); ?>">
                <?php
                    the_post_thumbnail('pick-theme-small-img', array( 'alt' => get_the_title()));
                ?>
            </a>
            <?php
        } else {
        ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/images/post/no-media/video.jpg" alt="<?php the_title(); ?>" />
            </a>
        <?php
        } //end else
    } elseif ( $post_format == "quote" ){
            ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo get_template_directory_uri().'/images/post/no-media/quote.jpg'; ?>" alt="<?php the_title(); ?>"> 
            </a>                            
            <?php 
    } elseif ( $post_format == "aside" ){
            ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo get_template_directory_uri().'/images/post/no-media/aside.jpg'; ?>" alt="<?php the_title(); ?>"> 
            </a>                            
            <?php 
    } elseif ( $post_format == "chat" ){
        if ( has_post_thumbnail() ) {
            ?>
            <a href="<?php the_permalink(); ?>">
                <?php
                    the_post_thumbnail('pick-theme-small-img', array( 'alt' => get_the_title()));
                ?>
            </a>
            <?php
        } else {
        ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/images/post/no-media/chat.jpg" alt="<?php the_title(); ?>" />
            </a>
        <?php
        } //end else
    } elseif ( $post_format == "link" ){
        if( isset($meta["_pick_theme_format_link_bg_img"][0]) ) {
            ?>
            <a href="<?php the_permalink(); ?>">
            <?php
            echo wp_get_attachment_image( get_post_meta( get_the_ID(), '_pick_theme_format_link_bg_img_id', 1 ), 'pick-theme-small-img' );
            ?>
            </a> 
            <?php
        } else {
            ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo get_template_directory_uri().'/images/post/no-media/link.jpg'; ?>" alt="<?php the_title(); ?>"> 
            </a>                            
            <?php 
        }
    } elseif ( $post_format == "status" ){
        if( isset($meta["_pick_theme_format_status_bg"][0]) ) {
            ?>
            <a href="<?php the_permalink(); ?>">
            <?php
            echo wp_get_attachment_image( get_post_meta( get_the_ID(), '_pick_theme_format_status_bg_id', 1 ), 'pick-theme-small-img' );
            ?>
            </a> 
            <?php
        } else {
            ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo get_template_directory_uri().'/images/post/no-media/status.jpg'; ?>" alt="<?php the_title(); ?>"> 
            </a>                            
            <?php 
        }
    } else {
        if ( has_post_thumbnail() ) {
            ?>
            <a href="<?php the_permalink(); ?>">
                <?php
                    the_post_thumbnail('pick-theme-small-img', array( 'alt' => get_the_title()));
                ?>
            </a>
            <?php
        } else {
        ?>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/images/post/no-media/image.jpg" alt="<?php the_title(); ?>" />
            </a>
        <?php
        } //end else
    } //end else
?> 