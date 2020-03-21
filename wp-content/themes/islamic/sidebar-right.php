<?php 
	/*
	 * This file is used to generate right sidebar
	 */	
?>
<?php
	global $sidebar;
	if( $sidebar == "right-sidebar" ){
		
		global $right_sidebar;
		echo "<aside class='five columns cp-right-sidebar mt0'>";
			echo "<div class='right-sidebar-wrapper cp-divider'>";
				dynamic_sidebar( $right_sidebar );
				echo "<div class='pt30'></div>";
			echo "</div>";
		echo "</aside>";
	
	}else if( $sidebar == "both-sidebar" ){
		
		global $right_sidebar;
			echo "<aside class='four columns cp-right-sidebar mt0'>";
				echo "<div class='right-sidebar-wrapper cp-divider'>";
				dynamic_sidebar( $right_sidebar );
				echo "<div class='pt30'></div>";	
			echo "</div>";			
		echo "</aside>";				
	
	}

?>