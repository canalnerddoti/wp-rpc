<?php
/**
 * Template Name: About Me
 */
?>
<?php 
    get_header();
    $softhopper_pick = get_option('softhopper_pick');
?>
<!-- Content Section 
===================================== -->
<div id="content" class="site-content">
    <div class="container">
        <div id="primary" class="content-area">
            <main id="main" class="about-me">
                <div class="row">
                    <div class="col-md-12">   
                        <div class="header-title">
                            <h2 class="section-title"><span><?php the_title(); ?></span></h2>
                            <span class="ex-small-border"></span>
                        </div> <!-- /.header-title -->  

                        <div class="row">
                            <div class="col-md-8">
                                <!-- Author image -->
                                <figure class="author-image" id="author-image-bg">
                                    <img class="img-responsive" src="<?php if ( isset ( $softhopper_pick['author_img']['url'] ) ) echo esc_url($softhopper_pick['author_img']['url']); ?>" alt="<?php esc_html_e('Author Img', 'pick'); ?>" >
                                </figure> <!-- /.author-image -->
                            </div> <!-- /.col-md-7 -->  

                            <div class="col-md-4">
                                <div class="author-details">
                                    <h2 class="author-name"> 
                                    <?php 
                                        if ( isset ( $softhopper_pick['author_name'] ) ) echo esc_html($softhopper_pick['author_name']);
                                    ?>
                                    </h2> <!-- /.author-name -->

                                    <div class="entry-content">
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
                                        
                                        if ( isset ( $softhopper_pick['author_description'] ) ) echo wp_kses( $softhopper_pick['author_description'], $allowed_html_array );
                                        ?>
                                    </div> <!-- /.entry-content -->

                                    <footer class="about-footer">
                                       <div class="author-sign">
                                           <img src="<?php if ( isset ( $softhopper_pick['author_sign']['url'] ) ) echo esc_url($softhopper_pick['author_sign']['url']); ?>" alt="<?php esc_html_e('Sign', 'pick'); ?>">
                                            <h3>
                                            <?php 
                                                if ( isset ( $softhopper_pick['author_name'] ) ) echo esc_html($softhopper_pick['author_name']);
                                            ?>
                                            </h3>
                                       </div>
                                       <div class="follow-link">
                                            <span><?php esc_html_e('Follow me:', 'pick' ); ?></span>
                                            <?php
                                                // show social link 
                                                if( isset ( $softhopper_pick['author_social_link'] )  && ! empty ( $softhopper_pick['author_social_link']) ) {
                                                    $social_link = $softhopper_pick['author_social_link'];                      
                                                    foreach ( $social_link as $key => $value ) {
                                                    if ( $value['title'] ) {
                                                        ?>
                                                        <a href="<?php echo esc_url($value['url']); ?>"><i class="fa <?php echo esc_html($value['title']);?>"></i></a>
                                                        <?php
                                                        }
                                                    }
                                                }
                                            ?>       
                                       </div> <!-- /.follow-link -->
                                    </footer> <!-- /.about-footer --> 
                                </div> <!-- /.author-details -->

                                <div class="clear"></div>

                                <div id="author-skill">
                                    <h3 class="skill-heading"><?php esc_html_e('Skill', 'pick' ); ?></h3>
                                    <span class="ex-small-border"></span>
                                    <?php
                                        // show author skill
                                        if( isset ( $softhopper_pick['author_skills'] )  && ! empty ( $softhopper_pick['author_skills']) ) {
                                            $social_link = $softhopper_pick['author_skills'];                      
                                            foreach ( $social_link as $key => $value ) {
                                            if ( $value['title'] ) {
                                        ?>

                                        <div class="skill-one" data-startdegree="10" data-dimension="110" data-text="<?php echo esc_attr($value['url']); ?>%" data-info="<?php echo esc_attr($value['title']);?>" data-width="20" data-fontsize="13" data-percent="<?php echo esc_attr($value['url']); ?>" data-fgcolor="#505050" data-bgcolor="#eee" data-bordersize="4"></div>

                                        <?php
                                                } // end if
                                            } //end foreach
                                        } // end if author_skills
                                    ?>

                                </div> <!-- /#author-skill -->
                            </div> <!-- /.col-md-5 -->  
                        </div> <!-- /.row -->
                    </div> <!-- /.col-md-10 -->
                </div> <!-- /.row -->
            </main> <!-- / Main -->
        </div> <!-- / Row -->
    </div> <!-- / Container -->
</div> <!-- / site-content -->
<?php get_footer(); ?>