<?php
/**
 * The template for displaying author info 
 *
 * Used for both single and author page.
 *
 * @package Pick
 */
$softhopper_pick = get_option('softhopper_pick');
?>
<?php if ( $softhopper_pick['author_info_box'] ) : ?>
<!-- author-info -->
<div class="author-info">
        <div id="author-img">
            <figure class="at-img">
                <?php echo get_avatar( get_the_author_meta('email') , 110 ); ?>
            </figure>  
        </div> <!-- /#author-img -->
        
        <div id="author-details">
            <h3 class="author-name"><?php the_author(); ?></h3>
            <h4 class="authors-title"><?php the_author_meta('_pick_theme_user_author_position'); ?></h4>
            <div class="authors-bio">
                <p><?php the_author_meta('description'); ?></p>
            </div>
        </div> <!-- /#author-details -->

        <footer id="author-footer">
            <div class="post-count">
                <b><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                <?php 
                    the_author_posts();
                    echo ( get_the_author_posts() > 1 ) ? esc_html__( ' Total Posts', 'pick' ) : esc_html__( ' Total Post', 'pick' );
                ?> </a></b>
            </div> <!-- /.post-count -->

            <div class="authors-social">                
                <?php 
                    $social_links = get_the_author_meta('_pick_theme_user_social_link'); 
                    if ( !empty ( $social_links ) ) : 
                        echo "<b>".esc_html__( 'Follow Me', 'pick' )."</b>"; 
                        foreach ($social_links as $key => $value) {
                            echo "<a href=\"{$value['social_url']}\"><i class=\"fa {$value['social_icon']}\"></i></a>";
                        } // end foreach
                    endif;
                ?>
            </div> 
        </footer>  <!-- /#author-footer -->                
</div> <!-- /.author-info -->
<?php endif; ?>