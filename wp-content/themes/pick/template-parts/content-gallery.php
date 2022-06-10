<?php
/**
 * The template for displaying gallery post formats
 *
 * Used for both single and index/archive/search.
 *
 * @package Pick
 */
    $softhopper_pick = get_option('softhopper_pick');
    (isset($_GET["post_layout"])) ? $post_layout_url = $_GET["post_layout"] : $post_layout_url = "";

    // check list or grid post layout
    pick_theme_post_grid_list_class();
    global $post_layout;
?>
<div class="<?php echo esc_attr($post_layout); ?>">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="entry-header">            
            <?php pick_theme_entry_header(); ?>
        </header> <!-- /.entry-header -->
        
        <?php
			$meta = get_post_meta( $post->ID );
			if ( !empty( $meta["_pick_theme_format_gallery"][0] ) ) :
		?>	
		<figure class="post-thumb">
			<?php        
				pick_theme_cropping_image_size();
                global $image_size;
				 
				// if gallery style one load this script
				$meta = get_post_meta( $post->ID );
		    	( isset( $meta["_pick_theme_gallery_style"][0] ) ) ? $gallery_style = $meta["_pick_theme_gallery_style"][0] : $gallery_style = "" ; 
		    	if ( $gallery_style == "gallery-one"  ) {
		    	?>
		            <div class="gallery-one owl-carousel">
    	                <?php
    						// this is to get meta field image
    					    $images = get_post_meta( get_the_ID(), '_pick_theme_format_gallery', true);
    				        if ( $images ) {
    				          	foreach ( $images as $attachment_id => $img_full_url ) {
    					           	$full_src = wp_get_attachment_image_src($attachment_id, 'full');
    					           	echo '<a class="item" href="'.$full_src[0].'">';
    					            echo wp_get_attachment_image($attachment_id, $image_size);
    					            echo '</a>';
    				            }
    				        }  
    					?> 
    	            </div> <!-- /.gallery-one -->
		    	<?php                      
		    	}  // end if;
		    ?>
		    <?php         
				// if gallery style three load this script
		    	if ( $gallery_style == "gallery-three"  ) {
		    	?>
		            <div class="pick-theme-tiled-gallery">
		                <?php              
		                    if ( isset ( $meta["_pick_theme_format_gallery"][0] ) ) {
		                        $imgs_urls = $meta["_pick_theme_format_gallery"][0];                            
		                    }  else {
		                        $imgs_urls = '';
		                    }        
		                    $imgs_url = explode( '"', $imgs_urls );
		                    for ( $x = 0; $x < count ( $imgs_url ); $x++ ) {

		                    	// if grid layout and tiled gallery just show first image
		                    	if ( !is_single() ) {
							        if( is_archive() ) {
							            if( $softhopper_pick['post_layout_archive'] != 'list' ) {
							            	if( $x == 2 ) {
					                    		break;
					                    	}
							            }
							        } else {
                                        if ($post_layout_url == "grid" || $post_layout_url == "grid_three") {
                                            if( $x == 2 ) {
                                                break;
                                            }
                                        } elseif( $softhopper_pick['post_layout'] != 'list' ) {
							            	if( $x == 2 ) {
					                    		break;
					                    	}
							            }
							        }
							    }	                    	

		                    	if($x % 2 != 0) {
		                        	?>
		                       		<a class="item" href="<?php if(isset($imgs_url[$x])) echo esc_url($imgs_url[$x]); ?>">
						                <img src="<?php if(isset($imgs_url[$x])) echo esc_url($imgs_url[$x]); ?>" alt="<?php the_title(); ?>">
						            </a>
		                        	<?php                  		
		                        } // end if
		                    } // end for
		                ?>  
		            </div> <!-- /.gallery-one -->
		    	<?php                      
		    	}  // end if;
		    ?>
		    <?php     
		    	// if gallery style two load this script
		    	if ( $gallery_style == "gallery-two"  ) {
		    	?>
		            <div class="gallery-two">
	                    <div class="full-view owl-carousel">
		                <?php
    						// this is to get meta field image
    					    $images = get_post_meta( get_the_ID(), '_pick_theme_format_gallery', true);
    				        if ( $images ) {
    				          	foreach ( $images as $attachment_id => $img_full_url ) {
    					           	$full_src = wp_get_attachment_image_src($attachment_id, 'full');
    					           	echo '<a class="item" href="'.esc_url($full_src[0]).'">';
    					            echo wp_get_attachment_image($attachment_id, $image_size);
    					            echo '</a>';
    				            }
    				        }  
    					?> 
		            	</div> <!-- /.full-view -->
		    	<?php                      
		    	}  // end if;
		    ?>
		    <?php         
		    	if ( $gallery_style == "gallery-two"  ) {
                        ob_start(); 
        		    	    ?>
        		            <div class="list-view owl-carousel">
        		                <?php
            						// this is to get meta field image
            					    $images = get_post_meta( get_the_ID(), '_pick_theme_format_gallery', true);
            				        if ( $images ) {
            				          	foreach ( $images as $attachment_id => $img_full_url ) {
            					           	echo '<div class="item" >';
            					            echo wp_get_attachment_image($attachment_id, 'pick-theme-gallery-small');
            					            echo '</div>';
            				            }
            				        }  
            	                ?>  
        		            </div>  <!-- /.list-view -->
                            <?php 
                        $gallery_list_images = ob_get_clean();
                        ?>
    		    	<?php            

                    if ( !is_single() ) {
                        if( is_archive() ) {
                            if( $softhopper_pick['post_layout_archive'] == 'list' ) {
                                echo ( $gallery_list_images );
                            }
                        } else {
                            if ($post_layout_url == "list") {
                                echo ( $gallery_list_images );
                            } elseif( $post_layout_url == "grid" || $post_layout_url == "grid_three" ) {
                                
                            } elseif( $softhopper_pick['post_layout'] == 'list' ) {
                                echo ( $gallery_list_images );
                            }
                        }
                    } else {
                        echo ( $gallery_list_images );
                    }  
                    echo "</div>";
		    	}  // end if;
		    ?>
		</figure> <!-- /.post-thumb -->
		<?php
			endif;
		?>

        <div class="entry-content">
        <?php 
            if ( is_single() ) {
                the_content(); 
                edit_post_link( esc_html__( '(Edit Post)', 'pick' ), '<span class="edit-link">', '</span>' );
                pick_theme_tag_list();
                ?>                
                <?php
            } else {
                if ( has_excerpt() ) {
                    the_excerpt();
                } else {
                    the_content();
                }
            }
        ?>  
        <?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pick' ),
				'after'  => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
			) );
		?>
        </div> <!-- .entry-content -->

        <footer class="entry-footer clearfix">                          
            <?php pick_theme_entry_footer(); ?>
        </footer> <!-- .entry-footer -->
    </article> <!-- /.post-->
</div> <!-- /.col-md-12 -->