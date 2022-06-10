<?php

if ( ! function_exists( 'pick_theme_soundcloud' ) ) :
/*-----------------------------------------------------------------------------------*/
# Soundcloud Function
/*-----------------------------------------------------------------------------------*/
function pick_theme_soundcloud($url , $autoplay = 'false' ) {
    $softhopper_pick = get_option('softhopper_pick'); 
    global $post;
    $color = '';
    switch( $softhopper_pick['pick_theme_color_scheme'] ) {
        case 1: //C69F73
        
            // add a condition to show demo color scheme by url
            ( isset($_GET["color_scheme_color"]) ) ? $color_scheme_color = $_GET["color_scheme_color"]  : $color_scheme_color = "" ;
            if (preg_match('/^[A-Z0-9]{6}$/i', $color_scheme_color)) {
              $demo_color_scheme = $_GET['color_scheme_color'];
            }
            else {
               $demo_color_scheme = "9bc6b2";
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
            $softhopper_pick_theme_color_scheme = "#9bc6b2";
            break;
    }   
    
    if( !empty( $softhopper_pick_theme_color_scheme ) ){
        $softhopper_pick_theme_color_scheme = str_replace ( '#' , '' , $softhopper_pick_theme_color_scheme );
        $color = '&amp;color='.$softhopper_pick_theme_color_scheme;
    }
    return '<iframe style="width:100%" height="166" src="https://w.soundcloud.com/player/?url='.$url.$color.'&amp;auto_play='.$autoplay.'&amp;show_artwork=true"></iframe>';
}
endif;

if ( ! function_exists( 'pick_theme_vedio' ) ) :
/*-----------------------------------------------------------------------------------*/
# Get Post Video  
/*-----------------------------------------------------------------------------------*/
function pick_theme_vedio() {
    global $post;
    $meta = get_post_meta( $post->ID );  
    if( isset( $meta["_pick_theme_format_video_url"][0] ) && !empty( $meta["_pick_theme_format_video_url"][0] ) ) {
        $video_url = $meta["_pick_theme_format_video_url"][0];
        $video_link = @parse_url($video_url);
        if ( $video_link['host'] == 'www.youtube.com' || $video_link['host']  == 'youtube.com' ) {
            parse_str( @parse_url( $video_url, PHP_URL_QUERY ), $my_array_of_vars );
            $video =  $my_array_of_vars['v'] ;
            $video_code ='<iframe width="600" height="325" src="http://www.youtube.com/embed/'.$video.'?rel=0&wmode=opaque" allowfullscreen="allowfullscreen"></iframe>';
        } elseif ( $video_link['host'] == 'www.vimeo.com' || $video_link['host']  == 'vimeo.com' ){
            $video = (int) substr(@parse_url($video_url, PHP_URL_PATH), 1);
            $video_code='<iframe width="600" height="325" src="http://player.vimeo.com/video/'.$video.'" allowfullscreen="allowfullscreen"></iframe>';
        } elseif ( $video_link['host'] == 'www.youtu.be' || $video_link['host']  == 'youtu.be' ){
            $video = substr(@parse_url($video_url, PHP_URL_PATH), 1);
            $video_code ='<iframe width="600" height="325" src="http://www.youtube.com/embed/'.$video.'?rel=0" allowfullscreen="allowfullscreen"></iframe>';
        } elseif ( $video_link['host'] == 'www.dailymotion.com' || $video_link['host']  == 'dailymotion.com' ){
            $video = substr(@parse_url($video_url, PHP_URL_PATH), 7);
            $video_id = strtok($video, '_');
            $video_code='<iframe width="600" height="325" src="http://www.dailymotion.com/embed/video/'.$video_id.'"></iframe>';
        }
    } elseif( isset( $meta["_pick_theme_format_embed_code"][0] ) ) {
        $embed_code = $meta["_pick_theme_format_embed_code"][0];
        $video_code = wp_specialchars_decode( $embed_code); 
    } else { 
        $video_file = isset( $meta["_pick_theme_format_video_file"][0] ) ? $meta["_pick_theme_format_video_file"][0] : "" ;
        $format_video_type = wp_check_filetype($video_file);
        $mp4 = ( $format_video_type['ext'] == "mp4" ) ? $meta["_pick_theme_format_video_file"][0] : '';
        $ogv = ( $format_video_type['ext'] == "ogv" ) ? $meta["_pick_theme_format_video_file"][0] : '';
        $mov = ( $format_video_type['ext'] == "mov" ) ? $meta["_pick_theme_format_video_file"][0] : '';
        $video_code = '<div class="post-video-player">'.do_shortcode('[video mp4="'.$mp4.'" ogv="'.$ogv.'" mov="'.$mov.'"]').'</div>';
    }
    if ( isset($video_code) ) return $video_code;
} // end pick_theme_vedio()
endif;