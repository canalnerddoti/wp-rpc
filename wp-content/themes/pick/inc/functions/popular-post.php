<?php
function softhopper_set_post_views($postID) {
    $count_key = 'softhopper_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ( $count == '' ){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);


function softhopper_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;    
    }
    softhopper_set_post_views($post_id);
}
add_action( 'wp_head', 'softhopper_track_post_views');

function softhopper_get_post_views($postID){
    $count_key = 'softhopper_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if( $count == 0 ) {
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return esc_html__('0 View','pick');
    }
    return $count.esc_html__(' Views','pick');
}