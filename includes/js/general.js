/*-----------------------------------------------------------------------------------

FILE INFORMATION

Description: JavaScript on the "Delicious Magazine" WooTheme.
Date Created: 2011-02-11.
Author: Matty.
Since: 1.0


TABLE OF CONTENTS

- Detect and adjust the heights of the main columns to match.

-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* Detect and adjust the heights of the main columns to match */
/*-----------------------------------------------------------------------------------*/

jQuery( window ).load( function () {

	// Detect the heights of the two main columns.
	
	var content;
	content = jQuery( '#main' );
	
	var contentHeight = content.height();
	
	var sidebar;
	sidebar = jQuery( '#sidebar' );
	
	var sidebarHeight = sidebar.height();
	
	// Determine the ideal new sidebar height.
	
	var newSidebarHeight;
	var contentPadding;
	var sidebarPadding;
	
	contentPadding = parseInt( content.css( 'padding-top' ) ) + parseInt( content.css( 'padding-bottom' ) );
	sidebarPadding = parseInt( sidebar.css( 'padding-top' ) ) + parseInt( sidebar.css( 'padding-bottom' ) );
	
	if( contentHeight < sidebarHeight ) {
	
		content.height( sidebarHeight + sidebarPadding );
		sidebar.height( sidebarHeight + contentPadding );
	
	} // End IF Statement
	
	if( contentHeight > sidebarHeight ) {
	
		sidebar.height( contentHeight + contentPadding );
		content.height( contentHeight );
	
	} // End IF Statement

}); // End jQuery()