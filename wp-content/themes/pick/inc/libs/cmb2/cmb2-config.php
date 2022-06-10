<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'pick_theme_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */
/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 object $cmb CMB2 object
 *
 * @return bool             True if metabox should show
 */
function pick_theme_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's the front page template
	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field object $field Field object
 *
 * @return bool                     True if metabox should show
 */
function pick_theme_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array             $field_args Array of field parameters
 * @param  CMB2_Field object $field      Field object
 */
function pick_theme_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

add_action( 'cmb2_init', 'pick_theme_register_demo_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
 */
function pick_theme_register_demo_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_pick_theme_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_post_format = new_cmb2_box( array(
		'id'            => $prefix . 'post_format_details',
		'title'         => esc_html__( 'Format Details', 'pick' ),
		'object_types'  => array( 'page', 'post' ), // Post type
		//'show_on_cb'    => 'pick_theme_show_if_front_page', // function should return a bool value
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );
	$cmb_post_format->add_field( array(
	    'name'    => 'Gallery Style',
	    'id'      => $prefix . 'gallery_style',
	    'desc'      => esc_html__('You can change gallery style from here', 'pick' ),
	    'type'    => 'radio_inline',
	    'row_classes'   => 'gallery radio-img',
	    'default'   => 'gallery-one',
	    'options' => array(
	        'gallery-one' => '<img src="'.get_template_directory_uri() . '/images/backend/meta-box/gallery-one.jpg">',
	        'gallery-two'   => '<img src="'.get_template_directory_uri() . '/images/backend/meta-box/gallery-two.jpg">',
	        'gallery-three'   => '<img src="'.get_template_directory_uri() . '/images/backend/meta-box/gallery-three.jpg">',
	    ),
	) );
	$cmb_post_format->add_field( array(
        'name' => esc_html__('Add your gallery images', 'pick' ),
        'desc' => esc_html__('Image size should 750x338', 'pick' ),
        'id' => $prefix . 'format_gallery',
        'type' => 'file_list',
        'row_classes'   => 'gallery',
        'preview_size' => array( 100, 100 ),
    ) );
    $cmb_post_format->add_field( array(
		'name' => esc_html__( 'Audio background for self hosted', 'pick' ),
		'id'   => $prefix . 'format_audio_bg_img',
		'type' => 'file',
		'row_classes'   => 'audio',
	) );
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'Upload Audio File', 'pick' ),
		'desc' => esc_html__('file format should Mp3, Ogg or M4a', 'pick' ),
		'id'   => $prefix . 'format_audio_file',
		'type' => 'file',
		'row_classes'   => 'audio',
	) );
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'OR', 'pick' ),
		'id'   => $prefix . 'format_audio_title',
		'type' => 'title',
		'row_classes'   => 'audio',
	) );
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'SoundCloud URL', 'pick' ),
		'id'   => $prefix . 'format_audio_soundcloud',
		'type' => 'text',
		'row_classes'   => 'audio',
	) );
    $cmb_post_format->add_field( array(
		'name' => esc_html__( 'Video embed code', 'pick' ),
		'id'   => $prefix . 'format_embed_code',
		'type' => 'textarea_code',
		'row_classes'   => 'video',
	) ); 
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'Youtube / Vimeo / Dailymotion Video Url', 'pick' ),
		'id'   => $prefix . 'format_video_url',
		'type' => 'text',
		'row_classes'   => 'video',
	) );
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'Or Self Hosted Video', 'pick' ),
		'id'   => $prefix . 'format_video_title',
		'type' => 'title',
		'row_classes'   => 'video',
	) );
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'Upload Video File', 'pick' ),
		'desc' => esc_html__('file format should Mp4, Ogv or Mov', 'pick' ),
		'id'   => $prefix . 'format_video_file',
		'type' => 'file',
		'row_classes'   => 'video',
	) );
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'Quote', 'pick' ),
		'id'   => $prefix . 'format_quote',
		'type' => 'textarea_small',
		'row_classes'   => 'quote',
	) );
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'Author', 'pick' ),
		'id'   => $prefix . 'format_quote_author',
		'type' => 'text',
		'row_classes'   => 'quote',
	) );
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'URL', 'pick' ),
		'id'   => $prefix . 'format_quote_url',
		'type' => 'text',
		'row_classes'   => 'quote',
	) );
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'Status Background Image', 'pick' ),
		'id'   => $prefix . 'format_status_bg',
		'type' => 'file',
		'row_classes'   => 'status',
	) );
	$cmb_post_format->add_field( array(
	    'name'             => esc_html__( 'Select Status Type', 'pick' ),
	    'id'   => $prefix . 'format_status_type',
	    'row_classes'   => 'status',
	    'type'             => 'select',
	    'show_option_none' => true,
	    'default'          => 'none',
	    'options'          => array(
	        'facebook' => esc_html__( 'Facebook', 'pick' ),
	        'twitter'   => esc_html__( 'Twitter', 'pick' ),
	        'gplus'     => esc_html__( 'Google Plus', 'pick' ),
	        'instagram'  => esc_html__( 'Instagram', 'pick' ),
	    ),
	) );
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'Facebook Status URL', 'pick' ),
		'id'   => $prefix . 'format_status_fb',
		'type' => 'text',
	) );
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'Twitter Status URL', 'pick' ),
		'id'   => $prefix . 'format_status_twitter',
		'type' => 'text',
	) );
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'Google Plus Status URL', 'pick' ),
		'id'   => $prefix . 'format_status_gplus',
		'type' => 'text',
	) );
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'Instagram Status Embed Code', 'pick' ),
		'id'   => $prefix . 'format_status_instagram',
		'type' => 'textarea_code',
	) );
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'Link Background', 'pick' ),
		'id'   => $prefix . 'format_link_bg_img',
		'type' => 'file',
	) );
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'Link', 'pick' ),
		'id'   => $prefix . 'format_link',
		'type' => 'text',
		'default' => '',
	) );
	$cmb_post_format->add_field( array(
		'name' => esc_html__( 'Text', 'pick' ),
		'id'   => $prefix . 'format_link_text',
		'type' => 'text',
	) );

	$cmb_display_settings = new_cmb2_box( array(
		'id'            => $prefix . 'display_settings',
		'title'         => esc_html__( 'Display Settings', 'pick' ),
		'object_types'  => array( 'page', 'post' ), // Post type
		//'show_on_cb'    => 'pick_theme_show_if_front_page', // function should return a bool value
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
	) );
	$cmb_display_settings->add_field( array(
	    'name'    => 'Custom Layout',
	    'id'      => $prefix . 'custom_layout',
	    'type'    => 'checkbox',
	    'default'   => false,
	) );
	$cmb_display_settings->add_field( array(
	    'name'    => 'Layout',
	    'id'      => $prefix . 'layout',
	    'row_classes'   => 'radio-img',
	    'desc'      => esc_html__('You can change layout', 'pick' ),
	    'type'    => 'radio_inline',
	    'default'   => 'content-sidebar',
	    'options' => array(
	        'full-content' => '<img src="'.get_template_directory_uri() . '/images/backend/sidebars/empty.png'.'">',
	        'sidebar-content'   => '<img src="'.get_template_directory_uri() . '/images/backend/sidebars/single-left.png'.'">',
	        'content-sidebar'   => '<img src="'.get_template_directory_uri() . '/images/backend/sidebars/single-right.png'.'">',	        
	    ),
	) );
	$cmb_display_settings->add_field( array(
		'name' => esc_html__( 'Custom CSS', 'pick' ),
		'desc' => esc_html__( 'Write your custom CSS code here without &lt;style&gt; &lt;/style&gt; tag block', 'pick' ),
		'id'   => $prefix . 'custom_css',
		'type' => 'textarea_code',
	) ); 
	$cmb_display_settings->add_field( array(
		'name' => esc_html__( 'Custom JS', 'pick' ),
		'desc' => esc_html__( 'Write your custom JS code here without &lt;script&gt; &lt;/script&gt; tag block', 'pick' ),
		'id'   => $prefix . 'custom_js',
		'type' => 'textarea_code',
	) ); 

}


