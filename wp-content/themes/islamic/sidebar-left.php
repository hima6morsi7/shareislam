<?php 
	/*
	 * This file is used to generate left sidebar
	 */	
?>
<?php

	global $sidebar;
	global $left_sidebar;	
		
	if( $sidebar == "left-sidebar" ){	
		
		echo "<aside class='five columns cp-left-sidebar mt0'>";
			echo "<div class='left-sidebar-wrapper cp-divider'>";
				dynamic_sidebar( $left_sidebar );
				echo "<div class='pt30'></div>";
			echo "</div>";
		echo "</aside>";
	
	}else if( $sidebar == "both-sidebar" ){
	
		global $left_sidebar;
		echo "<aside class='four columns cp-left-sidebar mt0'>";
			echo "<div class='left-sidebar-wrapper cp-divider'>";
				dynamic_sidebar( $left_sidebar );
				echo "<div class='pt30'></div>";		
			echo "</div>";	
		echo "</aside>";					
	
	}	

?>