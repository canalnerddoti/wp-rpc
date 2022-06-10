<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Pick
 */
?>
<?php 
    get_header(); 
    $softhopper_pick = get_option('softhopper_pick');
?>
<!-- Content
================================================== -->
<div id="content" class="site-content error-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-7">
                        <div class="error-image clearfix">
                            <img src="<?php if ( isset ( $softhopper_pick['404_img']['url'] ) ) echo esc_url($softhopper_pick['404_img']['url']); ?>" alt="<?php esc_html_e('404', 'pick'); ?>" class="img-responsive">
                        </div> <!-- /.error-image -->    
                    </div>
                    <div class="col-md-5">
                        <!-- Error Page Search Part -->
                        <div class="error-search">                        
                            <div class="search">
                                <?php get_search_form(); ?>                               
                            </div> <!-- /.search -->

                            <div class="goto-button">                
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="go-to">
                                    <span class="go-button"><?php esc_html_e( 'Go to Homepage', 'pick' ) ?></span>
                                </a>
                                <?php 
                                    //get contact page template url by template slug
                                    $pages = get_pages(array(
                                        'meta_key' => '_wp_page_template',
                                        'meta_value' => 'contact-page.php'
                                    ));
                                    $contact_page_url = '';
                                    foreach($pages as $page){
                                        $contact_page_url = $page->ID;
                                    }
                                    ( !empty($contact_page_url) ) ? $contact_page_url  = get_permalink( $contact_page_url ) : $contact_page_url = "#";
                                ?>
                                <a href="<?php echo esc_url($contact_page_url); ?>" class="go-to">
                                    <span class="go-button"><?php esc_html_e( 'Contact', 'pick' ) ?></span>
                                </a>
                            </div> <!-- /.goto-button --> 
                        </div> <!-- /.error-search -->   
                    </div> <!-- /.col-md-5 -->
                </div> <!-- /.row -->
            </div> <!-- /.col-md-12 --> 
        </div> <!-- /.row -->

    </div> <!-- /.container -->
    
</div><!-- #content -->
<?php get_footer(); ?>