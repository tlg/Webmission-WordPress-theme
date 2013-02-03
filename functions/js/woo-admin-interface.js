/**
 * WooThemes Admin Interface JavaScript
 *
 * All JavaScript logic for the theme options admin interface.
 * @since 4.8.0
 *
 */

(function ($) {

  woothemesAdminInterface = {
  
/**
 * toggle_nav_tabs()
 *
 * @since 4.8.0
 */
 
 	toggle_nav_tabs: function () {
 		var flip = 0;
	
		$( '#expand_options' ).click( function(){
			if( flip == 0 ){
				flip = 1;
				$( '#woo_container #woo-nav' ).hide();
				$( '#woo_container #content' ).width( 785 );
				$( '#woo_container .group' ).add( '#woo_container .group h1' ).show();

				$(this).text( '[-]' );

			} else {
				flip = 0;
				$( '#woo_container #woo-nav' ).show();
				$( '#woo_container #content' ).width( 595 );
				$( '#woo_container .group' ).add( '#woo_container .group h1' ).hide();
				$( '#woo_container .group:first' ).show();
				$( '#woo_container #woo-nav li' ).removeClass( 'current' );
				$( '#woo_container #woo-nav li:first' ).addClass( 'current' );

				$(this).text( '[+]' );

			}

		});
 	}, // End toggle_nav_tabs()

/**
 * load_first_tab()
 *
 * @since 4.8.0
 */
 
 	load_first_tab: function () {
 		$( '.group').hide();
		$( '.group:first' ).fadeIn();
 	}, // End load_first_tab()
 	
/**
 * toggle_collapsed_fields()
 *
 * @since 4.8.0
 */
 
 	toggle_collapsed_fields: function () {
		$( '.group .collapsed' ).each(function(){
			$( this ).find( 'input:checked' ).parent().parent().parent().nextAll().each( function(){
				if ($( this ).hasClass( 'last' ) ) {
					$( this ).removeClass( 'hidden' );
					return false;
				}
				$( this ).filter( '.hidden' ).removeClass( 'hidden' );
				
				$( '.group .collapsed input:checkbox').click(function ( e ) {
					woothemesAdminInterface.unhide_hidden( $( this ).attr( 'id' ) );
				});

			});
		});
 	}, // End toggle_collapsed_fields()

/**
 * setup_nav_highlights()
 *
 * @since 4.8.0
 */
 
 	setup_nav_highlights: function () {
	 	$( '#woo-nav li:first' ).addClass( 'current' );
		$( '#woo-nav li a' ).click( function( evt ) {
			$( '#woo-nav li' ).removeClass( 'current' );
			$( this ).parent().addClass( 'current' );
		
			var clicked_group = $( this ).attr( 'href' );
		
			$( '.group' ).hide();
			$( clicked_group ).fadeIn();
		
			evt.preventDefault();
		});
 	}, // End setup_nav_highlights()

/**
 * setup_custom_typography()
 *
 * @since 4.8.0
 */
 
 	setup_custom_typography: function () {
	 	$( 'select.woo-typography-unit' ).change( function(){
			var val = $( this ).val();
			var parent = $( this ).parent();
			var name = parent.find( '.woo-typography-size-px' ).attr( 'name' );
			if( name == '' ) { var name = parent.find( '.woo-typography-size-em' ).attr( 'name' ); }
		
			if( val == 'px' ) {
				parent.find( '.woo-typography-size-em' ).hide().removeAttr( 'name' );
				parent.find( '.woo-typography-size-px' ).show().attr( 'name', name );
			}
			else if( val == 'em' ) {
				parent.find( '.woo-typography-size-em' ).show().attr( 'name', name );
				parent.find( '.woo-typography-size-px' ).hide().removeAttr( 'name' );
			}
		
		});
 	}, // End setup_custom_typography()

/**
 * unhide_hidden()
 *
 * @since 4.8.0
 * @see toggle_collapsed_fields()
 */
 
 	unhide_hidden: function ( obj ) {
 		obj = $( '#' + obj ); // Get the jQuery object.
 		
		if ( obj.attr( 'checked' ) ) {
			obj.parent().parent().parent().nextAll().slideDown().removeClass( 'hidden' ).addClass( 'visible' );
		} else {
			obj.parent().parent().parent().nextAll().each( function(){
				if ( $( this ).filter( '.last' ).length ) {
					$( this ).slideUp().addClass( 'hidden' );
				return false;
				}
				$( this ).slideUp().addClass( 'hidden' );
			});
		}
 	} // End unhide_hidden()
  
  }; // End woothemesAdminInterface Object // Don't remove this, or the sky will fall on your head.

/**
 * Execute the above methods in the woothemesAdminInterface object.
 *
 * @since 4.8.0
 */
	$(document).ready(function () {
	
		woothemesAdminInterface.toggle_nav_tabs();
		woothemesAdminInterface.load_first_tab();
		woothemesAdminInterface.toggle_collapsed_fields();
		woothemesAdminInterface.setup_nav_highlights();
		woothemesAdminInterface.setup_custom_typography();
	
	});
  
})(jQuery);