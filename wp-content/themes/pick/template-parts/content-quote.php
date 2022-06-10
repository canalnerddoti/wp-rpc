<?php
/**
 * The template for displaying quote post formats
 *
 * Used for both single and index/archive/search.
 *
 * @package Pick
 */
    $softhopper_pick = get_option('softhopper_pick');
    $meta = get_post_meta( $post->ID );

    // check list or grid post layout
    pick_theme_post_grid_list_class();
    global $post_layout;
?>
<div class="<?php echo esc_attr( $post_layout ); ?>">
    <article id="post-<?php the_ID(); ?>" <?php post_class('format-quote'); ?>>
        <h2 class="entry-title">Some hide content</h2>
        <header class="entry-header">
            <div class="post-format">
                <?php
                esc_html_e('In Quote','pick'); 
                ?>
            </div>
        </header> <!-- /.entry-header -->
        <div class="quote-content">
            <div class="quote-icon">
                <?php
                    if ( is_single() ) {
                        ?>
                        <i class="fa fa-quote-left"></i>
                        <?php
                    } else {
                        ?>
                        <a href="<?php the_permalink(); ?>"><i class="fa fa-quote-left"></i></a>
                        <?php
                    }
                ?>
            </div>
            <blockquote>
                <span class="screen-reader-text"></span>
                <p>
                <?php             
                    $allowed_html_array = array(
                        'br' => array(),
                        'em' => array(),
                        'strong' => array(),
                    );
                    
                    if( isset ( $meta["_pick_theme_format_quote"][0] ) ) echo wp_kses( $meta["_pick_theme_format_quote"][0], $allowed_html_array );
                ?>
                </p>

                <footer class="author">
                    <?php
                    if ( isset ( $meta["_pick_theme_format_quote_author"][0] ) ) :
                        if( isset ( $meta["_pick_theme_format_quote_url"][0] ) ) {
                            ?>                           
                                <a href="<?php if( isset ( $meta["_pick_theme_format_quote_url"][0] ) ) echo esc_url($meta["_pick_theme_format_quote_url"][0]); ?>"><?php if( isset ( $meta["_pick_theme_format_quote_author"][0] ) ) echo esc_html($meta["_pick_theme_format_quote_author"][0]); ?></a>
                            <?php
                            } else {
                            ?>                        
                            <?php if( isset ( $meta["_pick_theme_format_quote_author"][0] ) ) echo esc_html($meta["_pick_theme_format_quote_author"][0]); ?>
                            <?php
                            } 
                    endif;
                    ?>
                </footer> <!-- /.author -->
            </blockquote> <!-- /.quote-content -->
        </div> <!-- /.quote-content -->
    </article> <!-- /.post-->
</div> <!-- /.col-md-12 -->