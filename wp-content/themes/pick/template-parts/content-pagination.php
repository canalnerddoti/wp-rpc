<?php
/**
 * The template for displaying previous next pagination link
 *
 * Used for both single and page.
 *
 * @package Pick
 */
?>
<?php if ( get_previous_post() || get_next_post() ) :
    ( get_previous_post() && get_next_post() == true ) ? $no_next = "" : $no_next = "no-next-link";
?>
 
    <nav class="post-navigation clearfix <?php echo esc_attr($no_next); ?>">
        <?php
            $previous_post = get_previous_post();
            $next_post = get_next_post();

            if ( !is_page() ) {
            ?>           
            <?php if ( get_previous_post() ) { ?>
                <div class="post-previous">
                    <?php previous_post_link('%link','<i class="fa fa-angle-double-left"></i> <h3> <span>'.esc_html__('Previous Post', 'pick').'</span>'.get_the_title( $previous_post->ID ).'</h3>'); ?>
                </div>
            <?php } ?> 

            <?php if ( get_next_post() ) { ?>
                <div class="post-next">
                    <?php next_post_link('%link', '<i class="fa fa-angle-double-right"></i> <h3> <span>'.esc_html__('Next Post', 'pick').'</span>'.get_the_title( $next_post->ID ).'</h3>'); ?>
                </div>       
            <?php } ?> 

            <?php
            } else {
            ?>           
            <?php if ( get_previous_post() ) { ?>
                <div class="post-previous">
                    <?php previous_post_link('%link','<i class="fa fa-angle-double-left"></i> <h3> <span>'.esc_html__('Previous Page', 'pick').'</span>'.get_the_title( $previous_post->ID ).'</h3>'); ?>
                </div>
            <?php } ?> 

            <?php if ( get_next_post() ) { ?>
                <div class="post-next">
                    <?php next_post_link('%link', '<i class="fa fa-angle-double-right"></i> <h3> <span>'.esc_html__('Next Page', 'pick').'</span>'.get_the_title( $next_post->ID ).'</h3>'); ?>
                </div>       
            <?php } ?> 

            <?php
            } 
        ?>        
    </nav> <!-- /.post-navigation -->
<?php endif; ?>