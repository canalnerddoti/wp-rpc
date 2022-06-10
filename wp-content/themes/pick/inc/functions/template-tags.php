<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Pick
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'pick' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( esc_html__( 'Older posts', 'pick' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'pick' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation">
		<h2 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'pick' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'pick_theme_posts_pagination_nav' ) ) :
/**
 * This is for post pagination
 */
function pick_theme_posts_pagination_nav() {
     if( is_singular() )
        return;

    global $wp_query, $softhopper_pick;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    //infinite-scroll
    (isset($_GET["infinity_scroll"])) ? $infinity_scroll_url = $_GET["infinity_scroll"] : $infinity_scroll_url = "";
    $infinite_scroll = ( $softhopper_pick['infinity_scroll'] == 1 || $infinity_scroll_url == "on") ? "infinite-scroll" : "" ;
    echo '<div class="navigation '.$infinite_scroll.' paging-navigation"><ul class="nav-links">' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() ) {
        printf( '<li class="nav-previous">%s</li>' . "\n", get_previous_posts_link('<span class="fa fa-angle-double-left"></span>'.esc_html__('Previous','pick') ) );
    } else {
        ?>
        <li class="nav-previous disabled">
            <a href="#"><span class="fa fa-angle-double-left"></span><?php esc_html_e(' No Post','pick'); ?></a>
        </li>
        <?php
    }


    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a class="page-numbers" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li><span class="page-numbers dots">&#46;&#46;&#46;</span></li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a class="page-numbers" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li><span class="page-numbers dots">'.esc_html__('&hellip;', 'pick').'</span></li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a class="page-numbers curent" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /** Next Post Link */
    if ( get_next_posts_link() ) {
        printf( '<li class="nav-next">%s</li>' . "\n", get_next_posts_link( esc_html__('Next','pick').'<span class="fa fa-angle-double-right"></span>') );
    } else {
        ?>
        <li class="nav-next disabled">
            <a href="#"><?php esc_html_e('No Post','pick'); ?><span class="fa fa-angle-double-right"></span>
            </a>
        </li>
        <?php
    }

    echo '</ul></div>' . "\n";
}
endif;

if ( ! function_exists( 'pick_theme_post_grid_list_class' ) ) :
/**
 * check list or grid post layout
 */
function pick_theme_post_grid_list_class() {
    $softhopper_pick = get_option('softhopper_pick');
    global $post_layout;
    (isset($_GET["post_layout"])) ? $post_layout_url = $_GET["post_layout"] : $post_layout_url = "";

    if ( !is_single() ) {
        if( is_archive() || is_search() ) {
            $post_layout = ( $softhopper_pick['post_layout_archive'] == 'list' ) ? 'col-md-12 full-width' : 'col-md-6 col-sm-6 grid';
        } else {
            if ( $post_layout_url == 'list' ) {
                $post_layout = 'col-md-12 full-width';
            } elseif ( $post_layout_url == 'grid' ) {
                $post_layout = 'col-md-6 col-sm-6 grid';
            } elseif ( $post_layout_url == 'grid_three' ) {
                $post_layout = 'col-md-4 col-sm-6 grid';
            } elseif ( $softhopper_pick['post_layout'] == 'list' ) {
                $post_layout = 'col-md-12 full-width';
            } elseif ( $softhopper_pick['post_layout'] == 'grid' ) {
                $post_layout = 'col-md-6 col-sm-6 grid';
            } elseif ( $softhopper_pick['post_layout'] == 'grid_three' ) {
                $post_layout = 'col-md-4 col-sm-6 grid';
            }
        }
    } else {
        $post_layout = 'col-md-12 full-width';
    }

    if ( is_sticky() ) {
        if ( is_archive() || is_search() ) {
            $post_layout = ( $softhopper_pick['post_layout_archive'] == 'list' ) ? 'col-md-12 full-width' : 'col-md-6 col-sm-6 grid';
        } else {
            if ( $softhopper_pick['post_layout'] == 'grid_three' || $post_layout_url == 'grid_three') {
                $post_layout = 'col-md-4 col-sm-6 grid';
            } else {
                $post_layout = 'col-md-12 full-width';
            }
        }
    }
}
endif;

