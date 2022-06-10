<?php
/**
 * The template for displaying page content.
 *
 * @package Pick
 */
 $softhopper_pick = get_option('softhopper_pick');
?>
<div class="col-md-12 full-width">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<header class="entry-header">
			<?php pick_theme_page_entry_header(); ?>
		</header>
		
		<?php 
			if ( has_post_thumbnail() ) {
	        ?>
	        <figure class="post-thumb">
				<?php
					$meta = get_post_meta( $post->ID );
					if ( isset($meta["_pick_theme_custom_layout"][0]) ) {
					    ( $meta["_pick_theme_layout"][0] == 'full-content' ) ? $image_size = "pick-theme-single-full" : $image_size = "pick-theme-single-list" ;
					} else {
					    ( $softhopper_pick['sidebar_layout_page'] == 1 ) ? $image_size = "pick-theme-single-full" : $image_size = "pick-theme-single-list";
					}
					the_post_thumbnail( $image_size, array( 'class' => " img-responsive", 'alt' => get_the_title() ));
		        ?>
			</figure> <!-- /.post-thumb -->
	        <?php
	        }
		?>

		<div class="entry-content">
			<?php 
				the_content();
				edit_post_link( esc_html__( '(Edit Page)', 'pick' ), '<span class="edit-link">', '</span>' ); 
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
	 	    
	</article> <!-- /.post-->
</div> <!-- /.col-md-12 -->