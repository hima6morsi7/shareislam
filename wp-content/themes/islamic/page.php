<?php
/*
 * This file is used to generate different page layouts set from backend.
 */
get_header ();
?>
		<?php
        
        $sidebar = get_post_meta ( $post->ID, 'page-option-sidebar-template', true );
        $sidebar_class = '';
        if ($sidebar == "left-sidebar" || $sidebar == "right-sidebar") {
            $sidebar_class = "sidebar-included " . $sidebar;
        } else if ($sidebar == "both-sidebar") {
            $sidebar_class = "both-sidebar-included";
        }
        	$left_sidebar = get_post_meta ( $post->ID, "page-option-choose-left-sidebar", true );
			$right_sidebar = get_post_meta ( $post->ID, "page-option-choose-right-sidebar", true );
		
        ?>
        
      <?php
				// Top Slider Part
				global $cp_top_slider_type, $cp_top_slider_xml;
				if( $cp_top_slider_type == 'Layer Slider' ){
					$layer_slider_id = get_post_meta( $post->ID, 'page-option-layer-slider-id', true);
					echo '<div class="slider-wrapper">';
					echo '<section class="slider-container">';
					echo do_shortcode('[layerslider id="' . $layer_slider_id . '"]');									    
					echo '</section>';
					echo '</div>';
				}else if ($cp_top_slider_type != "No Slider" && $cp_top_slider_type != '') {
					echo '<section class="slider-wrapper top-slider">';
					$slider_xml = "<Slider>" . create_xml_tag ( 'size', 'full-width' );
					$slider_xml = $slider_xml . create_xml_tag ( 'height', get_post_meta ( $post->ID, 'page-option-top-slider-height', true ) );
					$slider_xml = $slider_xml . create_xml_tag ( 'width', 960 );
					$slider_xml = $slider_xml . create_xml_tag ( 'slider-type', $cp_top_slider_type );
					$slider_xml = $slider_xml . $cp_top_slider_xml;
					$slider_xml = $slider_xml . "</Slider>";
					$slider_xml_dom = new DOMDocument ();
					$slider_xml_dom->loadXML ( $slider_xml );
					print_slider_item ( $slider_xml_dom->documentElement );
					echo '</section>';
				  }
				?>
                
	<section class="content-separator"></section>
    
    <section class="page-body-outer">
        <section class="page-body-wrapper container mt15"> 
		       <div class="content-wrapper <?php echo $sidebar_class; ?>">	 
	  <?php
			
			echo "<div class='cp-page-float-left'>";
			
		     			echo "<div class='cp-page-item'>";
								
								// Page title and content
								$cp_show_title = get_post_meta ( $post->ID, 'page-option-show-title', true );
								$cp_show_content = get_post_meta ( $post->ID, 'page-option-show-content', true );
								if ($cp_show_title != "No") {
									while ( have_posts () ) {
										the_post ();
										echo '<section class="sixteen columns mt0">';
											if (! empty ( $cp_page_xml )) {	
													$page_xml_val = new DOMDocument ();
													$page_xml_val->loadXML ( $cp_page_xml );
													
											foreach ( $page_xml_val->documentElement->childNodes as $item_xml ) {
													$page_title = ($item_xml->nodeName);
													}
											}
										/*    if ($page_title !== 'Portfolio' && $page_title !== 'Products' ){*/
											   		  echo '<h1 class="cp-page-title cp-divider cp-title title-color">';
													  $cp_show_title = get_post_meta ( $post->ID, 'page-option-show-title', true );
													  $cp_show_content = get_post_meta ( $post->ID, 'page-option-show-content', true );
											if ($cp_show_title != "No") {
												the_title ();
											}
											echo '<span class="h-line"></span></h1>';
											/*}*/
										$content = get_the_content ();
										if ($cp_show_content != 'No' && ! empty ( $content )) {
											echo '<div class="cp-page-wrapper">';
											echo '<div class="cp-page-content">';
											the_content ();
											wp_link_pages ( array ('before' => '<div class="page-link"><span>' . __ ( 'Pages:', 'cp_front_end' ) . '</span>', 'after' => '</div>' ) );
											echo '</div>';
											echo '</div>';
											echo '<div class="clear"></div>';
										}
										echo '</section>';
									}
								} else {
									while ( have_posts () ) {
										the_post ();
										$content = get_the_content ();
										if ($cp_show_content != 'No' && ! empty ( $content )) {
											echo '<section class="sixteen columns mt0">';
											echo '<div class="cp-page-content">';
											the_content ();
											echo '</div>';
											echo '</section>';
										}
									}
								}
								
								global $cp_item_row_size;
								$cp_item_row_size = 0;
								// Page Item Part
								if (! empty ( $cp_page_xml )) {
									$page_xml_val = new DOMDocument ();
									$page_xml_val->loadXML ( $cp_page_xml );
									foreach ( $page_xml_val->documentElement->childNodes as $item_xml ) {
										switch ($item_xml->nodeName) {
											case 'Accordion' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_accordion_item ( $item_xml );
												break;
											case 'Blog' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ));
												print_blog_item ( $item_xml );
												break;
											case 'Contact-Form' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'mt0' );
												print_contact_form ( $item_xml );
												break;
											case 'Column' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_column_item ( $item_xml );
												break;
											case 'Services-Widget' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_column_service ( $item_xml );
												break;
											case 'Content' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_content_item ( $item_xml );
												break;
											case 'Divider' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'wrapper' );
												print_divider ( $item_xml );
												break;
											case 'Gallery' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ),'wrapper');
												print_gallery_item ( $item_xml );
												break;
											case 'Message-Box' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_message_box ( $item_xml );
												break;
											case 'Page' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'wrapper cp-portfolio-item mt0' );
												print_page_item ( $item_xml );
												break;
											case 'Price-Item' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'cp-price-item' );
												print_price_item ( $item_xml );
												break;
											case 'Portfolio' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'wrapper cp-portfolio-item' );
												print_portfolio ( $item_xml ); // print_portfolio_style1
												break;
											case 'Slider' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'mt20' );
												print_slider_item ( $item_xml );
												break;
											case 'Text-Widget' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ), 'mt0' );
												print_text_widget ( $item_xml );
												break;
											case 'Tab' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_tab_item ( $item_xml );
												break;
											case 'Testimonial' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ));
												print_testimonial ( $item_xml );
												break;
											case 'Toggle-Box' :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												print_toggle_box_item ( $item_xml );
												break;
											default :
												print_item_size ( find_xml_value ( $item_xml, 'size' ) );
												break;
										}
										echo "</article>";
									}
								}
						echo "</div>"; // end of cp-page-item
		            	    get_sidebar ( 'left' );
					echo "</div>"; // cp-page-float-left
		                	get_sidebar ( 'right' );
		 	
			?>
        </div><!--content-wrapper-->
      </section> <!--page-body-wrapper-end-->
    </section>
<?php get_footer(); ?>