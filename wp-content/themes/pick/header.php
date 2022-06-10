<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Pick
 */
?>
<?php
    $softhopper_pick = get_option('softhopper_pick');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php        
        // Site Preloader
        $preloader = "";
        ( isset($_GET["site_preloader"]) ) ? $site_preloader = $_GET["site_preloader"]  : $site_preloader = "" ;
        ( $site_preloader == "on" ) ? $preloader = true : $preloader = $softhopper_pick['preloader'];
        if ( $preloader ) {
        ?>
        <!-- Preloader -->
        <div class="preloader">
            <div class="preloader-logo">
                <img src="<?php if ( isset( $softhopper_pick['preloader_logo']['url'] ) ) echo esc_url($softhopper_pick['preloader_logo']['url']); ?>" class="img-responsive" alt="preloader">
            </div> <!-- /.preloader-logo -->
            <div class="loader">
                <?php 
                    $animated_icon = "";
                    if ( $softhopper_pick['preloader_animated_icon'] == 1 ) {
                        $animated_icon = "fa-spinner fa-pulse";
                    } elseif ( $softhopper_pick['preloader_animated_icon'] == 2 ) {
                        $animated_icon = "fa-spinner fa-spin";
                    } elseif ( $softhopper_pick['preloader_animated_icon'] == 3 ) {
                        $animated_icon = "fa-circle-o-notch fa-spin";
                    } elseif ( $softhopper_pick['preloader_animated_icon'] == 4 ) {
                        $animated_icon = "fa-refresh fa-spin";
                    } elseif ( $softhopper_pick['preloader_animated_icon'] == 5 ) {
                        $animated_icon = "fa-cog fa-spin";
                    } 
                ?>
                <i class="fa <?php if ( isset( $animated_icon ) ) echo esc_attr($animated_icon); ?>"></i>
            </div> <!-- /.loader -->
        </div> <!-- /.preloader -->
        <?php
        }
    ?>
    
    <!-- Search Area -->
    <!-- ========================= -->
    <div id="search-screen">
        <div class="search-close"></div>
        <div class="container">
            <div class="text-center search-head">
                <h3><?php esc_html_e( 'Looking for something?', 'pick' ); ?></h3>
            </div>
            <div class="search default">
                <form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form" method="get">
                    <div class="input-group">
                        <input type="search" name="s" data-swplive="true" data-swpengine="default" data-swpconfig="default" placeholder="<?php esc_html_e( 'Search here &hellip;', 'pick' ); ?>" class="form-controller" autocomplete="off">
                        <?php if ( $softhopper_pick['search_only_form_post'] == 1 ) : ?>
                            <input type="hidden" value="post" name="post_type" id="post_type">
                        <?php endif; ?>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>
        </div>    
    </div> <!-- #search-screen -->
    
    <!-- Header Start Here -->
    <!-- ========================= -->
    <header class="site-header" id="masthead">
        <div class="site-header" style="background-image:url(<?php if ( isset( $softhopper_pick['header_bg_img']['url'] ) ) echo esc_url($softhopper_pick['header_bg_img']['url']); ?>); background-color: <?php if ( isset( $softhopper_pick['header_bg_color'] ) ) echo esc_attr($softhopper_pick['header_bg_color']); ?> ;">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="site-branding">
                        
                            <?php if ($softhopper_pick['header_logo_display'] == true) {
                                if (!empty($softhopper_pick['header_logo']['url'])):
                                ?>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home"><img src="<?php if ( isset( $softhopper_pick['header_logo']['url'] ) ) echo esc_url($softhopper_pick['header_logo']['url']); ?>" alt="<?php echo bloginfo('name'); ?>"></a>
                                <?php 
                                endif;
                            } else { ?>
                            <h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
                            <p class="site-description"><?php echo bloginfo( 'description' ); ?></p>
                            <?php } ?>
                           
                        </div> <!-- /site-branding -->
                    </div> <!-- / col-md-12 -->
                </div> <!-- / Row -->
            </div> <!-- / container -->
        </div> <!-- /site-header -->

         <!-- Menu -->
        <div class="menucontent overlapblackbg"></div>
        <div class="menuexpandermain slideRight">
            <a id="navToggle" class="animated-arrow slideLeft"><span></span></a>
            <span id="menu-marker"><?php esc_html_e('Menu', 'pick'); ?></span>
        </div>
        <nav class="top-menu slideLeft clearfix">
            <div class="container">
                <div class="row d-flex-header">
                    <div class="menu-wrapper"> 
                        <?php
                            wp_nav_menu( array(
                                'theme_location'    => 'main-menu',
                                'depth'             =>  0,
                                'menu_class'        => 'mobile-sub menu-list',
                                'container'         => '',
                                'fallback_cb'       => 'Pick_Theme_Nav_Walker::fallback',
                                'walker'            => new Pick_Theme_Nav_Walker()
                                )
                            );
                        ?> 
                    </div> <!-- /.menu-wrapper -->
                                
                    <!-- social search aria -->
                    <div class="social-search">
                        <div class="top-social">
                            <?php
                                // show main menu right social link
                                if ( isset ( $softhopper_pick['main_menu_right_social_link'] )  && ! empty ( $softhopper_pick['main_menu_right_social_link']) ) {
                                    $social_link = $softhopper_pick['main_menu_right_social_link'];                      
                                    foreach ( $social_link as $key => $value ) {
                                    if ( $value['title'] ) {
                                    ?>
                                    <a target="_blank" href="<?php echo esc_url($value['url']); ?>"><i class="fa <?php echo esc_attr($value['title']);?>"></i></a>
                                    <?php
                                        }
                                    }
                                }
                            ?> 
                        </div> <!-- / .top-social -->

                        <div id="top-search">
                            <button type="button" id="search-btn" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div> <!-- /.top-search -->
                    </div> <!-- /.social-search -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
            
        </nav> <!-- /.menu  -->
    </header> <!-- Header End -->