if ( ! function_exists( 'pick_theme_cropping_image_size' ) ) :
/**
 * To show cropping image size
 */
function pick_theme_cropping_image_size() {
    $softhopper_pick = get_option('softhopper_pick');
    global $image_size;
    if ( is_archive() || is_search() ) {
        if ($softhopper_pick['sidebar_layout_archive'] == 1) {
           $image_size = ( $softhopper_pick['post_layout_archive'] == 'list' ) ? 'pick-theme-single-full' : 'pick-theme-single-grid-full';
        } else {
           $image_size = ( $softhopper_pick['post_layout_archive'] == 'list' ) ? 'pick-theme-single-list' : 'pick-theme-single-grid';
        }  
    } else {
        if ($softhopper_pick['sidebar_layout'] == 1) {
           $image_size = ( $softhopper_pick['post_layout'] == 'list' ) ? 'pick-theme-single-full' : 'pick-theme-single-grid-full';
        } else {
          $image_size = ( $softhopper_pick['post_layout'] == 'list' ) ? 'pick-theme-single-list' : 'pick-theme-single-grid';
        } 
    }

    // this is for showing demo by url id
    if ( !is_archive() ) {
       ( isset($_GET["layout"]) ) ? $layout = $_GET["layout"]  : $layout = "";

       if ( $layout == "full-width"  ) {
           $image_size = ( $softhopper_pick['post_layout'] == 'list' ) ? 'pick-theme-single-full' : 'pick-theme-single-grid-full';
       } elseif ($layout == "sidebar-left" || $layout == "sidebar-right") {
           $image_size = ( $softhopper_pick['post_layout'] == 'list' ) ? 'pick-theme-single-list' : 'pick-theme-single-grid';
       } 
    }

    if (is_sticky()) {
        if ( is_archive() ) { 
            $image_size = ( $softhopper_pick['sidebar_layout_archive'] == 1 ) ? 'pick-theme-single-full' : 'pick-theme-single-list';
        } else {
            $image_size = ( $layout == "full-width" || $softhopper_pick['sidebar_layout'] == 1 ) ? 'pick-theme-single-full' : 'pick-theme-single-list';
        }
    }
}
endif;

if ( ! function_exists( 'pick_theme_tag_list' ) ) :
/**
 * Prints post format icon
 */
function pick_theme_tag_list() {
    if ( has_tag() ) :
        ?>
        <div class="tag clearfix">
            <span class="tags"><?php esc_html_e('Tagged In:', 'pick'); ?></span>
            <?php 
            echo get_the_tag_list("", "", "");
            ?>
        </div> <!-- /.tag -->
        <?php
    endif;
}
endif;

