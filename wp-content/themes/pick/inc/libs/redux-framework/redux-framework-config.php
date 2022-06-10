<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "softhopper_pick";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Pick Setting Options', 'pick' ),
        'page_title'           => esc_html__( 'Pick Setting Options', 'pick' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 100,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'forced_dev_mode_off' => true,
        // To disable tracking
        'disable_tracking' => true,
        // To forcefully disable the dev mode
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => 62,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => esc_html__( 'Documentation', 'pick' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => esc_html__( 'Support', 'pick' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => esc_html__( 'Extensions', 'pick' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/softhopper',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/softhopper',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/softhopperbd',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        //$args['intro_text'] = sprintf( esc_html__( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'pick' ), $v );
    } else {
        //$args['intro_text'] = esc_html__( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'pick' );
    }

    // Add content after the form.
    //$args['footer_text'] = esc_html__( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'pick' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'pick' ),
            'content' => esc_html__( 'This is the tab content, HTML is allowed.', 'pick' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'pick' ),
            'content' => esc_html__( 'This is the tab content, HTML is allowed.', 'pick' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'pick' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*
        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for
     */
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
    // -> START General Options
    Redux::setSection( $opt_name, array(
            'title' => esc_html__('General Options', 'pick' ),
            //'icon_class' => 'fa-lg',
            'icon' => 'el el-cog',
            'fields' => array (    
                array (
                    // this is load because if it not load other slides extension not work
                    'id'          => 'pick_theme_hidden_slides',
                    'type'        => 'slides',
                    'title'       => esc_html__( 'Pick Hidden Slider', 'pick' ),
                ),
                array(
                    'id'=>'preloader',
                    'type' => 'switch',
                    'title' => esc_html__('Site Preloader', 'pick'),
                    'default' => false
                ),
                array(
                    'id'=>'preloader_logo',
                    'type' => 'media',
                    'url'=> true,
                    'required' => array( 'preloader', '=', '1' ),
                    'readonly' => false,
                    'title' => esc_html__('Preloader Logo', 'pick'),
                    'subtitle' => esc_html__('This logo image will show in preloader', 'pick'),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/images/preloader.png'
                    )
                ),  
                array(
                    'id'=>'preloader_logo_retina',
                    'type' => 'media',
                    'url'=> true,
                    'required' => array( 'preloader', '=', '1' ),
                    'readonly' => false,
                    'title' => esc_html__('Preloader logo for retina ', 'pick'),
                    'subtitle' => esc_html__('2x logo size, for screens with high DPI.
                    Use the exact same filename and add @2x after the name. example: preloader@2x.png', 'pick'),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/images/preloader@2x.png'
                    )
                ),
                array(
                    'id'       => 'preloader_animated_icon',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Preloader Animated Icon', 'pick' ),
                    'subtitle' => esc_html__( 'This animated icon will show in preloader', 'pick' ),
                    'required' => array( 'preloader', '=', '1' ),
                    //Must provide key => value pairs for select options
                    'options'  => array(
                        '1' => 'fa-spinner fa-pulse',
                        '2' => 'fa-spinner fa-spin',
                        '3' => 'fa-circle-o-notch fa-spin',
                        '4' => 'fa-refresh fa-spin',
                        '5' => 'fa-cog fa-spin',
                    ),
                    'description' => wp_kses( __( "These animated icon used from font awesome. See demo <a target='_blank' href='http://fortawesome.github.io/Font-Awesome/examples/'>here</a> from Animated Icons List", "pick" ), $allowed_html_array ),
                    'default'  => '1'
                ),
                array(
                    'id'=>'favicon',
                    'type' => 'media',
                    'url'=> true,
                    'readonly' => false,
                    'title' => esc_html__('Favicon', 'pick'),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/images/favicon/favicon.ico'
                    )
                ),
                array(
                    'id'=>'icon_iphone',
                    'type' => 'media',
                    'url'=> true,
                    'readonly' => false,
                    'title' => esc_html__('Apple iPhone Icon', 'pick'),
                    'desc' => esc_html__('Icon for Apple iPhone (57px X 57px)', 'pick'),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/images/favicon/apple-touch-icon.png'
                    )
                ),

                array(
                    'id'=>'icon_iphone_retina',
                    'type' => 'media',
                    'url'=> true,
                    'readonly' => false,
                    'title' => esc_html__('Apple iPhone Retina Icon', 'pick'),
                    'desc' => esc_html__('Icon for Apple iPhone Retina (114px X 114px)', 'pick'),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/images/favicon/apple-touch-icon_114x114.png'
                    )
                ),

                array(
                    'id'=>'icon_ipad',
                    'type' => 'media',
                    'url'=> true,
                    'readonly' => false,
                    'title' => esc_html__('Apple iPad Icon', 'pick'),
                    'desc' => esc_html__('Icon for Apple iPad (72px X 72px)', 'pick'),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/images/favicon/apple-touch-icon_72x72.png'
                    )
                ),

                array(
                    'id'=>'icon_ipad_retina',
                    'type' => 'media',
                    'url'=> true,
                    'readonly' => false,
                    'title' => esc_html__('Apple iPad Retina Icon', 'pick'),
                    'desc' => esc_html__('Icon for Apple iPad Retina (144px X 144px)', 'pick'),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/images/favicon/apple-touch-icon_144x144.png'
                    )
                ),    
                array(
                    'id'       => 'custom_css',
                    'type'     => 'ace_editor',
                    'title'    => esc_html__( 'Custom CSS Code', 'pick' ),
                    'subtitle' => esc_html__( 'Paste your CSS code here.', 'pick' ),
                    'mode'     => 'css',
                    'theme'    => 'monokai',
                    'default'  => "#header {\n   margin: 0 auto;\n}"
                ),
                array(
                    'id'       => 'custom_js',
                    'type'     => 'ace_editor',
                    'title'    => esc_html__( 'Custom JS Code', 'pick' ),
                    'subtitle' => esc_html__( 'Paste your JS code here.', 'pick' ),
                    'mode'     => 'javascript',
                    'theme'    => 'monokai',
                    'default'  => "jQuery(document).ready(function($){});"
                ),                    
            )
        ) 
    ); //general

    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Layout', 'pick'),
            //'icon_class' => 'fa-lg',
            'icon' => 'fa fa-th-list',
            'fields' => array ( 
                array (
                    'id' => 'sidebar_layout',
                    'type' => 'image_select',
                    'title' => esc_html__('Default Layout', 'pick'),
                    'subtitle' => esc_html__('Default layout for whole site', 'pick'),
                    'options' => array (
                        '1' => array (
                            'alt' => 'empty.png',
                            'img' => get_template_directory_uri() . '/images/backend/sidebars/empty.png'
                        ),
                        '2' => array(
                            'alt' => 'single-left.png',
                            'img' => get_template_directory_uri() . '/images/backend/sidebars/single-left.png'
                        ),
                        '3' => array(
                            'alt' => 'single-right.png',
                            'img' => get_template_directory_uri() . '/images/backend/sidebars/single-right.png'
                        ),                               
                    ),
                    'default' => '3'
                ),
                array (
                    'id' => 'post_layout',
                    'type' => 'image_select',
                    'title' => esc_html__('Default Post Layout', 'pick'),
                    'subtitle' => esc_html__('Default layout post', 'pick'),
                    'options' => array (
                        'list' => array (
                            'alt' => 'list.png',
                            'img' => get_template_directory_uri() . '/images/backend/layout/list.png'
                        ),
                        'grid' => array(
                            'alt' => 'grid.png',
                            'img' => get_template_directory_uri() . '/images/backend/layout/grid.png'
                        ),   
                        'grid_three' => array(
                            'alt' => 'grid.png',
                            'img' => get_template_directory_uri() . '/images/backend/layout/grid-three.png'
                        ),                            
                    ),
                    'default' => 'list'
                ),
                array (
                    'id' => 'sidebar_layout_single',
                    'type' => 'image_select',
                    'title' => esc_html__('Single Layout', 'pick'),
                    'subtitle' => esc_html__('Default layout of single post', 'pick'),
                    'options' => array (
                        '1' => array (
                            'alt' => 'empty.png',
                            'img' => get_template_directory_uri() . '/images/backend/sidebars/empty.png'
                        ),
                        '2' => array(
                            'alt' => 'single-left.png',
                            'img' => get_template_directory_uri() . '/images/backend/sidebars/single-left.png'
                        ),
                        '3' => array(
                            'alt' => 'single-right.png',
                            'img' => get_template_directory_uri() . '/images/backend/sidebars/single-right.png'
                        ),                               
                    ),
                    'default' => '3'
                ),    
                array (
                    'id' => 'sidebar_layout_page',
                    'type' => 'image_select',
                    'title' => esc_html__('Page Layout', 'pick'),
                    'subtitle' => esc_html__('Default layout of single page ', 'pick'),
                    'options' => array (
                        '1' => array (
                            'alt' => 'empty.png',
                            'img' => get_template_directory_uri() . '/images/backend/sidebars/empty.png'
                        ),
                        '2' => array(
                            'alt' => 'single-left.png',
                            'img' => get_template_directory_uri() . '/images/backend/sidebars/single-left.png'
                        ),
                        '3' => array(
                            'alt' => 'single-right.png',
                            'img' => get_template_directory_uri() . '/images/backend/sidebars/single-right.png'
                        ),                               
                    ),
                    'default' => '3'
                ),
                array (
                    'id' => 'sidebar_layout_archive',
                    'type' => 'image_select',
                    'title' => esc_html__('Archive Layout', 'pick'),
                    'subtitle' => esc_html__('Default layout of category, archive, tag page and search page ', 'pick'),
                    'options' => array (
                        '1' => array (
                            'alt' => 'empty.png',
                            'img' => get_template_directory_uri() . '/images/backend/sidebars/empty.png'
                        ),
                        '2' => array(
                            'alt' => 'single-left.png',
                            'img' => get_template_directory_uri() . '/images/backend/sidebars/single-left.png'
                        ),
                        '3' => array(
                            'alt' => 'single-right.png',
                            'img' => get_template_directory_uri() . '/images/backend/sidebars/single-right.png'
                        ),                               
                    ),
                    'default' => '3'
                ),
                array (
                    'id' => 'post_layout_archive',
                    'type' => 'image_select',
                    'title' => esc_html__('Archive Post Layout', 'pick'),
                    'subtitle' => esc_html__('Default layout of category, archive, tag page, author and search page post', 'pick'),
                    'options' => array (
                        'list' => array (
                            'alt' => 'list.png',
                            'img' => get_template_directory_uri() . '/images/backend/layout/list.png'
                        ),
                        'grid' => array(
                            'alt' => 'grid.png',
                            'img' => get_template_directory_uri() . '/images/backend/layout/grid.png'
                        ),                            
                    ),
                    'default' => 'list'
                ),
            )
        ) 
    ); //Layout

    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Typography', 'pick'),
            //'icon_class' => 'fa-lg',
            'icon' => 'fa fa-font',
            'fields' => array (  
                array (
                    'id'       => 'body-font',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Body Font', 'pick' ),
                    'subtitle' => esc_html__( 'You can Specify the body font properties.', 'pick' ),
                    'google'   => true,
                    'color'    => true,
                    'text-align'=> true,
                    'update-weekly'=>false,
                    'line-height'=> true,
                    'subsets'  =>false,
                    'font-style'=> true,
                    'font-backup' => false,
                    'font-size' => true,
                    'font-weight'=>true,
                    'all_styles'  => true,
                    'letter-spacing'=>true,
                    'word-spacing'=>true,
                    'all_styles'=>true,        
                    'multi' => array( 'subset' => false, 'weight' => true),                    
                    'units'     => 'em',
                    'output'      => array('body'),
                    'units'   => 'em',
                    'default'  => array(
                        'font-size'   => '0.938em',
                        'line-height'   => '1.45em',
                        'font-family' => 'PT Serif',
                        'font-weight' => '400',
                    ),
                ),
                array (
                    'id'       => 'all-post-title',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'All Main Post &amp; Page Title', 'pick' ),
                    'subtitle' => esc_html__( 'You can Specify the all post and page title font properties.', 'pick' ),
                    'google'   => true,
                    'color'    => true,
                    'text-align'=> true,
                    'update-weekly'=>false,
                    'line-height'=> true,
                    'subsets'  =>false,
                    'all_styles'  => true,
                    'font-style'=> true,
                    'font-backup' => false,
                    'font-size' => true,
                    'letter-spacing'=>true,
                    'word-spacing'=>true,
                    'font-weight'=>true,
                    'units'     => 'em',
                    'output'      => array('.post .entry-title, .page .entry-title'),
                    'units'   => 'em',
                    'default'  => array(
                        'font-size'   => '1.953em',
                        'line-height'   => '1.4em',
                        'font-family' => 'Lora',
                        'font-weight' => '400',
                    ),
                ), 
                array (
                    'id'       => 'heading-one',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Heading h1 Font', 'pick' ),
                    'subtitle' => esc_html__( 'You can Specify the heading h1 font properties.', 'pick' ),
                    'google'   => true,
                    'color'    => true,
                    'all_styles'  => true,
                    'text-align'=> true,
                    'update-weekly'=>false,
                    'line-height'=> true,
                    'subsets'  =>false,
                    'font-style'=> true,
                    'font-backup' => false,
                    'font-size' => true,
                    'font-weight'=>true,
                    'letter-spacing'=>true,
                    'word-spacing'=>true,
                    'units'     => 'em',
                    'output'      => array('h1'),
                    'units'   => 'em',
                    'default'  => array(
                        'font-size'   => '2.441em',
                        'line-height'   => '1.4em',
                        'font-family' => 'Lora',
                        'font-weight' => '400',
                    ),
                ), 
                array (
                    'id'       => 'heading-two',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Heading h2 Font', 'pick' ),
                    'subtitle' => esc_html__( 'You can Specify the heading h2 font properties.', 'pick' ),
                    'google'   => true,
                    'color'    => true,
                    'text-align'=> true,
                    'update-weekly'=>false,
                    'all_styles'  => true,
                    'line-height'=> true,
                    'subsets'  =>false,
                    'font-style'=> true,
                    'font-backup' => false,
                    'font-size' => true,
                    'font-weight'=>true,
                    'letter-spacing'=>true,
                    'word-spacing'=>true,
                    'units'     => 'em',
                    'output'      => array('h2'),
                    'units'   => 'em',
                    'default'  => array(
                        'font-size'   => '1.953em',
                        'line-height'   => '1.4em',
                        'font-family' => 'Lora',
                        'font-weight' => '400',
                    ),
                ), 
                array (
                    'id'       => 'heading-three',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Heading h3 Font', 'pick' ),
                    'subtitle' => esc_html__( 'You can Specify the heading h3 font properties.', 'pick' ),
                    'google'   => true,
                    'color'    => true,
                    'all_styles'  => true,
                    'text-align'=> true,
                    'update-weekly'=>false,
                    'line-height'=> true,
                    'subsets'  =>false,
                    'font-style'=> true,
                    'font-backup' => false,
                    'font-size' => true,
                    'font-weight'=>true,
                    'letter-spacing'=>true,
                    'word-spacing'=>true,
                    'units'     => 'em',
                    'output'      => array('h3'),
                    'units'   => 'em',
                    'default'  => array(
                        'font-size'   => '1.563em',
                        'line-height'   => '1.4em',
                        'font-family' => 'Lora',
                        'font-weight' => '400',
                    ),
                ), 
                array (
                    'id'       => 'heading-four',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Heading h4 Font', 'pick' ),
                    'subtitle' => esc_html__( 'You can Specify the heading h4 font properties.', 'pick' ),
                    'google'   => true,
                    'color'    => true,
                    'all_styles'  => true,
                    'text-align'=> true,
                    'update-weekly'=>false,
                    'line-height'=> true,
                    'subsets'  =>false,
                    'font-style'=> true,
                    'font-backup' => false,
                    'font-size' => true,
                    'font-weight'=>true,
                    'letter-spacing'=>true,
                    'word-spacing'=>true,
                    'units'     => 'em',
                    'output'      => array('h4'),
                    'units'   => 'em',
                    'default'  => array(
                        'font-size'   => '1.25em',
                        'line-height'   => '1.4em',
                        'font-family' => 'Lora',
                        'font-weight' => '400',
                    ),
                ), 
                array (
                    'id'       => 'heading-five',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Heading h5 Font', 'pick' ),
                    'subtitle' => esc_html__( 'You can Specify the heading h5 font properties.', 'pick' ),
                    'google'   => true,
                    'color'    => true,
                    'text-align'=> true,
                    'all_styles'  => true,
                    'update-weekly'=>false,
                    'line-height'=> true,
                    'subsets'  =>false,
                    'font-style'=> true,
                    'font-backup' => false,
                    'font-size' => true,
                    'font-weight'=>true,
                    'letter-spacing'=>true,
                    'word-spacing'=>true,
                    'units'     => 'em',
                    'output'      => array('h5'),
                    'units'   => 'em',
                    'default'  => array(
                        'font-size'   => '1em',
                        'line-height'   => '1.4em',
                        'font-family' => 'Lora',
                        'font-weight' => '400',
                    ),
                ), 

                array (
                    'id'       => 'heading-six',
                    'type'     => 'typography',
                    'title'    => esc_html__( 'Heading h6 Font', 'pick' ),
                    'subtitle' => esc_html__( 'You can Specify the heading h6 font properties.', 'pick' ),
                    'google'   => true,
                    'color'    => true,
                    'text-align'=> true,
                    'update-weekly'=>false,
                    'line-height'=> true,
                    'subsets'  => false,
                    'font-style'=> true,
                    'font-backup' => false,
                    'font-size' => true,
                    'all_styles'  => true,
                    'font-weight'=>true,
                    'letter-spacing'=>true,
                    'word-spacing'=>true,
                    'units'     => 'em',
                    'default'  => array(
                        'font-size'   => '0.8em',
                        'line-height'   => '1.4em',
                        'font-family' => 'Lora',
                        'font-weight' => '400',
                    ),
                ),   
            )
        ) 
    ); //Typography

    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Color Options', 'pick'),
            //'icon_class' => 'fa-lg',
            'icon' => 'fa fa-life-ring',
            'fields' => array ( 
                array(
                    'id' => 'pick_theme_color_scheme',
                    'type' => 'radio',
                    'title' => esc_html__('Color Scheme', 'pick'),
                    'subtitle' => esc_html__('Select Predefined Color Schemes or your Own', 'pick'),
                    'options'  => array(
                        '1' => '<div class="redux-custom-color" style="background: #ddbe86;"> </div>',
                        '2' => '<div class="redux-custom-color" style="background: #1ABC9C;"> </div>',
                        '3' => '<div class="redux-custom-color" style="background: #D2527F;"> </div>',
                        '4' => '<div class="redux-custom-color" style="background: #F26D7E;"> </div>',
                        '5' => '<div class="redux-custom-color" style="background: #CC6054;"> </div>',
                        '6' => '<div class="redux-custom-color" style="background: #667A61;"> </div>',
                        '7' => '<div class="redux-custom-color" style="background: #A74C5B;"> </div>',
                        '8' => '<div class="redux-custom-color" style="background: #95A5A6;"> </div>',
                        '9' => '<img src="'.get_template_directory_uri() . '/images/color-scheme.png'.'">',
                    ),
                    'default'  => '1'
                ),
                array(
                    'id' => 'pick_theme_custom_color',
                    'type' => 'color',
                    'title' => esc_html__('Your Own Theme Color', 'pick'),
                    'subtitle' => esc_html__('Pick a custom color', 'pick'),
                    'default' => '#FFFFFF',
                    'validate' => 'color',
                    'required' => array("pick_theme_color_scheme", "=", "9")
                ),
            )
        ) 
    ); //Style  

    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Header Section', 'pick'),
            //'icon_class' => 'fa-lg',
            'icon' => 'fa fa-laptop',
            'fields' => array(      
                array(
                    'id' => 'header_bg_img',
                    'type' => 'media',
                    'title' => esc_html__('Header Background Image', 'pick'),
                    'subtitle' => esc_html__('This image will show in header banner area', 'pick'),
                    'default' => array("url" => get_template_directory_uri() . "/images/header-bg.png"),
                    'preview' => true,
                    'readonly' => false,
                    "url" => true,
                ),
                array(
                    'id'       => 'header_bg_overlay',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__('Header Background Image Overlay', 'pick'),
                    'subtitle' => esc_html__( 'This overlay color work when you add header images', 'pick' ),
                    'default'  => array( 'color' => '#000000', 'alpha' => '0.5' ),
                    'output'   => array( '.site-header .overlay' ),
                    'mode'     => 'background',
                    'validate' => 'colorrgba',
                ),
                array(
                    'id' => 'header_bg_color',
                    'type' => 'color',
                    'title' => esc_html__('Header Background Color', 'pick'),
                    'subtitle' => esc_html__('This color will show in header banner area if image not load or set', 'pick'),
                    'default' => "#060C1C",
                ),   
                array(
                    'id' => 'header_logo_display',
                    'type' => 'switch',
                    'title' => esc_html__('Display Header Logo', 'pick'),
                    'subtitle' => esc_html__('If you off header logo then site title and description will show instead of logo', 'pick'),
                    'default' => 1,
                ),           
                array(
                    'id' => 'header_logo',
                    'type' => 'media',
                    'title' => esc_html__('Header Logo', 'pick'),
                    'subtitle' => esc_html__('This image will show as a logo in header banner area', 'pick'),
                    'default' => array("url" => get_template_directory_uri() . "/images/logo.png"),
                    'preview' => true,
                    'readonly' => false,
                    "url" => true,
                ),
                array(
                    'id'=>'header_logo_retina',
                    'type' => 'media',
                    'url'=> true,
                    'readonly' => false,
                    'title' => esc_html__('Header Logo for retina', 'pick'),
                    'subtitle' => esc_html__('2x logo size, for screens with high DPI.
                    Use the exact same filename and add @2x after the name. example: logo@2x.png', 'pick'),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/images/logo@2x.png'
                    )
                ),
                array(
                    'id'             => 'header_logo_padding',
                    'type'           => 'spacing',
                    'output'         => array('.site-header .site-branding'),
                    'mode'           => 'padding',
                    'units'          => array('em', 'px'),
                    'units_extended' => 'false',
                    'title'    => esc_html__( 'Header logo padding', 'pick' ),
                    'subtitle' => esc_html__( 'You can increase or decrease header logo padding', 'pick' ),
                    'default'            => array(
                        'padding-top'     => '75px', 
                        'padding-right'   => '0px', 
                        'padding-bottom'  => '75px', 
                        'padding-left'    => '0px',
                        'units'          => 'px', 
                    )
                ),
                array(
                    'id'          => 'main_menu_right_social_link',
                    'type'        => 'softhopper_slides',
                    'title'       => esc_html__( 'Main menu right social link', 'pick' ),
                    'show' => array(
                        'title' => true,
                        'description' => false,
                        'url' => true,
                        ), 
                    'subtitle'    => wp_kses( __( "Font Awesome Icon Class, ex: fa-search. Get the full list <a target='_blank' href='http://fortawesome.github.io/Font-Awesome/cheatsheet/'>Here</a>", "pick" ), $allowed_html_array ),
                    'placeholder' => array(
                        'title'       => esc_html__( 'Add font awesome Icon Class', 'pick' ),
                        'url'       => esc_html__( 'Social Icon Url', 'pick' ),
                    ), 
                    'default' => array(
                        0 => array(
                            'title' => 'fa-facebook',
                            'url' => '#'
                        ),
                        1 => array(
                            'title' => 'fa-twitter',
                            'url' => '#'
                        ),
                        2 => array(
                            'title' => 'fa-google-plus',
                            'url' => '#'
                        ),
                        3 => array(
                            'title' => 'fa-behance',
                            'url' => '#'
                        ),
                        4 => array(
                            'title' => 'fa-pinterest-p',
                            'url' => '#'
                        ),
                    ),                                                                    
                ),
            )
        )
    ); //header

    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Featured Post', 'pick'),
            //'icon_class' => 'fa-lg',
            'icon' => 'fa fa-star',
            'fields' => array(                       
                array(
                    'id' => 'featured_display',
                    'type' => 'switch',
                    'title' => esc_html__('Display Featured Post', 'pick'),
                    'default' => 1,
                ), 
                array(
                    'id' => 'featured_display_in_post',
                    'type' => 'switch',
                    'title' => esc_html__('Show Featured Post In Post', 'pick'),
                    'subtitle' => esc_html__('If your want you can show featured post in Post. Post show in both place', 'pick'),
                    'default' => 0,
                ),
                array (
                    'id'       => 'featured_per_page',
                    'type'     => 'slider',
                    'title'    => esc_html__( 'Number of featured post', 'pick' ),
                    'subtitle' => esc_html__( 'How many featured post you want to show', 'pick' ),
                    'default'       => 5,
                    'min'           => 1,
                    'step'          => 1,
                    'max'           => 20,
                    'display_value' => 'text'
                ),
                array(
                    'id'            => 'featured_post_in_slider',
                    'type'          => 'slider',
                    'title' => esc_html__('Featured Post In Slider', 'pick'),
                    'subtitle' => esc_html__('How many words you want to show in featured post excerpt', 'pick'),
                    'default'       => 3,
                    'min'           => 1,
                    'step'          => 1,
                    'max'           => 10,
                    'display_value' => 'text',                       
                ),
                array(
                    'id' => 'featured_post_auto_slide',
                    'type' => 'switch',
                    'title' => esc_html__('Featured Post Auto Slide', 'pick'),
                    'default' => true,
                ),
                array(
                    'id'            => 'featured_slide_speed',
                    'type'          => 'slider',
                    'title'         => esc_html__('Featured post slide speed', 'pick'),
                    'subtitle'      => esc_html__('How fast featured post slide you can modified from here', 'pick'),
                    'default'       => 1000,
                    'min'           => 50,
                    'step'          => 10,
                    'max'           => 50000,
                    'display_value' => 'text'
                ),   
                array(
                    'id'            => 'featured_autoplay_timeout',
                    'type'          => 'slider',
                    'title'         => esc_html__('Featured autoplay timeout', 'pick'),
                    'subtitle'      => esc_html__('When auto slide remain true you can define here how many times later featured post will slide', 'pick'),
                    'default'       => 3000,
                    'min'           => 50,
                    'step'          => 10,
                    'max'           => 50000,
                    'display_value' => 'text'
                ),                      
            )
        )
    ); //featured post

    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Post Settings', 'pick'),
            //'icon_class' => 'fa-lg',
            'icon' => 'fa fa-file-text',
            'fields' => array (
                array(
                    'id'       => 'excerpt_status',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Excerpt Status', 'pick' ),
                    'subtitle' => esc_html__( 'If you off excerpt status always show full post', 'pick' ),
                    'default' => 1
                ), 
                array(
                    'id'            => 'post_excerpt',
                    'type'          => 'slider',
                    'title' => esc_html__('Default Excerpt Length', 'pick'),
                    'subtitle' => esc_html__('How many words you want to show in post excerpt', 'pick'),
                    'default'       => 55,
                    'min'           => 1,
                    'step'          => 1,
                    'max'           => 1000,
                    'display_value' => 'text',
                    'required' => array( 'excerpt_status', '=', '1' ),                          
                ), 
                array(
                    'id'            => 'post_excerpt_sticky',
                    'type'          => 'slider',
                    'title' => esc_html__('Default Sticky Post Excerpt Length', 'pick'),
                    'subtitle' => esc_html__('How many words you want to show in sticky post excerpt', 'pick'),
                    'default'       => 70,
                    'min'           => 1,
                    'step'          => 1,
                    'max'           => 1000,
                    'display_value' => 'text',
                    'required' => array( 'excerpt_status', '=', '1' ),                          
                ),
                array(
                    'id'       => 'post_format_meta',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Post Format', 'pick' ),
                    'subtitle' => esc_html__( 'You can show or hide post format meta up of post title', 'pick' ),
                    'default' => 1
                ),
                array(
                    'id'       => 'post_meta',
                    'type'     => 'sortable',
                    'mode'     => 'checkbox', // checkbox or text
                    'title'    => esc_html__( 'Post Header Meta', 'pick' ),
                    'subtitle' => esc_html__( 'Whose meta you want to show in post header?', 'pick' ),
                    'options'  => array(
                        'cat_meta' => esc_html__('Category Meta', 'pick'),
                        'author_meta' => esc_html__('Author Meta', 'pick'),
                        'date_meta' => esc_html__('Date Meta', 'pick'),
                    ),
                    'default'  => array(
                        'cat_meta' => true,
                        'date_meta' => true,
                        'author_meta' => true,
                    )
                ), 
                array(
                    'id'       => 'author_info_box',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Author Info Box', 'pick' ),
                    'subtitle' => esc_html__( 'You can show or hide author info box', 'pick' ),
                    'default' => 1
                ),  
                array(
                    'id'       => 'tiled_gallery_row_height',
                    'type'     => 'text',
                    'title'    => esc_html__('Tiled Gallery Row Height', 'pick'),
                    'subtitle' => esc_html__( 'This is for tiled gallery post', 'pick' ),
                    'default'  => "150",
                ),                       
                array(
                    'id'       => 'related_postsection_start',
                    'type'     => 'section',
                    'title'    => esc_html__( 'Related Posts Settings', 'pick' ),
                    'indent'   => true, // Indent all options below until the next 'section' option is set.
                ),
                array(
                    'id'       => 'related_post',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Related Posts', 'pick' ),
                    'subtitle' => esc_html__( 'You can show or hide related posts', 'pick' ),
                    'default' => 1
                ),
                array(
                    'id'            => 'related_post_number',
                    'type'          => 'slider',
                    'title'         => esc_html__('Number of posts to show', 'pick'),
                    'default'       => 5,
                    'min'           => 1,
                    'step'          => 1,
                    'max'           => 20,
                    'display_value' => 'text'
                ),
                array(
                    'id'       => 'related_query',
                    'type'     => 'radio',
                    'title'    => esc_html__( 'Query Type', 'pick' ),
                    'subtitle' => esc_html__( 'Show related by this query type', 'pick' ),
                    //Must provide key => value pairs for radio options
                    'options'  => array(
                        'tag' => 'Tag',
                        'category' => 'Category',
                        'author' => 'Author'
                    ),
                    'default'  => 'tag'
                ),
                array(
                    'id'     => 'related_postsection_end',
                    'type'   => 'section',
                    'indent' => false, // Indent all options below until the next 'section' option is set.
                ), 
                array(
                    'id'       => 'infinity_scroll_section_start',
                    'type'     => 'section',
                    'title'    => esc_html__( 'Infinity Scroll Settings', 'pick' ),
                    'indent'   => true, // Indent all options below until the next 'section' option is set.
                ),
                array(
                    'id'       => 'infinity_scroll',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Infinity Scroll', 'pick' ),
                    'subtitle' => esc_html__( 'You can off or on infinity scroll (Note: Infinity Scroll only for Post Layout grid or grid three not work in list post layout)', 'pick' ),
                    'default' => 0
                ),
                array(
                    'id' => 'infinity_scroll_img',
                    'type' => 'media',
                    'title' => esc_html__('Infinity Scroll Image', 'pick'),
                    'subtitle' => esc_html__('This image will show when infinity scroll not load', 'pick'),
                    'default' => array("url" => get_template_directory_uri() . "/images/post-loader.gif"),
                    'preview' => true,
                    'readonly' => false,
                    "url" => true,
                    'required' => array( 'infinity_scroll', '=', '1' ),
                ),
                array(
                    'id'     => 'infinity_scroll_section_end',
                    'type'   => 'section',
                    'indent' => false, // Indent all options below until the next 'section' option is set.
                ),   
            )
        ) 
    ); //Post Settings

    Redux::setSection( $opt_name, array(
            'title' => esc_html__('About Me Page', 'pick'),
            'icon' => 'fa fa-user',
            'fields' => array( 
                array(
                    'id'       => 'author_img',
                    'type'     => 'media',
                    'title'    => esc_html__('Author Image', 'pick'),
                    'subtitle' => esc_html__('This image will show in the navigation', 'pick'),
                    'default'  => array("url" => get_template_directory_uri() . "/images/author/author-image.png"),
                    'preview'  => true,
                    'readonly' => false,
                    "url"      => true,
                ),                      
                array(
                    'id'       => 'author_name',
                    'type'     => 'text',
                    'title'    => esc_html__('Author Name', 'pick'),
                    'subtitle' => esc_html__( 'This author will show in about page below author image', 'pick' ),
                    'default'  => "Johan Smith",
                ), 
                array(
                    'id'      => 'author_description',
                    'type'    => 'editor',
                    'title'   => esc_html__( 'Author description', 'pick' ),
                    'default' => '<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures.</p>',
                    'args'    => array(
                        'wpautop'       => false,
                        'media_buttons' => false,
                        'textarea_rows' => 5,
                        'teeny'         => false,
                        'quicktags'     => false,
                    )
                ), 
                array (
                    'id' => 'author_sign',
                    'type' => 'media',
                    'title' => esc_html__('Author Singnature', 'pick'),
                    'subtitle' => esc_html__('This image will show in the navigation', 'pick'),
                    'default' => array("url" => get_template_directory_uri() . "/images/author/sign.png"),
                    'preview' => true,
                    'readonly' => false,
                    "url" => true,
                ), 
                array(
                    'id'          => 'author_social_link',
                    'type'        => 'softhopper_slides',
                    'title'       => esc_html__( 'Add Follow Link', 'pick' ),
                    'show' => array(
                        'title' => true,
                        'description' => false,
                        'url' => true,
                        ),
                    'subtitle'    => wp_kses( __( "Font Awesome Icon Class, ex: fa-search. Get the full list <a target='_blank' href='http://fortawesome.github.io/Font-Awesome/cheatsheet/'>Here</a>", "pick" ), $allowed_html_array ),
                    'placeholder' => array(
                        'title'       => esc_html__( 'Add font awesome Icon Class', 'pick' ),
                        'url'       => esc_html__( 'Social Icon Url', 'pick' ),
                    ),
                    'default' => array(
                        0 => array(
                            'title' => 'fa-facebook',
                            'url' => '#'
                        ),
                        1 => array(
                            'title' => 'fa-twitter',
                            'url' => '#'
                        ),
                        2 => array(
                            'title' => 'fa-google-plus',
                            'url' => '#'
                        ),
                        3 => array(
                            'title' => 'fa-behance',
                            'url' => '#'
                        ),
                        4 => array(
                            'title' => 'fa-linkedin',
                            'url' => '#'
                        ),
                    ),
                ), 
                array(
                    'id'          => 'author_skills',
                    'type'        => 'softhopper_slides_skill',
                    'title'       => esc_html__( 'Add author skills', 'pick' ),
                    'show' => array(
                        'title' => true,
                        'description' => false,
                        'url' => true,
                        ),
                    'subtitle'    => esc_html__( "Add your skills for about page skill section", 'pick' ),
                    'placeholder' => array(
                        'title'       => esc_html__( 'Add skill name', 'pick' ),
                        'url'       => esc_html__( 'Add skill percent', 'pick' ),
                    ),
                    'default' => array(
                        0 => array(
                            'title' => 'Article Writing',
                            'url' => '97'
                        ),
                        1 => array(
                            'title' => 'Wordpress',
                            'url' => '90'
                        ),
                        2 => array(
                            'title' => 'PSD Design',
                            'url' => '95'
                        ),
                        3 => array(
                            'title' => 'HTML/CSS',
                            'url' => '90'
                        ),
                        4 => array(
                            'title' => 'Programming',
                            'url' => '92'
                        ),
                        5 => array(
                            'title' => 'SEO',
                            'url' => '82'
                        ),
                    ),
                ),                   
            )
        )
    ); //about me

    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Contact Page', 'pick'),
            'icon' => 'fa fa-phone',
            'fields' => array(
                array(
                    'id' => 'contact_lat',
                    'type' => 'text',
                    'title' => esc_html__('Latitude', 'pick'),
                    'subtitle' => wp_kses( __( "You can get Latitude and Longitude from <a href='http://www.latlong.net/'>latlong.net</a>", "pick" ), $allowed_html_array ),
                    'default' => "-37.817314",
                ),
                array(
                    'id' => 'contact_lon',
                    'type' => 'text',
                    'title' => esc_html__('Longitude', 'pick'),
                    'default' => "144.955431",
                ),
                array(
                    'id' => 'map_mouse_wheel',
                    'type' => 'switch',
                    'title' => esc_html__('Map Mouse Wheel', 'pick'),
                    'default' => true
                ),
                array(
                    'id' => 'map_zoom_control',
                    'type' => 'switch',
                    'title' => esc_html__('Map zoomControl', 'pick'),
                    'default' => true
                ),
                array(
                    'id' => 'contact_map_point_img',
                    'type' => 'media',
                    'title' => esc_html__('Contact Map Point Image', 'pick'),
                    'subtitle' => esc_html__('This image will show in the google map of your location point', 'pick'),
                    'default' => array("url" => get_template_directory_uri() . "/images/map-icon.png"),
                    'preview' => true,
                    'readonly' => false,
                    "url" => true,
                ),
                array(
                    'id' => 'contact_subtitle',
                    'type' => 'editor',
                    'title' => esc_html__('Contact Subtitle', 'pick'),
                    'default'=> 'We provides a wide array of specialised advisory and<br>Strategic services for our clients.',
                    'args'    => array(                                
                        'textarea_rows' => 5,
                    )
                ),
                array(
                    'id' => 'contact_address_main',
                    'type' => 'text',
                    'title' => esc_html__('Contact Address Main', 'pick'),
                    'default'=> "Pick Creative Agency, 02 Melborn, Australia"
                ),
                array(
                    'id' => 'contact_description',
                    'type' => 'editor',
                    'title' => esc_html__('Contact Description', 'pick'),
                    'default'=> 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum.',
                    'args'    => array(                                
                        'textarea_rows' => 6,
                    )
                ),
                array(
                    'id' => 'contact_form7_shortcode',
                    'type' => 'text',
                    'title' => esc_html__('Contact Form 7 Shortcode', 'pick'),
                    'default'=> ""
                ),
                
            )
        )
    ); //contact

    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Search Page', 'pick'),
            'icon' => 'fa fa-search',
            'fields' => array(                        
                array(
                    'id'       => 'search_only_form_post',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Search only post', 'pick' ),
                    'subtitle' => esc_html__( 'If you on this option query search form post. Otherwise query search form post and pages.', 'pick' ),
                    'default' => 0
                ),
                array(
                    'id'       => 'search_form_in_search_page',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Search form', 'pick' ),
                    'subtitle' => esc_html__( 'Show search form in search page', 'pick' ),
                    'default' => 0
                ),                        
            )
        )
    ); //search

    Redux::setSection( $opt_name, array(
            'title' => esc_html__('Footer Section', 'pick'),
            //'icon_class' => 'fa-lg',
            'icon' => 'fa fa-edit',
            'fields' => array(
                array(
                    'id'       => 'footer_widgets_top',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Enable Instagram Feed On Footer', 'pick' ),
                    'subtitle' => esc_html__( 'You can off or on footer Instagram feed content', 'pick' ),
                    'default'  => true,
                ),
                array(
                    'id'       => 'instagram_title_content',
                    'type'     => 'text',
                    'title'    => esc_html__('Instagram Feed Title', 'pick'),
                    'default'  => 'Follow @ Instagram',
                    'required' => array( 'footer_widgets_top', '=', '1' ),
                ),                
                array(
                    'id'       => 'instagram_usernames',
                    'type'     => 'text',
                    'title'    => esc_html__('Instagram User Name', 'pick'),
                    'default'  => '',
                    'required' => array( 'footer_widgets_top', '=', '1' ),
                ),   
                array(
                    'id'            => 'instagram_post_limit',
                    'type'          => 'slider',
                    'title' => esc_html__('Instagram Photo Item', 'pick'),
                    'subtitle' => esc_html__('How many Instagram photo you want to show', 'pick'),
                    'default'       => 8,
                    'min'           => 1,
                    'step'          => 1,
                    'max'           => 100,
                    'display_value' => 'text',
                    'required' => array( 'footer_widgets_top', '=', '1' ),                          
                ),                 
                array(
                    'id'            => 'instagram_item_columns',
                    'type'          => 'slider',
                    'title' => esc_html__('Instagram Column', 'pick'),
                    'subtitle' => esc_html__('How many Instagram photo column you want to show', 'pick'),
                    'default'       => 6,
                    'min'           => 1,
                    'step'          => 1,
                    'max'           => 12,
                    'display_value' => 'text',
                    'required' => array( 'footer_widgets_top', '=', '1' ),                          
                ), 
                array(
                    'id'       => 'instagram_image_size',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Instagram Image Size', 'pick' ),
                    'required' => array( 'footer_widgets_top', '=', '1' ),
                    //Must provide key => value pairs for select options
                    'options'  => array(
                        'thumbnail' => esc_html__('Thumbnail', 'pick' ),
                        'small' => esc_html__('Small', 'pick' ),
                        'large' => esc_html__('Large', 'pick' ),
                        'original' => esc_html__('Original', 'pick' ),
                    ),
                    'default'  => 'small'
                ),                 
                array(
                    'id'       => 'instagram_image_open',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Instagram Image Open In', 'pick' ),
                    'required' => array( 'footer_widgets_top', '=', '1' ),
                    //Must provide key => value pairs for select options
                    'options'  => array(
                        '_self' => esc_html__('Current window (_self)', 'pick' ),
                        '_blank' => esc_html__('New window (_blank)', 'pick' ),
                    ),
                    'default'  => '_blank'
                ),   
                array(
                    'id'       => 'footer_widgets',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Enable Footer Widget', 'pick' ),
                    'subtitle' => esc_html__( 'You can off or on footer widgets', 'pick' ),
                    'default'  => true,
                ),
                array (
                    'id' => 'footer_widget_columns',
                    'type' => 'image_select',
                    'required' => array( 'footer_widgets', '=', '1' ),
                    'title' => esc_html__('Default Layout', 'pick'),
                    'subtitle' => esc_html__('How many sidebar you want to show on footer', 'pick'),
                    'options' => array (
                        '1' => array (
                            'alt' => 'one-column.png',
                            'img' => get_template_directory_uri() . '/images/backend/footer/one-column.png'
                        ),
                        '2' => array(
                            'alt' => 'two-columns.png',
                            'img' => get_template_directory_uri() . '/images/backend/footer/two-columns.png'
                        ),
                        '3' => array(
                            'alt' => 'three-columns.png',
                            'img' => get_template_directory_uri() . '/images/backend/footer/three-columns.png'
                        ), 
                        '4' => array(
                            'alt' => 'four-columns.png',
                            'img' => get_template_directory_uri() . '/images/backend/footer/four-columns.png'
                        ),                               
                    ),
                    'default' => '3'
                ),                
                array(
                    'id'      => 'footer_copyright_info',
                    'type'    => 'editor',
                    'title'   => esc_html__( 'Footer Copyright Info', 'pick' ),
                    'default' => 'Copyright &copy;2015 Softhopper. All right reserved.',
                    'args'    => array(
                        'wpautop'       => false,
                        'media_buttons' => false,
                        'textarea_rows' => 5,
                        //'tabindex' => 1,
                        //'editor_css' => '',
                        'teeny'         => false,
                        //'tinymce' => array(),
                        'quicktags'     => false,
                    )
                ),
            )
        )
    ); //footer

    Redux::setSection( $opt_name, array(
            'title' => esc_html__('404 Settings', 'pick'),
            //'icon_class' => 'fa-lg',
            'icon' => 'fa fa-question-circle',                
            'fields' => array(
                array(
                    'id' => '404_img',
                    'type' => 'media',
                    'title' => esc_html__('404  Image', 'pick'),
                    'subtitle' => esc_html__('This image will show in 404 page', 'pick'),
                    'default' => array("url" => get_template_directory_uri() . "/images/404.png"),
                    'readonly' => false,
                    'preview' => true,
                    "url" => true,
                ),
                array(
                    'id'=>'404_img_retina',
                    'type' => 'media',
                    'url'=> true,
                    'readonly' => false,
                    'title' => esc_html__('404  image for retina', 'pick'),
                    'subtitle' => esc_html__('2x logo size, for screens with high DPI.
                    Use the exact same filename and add @2x after the name. example: 404@2x.png', 'pick'),
                    'default' => array(
                        'url' => get_template_directory_uri() . '/images/404@2x.png'
                    )
                ),
            )
        )
    ); //404   


    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'pick' ),
                'desc'   => wp_kses( __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', "pick" ), $allowed_html_array ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }



