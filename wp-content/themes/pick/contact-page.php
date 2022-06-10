<?php
/**
 * Template Name: Contact Page
 */
?>
<?php 
    get_header();
    $softhopper_pick = get_option('softhopper_pick');
?>
<!-- Content Section 
===================================== -->
<div id="content" class="site-content contact-page">
    <div class="container">
        <div id="primary" class="content-area">
            <main id="main" class="site-main">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">   
                        <div class="header-title">
                            <h2 class="section-title"><span><?php the_title(); ?></span></h2>
                            <span class="ex-small-border"></span>
                        </div> <!-- /.header-title -->  

                        <!-- Maps Area -->
                        <div class="gmaps-area">
                            <div id="gmaps"></div>                                   
                        </div> <!-- /.gmaps-area -->

                        <div class="clear"></div>

                        <div class="entry-content">
                            <p>
                                <?php 
                                    $allowed_html_array = array(
                                        'a' => array(
                                            'href' => array(),
                                            'title' => array()
                                        ),
                                        'br' => array(),
                                        'span' => array(),
                                        'em' => array(),
                                        'strong' => array(),
                                    );
                                    
                                    if ( isset ( $softhopper_pick['contact_description'] ) ) echo wp_kses( $softhopper_pick['contact_description'], $allowed_html_array );
                                ?>
                            </p>
                        </div> <!-- /.entry-content -->  

                        <div class="clear"></div>

                        <div class="row" id="contact-form-wrap">
                            <div class="col-md-12">
                                <div class="contact-respond" id="respond">                            
                                    <?php 
                                        // show contact form by contact form 7 plugin 
                                        if ( isset ( $softhopper_pick['contact_form7_shortcode'] ) ) {
                                            echo do_shortcode($softhopper_pick['contact_form7_shortcode']); 
                                        }
                                    ?>                                                   
                                </div><!-- #respond --> 
                            </div> <!-- /.col-md-12 -->
                        </div> <!-- /.row -->
                    </div> <!-- /.col-md-10 -->
                </div> <!-- /.row -->
            </main> <!-- / Main -->
        </div> <!-- / Row -->
    </div> <!-- / Container -->
</div> <!-- / site-content -->
<?php get_footer(); ?>