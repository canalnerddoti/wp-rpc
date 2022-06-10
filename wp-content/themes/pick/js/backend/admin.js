(function ($) {
    "use strict";

	var image_field;
	$( document ).ready( function() {
		// redux framework custom js code 
		$('#softhopper_pick-pick_theme_hidden_slides').parent().parent('tr').addClass( "softhopper_pick-pick_theme_hidden_slides" );
		
		// Show/hide settings for post format when choose post format
		var $format = $( '#post-formats-select' ).find( 'input.post-format' ),
			$formatBox = $( '#_pick_theme_post_format_details' );
			// add a link class default because in cmb2 link class not add
			$('.cmb2-id--pick-theme-format-link, .cmb2-id--pick-theme-format-link-text, .cmb2-id--pick-theme-format-link-bg-img').addClass('link');

		$format.on( 'change', function() {
			var	type = $format.filter( ':checked' ).val();

			$formatBox.hide();
			if( $formatBox.find( '.cmb-row' ).hasClass( type ) ) {
				$formatBox.show();
			}
			$formatBox.find( '.cmb-row' ).slideUp();
			$formatBox.find( '.' + type ).slideDown();
		} );
		$format.filter( ':checked' ).trigger( 'change' );

		// Show/hide settings for custom layout settings
		$( '#_pick_theme_custom_layout' ).on( 'change', function() {
			if( $( this ).is( ':checked' ) ) {
				$( '.cmb2-id--pick-theme-layout' ).slideDown();
			}
			else {
				$( '.cmb2-id--pick-theme-layout' ).slideUp();
			}
		} ).trigger( 'change' );

		// Show/hide settings for custom layout settings
		$( '#_pick_theme_format_status_type' ).on( 'change', function() {
			// facebook
			if( $( this ).val() == "facebook" ) {
				$( '.cmb2-id--pick-theme-format-status-fb' ).slideDown();
			}
			else {
				$( '.cmb2-id--pick-theme-format-status-fb' ).slideUp();
			}
			// twitter
			if( $( this ).val() == "twitter" ) {
				$( '.cmb2-id--pick-theme-format-status-twitter' ).slideDown();
			}
			else {
				$( '.cmb2-id--pick-theme-format-status-twitter' ).slideUp();
			}
			// gplus
			if( $( this ).val() == "gplus" ) {
				$( '.cmb2-id--pick-theme-format-status-gplus' ).slideDown();
			}
			else {
				$( '.cmb2-id--pick-theme-format-status-gplus' ).slideUp();
			}
			// instagram
			if( $( this ).val() == "instagram" ) {
				$( '.cmb2-id--pick-theme-format-status-instagram' ).slideDown();
			}
			else {
				$( '.cmb2-id--pick-theme-format-status-instagram' ).slideUp();
			}

		} ).trigger( 'change' );

	} );

}(jQuery));