<?php
/*
* This template for override wordpress some function to match the theme
*/

/**
 * Get excerpt
 *
 * @since 1.0
 */
if ( ! function_exists( 'pick_excerpt' ) ) {

    function pick_excerpt( $length = 30 ) {
        global $post;

        // Check for custom excerpt
        if ( has_excerpt( $post->ID ) ) {
            $output = $post->post_excerpt;
        }

        // No custom excerpt
        else {
            // Check for more tag and return content if it exists
            if ( strpos( $post->post_content, '<!--more-->' ) ) {
                $output = apply_filters( 'the_content', get_the_content() );
            }

            // No more tag defined
            else {
                $output = wp_trim_words( strip_shortcodes( $post->post_content ), $length );
            }

        }
        return $output;
    }

}  


if ( ! function_exists( 'pick_theme_post_excerpt' ) ) :
// limit words excerpt
//add_filter("the_content", "pick_theme_post_excerpt");
function pick_theme_post_excerpt($text) {
    $softhopper_pick = get_option('softhopper_pick'); 
    global $post;
    $post_format = get_post_format();
    $meta = get_post_meta( $post->ID );
    if ( false === $post_format ) {
        $post_format = "standard";
    }
    
    if ( !is_page() )  {
        if ( !is_single() ) {
            if ( $post_format == "standard" || $post_format == "image" || $post_format == "link") {
                if ( $softhopper_pick['excerpt_status'] == 1 ) {
                    $length = $softhopper_pick['post_excerpt'];
                    if ( is_sticky() ) {
                       $length = $softhopper_pick['post_excerpt_sticky']; 
                    }
                    $words = explode(' ', $text, ($length + 1));
                    if(count($words) > $length) {
                          array_pop($words);
                          ($post_format != "chat")? $hellip = '&hellip;' : $hellip = '' ;
                          return implode(' ', $words).$hellip.'<a href="'.get_the_permalink().'" class="more-link">'.esc_html__( 'Continue Reading',  'pick').'</a>';
                    } else {
                      return implode(' ', $words); 
                    }
                } else {
                    return $text;
                }  
            } else {
                return $text;
            }
        } else {
            return $text;
        }
    } else {
        return $text;
    }
}
endif;

if ( ! function_exists( 'pick_theme_categories_postcount_filter' ) ) :
// remove parentheses from category list and add span class to count
add_filter('wp_list_categories','pick_theme_categories_postcount_filter');
function pick_theme_categories_postcount_filter ($args) {
    $args = str_replace('(', '<span class="count"> ', $args);
    $args = str_replace(')', ' </span>', $args);
   return $args;
}
endif;

if ( ! function_exists( 'pick_theme_archive_count_no_brackets' ) ) :
// remove parentheses from archive list and add span class to count
add_filter('get_archives_link', 'pick_theme_archive_count_no_brackets');
function pick_theme_archive_count_no_brackets($links) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="count">', $links);
    $links = str_replace(')', ' </span>', $links);
    return $links;
}
endif;

if ( ! function_exists( 'pick_theme_remove_redux_menu' ) ) :
/* remove redux framework menu under the tools */
add_action( 'admin_menu', 'pick_theme_remove_redux_menu', 12 );
function pick_theme_remove_redux_menu() {
    remove_submenu_page('tools.php','redux-about');
}
endif;

if ( ! function_exists( 'pick_theme_wp_new_excerpt' ) ) :
// pick rewrite excerpt function
function pick_theme_wp_new_excerpt($text)
{
    $softhopper_pick = get_option('softhopper_pick');
    if ($text == '')
    {
        $text = get_the_content('');
        $text = strip_shortcodes( $text );
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
        //$text = strip_tags($text);
        $text = nl2br($text);
        $length = $softhopper_pick['post_excerpt'];
        if ( is_sticky() ) {
           $length = $softhopper_pick['post_excerpt_sticky']; 
        }
        $excerpt_length = apply_filters('excerpt_length', $length);
        $words = explode(' ', $text, $excerpt_length + 1);
        if (count($words) > $excerpt_length) {
            array_pop($words);
            array_push($words, esc_html__( '&hellip;', 'pick').'<a href="'.get_the_permalink().'" class="more-link">'.esc_html__( 'Continue Reading',  'pick').'</a>');
            $text = implode(' ', $words);
        }
    }
    return $text;
}
//remove_filter('get_the_excerpt', 'wp_trim_excerpt');
//add_filter('get_the_excerpt', 'pick_theme_wp_new_excerpt');
endif;


// Support shortcodes in text widgets
add_filter( 'widget_text', 'do_shortcode' );

if ( ! function_exists( 'pick_theme_custom_post_excerpt' ) ) :
// custom post excerpt with charecter
function pick_theme_custom_post_excerpt($string, $length, $dots = "&hellip;") {
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
}
endif;

if ( ! function_exists( 'pick_theme_custom_string_limit_words' ) ) :
// custom post excerpt with words
function pick_theme_custom_string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}
endif;

if ( ! function_exists( 'pick_theme_var_template_include' ) ) :
// to get current template name
add_filter( 'template_include', 'pick_theme_var_template_include', 1000 );
function pick_theme_var_template_include( $t ){
    $GLOBALS['current_theme_template'] = basename($t);
    return $t;
}
endif;

if ( ! function_exists( 'pick_theme_get_current_template' ) ) :
function pick_theme_get_current_template( $echo = false ) {
    if( !isset( $GLOBALS['current_theme_template'] ) )
        return false;
    if( $echo )
        echo esc_url($GLOBALS['current_theme_template']);
    else
        return $GLOBALS['current_theme_template'];
}
endif;

// remove unnecessary p and br tag from shortcode
if( !function_exists('pick_theme_fix_shortcodes') ) :
    function pick_theme_fix_shortcodes($content){
        $array = array (
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']'
        );
        $content = strtr($content, $array);
        return $content;   
    }
    add_filter('the_content', 'pick_theme_fix_shortcodes');
endif;

