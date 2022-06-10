<?php

function pick_theme_hex_2_rgba($color, $opacity = false) {
     $default = 'rgb(0,0,0)';
    //Return default if no color provided
    if(empty($color))
          return $default; 
 
    //Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
 
        //Check if opacity is set(rgba or rgb)
        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
}

function pick_theme_color_scheme() { 
  $softhopper_pick = get_option('softhopper_pick');
    switch( $softhopper_pick['pick_theme_color_scheme'] ) {
        case 1: //C69F73

            // add a condition to show demo color scheme by url
            ( isset($_GET["color_scheme_color"]) ) ? $color_scheme_color = $_GET["color_scheme_color"]  : $color_scheme_color = "" ;
            if (preg_match('/^[A-Z0-9]{6}$/i', $color_scheme_color)) {
              $demo_color_scheme = $_GET['color_scheme_color'];
            }
            else {
               $demo_color_scheme = "ddbe86";
            }
            $softhopper_pick_theme_color_scheme = "#".$demo_color_scheme;
            
            break;
        case 2: //1ABC9C
            $softhopper_pick_theme_color_scheme = "#1ABC9C";
            break;
        case 3: //D2527F
            $softhopper_pick_theme_color_scheme = "#D2527F";
            break;
        case 4: //F26D7E
            $softhopper_pick_theme_color_scheme = "#F26D7E";
            break;
        case 5: //CC6054
            $softhopper_pick_theme_color_scheme = "#CC6054";
            break;
        case 6: //667A61
            $softhopper_pick_theme_color_scheme = "#667A61";
            break;
        case 7: //A74C5B
            $softhopper_pick_theme_color_scheme = "#A74C5B";
            break;
        case 8: //95A5A6
            $softhopper_pick_theme_color_scheme = "#95A5A6";
            break;
        case 9: //turquoise
            $softhopper_pick_theme_color_scheme = $softhopper_pick['pick_theme_custom_color'];
            break;
        default:
            $softhopper_pick_theme_color_scheme = "#ddbe86";
            break;
    }
    //rgba color
    $softhopper_pick_theme_rgba = pick_theme_hex_2_rgba($softhopper_pick_theme_color_scheme, 0.8);    
?>
<style type="text/css">
::-moz-selection{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}::selection{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}a:hover,a:focus,a:active{color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}blockquote:before{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.border{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.btn-search{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.btn-search:focus,.btn-search:active:focus{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.comment-reply-link:hover{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.comment-reply-link:focus,.comment-reply-link:active:focus{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.more-link::after{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.current-menu-ancestor > a,.current-menu-parent > a,.current-menu-item > a{color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?> !important}.current-menu-ancestor .current-menu-item > a{color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?> !important}.current-menu-ancestor.current-menu-parent > a{color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?> !important}.current-menu-ancestor .current-menu-ancestor > a{color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?> !important}.owl-theme .owl-controls .owl-page span{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.entry-meta .entry-date::before,.entry-meta .author::before,.entry-meta .cat-links::before,.content-area .entry-footer .comments-link::before,.content-area .entry-footer .view-link::before,.content-area .entry-footer .share-button::before{color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.feature-area #featured-item .entry-title span{color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.feature-area #featured-item .owl-controls .owl-dot span{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.content-area .sticky-icon{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.navigation .nav-links > li.active a,.navigation .nav-links > li.active span{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>;border-color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.navigation .nav-links > li a:hover{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>;border-color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.navigation .nav-links li:first-child.nav-previous a:hover,.navigation .nav-links li:last-child.nav-next a:hover{color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.navigation > li.active a,.navigation > li.active span{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>;border-color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.navigation .nav-previous > a::after{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.navigation .nav-next > a::after{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.follow-us-area .follow-link .fa:hover{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>;border-color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.latest-item-meta a,.popular-item-meta a{color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.widget_categories li:hover > a,.widget_archive li:hover > a{color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.widget_categories li:hover > .count,.widget_archive li:hover > .count{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.widget_categories li.current-cat > a,.widget_categories li.current-cat-parent > a,.widget_archive li.current-cat > a,.widget_archive li.current-cat-parent > a{color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.widget_categories li.current-cat > .count,.widget_categories li.current-cat-parent > .count,.widget_archive li.current-cat > .count,.widget_archive li.current-cat-parent > .count{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.widget_tag_cloud .tagcloud a:hover{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>;border-color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.widget_calendar caption{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.widget_calendar tbody a{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.widget_links li a:hover,.widget_meta li a:hover,.widget_nav_menu li a:hover,.widget_pages li a:hover,.widget_recent_comments li a:hover,.widget_recent_entries li a:hover{color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.widget_links li span:hover:before,.widget_meta li span:hover:before,.widget_nav_menu li span:hover:before,.widget_pages li span:hover:before,.widget_recent_comments li span:hover:before,.widget_recent_entries li span:hover:before{color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.newsletter-area .form-newsletter #mc-embedded-subscribe:after{background:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.newsletter-area .form-newsletter #mc-embedded-subscribe:hover,.newsletter-area .form-newsletter #mc-embedded-subscribe:focus,.newsletter-area .form-newsletter #mc-embedded-subscribe:active:focus{color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.pick-theme-login-board .right-details strong,.pick-theme-login-board .fa{color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.comment-navigation .nav-links .nav-previous a:hover,.comment-navigation .nav-links .nav-next a:hover {color:<?php echo esc_attr($softhopper_pick_theme_color_scheme);?> !important}.go-button:hover {background: <?php echo esc_attr($softhopper_pick_theme_color_scheme);?>}.entry-content .tag > a:hover {background: <?php echo esc_attr($softhopper_pick_theme_color_scheme);?>;border-color: <?php echo esc_attr($softhopper_pick_theme_color_scheme);?>;}.entry-content p > a {color: <?php echo esc_attr($softhopper_pick_theme_color_scheme);?>;} .feat-bottom-ctn .entry-category { color: <?php echo esc_attr($softhopper_pick_theme_color_scheme);?>;  }
</style>
<?php
} // end pick_theme_color_scheme function
pick_theme_color_scheme(); // here print the function