add_action( 'cmb2_init', 'pick_theme_register_user_profile_metabox',6 );
/**
 * Hook in and add a metabox to add fields to the user profile pages
 */
function pick_theme_register_user_profile_metabox() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_pick_theme_user_';
	/**
	 * Metabox for the user profile screen
	 */
	$cmb_user = new_cmb2_box( array(
		'id'               => $prefix . 'edit',
		'title'            => esc_html__( 'User Profile Metabox', 'pick' ),
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );

	$cmb_user->add_field( array(
		'name'     => esc_html__( 'Extra Info', 'pick' ),
		'id'       => $prefix . 'extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );
	
	$cmb_user->add_field( array(
		'name' => esc_html__( 'Author Position', 'pick' ),
		'desc' => esc_html__( 'This info will show in post author theme area', 'pick' ),
		'id'   => $prefix . 'author_position',
		'type' => 'text',
	) );

	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
	$group_field_id = $cmb_user->add_field( array(
		'id'          => $prefix . 'social_link',
		'type'        => 'group',
		'options'     => array(
			'group_title'   => esc_html__( 'Social Link {#}', 'pick' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add New Social Link', 'pick' ),
			'remove_button' => esc_html__( 'Remove Social Link', 'pick' ),
			'sortable'      => true, // beta
		),
	) );
	$cmb_user->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Font awesome icon class', 'pick' ),
		'id'         => 'social_icon',
		'type'       => 'text',
	) );

	$cmb_user->add_group_field( $group_field_id, array(
		'name'       => esc_html__( 'Social link url', 'pick' ),
		'id'         => 'social_url',
		'type'       => 'text',
	) );
}
