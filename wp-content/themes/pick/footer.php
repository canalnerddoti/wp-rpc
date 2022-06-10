<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Pick
 */
    $softhopper_pick = get_option('softhopper_pick');
?>
    <!-- Footer
    ================================================== --> 
    <footer id="colophon" class="site-footer">
        <?php if (class_exists('Pick_Instagram_Section') && $softhopper_pick['footer_widgets_top'] == 1 ) : ?>
        <div id="footer-top">
            <div class="container-fluid">
                <div class="row">                
                    <?php new Pick_Instagram_Section; ?>
                </div>
            </div>
        </div> <!-- #footer-top" -->
        <?php endif; ?>
        
        <?php if ( $softhopper_pick['footer_widgets'] == 1 ) : ?>
        <div id="footer-middle">
            <div class="container">
                <div class="row">
                    <?php
                        // show footer widget with condition
                        $columns = intval( $softhopper_pick['footer_widget_columns'] );
                        $col_class = 12 / max( 1, $columns );
                        $col_class_sm = 12 / max( 1, $columns );
                        if ( $columns == 4 ) {
                            $col_class_sm = 6;
                        } 
                        $col_class = "col-sm-$col_class_sm col-md-$col_class";
                        for ( $i = 1; $i <= $columns ; $i++ ) {
                            if ( $columns == 3 ) :
                                if ( $i == 3 ) {
                                    $col_class = "col-sm-12 col-md-$col_class";
                                } else {
                                    $col_class = "col-sm-6 col-md-$col_class";
                                } 
                            endif; 
                        ?>
                            <div class="widget-area footer-sidebar-<?php echo esc_attr($i); ?> <?php echo esc_attr( $col_class ) ?>">
                                <?php dynamic_sidebar( esc_html__( 'Footer ', 'pick' ) . $i ) ?>
                            </div>
                        <?php
                        }
                    ?>
                </div> <!-- /.row -->
            </div> <!-- /.container -->         
        </div> <!-- #footer-middle -->
        <?php endif; ?>

        <div id="footer-bottom">
            <div class="container">
                <div class="copyright">
                    <?php 
                    $allowed_html_array = array(
                        'a' => array(
                            'href' => array(),
                            'title' => array()
                        ),
                        'span' => array(),
                        'em' => array(),
                        'strong' => array(),
                    );
                        if ( isset ( $softhopper_pick['footer_copyright_info'] ) ) echo wp_kses( $softhopper_pick['footer_copyright_info'], $allowed_html_array );
                    ?>     
                </div> <!-- /.copyright -->
            </div> <!-- /.container -->
        </div> <!-- /#footer-bottom -->

    </footer><!-- #colophon -->
    <?php wp_footer(); ?>
    </body>
</html>