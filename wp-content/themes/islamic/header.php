<!DOCTYPE HTML>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>>

<!--<![endif]-->

<head>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

            
            <!--[if gte IE 9]>
              <style type="text/css">
                .gradient {
                   filter: none;
                }
              </style>
            <![endif]-->
            <!-- Basic Page Requirements
            
  ================================================== -->

<meta charset="utf-8" />

<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>


<!-- CSS -->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo CP_PATH_URL; ?>/stylesheet/main.css" type="text/css" />
<?php global $cp_is_responsive ?>
<?php if( $cp_is_responsive ){ ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="<?php echo CP_PATH_URL; ?>/stylesheet/grid-responsive.css">
<link rel="stylesheet" href="<?php echo CP_PATH_URL; ?>/stylesheet/layout-responsive.css">
<?php } ?>

<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php echo CP_PATH_URL; ?>/stylesheet/ie-style.php?path=<?php echo CP_PATH_URL; ?>" type="text/css" media="screen, projection" /> 
	<![endif]-->
<!--[if IE 7]>
		<link rel="stylesheet" href="<?php echo CP_PATH_URL; ?>/stylesheet/ie7-style.css" /> 
	<![endif]-->
<!-- Favicon -->


<?php 

		if(get_option( THEME_NAME_S.'_enable_favicon','disable') == "enable"){
			$cp_favicon = get_option(THEME_NAME_S.'_favicon_image');
			    if( $cp_favicon ){
				   $cp_favicon = wp_get_attachment_image_src($cp_favicon, 'full');
				echo '<link rel="shortcut icon" href="' . $cp_favicon[0] . '" type="image/x-icon" />';
			}
		 } 
		 
?>

<!-- FB Thumbnail -->

<?php

	if( is_single() ){
		$thumbnail_id = get_post_meta($post->ID,'post-option-inside-thumbnial-image', true);
		if( !empty($thumbnail_id) ){
			      $thumbnail = wp_get_attachment_image_src( $thumbnail_id , '150x150' );
			echo '<link rel="image_src" href="' . $thumbnail[0] . '" />';
		  }

	} else {
		$thumbnail_id = get_post_thumbnail_id();
	    if( !empty($thumbnail_id) ){
			      $thumbnail = wp_get_attachment_image_src( $thumbnail_id , '150x150' );
	      	echo '<link rel="image_src" href="' . $thumbnail[0] . '" />';		
		  }
	}

?>


<!-- Start WP_HEAD -->

<?php wp_head(); ?>

</head>

          <body <?php echo body_class(); ?>>
               <div class="body-wrapper">
               		 <header class="main">
                  		<?php $cp_enable_top_navigation = get_option(THEME_NAME_S.'_enable_top_navigation');
                            if ( $cp_enable_top_navigation == '' || $cp_enable_top_navigation == 'enable' ){  ?>
                			  <section class="top-navigation">
                                <span class="patern bg-1"></span>
                               		 <strong class="bismiallah"></strong>
                                <span class="patern bg-2"></span>
						       </section>
                         <?php } ?>

                         
         <div class="header-wrapper">
                  
      <!-- Get Logo --> 
       <div class="container">
       <strong id="logo">
      <?php

                    echo '<a href="' . home_url( '/' ) . '">';
                    $logo_id = get_option(THEME_NAME_S.'_logo');
                    $logo_attachment = wp_get_attachment_image_src($logo_id, 'full');
                    $alt_text = get_post_meta($logo_id , '_wp_attachment_image_alt', true);
                    if( !empty($logo_attachment) ){
                       $logo_attachment = $logo_attachment[0];
                    }else{
                        $logo_attachment = CP_PATH_URL . '/images/default-logo.png';
                        $alt_text = 'default logo';
                    }

                    echo '<img src="' . $logo_attachment . '" alt="' . $alt_text . '"/>';
                    echo '</a>';

      ?>
      </strong>  
      
      
</div>
                    <!-- Main Menu -->
                      <nav class="main-menu"> 
                        <?php 
                            if( $cp_is_responsive ){
                                dropdown_menu( array('dropdown_title' => '-- Main Menu --', 'indent_string' => '- ', 'indent_after' => '','container' => 'div', 'container_class' =>  
                                                        'responsive-menu-wrapper', 'theme_location'=>'main_menu') );
                              }
                                 wp_nav_menu( array('container' => 'div', 'container_class' => 'container', 'menu_class'=> 'sf-menu',  'theme_location' => 'main_menu',) ); 
                         ?>
                      </nav>
                    

     </div>    <!--container-end-->
</header> 