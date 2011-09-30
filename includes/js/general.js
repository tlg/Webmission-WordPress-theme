/*-----------------------------------------------------------------------------------

FILE INFORMATION

Description: JavaScript on the "Delicious Magazine" WooTheme.
Date Created: 2011-02-11.
Author: Matty.
Since: 1.0


TABLE OF CONTENTS

- Detect and adjust the heights of the main columns to match.

-----------------------------------------------------------------------------------*/

jQuery(document).ready(function() {

/*-----------------------------------------------------------------------------------
  Detect and adjust the heights of the main columns to match.
-----------------------------------------------------------------------------------*/

	// Detect the heights of the two main columns.
	
	var content;
	content = jQuery("#main");
	
	var contentHeight = content.height();
	
	var sidebar;
	sidebar = jQuery("#sidebar");
	
	var sidebarHeight = sidebar.height();

	// Adjust the heights to match.

	var tabs;
	tabs = jQuery("#sidebar #tabs").height();
	tabs = tabs/3*2;
	sidebarHeight -= tabs;
	
	// Determine the ideal new sidebar height.
	
	var newSidebarHeight;
	var contentPadding;
	
	contentPadding = parseInt( content.css( 'padding-top' ) ) + parseInt( content.css( 'padding-bottom' ) );
	
	if( contentHeight < sidebarHeight ) {
	
		content.height(sidebarHeight);
		
		newSidebarHeight = sidebarHeight + contentPadding;
	
	} // End IF Statement
	
	if( contentHeight > sidebarHeight ) {
	
		sidebar.height(contentHeight);
		
		newSidebarHeight = contentHeight + contentPadding;
	
	} // End IF Statement
	
	newSidebarHeight = Math.ceil( newSidebarHeight );
	
	// Make the height of the sidebar the same as the container.
	sidebar.css( 'height', String( newSidebarHeight + 'px' ) );

}); // Do not remove this, or the sky will fall on your head.