if ( ! function_exists( 'pick_theme_entry_header' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function pick_theme_entry_header() {
    $softhopper_pick = get_option('softhopper_pick');
    (isset($_GET["post_layout"])) ? $post_layout = $_GET["post_layout"] : $post_layout = "";
    $meta = get_post_meta( get_the_ID() );
    $post_format = get_post_format();
    if ( false === $post_format ) {
        $post_format = "standard";
    }

    // post-format
    if ( 'post' == get_post_type() ) {
    ?>
    <div class="post-format">
        <?php esc_html_e('In: ','pick') . the_category( ', ' ); ?>
    </div>
    <?php
    }
        
    if ( is_single() ) {
        the_title( sprintf( '<h2 class="entry-title">', esc_url( get_permalink() ) ), '</h2>' ); 
    } else {
        the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); 
    }
    ?>

    <div class="entry-meta">
        <?php
        if (isset($softhopper_pick['post_meta']) != null ):
        foreach ($softhopper_pick['post_meta'] as $key => $value) {
            if ( $value == true ) :
                if ( $key == "author_meta" ) {
                ?>
                <span class="byline">
                    <span class="author vcard">
                        <?php
                            if ( is_rtl() ) {
                                esc_html_e('By','pick').the_author_posts_link();
                            } else {
                                esc_html_e('By: ','pick').the_author_posts_link();
                            }
                        ?>
                    </span>
                </span>
                <?php
                } elseif ( $key == "date_meta" ) {
                ?>
                <span class="entry-date">
                    <?php the_time( get_option( 'date_format' ) ); ?>
                </span>
                <?php
                }
            endif;
        } //end foreach
        endif;
        ?>
    </div> <!-- .entry-meta -->
    <?php
}
endif;

if ( ! function_exists( 'pick_theme_page_entry_header' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function pick_theme_page_entry_header() {
    the_title( sprintf( '<h2 class="entry-title">', esc_url( get_permalink() ) ), '</h2>' ); 
    ?>
    <div class="entry-meta">        
        <span class="entry-date">
            <?php the_time( get_option( 'date_format' ) ); ?>
        </span>
        <span class="byline">
            <span class="author vcard">
                <?php esc_html_e('By ','pick').the_author_posts_link(); ?>
            </span>
        </span>
    </div> <!-- .entry-meta -->
    <?php
}
endif;


if ( ! function_exists( 'pick_theme_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function pick_theme_entry_footer() {
$softhopper_pick = get_option('softhopper_pick');
(isset($_GET["post_layout"])) ? $post_layout = $_GET["post_layout"] : $post_layout = ""; ?>
<table>
    <tbody>
        <tr>
            <th>
                <a href="<?php comments_link(); ?>" class="comments-link">
                    <span><?php comments_number( '0 Comment', '1 Comment', '% Comments' ); ?></span>
                </a>
            </th>
            <th>
                <a href="<?php the_permalink(); ?>" class="view-link">
                    <span><?php echo softhopper_get_post_views(get_the_ID()); ?></span>
                </a>
            </th>
            <?php
            if ( is_single() ) { ?>
                <?php if( function_exists('pick_social_share_link') ) { ?>
                <th><?php pick_social_share_link(); ?></th>
                <?php } ?>
            <?php } else {
                if ( is_archive() || is_search() ) {
                    if( function_exists('pick_social_share_link') ) { ?>
                    <th><?php pick_social_share_link(); ?></th>
                    <?php }
                } else {
                    if ( $post_layout == "grid" ) {
                        if ( is_sticky() ) {
                            if( function_exists('pick_social_share_link') ) { ?>
                            <th><?php pick_social_share_link(); ?></th>
                            <?php }
                        }
                    } elseif ($post_layout == "grid_three") {
                        
                    } else {
                        if ( $softhopper_pick['post_layout'] == 'list' ) {
                            if( function_exists('pick_social_share_link') ) { ?>
                            <th><?php echo pick_social_share_link(); ?></th>
                            <?php }
                        } else {
                            if ( is_sticky() ) {
                                if ($softhopper_pick['post_layout'] != 'grid_three' && $post_layout != "grid_three") {
                                   if( function_exists('pick_social_share_link') ) { ?>
                                   <th><?php pick_social_share_link(); ?></th>
                                   <?php }
                                }
                            }
                        }
                    } 
                }
            }
            ?>
        </tr>
    </tbody>
</table>   
<?php
}
endif;


if ( ! function_exists( 'pick_theme_archive_title' ) ) :
/**
 * Shim for `pick_theme_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function pick_theme_archive_title( $before = '', $after = '' ) {
    $allowed_html_array = array(
        'span' => array()
    );
    if ( is_category() ) {
        $title = sprintf( wp_kses( __( '<span>Browsing Category</span>', 'pick' ), $allowed_html_array ).esc_html__( '%s', 'pick' ), single_cat_title( '', false ) );
    } elseif ( is_tag() ) {
        $title = sprintf( wp_kses( __( '<span>Browsing Tag</span>', 'pick' ), $allowed_html_array ).esc_html__( '%s', 'pick' ), single_tag_title( '', false ) );
    } elseif ( is_author() ) {
        $title = sprintf( wp_kses( __( '<span>Browsing Author</span>', 'pick' ), $allowed_html_array ).esc_html__( '%s', 'pick' ), '<span class="vcard">' . get_the_author() . '</span>' );
    } elseif ( is_year() ) {
        $title = sprintf( wp_kses( __( '<span>Browsing Year</span>', 'pick' ), $allowed_html_array ).esc_html__( '%s', 'pick' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'pick' ) ) );
    } elseif ( is_month() ) {
        $title = sprintf( wp_kses( __( '<span>Browsing Month</span>', 'pick' ), $allowed_html_array ).esc_html__( '%s', 'pick' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'pick' ) ) );
    } elseif ( is_day() ) {
        $title = sprintf( wp_kses( __( '<span>Browsing Day</span>', 'pick' ), $allowed_html_array ).esc_html__( '%s', 'pick' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'pick' ) ) );
    } elseif ( is_tax( 'post_format' ) ) {
        if ( is_tax( 'post_format', 'post-format-aside' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format</span>', 'pick' ), $allowed_html_array ).esc_html_x( 'Aside', 'post format archive title', 'pick' );
        } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format</span>', 'pick' ), $allowed_html_array ).esc_html_x( 'Gallery', 'post format archive title', 'pick' );
        } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format</span>', 'pick' ), $allowed_html_array ).esc_html_x( 'Image', 'post format archive title', 'pick' );
        } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format</span>', 'pick' ), $allowed_html_array ).esc_html_x( 'Video', 'post format archive title', 'pick' );
        } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format</span>', 'pick' ), $allowed_html_array ).esc_html_x( 'Quote', 'post format archive title', 'pick' );
        } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format</span>', 'pick' ), $allowed_html_array ).esc_html_x( 'Link', 'post format archive title', 'pick' );
        } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format</span>', 'pick' ), $allowed_html_array ).esc_html_x( 'Status', 'post format archive title', 'pick' );
        } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format</span>', 'pick' ), $allowed_html_array ).esc_html_x( 'Audio', 'post format archive title', 'pick' );
        } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format</span>', 'pick' ), $allowed_html_array ).esc_html_x( 'Chat', 'post format archive title', 'pick' );
        }
    } elseif ( is_post_type_archive() ) {
        $title = sprintf( __( '<span>Browsing Archives</span>', 'pick' ).esc_html__( '%s', 'pick' ), post_type_archive_title( '', false ) );
    } elseif ( is_tax() ) {
        $tax = get_taxonomy( get_queried_object()->taxonomy );
        /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
        $title = sprintf( esc_html__( '%1$s: %2$s', 'pick' ), $tax->labels->singular_name, single_term_title( '', false ) );
    } else {
        $title = esc_html__( 'Browsing Archives', 'pick' );
    }

    /**
     * Filter the archive title.
     *
     * @param string $title Archive title to be displayed.
     */
    $title = apply_filters( 'get_the_archive_title', $title );

    if ( ! empty( $title ) ) {
        echo wp_kses_post($before) . wp_kses_post($title) . wp_kses_post($after);  // WPCS: XSS OK
    }
}
endif;

if ( ! function_exists( 'pick_the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function pick_the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
        echo wp_kses_post($before) . wp_kses_post($description) . wp_kses_post($after); 
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function pick_theme_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'pick_theme_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'pick_theme_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so pick_theme_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so pick_theme_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in pick_theme_categorized_blog.
 */
function pick_theme_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'pick_theme_categories' );
}
add_action( 'edit_category', 'pick_theme_category_transient_flusher' );
add_action( 'save_post',     'pick_theme_category_transient_flusher' );
